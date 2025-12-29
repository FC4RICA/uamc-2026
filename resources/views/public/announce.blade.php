# unused
@extends('layouts.public')

@section('title', 'ประกาศรายชื่อผู้เข้าร่วมงาน')
@section('attendend', 'active')

@section('content')

<div class="container my-5">
    <h1 class="text-center"><strong>ประกาศรายชื่อผู้เข้าร่วมงาน</strong></h1>
    <hr>

    @if($status->status == 1)
    <div>
        <h2 class="mt-5">รายชื่อผู้ลงทะเบียนนำเสนอผลงาน แบบบรรยาย (Oral Presentation)</h2>
        <table class="table">
            <tr>
                <th class="text-center" width="10%">
                    ลำดับที่
                </th>
                <th class="text-center" width="45%">
                    มหาวิทยาลัย/สถาบัน
                </th>
                <th class="text-center" width="45%">
                    ชื่อ - สกุล
                </th>
            </tr>
            @for($i = 0; $i < sizeof($oral); $i++) <tr>
                <td class="text-center" width="10%">
                    {{ $i+1 }}
                </td>
                <td class="text-center" width="45%">
                    {{ $oral[$i]->organization }}
                </td>
                <td class="text-center" width="45%">
                    {{ $oral[$i]->name .'    '. $oral[$i]->lastname }}
                </td>
                </tr>
                @endfor
        </table>
        <hr>
        <h2 class="mt-5">รายชื่อผู้ลงทะเบียนนำเสนอผลงาน แบบโปสเตอร์ (Poster Presentation)</h2>
        <table class="table">
            <tr>
                <th class="text-center" width="10%">
                    ลำดับที่
                </th>
                <th class="text-center" width="45%">
                    มหาวิทยาลัย/สถาบัน
                </th>
                <th class="text-center" width="45%">
                    ชื่อ - สกุล
                </th>
            </tr>
            @for($i = 0; $i < sizeof($poster); $i++) <tr>
                <td class="text-center" width="10%">
                    {{ $i+1 }}
                </td>
                <td class="text-center" width="45%">
                    {{ $poster[$i]->organization }}
                </td>
                <td class="text-center" width="45%">
                    {{ $poster[$i]->name .'    '. $poster[$i]->lastname }}
                </td>
                </tr>
                @endfor
        </table>
        <hr>
        <h2 class="mt-5">รายชื่อผู้ลงทะเบียนเข้าร่วมงาน</h2>
        <table class="table">
            <tr>
                <th class="text-center" width="10%">
                    ลำดับที่
                </th>
                <th class="text-center" width="45%">
                    มหาวิทยาลัย/สถาบัน
                </th>
                <th class="text-center" width="45%">
                    ชื่อ - สกุล
                </th>
            </tr>
            @for($i = 0; $i < sizeof($paticipants); $i++) <tr>
                <td class="text-center" width="10%">
                    {{ $i+1 }}
                </td>
                <td class="text-center" width="45%">
                    {{ $paticipants[$i]->organization }}
                </td>
                <td class="text-center" width="45%">
                    {{ $paticipants[$i]->name .'    '. $paticipants[$i]->lastname }}
                </td>
                </tr>
                @endfor
        </table>
    </div>
    @elseif($status->status == 0)
    <h3 class="text-center"><strong>ขณะนี้ยังไม่มีการประกาศผล</strong></h3>
    @endif
</div>

@endsection