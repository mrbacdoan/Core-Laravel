<?php


namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\API\ApiController;
use App\IZee\Core\Roles\RoleInterface;
use IZeeAPIAdmin;

class SidebarController extends ApiController
{
    private $role;

    public function __construct(RoleInterface $role)
    {
        $this->role = $role;
    }

    public function index()
    {
        $sidebars = [];
        $data = config('sidebar', []);
        $permissions = $this->role->apiAllowPermissions();
        $allRoutes = $this->role->allRoutes();
        if(is_array($data)){
            foreach($data as $val){
                if(!empty($val['submenu']) && is_array($val['submenu'])){
                    $tmp = [];
                    foreach($val['submenu'] as $item){
                        if(1 || isset($item['sref']) && (!array_key_exists('api.' .$item['sref'], $allRoutes) || in_array($item['sref'], $permissions))){
                            array_push($tmp, $item);
                        }
                    }
                    if(!empty($tmp)){
                        $val['submenu'] = $tmp;
                        array_push($sidebars, $val);
                    }
                }else{
                    if(1 || isset($val['sref']) && (!array_key_exists('api.' .$val['sref'], $allRoutes) || in_array($val['sref'], $permissions))){
                        array_push($sidebars, $val);
                    }
                }
            }
        }
        $allPermissions = [];
        $allRoutes = $this->role->allRoutes();
        foreach($allRoutes as $key => $val){
            if(preg_match('/^api./', $key)){
                $allPermissions[substr($key, 4)] = substr($key, 4);
            }
        }
        return $this->respond(['data' => $sidebars, 'permissions' => $permissions, 'allPermission' => $allPermissions, 'user' => IZeeAPIAdmin::user()]);
    }
}