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
        {{-- @if ($status == 1) --}}
        <form id="submitpaper" name="submitpaper" action='{{ route('member.submission.store') }}' method="POST"
            enctype="multipart/form-data">
            @csrf

            <h3 class="mt-4">กลุ่มบทคัดย่อ</h3>
            <div class="row">
                <div class="col-12 col-lg-6 col-xl-4">
                    <div class="form-group">
                        <label for="category">ประเภทบทคัดย่อ *</label>
                        <input id="category" name="category" type="text" class="form-control" disabled
                            value="{{ $user_presentation_type->label() }}">
                        @error('category')
                            <label for="category" class="error">{{ $message }}</label>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 col-lg-6 col-xl-4">
                    <div class="form-group">
                        <label for="category">กลุ่มบทคัดย่อ *</label>
                        <select id="category" name="category" required
                            class="form-select @error('category') is-invalid @enderror">
                            <option value="" selected disabled>เลือก</option>
                            @foreach ($groups as $group)
                                <option value="{{ $group->id }}">{{ $group->name }}</option>
                            @endforeach
                        </select>
                        @error('category')
                            <label for="category" class="error">{{ $message }}</label>
                        @enderror
                    </div>
                </div>
                <div class="col-12 col-lg-6 col-xl-4">
                    <div class="form-group">
                        <label for="category2">กลุ่มบทคัดย่อ (สำรอง 1)</label>
                        <select id="category2" name="category2"
                            class="form-select @error('category2') is-invalid @enderror">
                            <option value="" selected disabled>เลือก (ไม่จำเป็น)</option>
                            <option value="">ไม่เลือก</option>
                            @foreach ($groups as $group)
                                <option value="{{ $group->id }}">{{ $group->name }}</option>
                            @endforeach
                        </select>
                        @error('category2')
                            <label for="category2" class="error">{{ $message }}</label>
                        @enderror
                    </div>
                </div>
                <div class="col-12 col-lg-6 col-xl-4">
                    <div class="form-group">
                        <label for="category3">กลุ่มบทคัดย่อ (สำรอง 2)</label>
                        <select id="category3" name="category3"
                            class="form-select @error('category3') is-invalid @enderror">
                            <option value="" selected disabled>เลือก (ไม่จำเป็น)</option>
                            <option value="">ไม่เลือก</option>
                            @foreach ($groups as $group)
                                <option value="{{ $group->id }}">{{ $group->name }}</option>
                            @endforeach
                        </select>
                        @error('category3')
                            <label for="category3" class="error">{{ $message }}</label>
                        @enderror
                    </div>
                </div>
            </div>

            <h3 class="mt-4">ข้อมูลบทคัดย่อ</h3>
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label for="title_th">ชื่อบทคัดย่อภาษาไทย *</label>
                        <input id="title_th" name="title_th" type="text" placeholder="ภาษาไทย"
                            class="form-control @error('title_th') is-invalid @enderror" required>
                        @error('title_th')
                            <label for="title_th" class="error">{{ $message }}</label>
                        @enderror
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label for="title_en">ชื่อบทคัดย่อภาษาอังกฤษ *</label>
                        <input id="title_en" name="title_en" type="text" placeholder="ภาษาอังกฤษ"
                            class="form-control @error('title_en') is-invalid @enderror" required>
                        @error('title_en')
                            <label for="title_en" class="error">{{ $message }}</label>
                        @enderror
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label for="keyword">คำสำคัญ (Keyword) *</label>
                        <input id="keyword" name="keyword" type="text" placeholder="Keyword"
                            class="form-control @error('keyword') is-invalid @enderror" required>
                        @error('keyword')
                            <label for="keyword" class="error">{{ $message }}</label>
                        @enderror
                    </div>
                </div>
                <div class="col-12 col-lg-6 col-xl-4">
                    <div class="form-group">
                        <label for="abstract_th">บทคัดย่อภาษาไทย (PDF) *</label>
                        <input type="file" id="abstract_th" name="abstract_th" placeholder="บทคัดย่อภาษาไทย"
                            class="form-control @error('abstract_th') is-invalid @enderror"
                            onchange="onInputFileChangeLabel(this.id, this.value)" required>
                        @error('abstract_th')
                            <label for="abstract_th" class="error">{{ $message }}</label>
                        @enderror
                    </div>
                </div>
                <div class="col-12 col-lg-6 col-xl-4">
                    <div class="form-group">
                        <label for="abstract_en">บทคัดย่อภาษาอังกฤษ (PDF) *</label>
                        <input type="file" id="abstract_en"name="abstract_en"
                            onchange="onInputFileChangeLabel(this.id, this.value)" placeholder="บทคัดย่อภาษาอังกฤษ"
                            class="form-control @error('abstract_en') is-invalid @enderror" required>
                        @error('abstract_en')
                            <label for="abstract_en" class="error">{{ $message }}</label>
                        @enderror
                    </div>
                </div>
                @if ($user->isOral())
                    {{-- <div class="row">
                    <div class="col-12 col-lg-12 col-md-12">
                        <p class="text-center">
                            <u>ผลงานที่ผ่านการคัดเลือกต้องส่งวิดีทัศน์ความยาวไม่เกิน 15 นาที <strong>ภายในวันที่ 16 เมษายน พ.ศ.2564</strong><br/>เพื่อสำรองไว้ในกรณีที่มีเหตุขัดข้องระหว่างการนำเสนอจริง</u>
                        </p>
                        <p class="text-center">ส่ง VDO นำเสนอผ่าน Google drive link</p>
                    </div>
                </div> --}}
                @elseif($user->isPoster())
                    <div class="col-12 col-lg-6 col-xl-4">
                        <div class="form-group">
                            <label for="poster">โปสเตอร์ (PDF) *</label>
                            <input type="file" class="form-control" id="poster" name="poster"
                                onchange="onInputFileChangeLabel(this.id, this.value)" placeholder="โปสเตอร์" required />
                            @error('poster')
                                <label for="poster" class="error">{{ $message }}</label>
                            @enderror
                        </div>
                    </div>

                    {{-- <div class="row">
                    <div class="col-12 col-lg-12 col-md-12">
                        <p class="text-center">
                            <u>ผลงานที่ผ่านการคัดเลือกต้องส่งวิดีทัศน์ความยาวไม่เกิน 10 นาที โดยนำเสนอผ่านโปสเตอร์ตัวเอง <strong>ภายในวันที่ 16 เมษายน พ.ศ.2564</strong><br/>เพื่อสำรองไว้ในกรณีที่มีเหตุขัดข้องระหว่างการนำเสนอจริง</u>
                        </p>
                        <p class="text-center">ส่ง VDO นำเสนอผ่าน Google drive link</p>
                    </div>
                </div> --}}
                @endif
            </div>

            <hr class="separator">

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
                @foreach ($participants as $index => $data)
                    <x-participant-form :index="$index" :data="$data" />
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

        {{-- @else
    <h4 class="text-center"><strong>ขณะนี้ยังไม่เปิดรับผลงาน หรือเลยกำหนดการมาแล้ว</strong></h4>
    @endif --}}
    </div>

@endsection

@push('scripts')
    @vite('resources/js/pages/member/submission.js')
@endpush
