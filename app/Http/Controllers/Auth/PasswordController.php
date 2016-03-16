<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\IZee\Users\Accounts\ForgotPasswordFormRequest;
use App\IZee\Users\Accounts\ResetPasswordFormRequest;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Password;
use Illuminate\Http\Request;
use Illuminate\Mail\Message;
use DB;

class PasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Create a new password controller instance.
     */
    public function __construct()
    {
        parent::__construct();
        $this->middleware('guest');
    }

    public function getForgot()
    {
        return view('admin.accounts.forgot-password', ['title' => trans('admin/title.forgot-password.title'), 'alert' => session('alert')]);
    }

    public function postForgot(ForgotPasswordFormRequest $request)
    {
        $response = Password::sendResetLink($request->only('email'), function (Message $message) {
            $message->subject(trans('mail.subject.forgot_password'));
        });
        switch ($response) {
            case Password::RESET_LINK_SENT:
                return redirect()->back()->with(['success' => trans($response), 'message' => trans($response), 'alert' => 'alert-success']);
                break;
            case Password::INVALID_USER:
                return redirect()->back()->withInput()->with(['error' => trans($response), 'message' => trans($response), 'alert' => 'alert-danger']);
                break;
        }
    }

    public function getReset(Request $request)
    {
        $data = $request->only(['email', 'token']);
        if (empty($data['email']) || empty($data['token'])) {
            abort(404);
        } else {
            $token = DB::table('password_resets')->where('email', $data['email'])->where('token', $data['token'])->where('created_at', '>', date('Y-m-d H:i:s', (time() - (config('auth.password.expire', 60) * 60))))->count();
            if (!$token) {
                abort(404);
            }
        }
        $data['title'] = trans('admin/title.reset-password.title');
        return view('admin.accounts.reset-password', $data);
    }

    public function postReset(ResetPasswordFormRequest $request)
    {
        $credentials = $request->only(['email', 'token', 'password_confirmation']);
        $credentials['password'] = $request->input('new_password');

        $response = Password::reset($credentials, function ($user, $password) {
            $user->password = bcrypt($password);
            $user->save();
            $this->auth->login($user);
        });
        switch ($response) {
            case Password::PASSWORD_RESET:
                return redirect()->route('home')->with(['success' => trans($response)]);
            default:
                return redirect()->back()
                    ->withInput()
                    ->withErrors(['error' => trans($response)]);
        }
    }
}
