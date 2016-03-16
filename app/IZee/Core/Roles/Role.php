<?php

/**
 * Created by Hoangnham
 * Date: 10/5/2015 3:59 PM
 */
namespace App\IZee\Core\Roles;

use App\IZee\Groups\GroupRepositoryInterface;
use Auth;
use Lang;

use Cache;

class Role implements RoleInterface
{
    protected $admin;
    protected $group;
    protected $allRoutes = [];
    protected $allRoles = [];
    protected $allowRoles = [];
    protected $allowRoutes = [];
    protected $timeCache = 10;
    protected $_cache = false;

    public function __construct()
    {
        $this->group = app(GroupRepositoryInterface::class);
        $this->all();
    }

    private function all()
    {
        $allPermissions = config('permissions', []);
        if (!empty($allPermissions) && is_array($allPermissions)) {
            foreach ($allPermissions as $key1 => $val) {
                foreach ($val as $key2 => $val2) {
                    array_push($this->allRoles, $key1 . '.' . $key2);
                    foreach ($val2 as $val3) {
                        if (empty($this->allRoutes[$val3])) {
                            $this->allRoutes[$val3] = [$key1 . '.' . $key2];
                        } else {
                            $this->allRoutes[$val3][] = $key1 . '.' . $key2;
                        }
                    }
                }
            }
        }
        $user = Auth::user();
        $group = $this->group->getById($user->id);
        if (!Auth::check() || empty($user) || $user->group_id < 1) {
            return false;
        }
        $this->allowRoles = json_decode($group->permissions, true);
        $this->allowRoles = is_array($this->allowRoles) ? $this->allowRoles : [];
    }

    public function apiAllowPermissions()
    {
        $routers = [];
        foreach($this->allowRoutes as $key => $val){
            if(preg_match('/^api./', $val)){
                $routers[] = substr($val, 4);
            }
        }
        return $routers;
    }
    public function allRoutes()
    {
        return $this->allRoutes;
    }

    public function apiGroups(){
        $allPermissions = config('permissions', []);
        $permissions = [];
        if (!empty($allPermissions) && is_array($allPermissions)) {
            foreach ($allPermissions as $key1 => $val) {
                $permissions[$key1] = [
                    'title'       => trans('permissions.' . $key1 . '.title'),
                    'permissions' => [],
                ];
                foreach ($val as $key2 => $val2) {
                    $permissions[$key1]['permissions'][$key1 . '.' . $key2] = Lang::has('permissions.' . $key1 . '.' . $key2) ?  trans('permissions.' . $key1 . '.' . $key2) : trans('permissions._global.' . $key2);
                }
            }
        }
        return $permissions;
    }

    public function checkRole($role)
    {
        return array_key_exists($role, $this->allowRoles);
    }

    public function hasRole($role)
    {
        if (!$this->checkRole($role)) {
            abort(403);
        }
    }

    public function checkRouteAccess($route)
    {
        $group = $this->group->getById(Auth::id());
        $allowRoles = $group->permissions;
        $allowRoles = json_decode($allowRoles, true);
        $route = str_replace('backend.', '', $route);
        return (array_key_exists($route, $this->allRoutes) && in_array($route, $allowRoles));
    }

    public function hashRouteAccess($route)
    {
        if (!$this->checkRouteAccess($route)) {
            abort(403);
        }
    }
}