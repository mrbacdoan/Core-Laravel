<?php
/**
 * Created by Hoangnham
 * Date: 9/30/2015 3:11 PM
 */

namespace App\Listeners;

use Cache;

class GroupEventListener
{
    public function onGroupCreate($event)
    {

    }

    public function onGroupUpdate($event)
    {
        Cache::forget(CORE_CACHE_GROUP . $event->id);
        Cache::forget(CORE_CACHE_ROLE . $event->id);
    }

    public function onGroupDelete($event)
    {
        Cache::forget(CORE_CACHE_GROUP . $event->id);
        Cache::forget(CORE_CACHE_ROLE . $event->id);
    }

    public function subscribe($events)
    {
        $events->listen(
            'groups.create',
            'App\Listeners\GroupEventListener@onGroupCreate'
        );
        $events->listen(
            'groups.update',
            'App\Listeners\GroupEventListener@onGroupUpdate'
        );
        $events->listen(
            'groups.delete',
            'App\Listeners\GroupEventListener@onGroupDelete'
        );
    }
}