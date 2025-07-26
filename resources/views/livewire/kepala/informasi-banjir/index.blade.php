<div>
    <div class="content-wrapper">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-header row">
                    <div class="col-md-6">
                        <h2>Informasi Banjir</h2>
                        <p class="card-description">
                            Dashboard /<code>{{ $title }}</code>
                        </p>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive pt-3">
                        <table class="table table-bordered table-hover" id="table_daerah_banjir" wire:ignore.self>
                            <thead>
                                <tr>
                                    <th class="bg-info text-center align-middle">
                                        No.
                                    </th>
                                    <th class="bg-info text-left align-middle">
                                        Kecamatan
                                    </th>
                                    <th class="bg-info">
                                        Nama Pemberi Informasi
                                    </th>
                                    <th class="bg-info text-center">
                                        Tanggal
                                    </th>
                                    <th class="bg-info">
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data_daerah_banjir as $daerah_banjir)
                                    <tr>
                                        <td class="text-center clickable-cell"
                                            wire:click="detailJalanDaerahBanjir('{{ $daerah_banjir->id_jalan_daerah_banjir }}')">
                                            {{ $no++ }}
                                        </td>
                                        <td class="clickable-cell"
                                            wire:click="detailJalanDaerahBanjir('{{ $daerah_banjir->id_jalan_daerah_banjir }}')">
                                            {{ $daerah_banjir->nama_kecamatan }}
                                        </td>
                                        <td class="clickable-cell"
                                            wire:click="detailJalanDaerahBanjir('{{ $daerah_banjir->id_jalan_daerah_banjir }}')">
                                            {{ $daerah_banjir->pemberi_informasi }}
                                        </td>`
                                        <td class="clickable-cell text-center"
                                            wire:click="detailJalanDaerahBanjir('{{ $daerah_banjir->id_jalan_daerah_banjir }}')">
                                            {{ $daerah_banjir->tb_daerah_banjir . $daerah_banjir->created_at != '' ? $daerah_banjir->tb_daerah_banjir . $daerah_banjir->created_at->translatedFormat('d F Y') : '' }}
                                        </td>
                                        <td align="center">
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-outline-secondary " aria-expanded="false" wire:click="detailJalanDaerahBanjir('{{ $daerah_banjir->id_jalan_daerah_banjir }}')"><i
                                                        class="bi bi-list"></i> Detail</button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal Bukti Penanganan -->
    <div class="modal fade"  tabindex="-1" aria-hidden="true" id="modalBuktiPenanganan" data-bs-backdrop="static" data-bs-backdrop="static" wire:ignore.self>
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title" id="staticBackdropLabel" style="font-size: 20px"></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" wire:click="refresh_inputan()"></button>
                </div>
                <div class="modal-body bg-secondary bg-gradient  bg-opacity-50">
                    <div class="container">
                        <div class="row d-flex align-items-center">
                            <!-- Previous Button -->
                            <div class="col-auto">
                                <button class="btn btn-outline-dark" data-bs-target="#carouselExample1" data-bs-slide="prev">
                                    <i class="fa fa-chevron-left"></i>
                                </button>
                            </div>

                            <!-- Carousel Images -->
                            <div class="col text-center">
                                <div id="carouselExample1" class="carousel slide" data-bs-ride="carousel">
                                    <div class="carousel-inner">
                                        @if (empty($buktiGambar))
                                        <div class="carousel-item active">
                                            <span>Tidak ada foto pada data ini.</span>
                                        </div>
                                        @else
                                        @php
                                            $no_gbr=1
                                        @endphp
                                            @foreach ($buktiGambar as $bukti)
                                                    <div class="carousel-item {{ ($no_gbr==1)?'active':'' }}">
                                                        <a href="{{ asset('storage/penanganan/'.$bukti) }}" data-lightbox="bukti-penanganan">
                                                            <img src="{{ asset('storage/penanganan/'.$bukti) }}" class="d-block mx-auto w-50 shadow-lg" alt="Bukti {{ $no_gbr }}">
                                                        </a>
                                                    </div>
                                                    @php $no_gbr++; @endphp
                                            @endforeach
                                        @endif
                                        <!-- Add more carousel items here -->
                                    </div>
                                </div>
                            </div>

                            <!-- Next Button -->
                            <div class="col-auto">
                                <button class="btn btn-outline-dark" data-bs-target="#carouselExample1" data-bs-slide="next">
                                    <i class="fa fa-chevron-right"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close" id="btn_close_bukti" wire:click="refresh_inputan()">Tutup</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Offcanvas -->
    <div class="offcanvas offcanvas-end h-100 w-auto" tabindex="-1" id="CanvasDetailBanjir"
        aria-labelledby="offcanvasRightLabel" aria-hidden="true" data-bs-backdrop="static" wire:ignore.self>
        <div class="offcanvas-header">
            <div class="d-flex justify-content-between">
                <div class="align-items-start">
                    <button type="button" id="button_detail_canvas" class="btn-close-custom-start text-reset"
                        data-bs-dismiss="offcanvas" aria-label="Close" wire:click="refresh_inputan()">
                        <i class="bi bi-arrow-right"></i>
                    </button>
                </div>
                <div>
                    <h3 id="offcanvasRightLabel"><b>Detail Laporan</b></h3>
                    <small class="text-muted fst-italic">{{ $detailWaktu ?? '-' }}</small>
                </div>
            </div>
        </div>
        <div class="offcanvas-body">
            <p>
            <table>
                <tr>
                    <td class="fw-bold">Kecamatan</td>
                    <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                    <td>
                        <span style="font-size: 0.9em">
                            {{ !empty($detailNamaKecamatan) ? $detailNamaKecamatan : '-' }}
                        </span>
                    </td>
                </tr>
                <tr>
                    <td class="fw-bold">Pemberi Informasi</td>
                    <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                    <td>
                        <span style="font-size: 0.9em">
                            {{ !empty($detailPemberiInformasi) ? $detailPemberiInformasi : '-' }}
                        </span>
                    </td>
                </tr>
            </table>
            </p>
            <button type="button" class="btn btn-outline-success btn-icon-text mt-3 mr-3"
                wire:click="showDetailLokasiMapsAll({{ $data_jalan_daerah_banjir[0]->id_jalan_daerah_banjir ?? null }})">
                <i class="mdi mdi-map-marker-multiple"></i>
                Lokasi
            </button>
            <p>
            <div class="table-responsive pt-3">
                <table class="table table-bordered table-hover" id="table_detail_daerah_banjir" wire:ignore.self>
                    <thead>
                        <tr>
                            <th class="bg-info text-center align-middle">
                                No.
                            </th>
                            <th class="bg-info text-left align-middle">
                                Jalan
                            </th>
                            <th class="bg-info">
                                Tinggi Banjir
                            </th>
                            <th class="bg-info">
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no_1 = 1;
                        @endphp

                        @if (empty($data_jalan_daerah_banjir))
                            <tr>
                                <td colspan="4" class="text-center text-muted">Data tidak ada</td>
                                <td class="d-none"></td>
                                <td class="d-none"></td>
                                <td class="d-none"></td>
                            </tr>
                        @else
                            @foreach ($data_jalan_daerah_banjir as $jalan_banjir)
                                <tr>
                                    <td class="text-center clickable-cell"
                                        wire:click="detailJalanDaerahBanjir({{ $jalan_banjir->id_jalan_daerah_banjir }})">
                                        {{ $no_1 }}
                                    </td>
                                    <td class="clickable-cell"
                                        wire:click="detailJalanDaerahBanjir({{ $jalan_banjir->id_jalan_daerah_banjir }})">
                                        {{ $jalan_banjir->nama_jalan }}
                                    </td>
                                    <td class="clickable-cell"
                                        wire:click="detailJalanDaerahBanjir({{ $jalan_banjir->id_jalan_daerah_banjir }})">
                                        {{ $jalan_banjir->tinggi_banjir }}
                                    </td>
                                    <td align="center">
                                        <div class="btn-group">
                                            <button type="button"
                                                class="btn  {{ $jalan_banjir->konfirmasi_st == 1 ? ' btn-outline-success' : ' btn-outline-danger' }} btn-icon-text"
                                                wire:click="showKonfirmasiJalanDaerahBanjir({{ $jalan_banjir->id_jalan_daerah_banjir }})">
                                                <i
                                                    class="mdi  {{ $jalan_banjir->konfirmasi_st == 1 ? 'mdi-check-circle-outline' : 'mdi-close-circle-outline' }}"></i>
                                                {{ $jalan_banjir->konfirmasi_st == 1 ? 'Terkonfirmasi' : 'Belum Terkonfirmasi' }}
                                            </button>
                                        </div>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-outline-secondary " aria-expanded="false" wire:click="showKonfirmasiJalanDaerahBanjir({{ $jalan_banjir->id_jalan_daerah_banjir }})">
                                                <i class="bi bi-list"></i> Detail
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @php
                                    $no_1++;
                                @endphp
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
            </p>
        </div>
    </div>

    <!-- Offcanvas FORM -->
    <div class="offcanvas offcanvas-start h-100 w-50" tabindex="-1" id="canvasFormLaporanJalanBanjir"
        aria-labelledby="offcanvasRightLabel" wire:ignore.self>
        <div class="offcanvas-header">
            <div>
                <h3 id="offcanvasRightLabel"><b>{{ $title_modal }} Detail Laporan</b></h3>
            </div>
            <div class="d-flex">
                <div class="align-items-end">
                    <button type="button" class="btn-close-custom text-reset" data-bs-dismiss="offcanvas"
                        aria-label="Close" id="formCanvasJalanBanjir" wire:click='refresh_canvas(false)'>
                        <i class="bi bi-arrow-left"></i>
                    </button>
                </div>
            </div>
        </div>
        <div class="offcanvas-body">
            <p>
            <form wire:submit.prevent="save_jalan_daerah_banjir" enctype="multipart/form-data">
                {{-- @if ($errors->any())
                        <div class="alert alert-warning" role="alert">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif --}}
                <div class="mb-3 form-group">
                    <label class="form-label fw-bold">Nama Jalan</label>
                    <input type="text" class="d-none" wire:model.defer="id_jalan_daerah_banjir_jalan" hidden>
                    <input type="text" class="form-control @error('nama_jalan') is-invalid @enderror"
                        wire:model.defer="nama_jalan" placeholder="Masukkan Nama Jalan" required>
                    @error('nama_jalan')
                        <label class="text-danger">{{ $message }}</label>
                    @enderror
                </div>
                <div class="mb-3 form-group row">
                    <div class="col-6">
                        <label class="form-label fw-bold">Nomor Jalan</label>
                        <input type="text" class="form-control  @error('nomor_jalan') is-invalid @enderror"
                            wire:model.defer="nomor_jalan" placeholder="Masukkan Nomor">
                        @error('nomor_jalan')
                            <label class="text-danger">{{ $message }}</label>
                        @enderror
                    </div>
                    <div class="col-6">
                        <label class="form-label fw-bold">Panjang Jalan</label>
                        <input type="text" class="form-control @error('panjang_jalan') is-invalid @enderror"
                            wire:model.defer="panjang_jalan" placeholder="Masukkan Panjang Jalan">
                        @error('panjang_jalan')
                            <label class="text-danger">{{ $message }}</label>
                        @enderror
                    </div>
                </div>
                <div class="mb-3 form-group row">
                    <div class="col-6">
                        <label class="form-label fw-bold">Waktu Mulai</label>
                        <input type="text" class="form-control @error('waktu_mulai') is-invalid @enderror" id="waktu_mulai"
                            wire:model.defer="waktu_mulai" placeholder="Pilih Waktu" required>
                        @error('waktu_mulai')
                            <label class="text-danger">{{ $message }}</label>
                        @enderror
                    </div>
                    <div class="col-6">
                        <label class="form-label fw-bold">Waktu Selesai</label>
                        <input type="text" class="form-control @error('waktu_selesai') is-invalid @enderror" id="waktu_selesai"
                            wire:model.defer="waktu_selesai" placeholder="Pilih Waktu">
                        @error('waktu_selesai')
                            <label class="text-danger">{{ $message }}</label>
                        @enderror
                    </div>
                </div>
                <div class="mb-3 form-group row">
                    <div class="col-6">
                        <div class="form-group">
                            <label class="form-label fw-bold">Latitude</label>
                            <input type="text" class="form-control @error('la_atitude') is-invalid @enderror"
                                wire:model.defer="la_atitude" placeholder="Masukkan Latitude" required>
                            @error('la_atitude')
                                <label class="text-danger">{{ $message }}</label>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label class="form-label fw-bold">Longatitude</label>
                            <input type="text" class="form-control @error('long_atitude') is-invalid @enderror"
                                wire:model.defer="long_atitude" placeholder="Masukkan Longtitude" required>
                            @error('long_atitude')
                                <label class="text-danger">{{ $message }}</label>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="mb-3 form-group row">
                    <div class="col-6">
                        <label class="form-label fw-bold">Radius</label>
                        <div class="row">
                            <div class="col-md-10 col-lg-10">
                                <input type="text" class="form-control @error('radius') is-invalid @enderror"
                                    wire:model.defer="radius" placeholder="Masukkan Radius" required>
                            </div>
                            <div class="col-md-2 col-lg-2 align-items-center align-middle d-flex">
                                Meter
                            </div>
                        </div>
                        @error('radius')
                            <label class="text-danger">{{ $message }}</label>
                        @enderror
                    </div>
                    <div class="col-6">
                        <label class="form-label fw-bold">Jenis Banjir</label>
                        <div class="d-flex flex-wrap gap-3 p-3 border rounded">
                            <label class="icon-option">
                                <input type="radio" wire:model.defer="icon" value="mdi mdi-map-marker" required>
                                <i class="mdi mdi-map-marker"></i> Normal
                            </label>

                            <label class="icon-option">
                                <input type="radio" wire:model.defer="icon" value="fa-solid fa-water" required>
                                <i class="fa-solid fa-water"></i> Banjir
                            </label>
                            <label class="icon-option">
                                <input type="radio" wire:model.defer="icon" value="fa-solid fa-house-flood-water"
                                    required>
                                <i class="fa-solid fa-house-flood-water"></i> Banjir Bandang
                            </label>
                        </div>
                        @error('icon')
                            <label class="text-danger">{{ $message }}</label>
                        @enderror
                    </div>
                </div>
                <div class="mb-3 form-group">
                </div>
                {{-- <div class="mb-3 form-group">
                        <label class="form-label fw-bold">Jenis Banjir</label>
                        <input type="text" class="form-control  @error('jenis_banjir') is-invalid @enderror" wire:model.defer="jenis_banjir" placeholder="Pilih Tingkat Banjir">
                        @error('jenis_banjir')
                            <label class="text-danger">{{ $message }}</label>
                        @enderror
                    </div> --}}
                <div class="mb-3 form-group row">
                    <div class="col-6">
                        <div class="mb-3 form-group">
                            <label class="form-label fw-bold">Tinggi Banjir</label>
                            <input type="text" class="form-control  @error('tinggi_banjir') is-invalid @enderror"
                                wire:model.defer="tinggi_banjir" placeholder="Masukkan Tinggi Banjir">
                            @error('tinggi_banjir')
                                <label class="text-danger">{{ $message }}</label>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label>Warna Radius</label>
                            <select class="form-control @error('warna_radius') is-invalid @enderror"
                                id="exampleFormControlSelect2" wire:model.defer="warna_radius"
                                onchange="changeBackgroundColor(this)" oninput="filterLettersOnly(this)" required>
                                <option value="" class="bg-white text-dark" selected>-- Pilih --</option>
                                <option value="blue" class="bg-primary text-white">Default</option>
                                <option value="green" class="bg-success text-white">Normal</option>
                                <option value="yellow" class="bg-warning text-white">Waspada</option>
                                <option value="red" class="bg-danger text-white">Bahaya</option>
                            </select>
                            @error('warna_radius')
                                <label class="text-danger">{{ $message }}</label>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="mb-3 form-group">
                    <label class="fw-bold">Bukti Foto</label>
                    <input type="file" class="file-upload-default @error('bukti_foto.*') is-invalid @enderror"
                        wire:model="bukti_foto" multiple hidden id="bukti_foto_input">
                    <div class="input-group">
                        <input type="text"
                            class="form-control file-upload-info @error('bukti_foto.*') is-invalid @enderror" disabled
                            placeholder="Pilih Gambar" wire:model.defer="bukti_foto_info">
                        <span class="input-group-append">
                            <button class="file-upload-browse btn btn-primary" type="button"
                                onclick="document.getElementById('bukti_foto_input').click()">
                                <span wire:loading wire:target="bukti_foto">Mengunggah...</span>
                                <span wire:loading.remove wire:target="bukti_foto">Unggah</span>
                            </button>
                        </span>
                    </div>
                    @error('bukti_foto.*')
                        <label class="text-danger">{{ $message }}</label>
                    @enderror
                </div>

                <div class="form-group align-items-center">
                    <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                        <span wire:loading wire:target="save_jalan_daerah_banjir">Menyimpan data...</span>
                        <span wire:loading.remove wire:target="save_jalan_daerah_banjir">Simpan</span>
                    </button>
                </div>
            </form>
            </p>
        </div>
    </div>

    <!-- Offcanvas Detail -->
    <div class="offcanvas offcanvas-start h-100 w-75" tabindex="-1" id="canvasDetailLaporanJalanBanjir"
        aria-labelledby="offcanvasRightLabel" wire:ignore.self>
        <div class="offcanvas-header">
            <div>
                <h3 id="offcanvasRightLabel"><b>Detail Laporan Banjir</b></h3>
                {{-- <h3 id="head_1"><b>{{ $baseLatitude }},{{ $baseLongtitude }}</b></h3> --}}
                    <small class="text-muted fst-italic">{{ $detailWaktu ?? '-' }}</small>
            </div>
            <div class="d-flex">
                <div class="align-items-end">
                    <button type="button" class="btn-close-custom text-reset" data-bs-dismiss="offcanvas"
                        aria-label="Close" id="DetailCanvasJalanBanjir" wire:click='refresh_canvas(false)'>
                        <i class="bi bi-arrow-left"></i>
                    </button>
                </div>
            </div>
        </div>
        <div class="offcanvas-body position-relative  offcanvas-scroll">
            <p class="mb-3">
                <table id="p_1">
                    <tr>
                        <td class="fw-bold">Detail Jalan</td>
                        <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                        <td>
                            <span style="font-size: 0.9em">
                                Jl. {{ $label_nama_jalan ?? '-' }}, No. {{ $label_nomor_jalan ?? '-' }}
                            </span>
                        </td>
                        <td width="30px"></td>
                        <td class="fw-bold">Panjang Jalan</td>
                        <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                        <td>
                            <span style="font-size: 0.9em">
                                {{ $label_panjang_jalan ?? '-' }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td class="fw-bold">Waktu Banjir</td>
                        <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                        <td>
                            <span style="font-size: 0.9em">
                                {{ $label_waktu_mulai ?? '-' }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td class="fw-bold">Jenis Banjir</td>
                        <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                        <td>
                            <span style="font-size: 0.9em">
                                {{ $label_jenis_banjir ?? '-' }}
                            </span>
                        </td>
                        <td></td>
                        <td class="fw-bold">Tinggi Banjir</td>
                        <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                        <td>
                            <span style="font-size: 0.9em">
                                {{ $label_tinggi_banjir ?? '-' }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td class="fw-bold align-top">
                            Catatan
                        </td>
                        <td class="align-top">&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                        <td colspan="3" width="80%">
                            <form wire:submit.prevent="save_catatan_jalan_daerah_banjir" class="w-100">
                                <input type="text" hidden wire:model.defer="id_jalan_daerah_banjir">
                                <textarea class="form-control w-100 @error('jalan_daerah_banjir_catatan_kepala') is-invalid @enderror" wire:model.defer="jalan_daerah_banjir_catatan_kepala" rows="5">
                                </textarea>
                                @error('jalan_daerah_banjir_catatan_kepala')
                                    <label class="text-danger">{{ $message }}</label>
                                @enderror
                                <div style="text-align:right !important;">
                                    <button class="btn btn-success my-3">
                                        <i class="bi bi-floppy"></i>
                                        Simpan
                                    </button>
                                </div>
                            </form>
                        </td>
                    </tr>
                </table>
            </p>
            <p>

            </p>
            <p class="mt-4">
            <div class="position-absolute start-50 translate-middle-x w-100 h-auto">
                <div id="btn-display" class="text-end">
                    <div class="btn-group mt-4" role="group" aria-label="Basic example">
                        <button type="button" class="btn btn-secondary-custom" id="btn_penanganan"
                            onclick="display_jalan_banjir('2')">
                            <i class="bi bi-exclamation-triangle-fill"></i>
                        </button>
                        <button type="button" class="btn btn-secondary-custom active" id="btn_map"
                            onclick="display_jalan_banjir('1')">
                            <i class="mdi mdi-map"></i>
                        </button>
                        <button type="button" class="btn btn-secondary-custom" id="btn_carousel"
                            onclick="display_jalan_banjir('0')">
                            <i class="mdi mdi-camera-front"></i>
                        </button>
                    </div>
                </div>

                <div class="bg-secondary bg-gradient bg-opacity-50 p-3 w-100 mx-auto" id="section_gambar_lokasi">
                    <div class="">
                        <div id="sec-1" class="container d-none">
                            <div class="row d-flex align-items-center">
                                <!-- Tombol Previous -->
                                <div class="col-auto">
                                    <button class="btn btn-outline-dark" data-bs-target="#carouselExample"
                                        data-bs-slide="prev">
                                        <i class="fa fa-chevron-left"></i>
                                    </button>
                                </div>

                                <!-- Carousel Gambar -->
                                <div class="col text-center">
                                    <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
                                        <div class="carousel-inner">
                                            @if (empty($buktiFoto))
                                                <div class="carousel-item active">
                                                    <span>Tidak ada foto pada data ini.</span>
                                                </div>
                                            @else
                                                @php $no_gbr=1 @endphp
                                                @foreach ($buktiFoto as $bukti)
                                                    <div class="carousel-item {{ $no_gbr == 1 ? 'active' : '' }}">
                                                        <a href="{{ asset('storage/jalanbanjir/' . $bukti) }}"
                                                            data-lightbox="bukti-jalan_daerah_banjir">
                                                            <img src="{{ asset('storage/jalanbanjir/' . $bukti) }}"
                                                                class="d-block mx-auto w-50 shadow-lg"
                                                                alt="Bukti {{ $no_gbr }}">
                                                        </a>
                                                        {{-- <br>
                                                        <button class="btn btn-danger" type="button"
                                                            wire:click="show_delete_bukti_jalan_daerah_banjir({{ "'" . $idbuktiFoto . "'" . ',' . "'" . $bukti . "'" }})">
                                                            <i class="fa fa-trash"></i>
                                                        </button> --}}
                                                    </div>
                                                    @php $no_gbr++; @endphp
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <!-- Tombol Next -->
                                <div class="col-auto">
                                    <button class="btn btn-outline-dark" data-bs-target="#carouselExample"
                                        data-bs-slide="next">
                                        <i class="fa fa-chevron-right"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div id="sec-2">
                            {{-- <select id="categoryFilter">
                                    <option value="all">Semua</option>
                                    <option value="air">Sumber Air</option>
                                    <option value="tanah">Wilayah Tanah</option>
                                </select> --}}
                            <div class="col-md-12">
                                <div id="map" wire:ignore></div>
                            </div>
                        </div>
                        <div id="sec-3" class="d-none">
                            <table class="table table-bordered table-hover" id="table_penanganan"
                                wire:ignore.self>
                                <thead>
                                    <tr>
                                        <th class="bg-info text-center align-middle">
                                            No.
                                        </th>
                                        <th class="bg-info text-left align-middle">
                                            Penanganan
                                        </th>
                                        <th class="bg-info text-center">
                                            Waktu
                                        </th>
                                        <th class="bg-info text-center">
                                            Status
                                        </th>
                                        <th class="bg-info">
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (empty($data_penanganan))
                                        <tr>
                                            <td colspan="5" class="text-center text-muted">Data tidak ada</td>
                                            <td class="d-none"></td>
                                            <td class="d-none"></td>
                                            <td class="d-none"></td>
                                            <td class="d-none"></td>
                                        </tr>
                                    @else
                                    @php
                                        $no_penanganan = 1;
                                    @endphp
                                        @foreach ($data_penanganan as $item)
                                            <tr>
                                                <td class="text-center text-muted">{{ $no_penanganan++ }}</td>
                                                <td class="text-left">{{ $item->nama_penanganan }}</td>
                                                <td class="text-center">{{ $item->waktu_mulai->translatedFormat('d F Y H:i:s').(!empty($item->waktu_selesai)?' - '.$item->waktu_selesai->translatedFormat('d F Y H:i:s'):'') }}</td>
                                                <td class="text-center">
                                                    <button type="button"
                                                    {{-- wire:click="ShowValidationStatusPenanganan({{ $item->id_penanganan }})"  --}}
                                                    class="btn btn-sm @if($item->status_penanganan === 1) btn-primary @elseif($item->status_penanganan === 2) btn-success @else btn-secondary @endif
                                                        " readonly>
                                                        @if ($item->status_penanganan === 1)
                                                            Proses
                                                        @elseif($item->status_penanganan === 2)
                                                            Selesai
                                                        @else
                                                            Terencana
                                                        @endif
                                                    </button>
                                                </td>
                                                <td class="text-center">
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-outline-secondary dropdown-toggle"
                                                            data-toggle="dropdown" aria-expanded="false">
                                                            <i class="bi bi-hand-index-thumb"></i> Aksi
                                                        </button>
                                                        <div class="dropdown-menu" x-placement="top-start">
                                                            {{-- <button type="button" class="dropdown-item text-danger"
                                                                wire:click="show_delete_penanganan({{ $item->id_penanganan }})">
                                                                <i class="bi bi-trash3"></i> Hapus
                                                            </button>
                                                            <button type="button" class="dropdown-item text-primary"
                                                                wire:click="showFormEditPenanganan({{ $item->id_penanganan }})">
                                                                <i class="bi bi-pencil-square"></i> Ubah
                                                            </button> --}}
                                                            <button type="button" class="dropdown-item text-info" wire:click="showModalBuktiPenanganan({{ $item->id_penanganan }})">
                                                                <i class="bi bi-camera"></i> Lihat Bukti
                                                            </button>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>

                            </table>
                            {{-- <div class="col text-end">
                                <button type="button" class="btn btn-primary btn-icon-text mt-3"
                                    onclick="showModalPenanganan()">
                                    <i class="mdi mdi-table-row-plus-before"></i>
                                    Tambah Penanganan
                                </button>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
            </p>
        </div>
    </div>
    <!-- Offcanvas Maps -->
    <div class="offcanvas offcanvas-start h-100 w-50" tabindex="-1" id="canvasDetailLaporanJalanBanjirMaps"
        aria-labelledby="offcanvasRightLabel" wire:ignore.self>
        <div class="offcanvas-header">
            <div>
                {{-- <h3 id="offcanvasRightLabel"><b>Detail Laporan</b></h3>
                <h3 id="offcanvasRightLabel"><b>{{ $baseLatitude }},{{ $baseLongtitude }}</b></h3> --}}
            </div>
            <div class="d-flex">
                <div class="align-items-end">
                    <button type="button" class="btn-close-custom text-reset" data-bs-dismiss="offcanvas"
                        aria-label="Close" id="DetailCanvasJalanBanjir" wire:click='refresh_canvas(false)'>
                        <i class="bi bi-arrow-left"></i>
                    </button>
                </div>
            </div>
        </div>
        <div class="offcanvas-body position-relative  offcanvas-scroll">
            <p class="mt-2">
                <!-- Wrapper untuk memastikan posisi elemen tepat -->
            <div class="position-absolute start-50 translate-middle-x w-100 h-auto">

                <div class="bg-secondary bg-gradient bg-opacity-50 p-3 w-100 h-100 mx-auto"
                    id="section_gambar_lokasi">
                    <div class="">
                        <div id="sec-2">
                            <select class="d-none" id="categoryFilter">
                                <option value="all">Semua</option>
                                <option value="air">Sumber Air</option>
                                <option value="tanah">Wilayah Tanah</option>
                            </select>
                            <div class="col-md-12">
                                <div id="map_all"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </p>
        </div>
    </div>

</div>

@push('scripts')
<script>

    var offcanvasElement = document.getElementById('CanvasDetailBanjir');
    var offcanvas = new bootstrap.Offcanvas(offcanvasElement, {
        backdrop: 'static',
        keyboard: false
    });
    var offcanvasElement2 = document.getElementById('canvasFormLaporanJalanBanjir');
    var offcanvas2 = new bootstrap.Offcanvas(offcanvasElement2, {
        backdrop: 'true',
        keyboard: false
    });
    var offcanvasElement3 = document.getElementById('canvasDetailLaporanJalanBanjir');
    var offcanvas3 = new bootstrap.Offcanvas(offcanvasElement3, {
        backdrop: 'true',
        keyboard: false
    });
    var offcanvasElement4 = document.getElementById('canvasDetailLaporanJalanBanjirMaps');
    var offcanvas4 = new bootstrap.Offcanvas(offcanvasElement4, {
        backdrop: 'true',
        keyboard: false
    });
    const button = document.getElementById('button_detail_canvas');

    document.getElementById("categoryFilter").addEventListener("change", function() {
        var selectedCategory = this.value;
        updateMap(locations, selectedCategory); // Panggil function untuk update layer
    });

    function changeBackgroundColor(select) {
        select.classList.remove('bg-white', 'bg-primary', 'bg-success', 'bg-warning', 'bg-danger', 'text-dark',
            'text-white');

        if (select.value == '') {
            select.classList.remove('bg-primary', 'text-white');
            select.classList.remove('bg-success', 'text-white');
            select.classList.remove('bg-warning', 'text-white');
            select.classList.remove('bg-danger', 'text-white');
            select.classList.add('bg-white', 'text-dark');
        } else if (select.value == 'green') {
            select.classList.add('bg-success', 'text-white');
        } else if (select.value == 'yellow') {
            select.classList.add('bg-warning', 'text-white');
        } else if (select.value == 'red') {
            select.classList.add('bg-danger', 'text-white');
        } else if (select.value == 'blue') {
            select.classList.add('bg-primary', 'text-white');
        }
    }
    function changeBgColorStatusPenanganan(select) {
        select.classList.remove('bg-primary', 'bg-success', 'bg-secondary', 'text-white');

        if (select.value == '') {
            select.classList.remove('bg-primary', 'text-white');
            select.classList.remove('bg-success', 'text-white');
            select.classList.remove('bg-secondary', 'text-white');
        } else if (select.value == 2) {
            select.classList.add('bg-success', 'text-white');
        } else if (select.value == 1) {
            select.classList.add('bg-primary', 'text-white');
        } else if (select.value == 0) {
            select.classList.add('bg-secondary', 'text-white');
        }
    }

    function display_jalan_banjir(value) {
        const carousel = document.getElementById("sec-1");
        const map = document.getElementById("sec-2");
        const penanganan = document.getElementById("sec-3");
        const btn_carousel = document.getElementById("btn_carousel");
        const btn_map = document.getElementById("btn_map");
        const btn_penganan = document.getElementById("btn_penganan");
        map.classList.add("d-none");
        carousel.classList.add("d-none");
        penanganan.classList.add("d-none");
        btn_map.classList.remove("active");
        btn_carousel.classList.remove("active");
        btn_penanganan.classList.remove("active");
        if (value === "1") {
            map.classList.remove("d-none");
            btn_map.classList.add("active");
        } else if (value === "2") {
            penanganan.classList.remove("d-none");
            btn_penanganan.classList.add("active");
        } else {
            carousel.classList.remove("d-none");
            btn_carousel.classList.add("active");
        }
    }


    document.addEventListener('DOMContentLoaded', function() {
        initializeDataTable('#table_daerah_banjir');
        initializeDataTable('#table_detail_daerah_banjir');

        // Rendering
        window.addEventListener('render-table', function() {
            setTimeout(function() {
                destroyDataTable('#table_daerah_banjir');
                initializeDataTable('#table_daerah_banjir');
                destroyDataTable('#table_detail_daerah_banjir');
                initializeDataTable('#table_detail_daerah_banjir');
                offcanvas.hide();
                offcanvas2.hide();
                $('#table_daerah_banjir').load(window.location.href + ' #table_daerah_banjir');
                $('#table_detail_daerah_banjir').load(window.location.href +
                    ' #table_detail_daerah_banjir');
                //    updateMap(locations, "all");
            }, 100);
        });
        window.addEventListener('render-canvas', function() {
            setTimeout(function() {
                offcanvas.hide();
                offcanvas2.hide();
                offcanvas4.hide();
                $('#modalFormPenanganan').modal('hide');

            }, 100);
            setTimeout(function() {
                offcanvas.show();
                offcanvas2.show();
            }, 300);
        });
        window.addEventListener('render-canvas-utama', function() {
            setTimeout(function() {
                offcanvas.hide();
                offcanvas2.hide();
                offcanvas3.hide();
                offcanvas4.hide();
            }, 100);
            setTimeout(function() {
                destroyDataTable('#table_daerah_banjir');
                initializeDataTable('#table_daerah_banjir');
                $('#table_daerah_banjir').load(window.location.href + ' #table_daerah_banjir');
                offcanvas.show();
            }, 300);
        });
        window.addEventListener('render-canvas-form', function() {
            setTimeout(function() {
                offcanvas2.hide();
                offcanvas3.hide();
                offcanvas4.hide();
            }, 100);
            setTimeout(function() {
                offcanvas2.show();
            }, 300);
        });
        window.addEventListener('render-canvas-detail-jalan-daerah-banjir', function() {
            setTimeout(function() {
                offcanvas2.hide();
                offcanvas3.hide();
                offcanvas4.hide();

            }, 100);
            setTimeout(function() {
                offcanvas3.show();
            }, 300);
        });
        window.addEventListener('hide-canvas-all', function() {
            setTimeout(function() {
                offcanvas.hide();
                offcanvas2.hide();
                offcanvas3.hide();
            }, 100);
        });

        window.addEventListener('render-map', function(event) {
            var baseLatitude = event.__livewire.params[0].baseLatitude;
            var baseLongtitude = event.__livewire.params[0].baseLongtitude;
            var Latitude = event.__livewire.params[0].Latitude;
            var Longtitude = event.__livewire.params[0].Longtitude;
            var namaJalan = event.__livewire.params[0].namaJalan;
            var iconJalan = event.__livewire.params[0].iconJalan;
            var radiusJalan = event.__livewire.params[0].radiusJalan;
            var warnaRadius = event.__livewire.params[0].warnaRadius;
            var locations = [{
                lat: Latitude,
                lng: Longtitude,
                name: namaJalan,
                category: iconJalan,
                radius: radiusJalan,
                color: warnaRadius,
                icon: iconJalan
            }, ];

            setTimeout(function() {
                // console.log(setBaseView("map",baseLatitude,baseLongtitude,13.2));
                setBaseView("map", baseLatitude, baseLongtitude, 13.2);
                updateMap("map", locations, false);
            }, 500);
        });

        document.addEventListener('updateSelectColor', function(event) {
            const select = $('#exampleFormControlSelect2');

            select.removeClass(
                'bg-white bg-primary bg-success bg-warning bg-danger text-dark text-white');
            setTimeout(function() {

                if (event.detail == '') {
                    select.removeClass('bg-primary text-white');
                    select.removeClass('bg-success text-white');
                    select.removeClass('bg-warning text-white');
                    select.removeClass('bg-danger text-white');
                    select.addClass('bg-white text-dark');
                } else if (event.detail == 'green') {
                    select.addClass('bg-success text-white');
                } else if (event.detail == 'yellow') {
                    select.addClass('bg-warning text-white');
                } else if (event.detail == 'red') {
                    select.addClass('bg-danger text-white');
                } else if (event.detail == 'blue') {
                    select.addClass('bg-primary text-white');
                }
            }, 100);
        });

        window.addEventListener('render-map-all', function(event) {
            var detail = event.detail[0];
            var base = detail.baseView;
            var jalanAll = detail.jalan_daerah_banjir;
            var locations = jalanAll.map(item => ({
                lat: item.la_atitude,
                lng: item.long_atitude,
                name: "Jl. " + item.nama_jalan +
                    ", No." + item.nomor_jalan +
                    "<br> Panjang Jalan: " + item.panjang_jalan +
                    "<br> Tinggi banjir: " + item.tinggi_banjir,
                category: item.icon,
                radius: item.radius,
                color: item.warna_radius,
                icon: item.icon
            }));
            setTimeout(function() {
                offcanvas.hide();
                offcanvas2.hide();
                offcanvas3.hide();
                offcanvas4.hide();
                $('#head_1').addClass('d-none')
                $('#p_1').addClass('d-none')
                $('#btn-display').addClass('d-none')
                $('#sec-1').addClass('d-none')
            }, 100);
            setTimeout(function() {
                offcanvas.show();
                offcanvas3.show();
            }, 300);
            // console.log(document.getElementById("map_all"));
            // console.log(locations);
            setTimeout(function() {
                // console.log(setBaseView("map",base.la_atitude,base.long_atitude,13.2));
                // updateMap("map_all",locations, "all");
                // clearExistingLayers("map");
                setBaseView("map", base.la_atitude, base.long_atitude, 13.2);
                updateMap("map", locations, false);
                updateMap("map", locations, true);
            }, 500);
        });

        // open canvas
        window.addEventListener('open-canvas-detail-daerah-banjir', function() {
            setTimeout(function() {
                offcanvas.show();
            }, 300);
        });
        window.addEventListener('open-canvas-form-jalan-daerah-banjir', function() {
            setTimeout(function() {
                offcanvas.hide();
                offcanvas2.hide();
                offcanvas3.hide();
                offcanvas4.hide();

            }, 100);
            setTimeout(function() {
                offcanvas2.show();
            }, 300);
        });
        window.addEventListener('open-canvas-detail-jalan-daerah-banjir', function() {
            setTimeout(function() {
                offcanvas2.hide();
                offcanvas3.hide();
                offcanvas4.hide();

            }, 100);
            setTimeout(function() {
                offcanvas3.show();
            }, 300);
        });
        window.addEventListener('open-modal-bukti-penanganan', function() {
            setTimeout(function () {
                $('#modalBuktiPenanganan').modal('show');
            }, 500);
        });

        window.addEventListener('open-notif-success-canvas', function() {
            setTimeout(function() {
                offcanvas.hide();
                offcanvas2.hide();
                offcanvas3.hide();
            }, 100);
            setTimeout(function() {
                // $('#formCanvasJalanBanjir').click();
                // offcanvas.show();
                offcanvas3.show();
                alertify.success('Berhasil Disimpan');
            }, 500);
        });
    });
</script>

@endpush
