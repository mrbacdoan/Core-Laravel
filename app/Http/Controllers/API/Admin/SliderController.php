<?php


namespace App\Http\Controllers\API\Admin;

use App\IZee\Sliders\Deleter;
use App\IZee\Sliders\DeleterListener;
use App\IZee\Sliders\Updater;
use App\IZee\Sliders\UpdaterListener;
use App\IZee\Sliders\Creator;
use App\IZee\Sliders\CreatorListener;
use App\IZee\Sliders\SliderFormRequest;
use App\IZee\Sliders\Search;

class SliderController extends AdminController implements CreatorListener, DeleterListener, UpdaterListener
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
        return $this->respondIndex($this->search->getSliderListsBackend());
    }

    public function create()
    {
        return $this->respond($this->creator->dataCreate());
    }

    public function store(SliderFormRequest $request)
    {
        return $this->creator->sliderCreate($request, $this);
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
        return $this->respond($this->search->getSliderDetailBackend($id));
    }
    /**
     * @param $slider
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit($slider)
    {
        return $this->respond($this->updater->dataEdit($slider));
    }

    /**
     * @param SliderFormRequest $request
     * @param $heritage
     * @return mixed
     */
    public function update(SliderFormRequest $request, $heritage)
    {
        return $this->updater->sliderUpdate($request, $this, $heritage);
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