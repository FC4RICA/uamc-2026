@php
    use App\Enums\ParticipationType;
@endphp

@extends('layouts.member')

@section('title', 'แก้ไขบทคัดย่อ')
@section('check', 'active')

@section('content')
<div class="container my-5">
    <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
            <h2 class="text-center"><strong>แก้ไขบทคัดย่อ</strong></h2>
        </div>
    </div>
    <hr>
    {{-- @if($status == 1) --}}
    <form id="editpaper" name="editpaper" action='{{ route('member.submission.update', ['id' => $research->research_id]) }}' method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
        <!-- @csrf -->
        <!-- @method('POST') -->
        <div>
            <div class="row">
                <div class="col-12 col-lg-6">
                    <div class="form-group">
                        <label for="type">ประเภทบทคัดย่อ</label>
                        <select id="type" name="type" class="custom-select">
                            <option value="{{ $participation_type->value }}" selected>{{ $participation_type->label() }}</option>
                        </select>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="form-group">
                        <label for="category">กลุ่มบทคัดย่อ</label>
                        <select id="category" name="category" class="custom-select" required>
                            @foreach($categories as $category)
                                @if($research->category_id == $category->id)
                                    <option value="{{ $category->id }}" selected>{{ $category->title}}</option>
                                @else
                                    <option value="{{ $category->id }}">{{ $category->title}}</option>
                                @endif
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
                        <option value="">เลือก</option>
                        @foreach($categories as $category)
                            @if($research->category_id2 == $category->id)
                                <option value="{{ $category->id }}" selected>{{ $category->title}}</option>
                            @else
                                <option value="{{ $category->id }}">{{ $category->title}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="form-group">
                    <label for="category3">กลุ่มบทคัดย่อ (สำรอง 2)</label>
                    <select id="category3" name="category3" class="custom-select">
                        <option value="">เลือก</option>
                        @foreach($categories as $category)
                            @if($research->category_id3 == $category->id)
                                <option value="{{ $category->id }}" selected>{{ $category->title}}</option>
                            @else
                                <option value="{{ $category->id }}">{{ $category->title}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-lg-6">
                <div class="form-group">
                    <label for="name_th">ชื่อบทคัดย่อภาษาไทย</label>
                    <input id="name_th" name="name_th" type="text" class="form-control" placeholder="ภาษาไทย" value="{{ $research->name_th }}" required>
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="form-group">
                    <label for="name_en">ชื่อบทคัดย่อภาษาอังกฤษ</label>
                    <input id="name_en" name="name_en" type="text" class="form-control" placeholder="ภาษาอังกฤษ" value="{{ $research->name_en }}" required>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-lg-12">
                <div class="form-group">
                    <label for="keyword">Keyword</label>
                    <input id="keyword" name="keyword" type="text" class="form-control" placeholder="Keyword" value="{{ $research->keyword }}" required>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-9 col-lg-9">
                <div class="form-group">
                    <label for="abstract_th">บทคัดย่อภาษาไทย (PDF)</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="abstract_th" name="abstract_th" onchange="onInputFileChangeLabel(this.id, this.value)" require />
                        <label class="custom-file-label" for="abstract_th" id="abstract_th_label" name="abstract_th_label">บทคัดย่อภาษาไทย</label>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-3 col-lg-3 align-self-center text-center">
                <?php
                $th_url = 'download/abstractTH/' . $research->research_id;
                ?>
                <a href="{{ url($th_url) }}" class="btn btn-primary"><i class="fas fa-file-download mr-3"></i>ดาวน์โหลดบทคัดย่อภาษาไทย</a>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-9 col-lg-9">
                <div class="form-group">
                    <label for="abstract_en">บทคัดย่อภาษาอังกฤษ (PDF)</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="abstract_en" name="abstract_en" onchange="onInputFileChangeLabel(this.id, this.value)" require />
                        <label class="custom-file-label" for="abstract_en" id="abstract_en_label" name="abstract_en_label">บทคัดย่อภาษาอังกฤษ</label>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-3 col-lg-3 align-self-center text-center">
                <?php
                $en_url = 'download/abstractEN/' . $research->research_id;
                ?>
                <a href="{{ url($en_url) }}" class="btn btn-primary ml-2"><i class="fas fa-file-download mr-3"></i>ดาวน์โหลดบทคัดย่อภาษาอังกฤษ</a>
            </div>
        </div>
        @if($research->participation_type == ParticipationType::Oral)
            <div class="row">
                <div class="col-12 col-lg-12">
                    <label for="agreement">ต้องการเผยแพร่ผลงานฉบับเต็มผ่าน Book of Proceedings หรือไม่</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="proceedingAgreement" value="1" onclick="onProceedingChange()" @checked($research->agreement === 1) />
                        <label class="form-check-label" for="agreement">ต้องการ</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="proceedingAgreement" value="0" onclick="onProceedingChange()" @checked($research->agreement === 0) />
                        <label class="form-check-label" for="agreement">ไม่ต้องการ</label>
                    </div>
                    <p>
                        <u>หมายเหตุ</u> สำหรับผลงานที่ต้องการเผยแพร่เมื่อผ่านการพิจาณาจากคณะกรรมการให้ลงใน Book of Proceedings แล้ว จะมี e-mail แจ้งไปเพื่อให้ดำเนินการในขั้นตอนต่อไปภายใน 1 สัปดาห์
                    </p>
                </div>
            </div>
            <div id="full_text_upload" class="row">
                <div class="col-12 col-lg-9 col-md-9">
                    <div class="form-group">
                        <label for="full_text">ผลงานฉบับเต็ม <u>"สำหรับผู้ที่<strong>ต้องการ</strong>เผยแพร่ผลงานฉบับเต็มผ่าน Book of proceedings"</u> (PDF)</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="full_text" name="full_text" onchange="onInputFileChangeLabel(this.id, this.value)" require @disabled($research->agreement === 0) />
                            <label class="custom-file-label" for="full_text" id="full_text_label" name="efull_text_label">ผลงานฉบับเต็ม</label>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-3 col-lg-3 align-self-center text-center">
                    <?php
                    $full_url = 'download/fulltext/' . $research->research_id;
                    ?>
                    <a href="{{ url($full_url) }}" class="btn btn-primary ml-2 <?php if ($research->agreement === 0 || $research->fulltext_path === null) echo 'disabled'; ?>"><i class="fas fa-file-download mr-3"></i>ดาวน์โหลดฉบับเต็ม</a>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-lg-9 col-md-9">
                    <div class="form-group">
                    <label for="extended_abstract">บทคัดย่อแบบขยาย <u>"สำหรับผู้ที่<strong>ไม่ต้องการ</strong>เผยแพร่ผลงานฉบับเต็มผ่าน Book of proceedings"</u> (PDF)</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="extended_abstract" name="extended_abstract" onchange="onInputFileChangeLabel(this.id, this.value)" require @disabled($research->agreement === 1) />
                            <label class="custom-file-label" for="extended_abstract" id="extended_abstract_label" name="extended_abstract_label">บทคัดย่อแบบขยาย</label>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-3 col-lg-3 align-self-center text-center">
                    <?php
                    $ex_url = 'download/extended/' . $research->research_id;
                    ?>
                    <a href="{{ url($ex_url) }}" class="btn btn-primary ml-2 <?php if ($research->agreement === 1 || $research->extended_abstract === null) echo 'disabled'; ?>"><i class="fas fa-file-download mr-3"></i>ดาวน์โหลดบทคัดย่อแบบขยาย</a>
                </div>
            </div>
        @elseif($research->participation_type == ParticipationType::Poster)
            <div class="row">
                <div class="col-12 col-lg-9 col-md-9">
                    <div class="form-group">
                        <label for="poster">โปสเตอร์ (PDF)</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="poster" name="poster" onchange="onInputFileChangeLabel(this.id, this.value)" require />
                            <label class="custom-file-label" for="poster" id="poster_label" name="poster_label">โปสเตอร์</label>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-3 col-lg-3 align-self-center text-center">
                    <?php
                    $ex_url = 'download/poster/' . $research->research_id;
                    ?>
                    <a href="{{ url($ex_url) }}" class="btn btn-primary ml-2 <?php if ($research->poster_path == null) echo 'disabled' ?>"><i class="fas fa-file-download mr-3"></i>ดาวน์โหลดโปสเตอร์</a>
                </div>
            </div>
        @endif
        <div class="text-center">
            <div class="form-group">
                {{-- <button class="btn btn-warning" type="submit">แก้ไขข้อมูล</button> --}}
                <a class="btn btn-warning" href="{{ route('member.submission.index') }}">แก้ไขข้อมูล</a>
                <?php $del_url = 'member/delete/' . $research->research_id; ?>
                <a href="{{ url($del_url) }}" class="btn btn-danger">ลบบทคัดย่อ</a>
            </div>
        </div>
    </form>
    {{-- @else
    <div class="row">
        <div class="col-12 col-md-2 col-lg-2">
            <strong>ประเภทบทคัดย่อ:</strong>
        </div>
        <div class="col-12 col-md-4 col-lg-4">
            @foreach($type as $ty)
            @if($research->type == $ty->id)
            {{ $ty->title}}
            @endif
            @endforeach
        </div>
        <div class="col-12 col-md-2 col-lg-2">
            <strong>ชนิดบทคัดย่อ:</strong>
        </div>
        <div class="col-12 col-md-4 col-lg-4">
            @foreach($category as $cat)
            @if($research->category == $cat->id)
            {{ $cat->title}}
            @endif
            @endforeach
        </div>
    </div>
    <div class="row my-2">
        <div class="col-12 col-md-2 col-lg-2">
            <strong>ชื่อบทคัดย่อภาษาไทย:</strong>
        </div>
        <div class="col-12 col-md-4 col-lg-4">
            {{ $research->name_th }}
        </div>
        <div class="col-12 col-md-2 col-lg-2">
            <strong>ชื่อบทคัดย่อภาษาอังกฤษ:</strong>
        </div>
        <div class="col-12 col-md-4 col-lg-4">
            {{ $research->name_en }}
        </div>
    </div>
    <div class="row my-2">
        <div class="col-12 col-md-2 col-lg-2">
            <strong>Keyword:</strong>
        </div>
        <div class="col-12 col-md-4 col-lg-4">
            {{ $research->keyword }}
        </div>
    </div>
    <div class="row my-2">
        <div class="col-12 col-md-4 col-lg-4 text-center">
            <?php
            // $th_url = 'download/abstractTH/' . $research->id;
            ?>
            <a href="{{ url($th_url) }}" class="btn btn-primary"><i class="fas fa-file-download mr-3"></i>ดาวน์โหลดบทคัดย่อภาษาไทย</a>
        </div>
        <div class="col-12 col-md-4 col-lg-4 text-center">
            <?php
            // $en_url = 'download/abstractEN/' . $research->id;
            ?>
            <a href="{{ url($en_url) }}" class="btn btn-primary"><i class="fas fa-file-download mr-3"></i>ดาวน์โหลดบทคัดย่อภาษาอังกฤษ</a>
        </div>
        @if($research->type == 2 && $research->agreement == 0)
        <div class="col-12 col-md-4 col-lg-4 text-center">
            <?php
            // $ex_url = 'download/extended/' . $research->id;
            ?>
            <a href="{{ url($ex_url) }}" class="btn btn-primary"><i class="fas fa-file-download mr-3"></i>ดาวน์โหลดบทคัดย่อแบบขยาย</a>
        </div>
        @elseif($research->type == 2 && $research->agreement == 1)
        <div class="col-12 col-md-4 col-lg-4 text-center">
            <?php
            // $full_url = 'download/fulltext/' . $research->id;
            ?>
            <a href="{{ url($full_url) }}" class="btn btn-primary ml-2 <?php if ($research->agreement == 0) echo 'disabled'; ?>"><i class="fas fa-file-download mr-3"></i>ดาวน์โหลดฉบับเต็ม</a>
        </div>
        @elseif ($research->type == 3)
        <div class="col-12 col-md-4 col-lg-4 text-center">
            <?php
            // $ex_url = 'download/poster/' . $research->id;
            ?>
            <a href="{{ url($ex_url) }}" class="btn btn-primary"><i class="fas fa-file-download mr-3"></i>ดาวน์โหลดโปสเตอร์</a>
        </div>
        @endif
    </div>
    @endif --}}
</div>

@endsection