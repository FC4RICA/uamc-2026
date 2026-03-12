@extends('layouts.member')
@section('title', 'หน้าแรกสมาชิก')

@section('home', 'active')

@section('content')
    <div class="container px-4 py-5 ">
        <h1 class="text-center">สวัสดี {{ $user->profile->firstname . ' ' . $user->profile->lastname }}</h1>

        {{-- registration and submission status --}}
        <div class="mt-4 text-center">
            {{-- registration --}}
            <p class="fw-bold">
                @if ($user->payment_required)
                    @if ($user->needsPayment())
                        <span class="text-danger">
                            *การลงทะเบียนของคุณยังไม่เสร็จสิ้น กรุณาชำระค่าลงทะเบียนเพื่อเข้าร่วมหรือส่งผลงาน*
                        </span>
                    @elseif (! $user->hasVerifiedPayment())
                        @if ($user->paymentsRejected())
                            <span class="text-danger">
                                *หลักฐานการชำระเงินของคุณถูกปฏิเสธ กรุณาตรวจสอบและอัพโหลดใหม่อีกครั้ง*
                            </span>
                        @else
                            <span class="text-success">
                                *การลงทะเบียนเสร็จสิ้น คุณได้ส่งหลักฐานการชำระเงินเรียบร้อยแล้ว การตรวจสอบหลักฐานจะใช้เวลา 3-4 วัน*
                            </span>
                        @endif
                    @endif
                @endif
            </p>

            {{-- submission status --}}
            @if ($user->submission?->hasActiveRevision())
                <h3 class="text-primary fw-bold">
                    ผู้ประเมินได้ขอให้คุณแก้ไขบทคัดย่อตามข้อเสนอแนะ #{{ $user->submission->current_revision_round }}</br>
                </h3>
                <h5>
                    <a href="{{ route('member.submission.abstract.revision', $user->submission->activeRevision) }}"
                        class="btn btn-primary my-2">
                        ไปยังหน้ารายละเอียดการแก้ไขบทคัดย่อ
                    </a>
                </h5>
            @endif
            @finalSubmissionOpen
                @if ($user->canSubmitFinal())
                    <h3 class="text-success fw-bold">
                        ผลงานของท่านได้รับการพิจารณาให้เข้าร่วมนำเสนอ</br>
                        กรุณาส่งเอกสารเพิ่มเติมสำหรับการนำเสนอ
                    </h3>
                    <h5>
                        <a href="{{ route('member.submission.final.index') }}" 
                            class="btn btn-success my-2">
                            ไปยังหน้าส่งเอกสารเพิ่มเติม
                        </a>
                    </h5>
                @endif
            @endfinalSubmissionOpen
        </div>

        <div class="my-5">
            <div class="row ">
                @finalSubmissionOpen
                    @if (Auth::user()->canSubmitFinal())
                        <div class="col-4 text-center m-auto">
                            <a href="{{ route('member.submission.final.index') }}">
                                <div class="circle mx-auto">
                                    <i class="fas fa-book fa-2x" style="margin-top: 10%;"></i>
                                </div>
                                <label>ส่งเอกสารรอบที่ 2</label>
                            </a>
                        </div>
                    @endif
                @endfinalSubmissionOpen
                @abstractSubmissionOpen
                    @if ($user->canSubmitAbstract())
                        <div class="col-4 text-center m-auto">
                            <a href="{{ route('member.submission.abstract.create') }}">
                                <div class="circle mx-auto">
                                    <i class="fas fa-book fa-2x" style="margin-top: 10%;"></i>
                                </div>
                                <label>ส่งบทคัดย่อ</label>
                            </a>
                        </div>
                    @endif
                @endabstractSubmissionOpen
                @if ($user->hasSubmission())
                    <div class="col-4 text-center m-auto">
                        <a href="{{ route('member.submission.abstract.index') }}">
                            <div class="circle mx-auto">
                                <i class="fas fa-clipboard-check fa-2x" style="margin-top: 10%;"></i>
                            </div>
                            <label>ตรวจสอบการส่งบทคัดย่อและผลการพิจารณา</label>
                        </a>
                    </div>
                @endif
                <div class="col-4 text-center m-auto">
                    <a href="{{ route('member.profile.edit') }}">
                        <div class="circle mx-auto text-center">
                            <i class="fas fa-user-edit fa-2x" style="margin-top: 10%;"></i>
                        </div>
                        <label>แก้ไขข้อมูลส่วนตัว</label>
                    </a>
                </div>
            </div>
        </div>
        <div class="my-5 d-grid gap-5">
            @include('components.schedule', ['showLineBreak' => true])
            @include('components.timetable', ['showLineBreak' => true])
        </div>
    </div>
@endsection
