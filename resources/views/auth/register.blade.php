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
        <hr class="separator">
        {{-- @if ($status == 1) --}}
        <form action="{{ route('register') }}" name="registration-form" id="registration-form" method="POST">
            @csrf
            <div>
                <h3 class="mt-4">ข้อมูลการเข้าใช้งาน</h3>
                <div class="form-group">
                    <label for="email">อีเมล</label>
                    <input id="email" name="email" value="{{ old('email') }}" type="email" autocomplete="username"
                        class="form-control @error('email') is-invalid @enderror" placeholder="uamc2026@kmutt.ac.th"
                        required>
                    @error('email')
                        <label for="email" class="error">{{ $message }}</label>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password">รหัสผ่าน</label>
                    <input id="password" name="password" type="password" autocomplete="new-password"
                        class="form-control @error('password') is-invalid @enderror" placeholder="รหัสผ่าน" required>
                    @error('password')
                        <label for="password" class="error">{{ $message }}</label>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password_confirmation">ยืนยันรหัสผ่าน</label>
                    <input id="password_confirmation" name="password_confirmation" type="password"
                        autocomplete="new-password"
                        class="form-control @error('password_confirmation') is-invalid @enderror"
                        placeholder="ยืนยันรหัสผ่าน" required>
                </div>
            </div>
            <div>
                <h3 class="mt-4">ข้อมูลส่วนตัว</h3>
                <div class="row">
                    <div class="col-12 col-lg-6">
                        <div class="form-group">
                            <label for="title">คำนำหน้า</label>
                            <select id="title" name="title" class="form-select @error('title') is-invalid @enderror"
                                required>
                                <option value="" @selected(!old('title')) disabled>เลือก</option>
                                @foreach ($titles as $title)
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
                            <select id="academic_title" name="academic_title"
                                class="form-select @error('academic_title') is-invalid @enderror" required>
                                <option value="" @selected(!old('academic_title')) disabled>เลือก</option>
                                @foreach ($academicTitles as $title)
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
                            <input id="firstname" name="firstname" value="{{ old('firstname') }}" type="text"
                                class="form-control @error('firstname') is-invalid @enderror" placeholder="ชื่อ" required>
                            @error('firstname')
                                <label for="firstname" class="error">{{ $message }}</label>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div class="form-group">
                            <label for="lastname">นามสกุล</label>
                            <input id="lastname" name="lastname" value="{{ old('lastname') }}" type="text"
                                class="form-control @error('lastname') is-invalid @enderror" placeholder="นามสกุล" required>
                            @error('lastname')
                                <label for="lastname" class="error">{{ $message }}</label>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <h3 class="mt-4">ข้อมูลการศึกษา การทำงาน</h3>
                <div class="row">
                    <div class="col-12 col-lg-6">
                        <div class="form-group">
                            <label for="education">ระดับการศึกษา</label>
                            <select id="education" name="education"
                                class="form-select @error('education') is-invalid @enderror" required>
                                <option value="" @selected(!old('education')) disabled>เลือก</option>
                                @foreach ($education as $ed)
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
                            <input id="phone" name="phone" value="{{ old('phone') }}" type="tel"
                                class="form-control @error('phone') is-invalid @enderror" placeholder="เบอร์โทร" required>
                            @error('phone')
                                <label for="phone" class="error">{{ $message }}</label>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row align-items-end">
                    <div class="col-12 col-lg-6">
                        <div class="form-group">
                            <label for="occupation_id">อาชีพ</label>
                            <select id="occupation_id" name="occupation_id"
                                class="form-select @error('occupation_id') is-invalid @enderror" required
                                data-toggle-select data-target="[data-occupation-other]" data-value="other">
                                <option value="" @selected(!old('occupation_id')) disabled>เลือก</option>
                                @foreach ($occupations as $ocu)
                                    <option value="{{ $ocu->id }}" @selected($ocu->id == old('organization_id'))>
                                        {{ $ocu->name }}
                                    </option>
                                @endforeach
                                <option value="other">อื่นๆ</option>
                            </select>
                            @error('occupation_id')
                                <label for="occupation_id" class="error">{{ $message }}</label>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div class="form-group">
                            <input id="occupation_other" name="occupation_other" value="{{ old('occupation_other') }}"
                                type="text" class="form-control @error('occupation_other') is-invalid @enderror"
                                placeholder="กรอกอาชีพของคุณ" data-occupation-other>
                            @error('occupation_other')
                                <label for="occupation_other" class="error">{{ $message }}</label>
                            @enderror
                        </div>
                    </div>
                </div>
                <div>
                    <h3 class="mt-4">ข้อมูลการเข้าร่วม</h3>
                    <div class="row align-items-end">
                        <div class="col-12 col-lg-6">
                            <div class="form-group">
                                <label for="organization_id">สถานที่ทำงาน/สถาบันการศึกษา/หน่วยงาน</label>
                                <select id="organization_id" name="organization_id"
                                    class="form-select @error('organization_id') is-invalid @enderror" required
                                    data-toggle-select data-target="[data-organization-other]" data-value="other">
                                    <option value="" @selected(!old('organization_id')) disabled>เลือก</option>
                                    @foreach ($organizations as $org)
                                        <option value="{{ $org->id }}" @selected($org->id == old('organization_id'))>
                                            {{ $org->name }}
                                        </option>
                                    @endforeach
                                    <option value="other">อื่นๆ</option>
                                </select>
                                @error('organization_id')
                                    <label for="organization_id" class="error">{{ $message }}</label>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 ">
                            <div class="form-group">
                                <input id="organization_other" name="organization_other"
                                    value="{{ old('organization_other') }}"
                                    class="form-control @error('organization_other') is-invalid @enderror" type="text"
                                    placeholder="กรอกสถานที่ทำงานของคุณ" data-organization-other>
                                @error('organization_other')
                                    <label for="organization_other" class="error">{{ $message }}</label>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-12">
                            <strong
                                class="fs-6 text-secondary">*ผู้สมัครที่ไม่ได้มาจากมหาวิทยาลัยที่เข้าร่วมต้องชำระค่าลงทะเบียน
                                100 บาท เพื่อเข้าร่วมหรือส่งผลงาน*</strong>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-lg-6">
                            <div class="form-group">
                                <label for="participation_type">ประเภทการเข้าร่วม</label>
                                <select name="participation_type" id="participation_type"
                                    class="form-select 
                                @error('participation_type') is-invalid @enderror"
                                    required data-toggle-select data-target="[data-presentation-type]"
                                    data-value="{{ ParticipationType::PRESENTER->value }}">
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
                                <label for="presentation_type" data-presentation-type-label>ประเภทการนำเสนอ</label>
                                <select id="presentation_type" name="presentation_type"
                                    class="form-select @error('presentation_type') is-invalid @enderror"
                                    data-presentation-type data-label="[data-presentation-type-label]">
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
                                <label for="special_requirements">ข้อจำกัดด้านอาหาร / ข้อมูลสุขภาพที่ควรทราบ
                                    (ถ้ามี)</label>
                                <input id="special_requirements" name="special_requirements"
                                    value="{{ old('special_requirements') }}" type="text"
                                    class="form-control @error('special_requirements') is-invalid @enderror"
                                    placeholder="เช่น มังสวิรัติ, ฮาลาล, แพ้ถั่ว, เบาหวาน">
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
    @vite('resources/js/pages/register.js')
@endpush
