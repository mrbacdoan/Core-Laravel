<?php

namespace App\IZee\Users;

use App\Exceptions\TransactionException;
use DB;

class Deleter
{

    protected $repository;
    protected $logged;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param \App\IZee\Users\User $user
     * @param \App\IZee\Users\DeleterListener $listener
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(User $user, DeleterListener $listener){
        $this->repository->beginTransaction();
        try {
            $user->delete();
            $this->repository->commit();
            return $listener->deleteSuccessful(trans('messages.delete_success'));
        } catch (TransactionException $e) {
            $this->repository->rollBack();
            izWriteLog($e);
            return $listener->deleteFailed(trans('messages.delete_failed'));
        }
    }
}