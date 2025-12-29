@extends('layouts.admin')
@section('title', 'Administrator')
@section('dashboard', 'active')

@section('content')

<div class="container my-5">
    <div class="text-center">
        <h1><strong>แก้ไขกำหนดการ/ตารางดำเนินการ</strong></h1>
    </div>
    <hr>
    <form id="schedule" name="schedule" method="POST" action="#">
        {{ csrf_field() }}
        <div>
            <div class="row">
                <div class="col-12 col-lg-6">
                    <div class="form-group">
                        <label for="sche_name">กำหนดการ</label>
                        <input id="sche_name" name="sche_name" type="text" class="form-control" placeholder="กำหนดการ" value="{{ $schedule->sch_name }}" require>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="form-group">
                        <label for="sche_date">วันที่</label>
                        <input id="sche_date" name="sche_date" type="date" class="form-control" value="{{ $schedule->sch_date }}" require>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label for="sche_detail">รายละเอียด</label>
                        <textarea id="sche_detail" name="sche_detail" class="form-control" placeholder="รายละเอียด" rows="5" require>{{ $schedule->sch_detail }}</textarea>
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
                            @if($schedule->sch_type == 1)
                            <option value="1" selected>กำหนดการ</option>
                            <option value="2">ตารางดำเนินการ</option>
                            @elseif($schedule->sch_type == 2)
                            <option value="1">กำหนดการ</option>
                            <option value="2" selected>ตารางดำเนินการ</option>
                            @endif
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-success">ยืนยัน</button>
            <?php $url = '/admin/shedule/delete/'. $schedule->id; ?>
            <a href="{{ url($url) }}" class="btn btn-danger">ลบข้อมูล</a>
        </div>
    </form>
</div>

@endsection