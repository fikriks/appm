<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <x-head/>
</head>

<body>
    <div id="app">
         @yield('content')
    </div>
</body>

</html>
