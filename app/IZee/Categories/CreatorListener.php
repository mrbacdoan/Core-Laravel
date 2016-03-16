<?php

namespace App\IZee\Categories;


interface CreatorListener
{

    /**
     * @param array $result
     * @return mixed
     */
    public function createSuccessful($result = array());

    /**
     * @param string|array $error
     * @return mixed
     */
    public function creationFailed($error);
}