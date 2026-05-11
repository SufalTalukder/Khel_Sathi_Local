<?php

namespace App\Listeners;

use App\Events\UserLoggedIn;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;

class UserLoggedInFired
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
     * @param  \App\Events\UserLoggedIn  $event
     * @return void
     */
    public function handle(UserLoggedIn $event)
    {
        // dd($event);
        DB::table('login_history')->insert([
            "uid" => $event->userId,
            "type" => $event->type,
            "user_type" => $event->user_type,
            "login_table" => $event->login_table,
            "ip_address" => request()->ip(),
            "user_agent" => request()->userAgent()
        ]);
    }
}
