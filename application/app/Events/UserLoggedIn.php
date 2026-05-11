<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserLoggedIn
{
    use Dispatchable, InteractsWithSockets, SerializesModels;


    public $userId;
    public $type;
    public $user_type;

    public $login_table;



    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($userId,$type,$user_type,$login_table)
    {
        $this->userId = $userId;
        $this->type = $type;
        $this->user_type = $user_type;
        $this->login_table = $login_table;
 
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
