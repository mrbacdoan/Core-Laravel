<?php
/**
 * Created by Hoang Nham.
 * Email: hoangnham01@gmail.com
 */

namespace App\Http\Controllers\API\Admin;


use App\IZee\Configs\ConfigFormRequest;
use App\IZee\Configs\Updater;
use App\IZee\Configs\UpdaterListener;

class ConfigController extends AdminController implements UpdaterListener
{

    public function __construct(Updater $updater)
    {
        $this->updater = $updater;
    }

    public function index(){

        return $this->respond($this->updater->getData());
    }

    public function update(ConfigFormRequest $request){
        return $this->updater->updateConfig($request, $this);
    }

    public function updaterSuccessful($result = array())
    {
        return $this->respond($result);
    }

    public function updaterFailed($error)
    {
        return $this->respond($error);
    }
}