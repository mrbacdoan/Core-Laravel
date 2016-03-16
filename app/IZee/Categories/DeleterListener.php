<?php

namespace App\IZee\Categories;


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