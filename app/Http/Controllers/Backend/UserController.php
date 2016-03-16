<?php


namespace App\Http\Controllers\Backend;

use App\IZee\Users\Deleter;
use App\IZee\Users\DeleterListener;
use App\IZee\Users\User;
use App\IZee\Users\UserFormRequest;
use App\IZee\Users\UserRepository;
use App\IZee\Users\Creator;
use App\IZee\Users\CreatorListener;
use App\IZee\Users\Search;
use App\IZee\Users\UpdateListener;
use App\IZee\Users\Updater;
use Session;

class UserController extends BackendController implements CreatorListener, UpdateListener, DeleterListener
{
    protected $admin, $profile, $search, $updater, $creator, $deleter;

    public function __construct(Creator $creator, Search $search, Updater $updater, Deleter $deleter)
    {
        parent::__construct();
        $this->admin = app(UserRepository::class);
        $this->creator = $creator;
        $this->search = $search;
        $this->updater = $updater;
        $this->deleter = $deleter;
    }

    public function index(Search $search)
    {
        $users = $search->getUsers();
        return view('backend.users.index', ['users' => $users]);
    }

    public function create()
    {
        $groups = $this->creator->dataCreate();
        return view('backend.users.create', $groups);
    }

    public function store(UserFormRequest $request)
    {
        return $this->creator->accountCreate($request, $this);
    }

    public function createSuccessful($result)
    {
        Session::flash('success', $result);
        return redirect()->route('backend.users.index');
    }

    public function creationFailed($error)
    {
        Session::flash('error', $error);
        return redirect()->back();
    }

    public function show($user)
    {
        return $this->respond($this->search->getDetail($user));
    }

    public function edit(User $user)
    {
        $data = $this->updater->dataEdit($user);
        return view('backend.users.edit', $data);
    }

    public function update(User $user, UserFormRequest $request)
    {
        return $this->updater->accountUpdate($user, $request, $this);
    }

    public function updateSuccessful($result)
    {
        Session::flash('success', $result);
        return redirect()->back();
    }

    public function updateFailed($error)
    {
        Session::flash('success', $error);
        return redirect()->back();
    }

    public function delete(User $user)
    {
        return $this->deleter->delete($user, $this);
    }

    public function deleteSuccessful($result)
    {
        Session::flash('success', $result);
        return redirect()->back();
    }

    public function deleteFailed($error)
    {
        Session::flash('error', $error);
        return redirect()->back();
    }
}