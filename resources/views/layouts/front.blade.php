<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="{{ empty($category->description) ? '' : strip_tags($category->description) }}" />
    <meta name="keywords" content="{{ empty($category->keywords) ? '' : strip_tags($category->keywords) }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    {{-- <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}"> --}}
    {{-- <link href="/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"> --}}
    <link id="css-light" rel="stylesheet" href="{{ asset('dist/bootstrap.css') }}">
    <link id="css-dark" rel="stylesheet" href="{{ asset('dist/bootstrap-dark.css') }}" disabled="">

    <link href="/css/font-awesome.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> @yield('title')</title>

    <link rel="stylesheet" href="/css/swiper-bundle.min.css" />
    <link rel="stylesheet" href="/css/style.css?ver=1.2">

</head>

<body>
    @include('layouts.parts.answer_call')
    <div class="page">
        @include('layouts.parts.top_menu')
        <div class="container">
            @yield('content')
        </div>
        @include('layouts.parts.footer')
    </div>
    <script src="/js/vendor/jquery-1.11.2.min.js"></script>
    <script src="/js/vendor/bootstrap.bundle.min.js"></script>
    <script src="/js/vendor/swiper-bundle.min.js"></script>
    <script src="/js/vendor/jquery.validate.min.js"></script>
    <script src="{{ asset('js/index.js') }}"></script>
    <script src="{{ asset('js/night.js') }}"></script>
    @livewireScripts
    @yield('scripts')
</body>

</html>
