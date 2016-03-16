<?php
/**
 * Created by Hoangnham
 * Date: 10/5/2015 4:06 PM
 */

namespace App\IZee\Core\Roles;

use Illuminate\Support\Facades\Facade;

class RoleFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'IZeeRole';
    }
}