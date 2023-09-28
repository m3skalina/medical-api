<?php

namespace App\Http\Resources\Point;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PointResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'city' => $this->city,
            'address' => $this->address,
            'vat' => $this->vat,
            'phone' => $this->phone,
            'email' => $this->email,
            'is_active' => $this->is_active,
        ];
    }
}
