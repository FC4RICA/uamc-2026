@php
    use App\Enums\ParticipationType;
@endphp

@extends('layouts.public')

@section('title', 'ลงทะเบียน')
@section('register', 'active')

@section('data-page', 'register')

@section('content')
<div class="container my-4">
    <div class="row">
        <div class="col-12">
            <h1 class="text-center"><strong>ลงทะเบียน</strong></h1>
        </div>
    </div>
    <hr>
    {{-- @if($status == 1) --}}
    <form action="{{ route('register') }}" name="registration-form" id="registration-form" method="POST">
        @csrf
        <div>
            <h3>ข้อมูลการเข้าใช้งาน</h3>
            <div class="form-group">
                <label for="email">อีเมล</label>
                <input id="email" name="email" value="{{ old('email') }}" type="email" class="form-control" style="@error('email') border-color: red; @enderror" placeholder="uamc2026@kmutt.ac.th" required>
                @error('email')
                    <label for="email" class="error">{{ $message }}</label>
                @enderror
            </div>
            <div class="form-group">
                <label for="password">รหัสผ่าน</label>
                <input id="password" name="password" type="password" class="form-control" style="@error('password') border-color: red; @enderror" placeholder="รหัสผ่าน" required>
                @error('password')
                    <label for="password" class="error">{{ $message }}</label>
                @enderror
            </div>
            <div class="form-group">
                <label for="password_confirmation">ยืนยันรหัสผ่าน</label>
                <input id="password_confirmation" name="password_confirmation" type="password" class="form-control" style="@error('password') border-color: red; @enderror" placeholder="ยืนยันรหัสผ่าน" required>
            </div>
        </div>
        <div>
            <h3>ข้อมูลส่วนตัว</h3>
            <div class="row">
                <div class="col-12 col-lg-6">
                    <div class="form-group">
                        <label for="title">คำนำหน้า</label>
                        <select id="title" name="title" class="custom-select" style="@error('title') border-color: red; @enderror" required>
                            <option value="" @selected(!old('title')) disabled>เลือก</option>
                            @foreach($titles as $title)
                                <option value="{{ $title->value }}" @selected($title->value == old('title'))>
                                    {{ $title->label() }}
                                </option>
                            @endforeach
                        </select>
                        @error('title')
                            <label for="title" class="error">{{ $message }}</label>
                        @enderror
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="form-group">
                        <label for="academic_title">ตำแหน่งทางวิชาการ</label>
                        <select id="academic_title" name="academic_title" class="custom-select" style="@error('academic_title') border-color: red; @enderror" required>
                            <option value="" @selected(!old('academic_title')) disabled>เลือก</option>
                            @foreach($academicTitles as $title)
                                <option value="{{ $title->value }}" @selected($title->value == old('academic_title'))>
                                    {{ $title->label() }}
                                </option>
                            @endforeach
                        </select>
                        @error('academic_title')
                            <label for="academic_title" class="error">{{ $message }}</label>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-lg-6">
                    <div class="form-group">
                        <label for="firstname">ชื่อ</label>
                        <input id="firstname" name="firstname" value="{{ old('firstname') }}" type="text" style="@error('firstname') border-color: red; @enderror" class="form-control" placeholder="ชื่อ" required>
                        @error('firstname')
                            <label for="firstname" class="error">{{ $message }}</label>
                        @enderror
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="form-group">
                        <label for="lastname">นามสกุล</label>
                        <input id="lastname" name="lastname" value="{{ old('lastname') }}" type="text" style="@error('lastname') border-color: red; @enderror" class="form-control" placeholder="นามสกุล" required>
                        @error('lastname')
                            <label for="lastname" class="error">{{ $message }}</label>
                        @enderror
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
                        <select id="education" name="education" class="custom-select" style="@error('education') border-color: red; @enderror" required>
                            <option value="" @selected(!old('education')) disabled>เลือก</option>
                            @foreach($education as $ed)
                                <option value="{{ $ed->value }}" @selected($ed->value == old('education'))>
                                    {{ $ed->label() }}
                                </option>
                            @endforeach
                        </select>
                        @error('education')
                            <label for="education" class="error">{{ $message }}</label>
                        @enderror
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="form-group">
                        <label for="phone">เบอร์โทร</label>
                        <input id="phone" name="phone" value="{{ old('phone') }}" style="@error('phone') border-color: red; @enderror" class="form-control" type="tel" placeholder="เบอร์โทร" required>
                        @error('phone')
                            <label for="phone" class="error">{{ $message }}</label>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-lg-6">
                    <div class="form-group">
                        <label for="organization_id">สถานที่ทำงาน/หน่วยงาน/สถาบันการศึกษา</label>
                        <select id="organization_id" name="organization_id" style="@error('organization_id') border-color: red; @enderror" class="custom-select" required>
                            <option value="" @selected(!old('organization_id')) disabled>เลือก</option>
                            @foreach($organizations as $org)
                                <option value="{{ $org->id }}" @selected($org->id == old('organization_id'))>
                                    {{ $org->name }}
                                </option>
                            @endforeach
                            <option value="other">อื่นๆ</option>
                        </select>
                        @error('organization_id')
                            <label for="organization_id" class="error">{{ $message }}</label>
                        @enderror
                        <input id="organization_other" name="organization_other" value="{{ old('organization_other') }}"  style="@error('organization_other') border-color: red; @enderror" class="form-control mt-2" type="text" placeholder="กรองสถานที่ทำงานของคุณ">
                        @error('organization_other')
                            <label for="organization_other" class="error">{{ $message }}</label>
                        @enderror
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="form-group">
                        <label for="occupation_id">อาชีพ</label>
                        <select id="occupation_id" name="occupation_id" style="@error('occupation_id') border-color: red; @enderror" class="custom-select" required>
                            <option value="" @selected(!old('occupation_id')) disabled>เลือก</option>
                            @foreach($occupations as $ocu)
                                <option value="{{ $ocu->id }}" @selected($ocu->id == old('organization_id'))>
                                    {{ $ocu->name }}
                                </option>
                            @endforeach
                            <option value="other">อื่นๆ</option>
                        </select>
                        @error('occupation_id')
                            <label for="occupation_id" class="error">{{ $message }}</label>
                        @enderror
                        <input id="occupation_other" name="occupation_other" value="{{ old('occupation_other') }}" style="@error('occupation_other') border-color: red; @enderror" class="form-control mt-2" type="text" placeholder="กรอกอาชีพของคุณ">
                        @error('occupation_other')
                            <label for="occupation_other" class="error">{{ $message }}</label>
                        @enderror
                    </div>
                </div>
            </div>
            <div>
                <h3>ข้อมูลการเข้าร่วม</h3>
                <div class="row">
                    <div class="col-12 col-lg-6">
                        <div class="form-group">
                            <label for="participation_type">ประเภทการเข้าร่วม</label>
                            <select id="participation_type" name="participation_type" class="custom-select" style="@error('participation_type') border-color: red; @enderror" required>
                                <option value="" @selected(!old('participation_type')) disabled>เลือก</option>
                                @foreach ($participationType as $role)
                                    <option value="{{ $role->value }}" @selected($role->value == old('participation_type'))>
                                        {{ $role->label() }}
                                    </option>
                                @endforeach
                            </select>
                            @error('participation_type')
                                <label for="participation_type" class="error">{{ $message }}</label>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div id="presentation_type_form_group" class="form-group">
                            <label for="presentation_type">ประเภทการนำเสนอ</label>
                            <select id="presentation_type" name="presentation_type" style="@error('presentation_type') border-color: red; @enderror" class="custom-select">
                                <option value="" @selected(!old('presentation_type')) disabled>เลือก</option>
                                @foreach ($presentationType as $type)
                                    <option value="{{ $type->value }}" @selected($type->value == old('presentation_type'))>
                                        {{ $type->label() }}
                                    </option>
                                @endforeach
                            </select>
                            @error('presentation_type')
                                <label for="presentation_type" class="error">{{ $message }}</label>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-lg-6">
                        <div class="form-group">
                            <label for="special_requirements">ข้อจำกัดด้านอาหาร / ข้อมูลสุขภาพที่ควรทราบ (ถ้ามี)</label>
                            <input id="special_requirements" name="special_requirements" value="{{ old('special_requirements') }}" type="text" class="form-control" placeholder="เช่น มังสวิรัติ, ฮาลาล, แพ้ถั่ว, เบาหวาน">
                            @error('special_requirements')
                                <label for="special_requirements" class="error">{{ $message }}</label>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div style="overflow:auto;">
            <div style="float:right;">
                <button type="submit" class="btn btn-warning">ยืนยัน</button>
            </div>
        </div>
    </form>
    {{-- @else
        <h1 class="text-center"><strong>ระบบยังไม่เปิดให้ลงทะเบียนในขณะนี้</strong></h1>
    @endif --}}
</div>
@endsection

@push('scripts')
    <script>
        const presenterId = @json(ParticipationType::PRESENTER->value);
    </script>
@endpush