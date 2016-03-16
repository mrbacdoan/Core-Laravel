<?php


namespace App\IZee\Users;

use App\Exceptions\TransactionException;
use App\IZee\Users\Accounts\ProfileFormRequest;
use Auth;

class Profile
{

    private $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getProfile()
    {
        $profile = $this->repository->getDetailById(Auth::id());
        return compact('profile');
    }

    public function updateProfile(ProfileFormRequest $request, ProfileListener $listener)
    {
        $data = $request->only(['full_name', 'phone', 'address', 'gender', 'birthday']);
        $this->repository->beginTransaction();
        try {
            $this->repository->update($data, ['column' => 'id', 'value' => Auth::id()]);
            $this->repository->commit();
            return $listener->profileSuccessful(trans('messages.update_success'));
        } catch (TransactionException $e) {
            izWriteLog($e);
            $this->repository->rollback();
        }
        return $listener->profileFailed(trans('messages.update_failed'));
    }
}