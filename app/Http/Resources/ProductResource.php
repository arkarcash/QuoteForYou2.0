<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use function Symfony\Component\Translation\t;

class ProductResource extends JsonResource
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
            'id' => $this->id,
            'code'=> $this->product_code,
            'price' => $this->price,
            'stock' => $this->stock,
            'description' => $this->description,
            'category_id'=> $this->category_id,
            'category_name' => $this->category->name,
            'from_age' => $this->from_age,
            'to_age' => $this->to_age,
            'photos' => PhotoResource::collection($this->photos)
        ];
    }
}
