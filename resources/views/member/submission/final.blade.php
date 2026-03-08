@extends('layouts.member')

@section('title', 'ส่งเอกสารรอบที่ 2')
@section('final', 'active')

@section('content')
    <div class="container px-4 my-4">
        <div class="text-center">
            <h2><strong>ส่งเอกสารรอบที่ 2</strong></h2>
        </div>
        <hr class="separator">

        @if (! $finalRound) {{-- Final submission files form  --}}
            <form id="final-submission-form" action='{{ route('member.submission.final.store') }}' method="POST"
                enctype="multipart/form-data" name="final-submission-form" class="mt-4">
                @csrf

                @if ($user->isOral())
                    <h4 class="mt-4 fw-bold">การส่งผลงานแบบบรรยาย</h4>
                    <ol>
                        <li>บทคัดย่อแบบขยาย (Extended Abstract) ไม่เกิน 10 หน้า โดยใช้รูปแบบ <a href="{{ route('public.templates') }}">Template</a>
                            ที่ทางเจ้าภาพได้เตรียมไว้ให้เป็นแนวทางแต่สามารถใช้ตัวสมการจาก MathType หรือ Equation
                            หรือโปรแกรมใดก็ได้ตามความที่ผู้ส่งผลงานเห็นสมควร</li>
                        <li>หนังสือรับรองตาม <a href="{{ route('public.templates') }}">Template</a> ในไฟล์ “หนังสือรับรองจากอาจารย์ที่ปรึกษา” จากอาจารย์ที่ปรึกษา</li>
                        <li>วิธีตั้งชื่อไฟล์บทคัดย่อแบบขยาย ชื่อ_นามสกุล_Extended.pdf</li>
                    </ol>
                    <p><span class="fst-italic">หมายเหตุ:</span>
                        <ul>
                            <li>ให้ใช้ชื่อ นามสกุล ภาษาไทยของนักศึกษาผู้ส่งผลงานเพียงคนเดียว ไม่ต้องใส่นาย/นางสาว</li>
                            <li>ขอให้นักศึกษาเตรียมไฟล์นําเสนอมาเองในวันงานประชุม</li>
                        </ul>     
                    </p>

                    <div class="form-group mt-5">
                        <label>บทคัดย่อแบบขยาย (PDF)</label>
                        <input type="file" name="extended_abstract"
                            class="form-control @error('extended_abstract') is-invalid @enderror"
                            onchange="onInputFileChangeLabel(this.id, this.value)" required>
                        @error('extended_abstract')
                            <label class="error">{{ $message }}</label>
                        @enderror
                    </div>

                @elseif ($user->isPoster())
                    <h4 class="mt-4 fw-bold">การส่งผลงานแบบโปสเตอร์</h4>
                    <ol>
                        <li>ไฟล์โปสเตอร์ ตามรูปแบบ <a href="{{ route('public.templates') }}">Template</a> ที่ทางเจ้าภาพได้เตรียมไว้ให้เป็นแนวทาง สามารถปรับหัวข้อในโปสเตอร์
                            ได้ตามความเหมาะสมแต่ขอให้ใช้รูปแบบและขนาดตัวอักษรตามที่กําหนดไว้ให้ทั้งนี้ผู้ส่งผลงานต้องทําการจัดพิมพ์โปสเตอร์ขนาด A1 เพื่อมานําเสนอด้วยตนเอง</li>
                        <li>หนังสือรับรองตาม <a href="{{ route('public.templates') }}">Template</a> ในไฟล์ “หนังสือรับรองจากอาจารย์ที่ปรึกษา” จากอาจารย์ที่ปรึกษา</li>
                        <li>วิธีตั้งชื่อไฟล์โปสเตอร์ ชื่อ_นามสกุล_Poster.pdf</li>
                    </ol>
                    <p><span class="fst-italic">หมายเหตุ:</span>
                        <ul>
                            <li>ให้ใช้ชื่อ นามสกุล ภาษาไทยของนักศึกษาผู้ส่งผลงานเพียงคนเดียว ไม่ต้องใส่นาย/นางสาว</li>
                        </ul>     
                    </p>

                    <div class="form-group mt-5">
                        <label>โปสเตอร์ (PDF)</label>
                        <input type="file" name="poster"
                            class="form-control @error('poster') is-invalid @enderror"
                            onchange="onInputFileChangeLabel(this.id, this.value)" required>
                        @error('poster')
                            <label class="error">{{ $message }}</label>
                        @enderror
                    </div>
                @endif

                <div class="form-group">
                    <label>หนังสือรับรองจากอาจารย์ที่ปรึกษา (PDF)</label>
                    <input type="file" name="recommendation_letter"
                        class="form-control @error('recommendation_letter') is-invalid @enderror"
                        onchange="onInputFileChangeLabel(this.id, this.value)" required>
                    @error('recommendation_letter')
                        <label class="error">{{ $message }}</label>
                    @enderror
                </div>

                <div class="text-center">
                    <button id="submit-final-submission" class="btn btn-warning" type="submit">
                        ส่งเอกสาร
                    </button>
                </div>
            </form>

        @else {{-- Final Submission files --}}
            <h4 class="fw-bold mt-4">ไฟล์ที่ส่งแล้ว</h4>

            @if ($user->isOral())
                <div class="mb-3">
                    <label>บทคัดย่อแบบขยาย</label>
                    <div class="mt-1 mb-2 d-flex gap-3">
                        @foreach ($finalRound->extendedAbstractFiles as $file)
                            <x-submission-file-card :file="$file" />
                        @endforeach
                    </div>
                </div>
            @elseif ($user->isPoster())
                <div class="mb-3">
                    <label>โปสเตอร์</label>
                    <div class="mt-1 mb-2 d-flex gap-3">
                        @foreach ($finalRound->posterFiles as $file)
                            <x-submission-file-card :file="$file" />
                        @endforeach
                    </div>
                </div>
            @endif

            <div class="mb-5">
                <label>หนังสือรับรอง</label>
                <div class="mt-1 mb-2 d-flex gap-3">
                    @foreach ($finalRound->recommendationLetterFiles as $file)
                        <x-submission-file-card :file="$file" />
                    @endforeach
                </div>
            </div>

            <h4 class="fw-bold">อัปโหลดไฟล์ใหม่ (สำหรับการแก้ไข)</h4>

            @if ($user->isOral())
                <form id="extended-abstract-form" action='{{ route('member.submission.final.update') }}' method="POST"
                    enctype="multipart/form-data" name="extended-abstract-form" class="mt-4 row align-items-end">
                    @csrf
                    @method('PUT')
                    <div class="form-group mb-0 col-12 col-lg-6">
                        <label>บทคัดย่อแบบขยาย (PDF)</label>
                        <input type="file" name="extended_abstract"
                            class="form-control @error('extended_abstract') is-invalid @enderror"
                            onchange="onInputFileChangeLabel(this.id, this.value)" required>
                        @error('extended_abstract')
                            <label class="error">{{ $message }}</label>
                        @enderror
                    </div>

                    <div class="text-center col-12 col-lg-6">
                        <button id="submit-extended-abstract" class="btn btn-warning" type="submit">
                            อัพโหลดไฟล์บทคัดย่อแบบขยายใหม่
                        </button>
                    </div>
                </form>
            @endif

            @if ($user->isPoster())
                <form id="poster-form" action='{{ route('member.submission.final.update') }}' method="POST"
                enctype="multipart/form-data" name="poster-form" class="mt-4 row align-items-end">
                @csrf
                @method('PUT')
                <div class="form-group mb-0 col-12 col-md-6">
                    <label>โปสเตอร์ (PDF)</label>
                    <input type="file" name="poster"
                        class="form-control @error('poster') is-invalid @enderror"
                        onchange="onInputFileChangeLabel(this.id, this.value)" required>
                    @error('poster')
                        <label class="error">{{ $message }}</label>
                    @enderror
                </div>

                <div class="col-6 mt-2">
                    <button id="submit-poster" class="btn btn-warning" type="submit">
                        อัพโหลดไฟล์โปสเตอร์ใหม่
                    </button>
                </div>
            </form>
            @endif

            <form id="recommendation-letter-form" action='{{ route('member.submission.final.update') }}' method="POST"
                enctype="multipart/form-data" name="recommendation-letter-form" class="mt-4 row align-items-end">
                @csrf
                @method('PUT')
                <div class="form-group mb-0 col-12 col-md-6">
                    <label>หนังสือรับรองจากอาจารย์ที่ปรึกษา (PDF)</label>
                    <input type="file" name="recommendation_letter"
                        class="form-control @error('recommendation_letter') is-invalid @enderror"
                        onchange="onInputFileChangeLabel(this.id, this.value)" required>
                    @error('recommendation_letter')
                        <label class="error">{{ $message }}</label>
                    @enderror
                </div>

                <div class="col-6 mt-2">
                    <button id="submit-recommendation-letter" class="btn btn-warning" type="submit">
                        อัพโหลดไฟล์หนังสือรับรองใหม่
                    </button>
                </div>
            </form>
        @endif
    </div>
@endsection