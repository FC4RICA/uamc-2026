@extends('layouts.public')

@section('title', 'ติดต่อเรา')
@section('about', 'active')

@section('content')
    <div class="container my-5">
        <div class="row">
            <div class="col-12">
                <h1 class="text-center fw-bold">ติดต่อเรา</h1>
            </div>
        </div>
        <hr class="separator">
        <div class="row">
            <div class="col-12 col-lg-6">
                <h3 class="fw-bold">ที่ตั้ง</h3>
                ภาควิชาคณิตศาสตร์, คณะวิทยาศาสตร์, มจธ.<br>
                126 ถ.ประชาอุทิศ แขวงบางมด เขตทุ่งครุ กรุงเทพมหานคร 10140<br>
                โทรศัพท์ (+66) 2 470 8820, (+66) 2 470 8822, (+66) 2 470 8839,
                โทรสาร (+66) 2 428 4025<br>
                {{-- facebook: <a href="https://www.facebook.com/uamc2021" target="_blank">Uamc2021</a><br><br> --}}
                {{-- <h3><strong>ผู้ประสานงาน</strong></h3>
                ดร.ชัชวาลย์ วัชราเรืองวิทย์ (+66) 2-470-8925<br>
                ดร.ทรงพล ศรีวงค์ษา --}}
            </div>
            <div class="col-12 col-lg-6">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d1938.5425509268268!2d100.49449900000002!3d13.652587!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xf81f84f74b47d10c!2sDepartment%20of%20Mathematics%2C%20KMUTT!5e0!3m2!1sth!2sth!4v1576926678282!5m2!1sth!2sth"
                    width="100%" height="100%" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
            </div>
        </div>
    </div>

@endsection
