<div>
    <header id="header">
        <nav class="left">
            <a href="#menu"><span>Menu</span></a>
        </nav>
        <a href="index.html" class="logo">Sistem Informasi Geografis Kabupaten Cilacap</a>
        <nav class="right">
            <a href="{{ url('/login') }}" class="button alt fw-bold" >Masuk/ Daftar
            </a>
        </nav>
    </header>
    <!-- Menu -->
    <nav id="menu">
        <ul class="links">
            <li><a href="#banner">Beranda</a></li>
            <li><a href="#two">Tentang</a></li>
            <li><a href="#one">Fitur</a></li>
            <li><a href="#peta">Peta</a></li>
        </ul>
        <ul class="actions vertical">
            <li><a href="#" class="button fit">Login</a></li>
        </ul>
    </nav>
    <!-- Banner -->
    <section id="banner">
        <div class="row mx-4">
            <div class="col-lg-5">
                <div class="content">
                    {{-- <h1 class="text-dark">Ipsum sed lorem</h1> --}}
                    <p class="text-dark g-1">
                        <b class="interactive-text">
                            <span class="highlight">Sistem Informasi Geografis (SIG)</span> Kabupaten Cilacap<br>
                            dirancang untuk memetakan dan mengidentifikasi daerah rawan banjir, serta memberikan informasi terkini mengenai kondisi banjir, upaya penanganan, dan strategi penanggulangan yang efektif untuk meminimalisir dampaknya di wilayah cilacap.
                        </b>
                    </p>
                    {{-- <ul class="actions">
                        <li><a href="#one" class="button scrolly">Get Started</a></li>
                    </ul> --}}
                </div>
            </div>
        </div>
    </section>
    <section id="two" class="wrapper style1 special">
        <div class="inner">
            <h1 class="fw-bold">SISTEM INFORMASI GEOGRAFIS </h1>
            <figure>
                <blockquote class="fs-5 text-white">
                    <b class="text-dark">
                        Sistem Informasi Geografis (SIG) Banjir Kabupaten Cilacap
                    </b>
                    dirancang untuk memantau dan memetakan kondisi banjir secara real-time dengan dukungan teknologi GeoMaps. Sistem ini memungkinkan pelaporan banjir yang sedang berlangsung, menyajikan data penanganan yang telah dilakukan, serta menampilkan rencana penanggulangan guna meminimalisir dampak bencana. Dengan integrasi data spasial melalui GeoMaps, informasi disajikan secara interaktif dan akurat untuk membantu pemerintah dan masyarakat dalam mengambil langkah cepat, tepat, dan terukur dalam menghadapi banjir.
                </blockquote>
            </figure>
        </div>
    </section>
    <!-- One -->
    <section id="one" class="wrapper">
        <div class="inner flex flex-3">
            <div class="flex-item left">
                <div>
                    <h3>Pemantauan langsung banjir yang sedang terjadi melalui visualisasi GeoMaps.</h3>
                    {{-- <p>
                    Morbi in sem quis dui plalorem ipsum<br />
                    euismod in, pharetra sed ultricies.
                    </p> --}}
                </div>
                <div>
                    <h3>Menyajikan informasi banjir secara interaktif melalui peta dan data terkini.</h3>
                    {{-- <p>
                    Tristique yonve cursus jam nulla quam<br />
                    loreipsu gravida adipiscing lorem
                    </p> --}}
                </div>
            </div>
            <div class="flex-item image fit round">
                <img src="{{ url('asset_landing/images/pic05.png') }}" alt="" width="330" height="350" />
            </div>
            <div class="flex-item right ">
                <div class="h-100 d-flex align-items-center align-middle">
                    <h3>Menampilkan data penanggulangan banjir yang sudah dilakukan dan yang masih direncanakan.</h3>
                </div>
                {{-- <div>
                    <h3>Suscipit nibh dolore</h3>
                    <p>
                    Pellentesque egestas sem. Suspendisse<br />
                    modo ullamcorper feugiat lorem.
                    </p>
                </div> --}}
            </div>
        </div>
    </section>
    <!-- Page Content-->
    <section id="peta">
        <div class="container">
            <!-- Heading Row-->
            <div class="row align-items-center my-5">
                <div class="col-lg-10">
                    <div id="map" class="col-lg-12 rounded" style="height: 600px;">
                    </div>
                </div>
                <div class="col-lg-2">
                    <h3>Filter Peta Banjir</h3>

                    <div class="filter-group mb-3">
                        <strong>Jenis Banjir:</strong><br>
                        <div class="form-check">
                            <input class="form-check-input icon-filter" type="checkbox" value="mdi mdi-map-marker" id="flood-normal" checked>
                            <label class="form-check-label" for="flood-normal">
                                Normal
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input icon-filter" type="checkbox" value="fa-solid fa-water" id="flood-water" checked>
                            <label class="form-check-label" for="flood-water">
                                Banjir
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input icon-filter" type="checkbox" value="fa-solid fa-house-flood-water" id="flood-flash" checked>
                            <label class="form-check-label" for="flood-flash">
                                Banjir Bandang
                            </label>
                        </div>
                    </div>

                    <div class="filter-group mb-3">
                        <strong>Zona:</strong><br>
                        <div class="form-check">
                            <input class="form-check-input color-filter" type="checkbox" value="green" id="zone-green" checked>
                            <label class="form-check-label" for="zone-green">
                                Hijau
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input color-filter" type="checkbox" value="yellow" id="zone-yellow" checked>
                            <label class="form-check-label" for="zone-yellow">
                                Kuning
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input color-filter" type="checkbox" value="red" id="zone-red" checked>
                            <label class="form-check-label" for="zone-red">
                                Merah
                            </label>
                        </div>
                    </div>

                        <div class="filter-group mb-3">
                            <strong>Rentang Waktu:</strong><br>
                            <div>
                                <label>Tanggal Awal
                                    <input type="text" id="waktu_mulai" class="form-control" value="{{ $now }}">
                                </label>
                            </div>
                            <div>
                                <label>Tanggal Akhir
                                    <input type="text" id="waktu_selesai" class="form-control" value="{{ $now }}">
                                </label>
                            </div>
                            {{-- <div>
                                <button class="btn btn-primary btn-sm mt-2" onclick="applyFilters()">Terapkan Filter</button>
                            </div> --}}
                        </div>
                </div>

                {{-- <div class="col-lg-5">
                    <h1 class="font-weight-light">Business Name or Tagline</h1>
                    <p>This is a template that is great for small businesses. It doesn't have too much fancy flare to it,
                        but it makes a great use of the standard Bootstrap core components. Feel free to use this template
                        for any project you want!</p>
                    <a class="btn btn-primary" href="#!">Call to Action!</a>
                </div> --}}
            </div>
            <!-- Call to Action-->
            {{-- <div class="card text-white bg-secondary my-5 py-4 text-center">
                <div class="card-body">
                    <p class="text-white m-0">This call to action card is a great place to showcase some important
                        information or display a clever tagline!</p>
                </div>
            </div> --}}
            <!-- Content Row-->
            {{-- <div class="row gx-4 gx-lg-5">
                <div class="col-md-4 mb-5">
                    <div class="card h-100">
                        <div class="card-body">
                            <h2 class="card-title">Card One</h2>
                            <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rem magni quas ex
                                numquam, maxime minus quam molestias corporis quod, ea minima accusamus.</p>
                        </div>
                        <div class="card-footer"><a class="btn btn-primary btn-sm" href="#!">More Info</a></div>
                    </div>
                </div>
                <div class="col-md-4 mb-5">
                    <div class="card h-100">
                        <div class="card-body">
                            <h2 class="card-title">Card Two</h2>
                            <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quod tenetur ex
                                natus at dolorem enim! Nesciunt pariatur voluptatem sunt quam eaque, vel, non in id dolore
                                voluptates quos eligendi labore.</p>
                        </div>
                        <div class="card-footer"><a class="btn btn-primary btn-sm" href="#!">More Info</a></div>
                    </div>
                </div>
                <div class="col-md-4 mb-5">
                    <div class="card h-100">
                        <div class="card-body">
                            <h2 class="card-title">Card Three</h2>
                            <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rem magni quas ex
                                numquam, maxime minus quam molestias corporis quod, ea minima accusamus.</p>
                        </div>
                        <div class="card-footer"><a class="btn btn-primary btn-sm" href="#!">More Info</a></div>
                    </div>
                </div>
            </div> --}}
        </div>
    </section>
    <!-- Footer-->
    <footer id="footer">
        <div class="inner">
            <h2>Sistem Informasi Geografis Kabupaten Cilacap</h2>
            <ul class="actions">
                <li>
                    <span class="icon fa-instagram"></span> <a class="text-white" target="_blank" href="https://www.instagram.com/hfsyptr_?igsh=MW5ibWI3OGx3d3gxOQ%3D%3D&utm_source=qr">Hafidh Syahputra</a>
                </li>
                <li>
                    <span class="icon fa-university"></span>
                    <a href="https://pnc.ac.id/" target="_blank" class="text-white">Politeknik Negeri Cilacap</a>
                </li>
                <li>
                    <span class="icon fa-map-marker text-white"></span> Cilacap Utara, Cilacap, Jawa Tengah
                </li>
            </ul>
        </div>
    </footer>
    <div class="copyright">
      Build by: <a href="https://www.instagram.com/hfsyptr_?igsh=MW5ibWI3OGx3d3gxOQ%3D%3D&utm_source=qr"
                    target="_blank">Hafidh Syahputra</a>.
    </div>

