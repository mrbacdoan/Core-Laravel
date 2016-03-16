<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Contracts\Auth\Guard as Auth;
use App\Http\Controllers\Controller;

class BackendController extends Controller
{
    protected $logged;
    public function __construct()
    {
        parent::__construct();
        $this->logged = app(Auth::class);
    }
}