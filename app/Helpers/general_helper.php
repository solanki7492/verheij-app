<?php

namespace App\Helpers;

use App\Models\Setting;
use Carbon\Carbon;

if(!function_exists('get_user_pic')){
    function get_user_pic() : string
    {
        return asset('logos/icon.png');
    }
}

if(!function_exists('parse_date')){
    function parse_date($date) : ?string
    {
        if(is_null($date)){
            return null;
        }
        return Carbon::parse($date)->format(get_date_format());
    }
}

if(!function_exists('get_date_format')){
    function get_date_format() : string
    {
        return 'd-m-Y';
    }
}

if(!function_exists('get_order_quantity')){
    function get_order_quantity() : array
    {
        return explode(',',env('ORDER_QUANTITY'));

    }
}

if(!function_exists('get_order_product')){
    function get_order_product() : array
    {
        return explode(',',env('ORDER_PRODUCT'));

    }
}

if(!function_exists('get_email')){
    function get_email()
    {
        $settings = Setting::query()->first();
        if (!is_null($settings) && !is_null($settings->email)){
            return $settings->email;
        }
        return env('CONTACT_EMAIL');
    }
}
