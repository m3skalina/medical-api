<?php

namespace App\Http\Resources\Invoice;

use App\Http\Resources\Point\PointResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InvoiceResource extends JsonResource
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
            'invoice_code' => $this->invoice_code,
            'date' => $this->date->format('Y-m-d'),
            'amount' => $this->amount,
        ];
    }
}
