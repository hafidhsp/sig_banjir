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
    {{--
    <link href="{{ asset('cdn/css/bootstrap.min.css') }}" rel="stylesheet"> --}}
    {{--
    <link href="{{ asset('scss/custom.scss') }}" rel="stylesheet"> --}}

    <!-- endinject -->
    <!-- plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('css3/style.css') }}">
    <!-- endinject -->
    {{--
    <link rel="shortcut icon" href="images/favicon.png" /> --}}

    {{-- datatables --}}
    <link href="{{ asset('ajax/twitter-bootstrap/5.3.0/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('ajax/twitter-bootstrap/5.3.0/css/datatables.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    {{-- alertify --}}
    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('alertify/css/alertify.min.css') }}" />
    <!-- Default theme -->
    <link rel="stylesheet" href="{{ asset('alertify/css/themes/default.min.css') }}" />
    <!-- Semantic UI theme -->
    <link rel="stylesheet" href="{{ asset('alertify/css/themes/semantic.min.css') }}" />
    <!-- Bootstrap theme -->
    <link rel="stylesheet" href="{{ asset('alertify/css/themes/bootstrap.min.css') }}" />
    {{-- FA Icon --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    {{-- select option --}}
    <link rel="stylesheet" href="{{ asset('choiceJs/choices.min.css') }}" />
    {{-- date timepicker --}}
    <link rel="stylesheet"
        href="{{ asset('bootstrap-date-time-picker/bootstrap5/css/bootstrap-datetimepicker.css') }}" />
    <link rel="stylesheet"
        href="{{ asset('bootstrap-date-time-picker/bootstrap5/css/bootstrap-datetimepicker.min.css') }}" />

    {{--
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css"> --}}
    {{--
    <link rel="stylesheet" href="{{ asset('leaflet/leaflet.css') }}" /> --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />


    {{-- <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script> --}}
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    {{--
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/fontawesome.min.css">
    --}}

    {{-- Flat Picker --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    {{-- select 2 --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <style>
        .clickable-cell {
            cursor: pointer;
        }

        .btn-close-custom {
            position: absolute;
            top: 0px;
            background: white;
            border: none;
            font-size: 24px;
            color: #333;
            padding: 10px;
            cursor: pointer;
            border-radius: 10%;
        }

        .btn-close-custom-start {
            position: absolute;
            left: -30px;
            top: 0px;
            background: white;
            border: none;
            font-size: 24px;
            color: #333;
            padding: 10px;
            cursor: pointer;
            border-radius: 10%;
        }

        .offcanvas-scroll {
            max-height: 100vh;
            overflow-y: auto;
            padding-bottom: 20px;
        }

        .btn-secondary-custom {
            background-color: transparent;
            color: rgb(108, 117, 125, 0.5);
            box-shadow: none;
            border-radius: 0;
            width: 75px;
            height: 40px;
            transition: all 0.3s ease-in-out;
        }

        .btn-secondary-custom:first-child {
            border-top-left-radius: 15px;
            border-bottom-left-radius: 0;
        }

        /* Saat tombol di-hover atau aktif */
        .btn-secondary-custom:hover,
        .btn-secondary-custom:active,
        .btn-secondary-custom.active {
            background-color: rgb(108, 117, 125, 0.5) !important;
            color: white !important;
            border-color: rgb(108, 117, 125, 0.5);
        }

        .btn-secondary-custom:focus {
            outline: none;
            box-shadow: none;
        }


        .bg-secondary-container {
            background-color: rgba(108, 117, 125, 0.5) !important;
            padding: 0 !important;
            border: none !important;
            margin-top: -1px;
        }

        #map {
            height: 60vh;
        }

        .icon-option {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
            cursor: pointer;
            margin-bottom: 5px;
        }

        /* .icon-option input {
            display: none;
        } */

        .icon-option i {
            font-size: 24px;
            color: #111111;
        }

        .icon-option input:checked+i {
            color: #007bff;
            font-weight: bold;
        }

        .select2-container .select2-selection--single {
            border: 1px solid #ced4da;
            border-radius: .25rem;
            height: calc(2.25rem + 2px);
            padding: .375rem .75rem;
            background-color: #fff;
        }

        .select2-container .select2-selection--single:not(.select2-selection--multiple) {
            border-color: black;
        }

        .select2-container .select2-selection--single:focus {
            border-color: #80bdff;
            outline: 0;
            box-shadow: 0 0 0 .2rem rgba(38, 143, 255, .25);
        }

        .select2-container .select2-dropdown {
            border: 1px solid #ced4da;
            border-radius: .25rem;
        }

        .select2-container .select2-search__field {
            border: 1px solid black;
            border-radius: .25rem;
            height: calc(2.25rem + 2px);
            padding: .375rem .75rem;
            background-color: #fff;
        }
    </style>

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
    {{-- <script
        src="https://cdn.datatables.net/v/bs5/jq-3.7.0/dt-2.2.1/af-2.7.0/cr-2.0.4/date-1.5.5/fc-5.0.4/fh-4.0.1/kt-2.12.1/r-3.0.3/rg-1.5.1/rr-1.5.0/sc-2.4.3/sb-1.8.1/sp-2.3.3/sl-3.0.0/sr-1.4.1/datatables.min.js">
    </script> --}}
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js">
    </script> --}}
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

    {{-- alertify --}}
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/alertify.min.js"></script>
    {{-- sweet alert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js">
    </script> --}}
    <script src="https://cdn.datatables.net/2.0.2/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.2/js/dataTables.bootstrap5.js"></script>

    {{-- select option --}}
    <script src="{{ asset('choiceJs/choices.min.js') }}"></script>


    {{-- date timepicker --}}
    <script src="{{ asset('bootstrap-date-time-picker/bootstrap5/js/bootstrap-datetimepicker.js') }}"> </script>
    <script src="{{ asset('bootstrap-date-time-picker/bootstrap5/js/bootstrap-datetimepicker.min.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>


    {{--
    <script src="{{ asset('leaflet/leaflet.js') }}"></script>
    <script src="{{ asset('leaflet/leaflet-src.js') }}"></script> --}}

    {{-- flat picker --}}
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    {{-- select2 --}}
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>



    <script>
        function initializeDataTable(tableSelector) {
        // $(tableSelector).DataTable().ajax.reload();
        $(tableSelector).DataTable({
            ordering: true,
            pageLength: 10,
            info: true,
            lengthChange: true,
            processing: true,
            serverSide: false,
            language: {
                lengthMenu: "_MENU_ Data dimuat",
                info: "Menampilkan _START_ hingga _END_ dari total _TOTAL_ data"
            },
            layout: {
                topEnd: 'search'
            },
        });
        // $(tableSelector).DataTable().ajax.reload();
    }

    function destroyDataTable(tableSelector) {
        if ($.fn.DataTable.isDataTable(tableSelector)) {
            $(tableSelector).DataTable().destroy();
            $(tableSelector).empty();
                // Remove all DataTable-related elements like pagination, etc.
            // $(tableSelector).children('thead').remove();
            // $(tableSelector).children('tfoot').remove();
            // $(tableSelector).children('tbody').empty();
        }
    }

    // var defaultLatitude = -7.712896;
    // var defaultLongitude = 109.028118;
    // var map;
    // var currentLayer = null;

    // function setBaseView(latitude, longitude, zoomLevel = 13) {
    //     var baseLatitude = latitude ?? defaultLatitude;
    //     var baseLongitude = longitude ?? defaultLongitude;

    //     // Jika peta belum dibuat, buat peta baru
    //     if (!map) {
    //         map = L.map('map').setView([baseLatitude, baseLongitude], zoomLevel);
    //     } else {
    //         map.setView([baseLatitude, baseLongitude], zoomLevel);
    //     }
    //         L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    //             attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    //         }).addTo(map);
    // }
    // function addLocationsToMap(locations, categoryFilter) {
    //     var layerGroup = L.layerGroup();

    //     locations.forEach(function(location) {
    //         if (location.category === categoryFilter || categoryFilter === "all") {
    //             var customIcon = L.divIcon({
    //                 html: `<i class='${location.icon}' style='font-size: 30px; color: ${location.color};'></i>`,
    //                 iconSize: [30, 30],
    //                 className: ""
    //             });

    //             var kategori = location.color === 'green' ? 'Normal' :
    //                            location.color === 'yellow' ? 'Waspada' :
    //                            location.color === 'red' ? 'Bahaya' : 'Default';

    //             var marker = L.marker([location.lat, location.lng], { icon: customIcon })
    //                 .bindPopup(`<b>${location.name}</b><br>Kategori: ${kategori}<br>Radius: ${location.radius} meter`);

    //             var circle = L.circle([location.lat, location.lng], {
    //                 color: location.color,
    //                 fillColor: location.color,
    //                 fillOpacity: 0.2,
    //                 radius: location.radius
    //             });

    //             marker.addTo(layerGroup);
    //             circle.addTo(layerGroup);
    //         }
    //     });

    //     return layerGroup;
    // }

    // // Fungsi untuk menampilkan lokasi-lokasi tanpa mengubah Base View
    // function updateMap(locations, categoryFilter) {
    //     if (currentLayer) {
    //         map.removeLayer(currentLayer);
    //     }

    //     currentLayer = addLocationsToMap(locations, categoryFilter);
    //     currentLayer.addTo(map);
    // }



    // function addLocationsToMap(locations, categoryFilter) {
    //     var layerGroup = L.layerGroup();

    //     locations.forEach(function(location) {
    //         if (location.category === categoryFilter || categoryFilter === "all") {
    //             var customIcon = L.divIcon({
    //                 html: `<i class='${location.icon}' style='font-size: 30px; color: ${location.color};'></i>`,
    //                 iconSize: [30, 30],
    //                 className: ""
    //             });

    //             var kategori = location.color === 'green' ? 'Normal' :
    //                            location.color === 'yellow' ? 'Waspada' :
    //                            location.color === 'red' ? 'Bahaya' : 'Default';

    //             var marker = L.marker([location.lat, location.lng], { icon: customIcon })
    //                 .bindPopup(`<b>${location.name}</b><br>Kategori: ${kategori}<br>Radius: ${location.radius} meter`);

    //             var circle = L.circle([location.lat, location.lng], {
    //                 color: location.color,
    //                 fillColor: location.color,
    //                 fillOpacity: 0.2,
    //                 radius: location.radius
    //             });

    //             marker.addTo(layerGroup);
    //             circle.addTo(layerGroup);
    //         }
    //     });

    //     return layerGroup;
    // }

    // function updateMap(mapId, locations, categoryFilter) {
    //     if (currentLayers[mapId]) {
    //         maps[mapId].removeLayer(currentLayers[mapId]);
    //     }

    //     currentLayers[mapId] = addLocationsToMap(locations, categoryFilter);
    //     currentLayers[mapId].addTo(maps[mapId]);
    // }

    var defaultLatitude = -7.712896;
    var defaultLongitude = 109.028118;
    var maps = {};
    var currentLayers = {};

    function setBaseView(mapId, latitude, longitude, zoomLevel = 13) {
        var baseLatitude = latitude ?? defaultLatitude;
        var baseLongitude = longitude ?? defaultLongitude;

        if (!maps[mapId]) {
            maps[mapId] = L.map(mapId).setView([baseLatitude, baseLongitude], zoomLevel);
            L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; Sistem Informasi Geografis Kabupaten Cilacap'
            }).addTo(maps[mapId]);
        } else {
            maps[mapId].setView([baseLatitude, baseLongitude], zoomLevel);
        }
    }
    function addLocationsToMap1(locations, categoryFilter) {
        var greenLayer = L.layerGroup();
        var yellowLayer = L.layerGroup();
        var redLayer = L.layerGroup();

        locations.forEach(function(location) {
            var kategori = location.color === 'green' ? 'Normal' :
                        location.color === 'yellow' ? 'Waspada' :
                        location.color === 'red' ? 'Bahaya' : 'Default';

            var customIcon = L.divIcon({
                html: `<i class='${location.icon}' style='font-size: 30px; color: ${location.color};'></i>`,
                iconSize: [30, 30],
                className: ""
            });

            var marker = L.marker([location.lat, location.lng], { icon: customIcon })
                .bindPopup(`<b>${location.name}</b><br>Kategori: ${kategori}<br>Radius: ${location.radius} meter`);

            var circle = L.circle([location.lat, location.lng], {
                color: location.color,
                fillColor: location.color,
                fillOpacity: 0.2,
                radius: location.radius
            });

            // Masukkan ke layer berdasarkan warnanya
            if (location.color === 'green' && visibleLayer.green) {
                marker.addTo(greenLayer);
                circle.addTo(greenLayer);
            } else if (location.color === 'yellow' && visibleLayer.yellow) {
                marker.addTo(yellowLayer);
                circle.addTo(yellowLayer);
            } else if (location.color === 'red' && visibleLayer.red) {
                marker.addTo(redLayer);
                circle.addTo(redLayer);
            }
        });

        return { greenLayer, yellowLayer, redLayer };
    }
    var layerControl = null; // Variabel untuk menyimpan kontrol layer

    // Layer yang bisa ditampilkan/dihilangkan berdasarkan warna
    var visibleLayer = {
        green: true,
        yellow: true,
        red: true
    };

    // Layer yang bisa ditampilkan/dihilangkan berdasarkan ikon
    var visibleIcon = {
        "mdi mdi-map-marker": true,         // Normal
        "fa-solid fa-water": true,          // Banjir
        "fa-solid fa-house-flood-water": true // Banjir Bandang
    };


    function clearExistingLayers(mapId) {
        if (window[mapId] && window[mapId]._layers) {
            Object.keys(window[mapId]._layers).forEach(function(layerId) {
                var layer = window[mapId]._layers[layerId];
                if (layer instanceof L.Marker || layer instanceof L.Circle) {
                    window[mapId].removeLayer(layer);
                }
            });
        }
    }
    // Fungsi untuk menambahkan lokasi ke peta dengan filter warna & ikon
    function addLocationsToMap(locations) {
        var greenLayer = L.layerGroup();
        var yellowLayer = L.layerGroup();
        var redLayer = L.layerGroup();

        var normalLayer = L.layerGroup();
        var banjirLayer = L.layerGroup();
        var banjirBdgLayer = L.layerGroup();

        locations.forEach(function(location) {
            var kategori = location.color === 'green' ? 'Normal' :
                        location.color === 'yellow' ? 'Waspada' :
                        location.color === 'red' ? 'Bahaya' : 'Default';

            var customIcon = L.divIcon({
                html: `<i class='${location.icon}' style='font-size: 30px; color: ${location.color};'></i>`,
                iconSize: [30, 30],
                className: ""
            });

            var marker = L.marker([location.lat, location.lng], { icon: customIcon })
                .bindPopup(`<b>${location.name}</b><br>Kategori: ${kategori}<br>Radius: ${location.radius} meter`);

            var circle = L.circle([location.lat, location.lng], {
                color: location.color,
                fillColor: location.color,
                fillOpacity: 0.5,
                radius: location.radius??0,
                // radius: Number(location.radius)??0,
                interactive: true,
                zIndex: 1000
                // radius: location.radius
            });
            // console.log(circle);

            if (visibleLayer[location.color] && visibleIcon[location.icon]) {
                if (location.color === 'green') {
                    // marker.addTo(greenLayer);
                    circle.addTo(greenLayer);
                } else if (location.color === 'yellow') {
                    // marker.addTo(yellowLayer);
                    circle.addTo(yellowLayer);
                } else if (location.color === 'red') {
                    // marker.addTo(redLayer);
                    circle.addTo(redLayer);
                }
            }

            if (visibleIcon[location.icon]) {
                if (location.icon === "mdi mdi-map-marker") {
                    marker.addTo(normalLayer);
                } else if (location.icon === "fa-solid fa-water") {
                    marker.addTo(banjirLayer);
                } else if (location.icon === "fa-solid fa-house-flood-water") {
                    marker.addTo(banjirBdgLayer);
                }
            }
        });

        return { greenLayer, yellowLayer, redLayer, normalLayer, banjirLayer, banjirBdgLayer };
    }

    function updateMap(mapId, locations, filter = false) {
        // console.log(filter);

        if (currentLayers[mapId]) {
            if (currentLayers[mapId].greenLayer) maps[mapId].removeLayer(currentLayers[mapId].greenLayer);
            if (currentLayers[mapId].yellowLayer) maps[mapId].removeLayer(currentLayers[mapId].yellowLayer);
            if (currentLayers[mapId].redLayer) maps[mapId].removeLayer(currentLayers[mapId].redLayer);
            if (currentLayers[mapId].normalLayer) maps[mapId].removeLayer(currentLayers[mapId].normalLayer);
            if (currentLayers[mapId].banjirLayer) maps[mapId].removeLayer(currentLayers[mapId].banjirLayer);
            if (currentLayers[mapId].banjirBdgLayer) maps[mapId].removeLayer(currentLayers[mapId].banjirBdgLayer);
        }

        currentLayers[mapId] = addLocationsToMap(locations);

        if (visibleLayer.green) currentLayers[mapId].greenLayer.addTo(maps[mapId]);
        if (visibleLayer.yellow) currentLayers[mapId].yellowLayer.addTo(maps[mapId]);
        if (visibleLayer.red) currentLayers[mapId].redLayer.addTo(maps[mapId]);

        if (visibleIcon["mdi mdi-map-marker"]) currentLayers[mapId].normalLayer.addTo(maps[mapId]);
        if (visibleIcon["fa-solid fa-water"]) currentLayers[mapId].banjirLayer.addTo(maps[mapId]);
        if (visibleIcon["fa-solid fa-house-flood-water"]) currentLayers[mapId].banjirBdgLayer.addTo(maps[mapId]);

        if (!filter &&layerControl) {
            maps[mapId].removeControl(layerControl);
            layerControl = null;
            return;
        }

        if (filter) {
            layerControl = L.control.layers(null, {
                "Zona Hijau (Normal)": currentLayers[mapId].greenLayer,
                "Zona Kuning (Waspada)": currentLayers[mapId].yellowLayer,
                "Zona Merah (Bahaya)": currentLayers[mapId].redLayer,
                "Normal": currentLayers[mapId].normalLayer,
                "Banjir": currentLayers[mapId].banjirLayer,
                "Banjir Bandang": currentLayers[mapId].banjirBdgLayer
            }, { collapsed: false }).addTo(maps[mapId]);

            var controlContainer = document.querySelector('.leaflet-control-layers');
            controlContainer.style.opacity = '0';
            controlContainer.style.transition = 'opacity 0.3s';

            maps[mapId].getContainer().addEventListener('mouseover', function() {
                controlContainer.style.opacity = '1';
            });

            maps[mapId].getContainer().addEventListener('mouseout', function() {
                controlContainer.style.opacity = '0';
            });
        }
    }

        $(document).ready(function() {
            $('.select2').select2({
                theme: 'bootstrap5'
            });
        });



    function filterLettersOnly(input) {
        input.value = input.value.replace(/[^a-zA-Z\s]/g, '');
    }

    function filterLatLong(input) {
        input.value = input.value
            .replace(/[^0-9.\-]/g, '')
            .replace(/(\..*?)\..*/g, '$1')
            .replace(/(?!^)-/g, '');
    }


    function filterNumbersOnly(input) {
        input.value = input.value.replace(/[^0-9]/g, '');
    }


    </script>
    @stack('scripts')

    @livewireScripts

</body>

</html>
