<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Http\Traits\ApiResponse;
use App\Models\Product;
use App\Services\Notifications\NotificationService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
    use ApiResponse;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        if (request()->ajax()) {
            $query = Product::query()->orderByDesc('created_at');

            return DataTables::eloquent($query)
                ->setTransformer(function ($item) {
                    return ProductResource::make($item)->resolve();
                })
                ->toJson();
        }
    }

    /**
     * store newly created resource
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:1024'],
            'price' => ['required', 'numeric', 'min:0']
        ]);

        Product::query()->create([
            'name' => optional($request)->name,
            'price' => optional($request)->price
        ]);

        return $this->success();
    }

    /**
     * update resource
     *
     * @param Request $request
     * @param Product $product
     * @return JsonResponse
     */
    public function update(Request $request, Product $product): JsonResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:1024'],
            'price' => ['required', 'numeric', 'min:0']
        ]);

        $product->update([
            'name' => optional($request)->name,
            'price' => optional($request)->price,
            'price_status' => ($request->price == $product->price)?0:(($request->price > $product->price)?1:2)
        ]);

        return $this->success();
    }

    /**
     * destroy a resource
     *
     * @param Product $product
     * @return JsonResponse
     */
    public function destroy(Product $product): JsonResponse
    {
        $product->delete();
        return $this->success();
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function notify(Request $request): JsonResponse
    {
        $request->validate([
            'title' => ['required', 'string'],
            'body' => ['required', 'string']
        ]);

        NotificationService::make()->sendNotification(optional($request)->title, optional($request)->body);

        return $this->success();
    }
}
