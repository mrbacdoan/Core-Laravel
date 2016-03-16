<?php

namespace App\IZee\Core;

use DB;
use Log;

/**
 * * An abstract class for repository.
 * Class BaseRepository
 * @package IZee\Core
 */
abstract class BaseRepository
{

    /**
     * var \Illuminate\Database\Eloquent\Model
     */
    protected $model;

    /**
     * @param array $filters
     * @param array $column
     *
     * @return \Illuminate\Support\Collection Model collections
     */
    public function getAll($filters = array(), $column = array('*'))
    {
        $model = $this->model;
        $this->filters($model, $filters);
        return $model->get($column);
    }

    /**
     * @param array $filters
     * @param array $column
     *
     * @return \Illuminate\Support\Collection Model collections
     */
    public function getFirst($filters = array(), $column = array('*'))
    {
        $model = $this->model;
        $this->filters($model, $filters);
        return $model->first($column);
    }

    /**
     * Get item of model. If model not exist then it will throw an exception
     *
     * @param array $columns
     * @param  int $id Model ID
     *
     * @return \Illuminate\Database\Eloquent\Model;
     */
    public function find($id, $columns = array('*'))
    {
        return $this->model->findOrFail($id, $columns);
    }

    /**
     * Get item of model
     *
     * @param array $columns
     * @param  int $id Model ID
     *
     * @return \Illuminate\Database\Eloquent\Model;
     */
    public function getById($id, $columns = array('*'))
    {
        return $this->model->find($id, $columns);
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
        $this->filters($model, $filters);
        return $model->paginate($pageSize, $columns);
    }

    public function getByConditions($filters = [], $columns = ['*'])
    {
        $model = $this->model;
        $this->filters($model, $filters);
        return $model->get($columns);
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
        $model = $this->model;
        $this->filters($model, $conditions);
        return $model->update($attributes);
    }

    /**
     * Delete an exist model
     *
     * @param array $condition
     *
     * @return bool|null
     * @throws \Exception
     */
    public function delete($condition)
    {
        $model = $this->model;
        $this->filters($model, $condition);
        return $model->delete();
    }

    /**
     * @param array $conditions
     * @param string $column
     *
     * @return mixed
     */
    public function count($conditions = array(), $column = 'id')
    {
        $model = $this->model;
        $this->filters($model, $conditions);
        return $model->count($column);
    }

    /**
     * Increment a column's value by a given amount.
     *
     * @param  array $conditions
     * @param  string $column
     * @param  int $amount
     * @param  array $extra
     *
     * @return int
     */
    public function increment($conditions = array(), $column, $amount = 1, array $extra = [])
    {
        $model = $this->model;
        $this->filters($model, $conditions);
        return $model->increment($column, $amount, $extra);
    }

    /**
     * Decrement a column's value by a given amount.
     *
     * @param  array $conditions
     * @param  string $column
     * @param  int $amount
     * @param  array $extra
     *
     * @return int
     */
    public function decrement($conditions = array(), $column, $amount = 1, array $extra = [])
    {
        $model = $this->model;
        $this->filters($model, $conditions);
        return $model->decrement($column, $amount, $extra);
    }

