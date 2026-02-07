<ul class="navbar-nav">
    <li class="nav-item @yield('dashboard')">
        <a href='{{ route('admin.index') }}' class="nav-link">หน้าแรก</a>
    </li>
    <li class="nav-item">
        <a href="{{ route('public.home') }}" class="nav-link">กลับหน้าเว็บหลัก</a>
    </li>
    <li class="nav-item @yield('participant')">
        <a href="{{ route('admin.member.index') }}" class="nav-link">จัดการผู้ลงทะเบียน</a>
    </li>
    <li class="nav-item @yield('payment')">
        <a href="{{ route('admin.payment.index') }}" class="nav-link">จัดการการชำระเงิน</a>
    </li>
    <li class="nav-item @yield('submission')">
        <a href="{{ route('admin.submission.index') }}" class="nav-link">จัดการบทคัดย่อ</a>
    </li>
    <li>
        <hr class="text-white">
    </li>
    <li class="nav-item">
        <form action="{{ route('logout') }}" method="POST" class="nav-link p-0">
            @csrf
            <button class="nav-link text-inherit bg-none border-0 w-100" style="background: none;" type="submit"
                name="logout" onclick="this.blur();">
                ออกจากระบบ
            </button>
        </form>
    </li>
</ul>