</div>

@push('scripts')

    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
        crossorigin=""></script>
    <script>
        // var map = L.map('map').setView([-7.6982991, 109.023521], 9);

        // // Tambahkan tile layer dari OpenStreetMap
        // L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        //     attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        // }).addTo(map);

        // // Data lokasi dengan koordinat, kategori, dan ikon
        // var locations = [
        //     { lat: -7.6982991, lng: 109.023521, name: "Lokasi 1", category: "air", radius: 500 },
        //     { lat: -7.699500, lng: 109.030000, name: "Lokasi 2", category: "tanah", radius: 700 },
        //     { lat: -7.705000, lng: 109.035000, name: "Lokasi 3", category: "air", radius: 400 },
        //     { lat: -7.710000, lng: 109.040000, name: "Lokasi 4", category: "tanah", radius: 800 }
        // ];

        // // Buat layer grup untuk kategori
        // var airLayer = L.layerGroup();
        // var tanahLayer = L.layerGroup();

        // // Loop melalui lokasi untuk menambahkan marker ke layer yang sesuai
        // locations.forEach(function(location) {
        //     var customIcon = L.divIcon({
        //         html: "<i class='fa-solid fa-water' style='font-size: 30px; color: #007bff;'></i>",
        //         iconSize: [30, 30],
        //         className: "custom-leaflet-icon"
        //     });

        //     var marker = L.marker([location.lat, location.lng], { icon: customIcon })
        //         .bindPopup(`<b>${location.name}</b><br>Kategori: ${location.category}`);

        //     // Tambahkan lingkaran radius berdasarkan data dari array
        //     var color = (location.category === "air") ? "blue" : "green";
        //     var circle = L.circle([location.lat, location.lng], {
        //         color: color,
        //         fillColor: color,
        //         fillOpacity: 0.2,
        //         radius: location.radius
        //     });

        //     // Tambahkan marker dan lingkaran ke dalam layer berdasarkan kategorinya
        //     if (location.category === "air") {
        //         marker.addTo(airLayer);
        //         circle.addTo(airLayer);
        //     } else if (location.category === "tanah") {
        //         marker.addTo(tanahLayer);
        //         circle.addTo(tanahLayer);
        //     }
        // });
        // // Tambahkan semua layer ke peta
        // airLayer.addTo(map);
        // tanahLayer.addTo(map);
        // var layerControl = L.control.layers(null, {
        //     "Sumber Air": airLayer,
        //     "Wilayah Tanah": tanahLayer
        // }, { collapsed: true });

        // layerControl.addTo(map);

        // var controlContainer = document.querySelector('.leaflet-control-layers');
        // controlContainer.style.opacity = '0';
        // controlContainer.style.transition = 'opacity 0.3s';

        // map.getContainer().addEventListener('mouseover', function() {
        //     controlContainer.style.opacity = '1';
        // });

        // map.getContainer().addEventListener('mouseout', function() {
        //     controlContainer.style.opacity = '0';
        // });
        const defaultLat = -7.712896;
        const defaultLng = 109.028118;
        const map = L.map('map').setView([defaultLat, defaultLng], 13);

        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        // var data = [
        //         // {
        //         //     start: "2025-05-04 08:00",
        //         //     end: "2025-05-04 4:00",
        //         //     jalan: "Jl. Sawo",
        //         //     nomor: "101",
        //         //     panjang: 120,
        //         //     tinggi: 40,
        //         //     lat: -7.712,
        //         //     lng: 109.027,
        //         //     icon: "mdi mdi-map-marker",
        //         //     radius: 200,
        //         //     color: "green"
        //         // },
        //     // {
        //     //     start: "2025-05-01T12:00",
        //     //     end: "2025-05-01T18:00",
        //     //     jalan: "Jl. Melati",
        //     //     nomor: "102",
        //     //     panjang: 100,
        //     //     tinggi: 80,
        //     //     lat: -7.713,
        //     //     lng: 109.029,
        //     //     icon: "fa-solid fa-water",
        //     //     radius: 300,
        //     //     color: "yellow"
        //     // },
        //     // {
        //     //     start: "2025-05-02T10:00",
        //     //     end: "2025-05-02T15:00",
        //     //     jalan: "Jl. Kenanga",
        //     //     nomor: "103",
        //     //     panjang: 80,
        //     //     tinggi: 60,
        //     //     lat: -7.714,
        //     //     lng: 109.03,
        //     //     icon: "fa-solid fa-house-flood-water",
        //     //     radius: 400,
        //     //     color: "red"
        //     // },
        //     // {
        //     //     start: "2025-05-02T16:00",
        //     //     end: "2025-05-02T20:00",
        //     //     jalan: "Jl. Mawar",
        //     //     nomor: "104",
        //     //     panjang: 90,
        //     //     tinggi: 30,
        //     //     lat: -7.715,
        //     //     lng: 109.026,
        //     //     icon: "fa-solid fa-water",
        //     //     radius: 250,
        //     //     color: "green"
        //     // },
        //     // {
        //     //     start: "2025-05-03T07:00",
        //     //     end: "2025-05-03T11:00",
        //     //     jalan: "Jl. Anggrek",
        //     //     nomor: "105",
        //     //     panjang: 110,
        //     //     tinggi: 70,
        //     //     lat: -7.716,
        //     //     lng: 109.025,
        //     //     icon: "mdi mdi-map-marker",
        //     //     radius: 220,
        //     //     color: "yellow"
        //     // }
        // ];
        var data = {!! json_encode($data->map(function($item) {
            return [
                'start' => \Carbon\Carbon::parse($item->waktu_mulai)->format('Y-m-d H:i'),
                'end' => \Carbon\Carbon::parse($item->waktu_selesai)->format('Y-m-d H:i'),
                'jalan' => $item->nama_jalan,
                'nomor' => $item->nomor_jalan,
                'panjang' => (float) $item->panjang_jalan,
                'tinggi' => $item->tinggi_banjir,
                'lat' => (float) $item->la_atitude,
                'lng' => (float) $item->long_atitude,
                'icon' => $item->icon,
                'radius' => (float) $item->radius,
                'color' => $item->warna_radius
            ];
        })) !!};

        // console.log(data);


        let markers = [];

        function renderMarkers(filtered) {
            // Hapus marker lama
            markers.forEach(m => map.removeLayer(m));
            markers = [];

            filtered.forEach(loc => {
                // console.log(loc.icon);
                let iconClass = loc.icon;
                if(loc.icon === 'mdi mdi-map-marker') {
                    iconClass  = 'fa-solid fa-location-dot';
                } else if (loc.icon === 'fa-solid fa-house-flood-water') {
                    iconClass  = 'fas fa-swimmer';
                }else if(loc.icon === 'fa-solid fa-water'){
                    iconClass  = 'fa-solid fa-water';
                }
                const icon = L.divIcon({
                    // html: `<i class='fa-solid fa-location-dot' style='font-size: 30px; color: ${loc.color}'></i>`,
                    html: `<i class="${iconClass}" style='font-size: 30px; color: ${loc.color}'></i>`,
                    iconSize: [30, 30],
                    className: ''
                });

                var kategori = loc.color === 'blue' ? 'Default' :
                                                    loc.color === 'green' ? 'Normal' :
                                                    loc.color === 'yellow' ? 'Waspada' :
                                                    loc.color === 'red' ? 'Bahaya' : 'Default';

                const marker = L.marker([loc.lat, loc.lng], { icon }).addTo(map)
                    .bindPopup(`
                        <b>${loc.jalan} No. ${loc.nomor}</b><br>
                        Mulai: ${loc.start.replace('T', ' ')}<br>
                        Selesai: ${loc.end.replace('T', ' ')}<br>
                        Panjang Jalan: ${loc.panjang} m<br>
                        Tinggi Banjir: ${loc.tinggi}<br>
                        Radius: ${loc.radius} m<br>
                        Kategori: ${kategori}
                    `);

                const circle = L.circle([loc.lat, loc.lng], {
                    radius: loc.radius,
                    color: loc.color,
                    fillColor: loc.color,
                    fillOpacity: 0.3
                }).addTo(map);

                markers.push(marker, circle);
            });
        }

        function applyFilters() {
            const selectedIcons = Array.from(document.querySelectorAll('.icon-filter:checked')).map(el => el.value);
            const selectedColors = Array.from(document.querySelectorAll('.color-filter:checked')).map(el => el.value);

            const start = document.getElementById('waktu_mulai').value;
            const end = document.getElementById('waktu_selesai').value;

            // Convert start and end to just the date part for comparison (YYYY-MM-DD)
            const startDate = start ? start.split("T")[0] : ''; // strip time part
            const endDate = end ? end.split("T")[0] : '';       // strip time part

            // Filter the data based on icons, colors, and date range
            // const filtered = data.filter(d => {
            //     // Extract date from start and end (YYYY-MM-DD) for comparison
            //     const dataStartDate = d.start.split(" ")[0];  // Get just the date part (YYYY-MM-DD)
            //     const dataEndDate = d.end.split(" ")[0];      // Get just the date part (YYYY-MM-DD)

            //     return selectedIcons.includes(d.icon) &&
            //         selectedColors.includes(d.color) &&
            //         (!startDate || dataStartDate >= startDate) && // Compare start date
            //         (!endDate || dataEndDate <= endDate);         // Compare end date
            // });
            const filtered = data.filter(d => {
                const dataStartDate = d.start.split(" ")[0];
                const dataEndDate = d.end.split(" ")[0];

                const iconMatch = selectedIcons.length === 0 || selectedIcons.includes(d.icon);
                const colorMatch = selectedColors.length === 0 || selectedColors.includes(d.color);
                const startMatch = !startDate || dataStartDate >= startDate;
                const endMatch = !endDate || dataEndDate <= endDate;

                return iconMatch && colorMatch && startMatch && endMatch;
            });

            renderMarkers(filtered);
        }

        applyFilters(); // load awal

        flatpickr("#waktu_mulai", {
            enableTime: true,
            time_24hr: true,
            dateFormat: "Y-m-d",
        });

        flatpickr("#waktu_selesai", {
            enableTime: true,
            time_24hr: true,
            dateFormat: "Y-m-d",
            minDate: document.getElementById('waktu_mulai').value, // ensures "end" is after "start"
        });

        // Add logic to update the end time picker dynamically based on the selected start time.
        document.getElementById('waktu_mulai').addEventListener('change', function() {
            const startTime = this.value;
            const endTimePicker = document.getElementById('waktu_selesai')._flatpickr;
            if (startTime) {
                endTimePicker.set('minDate', startTime); // Update the min date for the end time picker
            }
        });
        document.querySelectorAll('.icon-filter, .color-filter').forEach(el => {
            el.addEventListener('change', applyFilters);
        });

        document.getElementById('waktu_mulai').addEventListener('change', applyFilters);
        document.getElementById('waktu_selesai').addEventListener('change', applyFilters);
    </script>
@endpush
