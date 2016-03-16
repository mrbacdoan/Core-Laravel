<?php
namespace App\Http\Controllers\API\Admin;

use App\IZee\Dashboards\Dashboard;

class DashboardController extends AdminController
{

    protected $dashboard;

    public function __construct(Dashboard $dashboard){
        $this->dashboard = $dashboard;
    }

    public function index()
    {
        return $this->respond($this->dashboard->data());
    }
}