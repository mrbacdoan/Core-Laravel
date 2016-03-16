<?php

namespace App\IZee\Users;


interface DeleterListener
{

    /**
     * @param string|array $result
     * @return mixed
     */
    public function deleteSuccessful($result);

    /**
     * @param string|array $error
     * @return mixed
     */
    public function deleteFailed($error);
}