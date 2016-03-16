<?php

namespace App\IZee\Users;


interface ProfileListener
{

    public function profileSuccessful($result = []);

    public function profileFailed($error);

}