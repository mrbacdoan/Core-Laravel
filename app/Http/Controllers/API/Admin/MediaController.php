<?php


namespace App\Http\Controllers\API\Admin;

use App\IZee\Videos\Deleter;
use App\IZee\Videos\DeleterListener;
use App\IZee\Videos\Updater;
use App\IZee\Videos\UpdaterListener;
use App\IZee\Videos\Creator;
use App\IZee\Videos\CreatorListener;
use App\IZee\Videos\VideoFormRequest;
use App\IZee\Videos\Search;

class MediaController extends AdminController implements CreatorListener, DeleterListener, UpdaterListener
{
    protected $search, $updater, $creator, $deleter;

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
        return $this->respondIndex($this->search->getVideoListsBackend());
    }

    public function create()
    {
        return $this->respond($this->creator->dataCreate());
    }

    public function store(VideoFormRequest $request)
    {
        return $this->creator->videoCreate($request, $this);
    }

    public function createSuccessful($result = array())
    {
        return $this->respond($result);
    }

    public function creationFailed($error)
    {
        return $this->respond($error);
    }

    public function show($id)
    {
        return $this->respond($this->search->getVideoDetailBackend($id));
    }

    /**
     * @param $video
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit($video)
    {
        return $this->respond($this->updater->dataEdit($video));
    }

    /**
     * @param VideoFormRequest $request
     * @param $heritage
     * @return mixed
     */
    public function update(VideoFormRequest $request, $heritage)
    {
        return $this->updater->videoUpdate($request, $this, $heritage);
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
     * Xóa video
     * @param $video
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($video)
    {
        return $this->deleter->destroy($video, $this);
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