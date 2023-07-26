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

        if(Str::contains($this->photo,'http')){
            $photo = $this->photo;
        }else{
            $photo = asset('storage/'.$this->photo);
        }
        return [
            'id' => $this->id,
            'title' => $this->title,
            'category_id' => $this->voice_category_id,
            'category' => $this->voiceCategory->name,
            'photo' => $photo,
            'view' => $this->view,
            'description' => $this->description
        ];
    }
}
