<?php


namespace App\Http\Controllers\API\Admin;

use App\IZee\Admins\Accounts\ChangePasswordFormRequest;
use App\IZee\Admins\Accounts\ProfileFormRequest;
use App\IZee\Admins\AdminRepository;
use App\IZee\Admins\Profile;
use App\IZee\Admins\ProfileListener;

class AccountController extends AdminController implements ProfileListener
{
    protected $admin, $profile;

    public function __construct(Profile $profile)
    {
        parent::__construct();
        $this->admin = app(AdminRepository::class);
        $this->profile = $profile;
    }

    public function getProfile()
    {
        return $this->respond($this->profile->getProfile());
    }

    public function postProfile(ProfileFormRequest $request)
    {
        return $this->profile->postProfile($request, $this);
    }

    public function putChangePassword(ChangePasswordFormRequest $request)
    {
        if ($this->admin->checkPassword($request->input('pass_old'), $this->logged->user()->password)) {
            $this->admin->update(['password' => bcrypt($request->input('password'))], ['column' => 'id', 'value' => $this->logged->id()]);
            return response()->json(['code' => UPDATED_SUCCESS, 'msg' => trans('passwords.change_success')]);
        }
        return response()->json(['code' => UPDATED_FAILED, 'msg' => trans('passwords.old_failed')]);
    }

    public function getLogout()
    {
        $this->logged->logout();
        return response()->json(['code' => AJAX_SUCCESS], 204);
    }

    public function profileSuccessful($result = [])
    {
        return $this->respond($result);
    }

    public function profileFailed($error)
    {
        return $this->respond($error);
    }
}