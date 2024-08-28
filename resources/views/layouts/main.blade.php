<!-- resources/views/layouts/main.blade.php -->
@include('layouts.header')
@include('layouts.sidebar')
@yield('content')
@yield('stats')
@include('layouts.footer')
@yield('javascript')
