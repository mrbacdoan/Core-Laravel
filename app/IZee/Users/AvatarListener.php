<?php

namespace App\IZee\Users;


interface AvatarListener
{

    /**
     * @param array $result
     * @return mixed
     */
    public function uploadAvatarSuccessful($result);

    /**
     * @param string|array $error
     * @return mixed
     */
    public function uploadAvatarFailed($error);

}