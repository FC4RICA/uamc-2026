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
