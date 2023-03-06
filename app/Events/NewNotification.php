<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewNotification
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    //public $userId ;
    //public $userName;
    public $prodcutId;
    public $prodcutName;



    public function __construct($data=[])
    {
        //$this->userId = $data['userId'];
        //$this->userName = $data['userName'];
        $this->prodcutId=123;
        $this->prodcutName=$data['productName'];


    }

    public function broadcastOn()
    {
        return ['new-notify'];
    }



}
