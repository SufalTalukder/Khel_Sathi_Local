<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ChangePasswordLog
{
    use Dispatchable, InteractsWithSockets, SerializesModels;



    public $type;
    public $user_id;

    public $email;
    public $password;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($type, $user_id,$email, $password )
    {


        $this->type = $type;
        $this->user_id = $user_id;
        $this->email = $email;
        $this->password = $password;
       

    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */

}
