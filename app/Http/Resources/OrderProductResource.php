<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'name' => $this->product->name,
            'category' => $this->product->category->name,
            'quantity' => $this->quantity,
            'price' => $this->product_price,
            'total_price' => $this->sub_price,
        ];
    }
}
