<?php


namespace App\Http\Controllers\API\Admin;

use App\IZee\Users\User;
use App\IZee\Users\UserFormRequest;
use App\IZee\Users\UserRepository;
use App\IZee\Users\Creator;
use App\IZee\Users\CreatorListener;
use App\IZee\Users\Accounts\AccountFormRequest;
use App\IZee\Users\Search;
use App\IZee\Users\UpdateListener;
use App\IZee\Users\Updater;

class UserController extends AdminController implements CreatorListener, UpdateListener
{
    protected $admin, $profile, $search, $updater;

    public function __construct(Creator $creator, Search $search, Updater $updater)
    {
        parent::__construct();
        $this->admin = app(UserRepository::class);
        $this->creator = $creator;
        $this->search = $search;
        $this->updater = $updater;
    }

    public function index(Search $search)
    {
        return $this->respond($search->getUsers());
    }

    public function create()
    {
        return $this->respond($this->creator->dataCreate());
    }

    public function store(UserFormRequest $request)
    {
        return $this->creator->accountCreate($request, $this);
    }

    public function createSuccessful($result)
    {
        return $this->respond($result);
    }

    public function creationFailed($error)
    {
        return $this->respond($error);
    }

    public function show($user)
    {
        return $this->respond($this->search->getDetail($user));
    }

    public function edit(User $user)
    {
        return $this->respond($this->updater->dataEdit($user));
    }

    public function update(User $user, UserFormRequest $request)
    {
        return $this->updater->accountUpdate($user, $request, $this);
    }

    public function updateSuccessful($result)
    {
        return $this->respond($result);
    }

    public function updateFailed($error)
    {
        return $this->respond($error);
    }
}