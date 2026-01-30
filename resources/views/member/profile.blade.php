@php
    use App\Enums\ParticipationType;
@endphp

@extends('layouts.member')
@section('title', 'แก้ไขข้อมูล')

@section('profile', 'active')

@section('content')
    <div class="container px-4 my-5">
        <div class="text-center">
            <h2><strong>แก้ไขข้อมูล</strong></h2>
        </div>
        <hr class="separator">
        <form id="edit-profile-form" name="edit-profile-form" action="{{ route('member.profile.update') }}" method="POST">
            @csrf
            @method('PUT')
            {{-- <h3 class="mt-4">ข้อมูลการเข้าใช้งาน</h3>
            <div class="form-group">
                <label>อีเมล</label>
                <input name="email" value="{{ $user->email }}" type="email"
                    class="form-control @error('email') is-invalid @enderror"
                    required>
                @error('email')
                    <label class="error">{{ $message }}</label>
                @enderror
            </div> --}}

            <h3 class="mt-4">ข้อมูลส่วนตัว</h3>
            <div class="row">
                <div class="col-12 col-lg-6 form-group">
                    <label>คำนำหน้า</label>
                    <select name="title" required
                        class="form-select @error('title') is-invalid @enderror">
                        @foreach ($titles as $title)
                            <option value="{{ $title->value }}" 
                                @selected($title->value == $profile->title->value)>
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
                    <select name="academic_title"
                        class="form-select @error('academic_title') is-invalid @enderror" required>
                        @foreach ($academicTitles as $title)
                            <option value="{{ $title->value }}" 
                                @selected($title->value == $profile->academic_title->value)>
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
                    <input name="firstname" value="{{ $profile->firstname }}" type="text" 
                        class="form-control @error('firstname') is-invalid @enderror"  required>
                    @error('firstname')
                        <label class="error">{{ $message }}</label>
                    @enderror
                </div>
                <div class="col-12 col-lg-6 form-group">
                    <label>นามสกุล</label>
                    <input name="lastname" value="{{ $profile->lastname }}" type="text"
                        class="form-control @error('lastname') is-invalid @enderror" required>
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
                        class="form-select @error('education') is-invalid @enderror" >
                        @foreach ($education as $ed)
                            <option value="{{ $ed->value }}" 
                                @selected($ed->value == $profile->education->value)>
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
                    <input name="phone" value="{{ $profile->phone }}" type="tel" required
                        class="form-control @error('phone') is-invalid @enderror" placeholder="เบอร์โทร">
                    @error('phone')
                        <label class="error">{{ $message }}</label>
                    @enderror
                </div>
            </div>
            <div class="row align-items-end">
                <div class="col-12 col-lg-6 form-group">
                    <label>อาชีพ</label>
                    <select name="occupation_id"
                        class="form-select @error('occupation_id') is-invalid @enderror" required
                        data-toggle-select data-target="[data-occupation-other]" data-value="other">
                        @foreach ($occupations as $ocu)
                            <option value="{{ $ocu->id }}" 
                                @selected($ocu->id == $profile->organization_id)>
                                {{ $ocu->name }}
                            </option>
                        @endforeach
                        <option value="other" @selected($profile->occupation_other)>อื่นๆ</option>
                    </select>
                    @error('occupation_id')
                        <label for="occupation_id" class="error">{{ $message }}</label>
                    @enderror
                </div>
                <div class="col-12 col-lg-6 form-group">
                    <input name="occupation_other" value="{{ $profile->occupation_other }}"
                        type="text" class="form-control @error('occupation_other') is-invalid @enderror"
                        placeholder="กรอกอาชีพของคุณ" data-occupation-other>
                    @error('occupation_other')
                        <label class="error">{{ $message }}</label>
                    @enderror
                </div>
            </div>

            <h3 class="mt-4">ข้อมูลการเข้าร่วม</h3>
            <div class="row align-items-end">
                <div class="col-12 col-lg-6 form-group">
                    <label>สถานที่ทำงาน/สถาบันการศึกษา/หน่วยงาน</label>
                    <select name="organization_id" data-value="other" required
                        class="form-select @error('organization_id') is-invalid @enderror" 
                        data-toggle-select data-target="[data-organization-other]" >
                        @foreach ($organizations as $org)
                            <option value="{{ $org->id }}" @selected($org->id == $profile->organization_id)>
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
                        value="{{ $profile->organization_other }}" type="text"
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
                        required data-toggle-select data-value="{{ ParticipationType::PRESENTER->value }}"
                        @disabled($user->hasSubmission())>
                        @foreach ($participationType as $role)
                            <option value="{{ $role->value }}" 
                                @selected($role->value == $profile->participation_type->value)>
                                {{ $role->label() }}
                            </option>
                        @endforeach
                    </select>
                    @error('participation_type')
                        <label for="participation_type" class="error">{{ $message }}</label>
                    @enderror
                </div>
                <div class="col-12 col-lg-6 form-group">
                    <label data-presentation-type-label>ประเภทการนำเสนอ</label>
                    <select name="presentation_type" data-presentation-type
                        class="form-select @error('presentation_type') is-invalid @enderror"
                        data-label="[data-presentation-type-label]"
                        @disabled($user->hasSubmission())>
                        @foreach ($presentationType as $type)
                            <option value="{{ $type->value }}"
                                @selected($type == $profile->presentation_type->value)>
                                {{ $type->label() }}
                            </option>
                        @endforeach
                    </select>
                    @error('presentation_type')
                        <label class="error">{{ $message }}</label>
                    @enderror
                </div>
                @if ($user->hasSubmission())
                    <div class="col-12 fs-6 text-danger fw-bold mb-4">
                        *ไม่สามารถแก้ไขได้ระหว่างการส่งบทคัดย่อ กรุณายกเลิกการส่งบทคัดย่อเพื่อแก้ไข*
                    </div>
                @endif
            </div>
            <div class="row">
                <div class="col-12 col-lg-6 form-group">
                    <label>
                        ข้อจำกัดด้านอาหาร / ข้อมูลสุขภาพที่ควรทราบ (ถ้ามี)
                    </label>
                    <input name="special_requirements" value="{{ $profile->special_requirements }}"
                        class="form-control @error('special_requirements') is-invalid @enderror"
                        placeholder="เช่น มังสวิรัติ, ฮาลาล, แพ้ถั่ว, เบาหวาน" type="text">
                    @error('special_requirements')
                        <label class="error">{{ $message }}</label>
                    @enderror
                </div>
            </div>

            {{-- <h3  class="mt-4">ระบุรหัสผ่านเพื่อเปลี่ยนแปลงข้อมูล</h3>
            <div class="form-group">
                <label for="password">รหัสผ่าน</label>
                <input id="password" name="password" type="password" class="form-control" placeholder="รหัสผ่าน"
                    require>
            </div>
            <div class="form-group">
                <label for="confirmpassword">ยืนยันรหัสผ่าน</label>
                <input id="confirmpassword" name="confirmpassword" type="password" class="form-control"
                    placeholder="รหัสผ่าน" require>
            </div> --}}

            <div class="text-center mt-4">
                <div class="form-group">
                    <button id="submit-profile" class="btn btn-warning" type="submit">แก้ไขข้อมูล</button>
                    <button class="btn btn-danger" type="reset">รีเซ็ตการแก้ไข</button>
                </div>
            </div>
        </form>
    </div>

@endsection

@push('scripts')
    @vite('resources/js/pages/member/profile.js')
@endpush