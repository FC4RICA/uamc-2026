@extends('layouts.admin')

@section('title', 'จัดการคณะกรรมการ')

@section('committee', 'active')

@section('content')

<div class="container my-5">
    <div class="text-center">
        <h2><strong>ข้อมูลกรรมการ</strong></h2>
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
                            <option value="" selected disabled>เลือก</option>
                            <option value="นาย">นาย</option>
                            <option value="นาง">นาง</option>
                            <option value="นางสาว">นางสาว</option>
                            <option value="อื่น ๆ">อื่น ๆ</option>
                        </select>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="form-group">
                        <label for="position">ตำแหน่งทางวิชาการ</label>
                        <select id="position" name="position" class="custom-select" required>
                            <option value="" selected disabled>เลือก</option>
                            <option value="1">ไม่มี</option>
                            <option value="2">ศาสตราจารย์</option>
                            <option value="3">รองศาสตราจารย์</option>
                            <option value="4">ผู้ช่วยศาสตราจารย์</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-lg-6">
                    <div class="form-group">
                        <label for="firstname">ชื่อ</label>
                        <input id="firstname" name="firstname" type="text" class="form-control" placeholder="ชื่อ" required>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="form-group">
                        <label for="lastname">นามสกุล</label>
                        <input id="lastname" name="lastname" type="text" class="form-control" placeholder="นามสกุล" required>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-lg-6">
                <div class="form-group">
                    <label for="organization">หน่วยงาน/มหาวิทยาลัย</label>
                    <input id="organization" name="organization" class="form-control" type="text" required>
                </div>
            </div>
        </div>
        <div class="text-center">
            <div class="form-group">
                <button class="btn btn-warning" type="submit">เพิ่มข้อมูล</button>
            </div>
        </div>
    </form>
</div>

@endsection