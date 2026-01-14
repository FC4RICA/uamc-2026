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