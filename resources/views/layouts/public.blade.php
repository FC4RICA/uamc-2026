@extends('layouts.base')

@section('header')
<div class="header">
    <span class="topbar">King Mongkut's University of Technology Thonburi (KMUTT)</span>
    @include('partials.nav-public')
</div>
@endsection

@section('body')
<div id="myContainer">

    @hasSection('slide')
        @yield('slide')
    @else
        @include('partials.carousel')
    @endif

    @yield('content')
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
    <script type="text/javascript" src="{{ asset('js/control.js') }}" defer></script>
    <script type="text/javascript" src="{{ asset('js/form-validate.js') }}" defer></script>
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <title>@yield('title')</title>
</head>

<body>
    <div id="myContainer">
        @section('header')
        <div class="header">
            <span class="topbar">King Mongkut's University of Technology Thonburi (KMUTT)</span>
            <nav class="navbar navbar-expand-lg navbar-dark">
                <div class="container">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <a class="navbar-brand" href="/"><img src="img/60year-fsci.png" alt="kmutt-fsci"></a>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent" lang="th">
                        <ul class="navbar-nav">
                            <li class="nav-item @yield('home')">
                                <a href="{{ url('/') }}" class="nav-link"><strong>หน้าแรก</strong></a>
                            </li>
                            <li class="nav-item @yield('schedule')">
                                <a href="{{ url('/schedule') }}" class="nav-link"><strong>กำหนดการ</strong></a>
                            </li>
                            <li class="nav-item @yield('citeria')">
                                <a class="nav-link" href="{{ url('/citeria') }}"><strong>การนำเสนอและเกณฑ์การตัดสิน</strong></a>
                            </li>
                            <li class="nav-item @yield('attendend')">
                                <a href="{{ url('/announcement') }}" class="nav-link"><strong>ประกาศรายชื่อ</strong></a>
                            </li>
                            <li class="nav-item @yield('register')">
                                <a href="{{ url('/register') }}" class="nav-link"><strong>ลงทะเบียน</strong></a>
                            </li>
                            <li class="nav-item dropdown @yield('rules')">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><strong>การส่งผลงาน</strong></a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ url('/rules') }}">การส่งผลงานและข้อกำหนดรูปแบบของบทคัดย่อและโปสเตอร์</a>
                                    <a class="dropdown-item" href="{{ url('/templates') }}">Templates บทคัดย่อและโปสเตอร์</a>
                                </div>
                            </li>
                            <!-- <li class="nav-item @yield('submission')">
                                <a href="{{ url('/signin') }}" class="nav-link"><strong>ระบบส่งบทคัดย่อ</strong></a>
                            </li> -->
                            <li class="nav-item @yield('about')">
                                <a href="{{ url('/about') }}" class="nav-link"><strong>ติดต่อเรา</strong></a>
                            </li>
                        </ul>
                    </div>
                    <div class="accountBTN">
                        <a href="{{ url('/signin') }}">เข้าสู่ระบบ</a>
                    </div>
                </div>
            </nav>
        </div>
        @show

        @section('slide')
        <div id="imgSlide" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="{{ asset('img/banner.jpg') }}" class="d-block w-100" />
                </div>
                <div class="carousel-item">
                    <img src="img/slide1-2.jpg" class="d-block w-100" />
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
        @show
        @yield('content')
    </div>

    @include('components.pdpa')

    @section('footer')
    <x-footer />
    @show

</body>

</html> --}}