<?php


namespace App\IZee\Users;

use App\Exceptions\TransactionException;
use App\IZee\Users\Accounts\ChangePasswordFormRequest;
use Auth;

class ChangePassword
{

    private $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function changePassword(ChangePasswordFormRequest $request, ChangePasswordListener $listener)
    {
        db(Auth::user());
        // kiem tra xem password cu co dung khong
        if (!$this->repository->checkPassword($request->input('old_password'), Auth::user()->password)) {
            return $listener->passwordOldInValid(trans('messages.users.password_old_invalid'));
        }
        // neu dung thi update
        if($this->repository->update(['password' => bcrypt($request->input('new_password'))], ['column' => 'id', 'value' => Auth::id()]))
        {
            return $listener->changePasswordSuccessful(trans('messages.update_success'));
        }
        // bao loi
        return $listener->changePasswordFailed(['msg'=>trans('messages.update_failed')]);
    }

}