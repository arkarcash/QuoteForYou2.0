<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class VoiceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        if(Str::contains('http',$this->photo)){
            $photo = $this->photo;
        }else{
            $photo = asset('storage/'.$this->photo);
        }
        return [
            'title' => $this->title,
            'category_id' => $this->voice_category_id,
            'category' => $this->voiceCategory->name,
            'photo' => $photo,
            'description' => $this->description
        ];
    }
}
