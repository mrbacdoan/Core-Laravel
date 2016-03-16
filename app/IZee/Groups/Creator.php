<?php

namespace App\IZee\Groups;

use App\Exceptions\TransactionException;
use App\IZee\Core\Roles\RoleInterface;

class Creator
{
    protected $repository;
    protected $logged;
    protected $roles;

    public function __construct(GroupRepositoryInterface $repository, RoleInterface $roleInterface)
    {
        $this->repository = $repository;
        $this->roles = $roleInterface;
    }

    public function dataCreate()
    {
        db($this->roles->apiGroups());
        return [
            'permissions' => $this->roles->apiGroups(),
            'code' => 200
        ];
    }

    /**
     * @param \App\IZee\Groups\GroupFormRequest $request
     * @param \App\IZee\Groups\CreatorListener $listener
     * @return \Illuminate\Http\JsonResponse
     */
    public function groupCreate(GroupFormRequest $request, CreatorListener $listener)
    {
        $this->repository->beginTransaction();
        try {
            $data = [
                'name' => $request->input('name'),
                'permissions' => []
            ];
            $permissions = $request->input('permissions');
            if(is_array($permissions)){
                foreach($permissions as $key=>$val){
                    if($val)
                    {
                        $data['permissions'][$key] = $key;
                    }
                }
            }
            db($data);
            $data['permissions'] = json_encode($data['permissions']);
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