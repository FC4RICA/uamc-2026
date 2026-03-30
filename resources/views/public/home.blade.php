@extends('layouts.public')

@section('title', 'The 14th Undergraduate in Applied Mathematics Conference')
@section('home', 'active')

@section('content')
    <div class="container mt-4 mb-5">
        <div class="text-center my-2">
            <h1 class="text-center"><strong>ประชาสัมพันธ์</strong></h1>
            <hr class="separator" />
        </div>

        <div class="alert alert-light shadow-sm my-5">
            <h3 class="alert-heading fw-bold mb-4">
                ประกาศรางวัลการนำเสนอผลงาน ในการประชุมวิชาการระดับปริญญาตรีสาขาวิชาคณิตศาสตร์ประยุกต์ ครั้งที่ 14 ประจำปี 2569 (UAMC2026)
            </h3>

            <div class="list-group">
                <div class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        <strong>รางวัลการนำเสนอผลงานแบบบรรยาย (Oral Presentation)</strong>
                    </div>

                    <a href="{{ asset('file/ประกาศผลการตัดสินผลงานแบบบรรยาย.pdf') }}"
                        class="btn btn-primary btn-sm"
                        target="_blank">
                        <i class="fa fa-file-pdf"></i> ดาวน์โหลด PDF
                    </a>
                </div>

                <div class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        <strong>รางวัลการนำเสนอผลงานแบบโปสเตอร์ (Poster Presentation)</strong>
                    </div>

                    <a href="{{ asset('file/ประกาศผลการตัดสินผลงานแบบโปสเตอร์.pdf') }}"
                        class="btn btn-primary btn-sm"
                        target="_blank">
                        <i class="fa fa-file-pdf"></i> ดาวน์โหลด PDF
                    </a>
                </div>
            </div>
        </div>

        {{-- <div class="alert alert-light shadow-sm my-5">
            <h3 class="alert-heading fw-bold">
                ประกาศการอัพโหลดไฟล์นำเสนอสำหรับผู้นำเสนอแบบบรรยาย (Oral Presentation)
            </h3>

            <div class="list-group-item d-flex justify-content-between align-items-center">
                <p class="text-muted mb-0">
                    ข้อปฏิบัติในการอัพโหลดไฟล์นำเสนอแบบบรรยาย
                </p>

                <a class="btn btn-primary" href="{{ route("public.upload-presentation") }}">
                    รายละเอียดเพิ่มเติม >
                </a>
            </div>
        </div> --}}

        <div class="row justify-content-center">
            <div class="col-12 col-lg-10">
                <div class="ratio ratio-4x3">
                    <iframe src="https://heyzine.com/flip-book/01e7eeccd1.html" frameborder="0" class="w-100"></iframe>
                </div>
            </div>
        </div>
        

        <h2 class="alert-heading fw-bold mt-5 text-center">
            ประกาศตำแหน่งที่จอดรถและแผนผังห้องต่างๆ ในงาน
        </h2>

        <div class="row justify-content-center">
            <div class="col-12 col-lg-8 border rounded">
                <x-map-carousel />
            </div>
        </div>

        <div class="alert alert-light shadow-sm my-5">
            <h3 class="alert-heading fw-bold">
                ประกาศตารางการนำเสนอผลงาน
            </h3>

            <p class="text-muted mb-4">
                ตารางการนำเสนอผลงานสำหรับการประชุมวิชาการ
                The 14th Undergraduate in Applied Mathematics Conference
            </p>

            <div class="list-group">
                <div class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        <strong>การนำเสนอแบบบรรยาย (Oral Presentation)</strong>
                        <span class="badge text-bg-primary">อัพเดต</span>
                    </div>

                    <a href="{{ asset('file/oral-presentation-schedule.pdf') }}"
                        class="btn btn-primary btn-sm"
                        target="_blank">
                        <i class="fa fa-file-pdf"></i> ดาวน์โหลด PDF
                    </a>
                </div>

                <div class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        <strong>การนำเสนอแบบโปสเตอร์ (Poster Presentation)</strong>
                    </div>

                    <a href="{{ asset('file/poster-presentation-schedule.pdf') }}"
                        class="btn btn-primary btn-sm"
                        target="_blank">
                        <i class="fa fa-file-pdf"></i> ดาวน์โหลด PDF
                    </a>
                </div>
            </div>
        </div>

        {{-- Sponsors --}}
        <div class="row my-5 justify-content-center g-2 g-lg-4">
            <h1 class="col-12 text-center fw-bold mb-4">ขอบคุณผู้สนับสนุน</h1>
            <div class="col-2"></div>
            <div class="col-4">
                <img class="img-fluid rounded-3 img-thumbnail" src="{{ asset('img/cepmart-logo.png') }}"/>
            </div>
            <div class="col-4">
                <img class="img-fluid rounded-3 img-thumbnail" src="{{ asset('img/mathassociation-logo.jpg') }}"/>
            </div>
            <div class="col-2"></div>
            <div class="col-4">
                <img class="img-fluid rounded-3 img-thumbnail" src="{{ asset('img/miraah-logo.jpg') }}"/>
            </div>
            <div class="col-4">
                <img class="img-fluid rounded-3" src="{{ asset('img/dhipaya-logo.jpg') }}"/>
            </div>
            <div class="col-4">
                <img class="img-fluid rounded-3" src="{{ asset('img/sift-logo.png') }}" style="background-color: #bf0d3e;"/>
            </div>
            <div class="col-5">
                <img class="object-fit-contain img-fluid rounded-3 img-thumbnail" src="{{ asset('img/nd-travel-logo.jpg') }}" style="aspect-ratio: 2 / 1;"/>
            </div>
            <div class="col-5">
                <img class="object-fit-cover img-fluid rounded-3" src="{{ asset('img/lactasoy-logo.png') }}" style="aspect-ratio: 2 / 1;"/>
            </div>
        </div>

        <hr class="separator" />

        <div class="my-5">
            <h1 class="text-center"><strong>ภาควิชาคณิตศาสตร์ คณะวิทยาศาสตร์
                    มหาวิทยาลัยเทคโนโลยีพระจอมเกล้าธนบุรี</strong></h1>
            <h3 class="text-center" lang="th">ขอเชิญนักวิจัย คณาจารย์ นิสิต นักศึกษา ส่งผลงานวิจัย/เข้าร่วม<br>
                การประชุมวิชาการสำหรับนักศึกษาระดับปริญญาตรีสาขาวิชาคณิตศาสตร์ประยุกต์ ครั้งที่ 14<br>
                <span lang="en">The 14th Undergraduate in Applied Mathematics Conference</span><br>
                ณ คณะวิทยาศาสตร์ มหาวิทยาลัยเทคโนโลยีพระจอมเกล้าธนบุรี<br />
                วันที่ 29 มีนาคม พ.ศ.2569
            </h3>
        </div>
        <hr class="separator">
        <div class="my-4">
            <h3><strong>หลักการและเหตุผลของการจัดประชุม</strong></h3>
            <p>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ตามที่ภาควิชาคณิตศาสตร์ คณะวิทยาศาสตร์ มหาวิทยาลัยเทคโนโลยีพระจอมเกล้าธนบุรี
                ได้ร่วมมือกับมหาวิทยาลัยศิลปากร มหาวิทยาลัยเทคโนโลยีพระจอมเกล้าพระนครเหนือ
                สถาบันเทคโนโลยีพระจอมเกล้าเจ้าคุณทหารลาดกระบัง และมหาวิทยาลัยเทคโนโลยีสุรนารี
                ผลักดันให้เกิดการประชุมทางวิชาการสำหรับนักศึกษาระดับปริญญาตรีสาขาวิชาคณิตศาสตร์ประยุกต์
                โดยเริ่มจัดการประชุมขึ้นครั้งแรกในปี พ.ศ. 2555 ที่มหาวิทยาลัยศิลปากร
                และได้ดำเนินการจัดการประชุมมาอย่างต่อเนื่องทุกปี โดยการหมุนเวียนกันเป็นเจ้าภาพจัดการประชุม
                โดยในงานจะมีการนำเสนอโครงงานของนักศึกษาทั้งในรูปแบบบรรยายและแบบโปสเตอร์ นอกจากนั้น ในปี พ.ศ. 2558
                ทางสมาคมคณิตศาสตร์แห่งประเทศไทยพระบรมราชูปถัมภ์ ได้เห็นความสำคัญของการจัดงานการประชุมดังกล่าว
                จึงได้เป็นส่วนหนึ่งของการจัดการประชุม
                โดยได้มอบเงินสนับสนุนการจัดงานและมอบโล่รางวัลให้แก่นักศึกษาที่ชนะเลิศการนำเสนอโครงงานแบบบรรยาย
                เพื่อเป็นการสร้างกำลังใจและกระตุ้นให้นักศึกษาระดับปริญญาตรี สร้างสรรค์โครงงานให้มีคุณภาพมากยิ่งขึ้น<br />
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ในปี พ.ศ. 2569 ภาควิชาคณิตศาสตร์ คณะวิทยาศาสตร์
                มหาวิทยาลัยเทคโนโลยีพระจอมเกล้าธนบุรี
                ได้รับเกียรติให้เป็นเจ้าภาพหลักในการจัดการประชุมวิชาการระดับปริญญาตรีสาขาวิชาคณิตศาสตร์ประยุกต์ ครั้งที่ 14
                จึงขอเชิญนักวิจัย คณาจารย์ นิสิต นักศึกษา ส่งผลงานวิจัยเพื่อนำเสนอ และ/หรือ เข้าร่วมประชุม วันที่ 29 มีนาคม
                พ.ศ.2569 ณ คณะวิทยาศาสตร์ มหาวิทยาลัยเทคโนโลยีพระจอมเกล้าธนบุรี
            </p>
        </div>
        <hr class="separator" />
        <div class="my-4">
            <h1 class="text-center"><strong>กลุ่มย่อยสำหรับการนำเสนอแบบบรรยาย <span lang="en">(Oral
                        Presentation)</span><br />และโปสเตอร์ <span lang="en">(Poster Presentation)</span></strong>
            </h1>
            <ul>
                <li>
                    <h4 class="mt-4"><strong>
                            กลุ่มที่ 1 Pure Mathematics: graph theory / algebra / combinatorics / mathematical analysis /
                            number theory
                        </strong></h4>
                </li>
                <li>
                    <h4 class="mt-4"><strong>
                            กลุ่มที่ 2 Data Science / AI / Statistics
                        </strong></h4>
                </li>
                <li>
                    <h4 class="mt-4"><strong>
                            กลุ่มที่ 3 Differential Equations / Numerical Analysis
                        </strong></h4>
                </li>
                <li>
                    <h4 class="mt-4"><strong>
                            กลุ่มที่ 4 Mathematical Modelling / Simulations
                        </strong></h4>
                </li>
                <li>
                    <h4 class="mt-4"><strong>
                            กลุ่มที่ 5 Mathematics for Industry / Finance / Insurance
                        </strong></h4>
                </li>
            </ul>
            <p class="mt-5">*กลุ่มนำเสนออาจมีการปรับเปลี่ยนตามความเหมาะสม</p>
        </div>
        <hr class="separator" />
        <div class="my-4">
            <p class="text-center fw-bold" style="font-size: 2rem;">
                ผู้ชนะเลิศการนำเสนอแบบบรรยาย​ในแต่ละห้องจะได้รับโล่จากสมาคมคณิตศาสตร์แห่งประเทศไทยในพระบรมราชูปถัมภ์
                ผู้​ชนะ​เลิศการนำเสนอแบบโปสเตอร์​ในแต่ละสายจะได้รับโล่รางวัลจากภาควิชาคณิตศาสตร์ มจธ.
                <a href="{{ route('public.criteria') }}" style="font-size: 1.5rem;">(เงื่อนไขสำหรับการได้โล่รางวัล)</a>
            </p>
        </div>
        <hr class="separator mb-5">
        @include('components.schedule', ['showLineBreak' => false])
        <hr class="separator my-5">
        @include('components.timetable', ['showLineBreak' => false])
    </div>
@endsection
