@extends('layouts.admin')
@section('title', 'จัดการบทความ')
@section('submission', 'active')

@section('content')
<div class="container px-4 mt-4 mb-5">
    <div class="d-flex justify-content-between">
        <h2 class="fw-bold">ข้อมูลบทคัดย่อ</h2>
        <div class="d-flex">
            <div class="mx-1">
                <a href="{{ route('admin.submission.folder', $submission) }}" class="btn btn-primary">ดูไฟล์ในไดรฟ์</a>
            </div>
            <div class="mx-1">
                <a href="{{ route('admin.submission.edit', $submission) }}" class="btn btn-warning">แก้ไขข้อมูล</a>
            </div>
            <form action="{{ route('admin.submission.delete', $submission) }}"
                id="delete-submission-form" class="mx-1" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" id="submit-delete-submission">
                    ลบบทคัดย่อ
                </button>
            </form>
        </div>
    </div>
    <hr class="separator">

    <h5 class="mt-4 text">ID: {{ $submission->id }}</h5>

    {{-- <form class="row align-items-end">
        <div class="col-12 col-lg-6">
            <div class="form-group m-0">
                <label for="">สถานะ</label>
                <select class="form-select fs-6" disabled
                    value="{{ $submission->presentation_type->label() }}">
                </select>
            </div>
        </div>
        <div class="col-12 col-lg-6">
            <button class="btn btn-info">อัพเดต</button>
        </div>
    </form> --}}

    <h3 class="mt-4">กลุ่มบทคัดย่อ</h3>
    <div class="row">
        <div class="col-12 col-lg-6">
            <div class="form-group">
                <label for="">ประเภทบทคัดย่อ</label>
                <input class="form-control-plaintext fs-6" disabled
                    value="{{ $submission->presentation_type->label() }}">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-lg-6">
            <div class="form-group">
                <label>สาขาของผลงาน</label>
                <input class="form-control-plaintext fs-6" disabled
                    value="{{ $submission->abstractGroups[0]->name }}">
                </select>
            </div>
        </div>
        <div class="col-12 col-lg-6">
            <div class="form-group">
                <label>สาขาของผลงาน (สำรอง)</label>
                <input class="form-control-plaintext fs-6" disabled
                    value="{{ $submission->abstractGroups[1]?->name ?? 'ไม่เลือก' }}">
                </select>
            </div>
        </div>
    </div>

    <h3 class="mt-4">ข้อมูลบทคัดย่อ</h3>
    <div class="row">
        <div class="col-12">
            <div class="form-group">
                <label>ชื่อบทคัดย่อภาษาไทย</label>
                <input value="{{ $submission->title_th }}"
                    class="form-control-plaintext fs-6" disabled>
            </div>
        </div>
        <div class="col-12">
            <div class="form-group">
                <label>ชื่อบทคัดย่อภาษาอังกฤษ</label>
                <input value="{{ $submission->title_en }}"
                    class="form-control-plaintext fs-6" disabled>
            </div>
        </div>
        <div class="col-12">
            <div class="form-group">
                <label>คำสำคัญ (Keyword)</label>
                <input value="{{ $submission->keywords }}"
                    class="form-control-plaintext fs-6" disabled>
            </div>
        </div>
        <div class="col-12">
            <div class="form-group">
                <label>บทคัดย่อ</label>
                <div class="mt-1 mb-2 d-flex gap-3">
                    @foreach ($submission->abstractFiles as $abstract)
                        <a href="{{ route('member.submission.file.download', $abstract) }}" class="fs-6 text fw-bold">
                            {{ $abstract->original_file_name }}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <hr class="separator my-4">
    <h3 class="mt-4">ข้อมูลผู้จัดทำ</h3>

    <div id="participants" class="card mb-4">
        <h4 class="card-header">ผู้ส่งผลงาน</h4>
        <div class="card-body row align-items-end">
            <div class="col-12 form-group">
                <label for=" user_email">อีเมล</label>
                <input id="user_email" name="user_email" value="{{ $submission->user->email }}"
                    class="form-control" disabled>
            </div>
            <div class="col-12 col-sm-6 col-xl-2 form-group">
                <label for="user_title">คำนำหน้า</label>
                <input id="user_title" name="user_title" value="{{ $submission->user->profile->title->label() }}"
                    class="form-control" disabled>
            </div>
            <div class="col-12 col-sm-6 col-xl-2 form-group">
                <label for="user_academic_title">ตำแหน่งทางวิชาการ</label>
                <input id="user_academic_title" name="user_academic_title"
                    value="{{ $submission->user->profile->academic_title->label() }}" class="form-control" disabled>
            </div>
            <div class="col-12 col-md-6 col-xl-4 form-group">
                <label for="user_firstname">ชื่อ</label>
                <input id="user_firstname" name="user_firstname" value="{{ $submission->user->profile->firstname }}"
                    class="form-control" disabled>
            </div>
            <div class="col-12 col-md-6 col-xl-4 form-group">
                <label for=" user_lastname">นามสกุล</label>
                <input id="user_lastname" name="user_lastname" value="{{ $submission->user->profile->lastname }}"
                    class="form-control" disabled>
            </div>
            <div class="col-12 col-md-6 col-xl-3 form-group">
                <label for="user_education">ระดับการศึกษา</label>
                <input id="user_education" name="user_education" class="form-control" disabled
                    value="{{ $submission->user->profile->education->label() }}">
            </div>
            <div class="col-12 col-md-6 col-xl-3 form-group">
                <label for="user_phone">เบอร์โทร</label>
                <input id="user_phone" name="user_phone" value="{{ $submission->user->profile->phone }}" class="form-control"
                    disabled>
            </div>
            <div class="col-12 col-md-6 col-xl-3 form-group">
                <label for="user_occupation">อาชีพ</label>
                <input id="user_occupation" name="user_occupation" class="form-control" disabled
                    value="{{ $submission->user->profile->occupation?->name ?? $submission->user->profile->occupation_other }}">
            </div>
            <div class="col-12 col-md-6 col-xl-3 form-group">
                <label for="user_organization">สถานที่ทำงาน/สถาบันการศึกษา/หน่วยงาน</label>
                <input id="user_organization" name="user_organization" class="form-control" disabled
                    value="{{ $submission->user->profile->organization?->name ?? $submission->user->profile->organization_other }}">
            </div>
            @if ($submission->user->profile->special_requirements)
                <div class="col-12 col-md-6 form-group">
                    <label for="special_requirements">ข้อจำกัดด้านอาหาร / ข้อมูลสุขภาพที่ควรทราบ</label>
                    <input id="special_requirements" name="special_requirements" disabled class="form-control"
                        value="{{ $submission->user->profile->special_requirements }}">
                </div>
            @endif
        </div>
    </div>

    <div id="participants-container">
        @foreach ($submission->participants as $index => $data)
            <x-participant-form :index="$index" :profile="$data->toArray()" :disabled="true"/>
        @endforeach
    </div>
</div>
@endsection

@push('scripts')
    @vite('resources/js/pages/admin/view-submission.js')
@endpush