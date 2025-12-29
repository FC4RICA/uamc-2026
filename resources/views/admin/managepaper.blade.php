@extends('layouts.admin')

@section('title', 'จัดการบทความ')

@section('paper', 'active')

@section('content')

<div class="container my-5">
    @if($search != null || $search != '')
        คำค้นหา: {{ $search }}
    @endif
    <div class="table-wrapper">
        <div class="table-title">
            <div class="row no-gutters">
                <div class="col-12 col-lg-2">
                    <h2>จัดการบทคัดย่อ</b></h2>
                </div>
                <div class="col-12 col-lg-10">
                    <form action="{{ url('search/paper') }}" method="POST">
                        {{ csrf_field() }}
                        <div class="row no-gutters">
                            <div class="col-12 col-lg-4">
                                <input class="form-control" type="text" id="words" name="words" >
                            </div>
                            <div class="col-12 col-lg-8">
                                <div class="input-group">
                                    <div class="form-check-inline">
                                        <input id="by" name="by" type="radio" value="papername" class="form-check-input" checked>ค้นหาด้วยชื่อผลงาน
                                    </div>
                                    <div class="form-check-inline">
                                        <input id="by" name="by" type="radio" value="author" class="form-check-input">ค้นหาด้วยชื่อผู้ส่ง
                                    </div>
                                    <div class="form-check-inline">
                                        <input id="by" name="by" type="radio" value="organization" class="form-check-input">ค้นหาด้วยชื่อมหาวิทยาลัย/สถาบัน
                                    </div>
                                    <button type="submit" class="btn btn-default input-group-addon"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>ลำดับ</th>
                        <th>ชื่อบทคัดย่อ</th>
                        <th>ผู้จัดทำ</th>
                        <th>มหาวิทยาลัย</th>
                        <th>สถานะ</th>
                        <th>การจัดการ</th>
                    </tr>
                </thead>
                <tbody>
                    @if($paper_data != null)
                    @foreach($paper_data as $i => $p)
                    <tr>
                        <?php $url = 'admin/paper/' . $p->id; ?>
                        <td>{{ $i + 1 }}</td>
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
                            {{-- <a href="{{ url($url) }}" class="settings" title="Settings" data-toggle="tooltip"><i class="fa fa-edit"></i></a> --}}
                            <a href="{{ route('admin.submission.show', ['id', $p->id]) }}" class="settings" title="Settings" data-toggle="tooltip"><i class="fa fa-edit"></i></a>
                        </td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
        </div>

    </div>
</div>

@endsection