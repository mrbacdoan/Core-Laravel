<?php


namespace App\Http\Controllers\API\Admin;

use App\IZee\PhotoAlbums\Deleter;
use App\IZee\PhotoAlbums\DeleterListener;
use App\IZee\PhotoAlbums\Updater;
use App\IZee\PhotoAlbums\UpdaterListener;
use App\IZee\PhotoAlbums\Creator;
use App\IZee\PhotoAlbums\CreatorListener;
use App\IZee\PhotoAlbums\PhotoAlbumFormRequest;
use App\IZee\PhotoAlbums\Search;

class PhotoAlbumController extends AdminController implements CreatorListener, DeleterListener, UpdaterListener
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
        return $this->respondIndex($this->search->getPhotoAlbumListsBackend());
    }

    public function create()
    {
        return $this->respond($this->creator->dataCreate());
    }

    public function store(PhotoAlbumFormRequest $request)
    {
        return $this->creator->photoAlbumCreate($request, $this);
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
        return $this->respond($this->search->getAlbumDetailBackend($id));
    }
    /**
     * @param $photoAlbum
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit($photoAlbum)
    {
        return $this->respond($this->updater->dataEdit($photoAlbum));
    }

    /**
     * @param PhotoAlbumFormRequest $request
     * @param $heritage
     * @return mixed
     */
    public function update(PhotoAlbumFormRequest $request, $heritage)
    {
        return $this->updater->photoAlbumUpdate($request, $this, $heritage);
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
     * Xóa slider
     * @param $slider
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($slider)
    {
        return $this->deleter->destroy($slider, $this);
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