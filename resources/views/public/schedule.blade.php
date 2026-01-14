@extends('layouts.public')

@section('title', 'กำหนดการ')
@section('schedule', 'active')

@section('content')

<div class="container my-5 d-grid gap-5">
    @include('components.schedule', ['showLineBreak' => true])
    @include('components.timetable', ['showLineBreak' => true])
</div>

@endsection