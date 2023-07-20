<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        if($this->payment === null){
            $paymentPhoto = null;
        }else{
            $paymentPhoto = asset('storage/'.$this->payment->photo);
        }

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
            'delivery_name' => $this->name,
            'delivery_phone' => $this->phone,
            'shipping_address' => $this->address,
            'delivery_fees' =>  $this->township->fees ?? 0,
            'status' => $status,
            'user_payment_slip' => $this->payment_slip != null ? asset('storage/order_payment/'.$this->payment_slip) : "",
            'payment_name' => $this->payment->name ?? null,
            'payment_photo' => $paymentPhoto,
            'total_price' => $this->OrderProducts->sum('sub_price') + $this->Fees,
            'quantity' => $this->order_products_count,
            'date' => $this->created_at->format('d M Y'),
            'note' => $this->note,
            'products' => OrderProductResource::collection($this->OrderProducts),

        ];
    }
}
