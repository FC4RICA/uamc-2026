@extends('layouts.public')

@section('title', 'The 14th Undergraduate in Applied Mathematics Conference')
@section('home', 'active')

@section('content')
    <div class="container mt-4 mb-5">
        <div class="text-center my-2">
            <h1 class="text-center"><strong>ประชาสัมพันธ์</strong></h1>
            <hr class="separator" />

            {{-- <div class="presentation-list mb-3 text-left">
            <h2 class="font-weight-bold">ประกาศผล</h2>
            <ul>
                <li>
                    รางวัลการนำเสนอผลงานแบบบรรยาย
                    <a href="{{ asset('download/uamc2021-oral-award.pdf') }}" class="btn btn-warning" target="_blank" rel="noopener noreferrer">
                        ดูรายชื่อผลงาน
                    </a>
                </li>
                <li>
                    รางวัลการนำเสนอผลงานแบบโปสเตอร์
                    <a href="{{ asset('download/uamc2021-poster-award.pdf') }}" class="btn btn-warning" target="_blank" rel="noopener noreferrer">
                        ดูรายชื่อผลงาน
                    </a>
                </li>
            </ul>
        </div> --}}

            {{-- <div class="presentation-list mb-3">
            <img class="img-fluid mb-3 shadow" src="img/book-of-abstract.png" style="max-height: 50rem;" /><br/><br/>
            <a href="{{ asset('download/book-of-abstract.pdf') }}" class="btn btn-warning" target="_blank" rel="noopener noreferrer">
                Book of abstract
            </a>
            <a href="{{ asset('download/handbook/handbook.pdf') }}" class="btn btn-warning" target="_blank" rel="noopener noreferrer">
                คู่มือการประชุม
            </a>
            <a href="{{ asset('download/handbook/zoom-conference-handbook.pdf') }}" class="btn btn-warning" target="_blank" rel="noopener noreferrer">
                คู่มือการใช้งานโปรแกรม Zoom
            </a>
        </div> --}}

        <img class="img-fluid" src="{{ asset('img/UAMC2026.png') }}" style="max-height: 50rem;" />

        </div>
        <div class="my-5">
            <h1 class="text-center"><strong>ภาควิชาคณิตศาสตร์ คณะวิทยาศาสตร์
                    มหาวิทยาลัยเทคโนโลยีพระจอมเกล้าธนบุรี</strong></h1>
            <h3 class="text-center" lang="th">ขอเชิญนักวิจัย คณาจารย์ นิสิต นักศึกษา ส่งผลงานวิจัย/เข้าร่วม<br>
                การประชุมวิชาการสำหรับนักศึกษาระดับปริญญาตรีสาขาวิชาคณิตศาสตร์ประยุกต์ ครั้งที่ 14<br>
                <span lang="en">The 14th Undergraduate in Applied Mathematics Conference</span><br>
                ณ คณะวิทยาศาสตร์ มหาวิทยาลัยเทคโนโลยีพระจอมเกล้าธนบุรี<br />
                วันที่ 28 มีนาคม พ.ศ.2569
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
        <div class="my-5">
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
    </div>
@endsection
