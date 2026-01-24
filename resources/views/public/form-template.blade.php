@extends('layouts.public')

@section('title', 'Template บทคัดย่อและโปสเตอร์')
@section('rules', 'active')

@section('content')

    <div class="container my-5">
        <h1 class="text-center"><strong>Template บทคัดย่อและโปสเตอร์</strong></h1>
        <hr class="separator">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th width="70%" class="text-center">Template</th>
                        <th width="30%" class="text-center">ไฟล์</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <p>
                                <strong>บทคัดย่อ</strong><br />
                                <span style="font-size: 1rem;">(Abstract)</span>
                            </p>
                        </td>
                        <td class="text-center">
                            <a href="{{ asset('file/template/AbstractTemplate_uamc2026.docx') }}"
                                class="btn btn-outline-warning w-100" download>
                                ดาวน์โหลดไฟล์ MS Word
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p>
                                <strong>บทคัดย่อแบบขยาย</strong><br />
                                <span style="font-size: 1rem;">(Extended abstract)</span>
                            </p>
                        </td>
                        <td class="text-center">
                            <a href="{{ asset('file/template/ExtendedAbstractTemplate_uamc2026.docx') }}"
                                class="btn btn-outline-warning w-100" download>
                                ดาวน์โหลดไฟล์ MS Word
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p>
                                <strong>โปสเตอร์</strong><br />
                                <span style="font-size: 1rem;">(Poster)</span>
                            </p>
                        </td>
                        <td class="text-center" colspan="2">
                            <a href="{{ asset('file/template/PosterTemplate_uamc2026.pptx') }}"
                                class="btn btn-outline-warning w-100" download>
                                ดาวน์โหลดไฟล์ MS PowerPoint
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p>
                                <strong>หนังสือรับรองจากอาจารย์ที่ปรึกษา</strong><br />
                                <span style="font-size: 1rem;">(Letter of Recommendation)</span>
                            </p>
                        </td>
                        <td class="text-center" colspan="2">
                            <a href="{{ asset('file/template/หนังสือรับรองจากอาจารย์ที่ปรึกษา.docx') }}"
                                class="btn btn-outline-warning w-100" download>
                                ดาวน์โหลดไฟล์ MS Word
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

@endsection
