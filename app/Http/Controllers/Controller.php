<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use DB;
use Log;
use Exception;

abstract class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Keep track logged user
     */
    protected $logged;

    public function __construct()
    {

    }

    protected function beginTransaction()
    {
        DB::beginTransaction();
    }

    protected function commit()
    {
        DB::commit();
    }

    protected function rollBack()
    {
        DB::rollBack();
    }

    public function __log(Exception $e)
    {
        Log::error('__Exception:', [
            'file'    => $e->getFile(),
            'line'    => $e->getLine(),
            'code'    => $e->getCode(),
            'message' => $e->getMessage(),
        ]);
    }
}
