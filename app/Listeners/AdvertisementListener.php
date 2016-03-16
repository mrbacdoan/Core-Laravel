<?php

namespace App\Listeners;

use Cache;

class AdvertisementListener
{
    public function onCreate($event)
    {
        forgotCache(CACHE_ADVERTISEMENT);
    }

    public function onUpdate($event)
    {
        forgotCache(CACHE_ADVERTISEMENT);
    }

    public function onDelete($event)
    {
        forgotCache(CACHE_ADVERTISEMENT);
    }

    public function subscribe($events)
    {
        $events->listen(
            'advertisements.create',
            'App\Listeners\AdvertisementListener@onCreate'
        );
        $events->listen(
            'advertisements.update',
            'App\Listeners\AdvertisementListener@onUpdate'
        );
        $events->listen(
            'advertisements.delete',
            'App\Listeners\AdvertisementListener@onDelete'
        );
    }
}
