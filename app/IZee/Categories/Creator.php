<?php

namespace App\IZee\Categories;


use App\Exceptions\TransactionException;

class Creator
{

    protected $repository;
    protected $logged;

    public function __construct(CategoryRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function dataCreate()
    {
        $categories = $this->repository->getAll([], ['id', 'parent_id', 'name']);
        return compact('categories');
    }

    /**
     * @param \App\IZee\Categories\CategoryFormRequest $request
     * @param \App\IZee\Categories\CreatorListener $listener
     * @return \Illuminate\Http\JsonResponse
     */
    public function categoryCreate(CategoryFormRequest $request, CreatorListener $listener)
    {
        $this->repository->beginTransaction();
        try {
            $data = $request->only(['parent_id', 'name', 'slug', 'priority', 'status']);
            $this->repository->create($data);
            $this->repository->commit();
            return $listener->createSuccessful( trans('messages.create_success'));
        } catch (TransactionException $e) {
            izWriteLog($e);
            $this->repository->rollBack();
            return $listener->creationFailed(trans('messages.create_failed'));
        }
    }
}