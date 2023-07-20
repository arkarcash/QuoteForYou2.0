<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;
use function Symfony\Component\Translation\t;

class PhotoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        if($this->photo == 'default.png'){
            $photo = 'https://cdn3d.iconscout.com/3d/premium/thumb/afro-avatar-6299534-5187866.png';
        }else{
            $photo = asset('storage/'.$this->photo);
        }
        return $photo;
    }
}
