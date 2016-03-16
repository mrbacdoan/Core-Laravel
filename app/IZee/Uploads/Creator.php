<?php

namespace App\IZee\Uploads;

use Exception;

class Creator
{

    protected $logged;

    public function __construct()
    {
    }

    public function upload(CreatorFormRequest $request, CreatorListener $listener)
    {
        try {
            if (!$request->hasFile('file')) {
                return $listener->createFailed('Không tồn tại tệp tin');
            }
            $upload = uploadFile($request, 'file', PATH_UPLOAD_THUMBNAILS);
            if (!empty($upload)) {
                return $listener->createSuccessful(['file' => $upload, 'thumbnail' => getThumbFileUpload($upload), 'code' => AJAX_SUCCESS]);
            }
        } catch (Exception $e) {
            izWriteLog($e);
        }
        return $listener->createFailed('');
    }
}