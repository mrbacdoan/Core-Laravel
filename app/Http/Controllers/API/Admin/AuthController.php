<?php
/**
 * Created by Hoangnham
 * Date: 10/8/2015 11:28 PM
 */

namespace App\Http\Controllers\API\Admin;


use App\IZee\Admins\Accounts\LoginFormRequest;
use Illuminate\Cache\RateLimiter;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Cache;

class AuthController extends AdminController
{
    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    protected $maxLoginAttempts = 5;
    protected $lockoutTime = 600;
    protected $loginUsername = 'email';

    public function __construct()
    {
        parent::__construct();

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
            return $this->sendLockoutResponse($request);
        }
        $token = $this->logged->attempt([$this->loginUsername => $username, 'password' => $request->input('password')]);
        if (!empty($token)) {
            $this->clearLoginAttempts($request);
            return $this->loginSuccess($this->logged->user(), $token);
        }
        $this->incrementLoginAttempts($request);

        $countLoginFails = $this->getLoginAttempts($request) - 1;
        return response()->json(['code' => AJAX_FAILED, 'msg' => trans('auth.failed', array('count' => $countLoginFails, 'maxLoginAttempts' => $this->maxLoginAttempts, 'minute' => $this->lockoutTime / 60))]);
    }

    protected function loginSuccess($user, $token)
    {
        if ($user->status == USER_STATUS_BAN) {
            return response()->json(['code' => AJAX_FAILED, 'msg' => trans('messages.users.ban')]);
        }
        if ($user->status != USER_ACTIVATED) {
            return response()->json(['code' => AJAX_FAILED, 'msg' => trans('messages.users.deactivated')]);
        }
        return response()->json(['code' => AJAX_SUCCESS, 'data' => $user], 200, ['Authorization' => $token]);
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function loginUsername()
    {
        return 'email_or_username';
    }

    protected function getLoginAttempts(LoginFormRequest $request)
    {
        return Cache::get($request->input($this->loginUsername()) . $request->ip(), 1);
    }

    protected function sendLockoutResponse(LoginFormRequest $request)
    {
        $seconds = app(RateLimiter::class)->availableIn(
            $request->input($this->loginUsername()) . $request->ip()
        );
        return response()->json(['code' => AJAX_FAILED, 'msg' => $this->getLockoutErrorMessage($seconds) . $request->input($this->loginUsername()) . $request->ip()]);
    }
}