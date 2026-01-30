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

            <h3 class="mt-4">ข้อมูลการเข้าใช้งาน</h3>
            <div class="form-group">
                <label>อีเมล</label>
                <input name="email" value="{{ old('email') }}" type="email" autocomplete="username"
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

            <h3 class="mt-4">ข้อมูลส่วนตัว</h3>
            <div class="row">
                <div class="col-12 col-lg-6 form-group">
                    <label>คำนำหน้า</label>
                    <select name="title" required 
                        class="form-select @error('title') is-invalid @enderror">
                        <option value="" @selected(!old('title')) disabled>เลือก</option>
                        @foreach ($titles as $title)
                            <option value="{{ $title->value }}" 
                                @selected($title->value == old('title'))>
                                {{ $title->label() }}
                            </option>
                        @endforeach
                    </select>
                    @error('title')
                        <label class="error">{{ $message }}</label>
                    @enderror
                </div>
                <div class="col-12 col-lg-6 form-group">
                    <label>ตำแหน่งทางวิชาการ</label>
                    <select name="academic_title" required
                        class="form-select @error('academic_title') is-invalid @enderror">
                        <option value="" @selected(!old('academic_title')) disabled>เลือก</option>
                        @foreach ($academicTitles as $title)
                            <option value="{{ $title->value }}" 
                                @selected($title->value == old('academic_title'))>
                                {{ $title->label() }}
                            </option>
                        @endforeach
                    </select>
                    @error('academic_title')
                        <label class="error">{{ $message }}</label>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-lg-6 form-group">
                    <label>ชื่อ</label>
                    <input name="firstname" value="{{ old('firstname') }}" type="text" required
                        class="form-control @error('firstname') is-invalid @enderror" placeholder="ชื่อ" >
                    @error('firstname')
                        <label class="error">{{ $message }}</label>
                    @enderror
                </div>
                <div class="col-12 col-lg-6 form-group">
                    <label>นามสกุล</label>
                    <input name="lastname" value="{{ old('lastname') }}" type="text" required
                        class="form-control @error('lastname') is-invalid @enderror" placeholder="นามสกุล">
                    @error('lastname')
                        <label class="error">{{ $message }}</label>
                    @enderror
                </div>
            </div>

            <h3 class="mt-4">ข้อมูลการศึกษา การทำงาน</h3>
            <div class="row">
                <div class="col-12 col-lg-6 form-group">
                    <label>ระดับการศึกษา</label>
                    <select name="education" required
                        class="form-select @error('education') is-invalid @enderror">
                        <option value="" @selected(!old('education')) disabled>เลือก</option>
                        @foreach ($education as $ed)
                            <option value="{{ $ed->value }}" @selected($ed->value == old('education'))>
                                {{ $ed->label() }}
                            </option>
                        @endforeach
                    </select>
                    @error('education')
                        <label class="error">{{ $message }}</label>
                    @enderror
                </div>
                <div class="col-12 col-lg-6 form-group">
                    <label>เบอร์โทร</label>
                    <input name="phone" value="{{ old('phone') }}" type="tel" placeholder="เบอร์โทร"
                        class="form-control @error('phone') is-invalid @enderror" required>
                    @error('phone')
                        <label class="error">{{ $message }}</label>
                    @enderror
                </div>
            </div>
            <div class="row align-items-end">
                <div class="col-12 col-lg-6 form-group">
                    <label>อาชีพ</label>
                    <select name="occupation_id" data-value="other" required
                        class="form-select @error('occupation_id') is-invalid @enderror" 
                        data-toggle-select data-target="[data-occupation-other]">
                        <option value="" @selected(!old('occupation_id')) disabled>เลือก</option>
                        @foreach ($occupations as $ocu)
                            <option value="{{ $ocu->id }}" 
                                @selected($ocu->id == old('organization_id'))>
                                {{ $ocu->name }}
                            </option>
                        @endforeach
                        <option value="other">อื่นๆ</option>
                    </select>
                    @error('occupation_id')
                        <label class="error">{{ $message }}</label>
                    @enderror
                </div>
                <div class="col-12 col-lg-6 form-group">
                    <input name="occupation_other" value="{{ old('occupation_other') }}"
                        class="form-control @error('occupation_other') is-invalid @enderror"
                        placeholder="กรอกอาชีพของคุณ" data-occupation-other type="text">
                    @error('occupation_other')
                        <label class="error">{{ $message }}</label>
                    @enderror
                </div>
            </div>

            <h3 class="mt-4">ข้อมูลการเข้าร่วม</h3>
            <div class="row mb-3">
                <div class="col-12">
                    <ul class="mb-2">
                        <li>ค่าลงทะเบียน 100 บาท ต่อ คน</li>
                        <li>ธนาคารกรุงศรีอยุทยา ชื่อบัญชี: มจธ.-บริการวิชาการ เลขที่บัญชี 693-0-43369-1</li>
                    </ul>
                    <strong
                        class="fs-6 text-secondary">*สำหรับผู้เข้าร่วมจากมหาวิทยาลัยเจ้าภาพร่วม ได้แก่
                        มหาวิทยาลัยศิลปากร สถาบันเทคโนโลยีพระจอมเกล้าเจ้าคุณทหารลาดกระบัง
                        มหาวิทยาลัยเทคโนโลยีพระจอมเกล้าพระนครเหนือ และ มหาวิทยาลัยเทคโนโลยีสุรนารี
                        <u>โปรดติดต่อผู้ประสานของมหาวิทยาลัยเจ้าภาพร่วม ก่อนชำระค่าลงทะเบียน</u>
                    </strong>
                </div>
            </div>
            <div class="row align-items-end">
                <div class="col-12 col-lg-6 form-group">
                    <label>สถานที่ทำงาน/สถาบันการศึกษา/หน่วยงาน</label>
                    <select name="organization_id" data-value="other" required
                        class="form-select @error('organization_id') is-invalid @enderror" 
                        data-toggle-select data-target="[data-organization-other]" >
                        <option value="" @selected(!old('organization_id')) disabled>เลือก</option>
                        @foreach ($organizations as $org)
                            <option value="{{ $org->id }}" 
                                @selected($org->id == old('organization_id'))>
                                {{ $org->name }}
                            </option>
                        @endforeach
                        <option value="other">อื่นๆ</option>
                    </select>
                    @error('organization_id')
                        <label class="error">{{ $message }}</label>
                    @enderror
                </div>
                <div class="col-12 col-lg-6 form-group">
                    <input name="organization_other"
                        value="{{ old('organization_other') }}" type="text"
                        class="form-control @error('organization_other') is-invalid @enderror" 
                        placeholder="กรอกสถานที่ทำงานของคุณ" data-organization-other>
                    @error('organization_other')
                        <label class="error">{{ $message }}</label>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-lg-6 form-group">
                    <label>ประเภทการเข้าร่วม</label>
                    <select name="participation_type" data-target="[data-presentation-type]"
                        class="form-select @error('participation_type') is-invalid @enderror"
                        required data-toggle-select data-value="{{ ParticipationType::PRESENTER->value }}">
                        <option value="" @selected(!old('participation_type')) disabled>เลือก</option>
                        @foreach ($participationType as $role)
                            <option value="{{ $role->value }}" 
                                @selected($role->value == old('participation_type'))>
                                {{ $role->label() }}
                            </option>
                        @endforeach
                    </select>
                    @error('participation_type')
                        <label class="error">{{ $message }}</label>
                    @enderror
                </div>
                <div class="col-12 col-lg-6 form-group">
                    <label data-presentation-type-label>ประเภทการนำเสนอ</label>
                    <select name="presentation_type" data-presentation-type
                        class="form-select @error('presentation_type') is-invalid @enderror"
                        data-label="[data-presentation-type-label]">
                        <option value="" @selected(!old('presentation_type')) disabled>เลือก</option>
                        @foreach ($presentationType as $type)
                            <option value="{{ $type->value }}"
                                @selected($type->value == old('presentation_type'))>
                                {{ $type->label() }}
                            </option>
                        @endforeach
                    </select>
                    @error('presentation_type')
                        <label for="presentation_type" class="error">{{ $message }}</label>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-lg-6 form-group">
                    <label>
                        ข้อจำกัดด้านอาหาร / ข้อมูลสุขภาพที่ควรทราบ (ถ้ามี)
                    </label>
                    <input name="special_requirements" value="{{ old('special_requirements') }}"
                        class="form-control @error('special_requirements') is-invalid @enderror"
                        placeholder="เช่น มังสวิรัติ, ฮาลาล, แพ้ถั่ว, เบาหวาน" type="text">
                    @error('special_requirements')
                        <label class="error">{{ $message }}</label>
                    @enderror
                </div>
            </div>
            <div style="overflow:auto;">
                <div style="float:right;">
                    <button id="submit-btn" type="submit" class="btn btn-warning">ยืนยัน</button>
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
