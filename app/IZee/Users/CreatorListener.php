<?php

namespace App\IZee\Users;


interface CreatorListener
{

    /**
     * @param array $result
     * @return mixed
     */
    public function createSuccessful($result);

    /**
     * @param string|array $error
     * @return mixed
     */
    public function creationFailed($error);

}