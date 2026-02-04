@extends('layouts.base')

@section('header')
    <div class="header">
        <span class="topbar">The 9th Undergraduate in Applied Mathematics Conference</span>
        @include('partials.nav-admin')
    </div>
@endsection

@section('body')
    <div id="myContainer" class="row g-0">
        <div id="adminmenu" class="col-12 col-lg-2">
            @include('partials.sidebar-admin')
        </div>

        <div class="col-12 col-lg-10 overflow-auto">
            @yield('content')
        </div>
    </div>
@endsection
