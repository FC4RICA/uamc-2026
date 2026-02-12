<ul class="navbar-nav">
    <li class="nav-item">
        <a href='{{ route('admin.index') }}' class="nav-link @yield('dashboard')">
            หน้าแรก
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('public.home') }}" class="nav-link">กลับหน้าเว็บหลัก</a>
    </li>
    <li class="nav-item">
        <a href="{{ route('admin.user.index') }}" class="nav-link @yield('user')">
            บัญชีผู้ใช้งาน
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('admin.profile.index') }}" class="nav-link @yield('profile')">
            ผู้เข้าร่วมงาน
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('admin.payment.index') }}" class="nav-link @yield('payment')">
            การชำระเงิน
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('admin.submission.index') }}" class="nav-link @yield('submission')">
            บทคัดย่อ
        </a>
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
