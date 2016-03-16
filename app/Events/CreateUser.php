<?php

namespace App\Events;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class CreateUser extends Event
{
    use SerializesModels;

    private $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

    public function getUser(){
        return $this->user;
    }

}
