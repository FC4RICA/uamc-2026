<nav id="memberMode" class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="{{ route('public.home') }}">
            <img src="{{ asset('img/60year-fsci.png') }}" alt="kmutt-fsci">
        </a>
        <div class="collapse navbar-collapse" id="navbarSupportedContent" lang="th">
            @include('partials.navbar.member')
        </div>
    </div>
</nav>
