<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\API\ApiController;
use App\IZee\Core\API\Interfaces\Admin;


class AdminController extends ApiController
{
    /**
     * Keep track logged user
     */
    protected $logged, $creator, $updater, $deleter;
    public function __construct()
    {
        parent::__construct();
        $this->logged = app(Admin::class);
    }

    public function respondIndex($data, $headers = [])
    {
        if (!empty($data) && is_array($data) && empty($data['status_code'])) {
            $data = array_merge(array('status_code' => $this->getStatusCode()), $data);
            $data['code'] = AJAX_SUCCESS;
        }
        $data['lang'] = empty($data['lang']) ? config('languages', []) : $data['lang'];
        return response()->json($data, $this->getStatuscode(), $headers);
    }
}