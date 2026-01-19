<nav class="navbar navbar-dark">
    <div class="container">
        <a class="navbar-brand" href="{{ route('public.home') }}">
            <img src="{{ asset('img/60year-fsci.png') }}" alt="kmutt-fsci">
        </a>
        <div lang="th">
            @include('partials.navbar.admin')
        </div>
    </div>
</nav>
