<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    {{-- scripts --}}
    <script src="https://kit.fontawesome.com/03ec1819cd.js"></script>
    @vite(['resources/scss/app.scss', 'resources/js/app.js'])
    {{-- scripts --}}
</head>
<body>
    <div class="container-fluid">
        <div class="row">

            {{-- navigation --}}
            @include('layout.nav')

            {{-- page content --}}
            <div class="col">
                @yield('content')
            </div>
        </div>
    </div>
</body>
</html>

