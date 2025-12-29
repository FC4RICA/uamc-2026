@extends('layouts.public')

@section('title', 'ลงทะเบียน')
@section('register', 'active')

@section('content')
<!-- Form::token() -->
<div class="container" style="margin-top: 2rem;">
    <div class="row">
        <div class="col-12">
            <h1 class="text-center"><strong>ลงทะเบียน</strong></h1>
        </div>
    </div>
    <hr>
    @if($status == 1)
    <form action="register" name="registration" id="registration-form" method="POST">
        {{ csrf_field() }}
        <!-- @csrf
        @method('POST') -->
        <div>
            <h3>ข้อมูลการเข้าใช้งาน</h3>
            <div class="form-group">
                <label for="email">อีเมล</label>
                <input id="email" name="email" type="email" class="form-control" placeholder="uamc2020@kmutt.ac.th" required>
            </div>
            <div class="form-group">
                <label for="password">รหัสผ่าน</label>
                <input id="password" name="password" type="password" class="form-control" placeholder="รหัสผ่าน" required>
            </div>
            <div class="form-group">
                <label for="confirmpassword">ยืนยันรหัสผ่าน</label>
                <input id="confirmpassword" name="confirmpassword" type="password" class="form-control" placeholder="ยืนยันรหัสผ่าน" required>
            </div>
        </div>
        @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <div>
            <h3>ข้อมูลส่วนตัว</h3>
            <div class="row">
                <div class="col-12 col-lg-6">
                    <div class="form-group">
                        <label for="prefix">คำนำหน้า</label>
                        <select id="prefix" name="prefix" class="custom-select" required>
                            <option value="" selected disabled>เลือก</option>
                            <option value="นาย">นาย</option>
                            <option value="นาง">นาง</option>
                            <option value="นางสาว">นางสาว</option>
                            <option value="อื่น ๆ">อื่น ๆ</option>
                        </select>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="form-group">
                        <label for="position">ตำแหน่งทางวิชาการ</label>
                        <select id="position" name="position" class="custom-select" required>
                            <option value="" selected disabled>เลือก</option>
                            <option value="1">ไม่มี</option>
                            <option value="2">ศาสตราจารย์</option>
                            <option value="3">รองศาสตราจารย์</option>
                            <option value="4">ผู้ช่วยศาสตราจารย์</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-lg-6">
                    <div class="form-group">
                        <label for="firstname">ชื่อ</label>
                        <input id="firstname" name="firstname" type="text" class="form-control" placeholder="ชื่อ" required>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="form-group">
                        <label for="lastname">นามสกุล</label>
                        <input id="lastname" name="lastname" type="text" class="form-control" placeholder="นามสกุล" required>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <h3>ข้อมูลการศึกษา การทำงาน</h3>
            <div class="row">
                <div class="col-12 col-lg-6">
                    <div class="form-group">
                        <label for="education">ระดับการศึกษา</label>
                        <select id="education" name="education" class="custom-select" required>
                            <option value="" selected disabled>เลือก</option>
                            <option value="1">ปริญญาตรี</option>
                            <option value="2">ปริญญาโท</option>
                            <option value="3">ปริญญาเอก</option>
                            <option value="4">อื่น ๆ</option>
                        </select>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="form-group">
                        <label for="occupation">อาชีพ</label>
                        <select id="occupation" name="occupation" class="custom-select" required>
                            <option value="" selected disabled>เลือก</option>
                            <option value="อาจารย์">อาจารย์</option>
                            <option value="นักวิจัย นักวิชาการ">นักวิจัย นักวิชาการ</option>
                            <option value="นิสิต นักศึกษา">นิสิต นักศึกษา</option>
                            <option value="ข้าราชการ">ข้าราชการ</option>
                            <option value="พนักงานเอกชน">พนักงานเอกชน</option>
                            <option value="พนักงานรัฐวิสาหกิจ">พนักงานรัฐวิสาหกิจ</option>
                            <option value="พนักงานมหาวิทยาลัย">พนักงานมหาวิทยาลัย</option>
                            <option value="อื่นๆ">อื่นๆ</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-lg-6">
                    <div class="form-group">
                        <label for="organization">สถานที่ทำงาน/หน่วยงาน/สถาบันการศึกษา</label>
                        <select id="organization" name="organization" class="custom-select" required>
                            <option value="" selected disabled>เลือก</option>
                            @foreach($organ as $u)
                            <option value="{{ $u['id'] }}">{{ $u['title'] }}</option>
                            @endforeach
                        </select>
                        <!-- <input id="organization" name="organization" class="form-control" type="text" placeholder="สถานที่ทำงาน" required> -->
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="form-group">
                        <label for="phone">เบอร์โทร</label>
                        <input id="phone" name="phone" class="form-control" type="tel" placeholder="เบอร์โทร" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-lg-6">
                    <div class="form-group">
                        <label for="type">ประเภทการเข้าร่วม</label>
                        <select id="type" name="type" class="custom-select" required>
                            <option value="" selected disabled>เลือก</option>
                            <option value="1">เข้าร่วมงาน</option>
                            <option value="2">นำเสนอแบบบรรยาย (Oral Presentation)</option>
                            <option value="3">นำเสนอแบบโปสเตอร์ (Poster Presentation)</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div style="overflow:auto;">
            <div style="float:right;">
                <button type="submit" class="btn btn-warning">ยืนยัน</button>
                <!-- <button type="button" id="prevBtn" class="btn btn-warning" onclick="nextPrev(-1)">ก่อนหน้า</button> -->
                <!-- <button type="button" id="nextBtn" class="btn btn-primary" onclick="nextPrev(1)">ถัดไป</button> -->
            </div>
        </div>
        <div style="text-align:center;margin-top:40px;">
            <span class="step"></span>
            <span class="step"></span>
            <span class="step"></span>
        </div>
    </form>
    @else
        <h1 class="text-center"><strong>ระบบยังไม่เปิดให้ลงทะเบียนในขณะนี้</strong></h1>
    @endif
</div>
@endsection