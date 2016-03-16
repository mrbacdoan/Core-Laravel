<?php

namespace App\IZee\Categories;

use App\Exceptions\TransactionException;

class Deleter
{

    protected $repository;
    protected $logged;

    public function __construct(CategoryRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param \App\IZee\Categories\Category $category
     * @param \App\IZee\Categories\DeleterListener $listener
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Category $category, DeleterListener $listener){
        $this->repository->beginTransaction();
        try {
            $category->delete();
            return $listener->deleteSuccessful();
        } catch (TransactionException $e) {
            $this->repository->rollBack();
            izWriteLog($e);
            return $listener->deleteFailed(['code' => DELETED_FAILED, 'msg' => trans('messages.delete_failed')]);
        }
    }
}