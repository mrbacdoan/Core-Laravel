<?php

namespace App\IZee\Users;

use App\Exceptions\TransactionException;
use Illuminate\Http\Request;
use Auth;

class Avatar
{

    protected $repository;
    protected $logged;

    public function __construct(UserRepository $repository, Request $request)
    {
        $this->repository = $repository;
        $this->request= $request;
    }

    public function uploadAvatar(AvatarListener $listener)
    {
        $this->repository->beginTransaction();
        try {
            $img = $this->request->input('img');
            $img = str_replace('data:image/png;base64,', '', $img);
            $img = str_replace(' ', '+', $img);
            $avatarContent = base64_decode($img);
            $avatarPath = USER_AVATAR_PATH .date('Y').'/'.date('m').'/'. Auth::user()->username . '_' . time() . '.png';

            if (!file_exists(USER_AVATAR_PATH .date('Y').'/'.date('m'))) {
                mkdir(USER_AVATAR_PATH .date('Y').'/'.date('m'), 0777, true);
            }
            if(!empty(Auth::user()->avatar)){
                unlink(Auth::user()->avatar);
            }
            Auth::user()->update(['avatar' => $avatarPath]);
            $this->repository->update(['avatar' => $avatarPath], ['column' => 'id', 'value' => Auth::id()]);
            file_put_contents($avatarPath, $avatarContent);

            $this->repository->commit();
            return $listener->uploadAvatarSuccessful(['urlImage'=> $avatarPath,'msg'=>trans('messages.update_success')]);
        } catch (TransactionException $e) {
            izWriteLog($e);
            $this->repository->rollBack();
            return $listener->uploadAvatarFailed(trans('messages.update_failed'));
        }
    }
}