<?php


namespace App\Http\Controllers\API\Admin;

use App\IZee\Advertisements\Deleter;
use App\IZee\Advertisements\DeleterListener;
use App\IZee\Advertisements\Updater;
use App\IZee\Advertisements\UpdaterListener;
use App\IZee\Advertisements\Creator;
use App\IZee\Advertisements\CreatorListener;
use App\IZee\Advertisements\AdvertisementFormRequest;
use App\IZee\Advertisements\Search;

class AdvertisementController extends AdminController implements CreatorListener, DeleterListener, UpdaterListener
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
        return $this->respondIndex($this->search->getAdvertisementListsBackend());
    }

    public function create()
    {
        return $this->respond($this->creator->dataCreate());
    }

    public function store(AdvertisementFormRequest $request)
    {
        return $this->creator->advertisementCreate($request, $this);
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
        return $this->respond($this->search->getAdvertisementDetailBackend($id));
    }

    /**
     * @param $advertisement
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit($advertisement)
    {
        return $this->respond($this->updater->dataEdit($advertisement));
    }

    /**
     * @param AdvertisementFormRequest $request
     * @param $heritage
     * @return mixed
     */
    public function update(AdvertisementFormRequest $request, $heritage)
    {
        return $this->updater->advertisementUpdate($request, $this, $heritage);
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
     * Xóa advertisement
     * @param $advertisement
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($advertisement)
    {
        return $this->deleter->destroy($advertisement, $this);
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