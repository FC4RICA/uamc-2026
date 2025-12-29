@extends('layouts.admin')
@section('title', 'Administrator Dashboard')
@section('dashboard', 'active')

@php
    $actions = [
        'announce' => [
            'label_on'  => 'ยกเลิกการประกาศผล',
            'label_off' => 'ประกาศผล',
            'icon'      => 'fa-bullhorn',
        ],
        'register' => [
            'label_on'  => 'ปิดลงทะเบียน',
            'label_off' => 'เปิดลงทะเบียน',
            'icon'      => 'fa-bullhorn',
        ],
        'submission' => [
            'label_on'  => 'ปิดรับผลงาน',
            'label_off' => 'เปิดรับผลงาน',
            'icon'      => 'fa-print',
        ],
    ];

    $statuses = [
        'announce'   => 0,
        'register'   => 0,
        'submission' => 0,
    ];
@endphp

@section('content')
<div class="container mt-5">
    <div class="text-center">
        <h1><strong>สวัสดี {{ Auth::user()->name }}</strong></h1>
    </div>
    <hr>
    <h3><strong>การดำเนินการ</strong></h3>
    <div class="row bg-warning p-3 m-0">
        @foreach($actions as $key => $config)
            <div class="col-4 text-center">
                <x-toggle-button
                    :key="$key"
                    :status="$statuses[$key]"
                    :config="$config"
                    :mock="true"
                />
            </div>
        @endforeach
        {{-- <div class="col-4 text-center">
            @if($status[0]->status == 0)
            <?php //$url = '/admin/announce'; ?>
            <a href="{{ url($url) }}" class="btn btn-success"><i class="fa fa-bullhorn"></i><span class="mx-2">ประกาศผล</span></a>
            @elseif($status[0]->status == 1)
            <?php //$url = '/admin/unannounce'; ?>
            <a href="{{ url($url) }}" class="btn btn-danger"><i class="fa fa-bullhorn"></i><span class="mx-2">ยกเลิกการประกาศผล</span></a>
            @endif
        </div>
        <div class="col-4 text-center">
            @if($status[1]->status == 0)
            <?php //$reg_url = '/admin/openregister'; ?>
            <a href="{{ url($reg_url) }}" class="btn btn-success"><i class="fa fa-bullhorn"></i><span class="mx-2">เปิดลงทะเบียน</span></a>
            @elseif($status[1]->status == 1)
            <?php //$reg_url = '/admin/closeregister'; ?>
            <a href="{{ url($reg_url) }}" class="btn btn-danger"><i class="fa fa-bullhorn"></i><span class="mx-2">ปิดลงทะเบียน</span></a>
            @endif
        </div>
        <div class="col-4 text-center">
            @if($status[2]->status == 0)
            <?php //$reg_url = '/admin/opensubmission'; ?>
            <a href="{{ url($reg_url) }}" class="btn btn-success"><i class="fa fa-print"></i><span class="mx-2">เปิดรับผลงาน</span></a>
            @elseif($status[2]->status == 1)
            <?php //$reg_url = '/admin/closesubmission'; ?>
            <a href="{{ url($reg_url) }}" class="btn btn-danger"><i class="fa fa-print"></i><span class="mx-2">ปิดรับผลงาน</span></a>
            @endif
        </div> --}}
    </div>
    <br/>
    @include('components.schedule', ['showLineBreak' => true])
    @include('components.timetable', ['showLineBreak' => true])
</div>
@endsection

@push('scripts')
<script>
    function toggleMock(el) {
        let status = parseInt(el.dataset.status);

        // toggle state
        status = status === 1 ? 0 : 1;
        el.dataset.status = status;

        // update button style
        el.classList.toggle('btn-success', status === 0);
        el.classList.toggle('btn-danger', status === 1);

        // update label
        const label = status === 1
            ? el.dataset.labelOn
            : el.dataset.labelOff;

        el.querySelector('span').innerText = label;

        console.log('Mock toggle:', el.dataset.key, '=>', status);
    }
</script>
@endpush