<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>找回密碼</title>
</head>
<body>
    <h1>找回密碼</h1>

    <p>請點擊連結
        <a href="{{ route('password.reset', $token) }}">
            {{ route('password.reset', $token) }}
        </a>
    </p>
    <p>如果不是本人，請忽略</p>
</body>
</html>
