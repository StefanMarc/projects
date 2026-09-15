<!DOCTYPE html>
<html>
<head>
    <title>App Name - @yield('title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    @include('partials.nav')
    @yield('content')
</body>
</html>