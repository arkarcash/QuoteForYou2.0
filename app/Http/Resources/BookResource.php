<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class BookResource extends JsonResource
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

        if(Str::contains('http',$this->e_book)){
            $eBook = $this->e_book;
        }else{
            if ($this->e_book != null){
                $eBook = asset('storage/'.$this->e_book);
            }
        }
        return [
            'id' => $this->id,
            'title' => $this->title,
            'category_id' => $this->voice_category_id,
            'category' => $this->voiceCategory->name,
            'photo' => $photo,
            'description' => $this->description,
            "is_premium" =>  $this->is_premium,
            "point" => $this->points,
            "link" => $this->link,
            "eBook" => $eBook ?? null,
            "save" => $this->users_count
        ];
    }
}
