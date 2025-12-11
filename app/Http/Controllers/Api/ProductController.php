<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Http\Traits\ApiResponse;
use App\Models\Device;
use App\Models\Page;
use App\Models\Product;
use App\Models\Setting;
use App\Models\User;
use App\Services\Mail\MailService;
use App\Services\Notifications\NotificationService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Kreait\Firebase\Messaging\CloudMessage;
use function App\Helpers\get_email;
use function App\Helpers\get_order_product;
use function App\Helpers\get_order_quantity;
use function App\Helpers\parse_date;

class ProductController extends Controller
{
    use ApiResponse;

    /**
     * Show the application dashboard.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $products = Product::query()->orderByDesc('created_at')->get();
        $latestDate = Product::query()->orderByDesc('updated_at')->select('updated_at')->first();

        return $this->success([
            'latestUpdate' => (!is_null($latestDate))?parse_date($latestDate->updated_at):null,
            'products' => ProductResource::collection($products)
        ]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function contact(Request $request): JsonResponse
    {
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['required', 'max:15'],
            'message' => ['required', 'max:1024'],
            'time_slot' => ['required', 'string', 'max:255'],
        ]);

        $contact = "<strong>".__('web.first_name').":</strong> ".optional($request)->first_name."<br>";
        $contact .= "<strong>".__('web.last_name').":</strong> ".optional($request)->last_name."<br>";
        $contact .= "<strong>".__('web.emailAddress').":</strong> ".optional($request)->email."<br>";
        $contact .= "<strong>".__('web.phone').":</strong> ".optional($request)->phone."<br>";
        $contact .= "<strong>".__('web.message').":</strong> ".nl2br(optional($request)->message)."<br>";
        $contact .= "<strong>".__('web.time_slot').":</strong> ".nl2br(optional($request)->time_slot)."<br>";

        MailService::make()->sendMail(get_email(),__('web.contactSubject'), $contact);

        return $this->success([], __('web.contactSuccess'));
    }

    public function order(Request $request): JsonResponse
    {
        $request->validate([
            'date' => ['required'],
            'product_name' => ['required'],
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['required', 'max:15'],
            'message' => ['required', 'max:1024'],
            'address' => ['required', 'max:1024', 'string'],
            'postcode' => ['required', 'max:10', 'string'],
            'residence' => ['required', 'max:225', 'string'],
            'province' => ['required', 'max:225', 'string'],
            'quantity' => ['required', 'string', Rule::in(get_order_quantity())],
            'product' => ['required', 'string', Rule::in(get_order_product())],
            'minimum_weight' => ['required', 'max:225', 'string'],
            'time_slot' => ['required', 'max:225', 'string'],
            'image' => ['required', 'image']
        ]);

        $order = "<strong>".__('web.productName').":</strong> ".optional($request)->product_name."<br>";
        $order .= "<strong>".__('web.date').":</strong> ".optional($request)->date."<br>";
        $order .= "<strong>".__('web.first_name').":</strong> ".optional($request)->first_name."<br>";
        $order .= "<strong>".__('web.last_name').":</strong> ".optional($request)->last_name."<br>";
        $order .= "<strong>".__('web.emailAddress').":</strong> ".optional($request)->email."<br>";
        $order .= "<strong>".__('web.phone').":</strong> ".optional($request)->phone."<br>";
        $order .= "<strong>".__('web.address').":</strong> ".optional($request)->address."<br>";
        $order .= "<strong>".__('web.postcode').":</strong> ".optional($request)->postcode."<br>";
        $order .= "<strong>".__('web.residence').":</strong> ".optional($request)->residence."<br>";
        $order .= "<strong>".__('web.province').":</strong> ".optional($request)->province."<br>";
        $order .= "<strong>".__('web.quantity').":</strong> ".optional($request)->quantity."<br>";
        $order .= "<strong>".__('web.product').":</strong> ".optional($request)->product."<br>";
        $order .= "<strong>".__('web.message').":</strong> ".nl2br(optional($request)->message)."<br>";
        // if (optional($request)->product_name == "30m" || optional($request)->product_name == "40m") {
        $order .= "<strong>".__('web.minimumWeight').":</strong> ".optional($request)->minimum_weight."<br>";
        // }
        $order .= "<strong>".__('web.time_slot').":</strong> ".nl2br(optional($request)->time_slot)."<br>";

        $image = $request->file('image');
        $base64Image = base64_encode(file_get_contents($image->path()));

        MailService::make()->sendMail(get_email(),__('web.orderSubject'), $order,null,$base64Image);

        return $this->success([], __('web.orderSuccess'));
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function initial(Request $request): JsonResponse
    {
        $aboutUs = Page::where('slug', 'about-us')->first();
        $aboutText = "";
        if (!is_null($aboutUs)){
            $aboutText = $aboutUs->content;
        }

        $aboutUsDetail = Page::where('slug', 'about-us-detail')->first();
        $aboutDetailText = "";
        if (!is_null($aboutUsDetail)){
            $aboutDetailText = $aboutUsDetail->content;
        }

        $settings = Setting::query()->first();

        $coordinates = [];
        $phone = null;
        $whatsapp = null;
        if (!is_null($settings)){
            $coordinates = [$settings->latitude,$settings->longitude];
            $phone = $settings->phone;
            $whatsapp = $settings->whatsapp;
        }

        return $this->success([
            'about' => $aboutText,
            'about_detail' => $aboutDetailText,
            'location' => $coordinates,
            'phone' => $phone,
            'whatsapp' => $whatsapp,
            'quantity' => get_order_quantity(),
            'product' => get_order_product()
        ]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function addDevice(Request $request): JsonResponse
    {
        $request->validate([
            'firebase_token' => ['required', 'string'],
            'platform' => ['nullable', Rule::in(Device::DEVICES)]
        ]);

        Device::query()->updateOrCreate([
            'firebase_token' => optional($request)->firebase_token
        ],[
            'firebase_token' => optional($request)->firebase_token,
            'platform' => optional($request)->platform
        ]);

        return $this->success();
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function sendNotification(Request $request): JsonResponse
    {
        NotificationService::make()->sendNotification('Notification Title', 'Vanooapps notification body.');

        return $this->success();
    }

    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:1024'],
            'price' => ['required', 'numeric', 'min:0']
        ]);

        $product = Product::create([
            'name' => optional($request)->name,
            'price' => optional($request)->price,
            'price_status' => optional($request)->price_status ?? 0
        ]);

        return $this->success([
            'product' => $product
        ]);
    }

    public function update(Request $request, Product $product): JsonResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:1024'],
            'price' => ['required', 'numeric', 'min:0']
        ]);
        
        $product->update([
            'name' => optional($request)->name,
            'price' => optional($request)->price,
            'price_status' => optional($request)->price_status ?? 0
        ]);

        return $this->success([
            'product' => $product
        ]);
    }

    public function destroy(Product $product): JsonResponse
    {
        $product->delete();
        return $this->success();
    }
}
