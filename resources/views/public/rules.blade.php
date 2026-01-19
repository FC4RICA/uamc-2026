@extends('layouts.public')

@section('title', 'การส่งผลงานและข้อกำหนดรูปแบบ')
@section('rules', 'active')

@section('content')

    <div class="container my-5">

        <h1 class="text-center"><strong>คำชี้แจงเกี่ยวกับการส่งผลงานและข้อกำหนดรูปแบบของบทคัดย่อและโปสเตอร์</strong></h1>
        <hr class="separator">
        <h3><strong>ผลงานแบบบรรยาย</strong></h3>
        <p>การส่งผลงานแบบบรรยาย นักศึกษาจะต้องส่งเอกสาร 3 อย่าง ทั้งประเภท MS Word และ PDF ดังนี้</p>
        <ol>
            <li>
                <strong>บทคัดย่อภาษาไทย</strong>&nbsp;(MS Word+PDF) ความยาวไม่เกิน 1 หน้ากระดาษ A4 ตาม template ที่กำหนดให้
            </li>
            <li>
                <strong>บทคัดย่อภาษาอังกฤษ</strong>&nbsp;(MS Word+PDF) ความยาวไม่เกิน 1 หน้ากระดาษ A4 ตาม template
                ที่กำหนดให้
            </li>
        </ol>
        <table class="table w-100">
            <thead>
                <tr>
                    <th width="10%" class="text-center">หัวข้อ</th>
                    <th width="45%" class="text-center">บทคัดย่อภาษาไทย</th>
                    <th width="45%" class="text-center">บทคัดย่อภาษาอังกฤษ</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>ชื่อเรื่อง</td>
                    <td class="text-center">TH SarabunNew, 24 pt., ตัวหนา</td>
                    <td class="text-center">Times New Roman, 18 pt., ตัวหนา</td>
                </tr>
                <tr>
                    <td>ชื่อผู้แต่ง และอาจารย์ที่ปรึกษา</td>
                    <td class="text-center">TH SarabunNew, 22 pt., ตัวหนา</td>
                    <td class="text-center">Times New Roman, 16 pt., ตัวหนา</td>
                </tr>
                <tr>
                    <td>ชื่อภาควิชา</td>
                    <td class="text-center">TH SarabunNew, 18 pt., ตัวหนา</td>
                    <td class="text-center">Times New Roman, 14 pt., ตัวหนา</td>
                </tr>
                <tr>
                    <td>ข้อความ “บทคัดย่อ”</td>
                    <td class="text-center">TH SarabunNew, 22 pt., ตัวหนา</td>
                    <td class="text-center">Times New Roman, 16 pt., ตัวหนา</td>
                </tr>
                <tr>
                    <td>เนื้อหาบทคัดย่อ</td>
                    <td class="text-center">TH SarabunNew, 16 pt., ตัวปกติ</td>
                    <td class="text-center">Times New Roman, 12 pt., ตัวปกติ</td>
                </tr>
            </tbody>
        </table>
        <ol start="3">
            <li>
                <strong>บทคัดย่อแบบขยาย</strong>&nbsp;(extended abstract) (MS Word หรือ PDF) ความยาวไม่เกิน 5 หน้ากระดาษ A4
                ตาม template ที่กำหนดให้<br />
                ชื่อเรื่อง: TH SarabunNew, 16 pt., ตัวหนา<br />
                เนื้อเรื่อง: TH SarabunNew, 16 pt., ตัวปกติ

            </li>
        </ol>
        <h3><strong>ผลงานแบบโปสเตอร์</strong></h3>
        <p>การส่งผลงานแบบโปสเตอร์ นักศึกษาจะต้องส่งเอกสารดังนี้</p>
        <ol>
            <li>
                <strong>บทคัดย่อภาษาไทย</strong>&nbsp;(MS Word+PDF) ความยาวไม่เกิน 1 หน้ากระดาษ A4 ตาม template
                แบบเดียวกับรูปแบบบรรยาย
            </li>
            <li>
                <strong>บทคัดย่อภาษาอังกฤษ</strong>&nbsp;(MS Word+PDF) ความยาวไม่เกิน 1 หน้ากระดาษ A4 ตาม template
                แบบเดียวกับรูปแบบบรรยาย
            </li>
        </ol>
    </div>

@endsection
