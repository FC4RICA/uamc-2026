@extends('layouts.public')

@section('title', 'เข้าสู่ระบบ')
@section('submission', 'active')

@section('content')
<div class="container mb-5" style="margin-top: 2rem;">
    <div class="row">
        <div class="col-12 text-center">
            <h1 class="text-center"><strong>เข้าระบบส่งบทคัดย่อ</strong></h1>
        </div>
    </div>
    <hr>

    <form action="{{ route('login') }}" name="login" id="login-form" method="POST">
        @csrf
        <div>
            <div class="form-group">
                <label for="email">อีเมล</label>
                <input id="email" name="email" type="email" class="form-control" placeholder="uamc2020@kmutt.ac.th" required>
                @error('email')
                    <label for="email" class="error">{{ $message }}</label>
                @enderror
            </div>
            <div class="form-group">
                <label for="password">รหัสผ่าน</label>
                <input id="password" name="password" type="password" class="form-control" placeholder="password" required>
                @error('password')
                    <label for="password" class="error">{{ $message }}</label>
                @enderror
            </div>
            <div class="d-flex items-center gap-4 mb-2">
                <input id="remember" name="remember" type="checkbox" {{ old("remember") ? "checked" : "" }}>
                <label for="remember" class="m-0 ml-2">จำการเข้าสู่ระบบ</label>
            </div>
        </div>
        <div class="text-center">
            <button class="btn btn-success" type="submit">เข้าสู่ระบบ</button>
        </div>
        <div class="text-right">
            <label>ยังไม่มีบัญชีผู้ใช้?</label>
            <a href="{{ route('register') }}">ลงทะเบียน</a>
        </div>
    </form>

</div>

@endsection