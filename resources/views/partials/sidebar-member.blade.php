<nav class="navbar navbar-dark flex-col align-top p-2">
    <div class="container">
        <a class="navbar-brand m-0" href="{{ route('public.home') }}">
            <img class="img-fluid" src="{{ asset('img/60year-fsci.png') }}" alt="kmutt-fsci">
        </a>
        <div lang="th">
            @include('partials.navbar.member')
        </div>
    </div>
</nav>
