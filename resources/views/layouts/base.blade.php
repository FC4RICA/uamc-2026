<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    {{-- Shared CSS --}}
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css') }}" >
    @stack('styles')
    
    @vite(['resources/js/app.js'])

    <title>
        @if(View::hasSection('title'))
            @yield('title') - UAMC2026
        @else
            UAMC2026
        @endif
    </title>
</head>
<body data-page=@yield('data-page')>

    {{-- Page-specific header --}}
    @yield('header')

    {{-- Main content --}}
    @yield('body')

    {{-- Shared --}}
    @include('components.pdpa')
    @include('components.footer')

    {{-- Shared JS --}}
    <script src="{{ asset('js/jquery-3.4.1.js') }}"></script>
    <script src="{{ asset('js/popper.js') }}"></script>
    <script src="{{ asset('js/bootstrap.js') }}"></script>
    <script src="{{ asset('js/jquery.validate.js') }}"></script>
    {{-- might cause bug (only used in member layout) --}}
    <script src="{{ asset('js/additional-methods.js') }}"></script>

    <script src="{{ asset('js/control.js') }}"></script>
    <script src="{{ asset('js/form-validate.js') }}"></script>

    @stack('scripts')
</body>
</html>
