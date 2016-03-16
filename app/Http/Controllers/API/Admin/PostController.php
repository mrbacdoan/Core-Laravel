<?php


namespace App\Http\Controllers\API\Admin;

use App\IZee\Posts\Deleter;
use App\IZee\Posts\DeleterListener;
use App\IZee\Posts\Updater;
use App\IZee\Posts\UpdaterListener;
use App\IZee\Posts\Creator;
use App\IZee\Posts\CreatorListener;
use App\IZee\Posts\PostFormRequest;
use App\IZee\Posts\Search;

class PostController extends AdminController implements CreatorListener, DeleterListener, UpdaterListener
{
    protected $search, $creator, $updater, $deleter;

    public function __construct(Search $search, Creator $creator, Search $search, Deleter $deleter, Updater $updater)
    {
        parent::__construct();
        $this->search = $search;
        $this->creator = $creator;
        $this->deleter = $deleter;
        $this->updater = $updater;
    }

    public function index()
    {
        return $this->respondIndex($this->search->getPostListsBackend());
    }

    public function create()
    {
        return $this->respond($this->creator->dataCreate());
    }

    public function store(PostFormRequest $request)
    {
        return $this->creator->postCreate($request, $this);
    }

    public function createSuccessful($result = array())
    {
        return $this->respond($result);
    }

    public function creationFailed($error)
    {
        return $this->respond($error);
    }

    public function show($id){
        return $this->respond($this->search->getPostDetailBackend($id));
    }

    /**
     * @param $post
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit($post)
    {
        return $this->respond($this->updater->dataEdit($post));
    }

    /**
     * @param PostFormRequest $request
     * @param $heritage
     * @return mixed
     */
    public function update(PostFormRequest $request, $heritage)
    {
        return $this->updater->postUpdate($request, $this, $heritage);
    }

    public function updaterSuccessful($result = array())
    {
        return response()->json($result);
    }

    public function updaterFailed($error)
    {
        return response()->json($error);
    }

    /**
     * Xóa post
     * @param $post
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($post)
    {
        return $this->deleter->destroy($post, $this);
    }

    public function deleteSuccessful()
    {
        return $this->respond(['code' => DELETED_SUCCESS]);
    }

    public function deleteFailed($error)
    {
        return $this->respond(['code' => DELETED_FAILED]);
    }
}