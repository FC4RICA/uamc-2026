@php
    use App\Enums\ParticipationType;
@endphp

@extends('layouts.member')

@section('title', 'ตรวจสอบผลการพิจารณา')
@section('check', 'active')

@section('content')
<div class="container my-5">
    <div class="text-center">
        <h2><strong>ตรวจสอบผลการพิจารณา</strong></h2>
    </div>
    <div class="text-center">
        {{-- @if($status->status == 1) --}}
        @if($results != null)
            <h3><span class="text-success"><strong>ขอแสดงความยินดี คุณได้รับคัดเลือกจากบทความ</strong></span></h3>
            @foreach($results as $result)
                <h4><span class="text-primary">{{ $result->name_th . '/' . $result->name_en}}</span> ในประเภท {{ $result->participation_type->label() }} กลุ่ม {{ $result->category }}</h4>
            @endforeach
        @else
            <h3><span class="text-danger"><strong>ขอแสดงความเสียใจ คุณไม่ได้รับคัดเลือก</strong></span></h3>
        @endif
        {{-- @elseif($status->status == 0)
        <h3>ขณะนี้ยังไม่มีการประกาศผลการคัดเลือก</h3>
        @endif --}}
    </div>
    <hr>
    <div class="text-center">
        <h2><strong>รายการบทความ</strong></h2>
    </div>
    <hr>
    <div>
        <table class="table">
            <tr>
                <th class="text-center" width="35%">
                    ชื่อบทความ
                </th>
                <th class="text-center" width="15%">
                    ประเภท
                </th>
                <th class="text-center" width="20%">
                    กลุ่ม
                </th>
                <th class="text-center" width="15%">
                    วันที่อัพโหลด
                </th>
                <th class="text-center" width="15%">

                </th>
            </tr>
            @foreach($submission as $research)
            <tr>
                <td class="text-center" width="35%">
                    {{ $research->name_th . '/' . $research->name_en }}
                </td>
                <td class="text-center" width="20%">
                    {{ $research->participation_type->label() }}
                </td>
                <td class="text-center" width="20%">
                    {{ $research->category }}
                </td>
                <td class="text-center" width="15%">
                    {{ $research->created_at }}
                </td>
                <td class="text-center" width="15%">
                    {{-- <?php $ed_url = 'member/edit/' . $research->research_id ?>
                    <a href="{{ url($ed_url) }}" class="btn btn-primary" style="text-decoration: none; color:white;">แก้ไขข้อมูล/ดูข้อมูล</a> --}}
                    <a href="{{ route('member.submission.edit', ['id' => $research->research_id]) }}" class="btn btn-primary" style="text-decoration: none; color:white;">แก้ไขข้อมูล/ดูข้อมูล</a>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</div>

@endsection