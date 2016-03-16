<?php

namespace App\IZee\Groups;

use App\Exceptions\TransactionException;

class Deleter
{

    protected $repository;
    protected $logged;

    public function __construct(GroupRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param \App\IZee\Groups\Group $group
     * @param \App\IZee\Groups\DeleterListener $listener
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Group $group, DeleterListener $listener){
        $this->repository->beginTransaction();
        try {
            $group->delete();
            event('groups.delete', $group);
            return $listener->deleteSuccessful();
        } catch (TransactionException $e) {
            $this->repository->rollBack();
            izWriteLog($e);
            return $listener->deleteFailed(['code' => DELETED_FAILED, 'msg' => trans('messages.delete_failed')]);
        }
    }
}