<?php

namespace App\IZee\Users;


interface UpdateListener
{

    /**
     * @param array $result
     * @return mixed
     */
    public function updateSuccessful($result);

    /**
     * @param string|array $error
     * @return mixed
     */
    public function updateFailed($error);

}