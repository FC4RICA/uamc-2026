<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="{{ route('public.home') }}">
            <img src="{{ asset('img/logo.png') }} " alt="kmutt-fsci">
        </a>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto m-auto">
                <li class="nav-item">
                    <a href="{{ route('public.home') }}" class="nav-link @yield('home')"><strong>หน้าแรก</strong></a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('public.schedule') }}"
                        class="nav-link @yield('schedule')"><strong>กำหนดการ</strong></a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('public.criteria') }}"
                        class="nav-link  @yield('criteria')"><strong>การนำเสนอและเกณฑ์การตัดสิน</strong></a>
                </li>
                {{-- <li class="nav-item @yield('attendend')">
                    <a href="{{ route('public.announcement') }}" class="nav-link"><strong>ประกาศรายชื่อ</strong></a>
                </li> --}}
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle @yield('rules')" href="#" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <strong>การส่งผลงาน</strong>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('public.rules') }}"
                                class="dropdown-item">หลักเกณฑ์การลงทะเบียนและส่งบทคัดย่อ</a></li>
                        <li><a href="{{ route('public.templates') }}" class="dropdown-item">Templates
                                บทคัดย่อและโปสเตอร์</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ route('public.about') }}"
                        class="nav-link @yield('about')"><strong>ติดต่อเรา</strong></a>
                </li>
                <li class="nav-item">
                    @if (Auth::user())
                        <a href="{{ route('member.index') }}" class="nav-link"><strong>หน้าสมาชิก</strong></a>
                    @else
                        <a href="{{ route('register') }}"
                            class="nav-link @yield('register')"><strong>ลงทะเบียน</strong></a>
                    @endif
                </li>
            </ul>
        </div>
        @if (Auth::user())
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="accountBTN" style="border: 0;" type="submit" name="logout"
                    onclick="this.blur();">ออกจากระบบ</button>
            </form>
        @else
            <a class="accountBTN" href="{{ route('login') }}">เข้าสู่ระบบ</a>
        @endif
    </div>
</nav>
