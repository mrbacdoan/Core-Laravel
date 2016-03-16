<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 10/12/2015
 * Time: 18:36 PM
 */

namespace App\Http\Controllers\Backend;

use App\IZee\Groups\Creator;
use App\IZee\Groups\CreatorListener;
use App\IZee\Groups\Deleter;
use App\IZee\Groups\GroupFormRequest;
use App\IZee\Groups\Search;
use App\IZee\Groups\Updater;
use App\IZee\Groups\UpdaterListener;
use Illuminate\Http\Request;
use Session;

class GroupController extends BackendController implements CreatorListener, UpdaterListener
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
        return view('backend.groups.index', $this->search->getData($request));
    }

    public function create()
    {
        return view('backend.groups.create', $this->creator->dataCreate());
    }

    public function store(GroupFormRequest $request)
    {
        return $this->creator->groupCreate($request, $this);
    }

    public function createSuccessful($result = array())
    {
        Session::flash('success', $result);
        return redirect()->route('backend.groups.index');
    }

    public function creationFailed($error)
    {
        Session::flash('error', $error);
        return redirect()->route('backend.groups.index');
    }

    public function edit($group)
    {
        return view('backend.groups.edit', $this->updater->dataEdit($group));
    }

    public function update(GroupFormRequest $request, $group)
    {
        return $this->updater->groupUpdate($request, $this, $group);
    }

    public function updaterSuccessful($result = array())
    {
        Session::flash('success', $result);
        return redirect()->back();
    }

    public function updaterFailed($error)
    {
        Session::flash('error', $error);
        return redirect()->back();
    }

    public function deleteSuccessful()
    {
        $result['code'] = empty($result['code']) ? DELETED_SUCCESS :$result['code'];
        $result['msg'] =empty($result['msg']) ?trans('message.delete_success') :$result['msg'];
        return $this->respond($result);
    }
}