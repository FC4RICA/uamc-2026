@extends('layouts.admin')
@section('title', 'แก้ไขบัญชีผู้ใช้งาน')
@section('user', 'active')

@section('content')
    <div class="container px-4 my-5">
        <div class="d-flex justify-content-between">
            <h2 class="fw-bold">ข้อมูลบัญชีผู้ใช้งาน</h2>
            <div class="d-flex">
                <form action=""
                    id="delete-user-form" class="mx-1" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger" id="submit-delete-user">
                        <i class="fa fa-lock me-2"></i>ปิดการใช้งานบัญชีผู้ใช้
                    </button>
                </form>
            </div>
        </div>
        <hr class="separator">

        <form id="edit-user-form" name="edit-user-form" action="{{ route('admin.user.update-email', $user) }}" method="POST">
            @csrf
            @method('PATCH')
            <h3 class="mt-4">ข้อมูลการเข้าใช้งาน</h3>
            <div class="form-group">
                <label>อีเมล</label>
                <input name="email" value="{{ $user->email }}" type="email"
                    class="form-control @error('email') is-invalid @enderror"
                    required>
                @error('email')
                    <label class="error">{{ $message }}</label>
                @enderror
            </div>

            <div class="text-center mt-4">
                <div class="form-group">
                    <button id="submit-edit-user" class="btn btn-warning" type="submit">แก้ไขอีเมล</button>
                    <button class="btn btn-danger" type="reset">รีเซ็ตการแก้ไข</button>
                </div>
            </div>
        </form>

        <h3 class="mt-4">ข้อมูลส่วนตัว</h3>
        <div class="row align-items-end">
            <div class="col-12 col-sm-6 form-group">
                <label for="user_title">คำนำหน้า</label>
                <input id="user_title" name="user_title" value="{{ $profile->title->label() }}"
                    class="form-control" disabled>
            </div>
            <div class="col-12 col-sm-6 form-group">
                <label for="user_academic_title">ตำแหน่งทางวิชาการ</label>
                <input id="user_academic_title" name="user_academic_title"
                    value="{{ $profile->academic_title->label() }}" class="form-control" disabled>
            </div>
            <div class="col-12 col-md-6 form-group">
                <label for="user_firstname">ชื่อ</label>
                <input id="user_firstname" name="user_firstname" value="{{ $profile->firstname }}"
                    class="form-control" disabled>
            </div>
            <div class="col-12 col-md-6 form-group">
                <label for=" user_lastname">นามสกุล</label>
                <input id="user_lastname" name="user_lastname" value="{{ $profile->lastname }}"
                    class="form-control" disabled>
            </div>
            <div class="col-12 col-md-6 form-group">
                <label for="user_education">ระดับการศึกษา</label>
                <input id="user_education" name="user_education" class="form-control" disabled
                    value="{{ $profile->education->label() }}">
            </div>
            <div class="col-12 col-md-6 form-group">
                <label for="user_phone">เบอร์โทร</label>
                <input id="user_phone" name="user_phone" value="{{ $profile->phone }}" class="form-control"
                    disabled>
            </div>
            <div class="col-12 col-md-6 form-group">
                <label for="user_occupation">อาชีพ</label>
                <input id="user_occupation" name="user_occupation" class="form-control" disabled
                    value="{{ $profile->occupation?->name ?? $profile->occupation_other }}">
            </div>
        </div>

        <h3 class="mt-4">ข้อมูลการเข้าร่วม</h3>
        <div class="row align-items-end">
            <div class="col-12 col-lg-6 form-group">
                <label for="participation_type">ประเภทการเข้าร่วม</label>
                <input name="participation_type" class="form-control" disabled
                    value="{{ $profile->participation_type->label() }}">
            </div>
            @if ($profile->presentation_type)
                <div class="col-12 col-lg-6 form-group">
                    <label for="presentation_type">ประเภทการนำเสนอ</label>
                    <input name="presentation_type" disabled class="form-control"
                        value="{{ $profile->presentation_type->label() }}">
                </div>
            @endif
            <div class="col-12 col-md-6 form-group">
                <label for="user_organization">สถานที่ทำงาน/สถาบันการศึกษา/หน่วยงาน</label>
                <input id="user_organization" name="user_organization" class="form-control" disabled
                    value="{{ $profile->organization?->name ?? $profile->organization_other }}">
            </div>
            @if ($profile->special_requirements)
                <div class="col-12 col-md-6 form-group">
                    <label for="special_requirements">ข้อจำกัดด้านอาหาร / ข้อมูลสุขภาพที่ควรทราบ</label>
                    <input id="special_requirements" name="special_requirements" disabled class="form-control"
                        value="{{ $profile->special_requirements }}">
                </div>
            @endif
        </div>

        <div class="text-center mt-4">
            <a class="btn btn-warning" href="{{ route('admin.profile.edit', $profile) }}">ไปยังหน้าแก้ไขข้อมูล</a>
        </div>
    </div>

@endsection

@push('scripts')
    @vite('resources/js/pages/admin/user.js')
@endpush