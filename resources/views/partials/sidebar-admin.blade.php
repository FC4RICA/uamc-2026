<nav class="navbar navbar-dark">
    <div class="container">
        <a class="navbar-brand" href="{{ route('public.home') }}">
            <img src="{{ asset('img/logo.png') }}" alt="kmutt-fsci">
        </a>
        <div lang="th">
            @include('partials.navbar.admin')
        </div>
    </div>
</nav>
