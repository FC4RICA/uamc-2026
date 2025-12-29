<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <script type="text/javascript" src="{{ asset('js/bootstrap.js') }}" defer></script>
    <script type="text/javascript" src="{{ asset('js/jquery-3.4.1.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/popper.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/jquery.validate.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script type="text/javascript" src="{{ asset('js/control.js') }}" defer></script>
    <script type="text/javascript" src="{{ asset('js/form-validate.js') }}"></script>
    <title>Administrator</title>
</head>

<body class="adminSignInPage">
    <div class="header">
        <span class="topbar"><strong>The 9th Undergraduate in Applied Mathematics Conference</strong></span>
    </div>
    <div class="adminSignIn">
        <form action='{{ url("admin/signin") }}' method="POST">
            {{ csrf_field() }}
            <!-- @csrf
            @method('POST') -->
            <h2 class="text-center"><strong>เข้าสู่ระบบ</strong></h2>
            <div class="form-group">
                <label for="username"><strong>ชื่อผู้ใช้</strong></label>
                <input id="username" name="username" class="form-control" type="text" placeholder="username" required>
            </div>
            <div class="form-group">
                <label for="password"><strong>รหัสผ่าน</strong></label>
                <input id="password" name="password" class="form-control" type="password" placeholder="password" required>
            </div>
            <div class="text-center">
                <button class="btn btn-success" type="submit">เข้าสู่ระบบ</button>
            </div>
        </form>
    </div>
</body>

</html>