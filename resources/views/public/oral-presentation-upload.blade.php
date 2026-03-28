@extends('layouts.public')

@section('title', 'อัพโหลดสไลด์นำเสนอ')
@section('home', 'active')

@section('content')
    <div class="container my-5">

        <h1 class="text-center"><strong>ประชาสัมพันธ์</strong></h1>
        <hr class="separator">
        <p class="mt-4">
            ผู้นำเสนอแบบ oral สามารถอัพโหลดสไลด์นำเสนอผ่านลิงค์นี้ได้ล่วงหน้าโดยมีข้อปฏิบัติดังนี้ย
        </p>
        <ol>
            <li>ให้อัพโหลดไฟล์ประเภท .pdf หรือ .ppt/.pptx เพียงไฟล์เดียวเท่านั้น (ไฟล์นอกเหนือจากนี้ อาจไม่มีโปรแกรมสำหรับอ่านไฟล์ในห้องนำเสนอ)</li>
            <li>ให้อัพโหลดไฟล์เพียงครั้งเดียวเท่านั้น ดังนั้นขอความกรุณาผู้นำเสนอตรวจสอบความถูกต้องให้เรียบร้อยก่อนการอัพโหลด</li>
            <li>
                ให้ตั้งชือไฟล์นำเสนอตามรหัสผลงานของกลุ่มตนเอง เช่น OMG-3.pdf โดยสามารถตรวจสอบรหัสกลุ่มได้ที่ 
                <a href="{{ asset('file/oral-presentation-schedule.pdf') }}">{{ asset('file/oral-presentation-schedule.pdf') }}</a>
            </li>
            <li>ขอให้ตรวจสอบกลุ่มนำเสนอ และอัพโหลดไฟล์ในลิงค์ที่ถูกต้อง</li>
        </ol>

        <table class="table mt-4">
            <tbody>
                <tr>
                    <td>ห้องบรรยายที่ 1 Pure Mathematics (OPM)</td>
                    <td><a href="https://kmutt.me/uamc_upload_1">ลิงค์</a></td>
                    <td><a href="{{ asset("img/uamc-upload-1.png") }}">QR Code</a></td>
                </tr>

                <tr>
                    <td>ห้องบรรยายที่ 2 Sustainable environment, Agriculture and Climate (OSE)</td>
                    <td><a href="https://kmutt.me/uamc_upload_2">ลิงค์</a></td>
                    <td><a href="{{ asset("img/uamc-upload-2.png") }}">QR Code</a></td>
                </tr>

                <tr>
                    <td>ห้องบรรยายที่ 3 Economy, Finance and Industrial analytics (OEF)</td>
                    <td><a href="https://kmutt.me/uamc_upload_3">ลิงค์</a></td>
                    <td><a href="{{ asset("img/uamc-upload-3.png") }}">QR Code</a></td>
                </tr>

                <tr>
                    <td>ห้องบรรยายที่ 4 Health, Safety and Social well-being (OHF)</td>
                    <td><a href="https://kmutt.me/uamc_upload_4">ลิงค์</a></td>
                    <td><a href="{{ asset("img/uamc-upload-4.png") }}">QR Code</a></td>
                </tr>

                <tr>
                    <td>ห้องบรรยายที่ 5 Education, Digital infrastructure and Intelligent systems (OED)</td>
                    <td><a href="https://kmutt.me/uamc_upload_5">ลิงค์</a></td>
                    <td><a href="{{ asset("img/uamc-upload-5.png") }}">QR Code</a></td>
                </tr>

                <tr>
                    <td>ห้องบรรยายที่ 6 Actuarial science and Risk management (OAS)</td>
                    <td><a href="https://kmutt.me/uamc_upload_6">ลิงค์</a></td>
                    <td><a href="{{ asset("img/uamc-upload-6.png") }}">QR Code</a></td>
                </tr>
                
                <tr>
                    <td>ห้องบรรยายที่ 7 Quantitative finance and Business decision making (OQF)</td>
                    <td><a href="https://kmutt.me/uamc_upload_7">ลิงค์</a></td>
                    <td><a href="{{ asset("img/uamc-upload-7.png") }}">QR Code</a></td>
                </tr>
                
                <tr>
                    <td>ห้องบรรยายที่ 8 Mathematical modeling and Systems optimization (OMM)</td>
                    <td><a href="https://kmutt.me/uamc_upload_8">ลิงค์</a></td>
                    <td><a href="{{ asset("img/uamc-upload-8.png") }}">QR Code</a></td>
                </tr>
            </tbody>
        </table> 
    </div>
@endsection
