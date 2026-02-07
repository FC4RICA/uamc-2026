<ul class="navbar-nav">
    <li class="nav-item">
        <a href="{{ route('member.index') }}" class="nav-link @yield('home')">
            หน้าแรก
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('public.home') }}" class="nav-link">
            กลับหน้าเว็บหลัก
        </a>
    </li>
    @if (Auth::user()->payment_required)
        <li class="Nav-item">
            <a href="{{ route('member.payment.create') }}" class="nav-link @yield('payment')">
                ชำระค่าลงทะเบียน
            </a>
        </li>
    @endif
    <li class="nav-item">
        <a href="{{ route('member.profile.edit') }}" class="nav-link @yield('profile')">
            ข้อมูลส่วนตัว
        </a>
    </li>
    @if (Auth::user()->isPresenter())
        <li class="nav-item">
            <a href="{{ route('member.submission.abstract.index') }}" disabled
                class="nav-link @yield('check') {{ Auth::user()->hasSubmission() ?: 'disabled' }}">
                ตรวจสอบการส่งบทคัดย่อ และผลการพิจารณา
            </a>
        </li>
        @abstractSubmissionOpen
            <li class="nav-item">
                <a href="{{ route('member.submission.abstract.create') }}"
                    class="nav-link @yield('submission') {{ Auth::user()->canSubmitAbstract() ?: 'disabled' }}">
                    ส่งบทคัดย่อ
                </a>
            </li>
        @endabstractSubmissionOpen
    @endif
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
