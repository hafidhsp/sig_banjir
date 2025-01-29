<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{ $title }} - SIG</title>
    <link rel="icon" href="{{ asset('image/logo_4.png') }}" type="image/x-icon">

    <!-- base:css -->
    <link rel="stylesheet" href="{{ asset('vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/css/vendor.bundle.base.css') }}">
    <link href="{{ asset('cdn/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- endinject -->
    <!-- plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('css3/style.css') }}">
    <!-- endinject -->
    {{-- <link rel="shortcut icon" href="images/favicon.png" /> --}}

    {{-- datatables --}}
    <link href="{{ asset('ajax/twitter-bootstrap/5.3.0/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('ajax/twitter-bootstrap/5.3.0/css/datatables.min.css') }}" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

{{-- alertify --}}
<!-- CSS -->
<link rel="stylesheet" href="{{ asset('alertify/css/alertify.min.css') }}"/>
<!-- Default theme -->
<link rel="stylesheet" href="{{ asset('alertify/css/themes/default.min.css') }}"/>
<!-- Semantic UI theme -->
<link rel="stylesheet" href="{{ asset('alertify/css/themes/semantic.min.css') }}"/>
<!-- Bootstrap theme -->
<link rel="stylesheet" href="{{ asset('alertify/css/themes/bootstrap.min.css') }}"/>
{{-- FA Icon --}}
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

{{-- select option --}}
<link
  rel="stylesheet"
  href="{{ asset('choiceJs/choices.min.css') }}"
/>
{{-- date timepicker --}}
<link rel="stylesheet" href="{{ asset('bootstrap-date-time-picker/bootstrap5/css/bootstrap-datetimepicker.css') }}" />
<link rel="stylesheet" href="{{ asset('bootstrap-date-time-picker/bootstrap5/css/bootstrap-datetimepicker.min.css') }}" />


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css">

    @livewireStyles

</head>

<body>
    <div class="container-scroller d-flex">
        <!-- partial:./partials/_sidebar.html -->
        @include('layout.sidebar')
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:./partials/_navbar.html -->
            @include('layout.navbar')
            <div class="main-panel">
                @yield('content')

                <!-- content-wrapper ends -->
                <!-- partial:./partials/_footer.html -->
                @include('layout.footer')
                {{-- @yield('footer') --}}
                <!-- partial -->

                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    @livewire('modal.modal')

    {{-- JQuery --}}
    <!-- base:js -->
    <script src="{{ asset('vendors/js/vendor.bundle.base.js') }}"></script>
    {{-- <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script> --}}
    {{-- <script src="https://cdn.datatables.net/v/bs5/jq-3.7.0/dt-2.2.1/af-2.7.0/cr-2.0.4/date-1.5.5/fc-5.0.4/fh-4.0.1/kt-2.12.1/r-3.0.3/rg-1.5.1/rr-1.5.0/sc-2.4.3/sb-1.8.1/sp-2.3.3/sl-3.0.0/sr-1.4.1/datatables.min.js"></script> --}}
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script> --}}
    {{-- <script>
        var jQuery360 = $.noConflict(true); // Simpan versi jQuery yang lebih baru
    </script> --}}

    {{-- Apex Chart Js --}}
    <script src="{{ asset('dist/apexcharts.min.js') }}"></script>

    <!-- endinject -->
    <!-- Plugin js for this page-->
    <script src="{{ asset('vendors/chart.js/Chart.min.js') }}"></script>
    <!-- End plugin js for this page-->
    <!-- inject:js -->
    <script src="{{ asset('js/off-canvas.js') }}"></script>
    <script src="{{ asset('js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('js/template.js') }}"></script>
    <script src="{{ asset('js/file-upload.js') }}"></script>
    <!-- endinject -->
    <!-- plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- Custom js for this page-->
    <script src="{{ asset('js/dashboard.js') }}"></script>
    <script src="{{ asset('alertify/alertify.min.js') }}"></script>
    <script src="{{ asset('alertify/alertify.js') }}"></script>
    <!-- End custom js for this page-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    {{-- alertify --}}
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/alertify.min.js"></script>
    {{-- sweet alert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script> --}}
<script src="https://cdn.datatables.net/2.0.2/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.0.2/js/dataTables.bootstrap5.js"></script>

{{-- select option --}}
<script src="{{ asset('choiceJs/choices.min.js') }}"></script>


{{-- date timepicker --}}
<script src="{{ asset('bootstrap-date-time-picker/bootstrap5/js/bootstrap-datetimepicker.js') }}" > </script>
<script src="{{ asset('bootstrap-date-time-picker/bootstrap5/js/bootstrap-datetimepicker.min.js') }}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>



<script>
function initializeDataTable(tableSelector) {
    $(tableSelector).DataTable({
        ordering: true,
        pageLength: 10,
        info: true,
        lengthChange: true,
        language: {
            lengthMenu: "_MENU_ Data dimuat",
            info: "Menampilkan _START_ hingga _END_ dari total _TOTAL_ data"
        },
        layout: {
            topEnd: 'search'
        },
    });
}

function destroyDataTable(tableSelector) {
    if ($.fn.DataTable.isDataTable(tableSelector)) {
        $(tableSelector).DataTable().destroy();
        $(tableSelector).empty();
    }
}
</script>
    @stack('scripts')

    @livewireScripts

</body>

</html>
