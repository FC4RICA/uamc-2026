@extends('layouts.admin')

@section('title', 'จัดการคณะกรรมการ')

@section('committee', 'active')

@section('content')

<div class="container my-5">
    <div class="text-center">
        <h2><strong>{{ $committee->name. '  '. $committee->lastname }}</strong></h2>
    </div>
    <hr>
    <form id="editcommittee" name="editcommittee" action="#" method="POST">
        {{ csrf_field() }}
        <div>
            <div class="row">
                <div class="col-12 col-lg-6">
                    <div class="form-group">
                        <label for="prefix">คำนำหน้า</label>
                        <select id="prefix" name="prefix" class="custom-select" required>
                            <option value="" disabled>เลือก</option>
                            <option value="นาย" @selected($committee->prefix == 'นาย')>นาย</option>
                            <option value="นาง" @selected($committee->prefix == 'นาง')>นาง</option>
                            <option value="นางสาว" @selected($committee->prefix == 'นางสาว')>นางสาว</option>
                            <option value="อื่น ๆ" @selected($committee->prefix == 'อื่น ๆ')>อื่น ๆ</option>
                        </select>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="form-group">
                        <label for="position">ตำแหน่งทางวิชาการ</label>
                        <select id="position" name="position" class="custom-select" required>
                            <option value="" disabled>เลือก</option>
                            <option value="1" @selected($committee->title == 1)>ไม่มี</option>
                            <option value="2" @selected($committee->title == 2)>ศาสตราจารย์</option>
                            <option value="3" @selected($committee->title == 3)>รองศาสตราจารย์</option>
                            <option value="4" @selected($committee->title == 4)>ผู้ช่วยศาสตราจารย์</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-lg-6">
                    <div class="form-group">
                        <label for="firstname">ชื่อ</label>
                        <input id="firstname" name="firstname" type="text" class="form-control" placeholder="ชื่อ" value="{{ $committee->name }}" required>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="form-group">
                        <label for="lastname">นามสกุล</label>
                        <input id="lastname" name="lastname" type="text" class="form-control" placeholder="นามสกุล" value="{{ $committee->lastname }}" required>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-lg-6">
                <div class="form-group">
                    <label for="organization">หน่วยงาน/มหาวิทยาลัย</label>
                    <input id="organization" name="organization" class="form-control" type="text" value="{{ $committee->organization }}" required>
                </div>
            </div>
        </div>
        <div class="text-center">
            <div class="form-group">
                <button class="btn btn-warning" type="submit">แก้ไขข้อมูล</button>
                <?php $del_url = 'admin/committee/delete/' . $committee->id; ?>
                <a href="{{ url($del_url) }}" class="btn btn-danger">ลบข้อมูล</a>
            </div>
        </div>
    </form>
    <div>
        <div class="text-center mt-5">
            <h2><strong>บทความที่รับผิดชอบ</strong></h2>
        </div>
        <hr>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>ลำดับ</th>
                    <th>ชื่อบทความ</th>
                    <th>ผู้จัดทำ</th>
                    <th>มหาวิทยาลัย</th>
                    <th>สถานะ</th>
                    <th>การจัดการ</th>
                </tr>
            </thead>
            <tbody>
                @if($paper_data != null)
                <?php $i = 1; ?>
                @foreach($paper_data as $p)
                <tr>
                    <?php $url = 'admin/paper/' . $p->id; ?>
                    <td>{{ $i }}</td>
                    <td><a href="{{ url($url) }}">{{ $p->name_th .'/'. $p->name_en }}</a></td>
                    <td>{{ $p->name .' '. $p->lastname }}</td>
                    <td>{{ $p->organization }}</td>
                    @if($p->decision == 1)
                    <td><span class="status text-success">&bull;</span>ผ่านการพิจารณา</td>
                    @elseif($p->decision == -1)
                    <td><span class="status text-danger">&bull;</span>ไม่ผ่านการพิจารณา</td>
                    @else
                    <td><span class="status text-warning">&bull;</span>อยู่ระหว่างการพิจารณา</td>
                    @endif
                    <td class="text-center">
                        <a href="{{ url($url) }}" class="settings" title="Settings" data-toggle="tooltip"><i class="fa fa-edit"></i></a>
                    </td>
                </tr>
                <?php $i++; ?>
                @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>

@endsection