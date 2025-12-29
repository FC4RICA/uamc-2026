@extends('layouts.admin')
@section('title', 'Administrator')
@section('dashboard', 'active')

@section('content')

<div class="container my-5">
    <div class="text-center">
        <h1><strong>เพิ่มกำหนดการ/ตารางดำเนินการ</strong></h1>
    </div>
    <hr>
    <form id="schedule" name="schedule" method="POST" action="#">
        {{ csrf_field() }}
        <div>
            <div class="row">
                <div class="col-12 col-lg-6">
                    <div class="form-group">
                        <label for="sche_name">กำหนดการ</label>
                        <input id="sche_name" name="sche_name" type="text" class="form-control" placeholder="กำหนดการ" require>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="form-group">
                        <label for="sche_date">วันที่</label>
                        <input id="sche_date" name="sche_date" type="date" class="form-control" require>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label for="sche_detail">รายละเอียด</label>
                        <textarea id="sche_detail" name="sche_detail" class="form-control" placeholder="รายละเอียด" rows="5" require></textarea>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label for="sche_type">ประเภท</label>
                        <select id="sche_type" name="sche_type" class="custom-select" require>
                            <option value="">เลือก</option>
                            <option value="1">กำหนดการ</option>
                            <option value="2">ตารางดำเนินการ</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-success">ยืนยัน</button>
        </div>
    </form>
</div>

@endsection