@php
    use App\Enums\ParticipationType;
@endphp

@extends('layouts.member')
@section('title', 'หน้าแรกสมาชิก')

@section('home', 'active')

@section('content')
<div class="container">
    <h1 class="text-center mt-5">สวัสดี {{ Auth::user()->name .' '. Auth::user()->lastname }}</h1>
    <div class="my-5">
        <div class="row">
            @if(in_array(Auth::user()->participation_type, [ParticipationType::Oral, ParticipationType::Poster]))
                <div class="col-4 text-center">
                    <a href="{{ route('member.submission.create') }}">
                        <div class="circle mx-auto">
                            <i class="fas fa-book fa-2x" style="margin-top: 10%;"></i>
                        </div>
                        <label>ระบบส่งบทความ</label>
                    </a>
                </div>
                <div class="col-4 text-center">
                    <a href="{{ route('member.submission.index') }}">
                        <div class="circle mx-auto">
                            <i class="fas fa-clipboard-check fa-2x" style="margin-top: 10%;"></i>
                        </div>
                        <label>ตรวจสอบการส่งบทความและผลการพิจารณา</label>
                    </a>
                </div>
            @endif
            <div class="col-4 text-center">
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