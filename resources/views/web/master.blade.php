<!--
Author: Dong Nguyen
Website URL: http://dnguyen.xyz
-->
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="{{ asset('vendor/dnsoft/admin/img/logo.png') }}"/>
    @include('cms::web.partials.style')

    @stack('style')

    @yield('seometa')

    <title>@yield('title', 'Welcome to my blog')</title>

</head>
<body>

    @include('cms::web.partials.header')

    @include('cms::web.partials.category')


    @yield('content')

    @include('cms::web.partials.subscribe')

    @include('cms::web.partials.footer')

    @include('cms::web.partials.script')

    @stack('script')

</body>

</html>
