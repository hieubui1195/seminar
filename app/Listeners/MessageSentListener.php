<?php

namespace App\Listeners;

use App\Events\MessageSentEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class MessageSentListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  MesseageSentEvent  $event
     * @return void
     */
    public function handle(MessageSentEvent $event)
    {
        // dd($event);
    }
}