    /**
     * @param \Illuminate\Database\Eloquent\Model $model
     * @param null $filters
     *
     * @return \Illuminate\Support\Collection Model collections
     */
    protected function filters(&$model, $filters = null)
    {
        if (!empty($filters)) {
            if (isset($filters['value'])) {
                $operator = isset($filters['operator']) ? $filters['operator'] : '=';
                $boolean = isset($filters['boolean']) ? $filters['boolean'] : 'and';
                $not = isset($filters['not']) ? $filters['not'] : false;
                if (isset($filters['column'])) {
                    $column = $filters['column'];
                } else {
                    $column = 'id';
                }
                $value = $filters['value'];
                $bindings = empty($filters['bindings']) ? array() : $filters['bindings'];
                $type = empty($filters['type']) ? '' : $filters['type'];
                switch ($type) {
                    case WHERE_OR_GROUP:
                        $data = $filters['data'];
                        $model = $model->orWhere(function($query) use ($data){
                            foreach($data as $item)
                            {
                                $query->orWhere($item['column'], $item['operator'], $item['value']);
                            }
                        });
                        break;
                    case WHERE_AND:
                        $model = $model->where($column, $operator, $value, $boolean);
                        break;
                    case WHERE_OR:
                        $model = $model->orWhere($column, $operator, $value);
                        break;
                    case WHERE_IN:
                        $model = $model->whereIn($column, $value, $boolean, $not);
                        break;
                    case WHERE_NOT_IN:
                        $model = $model->whereNotIn($column, $value, $boolean);
                        break;
                    case OR_WHERE_IN:
                        $model = $model->orWhereIn($column, $value);
                        break;
                    case OR_WHERE_NOT_IN:
                        $model = $model->orWhereNotIn($column, $value);
                        break;
                    case WHERE_BETWEEN:
                        $model = $model->whereBetween($column, $value, $boolean, $not);
                        break;
                    case WHERE_NOT_BETWEEN:
                        $model = $model->whereNotBetween($column, $value, $boolean);
                        break;
                    case WHERE_NULL:
                        $model = $model->whereNull($column, $boolean, $not);
                        break;
                    case WHERE_DATE:
                        $model = $model->whereDate($column, $operator, $value, $boolean);
                        break;
                    case WHERE_DAY:
                        $model = $model->whereDay($column, $operator, $value, $boolean);
                        break;
                    case WHERE_MONTH:
                        $model = $model->whereMonth($column, $operator, $value, $boolean);
                        break;
                    case WHERE_YEAR:
                        $model = $model->whereYear($column, $operator, $value, $boolean);
                        break;
                    case WHERE_RAW:
                        $model = $model->whereRaw($value, $bindings, $boolean);
                        break;
                    case WHERE_RAW_OR:
                        $model = $model->orWhereRaw($value, $bindings);
                        break;
                    case ORDER_BY:
                        $value = strtoupper($value) == 'ASC' ? 'ASC' : 'DESC';
                        $model = $model->orderBy($column, $value);
                        break;
                    case GROUP_BY:
                        $model = $model->groupBy($column);
                        break;
                    case LIMIT:
                        $value = (int)$value < 1 ? 1 : (int)$value;
                        $model = $model->limit($value);
                        break;
                    case SKIP:
                        $value = (int)$value < 1 ? 0 : (int)$value;
                        $model = $model->skip($value);
                        break;
                    case TAKE:
                        $value = (int)$value < 01 ? 0 : (int)$value;
                        $model = $model->take($value);
                        break;
                    case MIN:
                        $model = $model->min($column);
                        break;
                    case MAX:
                        $model = $model->max($column);
                        break;
                    default:
                        $model = $model->where($column, $operator, $value, $boolean);
                        break;
                }
            } elseif (is_array($filters)) {
                foreach ($filters as $filter) {
                    $this->filters($model, $filter);
                }
            }
        }
        return $model;
    }

    function beginTransaction()
    {
        DB::beginTransaction();
    }

    function commit()
    {
        DB::commit();
    }

    function rollBack()
    {
        DB::rollBack();
    }

    function createMultiple($attributes)
    {
        $this->model->insert($attributes);
    }

    private function getNextAndPreviousId($baseConditions, $conditions)
    {
        if (!empty($conditions)) {
            array_push($baseConditions, $conditions);
        }
        $model = $this->model;
        $this->filters($model, $baseConditions);
        $result = $model->first(['id']);
        return !empty($result->id) ? $result->id : '';
    }

    /**
     * Get previous Id
     * @param $id
     * @param array $conditions
     * @return string|void
     */
    public function getPreviousId($id, array $conditions = [])
    {
        if ($id <= 1) {
            return;
        }
        $baseConditions = [
            ['type' => WHERE_AND, 'column' => 'id', 'value' => $id, 'operator' => '<'],
            ['type' => ORDER_BY, 'column' => 'id', 'value' => 'DESC']
        ];
        return $this->getNextAndPreviousId($baseConditions, $conditions);
    }

    /**
     * Get next id
     * @param $id
     * @param array $conditions
     * @return string|void
     */
    public function getNextId($id, array $conditions = [])
    {
        $baseConditions = [
            ['type' => WHERE_AND, 'column' => 'id', 'value' => $id, 'operator' => '>'],
            ['type' => ORDER_BY, 'column' => 'id', 'value' => 'ASC']
        ];
        return $this->getNextAndPreviousId($baseConditions, $conditions);
    }

}