@extends('layouts.member')
@section('title', 'แก้ไขข้อมูล')

@section('profile', 'active')

@section('content')
    <div class="container px-4 my-5">
        <div class="text-center">
            <h2><strong>แก้ไขข้อมูล</strong></h2>
        </div>
        <hr class="separator">
        <form id="editprofile" name="editprofile" action='{{ route('user-profile-information.update') }}' method="POST">
            @csrf
            <div>
                <h3>ข้อมูลการเข้าใช้งาน</h3>
                <div class="form-group">
                    <label for="email">อีเมล</label>
                    <input id="email" name="email" type="email" class="form-control"
                        placeholder="uamc2020@kmutt.ac.th" value="{{ Auth::user()->email }}">
                </div>
            </div>
            <div>
                <h3>ข้อมูลส่วนตัว</h3>
                <div class="row">
                    <div class="col-12 col-lg-6">
                        <div class="form-group">
                            <label for="prefix">คำนำหน้า</label>
                            <select id="prefix" name="prefix" class="custom-select" required>
                                @foreach ($titles as $title)
                                    <option value="{{ $title->value }}" @selected(Auth::user()->profile->title === $title)>
                                        {{ $title->label() }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div class="form-group">
                            <label for="position">ตำแหน่งทางวิชาการ</label>
                            <select id="position" name="position" class="custom-select" required>
                                @foreach ($academicTitles as $title)
                                    <option value="{{ $title->value }}" @selected(Auth::user()->profile->academic_title === $title)>
                                        {{ $title->label() }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-lg-6">
                        <div class="form-group">
                            <label for="firstname">ชื่อ</label>
                            <input id="firstname" name="firstname" type="text" class="form-control" placeholder="ชื่อ"
                                value="{{ Auth::user()->profile->firstname }}" required>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div class="form-group">
                            <label for="lastname">นามสกุล</label>
                            <input id="lastname" name="lastname" type="text" class="form-control" placeholder="นามสกุล"
                                value="{{ Auth::user()->profile->lastname }}" required>
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
                                @foreach ($education as $ed)
                                    <option value="{{ $ed->value }}" @selected(Auth::user()->profile->education === $ed)>
                                        {{ $ed->label() }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div class="form-group">
                            <label for="occupation">อาชีพ</label>
                            <select id="occupation" name="occupation" class="custom-select" required>
                                @foreach ($occupations as $ocu)
                                    <option value="{{ $ocu->id }}" @selected(Auth::user()->profile->occupation_id === $ocu->id)>
                                        {{ $ocu->name }}
                                    </option>
                                @endforeach
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
                                @foreach ($organizations as $org)
                                    <option value="{{ $org->id }}" @selected(Auth::user()->profile->organization_id === $org->id)>
                                        {{ $org->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div class="form-group">
                            <label for="phone">เบอร์โทร</label>
                            <input id="phone" name="phone" class="form-control" type="tel" placeholder="เบอร์โทร"
                                value="{{ Auth::user()->profile->phone }}" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-lg-6">
                        <div class="form-group">
                            <label for="type">ประเภทการเข้าร่วม</label>
                            <select id="type" name="type" class="custom-select" required>
                                @foreach ($participationTypes as $type)
                                    <option value="{{ $type->value }}" @selected(Auth::user()->profile->participation_type === $type)>
                                        {{ $type->label() }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <h3>ระบุรหัสผ่านเพื่อเปลี่ยนแปลงข้อมูล</h3>
                <div class="form-group">
                    <label for="password">รหัสผ่าน</label>
                    <input id="password" name="password" type="password" class="form-control" placeholder="รหัสผ่าน"
                        require>
                </div>
                <div class="form-group">
                    <label for="confirmpassword">ยืนยันรหัสผ่าน</label>
                    <input id="confirmpassword" name="confirmpassword" type="password" class="form-control"
                        placeholder="รหัสผ่าน" require>
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
