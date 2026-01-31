@php
    use App\Enums\ParticipationType;
@endphp

@extends('layouts.member')

@section('title', 'ตรวจสอบผลการพิจารณา')
@section('check', 'active')

@section('content')
    <div class="container px-4 mt-4 mb-5">

        {{-- 
        // future announcement
        <div class="text-center">
            <h2 class="fw-bold">ตรวจสอบผลการพิจารณา</h2>
        </div>
        <div class="text-center">
            @if($results != null)
                <h3><span class="text-success"><strong>ขอแสดงความยินดี คุณได้รับคัดเลือกจากบทความ</strong></span></h3>
                @foreach($results as $result)
                    <h4><span class="text-primary">{{ $result->name_th . '/' . $result->name_en}}</span> ในประเภท {{ $result->participation_type->label() }} กลุ่ม {{ $result->category }}</h4>
                @endforeach
            @else
                <h3><span class="text-danger"><strong>ขอแสดงความเสียใจ คุณไม่ได้รับคัดเลือก</strong></span></h3>
            @endif
            <h3>ขณะนี้ยังไม่มีการประกาศผลการคัดเลือก</h3>
        </div>
        <hr class="separator"> 
        --}}


        <div class="text-center">
            <h2><strong>บทคัดย่อ</strong></h2>
        </div>
        <hr class="separator">
        <div>
            <table class="table">
                <tr>
                    <th class="text-center" width="35%">
                        ชื่อบทคัดย่อ
                    </th>
                    <th class="text-center" width="15%">
                        ประเภทการนำเสนอ
                    </th>
                    <th class="text-center" width="20%">
                        สาขาของผลงาน
                    </th>
                    <th class="text-center" width="15%">
                        วันที่อัพโหลด
                    </th>
                    <th class="text-center" width="15%">

                    </th>
                </tr>
                <tr>
                    <td class="text-center" width="35%">
                        {{ $submission->title_th . ' / ' . $submission->title_en }}
                    </td>
                    <td class="text-center" width="20%">
                        {{ $submission->presentation_type->label() }}
                    </td>
                    <td class="text-center" width="20%">
                        {{ $submission->abstractGroups[0]->name }}<br>
                        @if ($submission->abstractGroups[1] ?? false)
                            {{ $submission->abstractGroups[1]->name }}
                        @endif
                    </td>
                    <td class="text-center" width="15%">
                        {{ $submission->created_at }}
                    </td>
                    <td class="text-center" width="15%">
                        <a href="{{ route('member.submission.abstract.edit') }}" 
                            class="btn btn-primary" style="text-decoration: none; color:white;">
                            แก้ไขข้อมูล/ดูข้อมูล
                        </a>
                    </td>
                </tr>
            </table>
        </div>
    </div>
@endsection