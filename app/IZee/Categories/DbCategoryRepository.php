<?php

namespace App\IZee\Categories;


use App\IZee\Core\BaseRepository;

class DbCategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{

    public function __construct(Category $category){
        $this->model = $category;
    }
}