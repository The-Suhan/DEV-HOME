<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DEV HOME </></title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fancybox.css') }}">
    <link rel="stylesheet" href="{{ asset('css/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/splide.min.css') }}">

    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/aos.js') }}"></script>
    <script src="{{ asset('js/fancybox.umd.js') }}"></script>
    <script src="{{ asset('js/splide.min.js') }}"></script>   

    <link rel="stylesheet" href="{{ asset('css/icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/icons/fonts/bootstrap-icons.woff') }}">

    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <script src="{{ asset('js/script.js') }}"></script>
</head>

<body>
    @include('app.sidebar')

    @yield('home-section')
</body>

</html>