<?php

namespace App\Http\Controllers\API\Admin;


use App\Http\Controllers\API\ApiController;
use App\IZee\Uploads\Creator;
use App\IZee\Uploads\CreatorFormRequest;
use App\IZee\Uploads\CreatorListener;

class UploadController extends ApiController implements CreatorListener
{

    private $creator;

    function __construct(Creator $creator)
    {
        $this->creator = $creator;
    }

    public function store(CreatorFormRequest $request)
    {
        return $this->creator->upload($request, $this);
    }

    /**
     * @param array $result
     * @return mixed
     */
    public function createSuccessful($result = array())
    {
        return $this->respond($result);
    }

    /**
     * @param string|array $error
     * @return mixed
     */
    public function createFailed($error)
    {
        return $this->respond($error);
    }


}