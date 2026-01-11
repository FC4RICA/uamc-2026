@extends('layouts.base')

@section('header')
@include('partials.nav-admin')
@endsection

@section('body')
<div id="myContainer" class="row no-gutters">
    <div id="adminmenu" class="col-12 col-lg-2 Menu">
        @include('partials.sidebar-admin')
    </div>

    <div class="col-12 col-lg-10 Board overflow-auto">
        @include('partials.carousel')
        @yield('content')
    </div>
</div>
@endsection
