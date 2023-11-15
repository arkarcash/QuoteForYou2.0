<?php

namespace App\Observers;

use App\Jobs\NotificationSend;
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

        NotificationSend::dispatch($message);

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
