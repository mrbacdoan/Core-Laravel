<?php


namespace App\Http\Controllers\Frontend;
use Illuminate\Contracts\Auth\Guard as Auth;
use App\Http\Controllers\Controller;

class FrontendController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->logged = app(Auth::class);
    }
}