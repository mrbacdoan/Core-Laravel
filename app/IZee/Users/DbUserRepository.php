<?php
/**
 * Created by Hoangnham
 * Date: 9/28/2015 3:23 PM
 */

namespace App\IZee\Users;

use App\IZee\Core\BaseRepository;
use Hash;

class DbUserRepository extends BaseRepository implements UserRepository
{
    public function __construct(User $user)
    {
        $this->model = $user;
    }

    /**
     * Get items with filter & paginate
     *
     * @param  array $filters
     * @param        $pageSize
     * @param  array $columns
     *
     * @return \Illuminate\Support\Collection Model collections
     */
    public function getAllWithPaginate($filters = [], $pageSize = NUM_PER_PAGE, $columns = ['*'])
    {
        $model = $this->model;
        $model = $model->leftJoin('groups', 'users.group_id', '=', 'groups.id');
        $this->filters($model, $filters);
        return $model->paginate($pageSize, $columns);
    }

    public function getByEmail($email)
    {
        return $this->model
            ->leftJoin('groups', 'groups.id', '=', 'users.group_id')
            ->where('email', $email)
            ->first(['users.*', 'groups.name as group_name']);
    }

    public function getByUsername($username)
    {
        return $this->model
            ->leftJoin('groups', 'groups.id', '=', 'users.group_id')
            ->where('username', $username)
            ->first(['users.*', 'groups.name as group_name']);
    }

    public function checkPassword($password, $passwordOld = null)
    {
        return !empty($password) && Hash::check($password, $passwordOld);
    }

    public function apiCheck(array $credentials)
    {
        return $this->model
            ->leftJoin('groups', 'groups.id', '=', 'users.group_id')
            ->where($credentials)
            ->first(['users.*', 'groups.name as group_name', 'permissions']);
    }

    public function apiAttempt(array $credentials)
    {
        $password = $credentials['password'];
        unset($credentials['password']);
        $user = $this->model
            ->leftJoin('groups', 'groups.id', '=', 'users.group_id')
            ->where($credentials)
            ->first(['users.*', 'groups.name as group_name', 'permissions']);
        if (!empty($user)) {
            if (!$this->checkPassword($password, $user->password)) {
                return null;
            }
        }
        return $user;
    }

    public function getDetailById($id)
    {
        return $this->model
            ->leftJoin('groups', 'groups.id', '=', 'users.group_id')
            ->where('users.id', $id)
            ->first(['users.*', 'groups.name as group_name', 'permissions']);
    }

}