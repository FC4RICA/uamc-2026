@extends('layouts.admin')
@section('title', 'Administrator Dashboard')
@section('dashboard', 'active')

@section('content')
    <div class="container mt-4">

        <h3><strong>ตั้งค่าสถานะ</strong></h3>
        <div class="row g-3">
            @foreach($toggles as $toggle)
                <div class="col-12 col-lg-6 col-xl-4">
                    <x-status-toggle-card
                        :label="$toggle['config']['label']"
                        :enabled="$toggle['status']"
                        :action="$toggle['route']"
                    />
                </div>
            @endforeach
        </div>
    </div>
@endsection