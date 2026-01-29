@php
    use App\Enums\ParticipationType;
@endphp

@extends('layouts.member')

@section('title', 'แก้ไขบทคัดย่อ')
@section('check', 'active')

@section('content')
    <div class="container px-4 mt-4 mb-5">
        <div class="text-center">
            <h2 class="fw-bold">แก้ไขบทคัดย่อ</h2>
        </div>
        <hr class="separator">
        <form id="editpaper" name="editpaper" action='{{ route('member.submission.abstract.update') }}' method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <h3 class="mt-4">กลุ่มบทคัดย่อ</h3>
            <div class="row">
                <div class="col-12 col-lg-6">
                    <div class="form-group">
                        <label for="">ประเภทบทคัดย่อ *</label>
                        <input name="category" type="text" class="form-control" disabled
                            value="{{ $submission->presentation_type->label() }}">
                        @error('category')
                            <label class="error">{{ $message }}</label>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 col-lg-6">
                    <div class="form-group">
                        <label>สาขาของผลงาน *</label>
                        <select name="groups[1]" required
                            class="form-select @error('groups.1') is-invalid @enderror">
                            @foreach ($groups as $group)
                                <option value="{{ $group->id }}"
                                    @selected($group->id == $submission->abstractGroups[0]->id)>
                                    {{ $group->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('groups.1')
                            <label class="error">{{ $message }}</label>
                        @enderror
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="form-group">
                        <label>สาขาของผลงาน (สำรอง)</label>
                        <select name="groups[2]"
                            class="form-select @error('groups.2') is-invalid @enderror">
                            <option value="" @selected(!($submission->abstractGroups[1] ?? null))>
                                ไม่เลือก
                            </option>
                            @foreach ($groups as $group)
                                <option value="{{ $group->id }}" 
                                    @selected($group->id == ($submission->abstractGroups[1]->id ?? ''))>
                                    {{ $group->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('groups.2')
                            <label class="error">{{ $message }}</label>
                        @enderror
                    </div>
                </div>
            </div>
            <p class="fs-6 text-secondary fw-bold">*กลุ่มนำเสนออาจมีการปรับเปลี่ยนตามความเหมาะสม</p>

            <h3 class="mt-4">ข้อมูลบทคัดย่อ</h3>
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label>ชื่อบทคัดย่อภาษาไทย *</label>
                        <input name="title_th" type="text" value="{{ $submission->title_th }}"
                            class="form-control @error('title_th') is-invalid @enderror" required>
                        @error('title_th')
                            <label class="error">{{ $message }}</label>
                        @enderror
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label>ชื่อบทคัดย่อภาษาอังกฤษ *</label>
                        <input name="title_en" type="text" value="{{ $submission->title_en }}"
                            class="form-control @error('title_en') is-invalid @enderror" required>
                        @error('title_en')
                            <label class="error">{{ $message }}</label>
                        @enderror
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label>คำสำคัญ (Keyword) *</label>
                        <input name="keywords" type="text" value="{{ $submission->keywords }}"
                            class="form-control @error('keywords') is-invalid @enderror" required>
                        @error('keywords')
                            <label class="error">{{ $message }}</label>
                        @enderror
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label>บทคัดย่อ (PDF) *</label>
                        <div class="mt-1 mb-2 d-flex gap-3">
                            @foreach ($submission->abstractFiles as $abstract)
                                <a href="{{ route('member.submission.file.download', $abstract) }}" class="fs-6 text fw-bold">
                                    {{ $abstract->original_file_name }}
                                </a>
                            @endforeach
                        </div>
                        <input type="file" name="abstract"
                            class="form-control @error('abstract') is-invalid @enderror"
                            onchange="onInputFileChangeLabel(this.id, this.value)">
                        @error('abstract')
                            <label class="error">{{ $message }}</label>
                        @enderror
                    </div>
                </div>
            </div>

            <hr class="separator my-4">
            <h3 class="mt-4">ข้อมูลผู้ร่วมผลงาน</h3>

            <div id="participants-container">
                @foreach ($submission->participants as $index => $data)
                    <x-participant-form :index="$index" :profile="$data->toArray()"/>
                @endforeach
            </div>

            <button type="button" id="add-participant" class="btn btn-secondary">
                + เพิ่มผู้ร่วมผลงาน
            </button>

            <template id="participant-template">
                <x-participant-form index="__INDEX__" />
            </template>

            <div class="text-center">
                <div class="form-group">
                    <button class="btn btn-warning" type="submit">แก้ไขข้อมูล</button>
                    <button class="btn btn-outline-danger" type="reset">รีเซ็ตการแก้ไข</button>
                    <a href="{{ route('member.submission.abstract.delete') }}" class="btn btn-danger">ลบบทคัดย่อ</a>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    @vite('resources/js/pages/member/submission.js')
@endpush