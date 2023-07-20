<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        switch ($this->status){
            case '0':
                $status = 'Pending';
                break;
            case '1':
                $status = 'Confirmed';
                break;
            case '2':
                $status = 'Delivered';
                break;
            case '3':
                $status = 'Completed';
                break;
            case '4':
                $status = 'Cancel';
                break;
            default:
                $status = 'ERROR';
                break;
        }
        return [
            'order_id' => $this->order_id,
            'order_data' => [
                'status' => $status,
                'total_price' => $this->OrderProducts->sum('sub_price') + $this->Fees,
                'quantity' => $this->order_product_count,
                'date' => $this->created_at->diffForHumans(),
            ],
        ];
    }
}
