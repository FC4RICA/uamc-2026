@extends('layouts.public')

@section('title', 'ประกาศรายชื่อ')
@section('attendend', 'active')

@section('content')

<div class="container my-5">
    <h1 class="text-center"><strong>ประกาศรายชื่อผู้เข้าร่วมงาน</strong></h1>
    <hr>

    <div class="table-responsive">
        <table class="table table-hover">
            <tbody>
                <tr>
                    <td>
                        <p>
                            <strong>ผลงานที่ผ่านการคัดเลือกแบบโปสเตอร์</strong><br/>
                            <span style="font-size: 1rem;">(Poster Presentation)</span>
                        </p>
                    </td>
                    <td class="text-center" colspan="2">
                        <a href="{{ asset('download/announcement/UAMC2021-poster-presentation.pdf') }}" class="btn btn-outline-warning w-100" target="_blank" rel="noopener noreferrer">
                            ดาวน์โหลด PDF
                        </a>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p>
                            <strong>ผลงานที่ผ่านการคัดเลือกแบบบรรยาย</strong><br/>
                            <span style="font-size: 1rem;">(Oral Presentation)</span>
                        </p>
                    </td>
                    <td class="text-center" colspan="2">
                        <a href="{{ asset('download/announcement/UAMC2021-oral-presentation.pdf') }}" class="btn btn-outline-warning w-100" target="_blank" rel="noopener noreferrer">
                            ดาวน์โหลด PDF
                        </a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

@endsection