<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 15/12/2015
 * Time: 10:58 AM
 */

namespace App\IZee\Core\Roles;

interface RoleInterface
{
    public function apiAllowPermissions();

    public function apiGroups();

    public function allRoutes();

    public function checkRole($role);

    public function hasRole($role);

    public function checkRouteAccess($route);

    public function hashRouteAccess($route);
}