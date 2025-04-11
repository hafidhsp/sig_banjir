<div>
     <!-- Modal User -->
    <div class="modal fade" id="modalUser"  tabindex="-1" aria-hidden="true" data-bs-backdrop="static" wire:ignore.self>
        <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title" id="staticBackdropLabel" style="font-size: 20px">Akun</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="forms-sample" wire:submit.prevent="ubah_akun">
                            @if (session('error'))
                                <div class="alert alert-warning" role="alert">
                                    {{ session('error') }}
                                </div>
                            @endif
                            @if (session('success'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('success') }}
                                </div>
                            @endif
                            <input type="text" class="form-control  @error('id') is-invalid @enderror" wire:model.defer="id" id="exampleInputUsername1" required hidden>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email</label>
                                <input type="email" class="form-control" wire:model.defer="email" readonly>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputUsername2">Nama Lengkap</label>
                                <input type="text" class="form-control  @error('nama_lengkap') is-invalid @enderror" wire:model.defer="nama_lengkap" id="exampleInputUsername2" placeholder="Nama Lengkap" required>
                                @error('nama_lengkap')
                                    <label class="text-danger">{{ $message }}</label>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Password</label>
                                <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" wire:model.defer="password">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputConfirmPassword1">Ulangi Password</label>
                                <input type="password" class="form-control" id="exampleInputConfirmPassword1" placeholder="Password" wire:model.defer="confirm_password">
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close" id="closeModal" wire:ignore>Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
        <!-- Modal Panduan -->
        <!-- Modal Panduan -->
    <div class="modal fade" id="modalPanduan" tabindex="-1" aria-hidden="true" data-bs-backdrop="static" >
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header" style="text-decoration: none !important;">
                    <h5 class="modal-title text-dark fw-bold" id="staticBackdropLabel" style="text-decoration: none !important;">Panduan Cara Memberikan Titik Lokasi <i class="mdi mdi-map-marker"></i></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body bg-secondary bg-gradient  bg-opacity-50">
                    <div class="section" id="carousel">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12 mr-auto ml-auto">

                                    <!-- Carousel Card -->
                                    <div class="card card-raised card-carousel">
                                        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" data-interval="3000">
                                            <ol class="carousel-indicators">
                                                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                                                <li data-target="#carouselExampleIndicators" data-slide-to="1" class=""></li>
                                                <li data-target="#carouselExampleIndicators" data-slide-to="2" class=""></li>
                                                <li data-target="#carouselExampleIndicators" data-slide-to="3" class=""></li>
                                                <li data-target="#carouselExampleIndicators" data-slide-to="4" class=""></li>
                                            </ol>
                                            <div class="carousel-inner">
                                                <div class="carousel-item active">
                                                    <img class="d-block w-100" src="{{ asset('images/panduan-1.png') }}"
                                                    alt="First slide">
                                                    <div class="carousel-caption d-none d-md-block">
                                                        <h4>
                                                            {{-- <i class="material-icons">location_on</i> --}}
                                                            Langkah 1
                                                        </h4>
                                                    </div>
                                                </div>
                                                <div class="carousel-item">
                                                    <img class="d-block w-100" src="{{ asset('images/panduan-2.png') }}"  alt="Second slide">
                                                    <div class="carousel-caption d-none d-md-block">
                                                        <h4>
                                                            {{-- <i class="material-icons">location_on</i> --}}
                                                            Langkah 2
                                                        </h4>
                                                    </div>
                                                </div>
                                                <div class="carousel-item">
                                                    <img class="d-block w-100" src="{{ asset('images/panduan-3.png') }}" alt="Third slide">
                                                    <div class="carousel-caption d-none d-md-block">
                                                        <h4>
                                                            {{-- <i class="material-icons">location_on</i> --}}
                                                            Langkah 3
                                                        </h4>
                                                    </div>
                                                </div>
                                                <div class="carousel-item">
                                                    <img class="d-block w-100" src="{{ asset('images/panduan-4.png') }}" alt="Forth slide">
                                                    <div class="carousel-caption d-none d-md-block">
                                                        <h4>
                                                            {{-- <i class="material-icons">location_on</i> --}}
                                                            Langkah 4
                                                        </h4>
                                                    </div>
                                                </div>
                                                <div class="carousel-item">
                                                    <img class="d-block w-100" src="{{ asset('images/panduan-5.png') }}" alt="Fifth slide">
                                                    <div class="carousel-caption d-none d-md-block">
                                                        <h4>
                                                            {{-- <i class="material-icons">location_on</i> --}}
                                                            Langkah 5
                                                        </h4>
                                                    </div>
                                                </div>
                                            </div>
                                            <a class="carousel-control-prev" style="text-decoration: none !important;" href="#carouselExampleIndicators" role="button" data-slide="prev">
                                                <i class="fa-solid fa-chevron-left" style="font-size: 2.5em"></i>
                                                <span class="sr-only">Previous</span>
                                            </a>
                                            <a class="carousel-control-next" style="text-decoration: none !important;" href="#carouselExampleIndicators" role="button" data-slide="next">
                                                <i class="fa-solid fa-chevron-right" style="font-size: 2.5em"></i>
                                                <span class="sr-only">Next</span>
                                            </a>
                                        </div>
                                    </div>
                                    <!-- End Carousel Card -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- <div class="modal fade" id="modalPanduan"  tabindex="-1" aria-hidden="true" data-bs-backdrop="static" wire:ignore.self>
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
        <div class="modal-header text-dark">
            <h1 class="modal-title" id="staticBackdropLabel" style="font-size: 20px">Panduan Memberikan Titik Lokasi</h1>
            <button type="button" class="btn-close opacity-100" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
            <div class="modal-body bg-secondary bg-gradient">
                <div id="scene">
                    <div id="left-zone">
                    <ul class="list">
                        <li class="item">
                        <input type="radio" id="radio_The garden strawberry (or simply strawberry /ˈstrɔːbᵊri/; Fragaria × ananassa) is a widely grown hybrid species of the genus Fragaria (collectively known as the strawberries)" name="basic_carousel" value="The garden strawberry (or simply strawberry /ˈstrɔːbᵊri/; Fragaria × ananassa) is a widely grown hybrid species of the genus Fragaria (collectively known as the strawberries)" checked="checked"/>
                        <label class="label_strawberry" for="radio_The garden strawberry (or simply strawberry /ˈstrɔːbᵊri/; Fragaria × ananassa) is a widely grown hybrid species of the genus Fragaria (collectively known as the strawberries)">strawberry</label>
                        <div class="content content_strawberry"><span class="picto"></span>
                            <h1>strawberry</h1>
                            <p>The garden strawberry (or simply strawberry /ˈstrɔːbᵊri/; Fragaria × ananassa) is a widely grown hybrid species of the genus Fragaria (collectively known as the strawberries)</p>
                        </div>
                        </li>
                        <li class="item">
                        <input type="radio" id="radio_A banana is an edible fruit, botanically a berry, produced by several kinds of large herbaceous flowering plants in the genus Musa." name="basic_carousel" value="A banana is an edible fruit, botanically a berry, produced by several kinds of large herbaceous flowering plants in the genus Musa."/>
                        <label class="label_banana" for="radio_A banana is an edible fruit, botanically a berry, produced by several kinds of large herbaceous flowering plants in the genus Musa.">banana</label>
                        <div class="content content_banana"><span class="picto"></span>
                            <h1>banana</h1>
                            <p>A banana is an edible fruit, botanically a berry, produced by several kinds of large herbaceous flowering plants in the genus Musa.</p>
                        </div>
                        </li>
                        <li class="item">
                        <input type="radio" id="radio_The apple tree (Malus domestica) is a deciduous tree in the rose family best known for its sweet, pomaceous fruit, the apple. It is cultivated worldwide as a fruit tree, and is the most widely grown species in the genus Malus." name="basic_carousel" value="The apple tree (Malus domestica) is a deciduous tree in the rose family best known for its sweet, pomaceous fruit, the apple. It is cultivated worldwide as a fruit tree, and is the most widely grown species in the genus Malus."/>
                        <label class="label_apple" for="radio_The apple tree (Malus domestica) is a deciduous tree in the rose family best known for its sweet, pomaceous fruit, the apple. It is cultivated worldwide as a fruit tree, and is the most widely grown species in the genus Malus.">apple</label>
                        <div class="content content_apple"><span class="picto"></span>
                            <h1>apple</h1>
                            <p>The apple tree (Malus domestica) is a deciduous tree in the rose family best known for its sweet, pomaceous fruit, the apple. It is cultivated worldwide as a fruit tree, and is the most widely grown species in the genus Malus.</p>
                        </div>
                        </li>
                        <li class="item">
                        <input type="radio" id="radio_The orange (specifically, the sweet orange) is the fruit of the citrus species Citrus × sinensis in the family Rutaceae." name="basic_carousel" value="The orange (specifically, the sweet orange) is the fruit of the citrus species Citrus × sinensis in the family Rutaceae."/>
                        <label class="label_orange" for="radio_The orange (specifically, the sweet orange) is the fruit of the citrus species Citrus × sinensis in the family Rutaceae.">orange</label>
                        <div class="content content_orange"><span class="picto"></span>
                            <h1>orange</h1>
                            <p>The orange (specifically, the sweet orange) is the fruit of the citrus species Citrus × sinensis in the family Rutaceae.</p>
                        </div>
                        </li>
                    </ul>
                    </div>
                    <div id="middle-border"></div>
                    <div id="right-zone"></div>
                </div>
            </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary opacity-100" data-bs-dismiss="modal" aria-label="Close" id="closeModal" wire:ignore>Tutup</button>
        </div>
        </div>
    </div>
    </div> --}}
    @push('scripts')
    <script>
        function openModalUser(){
             var modal = new bootstrap.Modal(document.getElementById('modalUser'));
             modal.show();
        }
        function openModalPanduan(){
             var modal = new bootstrap.Modal(document.getElementById('modalPanduan'));
             modal.show();
        }

        document.addEventListener('DOMContentLoaded', function() {
            window.addEventListener('open-notif-success-profil', function() {
            $('#nama_pengguna').load(window.location.href + ' #nama_pengguna');
            setTimeout(function () {
                $('#closeModal').click();
            }, 100);
            setTimeout(function () {
                    alertify.success('Berhasil Disimpan');
                }, 500);
            });
        });


    </script>
    @endpush

</div>
