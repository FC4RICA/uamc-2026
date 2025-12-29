@php
    use App\Enums\ParticipationType;
@endphp

@extends('layouts.member')

@section('title', 'ส่งบทคัดย่อ')
@section('submission', 'active')

@section('content')
<div class="container my-5">
    <div class="text-center">
        <h2><strong>ส่งบทคัดย่อ</strong></h2>
    </div>
    <hr>
    {{-- @if($status == 1) --}}
    <form id="submitpaper" name="submitpaper" action='{{ url("/member/submission") }}' method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
        <!-- @csrf -->
        <!-- @method('POST') -->
        <div>
            <div class="row">
                <div class="col-12 col-lg-6">
                    <div class="form-group">
                        <label for="type">ประเภทบทคัดย่อ*</label>
                        <select id="type" name="type" class="custom-select">
                            <option value="{{ Auth::user()->participation_type->value }}">{{ Auth::user()->participation_type->label() }}</option>
                        </select>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="form-group">
                        <label for="category">กลุ่มบทคัดย่อ*</label>
                        <select id="category" name="category" class="custom-select" required>
                            <option value="" selected disabled>เลือก</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->title}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-lg-6">
                <div class="form-group">
                    <label for="category2">กลุ่มบทคัดย่อ (สำรอง 1)</label>
                    <select id="category2" name="category2" class="custom-select">
                        <option value="" selected disabled>เลือก (ไม่จำเป็น)</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->title}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="form-group">
                    <label for="category3">กลุ่มบทคัดย่อ (สำรอง 2)</label>
                    <select id="category3" name="category3" class="custom-select">
                        <option value="" selected disabled>เลือก (ไม่จำเป็น)</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->title}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-lg-6">
                <div class="form-group">
                    <label for="name_th">ชื่อบทคัดย่อภาษาไทย*</label>
                    <input id="name_th" name="name_th" type="text" class="form-control" placeholder="ภาษาไทย" required>
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="form-group">
                    <label for="name_en">ชื่อบทคัดย่อภาษาอังกฤษ*</label>
                    <input id="name_en" name="name_en" type="text" class="form-control" placeholder="ภาษาอังกฤษ" required>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-lg-12">
                <div class="form-group">
                    <label for="keyword">Keyword*</label>
                    <input id="keyword" name="keyword" type="text" class="form-control" placeholder="Keyword" required>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
                <div class="form-group">
                    <label for="abstract_th">บทคัดย่อภาษาไทย (PDF)*</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="abstract_th" name="abstract_th" onchange="onInputFileChangeLabel(this.id, this.value)" require />
                        <label class="custom-file-label" for="abstract_th" id="abstract_th_label" name="abstract_th_label">บทคัดย่อภาษาไทย</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
                <div class="form-group">
                    <label for="abstract_en">บทคัดย่อภาษาอังกฤษ (PDF)*</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="abstract_en" name="abstract_en" onchange="onInputFileChangeLabel(this.id, this.value)" require />
                        <label class="custom-file-label" for="abstract_en" id="abstract_en_label" name="abstract_en_label">บทคัดย่อภาษาอังกฤษ</label>
                    </div>
                </div>
            </div>
        </div>
        @if(Auth::user()->participation_type === ParticipationType::Oral)
            <div class="row">
                <div class="col-12 col-lg-12">
                    <label for="proceedingAgreement"><strong>ต้องการเผยแพร่ผลงานฉบับเต็มลงใน Book of Proceedings หรือไม่*</strong></label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="proceedingAgreement" id="proceedingAgreement" value="1" onclick="onProceedingChange()" checked />
                        <label class="form-check-label" for="proceedingAgreement">ต้องการ</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="proceedingAgreement" id="proceedingDisagreement" value="0" onclick="onProceedingChange()" />
                        <label class="form-check-label" for="proceedingDisagreement">ไม่ต้องการ</label>
                    </div>
                    <p>
                        <u>หมายเหตุ</u> สำหรับผลงานที่ต้องการเผยแพร่เมื่อผ่านการพิจาณาจากคณะกรรมการให้ลงใน Book of Proceedings แล้ว จะมี e-mail แจ้งไปเพื่อให้ดำเนินการในขั้นตอนต่อไปภายใน 1 สัปดาห์
                    </p>
                </div>
            </div>
            <div id="full_text_upload" class="row">
                <div class="col-12 col-lg-12 col-md-12">
                    <div class="form-group">
                        <label for="full_text">ผลงานฉบับเต็ม <u>"สำหรับผู้ที่<strong>ต้องการ</strong>เผยแพร่ผลงานฉบับเต็มผ่าน Book of proceedings"</u> (PDF)</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="full_text" name="full_text" onchange="onInputFileChangeLabel(this.id, this.value)"/>
                            <label class="custom-file-label" for="full_text" id="full_text_label" name="efull_text_label">ผลงานฉบับเต็ม</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-lg-12 col-md-12">
                    <div class="form-group">
                        <label for="extended_abstract">บทคัดย่อแบบขยาย <u>"สำหรับผู้ที่<strong>ไม่ต้องการ</strong>เผยแพร่ผลงานฉบับเต็มผ่าน Book of proceedings"</u> (PDF)</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="extended_abstract" name="extended_abstract" onchange="onInputFileChangeLabel(this.id, this.value)" disabled/>
                            <label class="custom-file-label" for="extended_abstract" id="extended_abstract_label" name="extended_abstract_label">บทคัดย่อแบบขยาย</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-lg-12 col-md-12">
                    <p class="text-center">
                        <u>ผลงานที่ผ่านการคัดเลือกต้องส่งวิดีทัศน์ความยาวไม่เกิน 15 นาที <strong>ภายในวันที่ 16 เมษายน พ.ศ.2564</strong><br/>เพื่อสำรองไว้ในกรณีที่มีเหตุขัดข้องระหว่างการนำเสนอจริง</u>
                    </p>
                    <p class="text-center">ส่ง VDO นำเสนอผ่าน Google drive link</p>
                </div>
            </div>
        @elseif(Auth::user()->participation_type === ParticipationType::Poster)
            <div class="row">
                <div class="col-12 col-lg-12 col-md-12">
                    <div class="form-group">
                        <label for="poster">โปสเตอร์ (PDF)</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="poster" name="poster" onchange="onInputFileChangeLabel(this.id, this.value)" />
                            <label class="custom-file-label" for="poster" id="poster_label" name="poster_label">โปสเตอร์</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-lg-12 col-md-12">
                    <p class="text-center">
                        <u>ผลงานที่ผ่านการคัดเลือกต้องส่งวิดีทัศน์ความยาวไม่เกิน 10 นาที โดยนำเสนอผ่านโปสเตอร์ตัวเอง <strong>ภายในวันที่ 16 เมษายน พ.ศ.2564</strong><br/>เพื่อสำรองไว้ในกรณีที่มีเหตุขัดข้องระหว่างการนำเสนอจริง</u>
                    </p>
                    <p class="text-center">ส่ง VDO นำเสนอผ่าน Google drive link</p>
                </div>
            </div>
        @endif
        <div class="text-center">
            <div class="form-group">
                {{-- <button class="btn btn-warning" type="submit">ส่งบทคัดย่อ</button> --}}
                <a class="btn btn-warning" href="{{ route('member.submission.index') }}">ส่งบทคัดย่อ</a>
            </div>
        </div>
    </form>
    {{-- @else
    <h4 class="text-center"><strong>ขณะนี้ยังไม่เปิดรับผลงาน หรือเลยกำหนดการมาแล้ว</strong></h4>
    @endif --}}
</div>

@endsection