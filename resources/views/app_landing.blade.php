<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    {{-- <meta
      name="robots"
      content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1" /> --}}
    {{-- <meta name="viewport" content="width=device-width, initial-scale=1" /> --}}
    <title>SIG - Kabupaten Cilacap</title>
    <!-- Favicon-->
    <link rel="icon" href="{{ asset('image/logo_4.png') }}" type="image/x-icon">
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css">
    <link rel="stylesheet" href="{{ asset('asset_landing/assets/css/main.css') }}" />
    {{-- FA Icon --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css" rel="stylesheet"> --}}
    {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet"> --}}
    {{-- <link href="https://cdn.jsdelivr.net/npm/font-awesome@6.0.0-beta3/css/all.min.css" rel="stylesheet"> --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('vendors/mdi/css/materialdesignicons.min.css') }}">

    {{-- Flat Picker --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    @livewireStyles

</head>

<body>
    <!-- Responsive navbar-->
    @yield('content')
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
    {{-- flat picker --}}
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script> --}}

    <!-- Scripts -->
    <script src="{{ asset('asset_landing/assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('asset_landing/assets/js/jquery.scrolly.min.js') }}"></script>
    <script src="{{ asset('asset_landing/assets/js/skel.min.js') }}"></script>
    <script src="{{ asset('asset_landing/assets/js/util.js') }}"></script>
    <script src="{{ asset('asset_landing/assets/js/main.js') }}"></script>


    @stack('scripts')
    @livewireScripts

</body>

</html>
