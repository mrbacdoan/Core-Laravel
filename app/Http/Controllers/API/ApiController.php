<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;

class ApiController extends Controller
{

    protected $statusCode = 200;

    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;
        return $this;
    }

    public function getStatusCode()
    {
        return $this->statusCode;
    }

    public function respond($data, $headers = [])
    {
        if (!empty($data) && is_array($data) && empty($data['status_code'])) {
            $data = array_merge(array('status_code' => $this->getStatusCode()), $data);
        }
        return response()->json($data, $this->getStatuscode(), $headers);
    }

    public function respondWithError($message)
    {
        return $this->respond([
            "error" => [
                "message" => $message,
                "status_code" => $this->getStatusCode()
            ]
        ]);
    }

    public function respondNotFound($message = "Not Found")
    {
        return $this->setStatusCode(Response::HTTP_NOT_FOUND)->respondWithError($message);
    }

    public function respondInternalError($message = "Internal Error")
    {
        return $this->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR)->respondWithError($message);
    }
}