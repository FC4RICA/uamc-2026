@php
    use App\Enums\ParticipationType;
@endphp

@extends('layouts.member')

@section('title', 'ส่งบทคัดย่อ')
@section('submission', 'active')

@section('content')
    <div class="container px-4 mt-4 mb-5">
        <div class="text-center">
            <h2><strong>ส่งบทคัดย่อ</strong></h2>
        </div>
        <hr class="separator">
        <form id="submitpaper" name="submitpaper" action='{{ route('member.submission.abstract.store') }}' method="POST"
            enctype="multipart/form-data">
            @csrf

            <h3 class="mt-4">กลุ่มบทคัดย่อ</h3>
            <div class="row">
                <div class="col-12 col-lg-6">
                    <div class="form-group">
                        <label>ประเภทบทคัดย่อ *</label>
                        <input name="category" type="text" class="form-control" disabled
                            value="{{ $user_presentation_type->label() }}">
                        @error('category')
                            <label
                             class="error">{{ $message }}</label>
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
                            <option value="" disabled @selected(!old('groups.1'))>เลือก</option>
                            @foreach ($groups as $group)
                                <option value="{{ $group->id }}" @selected($group->id == old('groups.1'))>
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
                            <option value="" disabled @selected(!old('groups.2'))>เลือก (ไม่จำเป็น)</option>
                            <option value="">ไม่เลือก</option>
                            @foreach ($groups as $group)
                                <option value="{{ $group->id }}" @selected($group->id == old('groups.2'))>
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
                        <input name="title_th" type="text" placeholder="ภาษาไทย" value="{{ old('title_th') }}"
                            class="form-control @error('title_th') is-invalid @enderror" required>
                        @error('title_th')
                            <label class="error">{{ $message }}</label>
                        @enderror
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label>ชื่อบทคัดย่อภาษาอังกฤษ *</label>
                        <input name="title_en" type="text" placeholder="ภาษาอังกฤษ" value="{{ old('title_en') }}"
                            class="form-control @error('title_en') is-invalid @enderror" required>
                        @error('title_en')
                            <label class="error">{{ $message }}</label>
                        @enderror
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label>คำสำคัญ (Keyword) *</label>
                        <input name="keywords" type="text" placeholder="คำสำคัญ" value="{{ old('keywords') }}"
                            class="form-control @error('keywords') is-invalid @enderror" required>
                        @error('keywords')
                            <label class="error">{{ $message }}</label>
                        @enderror
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label>บทคัดย่อ (PDF) *</label>
                        <input type="file" name="abstract" placeholder="O_ชื่อจริง_นามสกุล.pdf หรือ P_ชื่อจริง_นามสกุล.pdf"
                            class="form-control @error('abstract') is-invalid @enderror" value="{{ old('abstract') }}"
                            onchange="onInputFileChangeLabel(this.id, this.value)" required>
                        @error('abstract')
                            <label class="error">{{ $message }}</label>
                        @enderror
                    </div>

                    <p class="fs-6 text-secondary fw-bold">*ตั้งชื่อไฟล์ผลงาน O_ชื่อ_นามสกุล.pdf หรือ P_ชื่อ_นามสกุล.pdf ตามรูปแบบการนําเสนอ*</p>
                </div>
            </div>

            <hr class="separator my-4">

            <h3 class="mt-4">ข้อมูลผู้ร่วมผลงาน</h3>
            <div id="participants" class="card mb-4">
                <h4 class="card-header">ผู้นำเสนอหลัก</h4>
                <div class="card-body row align-items-end">
                    <div class="col-12 col-sm-6 col-xl-2">
                        <div class="form-group">
                            <label for="user_title">คำนำหน้า</label>
                            <input id="user_title" name="user_title" value="{{ $profile->title->label() }}"
                                class="form-control" disabled>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-xl-2">
                        <div class="form-group">
                            <label for="user_academic_title">ตำแหน่งทางวิชาการ</label>
                            <input id="user_academic_title" name="user_academic_title"
                                value="{{ $profile->academic_title->label() }}" class="form-control" disabled>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-xl-4">
                        <div class="form-group">
                            <label for="user_firstname">ชื่อ</label>
                            <input id="user_firstname" name="user_firstname" value="{{ $profile->firstname }}"
                                class="form-control" disabled>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-xl-4">
                        <div class="form-group">
                            <label for=" user_lastname">นามสกุล</label>
                            <input id="user_lastname" name="user_lastname" value="{{ $profile->lastname }}"
                                class="form-control" disabled>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-xl-3">
                        <div class="form-group">
                            <label for="user_education">ระดับการศึกษา</label>
                            <input id="user_education" name="user_education" class="form-control" disabled
                                value="{{ $profile->education->label() }}">
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-xl-3">
                        <div class="form-group">
                            <label for="user_phone">เบอร์โทร</label>
                            <input id="user_phone" name="user_phone" value="{{ $profile->phone }}" class="form-control"
                                disabled>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-xl-3">
                        <div class="form-group">
                            <label for="user_occupation">อาชีพ</label>
                            <input id="user_occupation" name="user_occupation" class="form-control" disabled
                                value="{{ $profile->occupation?->name ?? $profile->occupation_other }}">
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-xl-3">
                        <div class="form-group">
                            <label for="user_organization">สถานที่ทำงาน/สถาบันการศึกษา/หน่วยงาน</label>
                            <input id="user_organization" name="user_organization" class="form-control" disabled
                                value="{{ $profile->organization?->name ?? $profile->organization_other }}">
                        </div>
                    </div>
                    @if ($profile->special_requirements)
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="special_requirements">ข้อจำกัดด้านอาหาร / ข้อมูลสุขภาพที่ควรทราบ</label>
                                <input id="special_requirements" name="special_requirements" disabled
                                    class="form-control" value="{{ $profile->special_requirements }}">
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <div id="participants-container">
                @foreach ((old('participants', [])) as $index => $data)
                    <x-participant-form :index="$index" :profile="$data" />
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
                    <button id="submit-submission" class="btn btn-warning" type="submit">
                        ส่งบทคัดย่อ
                    </button>
                </div>
            </div>
        </form>
    </div>

@endsection

@push('scripts')
    @vite('resources/js/pages/member/submission.js')
@endpush
