<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 10/12/2015
 * Time: 18:36 PM
 */

namespace App\Http\Controllers\API\Admin;

use App\IZee\Groups\Creator;
use App\IZee\Groups\CreatorListener;
use App\IZee\Groups\Deleter;
use App\IZee\Groups\GroupFormRequest;
use App\IZee\Groups\Search;
use App\IZee\Groups\Updater;
use App\IZee\Groups\UpdaterListener;
use Illuminate\Http\Request;

class GroupController extends AdminController implements CreatorListener, UpdaterListener
{
    protected $search, $creator, $updater, $deleter;

    public function __construct(Search $search, Creator $creator, Updater $updater, Deleter $deleter)
    {
        parent::__construct();
        $this->search = $search;
        $this->creator = $creator;
        $this->updater = $updater;
        $this->deleter = $deleter;
    }

    public function index(Request $request)
    {
        return $this->respond($this->search->getData($request));
    }

    public function create()
    {
        return $this->respond($this->creator->dataCreate());
    }

    public function store(GroupFormRequest $request)
    {
        return $this->creator->groupCreate($request, $this);
    }

    public function edit($group)
    {
        return $this->respond($this->updater->dataEdit($group));
    }

    public function update(GroupFormRequest $request, $group)
    {
        return $this->updater->groupUpdate($request, $this, $group);
    }
    public function createSuccessful($result = array())
    {

        $result['code'] = empty($result['code']) ? CREATED_SUCCESS :$result['code'];
        $result['msg'] =empty($result['msg']) ?trans('message.create_success') :$result['msg'];
        return $this->respond($result);
    }

    public function creationFailed($error)
    {
        $error['code'] = empty($result['code']) ? CREATED_FAILED :$result['code'];
        $result['msg'] =empty($result['msg']) ?trans('message.create_failed') :$result['msg'];
        return $this->respond($error);
    }

    public function updaterSuccessful($result = array())
    {
        $result['code'] = empty($result['code']) ? UPDATED_SUCCESS :$result['code'];
        $result['msg'] =empty($result['msg']) ?trans('message.update_success') :$result['msg'];
        return $this->respond($result);
    }

    public function updaterFailed($error)
    {
        $error['code'] = empty($result['code']) ? UPDATED_FAILED :$result['code'];
        $result['msg'] =empty($result['msg']) ?trans('message.update_failed') :$result['msg'];
        return $this->respond($error);
    }

    public function deleteSuccessful()
    {
        $result['code'] = empty($result['code']) ? DELETED_SUCCESS :$result['code'];
        $result['msg'] =empty($result['msg']) ?trans('message.delete_success') :$result['msg'];
        return $this->respond($result);
    }
}