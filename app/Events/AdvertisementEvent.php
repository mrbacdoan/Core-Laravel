<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;

class AdvertisementEvent extends Event
{
    use SerializesModels;

    private $advertisement;

    public function __construct($advertisement)
    {
        $this->advertisement = $advertisement;
    }

    public function getAdvertisement(){
        return $this->advertisement;
    }
}
