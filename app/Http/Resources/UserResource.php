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
        if($this->photo == null){
            $photo = 'https://cdn3d.iconscout.com/3d/premium/thumb/afro-avatar-6299534-5187866.png';
        }else{
            $photo = asset('storage/'.$this->photo);
        }
        return [
            "id" => $this->id,
            "name" => $this->name,
            "email" => $this->email,
            "points" => $this->points,
            "photo" => $photo,
        ];
    }
}
