<?php

namespace App\IZee\Groups;


use Illuminate\Database\Eloquent\Model;

interface GroupRepositoryInterface
{

    /**
     * @param array $filters
     * @param array $column
     * @return mixed
     */
    public function getAll($filters = array(), $column = array('*'));
    /**
     * @param array $filters
     * @param array $column
     *
     * @return \Illuminate\Support\Collection Model collections
     */
    public function getFirst($filters = array(), $column = array('*'));

    /**
     * Get item of model. If model not exist then it will throw an exception
     *
     * @param array $columns
     * @param  int  $id Model ID
     *
     * @return \Illuminate\Database\Eloquent\Model;
     */
    public function find($id, $columns = array('*'));

    /**
     * Get item of model
     *
     * @param array $columns
     * @param  int  $id Model ID
     *
     * @return \Illuminate\Database\Eloquent\Model;
     */
    public function getById($id, $columns = array('*'));
    /**
     * Get items with filter & paginate
     *
     * @param  array   $filters
     * @param  array   $columns
     * @param  integer $pageSize
     *
     * @return \Illuminate\Support\Collection Model collections
     */
    /**
     * Get items with filter & paginate
     *
     * @param  array $filters
     * @param        $pageSize
     * @param  array $columns
     *
     * @return \Illuminate\Support\Collection Model collections
     */
    public function getAllWithPaginate($filters = [], $pageSize = NUM_PER_PAGE, $columns = ['*']);

    /**
     * Create a new model
     *
     * @param  array $attributes
     *
     * @return Model
     */
    public function create($attributes);

    /**
     * Update an exitst model
     *
     * @param  array $attributes
     * @param  array $conditions
     *
     * @return bool|int
     * @throws \Exception
     */
    public function update($attributes, $conditions = []);

    /**
     * Delete an exist model
     *
     * @param array $condition
     *
     * @return bool|null
     * @throws \Exception
     */
    public function delete($condition);

    /**
     * @param array  $conditions
     * @param string $column
     *
     * @return mixed
     */
    public function count($conditions = array(), $column = 'id');

    /**
     * Increment a column's value by a given amount.
     *
     * @param  array  $conditions
     * @param  string $column
     * @param  int    $amount
     * @param  array  $extra
     *
     * @return int
     */
    public function increment($conditions = array(), $column, $amount = 1, array $extra = []);

    /**
     * Decrement a column's value by a given amount.
     *
     * @param  array  $conditions
     * @param  string $column
     * @param  int    $amount
     * @param  array  $extra
     *
     * @return int
     */
    public function decrement($conditions = array(), $column, $amount = 1, array $extra = []);

    /**
     * @return mixed
     */
    function beginTransaction();

    /**
     * @return mixed
     */
    function commit();

    /**
     * @return mixed
     */
    function rollBack();

    public function transform(&$group);
}
