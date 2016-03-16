<?php

namespace App\Http\Controllers\Backend;

class DashboardController extends BackendController
{
    public function getIndex()
    {
        return view('backend.dashboard.index', ['title' => 'Dashboard']);
    }
}