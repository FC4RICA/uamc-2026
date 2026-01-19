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
    <li class="nav-item @yield('attended')">
        <a href="{{ route('admin.attendee.index') }}" class="nav-link">จัดการผู้ลงทะเบียน</a>
    </li>
    <li class="nav-item">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="nav-link text-inherit bg-none border-0" style="background: none;" type="submit"
                name="logout" onclick="this.blur();">ออกจากระบบ</button>
        </form>
    </li>
</ul>
