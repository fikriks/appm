<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <x-head/>
</head>

<body>
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg main-navbar">
                <x-topbar/>
            </nav>
            <div class="main-sidebar sidebar-style-2">
                <x-sidebar/>
            </div>

            <div class="main-content">
                @yield('content')
            </div>
            <footer class="main-footer">
                <x-footer/>
            </footer>
        </div>
    </div>

   <x-scripts/>
</body>

</html>
