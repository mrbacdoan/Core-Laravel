<?php

namespace App\IZee\Groups;

use App\IZee\Transformers\GroupTransformers;
use Illuminate\Http\Request;
use Fractal;

class Search
{

    protected $repository;

    public function __construct(GroupRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function getData(Request $request){
        $filters = [];
        $search = $request->input('search');
        if($request->has('search') &&!empty($search)){
            array_push($filters, ['column' => 'name', 'operator' => 'LIKE', 'value' => '%' .$search. '%']);
        }
        $groups = $this->repository->getAllWithPaginate($filters, NUM_PER_PAGE, ['id', 'name', 'permissions', 'created_at']);
        return compact('groups');
    }
}