<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class StatusChangeLog
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $form_id;
    public $user_id;
    public $master_table_id;
    public $remark;

    public $new_status;


    


    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($form_id,$user_id,$remark,$new_status,$master_table_id)
    {
        $this->form_id = $form_id;
        $this->user_id = $user_id;
        $this->master_table_id = $master_table_id;
        $this->remark = $remark;
        $this->new_status = $new_status;
 
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    // public function broadcastOn()
    // {
    //     return new PrivateChannel('channel-name');
    // }
}
