<?php
namespace App\Http\Controllers\Backend;

use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use App\IZee\Users\Accounts\LoginFormRequest;
use App\IZee\Users\Accounts\ProfileFormRequest;
use App\IZee\Users\Accounts\ChangePasswordFormRequest;
use App\IZee\Users\UserRepository;
use App\IZee\Users\Avatar;
use App\IZee\Users\AvatarListener;
use App\IZee\Users\Profile;
use App\IZee\Users\ProfileListener;
use App\IZee\Users\ChangePassword;
use App\IZee\Users\ChangePasswordListener;
use Auth;
use Cache;
use Session;

class AccountController extends BackendController implements AvatarListener, ProfileListener, ChangePasswordListener
{
    use AuthenticatesAndRegistersUsers,ThrottlesLogins;
    protected $maxLoginAttempts = 5, $lockoutTime = 600, $loginUsername = 'email', $userRepository, $avatar, $profile;

    public function __construct(UserRepository $userRepository, Avatar $avatar, Profile $profile, ChangePassword $changePassword)
    {
        parent::__construct();
        $this->userRepository = $userRepository;
        $this->avatar = $avatar;
        $this->profile = $profile;
        $this->changePassword = $changePassword;
    }

    public function getLogin()
    {
        if (Auth::check()) {
            return redirect($this->redirectPath());
        }
        return view('backend.accounts.login', ['title' => 'Đăng nhập']);
    }

    public function postLogin(LoginFormRequest $request)
    {
        $username = $request->input('email_or_username');
        if (filter_var($username, FILTER_VALIDATE_EMAIL)) {
            $this->loginUsername = 'email';
        } else {
            $this->loginUsername = 'username';
        }
        // Throttles login
        if ($this->hasTooManyLoginAttempts($request)) {
            $seconds = $this->sendLockoutResponse($request);

            Session::flash('warning', $this->getLockoutErrorMessage($seconds));
            return redirect()->back()
                ->withInput($request->only($this->loginUsername(), 'remember'));
        }

        if (Auth::attempt([$this->loginUsername => $username, 'password' => $request->input('password')], $request->has('remember'))) {
            $this->clearLoginAttempts($request);
            Session::flash('success', trans('auth.login_success'));
            return redirect()->intended($this->redirectPath());
        }
        $this->incrementLoginAttempts($request);

        $countLoginFails = $this->getLoginAttempts($request) - 1;
        Session::flash('error', trans('auth.failed', array('count' => $countLoginFails,
                  'maxLoginAttempts' => $this->maxLoginAttempts,
                  'minute'           => $this->lockoutTime / 60)));
        return back()->withInput();
    }

    public function getLogout()
    {
        $this->logged->logout();
        Session::flash('success', trans('auth.logout_success'));
        return view('backend.accounts.login', ['title' => 'Đăng nhập']);
    }

    public function loginUsername()
    {
        return $this->loginUsername;
    }

    public function redirectPath()
    {
        return route('backend.dashboard.index');
    }

    protected function getLoginAttempts(LoginFormRequest $request)
    {
        return Cache::get($request->input($this->loginUsername()) . $request->ip(), 1);
    }

    public function getProfile()
    {
        $data = $this->profile->getProfile();
        return view('backend.accounts.profile', $data);
    }

    public function updateProfile(ProfileFormRequest $request)
    {
        return $this->profile->updateProfile($request, $this);
    }

    public function profileSuccessful($result = []){
        Session::flash('success', $result);
        return redirect()->back();
    }

    public function profileFailed($error){
        Session::flash('error', $error);
        return redirect()->back();
    }

    public function changeAvatar()
    {
        return $this->avatar->uploadAvatar($this);
    }

    public function uploadAvatarSuccessful($result)
    {
        return response()->json(['code' => UPDATED_SUCCESS, 'data' => $result]);
    }

    public function uploadAvatarFailed($error)
    {
        return response()->json(['code' => UPDATED_FAILED, 'msg' => $error]);
    }

    public function changePassword(ChangePasswordFormRequest $request)
    {
        return $this->changePassword->changePassword($request, $this);
    }

    public function passwordOldInValid($message)
    {
        Session::flash('error', $message);
        Session::flash('tabChangPassword', true);
        return redirect()->back();
    }

    public function changePasswordFailed($error)
    {
        Session::flash('error', $error);
        return redirect()->back();
    }

    public function changePasswordSuccessful($success)
    {
        Session::flash('success', $success);
        return redirect()->back();
    }
}