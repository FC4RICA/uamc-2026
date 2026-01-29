@extends('layouts.member')
@section('title', 'หน้าแรกสมาชิก')

@section('home', 'active')

@section('content')
    <div class="container px-4 py-5 ">
        <h1 class="text-center">สวัสดี {{ $user->profile->firstname . ' ' . $user->profile->lastname }}</h1>
        @if ($user->payment_required)
            @if ($user->needsPayment())
                <div class="mt-4 text-danger text-center">
                    <strong>*การลงทะเบียนของคุณยังไม่เสร็จสิ้น กรุณาชำระค่าลงทะเบียนเพื่อเข้าร่วมหรือส่งผลงาน*</strong>
                </div>
            @elseif (! $user->hasVerifiedPayment())
                <div class="mt-4 text-success text-center">
                    <strong>*การลงทะเบียนเสร็จสิ้น คุณได้ส่งหลักฐานการชำระเงินเรียบร้อยแล้ว การตรวจสอบหลักฐานจะใช้เวลา 3-4 วัน*</strong>
                </div>
            @endif
        @endif
        <div class="my-5">
            <div class="row ">
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
        @include('components.schedule', ['showLineBreak' => true])
        @include('components.timetable', ['showLineBreak' => true])
    </div>
@endsection
