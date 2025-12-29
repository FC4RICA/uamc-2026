@php
    use App\Enums\ParticipationType;
@endphp

@extends('layouts.member')
@section('title', 'แก้ไขข้อมูล')

@section('profile', 'active')

@section('content')
<div class="container my-5">
    <div class="text-center">
        <h2><strong>แก้ไขข้อมูล</strong></h2>
    </div>
    <hr>
    @if($incorrect == 1)
        <div class="row">
            <div class="col-12 text-center">
                <label style="color: red"><strong>รหัสผ่านไม่ถูกต้อง</strong></label>
            </div>
        </div>
    @endif
    <form id="editprofile" name="editprofile" action='{{ url("member/editprofile") }}' method="POST">
        {{ csrf_field() }}
        <!-- @csrf
        @method('POST') -->
        <div>
            <h3>ข้อมูลการเข้าใช้งาน</h3>
            <div class="form-group">
                <label for="email">อีเมล</label>
                <input id="email" name="email" type="email" class="form-control" placeholder="uamc2020@kmutt.ac.th" value="{{ Auth::user()->email }}">
            </div>
        </div>
        <div>
            <h3>ข้อมูลส่วนตัว</h3>
            <div class="row">
                <div class="col-12 col-lg-6">
                    <div class="form-group">
                        <label for="prefix">คำนำหน้า</label>
                        <select id="prefix" name="prefix" class="custom-select" required>
                            <?php
                            $mr = '';
                            $mrs = '';
                            $other = '';
                            $ms = '';
                            switch (Auth::user()->prefix) {
                                case 'นาย':
                                    $mr = 'selected';
                                    break;
                                case 'นาง':
                                    $mrs = 'selected';
                                    break;
                                case 'นางสาว':
                                    $ms = 'selected';
                                    break;
                                default:
                                    $other = 'selected';
                            }
                            ?>
                            <option value="" disabled>เลือก</option>
                            <option value="นาย" {{ $mr }}>นาย</option>
                            <option value="นาง" {{ $mrs }}>นาง</option>
                            <option value="นางสาว" {{ $ms }}>นางสาว</option>
                            <option value="อื่น ๆ" {{ $other }}>อื่น ๆ</option>
                        </select>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="form-group">
                        <label for="position">ตำแหน่งทางวิชาการ</label>
                        <select id="position" name="position" class="custom-select" required>
                            <?php
                            $none = '';
                            $pro = '';
                            $asc = '';
                            $ass = '';
                            switch (Auth::user()->position) {
                                case 1:
                                    $none = 'selected';
                                    break;
                                case 2:
                                    $pro = 'selected';
                                    break;
                                case 3:
                                    $asc = 'selected';
                                    break;
                                default:
                                    $ass = 'selected';
                            }
                            ?>
                            <option value="" disabled>เลือก</option>
                            <option value="1" {{ $none }}>ไม่มี</option>
                            <option value="2" {{ $pro }}>ศาสตราจารย์</option>
                            <option value="3" {{ $asc }}>รองศาสตราจารย์</option>
                            <option value="4" {{ $ass }}>ผู้ช่วยศาสตราจารย์</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-lg-6">
                    <div class="form-group">
                        <label for="firstname">ชื่อ</label>
                        <input id="firstname" name="firstname" type="text" class="form-control" placeholder="ชื่อ" value="{{ Auth::user()->name }}" required>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="form-group">
                        <label for="lastname">นามสกุล</label>
                        <input id="lastname" name="lastname" type="text" class="form-control" placeholder="นามสกุล" value="{{ Auth::user()->lastname }}" required>
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
                            <?php
                            $bsc = '';
                            $mas = '';
                            $phd = '';
                            $other = '';
                            switch (Auth::user()->education) {
                                case 1:
                                    $bsc = 'selected';
                                    break;
                                case 2:
                                    $mas = 'selected';
                                    break;
                                case 3:
                                    $phd = 'selected';
                                    break;
                                default:
                                    $other = 'selected';
                            }
                            ?>
                            <option value="" disabled>เลือก</option>
                            <option value="1" {{ $bsc }}>ปริญญาตรี</option>
                            <option value="2" {{ $mas }}>ปริญญาโท</option>
                            <option value="3" {{ $phd }}>ปริญญาเอก</option>
                            <option value="4" {{ $other }}>อื่น ๆ</option>
                        </select>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="form-group">
                        <label for="occupation">อาชีพ</label>
                        <select id="occupation" name="occupation" class="custom-select" required>
                            <?php
                            $lec = '';
                            $res = '';
                            $std = '';
                            $off1 = '';
                            $off2 = '';
                            $off3 = '';
                            $ustaff = '';
                            $oth = '';
                            switch (Auth::user()->occupation) {
                                case 'อาจารย์':
                                    $lec = 'selected';
                                    break;
                                case 'นักวิจัย นักวิชาการ':
                                    $res = 'selected';
                                    break;
                                case 'นิสิต นักศึกษา':
                                    $std = 'selected';
                                    break;
                                case 'ข้าราชการ':
                                    $off1 = 'selected';
                                    break;
                                case 'พนักงานเอกชน':
                                    $off2 = 'selected';
                                    break;
                                case 'พนักงานรัฐวิสาหกิจ':
                                    $off3 = 'selected';
                                    break;
                                case 'พนักงานมหาวิทยาลัย':
                                    $ustaff = 'selected';
                                    break;
                                default:
                                    $oth = 'selected';
                            }
                            ?>
                            <option value="" disabled>เลือก</option>
                            <option value="อาจารย์" {{ $lec }}>อาจารย์</option>
                            <option value="นักวิจัย นักวิชาการ" {{ $res }}>นักวิจัย นักวิชาการ</option>
                            <option value="นิสิต นักศึกษา" {{ $std }}>นิสิต นักศึกษา</option>
                            <option value="ข้าราชการ" {{ $off1 }}>ข้าราชการ</option>
                            <option value="พนักงานเอกชน" {{ $off2 }}>พนักงานเอกชน</option>
                            <option value="พนักงานรัฐวิสาหกิจ" {{ $off3 }}>พนักงานรัฐวิสาหกิจ</option>
                            <option value="พนักงานมหาวิทยาลัย" {{ $ustaff }}>พนักงานมหาวิทยาลัย</option>
                            <option value="อื่นๆ" {{ $oth }}>อื่นๆ</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-lg-6">
                    <div class="form-group">
                        <label for="organization">สถานที่ทำงาน/หน่วยงาน/สถาบันการศึกษา</label>
                        <select id="organization" name="organization" class="custom-select" required>
                            <option value="">เลือก</option>
                            @foreach($organ as $u)
                            @if(Auth::user()->organization == $u->id)
                                <option value="{{ $u->id }}" selected>{{ $u->title }}</option>
                            @else
                                <option value="{{ $u->id }}">{{ $u->title }}</option>
                            @endif
                            @endforeach
                        </select>
                        <!-- <input id="organization" name="organization" class="form-control" type="text" placeholder="สถานที่ทำงาน" value="{{ Auth::user()->organization }}" required> -->
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="form-group">
                        <label for="phone">เบอร์โทร</label>
                        <input id="phone" name="phone" class="form-control" type="tel" placeholder="เบอร์โทร" value="{{ Auth::user()->phone }}" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-lg-6">
                    <div class="form-group">
                        <label for="type">ประเภทการเข้าร่วม</label>
                        <select id="type" name="type" class="custom-select" required>
                            <option value="">เลือก</option>
                            <option value="1" @selected(Auth::user()->participation_type == ParticipationType::Attendee)>เข้าร่วมงาน</option>
                            <option value="2" @selected(Auth::user()->participation_type == ParticipationType::Oral)>นำเสนอแบบบรรยาย (Oral Presentation)</option>
                            <option value="3" @selected(Auth::user()->participation_type == ParticipationType::Poster)>นำเสนอแบบโปสเตอร์ (Poster Presentation)</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <h3>ระบุรหัสผ่านเพื่อเปลี่ยนแปลงข้อมูล</h3>
            <div class="form-group">
                <label for="password">รหัสผ่าน</label>
                <input id="password" name="password" type="password" class="form-control" placeholder="รหัสผ่าน" require>
            </div>
            <div class="form-group">
                <label for="confirmpassword">ยืนยันรหัสผ่าน</label>
                <input id="confirmpassword" name="confirmpassword" type="password" class="form-control" placeholder="รหัสผ่าน" require>
            </div>
        </div>
        <div class="text-center">
            <div class="form-group">
                <button class="btn btn-warning" type="submit">แก้ไขข้อมูล</button>
                <button class="btn btn-danger" type="reset">ยกเลิกการแก้ไข</button>
            </div>
        </div>
    </form>
</div>

@endsection