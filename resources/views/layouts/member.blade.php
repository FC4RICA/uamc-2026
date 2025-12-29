@extends('layouts.base')

@section('header')
<div class="header">
    <span class="topbar">The 9th Undergraduate in Applied Mathematics Conference</span>
    @include('partials.nav-member')
</div>
@endsection

@section('body')
<div id="myContainer" class="row no-gutters">
    <div id="membermenu" class="col-12 col-lg-2 Menu">
        @include('partials.sidebar-member')
    </div>

    <div class="col-12 col-lg-10 Board overflow-auto">
        @include('partials.carousel')
        @yield('content')
    </div>
</div>
@endsection

{{-- <!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script type="text/javascript" src="{{ asset('js/bootstrap.js') }}" defer></script>
    <script type="text/javascript" src="{{ asset('js/jquery-3.4.1.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/popper.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/jquery.validate.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/additional-methods.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/control.js') }}" defer></script>
    <script type="text/javascript" src="{{ asset('js/form-validate.js') }}" defer></script>
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.css') }}" >
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <title>@yield('title')</title>
</head>

<body>
    <div class="header">
        <span class="topbar">The 9th Undergraduate in Applied Mathematics Conference</span>
        <nav id="memberMode" class="navbar navbar-expand-lg navbar-dark">
            <div class="container">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <a class="navbar-brand" href="/"><img src="{{ asset('img/60year-fsci.png') }}" alt="kmutt-fsci"></a>

                <div class="collapse navbar-collapse" id="navbarSupportedContent" lang="th">
                    <ul class="navbar-nav">
                        <li class="nav-item @yield('home')">
                            <a href="{{ url('member') }}" class="nav-link">หน้าแรก</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/') }}" class="nav-link">กลับหน้าเว็บหลัก</a>
                        </li>
                        <li class="nav-item @yield('profile')">
                            <a href="{{ url('member/profile') }}" class="nav-link">ข้อมูลส่วนตัว</a>
                        </li>
                        <?php
                        // $type = Auth::guard('member')->user()->type;

                        // if ($type == 2 || $type == 3) {
                        ?>
                            <li class="nav-item @yield('check')">
                                <a href="{{ url('member/check') }}" class="nav-link">ตรวจสอบการส่งบทคัดย่อ และผลการพิจารณา</a>
                            </li>
                            <li class="nav-item @yield('submission')">
                                <a href="{{ url('member/submission') }}" class="nav-link">ส่งบทคัดย่อ</a>
                            </li>
                        <?php //} ?>
                        <li class="nav-item">
                            <a href="{{ url('signout') }}" class="nav-link">ออกจากระบบ</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    <div id="myContainer" class="row no-gutters">
        <div id="membermenu" class="col-12 col-lg-2 Menu">
            <nav class="navbar navbar-dark">
                <div class="container">
                    <a class="navbar-brand" href="#"><img src="{{ asset('img/60year-fsci.png') }}" alt="kmutt-fsci"></a>
                    <div lang="th">
                        <ul class="navbar-nav">
                            <li class="nav-item @yield('home')">
                                <a href="{{ url('member') }}" class="nav-link">หน้าแรก</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('/') }}" class="nav-link">กลับหน้าเว็บหลัก</a>
                            </li>
                            <li class="nav-item @yield('profile')">
                                <a href="{{ url('member/profile') }}" class="nav-link">ข้อมูลส่วนตัว</a>
                            </li>
                            <?php
                            // $type = Auth::guard('member')->user()->type;

                            // if ($type == 2 || $type == 3) {
                            ?>
                                <li class="nav-item @yield('check')">
                                    <a href="{{ url('member/check') }}" class="nav-link">ตรวจสอบการส่งบทคัดย่อ และผลการพิจารณา</a>
                                </li>
                                <li class="nav-item @yield('submission')">
                                    <a href="{{ url('member/submission') }}" class="nav-link">ส่งบทคัดย่อ</a>
                                </li>
                            <?php //} ?>
                            <li class="nav-item">
                                <a href="{{ url('signout') }}" class="nav-link">ออกจากระบบ</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
        <div class="col-12 col-lg-10 Board overflow-auto">
            <div id="imgSlide" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="{{ asset('img/banner.jpg') }}" class="d-block w-100" />
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('img/slide1-2.jpg') }}" class="d-block w-100">
                    </div>
                    <a class="carousel-control-prev" href="#imgSlide" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#imgSlide" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>

            @yield('content')
        </div>
    </div>

    @include('components.pdpa')
    
    <x-footer />

    @yield('java-script')

</body>

</html> --}}