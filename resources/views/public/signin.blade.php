@extends('layouts.public')

@section('title', 'เข้าสู่ระบบ')
@section('submission', 'active')

@section('content')
<div class="container mb-5" style="margin-top: 2rem;">
    <div class="row">
        <div class="col-12 text-center">
            <h1 class="text-center"><strong>เข้าระบบส่งบทคัดย่อ</strong></h1>
            @if($incorrect == 0)
            <label style="color: red">กรุณาลงทะเบียนก่อนส่งบทคัดย่อ</label>
            @else
            <label style="color: red"><strong>ชื่อผู้ใช้งานหรือรหัสผ่านไม่ถูกต้อง</strong></label>
            @endif
        </div>
    </div>
    <hr>

    <form action="signin" name="signin" id="signin-form" method="POST">
        {{ csrf_field() }}
        <!-- @csrf
        @method('POST') -->
        <div>
            <div class="form-group">
                <label for="email">อีเมล</label>
                <input id="email" name="email" type="email" class="form-control" placeholder="uamc2020@kmutt.ac.th" required>
            </div>
            <div class="form-group">
                <label for="password">รหัสผ่าน</label>
                <input id="password" name="password" type="password" class="form-control" placeholder="password" required>
            </div>
        </div>
        <div class="text-center">
            {{-- <button class="btn btn-success" type="submit">เข้าสู่ระบบ</button> --}}
            <a class="btn btn-success" type="submit" href="{{ route('member.index') }}">เข้าสู่ระบบ</a>
        </div>
        <div class="text-right">
            <label>ยังไม่มีบัญชีผู้ใช้</label>
            <a href="{{ route('public.register.show') }}">ลงทะเบียน</a>
        </div>
    </form>

</div>

@endsection