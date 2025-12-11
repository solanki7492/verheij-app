<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use function App\Helpers\parse_date;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray(Request $request): array
    {
        $priceStatus = '<img src="'.asset('same.png').'" width="20" style="margin-left: 5px;">';
        if (optional($this)->price_status == 1){
            $priceStatus = '<img src="'.asset('up.png').'" width="20" style="margin-left: 5px;">';
        }elseif (optional($this)->price_status == 2){
            $priceStatus = '<img src="'.asset('down.png').'" width="20" style="margin-left: 5px;">';
        }
        return [
            'id' => optional($this)->id,
            'name' => optional($this)->name,
            'price' => number_format(optional($this)->price, 2, ','),
            'display_price' => $priceStatus.' &euro; '.number_format(optional($this)->price, 2, ','),
            'price_status' => optional($this)->price_status,
            'created_at' => parse_date(optional($this)->created_at),
            'updated_at' => parse_date(optional($this)->updated_at)
        ];
    }
}
