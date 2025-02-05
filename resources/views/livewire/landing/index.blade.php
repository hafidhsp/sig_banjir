<div>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container px-5">
            <a class="navbar-brand" href="#!">Start Bootstrap</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span
                    class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link" aria-current="page" href="{{ url('/login') }}">Masuk /
                            Daftar</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Page Content-->
    <div class="container px-5 px-lg-6">
        <!-- Heading Row-->
        <div class="row gx-4 gx-lg-5 align-items-center my-5">
            <div id="map" class="col-lg-6 rounded" style="height: 300px;">
            </div>
                <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
                <script>
                 var map = L.map('map').setView([-7.6982991, 109.023521], 9);

                // Tambahkan tile layer dari OpenStreetMap
                L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                }).addTo(map);

                // Data lokasi dengan koordinat, kategori, dan ikon
                var locations = [
                    { lat: -7.6982991, lng: 109.023521, name: "Lokasi 1", category: "air", radius: 500 },
                    { lat: -7.699500, lng: 109.030000, name: "Lokasi 2", category: "tanah", radius: 700 },
                    { lat: -7.705000, lng: 109.035000, name: "Lokasi 3", category: "air", radius: 400 },
                    { lat: -7.710000, lng: 109.040000, name: "Lokasi 4", category: "tanah", radius: 800 }
                ];

                // Buat layer grup untuk kategori
                var airLayer = L.layerGroup();
                var tanahLayer = L.layerGroup();

                // Loop melalui lokasi untuk menambahkan marker ke layer yang sesuai
                locations.forEach(function(location) {
                    var customIcon = L.divIcon({
                        html: "<i class='fa-solid fa-water' style='font-size: 30px; color: #007bff;'></i>",
                        iconSize: [30, 30],
                        className: "custom-leaflet-icon"
                    });

                    var marker = L.marker([location.lat, location.lng], { icon: customIcon })
                        .bindPopup(`<b>${location.name}</b><br>Kategori: ${location.category}`);

                    // Tambahkan lingkaran radius berdasarkan data dari array
                    var color = (location.category === "air") ? "blue" : "green";
                    var circle = L.circle([location.lat, location.lng], {
                        color: color,
                        fillColor: color,
                        fillOpacity: 0.2,
                        radius: location.radius
                    });

                    // Tambahkan marker dan lingkaran ke dalam layer berdasarkan kategorinya
                    if (location.category === "air") {
                        marker.addTo(airLayer);
                        circle.addTo(airLayer);
                    } else if (location.category === "tanah") {
                        marker.addTo(tanahLayer);
                        circle.addTo(tanahLayer);
                    }
                });
                // Tambahkan semua layer ke peta
                airLayer.addTo(map);
                tanahLayer.addTo(map);
                var layerControl = L.control.layers(null, {
                    "Sumber Air": airLayer,
                    "Wilayah Tanah": tanahLayer
                }, { collapsed: true });

                layerControl.addTo(map);

                var controlContainer = document.querySelector('.leaflet-control-layers');
                controlContainer.style.opacity = '0';
                controlContainer.style.transition = 'opacity 0.3s';

                map.getContainer().addEventListener('mouseover', function() {
                    controlContainer.style.opacity = '1';
                });

                map.getContainer().addEventListener('mouseout', function() {
                    controlContainer.style.opacity = '0';
                });

                </script>
            <div class="col-lg-5">
                <h1 class="font-weight-light">Business Name or Tagline</h1>
                <p>This is a template that is great for small businesses. It doesn't have too much fancy flare to it,
                    but it makes a great use of the standard Bootstrap core components. Feel free to use this template
                    for any project you want!</p>
                <a class="btn btn-primary" href="#!">Call to Action!</a>
            </div>
        </div>
        <!-- Call to Action-->
        <div class="card text-white bg-secondary my-5 py-4 text-center">
            <div class="card-body">
                <p class="text-white m-0">This call to action card is a great place to showcase some important
                    information or display a clever tagline!</p>
            </div>
        </div>
        <!-- Content Row-->
        <div class="row gx-4 gx-lg-5">
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
        </div>
    </div>
    <!-- Footer-->
    <footer class="py-5 bg-dark">
        <div class="container px-4 px-lg-5">
            <p class="m-0 text-center text-white">Copyright &copy; Your Website 2023</p>
        </div>
    </footer>
</div>
