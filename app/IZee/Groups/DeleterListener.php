<?php

namespace App\IZee\Groups;


interface DeleterListener
{

    /**
     * @return mixed
     */
    public function deleteSuccessful();

    /**
     * @param string|array $error
     * @return mixed
     */
    public function deleteFailed($error);
}