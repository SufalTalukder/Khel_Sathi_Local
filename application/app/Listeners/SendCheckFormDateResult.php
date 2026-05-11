<?php

namespace App\Listeners;

use App\Events\CheckFormDate;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendCheckFormDateResult
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
     * @param  \App\Events\CheckFormDate  $event
     * @return void
     */
    public function handle(CheckFormDate $event)
    {
       
    }
}
