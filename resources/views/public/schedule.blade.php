@extends('layouts.public')

@section('title', 'กำหนดการ')
@section('schedule', 'active')

@section('content')

<div class="container my-5 gap-y-10">
    @include('components.schedule', ['showLineBreak' => true])
    @include('components.timetable', ['showLineBreak' => true])
</div>

@endsection