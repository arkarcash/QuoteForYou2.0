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
        $bgFrames = [
            '1.-QFY-CONTRIBUTOR-(FOR-APP).png',
            '2.-QFY-RISING-STAR-(FOR-APP).png',
            '3.-QFY-GURU-(FOR-APP).png',
            '4.-QFY-MENTOR-(FOR-APP).png',
            '5.-QFY-MYSTERY-(FOR-APP).png',
            '6.-QFY-(Creator)-(FOR-APP).png',
            '7.-QFY-(Specialist)-(FOR-APP).png',
            '8.-QFY-(Collaborator)-(FOR-APP).png',
            '9.-QFY-(Authority)-(FOR-APP).png',
            '10.-QFY-(Legend)-(FOR-APP).png'
        ];

        $bgFrames = [
            '0_newbie.png',
            '1_contributor.png',
            '2_rising_star.png',
            '3_mentor.png',
            '4_guru.png',
            '5_mystery.png',
            '6_Creator.png',
            '7_Specialist.png',
            '8_Collaborator.png',
            '9_Authority.png',
            '10_Legend.png'
        ];

        return [
            "id" => $this->id,
            "name" => $this->name,
            "email" => $this->email,
            'current_point' => $this->points,
            'photo' => asset('Ranks/'.$this->photo),
            'ranks' => [
                [
                    'rank_name' => 'Newbie',
                    'rank_photo' =>  asset('Ranks/'.$bgFrames[0]),
                    'need_point' => 0,
                    'is_arrived' => true,
                    'require_point' => 0,
                    'certificate' =>  null,
                    'percentage' => 100
                ],
                [
                    'rank_name' => 'Contributor',
                    'rank_photo' =>  asset('Ranks/'.$bgFrames[1]),
                    'need_point' => 500,
                    'is_arrived' => $this->points >= 500,
                    'require_point' => $this->points >= 500 ? 0 : 500 - $this->points,
                    'certificate' => $this->certificate->contributor != null ? asset('storage/certificates/'.$this->certificate->contributor) : asset('CertificateFrame/'.$bgFrames[0]),
                    'percentage' => $this->points == 0 ? 0 :  ($this->points / 500 ) * 100
                ],
                [
                    'rank_name' => 'Rising Star',
                    'rank_photo' =>  asset('Ranks/'.$bgFrames[2]),
                    'need_point' => 1500,
                    'is_arrived' => $this->points >= 1500,
                    'require_point' => $this->points >= 1500 ? 0 : 1500 - $this->points,
                    'certificate' => $this->certificate->rising_star != null ? asset('storage/certificates/'.$this->certificate->rising_star) : asset('CertificateFrame/'.$bgFrames[1]),
                    'percentage' => $this->points == 0 ? 0 :  ($this->points / 1500 ) * 100
                ],
                [
                    'rank_name' => 'Guru',
                    'rank_photo' =>  asset('Ranks/'.$bgFrames[3]),

                    'need_point' => 3000,
                    'is_arrived' => $this->points >= 3000,
                    'require_point' => $this->points >= 3000 ? 0 : 3000 - $this->points,
                    'certificate' => $this->certificate->guru != null ? asset('storage/certificates/'.$this->certificate->guru) : asset('CertificateFrame/'.$bgFrames[2]),
                    'percentage' => $this->points == 0 ? 0 :  ($this->points / 3000 ) * 100
                ],
                [
                    'rank_name' => 'Mentor',
                    'rank_photo' =>  asset('Ranks/'.$bgFrames[4]),

                    'need_point' => 6000,
                    'is_arrived' => $this->points >= 6000,
                    'require_point' => $this->points >= 6000 ? 0 : 6000 - $this->points,
                    'certificate' => $this->certificate->mentor != null ? asset('storage/certificates/'.$this->certificate->mentor) : asset('CertificateFrame/'.$bgFrames[3]),
                    'percentage' => $this->points == 0 ? 0 :  ($this->points / 6000 ) * 100
                ],
                [
                    'rank_name' => 'Mystery',
                    'rank_photo' =>  asset('Ranks/'.$bgFrames[5]),

                    'need_point' => 10000,
                    'is_arrived' => $this->points >= 10000,
                    'require_point' => $this->points >= 10000 ? 0 : 10000 - $this->points,
                    'certificate' => $this->certificate->mystery != null ? asset('storage/certificates/'.$this->certificate->mystery) : asset('CertificateFrame/'.$bgFrames[4]),
                    'percentage' => $this->points == 0 ? 0 :  ($this->points / 10000 ) * 100
                ],
                [
                    'rank_name' => 'Creator',
                    'rank_photo' =>  asset('Ranks/'.$bgFrames[6]),

                    'need_point' => 20000,
                    'is_arrived' => $this->points >= 20000,
                    'require_point' => $this->points >= 20000 ? 0 : 20000 - $this->points,
                    'certificate' => $this->certificate->creator != null ? asset('storage/certificates/'.$this->certificate->creator) : asset('CertificateFrame/'.$bgFrames[5]),
                    'percentage' => $this->points == 0 ? 0 :  ($this->points / 20000 ) * 100
                ],
                [
                    'rank_name' => 'Specialist',
                    'rank_photo' =>  asset('Ranks/'.$bgFrames[7]),

                    'need_point' => 40000,
                    'is_arrived' => $this->points >= 40000,
                    'require_point' => $this->points >= 40000 ? 0 : 40000 - $this->points,
                    'certificate' => $this->certificate->specialist != null ? asset('storage/certificates/'.$this->certificate->specialist) : asset('CertificateFrame/'.$bgFrames[6]),
                    'percentage' => $this->points == 0 ? 0 :  ($this->points / 40000 ) * 100

                ],
                [
                    'rank_name' => 'Collaborator',
                    'rank_photo' =>  asset('Ranks/'.$bgFrames[8]),

                    'need_point' => 80000,
                    'is_arrived' => $this->points >= 80000,
                    'require_point' => $this->points >= 80000 ? 0 : 80000 - $this->points,
                    'certificate' => $this->certificate->collaborator != null ? asset('storage/certificates/'.$this->certificate->collaborator) : asset('CertificateFrame/'.$bgFrames[7]),
                    'percentage' => $this->points == 0 ? 0 :  ($this->points / 80000 ) * 100
                ],
                [
                    'rank_name' => 'Authority',
                    'rank_photo' =>  asset('Ranks/'.$bgFrames[9]),

                    'need_point' => 120000,
                    'is_arrived' => $this->points >= 120000,
                    'require_point' => $this->points >= 120000 ? 0 : 120000 - $this->points,
                    'certificate' => $this->certificate->authority != null ? asset('storage/certificates/'.$this->certificate->authority) : asset('CertificateFrame/'.$bgFrames[8]),
                    'percentage' => $this->points == 0 ? 0 :  ($this->points / 120000 ) * 100
                ],
                [
                    'rank_name' => 'Legend',
                    'rank_photo' =>  asset('Ranks/'.$bgFrames[10]),

                    'need_point' => 200000,
                    'is_arrived' => $this->points >= 200000,
                    'require_point' => $this->points >= 200000 ? 0 : 200000 - $this->points,
                    'certificate' => $this->certificate->legend != null ? asset('storage/certificates/'.$this->certificate->legend) : asset('CertificateFrame/'.$bgFrames[9]),
                    'percentage' => $this->points == 0 ? 0 :  ($this->points / 200000 ) * 100

                ],
            ]

        ];
    }
}
