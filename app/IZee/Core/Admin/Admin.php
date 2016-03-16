<?php

namespace App\IZee\Core\Admin;

use App\IZee\Users\UserRepository;
use App\IZee\Core\Admin\Interfaces\Admin as BaseAdmin;

class Admin implements BaseAdmin
{
    protected $_user;

    private $logged = null;
    const TOKEN_LENGTH = 80;

    public function __construct()
    {
        $this->_user = app(UserRepository::class);
        $this->__getUser();
    }

    /**
     * @return array|null
     */
    private function __getUser()
    {
        if ($this->logged === null) {
            $headers = getallheaders();
            $authorization = empty($headers['Authorization']) ? null : $headers['Authorization'];
            if(empty($authorization)){
                $headers = getAllHeadersTest();
                $authorization = empty($headers['Authorization']) ? null : $headers['Authorization'];
            }
            if (!empty($authorization) && is_string($authorization) && preg_match('/^Bearer /i', $authorization)) {
                $decode = json_decode(base64_decode(str_rot13(last(explode('.', $authorization)))));
                if (!empty($decode) && !empty($decode->x) && !empty($decode->y) && !empty($decode->key)) {
                    $token = substr($authorization, ((int)$decode->y + 7), self::TOKEN_LENGTH);
                    $userId = (int)base64_decode(str_rot13(substr($authorization, ((int)$decode->y + 7 + self::TOKEN_LENGTH), (int)$decode->x)));
                    if (!empty($token) && $userId > 0) {
                        $this->logged = $this->_user->apiCheck(['admins.id' => $userId, 'token' => $token]);
                        return $this->logged;
                    }
                }
            }
            return $this->logged = array();
        }
    }

    /**
     * @param $userId
     * @return string
     */
    protected function __setToken($userId)
    {
        $number = rand(50, 100);
        $token = str_random(self::TOKEN_LENGTH);
        $this->_user->update(['token' => $token], ['column' => 'id', 'value' => $userId]);
        $userId = str_rot13(base64_encode(($userId)));
        return 'Bearer ' . str_random($number) . $token . $userId . str_random(rand(50, 100)) . '.' . str_rot13(base64_encode(json_encode(['x' => strlen($userId), 'y' => $number, 'key' => str_random()])));
    }

    /**
     * @param UserRepository $user
     * @return UserRepository
     */
    protected function __transform(&$user){
        unset($user->group_id);
        if(isset($user->permissions)){
            if(is_string($user->permissions)){
                $permissions = json_decode($user->permissions, true);
                $user->permissions = is_array($permissions) ? array_keys($permissions) : [];
            }
        }else{
            unset($user->permissions);
        }
        return $user;
    }

    /**
     * @return bool
     */
    public function check()
    {
        return !empty($this->logged);
    }

    /**
     * @return bool
     */
    public function guest()
    {
        return empty($this->logged);
    }

    /**
     * @param $transform
     * @return UserRepository
     */
    public function user($transform = true)
    {
        return empty($this->logged) ? array() : ($transform ? $this->__transform($this->logged) : $this->logged);
    }

    /**
     * @return int
     */
    public function id()
    {
        return $this->check() ? $this->logged->id : 0;
    }

    /**
     * @param array $credentials
     * @return bool|string
     */
    public function attempt(array $credentials = [])
    {
        $this->logged = $this->_user->apiAttempt($credentials);
        if (!empty($this->logged)) {
            return $this->__setToken($this->logged->id);
        }
        return false;
    }

    /**
     * @param \App\IZee\Users\UserRepository $user
     * @return string
     */
    public function login(UserRepository $user)
    {
        $this->logged = $user;
        return $this->__setToken($user->id);
    }

    /**
     * @param $id
     * @return string
     */
    public function loginUsingId($id)
    {
        $this->logged = $this->_user->getById($id);
        if ($this->check()) {
            return $this->__setToken($id);
        }
    }

    /**
     * @return string
     */
    public function userType(){
        if($this->check()){
            return $this->user()->type;
        }
        return null;
    }

    /**
     *
     */
    public function logout()
    {
        if ($this->check()) {
            $this->_user->update(['token' => str_random(90)], ['column' => 'id', 'value' => $this->id()]);
        }
    }
}