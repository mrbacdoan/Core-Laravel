<?php


namespace App\Http\Controllers\Backend;

use App\IZee\Categories\Category;
use App\IZee\Categories\CategoryFormRequest;
use App\IZee\Categories\CategoryRepositoryInterface;
use App\IZee\Categories\Creator;
use App\IZee\Categories\CreatorListener;
use App\IZee\Categories\Updater;
use App\IZee\Categories\UpdaterListener;
use App\IZee\Categories\Search;
use Session;

class CategoryController extends BackendController implements CreatorListener, UpdaterListener
{
    protected $search, $updater, $creator, $deleter;

    public function __construct(Creator $creator, Updater $updater, Search $search)
    {
        parent::__construct();
        $this->category = app(CategoryRepositoryInterface::class);
        $this->creator = $creator;
        $this->updater = $updater;
        $this->search = $search;
    }

    public function index(Search $search)
    {
        $categories = $search->getCategories();
        return view('backend.categories.index', compact('categories'));
    }

    public function create()
    {
        $categories = $this->creator->dataCreate();
        return view('backend.categories.create', $categories);
    }

    public function store(CategoryFormRequest $request)
    {
        return $this->creator->categoryCreate($request, $this);
    }

    public function createSuccessful($result = [])
    {
        Session::flash('success', $result);
        return redirect()->route('backend.categories.index');
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

    public function edit(Category $category)
    {
        return view('backend.categories.edit', $this->updater->dataEdit($category));
    }

    public function update(Category $category, CategoryFormRequest $request)
    {
        return $this->updater->categoryUpdate($category, $request, $this);
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