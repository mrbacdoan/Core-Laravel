<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use App\IZee\Users\Accounts\LoginFormRequest;
use Illuminate\Cache\RateLimiter;
use Cache;

class AuthController extends Controller
{
    use AuthenticatesAndRegistersUsers, ThrottlesLogins;
    protected $maxLoginAttempts = 5;
    protected $lockoutTime = 600;
    protected $loginUsername = 'email';

    public function __construct()
    {
        parent::__construct();
        $this->middleware('guest', ['except' => 'logout']);
    }

    /**
     * Get login view
     * @return \View
     */
    public function getLogin()
    {
        if ($this->auth->check()) {
            return redirect($this->redirectPath());
        }
        return view('admin.accounts.login', ['title' => trans('admin/title.login.title')]);
    }

    /**
     * Get logout
     * @return \Redirect
     */
    public function logout()
    {
        $this->auth->logout();
        return redirect($this->loginPath());
    }

    /**
     * Authentication login admin
     *
     * @param  LoginFormRequest $request
     *
     * @return \Redirect
     */
    public function authenticate(LoginFormRequest $request)
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

        if ($this->auth->attempt([$this->loginUsername => $username, 'password' => $request->input('password')], $request->has('remember'))) {
            $this->clearLoginAttempts($request);
            return redirect()->intended($this->redirectPath());
        }
        $this->incrementLoginAttempts($request);

        $countLoginFails = $this->getLoginAttempts($request) - 1;
        return back()->withInput()->with([
            'error' => trans('auth.failed',
                array('count'            => $countLoginFails,
                      'maxLoginAttempts' => $this->maxLoginAttempts,
                      'minute'           => $this->lockoutTime / 60)),
        ]);
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function loginUsername()
    {
        return $this->loginUsername;
    }

    /**
     * Get the path to the login route.
     *
     * @return string
     */
    public function loginPath()
    {
        return route('admin.login');
    }

    /**
     * Get the path to the login route.
     *
     * @return string
     */
    public function redirectPath()
    {
        return route('admin.dashboard.index');
    }

    /**
     * Get the needed authorization credentials from the request.
     *
     * @param  LoginFormRequest $request
     *
     * @return array
     */

    protected function getLoginAttempts($request)
    {
        return Cache::get($request->input($this->loginUsername()) . $request->ip(), 1);
    }

    protected function sendLockoutResponse(LoginFormRequest $request)
    {
        $seconds = app(RateLimiter::class)->availableIn(
            $request->input($this->loginUsername()) . $request->ip()
        );

        return redirect($this->loginPath())->withInput()->withError($this->getLockoutErrorMessage($seconds));
    }
}
