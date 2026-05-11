<?php

namespace App\Listeners;

use App\Events\StatusChangeLog;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class StatusChangeLogFired
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
     * @param  \App\Events\StatusChangeLog  $event
     * @return void
     */
    public function handle(StatusChangeLog $event)
    {
       if(isset(Auth::guard('admin')->user()->id)){
        $id=Auth::guard('admin')->user()->id;
       }
       elseif(isset(Auth::guard('direct_recruitment')->user()->user_id)){
        $id=Auth::guard('direct_recruitment')->user()->user_id;
       }
       else{
        $id=Auth::id();
       }
    //    dd($event->user_id);
        DB::table('status_change_log_detail')->insert([
            "form_id" => $event->form_id,
            "user_id" => $event->user_id,
            "remark" => $event->remark,
            "master_table_id" => $event->master_table_id,
            "new_status" => $event->new_status,
            "action_by" => $id,
            // "ip_address" => request()->ip(),
            // "user_agent" => request()->userAgent()
        ]);
    }
}
