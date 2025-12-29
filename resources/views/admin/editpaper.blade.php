    @extends('layouts.admin')

@section('title', 'จัดการบทคัดย่อ')

@section('paper', 'active')

@section('content')

<div class="container my-5">
    <div class="text-center">
        <h2><strong>จัดการบทคัดย่อ</strong></h2>
    </div>
    <hr>
    <form id="admineditpaper" name="admineditpaper" action="#" method="POST">
        {{ csrf_field() }}
        <div>
            <div class="row">
                <div class="col-12 col-lg-6">
                    <div class="form-group">
                        <label for="type">ประเภทบทความ</label>
                        <select id="type" name="type" class="custom-select" required>
                            @foreach($types as $t)
                                <option value="{{ $t->value }}" @selected($t->value == $paper->participation_type->value)>{{ $t->label() }}</option>
                            @endforeach
                            <!-- <option value="">เลือก</option> -->
                            <!-- <option value="อื่น ๆ">อื่น ๆ</option> -->
                        </select>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="form-group">
                        <label for="category">ชนิดบทความ</label>
                        <select id="category" name="category" class="custom-select" required>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" @selected($category->id == $paper->category_id)>{{ $category->title }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-lg-6">
                <div class="form-group">
                    <label for="name_th">ชื่อบทความภาษาไทย</label>
                    <input id="name_th" name="name_th" type="text" class="form-control-plaintext" placeholder="ภาษาไทย" value="{{ $paper->name_th }}" readonly="readonly">
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="form-group">
                    <label for="name_en">ชื่อบทความภาษาอังกฤษ</label>
                    <input id="name_en" name="name_en" type="text" class="form-control-plaintext" placeholder="ภาษาอังกฤษ" value="{{ $paper->name_en }}" readonly="readonly">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-lg-12">
                <div class="form-group">
                    <label for="keyword_th">Keyword</label>
                    <input id="keyword_th" name="keyword" type="text" class="form-control-plaintext" placeholder="ภาษาไทย" value="{{ $paper->keyword }}" readonly="readonly">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-lg-12">
                <label>Download File</label>
                <?php 
                $th_url = 'download/abstractTH/' . $paper->id;
                $en_url = 'download/abstractEN/' . $paper->id;
                $ex_url = 'download/extended/' . $paper->id;
                ?>
                <div class="btn-group">
                    <a href="{{ url($th_url) }}" class="btn btn-success"><i class="fas fa-file-download mr-3"></i><span>ดาวน์โหลดบทคัดย่อภาษาไทย</span></a>
                    <a href="{{ url($en_url) }}" class="btn btn-primary"><i class="fas fa-file-download mr-3"></i><span>ดาวน์โหลดบทคัดย่อภาษาอังกฤษ</span></a>
                    @if($paper->participation_type == 2)
                    <a href="{{ url($ex_url) }}" class="btn btn-warning"><i class="fas fa-file-download mr-3"></i><span>ดาวน์โหลดบทคัดย่อแบบขยาย</span></a>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-lg-6">
                <div class="form-group">
                    <label for="committee1">แต่งตั้งคณะกรรมการ คนที่ 1 </label>
                    <select id="committee1" name="committee1" class="custom-select">
                        <option value="" disabled>เลือก</option>
                        @foreach($committee as $com)
                            <option value="{{ $com->id }}" @selected($paper->committee1 == $com->id)>{{ $com->name .' '. $com->lastname }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <label for="committee2">แต่งตั้งคณะกรรมการ คนที่ 2 </label>
                <select id="committee2" name="committee2" class="custom-select">
                    <option value="" disabled>เลือก</option>
                    @foreach($committee as $com)
                        <option value="{{ $com->id }}" @selected($paper->committee2 == $com->id)>{{ $com->name .' '. $com->lastname }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-12 col-lg-6">
                <label for="committee3">แต่งตั้งคณะกรรมการ คนที่ 3 </label>
                <select id="committee3" name="committee3" class="custom-select">
                    <option value="" disabled>เลือก</option>
                    @foreach($committee as $com)
                        <option value="{{ $com->id }}" @selected($paper->committee3 == $com->id)>{{ $com->name .' '. $com->lastname }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-12 col-lg-6">
                <label for="committee4">แต่งตั้งคณะกรรมการ คนที่ 4 </label>
                <select id="committee4" name="committee4" class="custom-select">
                    <option value="" disabled>เลือก</option>
                    @foreach($committee as $com)
                        <option value="{{ $com->id }}" @selected($paper->committee4 == $com->id)>{{ $com->name .' '. $com->lastname }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-12 col-lg-6">
                <label for="committee5">แต่งตั้งคณะกรรมการ คนที่ 5 </label>
                <select id="committee5" name="committee5" class="custom-select">
                    <option value="" disabled>เลือก</option>
                    @foreach($committee as $com)
                        <option value="{{ $com->id }}" @selected($paper->committee5 == $com->id)>{{ $com->name .' '. $com->lastname }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-12 col-lg-6">
                <div class="form-group">
                    <label for="decision">สถานะ</label>
                    <select id="decision" name="decision" class="custom-select" required>
                        <option value="" disabled>เลือก</option>
                        <option value="1" @selected($paper->decision == 1)>ผ่าน</option>
                        <option value="-1" @selected($paper->decision == -1)>ไม่ผ่าน</option>
                        <option value="0" @selected($paper->decision == 0)>อยู่ระหว่างการพิจารณา</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-lg-12">
                <?php $agreement = "ต้องการ";
                if($paper->agreement == 0){
                    $agreement = "ไม่ต้องการ";
                }
                ?>
                <h4>ผลงานนี้ {{ $agreement }} เผยแพร่ผลงานผ่าน Book of Proceeding</h4>
            </div>
        </div>
        <div class="text-center">
            <div class="form-group">
                <button class="btn btn-warning" type="submit">แก้ไขข้อมูล</button>
            </div>
        </div>
    </form>
</div>

@endsection