<?php

namespace App\IZee\Categories;


use Illuminate\Http\Request;

class Search
{

    protected $repository;

    public function __construct(CategoryRepositoryInterface $repository, Request $request)
    {
        $this->repository = $repository;
        $this->request = $request;
    }

    private function getFilter($filters = [])
    {
        $search = $this->request->input('search');
        if (!empty($search) && is_string($search)) {
            $filters[0] = ['type' => WHERE_OR_GROUP, 'value' => true];
            $filters[0]['data'] = [
                ['type' => WHERE_OR, 'column' => 'name', 'value' => '%' . $search . '%', 'operator' => 'LIKE']
            ];
        }
        $orderBy = getSortBy(['id', 'title', 'public_at']);
        $parameters = ['per_page' => getPerPage(), 'search' => $search];
        if (!empty($orderBy)) {
            $parameters['sort'] = $orderBy['column'];
            $parameters['order_by'] = $orderBy['value'];
            $filters[] = $orderBy;
        }
        return $filters;
    }

    public function getCategories(){
        return $this->repository->getAllWithPaginate($this->getFilter(), NUM_PER_PAGE, ['id', 'parent_id', 'name', 'slug', 'status', 'created_at']);
    }
}