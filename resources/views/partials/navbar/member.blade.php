<ul class="navbar-nav">
    <li class="nav-item @yield('home')">
        <a href="{{ route('member.index') }}" class="nav-link">หน้าแรก</a>
    </li>
    <li class="nav-item">
        <a href="{{ route('public.home') }}" class="nav-link">กลับหน้าเว็บหลัก</a>
    </li>
    @if (Auth::user()->needsPayment())
        <li class="Nav-item @yield('payment')">
            <a href="{{ route('member.payment.create') }}" class="nav-link">ชำระค่าลงทะเบียน</a>
        </li>
    @endif
    <li class="nav-item @yield('profile')">
        <a href="{{ route('member.profile.index') }}" class="nav-link">ข้อมูลส่วนตัว</a>
    </li>
    @if(Auth::user()->isPresenter())
        <li class="nav-item @yield('check')">
            <a href="{{ route('member.submission.index') }}" 
            class="nav-link {{ Auth::user()->hasSubmission() ?: "disabled" }}">
                ตรวจสอบการส่งบทคัดย่อ และผลการพิจารณา
            </a>
        </li>
        <li class="nav-item @yield('submission')">
            <a href="{{ route('member.submission.create') }}" 
            class="nav-link {{ Auth::user()->canSubmitAbstract() ?: "disabled" }}">
                ส่งบทคัดย่อ
            </a>
        </li>
    @endif
    <li><hr class="text-white"></li>
    <li class="nav-item">
        <form action="{{ route('logout') }}" method="POST" class="nav-link p-0">
            @csrf
            <button class="nav-link text-inherit bg-none border-0 w-100" style="background: none;" type="submit" name="logout" onclick="this.blur();">
                ออกจากระบบ
            </button>
        </form>
    </li>
</ul>