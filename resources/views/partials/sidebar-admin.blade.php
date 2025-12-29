<nav class="navbar navbar-dark">
    <div class="container">
        <a class="navbar-brand" href="#"><img src="{{ asset('img/60year-fsci.png') }}" alt="kmutt-fsci"></a>
        <div lang="th">
            <ul class="navbar-nav">
                <li class="nav-item @yield('dashboard')">
                    <a href='{{ route('admin.index') }}' class="nav-link">หน้าแรก</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('public.home') }}" class="nav-link">กลับหน้าเว็บหลัก</a>
                </li>
                <li class="nav-item @yield('paper')">
                    <a href="{{ route('admin.submission.index') }}" class="nav-link">จัดการบทคัดย่อ</a>
                </li>
                <li class="nav-item @yield('committee')">
                    <a href="{{ route('admin.committee.index') }}" class="nav-link">จัดการคณะกรรมการ</a>
                </li>
                <li class="nav-item @yield('attended')">
                    <a href="{{ route('admin.attendee.index') }}" class="nav-link">จัดการผู้ลงทะเบียน</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('public.logout') }}" class="nav-link">ออกจากระบบ</a>
                </li>
            </ul>
        </div>
    </div>
</nav>