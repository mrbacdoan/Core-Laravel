<?php


namespace App\IZee\Users;


use App\Exceptions\TransactionException;
use App\IZee\Users\Accounts\AccountFormRequest;
use App\IZee\Groups\GroupRepositoryInterface;

class Updater
{

    public function __construct(UserRepository $repository, GroupRepositoryInterface $groupRepository)
    {
        $this->repository = $repository;
        $this->groupRepository = $groupRepository;
    }

    public function dataEdit(User $user)
    {
        $groups = array();
        $dataGroups = $this->groupRepository->getAll([], ['id', 'name'])->toArray();
        foreach($dataGroups as $group)
        {
            $groups = array($group['id']=>$group['name']) + $groups;
        }
        return compact('groups', 'user');
    }

    /**
     * @param User $user
     * @param UserFormRequest $request
     * @param UpdateListener $listener
     * @return mixed
     */
    public function accountUpdate(User $user, UserFormRequest $request, UpdateListener $listener)
    {
        $this->repository->beginTransaction();
        try {
            $data = $request->only(['username', 'email','full_name', 'phone', 'group_id', 'status', 'password', 'gender', 'birthday']);
            if(empty($data['password']))
            {
                unset($data['password']);
            }
            else{
                $data['password'] = bcrypt($data['password']);
            }
            $this->repository->update($data, [['column' => 'id', 'value' => $user->id]]);
            $this->repository->commit();
            return $listener->updateSuccessful(trans('messages.update_success'));
        } catch (TransactionException $e) {
            izWriteLog($e);
            $this->repository->rollBack();
            return $listener->updateFailed(trans('messages.update_failed'));
        }
    }

}