@extends('layouts.member')

@section('title', 'ตรวจสอบผลการพิจารณา')
@section('check', 'active')

@section('content')
    <div class="container px-4 mt-4 mb-5">
        <div class="text-center">
            <h2 class="fw-bold">ตรวจสอบผลการพิจารณา</h2>
        </div>

        <div class="text-center mt-4 mb-5">
            {{-- TODO: add publish status to access control --}}
            @if (true) 
                @switch($submission->status)
                    @case(\App\Enums\SubmissionStatus::PENDING)
                        อยู่ในระหว่างการตรวจสอบ
                    @break

                    @case(\App\Enums\SubmissionStatus::ACCEPTED)
                        <h3 class="text-success fw-bold">
                            ผลงานของท่านได้รับการพิจารณาให้เข้าร่วมนำเสนอ</br>
                            กรุณาส่งเอกสารเพิ่มเติมสำหรับการนำเสนอ
                        </h3>
                        @if ($user->canSubmitFinal())
                            <h5>
                                <a href="{{ route('member.submission.final.index') }}" 
                                    class="btn btn-success my-2">
                                    ไปยังหน้าส่งเอกสารเพิ่มเติม
                                </a>
                            </h5>
                        @endif
                    @break

                    @case(\App\Enums\SubmissionStatus::REJECTED)
                        <h3 class="text-danger fw-bold">
                            ขอแสดงความเสียใจ บทความของคุณไม่ได้รับคัดเลือก
                        </h3>
                    @break

                    @case(\App\Enums\SubmissionStatus::REVISE_REQUIRED)
                        <h3 class="text-primary fw-bold">
                            ผู้ประเมินได้ขอให้คุณแก้ไขบทคัดย่อตามข้อเสนอแนะ #{{ $submission->current_revision_round }}</br>
                        </h3>
                        <h5>
                            <a href="{{ route('member.submission.abstract.revision', $submission->activeRevision) }}">
                                ไปยังหน้ารายละเอียดการแก้ไขบทคัดย่อ
                            </a>
                        </h5>
                    @break
                @endswitch
            @else
                ขณะนี้ยังไม่มีการประกาศผลการคัดเลือก
            @endif
        </div>

        <hr class="separator">

        <div class="d-flex justify-content-between">
            <h2 class="fw-bold">ข้อมูลบทคัดย่อ</h2>
            <div class="d-flex">
                <div class="mx-1">
                    <a href="{{ route('member.submission.abstract.edit', $submission) }}" class="btn btn-outline-secondary">
                        <i class="fa fa-edit me-2"></i>แก้ไขข้อมูล
                    </a>
                </div>
            </div>
        </div>

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
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="form-group">
                    <label>สาขาของผลงาน (สำรอง)</label>
                    <input class="form-control-plaintext fs-6" disabled
                        value="{{ $submission->abstractGroups[1]?->name ?? 'ไม่เลือก' }}">
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
                            <x-submission-file-card :file="$abstract" />
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        @if ($submission->participants()->exists())
            <hr class="separator my-4">
            <h3 class="mt-4">ข้อมูลผู้จัดทำ</h3>

            <div id="participants-container">
                @foreach ($submission->participants as $index => $data)
                    <x-participant-form :index="$index" :profile="$data->toArray()" :disabled="true"/>
                @endforeach
            </div>
        @endif

        @if ($submission->hasRevision())
            <hr class="separator my-4">

            @foreach ($submission->revisions->reverse() as $revision)
                <x-revision-card :revision="$revision" />
            @endforeach

            @if ($submission->hasActiveRevision())
            <div class="text-center">
                <a href="{{ route('member.submission.abstract.revision', $submission->activeRevision) }}"
                    class="btn btn-warning">
                    อัพโหลดไฟล์บทคัดย่อ
                </a>
            </div>
            @endif
        @endif
    </div>
@endsection