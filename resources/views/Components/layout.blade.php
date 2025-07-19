<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="/images/header/devcamp-white2.svg">
    <link rel="stylesheet" href="/css/root.css">
    <link rel="stylesheet" href="/css/header.css">
    <link rel="stylesheet" href="/css/main.css">
    <title>{{ $title ?? 'Курсы' }}</title>
</head>
<body>
    @yield('header')


    @yield('content')

    @yield('footer')

</body>
</html>
