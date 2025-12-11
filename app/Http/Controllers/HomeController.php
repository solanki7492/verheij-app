<?php

namespace App\Http\Controllers;

use App\Http\Traits\ApiResponse;
use App\Models\Page;
use App\Models\Setting;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class HomeController extends Controller
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
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function index()
    {
        $aboutUs = Page::where('slug', 'about-us')->first();
        $settings = Setting::first();
        $aboutText = "";
        if (!is_null($aboutUs)){
            $aboutText = $aboutUs->content;
        }

        $aboutUsDetail = Page::where('slug', 'about-us-detail')->first();
        $aboutDetailText = "";
        if (!is_null($aboutUsDetail)){
            $aboutDetailText = $aboutUsDetail->content;
        }
        return view('admin.index', compact('aboutText', 'aboutDetailText', 'settings'));
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function aboutUs(Request $request): JsonResponse
    {
        Page::updateOrCreate([
            'name' => 'About Us',
            'slug' => 'about-us'
        ],[
            'name' => 'About Us',
            'slug' => 'about-us',
            'content' => $request->text
        ]);

        return $this->success();
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function aboutUsDetail(Request $request): JsonResponse
    {
        Page::updateOrCreate([
            'name' => 'About Us Detail',
            'slug' => 'about-us-detail'
        ],[
            'name' => 'About Us Detail',
            'slug' => 'about-us-detail',
            'content' => $request->text
        ]);

        return $this->success();
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function settings(Request $request): JsonResponse
    {
        $request->validate([
            'contactPhone' => ['required', 'string', 'max:20'],
            'whatsapp' => ['required', 'string', 'max:20'],
            'contactEmail' => ['required', 'string', 'max:225'],
            'latitude' => ['required', 'numeric'],
            'longitude' => ['required', 'numeric'],
        ]);

        $settings = Setting::query()->first();
        if (is_null($settings)){
            Setting::query()->create([
                'phone' => optional($request)->contactPhone,
                'whatsapp' => optional($request)->whatsapp,
                'email' => optional($request)->contactEmail,
                'latitude' => optional($request)->latitude,
                'longitude' => optional($request)->longitude
            ]);
        }else {
            $settings->update([
                'phone' => optional($request)->contactPhone,
                'whatsapp' => optional($request)->whatsapp,
                'email' => optional($request)->contactEmail,
                'latitude' => optional($request)->latitude,
                'longitude' => optional($request)->longitude
            ]);
        }

        return $this->success();
    }
}
