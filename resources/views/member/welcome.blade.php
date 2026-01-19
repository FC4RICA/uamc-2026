@extends('layouts.member')
@section('title', 'หน้าแรกสมาชิก')

@section('home', 'active')

@section('content')
<div class="container px-4 py-5 ">
    <h1 class="text-center">สวัสดี {{ Auth::user()->profile->firstname .' '. Auth::user()->profile->lastname }}</h1>
    @if (Auth::user()->needsPayment())
        <div class="mt-4 text-danger text-center">
            <strong>*การลงทะเบียนของคุณยังไม่เสร็จสิ้น กรุณาชำระค่าลงทะเบียนเพื่อเข้าร่วมหรือส่งผลงาน*</strong>
        </div>
    @endif
    <div class="my-5">
        <div class="row ">
            @if(Auth::user()->canSubmitAbstract())
                <div class="col-4 text-center m-auto">
                    <a href="{{ route('member.submission.create') }}">
                        <div class="circle mx-auto">
                            <i class="fas fa-book fa-2x" style="margin-top: 10%;"></i>
                        </div>
                        <label>ส่งบทคัดย่อ</label>
                    </a>
                </div>
            @endif
            @if (Auth::user()->hasSubmission())
                <div class="col-4 text-center m-auto">
                    <a href="{{ route('member.submission.index') }}">
                        <div class="circle mx-auto">
                            <i class="fas fa-clipboard-check fa-2x" style="margin-top: 10%;"></i>
                        </div>
                        <label>ตรวจสอบการส่งบทความและผลการพิจารณา</label>
                    </a>
                </div>
            @endif
            <div class="col-4 text-center m-auto">
                <a href="{{ route('member.profile.index') }}">
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