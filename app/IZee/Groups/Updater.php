<?php

namespace App\IZee\Groups;


use App\Exceptions\TransactionException;
use App\IZee\Core\Roles\RoleInterface;
use App\IZee\Transformers\GroupItemTransformers;
use Fractal;

class Updater
{

    protected $repository;

    public function __construct(GroupRepositoryInterface $repository, RoleInterface $roleInterface)
    {
        $this->repository = $repository;
        $this->roles = $roleInterface;
    }

    public function dataEdit(Group $group)
    {
        $group = Fractal::item($group, new GroupItemTransformers())->getArray();
        return [
            'permissions' => $this->roles->apiGroups(),
            'group' => $group,
            'code' => 200
        ];
    }

     /**
     * @param \App\IZee\Groups\GroupFormRequest $request
     * @param \App\IZee\Groups\UpdaterListener $listener
     * @param \App\IZee\Groups\Group       $group
     * @return \Illuminate\Http\JsonResponse
     */
    public function groupUpdate(GroupFormRequest $request, UpdaterListener $listener, Group $group)
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
            $data['permissions'] = json_encode($data['permissions']);
            $this->repository->update($data, ['column' => 'id', 'value' => $group->id]);
            $this->repository->commit();
            return $listener->updaterSuccessful(trans('messages.update_success'));
        } catch (TransactionException $e) {
            $this->repository->rollBack();
            izWriteLog($e);
            return $listener->updaterFailed(trans('messages.update_failed'));
        }
    }
}