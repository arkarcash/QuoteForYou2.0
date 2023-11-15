<?php

namespace App\Jobs;

use App\Http\Controllers\AdsController;
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

    protected $title;
    protected $message;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($title,$message)
    {
        $this->title = $title;
        $this->message = $message;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        AdsController::sendPushNotification($this->title,$this->message);
    }
}
