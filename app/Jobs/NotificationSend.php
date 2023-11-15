<?php

namespace App\Jobs;

use App\Models\Fcmtokenkey;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class NotificationSend implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $message;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($message)
    {
        $this->message = $message;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $url = 'https://fcm.googleapis.com/fcm/send';
        $serverKey = config('app.firebase.server_key');

        $fcm_user_key = Fcmtokenkey::all();

        foreach ($fcm_user_key as $key){

            $notificaions = [
                'title' => $this->message->title,
                'body' => $this->message->description,
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
}
