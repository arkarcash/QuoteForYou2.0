<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NoteResource extends JsonResource
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
            'id'=> $this->id,
            'author_id' => $this->author_id,
            'author' => $this->author->name,
            'description' => $this->description,
            'is_poem' => $this->is_poem,
            'tags' => TagResource::collection($this->tags),
            'view' => $this->view,
            'saved' => $this->users_count ?? 0
        ];
    }
}
