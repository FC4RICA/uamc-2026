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
                    <th width="40%" class="text-center">Template</th>
                    <th width="30%" class="text-center">ไฟล์ MS Word</th>
                    <th width="30%" class="text-center">ไฟล์ PDF</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td >
                        <p>
                            <strong>บทคัดย่อภาษาไทย</strong><br/>
                            <span style="font-size: 1rem;">(Thai abstract)</span>
                        </p>
                    </td>
                    <td class="text-center">
                        <a href="{{ asset('download/template/Abstract_Template_TH_KMUTT.docx') }}" class="btn btn-outline-warning w-100" download>
                            ดาวน์โหลด
                        </a>
                    </td>
                    <td class="text-center">    
                        <a href="{{ asset('download/template/Abstract_Template_TH_KMUTT.pdf') }}" class="btn btn-outline-warning w-100" target="_blank" rel="noopener noreferrer">
                            ดาวน์โหลด
                        </a>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p>
                            <strong>บทคัดย่อภาษาอังกฤษ</strong><br/>
                            <span style="font-size: 1rem;">(English abstract)</span>
                        </p>
                    </td>
                    <td class="text-center">
                        <a href="{{ asset('download/template/Abstract_Template_EN_KMUTT.docx') }}" class="btn btn-outline-warning w-100" download>
                            ดาวน์โหลด
                        </a>
                    </td>
                    <td class="text-center">
                        <a href="{{ asset('download/template/Abstract_Template_EN_KMUTT.pdf') }}" class="btn btn-outline-warning w-100" target="_blank" rel="noopener noreferrer">
                            ดาวน์โหลด
                        </a>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p>
                            <strong>บทคัดย่อแบบขยาย</strong><br/>
                            <span style="font-size: 1rem;">(Extended abstract)</span>
                        </p>
                    </td>
                    <td class="text-center">
                        <a href="{{ asset('download/template/ExtendedAbstract_Template.docx') }}" class="btn btn-outline-warning w-100" download>
                            ดาวน์โหลด
                        </a>
                    </td>
                    <td class="text-center">
                        <a href="{{ asset('download/template/ExtendedAbstract_Template.pdf') }}" class="btn btn-outline-warning w-100" target="_blank" rel="noopener noreferrer">
                            ดาวน์โหลด
                        </a>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p>
                            <strong>โปสเตอร์</strong><br/>
                            <span style="font-size: 1rem;">(Poster)</span>
                        </p>
                    </td>
                    <td class="text-center" colspan="2">
                        <a href="{{ asset('download/template/Poster_Template.pptx') }}" class="btn btn-outline-warning w-100" download>
                            ดาวน์โหลดไฟล์ MS PowerPoint
                        </a>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p>
                            <strong>บทความวิจัยฉบับเต็มภาษาไทย</strong><br/>
                            <span style="font-size: 1rem;">(Thai full text)</span>
                        </p>
                    </td>
                    <td class="text-center" colspan="2">
                        <a href="{{ asset('download/template/UAMC2021_fulltext_thai.docx') }}" class="btn btn-outline-warning w-100" download>
                            ดาวน์โหลดไฟล์ MS Word
                        </a>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p>
                            <strong>บทความวิจัยฉบับเต็มภาษาอังกฤษ</strong><br/>
                            <span style="font-size: 1rem;">(English full text)</span>
                        </p>
                    </td>
                    <td class="text-center" colspan="2">
                        <a href="{{ asset('download/template/UAMC2021_fulltext_eng.docx') }}" class="btn btn-outline-warning w-100" download>
                            ดาวน์โหลดไฟล์ MS Word
                        </a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

@endsection