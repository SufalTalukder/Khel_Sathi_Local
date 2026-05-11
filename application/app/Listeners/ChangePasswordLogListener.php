<?php

namespace App\Listeners;

use App\Events\ChangePasswordLog;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class ChangePasswordLogListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\ChangePasswordLog  $event
     * @return void
     */
    public function handle(ChangePasswordLog $event)
    {


        DB::table('change_password_log')->insert([
            "type" => $event->type,
            "user_id" => $event->user_id,
            "email" => $event->email,
            "password" => $event->password,

        ]);
    }
}
