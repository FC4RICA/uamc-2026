<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ asset('img/favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css') }}">
    @stack('styles')

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <title>
        @if (View::hasSection('title'))
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

    @stack('scripts')
</body>

</html>
