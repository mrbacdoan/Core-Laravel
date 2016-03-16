<?php


namespace App\Http\Controllers\API\Admin;

use App\IZee\Heritages\Deleter;
use App\IZee\Heritages\DeleterListener;
use App\IZee\Heritages\Updater;
use App\IZee\Heritages\UpdaterListener;
use App\IZee\Heritages\Creator;
use App\IZee\Heritages\CreatorListener;
use App\IZee\Heritages\HeritageFormRequest;
use App\IZee\Heritages\Search;
use Illuminate\Http\Request;

class HeritageController extends AdminController implements CreatorListener, DeleterListener, UpdaterListener
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

    public function index(Request $request)
    {
        return $this->respondIndex($this->search->getHeritageListsBackend($request));
    }

    public function create()
    {
        return $this->creator->dataCreate();
    }

    public function store(HeritageFormRequest $request)
    {
        return $this->creator->heritageCreate($request, $this);
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
        return $this->respond($this->search->getDetailBackend($id));
    }

    public function edit($heritage)
    {
        return $this->respond($this->updater->dataEdit($heritage));
    }

    /**
     * @param HeritageFormRequest $request
     * @param $heritage
     * @return mixed
     */
    public function update(HeritageFormRequest $request, $heritage)
    {
        return $this->updater->heritageUpdate($request, $this, $heritage);
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
     * Xóa heritage
     * @param $heritage
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($heritage)
    {
        return $this->deleter->destroy($heritage, $this);
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