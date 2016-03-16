<?php

function userStatus($status)
{
    if ($status == USER_ACTIVATED) {
        return '<span class="label label-info">' . trans('admin/table.users.activated') . '</span>';
    } elseif ($status == USER_DEACTIVATED) {
        return '<span class="label label-warning">' . trans('admin/table.users.deactivated') . '</span>';
    } elseif ($status == USER_STATUS_BAN) {
        return '<span class="label label-danger">' . trans('admin/table.users.ban') . '</span>';
    } else {
        return '';
    }
}

function izCacheDevice($uuid, $platform, $model)
{
    $cache = Cache::get('_device_' . $uuid . $platform . $model);
    if (!empty($cache) && is_object($cache)) {
        return $cache;
    }
    return null;
}

function izSetCacheDevice($uuid, $platform, $model, $value)
{
    if(!empty($value)){
        Cache::put('_device_' . $uuid . $platform . $model, $value, DEVICE_CACHE_TIME);
    }
}
function izClearCacheDevice($uuid, $platform, $model)
{
    Cache::forget('_device_' . $uuid . $platform . $model);
}

function getListProvinces(){
    $locations = Cache::get(PROVINCE_CACHE_ALL, function () {
        $provinces = App\IZee\Provinces\Province::orderBy('position', 'ASC')->orderBy('name', 'ASC')->get(['id', 'name'])->toArray();
        Cache::put(PROVINCE_CACHE_ALL, $provinces, 15);
        return $provinces;
    });
    if(empty($locations)){
        $provinces = App\IZee\Provinces\Province::orderBy('position', 'ASC')->orderBy('name', 'ASC')->get(['id', 'name'])->toArray();
        Cache::put(PROVINCE_CACHE_ALL, $provinces, 15);
        return $provinces;
    }
    return $locations;

}