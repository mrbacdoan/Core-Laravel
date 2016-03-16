<?php


namespace App\Http\ViewComposers;

use Illuminate\Contracts\View\View;
use Illuminate\Contracts\Auth\Guard as Auth;

class AdminSidebarComposer extends ViewComposer
{
    protected $auth;

    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    public function compose(View $view)
    {
        $view->with([
            '_user' => $this->auth->user(),
        ]);
    }
}