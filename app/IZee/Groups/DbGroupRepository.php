<?php

namespace App\IZee\Groups;

use App\IZee\Core\BaseRepository;
use DB;

class DbGroupRepository extends BaseRepository implements GroupRepositoryInterface
{

    public function __construct(Group $group){
        $this->model = $group;
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
    public function getAllWithPaginate($filters = [], $pageSize = NUM_PER_PAGE,
                                       $columns = [''])
    {
        $columns[] = DB::raw('(SELECT COUNT(`users`.`id`) FROM `users` WHERE `users`.`group_id` = `groups`.`id`) as users');
        $model = $this->model;
        $this->filters($model, $filters);
        return $model->paginate($pageSize, $columns);
    }

    /**
     * Create a new model
     *
     * @param  array $attributes
     *
     * @return static
     */
    public function create($attributes)
    {
        if (isset($attributes['permissions']) && !is_string($attributes['permissions'])) {
            $attributes['permissions'] = json_encode($attributes['permissions']);
        }
        return $this->model->create($attributes);
    }

    /**
     * Update an exitst model
     *
     * @param  array $attributes
     * @param  array $conditions
     *
     * @return bool|int
     */
    public function update($attributes, $conditions = [])
    {
        if (isset($attributes['permissions']) && !is_string($attributes['permissions'])) {
            $attributes['permissions'] = json_encode($attributes['permissions']);
        }
        $model = $this->model;
        $this->filters($model, $conditions);
        return $model->update($attributes);
    }

    public function transform(&$group)
    {
        if (isset($group->permissions)) {
            $group->permissions = json_decode($group->permissions, true);
            $group->permissions = is_array($group->permissions) ? $group->permissions : [];
            return $group;
        }
        if (isset($group['permissions'])) {
            $group['permissions'] = json_decode($group['permissions']);
            $group['permissions'] = is_array($group['permissions']) ? $group['permissions'] : [];
            return $group;
        }
    }
}