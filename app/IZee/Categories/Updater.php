<?php

namespace App\IZee\Categories;


use App\Exceptions\TransactionException;


class Updater
{

    protected $repository;

    public function __construct(CategoryRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function dataEdit(Category $category)
    {
        $categories = $this->repository->getAll([], ['id', 'parent_id', 'name']);
        return compact('category', 'categories');
    }

     /**
     * @param \App\IZee\Categories\CategoryFormRequest $request
     * @param \App\IZee\Categories\UpdaterListener $listener
     * @param \App\IZee\Categories\Category       $category
     * @return \Illuminate\Http\JsonResponse
     */
    public function categoryUpdate(Category $category, CategoryFormRequest $request, UpdaterListener $listener)
    {
        $this->repository->beginTransaction();
        try {
            $data = $request->only(['parent_id', 'name', 'slug', 'priority', 'status']);
            $this->repository->update($data, ['column' => 'id', 'value' => $category->id]);
            $this->repository->commit();
            return $listener->updaterSuccessful(trans('messages.update_success'));
        } catch (TransactionException $e) {
            $this->repository->rollBack();
            izWriteLog($e);
            return $listener->updaterFailed(trans('messages.update_failed'));
        }
    }
}