<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        $photo = asset('Ranks/'.$this->photo);
        return [
            "id" => $this->id,
            "name" => $this->name,
            "email" => $this->email,
            "points" => $this->points,
            "photo" => $photo,
        ];
    }
}
