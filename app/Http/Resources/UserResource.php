<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use function App\Helpers\parse_date;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => optional($this)->id,
            'name' => optional($this)->name,
            'email' => optional($this)->email,
            'role' => optional($this)->role == \App\Models\User::ROLE_ADMIN ? 'Admin' : 'API User',
            'created_at' => parse_date(optional($this)->created_at),
            'updated_at' => parse_date(optional($this)->updated_at)
        ];
    }
}
