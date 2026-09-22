<!DOCTYPE html>
<html>
<head>
    <title>Weblog - @yield('title')</title>
    @vite('resources/css/app.css')
</head>
<body>
    @include('partials.nav')
    @yield('content')
</body>
</html>