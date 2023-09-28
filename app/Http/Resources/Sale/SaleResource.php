<?php

namespace App\Http\Resources\Sale;

use App\Http\Resources\Point\PointResource;
use App\Http\Resources\Service\ServiceResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SaleResource extends JsonResource
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
            'point' => PointResource::make($this->point),
            'service' => ServiceResource::make($this->service),
            'date' => $this->date->format('Y-m-d'),
            'amount' => $this->amount,
        ];
    }
}
