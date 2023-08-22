<?php

namespace App\Observers;

use App\Models\Fcmtokenkey;
use App\Models\message;
use Illuminate\Support\Facades\Http;

class MessageObserver
{
    /**
     * Handle the message "created" event.
     *
     * @param  \App\Models\message  $message
     * @return void
     */
    public function created(message $message)
    {
        $url = 'https://fcm.googleapis.com/fcm/send';
        $serverKey = config('app.firebase.server_key');

        $fcm_user_key = Fcmtokenkey::all();

        foreach ($fcm_user_key as $key){

            $notificaions = [
                'title' => $message->title,
                'body' => $message->description,
                'badge' => 1,
            ];

            Http::withHeaders([
                'Authorization' => "key={$serverKey}",
                'Content-Type' => "application/json"
            ])->post($url, [
                'to' => $key->token,
                'notification' => $notificaions,
            ]);
        }

    }

    /**
     * Handle the message "updated" event.
     *
     * @param  \App\Models\message  $message
     * @return void
     */
    public function updated(message $message)
    {
        //
    }

    /**
     * Handle the message "deleted" event.
     *
     * @param  \App\Models\message  $message
     * @return void
     */
    public function deleted(message $message)
    {
        //
    }

    /**
     * Handle the message "restored" event.
     *
     * @param  \App\Models\message  $message
     * @return void
     */
    public function restored(message $message)
    {
        //
    }

    /**
     * Handle the message "force deleted" event.
     *
     * @param  \App\Models\message  $message
     * @return void
     */
    public function forceDeleted(message $message)
    {
        //
    }
}
