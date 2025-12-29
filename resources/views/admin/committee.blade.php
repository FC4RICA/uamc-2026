@extends('layouts.admin')

@section('title', 'จัดการคณะกรรมการ')

@section('committee', 'active')

@section('content')

<div class="container my-5">
    @if($search != null)
    คำค้นหา: {{ $search }}
    @endif
    <div class="table-wrapper">
        <div class="table-title">
            <div class="row no-gutters">
                <div class="col-12 col-lg-2">
                    <h2>จัดการคณะกรรมการ</b></h2>
                </div>
                <div class="col-12 col-lg-10">
                    <form action="{{ url('search/committee') }}" method="POST">
                        {{ csrf_field() }}
                        <div class="row no-gutters">
                            <div class="col-12 col-lg-4">
                                <input class="form-control" type="text" id="words" name="words">
                            </div>
                            <div class="col-12 col-lg-8">
                                <div class="input-group">
                                    <div class="form-check-inline">
                                        <input id="by" name="by" type="radio" value="name" class="form-check-input" checked>ค้นหาด้วยชื่อ
                                    </div>
                                    <div class="form-check-inline">
                                        <input id="by" name="by" type="radio" value="organization" class="form-check-input">ค้นหาด้วยชื่อมหาวิทยาลัย/สถาบัน
                                    </div>
                                    <button type="submit" class="btn btn-default input-group-addon"><i class="fa fa-search"></i></button>
                                    <a href="{{ route('admin.committee.create') }}" class="btn btn-primary"><i class="fa fa-plus-circle"></i><span>เพิ่มกรรมการ</span></a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ลำดับ</th>
                        <th width=10%>ตำแหน่ง</th>
                        <th width=30%>ชื่อกรรมการ</th>
                        <th width=40%>หน่วยงาน/มหาวิทยาลัย</th>
                        <th width=15%>การจัดการ</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($committee as $i => $c)
                    <tr>
                        <td class="text-center">{{ $i + 1 }}</td>
                        <td><a href="{{ route('admin.committee.show', ['id' => $c->id]) }}">{{ $c->name .'   '. $c->lastname}}</a></td>
                        <td>{{ $c->title }}</td>
                        <td>{{ $c->organization }}</td>
                        <td class="text-center">
                            <a href="{{ route('admin.committee.show', ['id' => $c->id]) }}" class="settings" title="Settings" data-toggle="tooltip"><i class="fa fa-edit"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- <div class="clearfix">
            <div class="hint-text">Showing <b>5</b> out of <b>25</b> entries</div>
            <ul class="pagination">
                <li class="page-item disabled"><a href="#">Previous</a></li>
                <li class="page-item"><a href="#" class="page-link">1</a></li>
                <li class="page-item"><a href="#" class="page-link">2</a></li>
                <li class="page-item "><a href="#" class="page-link">3</a></li>
                <li class="page-item"><a href="#" class="page-link">4</a></li>
                <li class="page-item"><a href="#" class="page-link">5</a></li>
                <li class="page-item"><a href="#" class="page-link">Next</a></li>
            </ul>
        </div> -->
    </div>
</div>

@endsection