<?php

namespace App\IZee\Users;

interface ChangePasswordListener
{

    /**
     * Mật khẩu cũ không chính xác
     * @param $message
     * @return mixed
     */
    public function passwordOldInValid($message);

    /**
     * Đổi mật khẩu thất bại
     * @param $error
     * @return mixed
     */
    public function changePasswordFailed($error);

    /**
     * Đổi mật khẩu thành công
     * @param $success
     * @return mixed
     */
    public function changePasswordSuccessful($success);
}