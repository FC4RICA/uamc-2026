<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="/"><img src="img/60year-fsci.png" alt="kmutt-fsci"></a>

        <div class="collapse navbar-collapse" id="navbarSupportedContent" lang="th">
            <ul class="navbar-nav">
                <li class="nav-item @yield('home')">
                    <a href="{{ route('public.home') }}" class="nav-link"><strong>หน้าแรก</strong></a>
                </li>
                <li class="nav-item @yield('schedule')">
                    <a href="{{ route('public.schedule') }}" class="nav-link"><strong>กำหนดการ</strong></a>
                </li>
                <li class="nav-item @yield('criteria')">
                    <a class="nav-link" href="{{ route('public.criteria') }}"><strong>การนำเสนอและเกณฑ์การตัดสิน</strong></a>
                </li>
                <li class="nav-item @yield('attendend')">
                    <a href="{{ route('public.announcement') }}" class="nav-link"><strong>ประกาศรายชื่อ</strong></a>
                </li>
                <li class="nav-item @yield('register')">
                    <a href="{{ route('public.register.show') }}" class="nav-link"><strong>ลงทะเบียน</strong></a>
                </li>
                <li class="nav-item dropdown @yield('rules')">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><strong>การส่งผลงาน</strong></a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('public.rules') }}">การส่งผลงานและข้อกำหนดรูปแบบของบทคัดย่อและโปสเตอร์</a>
                        <a class="dropdown-item" href="{{ route('public.templates') }}">Templates บทคัดย่อและโปสเตอร์</a>
                    </div>
                </li>
                <li class="nav-item @yield('about')">
                    <a href="{{ route('public.about') }}" class="nav-link"><strong>ติดต่อเรา</strong></a>
                </li>
            </ul>
        </div>
        <div class="accountBTN">
            <a href="{{ route('public.signin.show') }}">เข้าสู่ระบบ</a>
        </div>
    </div>
</nav>