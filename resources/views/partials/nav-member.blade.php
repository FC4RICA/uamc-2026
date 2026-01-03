@php
    use App\Enums\ParticipationType;
@endphp

<nav id="memberMode" class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="/"><img src="{{ asset('img/60year-fsci.png') }}" alt="kmutt-fsci"></a>

        <div class="collapse navbar-collapse" id="navbarSupportedContent" lang="th">
            <ul class="navbar-nav">
                <li class="nav-item @yield('home')">
                    <a href="{{ route('member.index') }}" class="nav-link">หน้าแรก</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('public.home') }}" class="nav-link">กลับหน้าเว็บหลัก</a>
                </li>
                <li class="nav-item @yield('profile')">
                    <a href="{{ route('member.profile.index') }}" class="nav-link">ข้อมูลส่วนตัว</a>
                </li>
                @if(in_array(Auth::user()->participation_type, [ParticipationType::ORAL, ParticipationType::POSTER]))
                    <li class="nav-item @yield('check')">
                        <a href="{{ route('member.submission.index') }}" class="nav-link">ตรวจสอบการส่งบทคัดย่อ และผลการพิจารณา</a>
                    </li>
                    <li class="nav-item @yield('submission')">
                        <a href="{{ route('member.submission.create') }}" class="nav-link">ส่งบทคัดย่อ</a>
                    </li>
                @endif
                <li class="nav-item">
                    <a href="{{ route('public.logout') }}" class="nav-link">ออกจากระบบ</a>
                </li>
            </ul>
        </div>
    </div>
</nav>