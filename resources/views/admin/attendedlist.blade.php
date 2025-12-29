@extends('layouts.admin')

@section('title', 'จัดการคณะกรรมการ')

@section('attended', 'active')

@section('content')

<div class="container my-5">
    <div class="text-center">
        <h1><strong>รายชื่อผู้เข้าร่วมงาน</strong></h1>
    </div>
    <hr>
    <div class="table-wrapper">
        <div>
            <label>
                แสดงผู้ลงทะเบียนข้าร่วมจากประเภทการเข้าร่วม
            </label>
            <select class="custom-select" id="attendtype" name="attendtype">
                <option value="0" selected>ทั้งหมด</option>
                <option value="1">เข้าร่วมงาน</option>
                <option value="2">การนำเสนอแบบบรรยาย (Oral Presentation)</option>
                <option value="3">การนำเสนอแบบโปสเตอร์ (Poster Presentation)</option>
            </select>
            <a href="{{ url('v1/export') }}" class="btn btn-success">Export Excel</a>
        </div>
        <div class="table-responsive">

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ลำดับ</th>
                        <th>ชื่อ - นามสกุล</th>
                        <th>สถาบัน/หน่วยงาน</th>
                        <th>ประเภทการเข้าร่วม</th>
                        <th>ดูข้อมูล</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($attendee != null)
                    @foreach($attendee as $i => $data)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <?php $name = $data->name . ' ' . $data->lastname; ?>
                        <td>{{ $name }}</td>
                        <td>{{ $data->organization }}</td>
                        <td>{{ $data->participation_type->label() }}</td>
                        <td><button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#exampleModalCenter" onclick="getAttendedData(<?php echo $data->id; ?>)">
                                <i class="fas fa-edit"></i>
                            </button></td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

@if($attendee != null)
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">ข้อมูลผู้เข้าร่วม</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editprofile" name="editprofile">
                    <div>
                        <h3>ข้อมูลการเข้าใช้งาน</h3>
                        <div class="form-group">
                            <label for="email">อีเมล</label>
                            <input id="email" name="email" type="email" class="form-control-plaintext" placeholder="uamc2020@kmutt.ac.th" readonly>
                        </div>
                    </div>
                    <div>
                        <h3>ข้อมูลส่วนตัว</h3>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="prefix">คำนำหน้า</label>
                                    <input id="prefix" type="text" class="form-control-plaintext" readonly />
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="position">ตำแหน่งทางวิชาการ</label>
                                    <input id="position" type="text" class="form-control-plaintext" readonly />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="firstname">ชื่อ</label>
                                    <input id="firstname" name="firstname" type="text" class="form-control-plaintext" placeholder="ชื่อ" readonly>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="lastname">นามสกุล</label>
                                    <input id="lastname" name="lastname" type="text" class="form-control-plaintext" placeholder="นามสกุล" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <h3>ข้อมูลการศึกษา การทำงาน</h3>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="education">ระดับการศึกษา</label>
                                    <input id="education" type="text" class="form-control-plaintext" readonly />
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="occupation">อาชีพ</label>
                                    <input id="occupation" type="text" class="form-control-plaintext" readonly />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="organization">สถานที่ทำงาน/หน่วยงาน/สถาบันการศึกษา</label>
                                    <input id="organization" type="text" class="form-control-plaintext" readonly />
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="phone">เบอร์โทร</label>
                                    <input id="phone" name="phone" class="form-control-plaintext" type="tel" placeholder="เบอร์โทร" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label for="type">ประเภทการเข้าร่วม</label>
                                    <input id="type" type="text" class="form-control-plaintext" readonly />
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <label for="food">ประเภทอาหาร</label>
                                <input id="food" type="text" class="form-control-plaintext" readonly />
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                <button id="showdeleteBTN" type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteMembers">ลบข้อมูลผู้เข้าร่วม</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteMembers" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">ลบข้อมูล</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>
                    ต้องการลบข้อมูล <span class="deleteName">ฟฟฟฟฟฟ</span> ใช่หรือไม่<br />
                    ระบบจะทำการลบข้อมูลทั้งหมดของ <span class="deleteName">ฟฟฟฟฟฟ</span> (ข้อมูลส่วนตัว, ข้อมูลการส่งบทคัดย่อ และบทคัดย่อ)
                </p>
            </div>
            <div class="modal-footer">
                <form action="{{ url('/v1/deleteattended') }}" method="GET">
                    {{ csrf_field() }}
                    <input id="id" name="id" type="text" hidden />
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                    <button type="submit" class="btn btn-danger">ลบข้อมูล</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endif
@endsection