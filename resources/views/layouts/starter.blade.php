<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    @include('layouts.includes.meta')

    @stack('before-styles')
    <link href="{{ asset('asset/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('asset/css/style.min.css') }}" rel="stylesheet">
    <link href="{{ asset('asset/css/colors/' . $theme_color . '.min.css') }}" id="theme" rel="stylesheet">
    @stack('after-styles')
</head>

<body class="fix-header card-no-border">

<div id="main-wrapper">
    @include('layouts.includes.header-topbar-starter')

    <div class="page-wrapper">
        <div class="container-fluid">
            @yield('content')
        </div>
    </div>

    @include('layouts.includes.footer')
</div>

@stack('before-scripts')
<script src="{{ asset('asset/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('asset/vendor/bootstrap/js/tether.min.js') }}"></script>
<script src="{{ asset('asset/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('asset/vendor/sticky-kit-master/sticky-kit.min.js') }}"></script>
<script src="{{ asset('asset/js/jquery.slimscroll.js') }}"></script>
<script src="{{ asset('asset/js/sidebarmenu.js') }}"></script>
<script src="{{ asset('asset/js/custom.js') }}"></script>
@stack('after-scripts')

@include('layouts.includes.ga')
</body>

</html>