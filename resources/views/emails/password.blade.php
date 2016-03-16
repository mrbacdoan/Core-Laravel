<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>
<h2>Password Reset</h2>
<div>
    Để thay đổi mật khẩu bạn vui lòng xác nhận tại đây: <a href="{{ route('admin.accounts.reset-password', ['email' => $user->email, 'token' => $token]) }}">Xác nhận</a><br/>
    Xác nhận mật khẩu chỉ còn hiệu lực sau {{ Config::get('auth.password.expire', 60) }} phút kể từ khi có thông báo từ website.
</div>
</body>
</html>
