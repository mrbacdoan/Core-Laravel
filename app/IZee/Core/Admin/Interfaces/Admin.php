<?php

namespace App\IZee\Core\Admin\Interfaces;

use App\IZee\Users\UserRepository;

interface Admin
{
    /**
     * @return bool
     */
    public function check();

    /**
     * @return bool
     */
    public function guest();

    /**
     * @return UserRepository
     */
    public function user();

    /**
     * @return int
     */
    public function id();

    /**
     * @param array $credentials
     * @return bool|string
     */
    public function attempt(array $credentials = []);

    /**
     * @param \App\IZee\Users\UserRepository $user
     * @return string
     */
    public function login(UserRepository $user);

    /**
     * @param $id
     * @return string
     */
    public function loginUsingId($id);

    /**
     * @return string
     */
    public function userType();

    /**
     * @return mixed
     */
    public function logout();
}