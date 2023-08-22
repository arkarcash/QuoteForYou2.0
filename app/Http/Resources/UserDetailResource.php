<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserDetailResource extends JsonResource
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
            "id" => $this->id,
            "name" => $this->name,
            "email" => $this->email,
            'current_point' => $this->points,
            'photo' => asset('Ranks/'.$this->photo),
            'ranks' => [
                [
                    'rank_name' => 'Newbie',
                    'need_point' => 0,
                    'is_arrived' => true,
                    'require_point' => 0,
                    'certificate' =>  null,
                    'percentage' => 100
                ],
                [
                    'rank_name' => 'Contributor',
                    'need_point' => 500,
                    'is_arrived' => $this->points >= 500,
                    'require_point' => $this->points >= 500 ? 0 : 500 - $this->points,
                    'certificate' => $this->certificate->contributor != null ? asset('storage/certificates/'.$this->certificate->contributor) : null,
                    'percentage' => $this->points == 0 ? 0 :  ($this->points / 500 ) * 100
                ],
                [
                    'rank_name' => 'Rising Star',
                    'need_point' => 1500,
                    'is_arrived' => $this->points >= 1500,
                    'require_point' => $this->points >= 1500 ? 0 : 1500 - $this->points,
                    'certificate' => $this->certificate->rising_star != null ? asset('storage/certificates/'.$this->certificate->rising_star) : null,
                    'percentage' => $this->points == 0 ? 0 :  ($this->points / 1500 ) * 100
                ],
                [
                    'rank_name' => 'Guru',
                    'need_point' => 3000,
                    'is_arrived' => $this->points >= 3000,
                    'require_point' => $this->points >= 3000 ? 0 : 3000 - $this->points,
                    'certificate' => $this->certificate->guru != null ? asset('storage/certificates/'.$this->certificate->guru) : null,
                    'percentage' => $this->points == 0 ? 0 :  ($this->points / 3000 ) * 100
                ],
                [
                    'rank_name' => 'Mentor',
                    'need_point' => 6000,
                    'is_arrived' => $this->points >= 6000,
                    'require_point' => $this->points >= 6000 ? 0 : 6000 - $this->points,
                    'certificate' => $this->certificate->mentor != null ? asset('storage/certificates/'.$this->certificate->mentor) : null,
                    'percentage' => $this->points == 0 ? 0 :  ($this->points / 6000 ) * 100
                ],
                [
                    'rank_name' => 'Mystery',
                    'need_point' => 10000,
                    'is_arrived' => $this->points >= 10000,
                    'require_point' => $this->points >= 10000 ? 0 : 10000 - $this->points,
                    'certificate' => $this->certificate->mystery != null ? asset('storage/certificates/'.$this->certificate->mystery) : null,
                    'percentage' => $this->points == 0 ? 0 :  ($this->points / 10000 ) * 100
                ],
                [
                    'rank_name' => 'Creator',
                    'need_point' => 20000,
                    'is_arrived' => $this->points >= 20000,
                    'require_point' => $this->points >= 20000 ? 0 : 20000 - $this->points,
                    'certificate' => $this->certificate->creator != null ? asset('storage/certificates/'.$this->certificate->creator) : null,
                    'percentage' => $this->points == 0 ? 0 :  ($this->points / 20000 ) * 100
                ],
                [
                    'rank_name' => 'Specialist',
                    'need_point' => 40000,
                    'is_arrived' => $this->points >= 40000,
                    'require_point' => $this->points >= 40000 ? 0 : 40000 - $this->points,
                    'certificate' => $this->certificate->specialist != null ? asset('storage/certificates/'.$this->certificate->specialist) : null,
                    'percentage' => $this->points == 0 ? 0 :  ($this->points / 40000 ) * 100

                ],
                [
                    'rank_name' => 'Collaborator',
                    'need_point' => 80000,
                    'is_arrived' => $this->points >= 80000,
                    'require_point' => $this->points >= 80000 ? 0 : 80000 - $this->points,
                    'certificate' => $this->certificate->collaborator != null ? asset('storage/certificates/'.$this->certificate->collaborator) : null,
                    'percentage' => $this->points == 0 ? 0 :  ($this->points / 80000 ) * 100
                ],
                [
                    'rank_name' => 'Authority',
                    'need_point' => 120000,
                    'is_arrived' => $this->points >= 120000,
                    'require_point' => $this->points >= 120000 ? 0 : 120000 - $this->points,
                    'certificate' => $this->certificate->authority != null ? asset('storage/certificates/'.$this->certificate->authority) : null,
                    'percentage' => $this->points == 0 ? 0 :  ($this->points / 120000 ) * 100
                ],
                [
                    'rank_name' => 'Legend',
                    'need_point' => 200000,
                    'is_arrived' => $this->points >= 200000,
                    'require_point' => $this->points >= 200000 ? 0 : 200000 - $this->points,
                    'certificate' => $this->certificate->legend != null ? asset('storage/certificates/'.$this->certificate->legend) : null,
                    'percentage' => $this->points == 0 ? 0 :  ($this->points / 200000 ) * 100

                ],
            ]

        ];
    }
}
