@extends('layouts.public')

@section('title', 'The 14th Undergraduate in Applied Mathematics Conference')
@section('home', 'active')

@section('content')
<div class="container my-5">
    <div class="text-center my-2">
        <h1 class="text-center"><strong>ประชาสัมพันธ์</strong></h1>
        <hr />
        <div class="presentation-list mb-3 text-left">
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
        </div>
        <div class="presentation-list mb-3">
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
        </div>
        <img class="img-fluid" src="img/announce.webp" style="max-height: 50rem;" />
    </div>
    <div class="mt-5">
        <h1 class="text-center"><strong>ภาควิชาคณิตศาสตร์ คณะวิทยาศาสตร์
                มหาวิทยาลัยเทคโนโลยีพระจอมเกล้าธนบุรี</strong></h1>
        <h3 class="text-center" lang="th">ขอเชิญนักวิจัย คณาจารย์ นิสิต นักศึกษา ส่งผลงานวิจัย/เข้าร่วม<br>
            การประชุมวิชาการสำหรับนักศึกษาระดับปริญญาตรีสาขาวิชาคณิตศาสตร์ประยุกต์ ครั้งที่ 9<br>
            <span lang="en">The 9th Undergraduate in Applied Mathematics Conference</span><br>
            ณ คณะวิทยาศาสตร์ มหาวิทยาลัยเทคโนโลยีพระจอมเกล้าธนบุรี<br />
            วันที่ 23-24 เมษายน พ.ศ.2564</h3>
    </div>
    <hr>
    <div>
        <h3><strong>หลักการและเหตุผลของการจัดประชุม</strong></h3>
        <p>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ตามที่ภาควิชาคณิตศาสตร์ คณะวิทยาศาสตร์ มหาวิทยาลัยเทคโนโลยีพระจอมเกล้าธนบุรี ได้ร่วมมือกับมหาวิทยาลัยศิลปากร มหาวิทยาลัยเทคโนโลยีพระจอมเกล้าพระนครเหนือ สถาบันเทคโนโลยีพระจอมเกล้าเจ้าคุณทหารลาดกระบัง และมหาวิทยาลัยเทคโนโลยีสุรนารี ผลักดันให้เกิดการประชุมทางวิชาการสำหรับนักศึกษาระดับปริญญาตรีสาขาวิชาคณิตศาสตร์ประยุกต์ โดยเริ่มจัดการประชุมขึ้นครั้งแรกในปี พ.ศ. 2555 ที่มหาวิทยาลัยศิลปากร และได้ดำเนินการจัดการประชุมมาอย่างต่อเนื่องทุกปี โดยการหมุนเวียนกันเป็นเจ้าภาพจัดการประชุม โดยในงานจะมีการนำเสนอโครงงานของนักศึกษาทั้งในรูปแบบบรรยายและแบบโปสเตอร์ นอกจากนั้น ในปี พ.ศ. 2558 ทางสมาคมคณิตศาสตร์แห่งประเทศไทยพระบรมราชูปถัมภ์ ได้เห็นความสำคัญของการจัดงานการประชุมดังกล่าว จึงได้เป็นส่วนหนึ่งของการจัดการประชุม โดยได้มอบเงินสนับสนุนการจัดงานและมอบโล่รางวัลให้แก่นักศึกษาที่ชนะเลิศการนำเสนอโครงงานแบบบรรยาย เพื่อเป็นการสร้างกำลังใจและกระตุ้นให้นักศึกษาระดับปริญญาตรี สร้างสรรค์โครงงานให้มีคุณภาพมากยิ่งขึ้น นอกจากนี้ทางสมาคมคณิตศาสตร์แห่งประเทศไทยฯ จะคัดเลือกโครงงานที่มีคุณภาพดีเยี่ยมไปแข่งขันต่อในเวทีระดับนานาชาติต่อไป<br />
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ในปี พ.ศ. 2564 ภาควิชาคณิตศาสตร์ คณะวิทยาศาสตร์ มหาวิทยาลัยเทคโนโลยีพระจอมเกล้าธนบุรี ได้รับเกียรติให้เป็นเจ้าภาพหลักในการจัดการประชุมวิชาการระดับปริญญาตรีสาขาวิชาคณิตศาสตร์ประยุกต์ ครั้งที่ 9 จึงขอเชิญนักวิจัย คณาจารย์ นิสิต นักศึกษา ส่งผลงานวิจัยเพื่อนำเสนอ และ/หรือ เข้าร่วมประชุม วันที่ 23-24 เมษายน พ.ศ.2564 ณ คณะวิทยาศาสตร์ มหาวิทยาลัยเทคโนโลยีพระจอมเกล้าธนบุรี
        </p>
    </div>
    <hr />
    <div class="mt-5">
        <h1 class="text-center"><strong>กลุ่มย่อยสำหรับการนำเสนอแบบบรรยาย <span lang="en">(Oral
                    Presentation)</span><br />และโปสเตอร์ <span lang="en">(Poster Presentation)</span></strong></h1>
        <h3 class="mt-4"><strong>กลุ่มที่ 1 Numerical Methods and Applications</strong></h3>
        <p>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Numerical approximation and computation, error analysis and interval
            analysis, acceleration of
            convergence, mathematical programming, numerical optimization and variational techniques, approximation
            methods and numerical treatment of dynamical systems, integral transforms, numerical methods in Fourier
            analysis, computer aspects of numerical algorithms, applications of numerical methods to physics and
            engineering problems.
        </p>
        <h3 class="mt-4"><strong>กลุ่มที่ 2 Mathematical Modelling</strong></h3>
        <p>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Analysis of mathematical modeling, validation and verification of
            mathematical models, topological dynamics, Hamiltonian and Lagrangian systems, dynamical analysis of
            models, stability analysis, local and nonlocal bifurcation theory, controllability and observability,
            system structure mathematical biology, genetics and population dynamics, calculus of variations and
            optimal control, optimization models. Stochastic and probability models.
        </p>
        <h3 class="mt-4"><strong>กลุ่มที่ 3 Mathematics for Industry</strong></h3>
        <p>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Industrial mathematics, operations research, logistics and supply chain
            management, optimization, mathematics for economics, business mathematics, engineering modeling and
            simulations, robust geometric modeling, mathematical challenges from industry and business, analytical
            and problem-solving on business and industrial issue, applications in industry and business.
            calculus of variations and
            optimal control, optimization models. Stochastic and probability models.
        </p>
        <h3 class="mt-4"><strong>กลุ่มที่ 4 Mathematics for Finance and Insurance</strong></h3>
        <p>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Financial mathematics, actuarial mathematics, risk analysis and
            management, investment mathematics, quantitative analysis in finance, financial analytics, interest
            theory, fuzzy logic for business and finance, financial derivatives, econometrics, engineering economy,
            mathematical models in finance and insurance, mathematics of securities industry.
        </p>
        <h3 class="mt-4"><strong>กลุ่มที่ 5 Computational Mathematics</strong></h3>
        <p>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Computer system organization, theory of data, big data analysis and data
            mining, theory of computation and programming, discrete mathematics in relation to computer science,
            computability and recursion theory, artificial intelligence, evolutionary computation, computing
            methodologies and applications, algorithms in combinatorics and graph theory, communication and
            information, theory of error-correcting codes and error-detecting codes, fuzzy sets and logics,
            mathematics for computer graphics, image processing.
        </p>
        <h3 class="mt-4"><strong>กลุ่มที่ 6 Algebra and Analysis with Applications</strong></h3>
        <p>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Algebra, Linear algebra, Semigroups, Universal algebra, Algebraic
            Structure, Number Theory, Analytic number theory, Coding theory, Graph Theory, Combinatorics, Algebraic
            geometry, Field theory and polynomial, Set theory, Logic and applications of logic, Analysis, Functional
            Analysis, Complex analysis, Differential equations, Applied analysis, Topology, Differential geometry,
            Differential topology, Probabilistic theory, Calculus theory, Fractional derivatives and integral.
            Topological group, Lie group, Lie algebra, Group Analysis, Fourier Analysis, Wavelet, Game theory.</p>
    </div>
    <div class="mt-5">
        <p class="text-center" style="font-size: 2rem;">
            <strong>ผู้ชนะเลิศการนำเสนอแบบบรรยาย​ได้รับโล่จากสมาคมคณิตศาสตร์แห่งประเทศไทยในพระบรมราชูปถัมภ์<br />
                ผู้​ชนะ​เลิศการนำเสนอแบบโปสเตอร์​ ได้รับใบประกาศเกียรติ​คุณ</strong>
        </p>
    </div>
    <hr>
    @include('components.schedule', ['showLineBreak' => false])
</div>
@endsection