@extends('layouts.base')

@section('header')
    <div class="header">
        <span class="topbar">The 9th Undergraduate in Applied Mathematics Conference</span>
        @include('partials.nav-member')
    </div>
@endsection

@section('body')
    <div id="myContainer" class="row g-0">
        <div id="membermenu" class="col-12 col-lg-2">
            @include('partials.sidebar-member')
        </div>

        <div class="col-12 col-lg-10 overflow-auto">
            @include('partials.carousel')
            @yield('content')
        </div>
    </div>
@endsection
