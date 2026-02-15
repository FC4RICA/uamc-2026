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
            <h2 class="fw-bold">ตรวจสอบผลการพิจารณา</h2>
        </div>

        <div class="text-center mt-4 mb-5">
            <h3>ขณะนี้ยังไม่มีการประกาศผลการคัดเลือก</h3>
        </div>

        <hr class="separator">

        <div class="d-flex justify-content-between">
            <h2 class="fw-bold">ข้อมูลบทคัดย่อ</h2>
            <div class="d-flex">
                <div class="mx-1">
                    <a href="{{ route('member.submission.abstract.edit', $submission) }}" class="btn btn-outline-secondary">
                        <i class="fa fa-edit me-2"></i>แก้ไขข้อมูล
                    </a>
                </div>
            </div>
        </div>

        <h3 class="mt-4">กลุ่มบทคัดย่อ</h3>
        <div class="row">
            <div class="col-12 col-lg-6">
                <div class="form-group">
                    <label for="">ประเภทบทคัดย่อ</label>
                    <input class="form-control-plaintext fs-6" disabled
                        value="{{ $submission->presentation_type->label() }}">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-lg-6">
                <div class="form-group">
                    <label>สาขาของผลงาน</label>
                    <input class="form-control-plaintext fs-6" disabled
                        value="{{ $submission->abstractGroups[0]->name }}">
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="form-group">
                    <label>สาขาของผลงาน (สำรอง)</label>
                    <input class="form-control-plaintext fs-6" disabled
                        value="{{ $submission->abstractGroups[1]?->name ?? 'ไม่เลือก' }}">
                </div>
            </div>
        </div>

        <h3 class="mt-4">ข้อมูลบทคัดย่อ</h3>
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <label>ชื่อบทคัดย่อภาษาไทย</label>
                    <input value="{{ $submission->title_th }}"
                        class="form-control-plaintext fs-6" disabled>
                </div>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <label>ชื่อบทคัดย่อภาษาอังกฤษ</label>
                    <input value="{{ $submission->title_en }}"
                        class="form-control-plaintext fs-6" disabled>
                </div>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <label>คำสำคัญ (Keyword)</label>
                    <input value="{{ $submission->keywords }}"
                        class="form-control-plaintext fs-6" disabled>
                </div>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <label>บทคัดย่อ</label>
                    <div class="mt-1 mb-2 d-flex gap-3">
                        @foreach ($submission->abstractFiles as $abstract)
                            <x-submission-file-card :file="$abstract" />
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        @if ($submission->participants()->exists())
            <hr class="separator my-4">
            <h3 class="mt-4">ข้อมูลผู้จัดทำ</h3>

            <div id="participants-container">
                @foreach ($submission->participants as $index => $data)
                    <x-participant-form :index="$index" :profile="$data->toArray()" :disabled="true"/>
                @endforeach
            </div>
        @endif

        {{-- <div>
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
                        {{ $submission->created_at->format('j M g:i A') }}
                    </td>
                    <td class="text-center" width="15%">
                        <a href="{{ route('member.submission.abstract.edit') }}" 
                            class="btn btn-primary" style="text-decoration: none; color:white;">
                            แก้ไขข้อมูล/ดูข้อมูล
                        </a>
                    </td>
                </tr>
            </table>
        </div> --}}
    </div>
@endsection