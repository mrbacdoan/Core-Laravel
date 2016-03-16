<?php

namespace App\IZee\Users;


use App\Exceptions\TransactionException;
use App\IZee\Groups\GroupRepositoryInterface;
use Hash;

class Creator
{

    protected $repository;
    protected $logged;

    public function __construct(UserRepository $repository, GroupRepositoryInterface $groupRepository)
    {
        $this->repository = $repository;
        $this->groupRepository = $groupRepository;
    }

    public function dataCreate()
    {
        $groups = array();
        $dataGroups = $this->groupRepository->getAll([], ['id', 'name'])->toArray();
        foreach($dataGroups as $group)
        {
            $groups = array($group['id']=>$group['name']) + $groups;
        }
        return compact('groups');
    }

    /**
     * @param \App\IZee\Users\UserFormRequest $request
     * @param \App\IZee\Users\CreatorListener $listener
     * @return \Illuminate\Http\JsonResponse
     */
    public function accountCreate(UserFormRequest $request, CreatorListener $listener)
    {
        $this->repository->beginTransaction();
        try {
            $data = $request->only(['username', 'email', 'full_name', 'phone', 'group_id', 'gender', 'status', 'password', 'birthday']);
            $data['status'] = STATUS_ACTIVATED;
            $data['password'] = bcrypt($data['password']);
            $data['group_id'] = empty($data['group_id']) ? 1 : $data['group_id'];
            $this->repository->create($data);
            $this->repository->commit();
            return $listener->createSuccessful(trans('messages.create_success'));
        } catch (TransactionException $e) {
            izWriteLog($e);
            $this->repository->rollBack();
            return $listener->creationFailed(trans('messages.create_failed'));
        }
    }
}