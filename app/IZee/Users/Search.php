<?php

namespace App\IZee\Users;


use App\IZee\Transformers\ShowUserTransformer;
use App\IZee\Transformers\UserTransformer;
use Fractal;
use Illuminate\Http\Request;

class Search
{

    protected $repository;
    protected $request;

    public function __construct(UserRepository $repository, Request $request)
    {
        $this->repository = $repository;
        $this->request = $request;
    }

    private function getFilter($filters = [])
    {
        $search = $this->request->input('search');
        $group = $this->request->input('group');
        if (!empty($search) && is_string($search)) {
            $filters[0] = ['type' => WHERE_OR_GROUP, 'value' => true];
            $filters[0]['data'] = [
                ['type' => WHERE_OR, 'column' => 'username', 'value' => '%' . $search . '%', 'operator' => 'LIKE'],
                ['type' => WHERE_OR, 'column' => 'full_name', 'value' => '%' . $search . '%', 'operator' => 'LIKE'],
                ['type' => WHERE_OR, 'column' => 'email', 'value' => '%' . $search . '%', 'operator' => 'LIKE']
            ];
        }
        if(!empty($group) && is_numeric($group)){
            $filters[] = ['type' => WHERE_AND, 'column' => 'group_id', 'operator'=> '=', 'value' => $group];
        }
        $orderBy = getSortBy(['id', 'title', 'public_at']);
        $parameters = ['per_page' => getPerPage(), 'search' => $search, 'group' => $group];
        if (!empty($orderBy)) {
            $parameters['sort'] = $orderBy['column'];
            $parameters['order_by'] = $orderBy['value'];
            $filters[] = $orderBy;
        }
        return $filters;
    }

    public function getUsers()
    {
        return $this->repository->getAllWithPaginate($this->getFilter(), NUM_PER_PAGE, ['users.id', 'users.avatar', 'users.username', 'users.full_name', 'users.email', 'users.phone', 'users.birthday', 'users.status', 'users.created_at', 'groups.name as group_name']);
    }

    public function getDetail($user)
    {
        return ['user' => Fractal::item($this->repository->getDetailById($user->id), new ShowUserTransformer())->getArray(), 'x' => \IZeeAPIUser::user()];
    }

}