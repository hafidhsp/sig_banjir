<div>
    <div class="content-wrapper">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-header row">
                    <div class="col-md-6">
                        <h2>{{ $title }}</h2>
                        <p class="card-description">
                            Dashboard /<code>{{ $title }}</code>
                        </p>
                    </div>
                    <div class="col-md-6"></div>
                    <div class="col-md-12 row align-items-center">
                        <div class="col-md-4"></div>
                        <div class="col-md-6">
                            <form action="">
                                <div class="mb-3 form-group row">
                                    <div class="col-6">
                                        <label class="form-label fw-bold">Tanggal Awal</label>
                                        <input type="text" class="form-control @error('tanggal_awal') is-invalid @enderror" id="tanggal_awal"
                                            wire:model.defer="tanggal_awal" placeholder="Pilih Waktu" value="{{ now()->translatedformat('Y-m-d') }}" required>
                                        @error('tanggal_awal')
                                            <label class="text-danger">{{ $message }}</label>
                                        @enderror
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label fw-bold">Tanggal Akhir</label>
                                        <input type="text" class="form-control @error('tanggal_akhir') is-invalid @enderror" id="tanggal_akhir"
                                            wire:model.defer="tanggal_akhir" placeholder="Pilih Waktu" value="{{ now()->translatedformat('Y-m-d') }}" required>
                                        @error('tanggal_akhir')
                                            <label class="text-danger">{{ $message }}</label>
                                        @enderror
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-2">
                            <div class="d-flex justify-content-center">
                                <button type="button" class="btn btn-outline-success btn-icon-text mt-3 form-control"
                                    wire:click="showDetailLokasiMapsAllBase()">
                                    <i class="mdi mdi-map-marker-multiple"></i>
                                    Peta Banjir
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive pt-3">
                        <table class="table table-bordered table-hover" id="table_daerah_banjir" wire:ignore wire:key="table-daerah-banjir">
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
                                    <th class="bg-info">
                                        Jalan
                                    </th>
                                    <th class="bg-info text-center">
                                        Tanggal
                                    </th>
                                    <th class="bg-info text-center">
                                        Status
                                    </th>
                                    <th class="bg-info">
                                    </th>
                                </tr>
                            </thead>
                            <tbody wire:ignore.self>
                                @if (!empty($data_daerah_banjir_search))
                                    @foreach ($data_daerah_banjir_search as $daerah_banjir_search)
                                        <tr>
                                            <td class="text-center clickable-cell"
                                                wire:click="detailJalanDaerahBanjir('{{ $daerah_banjir_search->id_jalan_daerah_banjir }}')">
                                                {{ $no++ }}
                                            </td>
                                            <td class="clickable-cell"
                                                wire:click="detailJalanDaerahBanjir('{{ $daerah_banjir_search->id_jalan_daerah_banjir }}')">
                                                {{ $daerah_banjir_search->nama_kecamatan }}
                                            </td>
                                            <td class="clickable-cell"
                                                wire:click="detailJalanDaerahBanjir('{{ $daerah_banjir_search->id_jalan_daerah_banjir }}')">
                                                {{ $daerah_banjir_search->pemberi_informasi }}
                                            </td>
                                            <td class="clickable-cell"
                                                wire:click="detailJalanDaerahBanjir('{{ $daerah_banjir_search->id_jalan_daerah_banjir }}')">
                                                {{ 'Jl. '.$daerah_banjir_search->nama_jalan .' No.'.$daerah_banjir_search->nomor_jalan}}
                                            </td>
                                            <td class="clickable-cell text-center"
                                                wire:click="detailJalanDaerahBanjir('{{ $daerah_banjir_search->id_jalan_daerah_banjir }}')">

                                                {{ $daerah_banjir_search->tb_jalan_daerah_banjir }}
                                                {{ $daerah_banjir_search->waktu_mulai->translatedFormat('d F Y') }}

                                                @if ($daerah_banjir_search->waktu_selesai)
                                                    {{ $daerah_banjir_search->waktu_selesai->translatedFormat('d F Y') }}
                                                @else
                                                    -
                                                @endif

                                            </td>
                                            <td align="center">
                                                <div class="btn-group">
                                                    <button type="button"
                                                        class="btn  {{ $daerah_banjir_search->konfirmasi_st == 1 ? ' btn-outline-success' : ' btn-outline-danger' }} btn-icon-text"
                                                        wire:click="showKonfirmasiJalanDaerahBanjir({{ $daerah_banjir_search->id_jalan_daerah_banjir }})">
                                                        <i
                                                            class="mdi  {{ $daerah_banjir_search->konfirmasi_st == 1 ? 'mdi-check-circle-outline' : 'mdi-close-circle-outline' }}"></i>
                                                        {{ $daerah_banjir_search->konfirmasi_st == 1 ? 'Terkonfirmasi' : 'Belum Terkonfirmasi' }}
                                                    </button>
                                                </div>
                                            </td>
                                            <td align="center">
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-outline-secondary dropdown-toggle"
                                                        data-toggle="dropdown" aria-expanded="false"><i
                                                            class="bi bi-hand-index-thumb"></i> Aksi</button>
                                                    <div class="dropdown-menu" x-placement="top-start"
                                                        style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, -104px, 0px);">
                                                        <button type="button" class="dropdown-item text-danger"
                                                            wire:click="show_delete_jalan_daerah_banjir('{{ $daerah_banjir_search->id_jalan_daerah_banjir }}')"><i
                                                                class="bi bi-trash3"></i> Hapus</button>
                                                        <button type="button" class="dropdown-item text-primary"
                                                            wire:click="showFormJalanDaerahBanjir({{ $daerah_banjir_search->id_jalan_daerah_banjir }})"><i
                                                                class="bi bi-pencil-square"></i> Ubah</button>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
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
                                            </td>
                                            <td class="clickable-cell"
                                                wire:click="detailJalanDaerahBanjir('{{ $daerah_banjir->id_jalan_daerah_banjir }}')">
                                                {{ 'Jl. '.$daerah_banjir->nama_jalan .' No.'.$daerah_banjir->nomor_jalan}}
                                            </td>
                                            <td class="clickable-cell text-center"
                                                wire:click="detailJalanDaerahBanjir('{{ $daerah_banjir->id_jalan_daerah_banjir }}')">

                                                {{ $daerah_banjir->tb_jalan_daerah_banjir }}
                                                {{ $daerah_banjir->waktu_mulai->translatedFormat('d F Y') }}

                                                @if ($daerah_banjir->waktu_selesai)
                                                    {{ $daerah_banjir->waktu_selesai->translatedFormat('d F Y') }}
                                                @else
                                                    -
                                                @endif

                                            </td>
                                            <td align="center">
                                                <div class="btn-group">
                                                    <button type="button"
                                                        class="btn  {{ $daerah_banjir->konfirmasi_st == 1 ? ' btn-outline-success' : ' btn-outline-danger' }} btn-icon-text">
                                                        <i
                                                            class="mdi  {{ $daerah_banjir->konfirmasi_st == 1 ? 'mdi-check-circle-outline' : 'mdi-close-circle-outline' }}"></i>
                                                        {{ $daerah_banjir->konfirmasi_st == 1 ? 'Terkonfirmasi' : 'Belum Terkonfirmasi' }}
                                                    </button>
                                                </div>
                                            </td>
                                            <td align="center">
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-outline-secondary" aria-expanded="false" wire:click="detailJalanDaerahBanjir({{ $daerah_banjir->id_jalan_daerah_banjir }})"><i
                                                            class="bi bi-list"></i> Detail</button>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Offcanvas -->
    <div class="offcanvas offcanvas-end h-100 w-75" tabindex="-1" id="CanvasDetailBanjir"
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
                wire:click="showDetailLokasiMapsAll({{ $data_jalan_daerah_banjir[0]->id_daerah_banjir ?? null }})">
                <i class="mdi mdi-map-marker-multiple"></i>
                Lokasi
            </button>
            <p>
                <div class="table-responsive pt-3">
                    <table class="table table-bordered table-hover" id="table_detail_daerah_banjir">
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
                                    <tr wire:ignore.self>
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
                                                    class="btn  {{ $jalan_banjir->konfirmasi_st == 1 ? ' btn-outline-success' : ' btn-outline-danger' }} btn-icon-text">
                                                    <i
                                                        class="mdi  {{ $jalan_banjir->konfirmasi_st == 1 ? 'mdi-check-circle-outline' : 'mdi-close-circle-outline' }}"></i>
                                                    {{ $jalan_banjir->konfirmasi_st == 1 ? 'Terkonfirmasi' : 'Belum Terkonfirmasi' }}
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
                        <td class="fw-bold" width="20%">Pemberi Catatan</td>
                        <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                        <td >
                            <span style="font-size: 0.9em">
                                {{ $detailNamaKepala ?? '-' }}
                            </span>
                        </td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="fw-bold align-top">
                            Catatan
                        </td>
                        <td class="align-top">&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                        <td colspan="3" width="80%">
                            {{-- <form wire:submit.prevent="save_catatan_jalan_daerah_banjir" class="w-100"> --}}
                                <textarea class="form-control w-100 @error('jalan_daerah_banjir_catatan_kepala') is-invalid @enderror" wire:model.defer="jalan_daerah_banjir_catatan_kepala" rows="5" readonly>
                                </textarea>
                            {{-- </form> --}}
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
                                                    <button type="button" class="btn btn-sm @if($item->status_penanganan === 1) btn-primary @elseif($item->status_penanganan === 2) btn-success @else btn-secondary @endif
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
                        </div>
                    </div>
                </div>
            </div>
            </p>
        </div>
    </div>
    <!-- Modal Lokasi -->
    <div class="modal fade"  tabindex="-1" aria-hidden="true" id="modalLokasiBanjir" data-bs-backdrop="static" data-bs-backdrop="static" wire:ignore.self>
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title" id="staticBackdropLabel" style="font-size: 20px">Titik Lokasi Banjir</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" wire:click="refresh_inputan()"></button>
                </div>
                <div class="modal-body" wire:ignore.self>
                    <div id="map_banjir"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close" id="btn_close" wire:click="refresh_inputan()">Tutup</button>
                </div>
            </div>
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
        var offcanvasElement3 = document.getElementById('canvasDetailLaporanJalanBanjir');
        var offcanvas3 = new bootstrap.Offcanvas(offcanvasElement3, {
            backdrop: 'true',
            keyboard: false
        });
        document.addEventListener('DOMContentLoaded', function() {
            flatpickr("#tanggal_awal", {
                enableTime: false,
                time_24hr: false,
                dateFormat: "Y-m-d",
                onChange: function(selectedDates, dateStr) {
                    @this.set('tanggal_awal', dateStr);
                }
            });
            flatpickr("#tanggal_akhir", {
                enableTime: false,
                time_24hr: false,
                dateFormat: "Y-m-d",
                onChange: function(selectedDates, dateStr) {
                    @this.set('tanggal_akhir', dateStr);
                }
            });
            initializeDataTable('#table_daerah_banjir');
            initializeDataTable('#table_detail_daerah_banjir');
            // initializeDataTable('#table_jalan_detail_daerah_banjir');
            window.addEventListener('render-table', function() {
                setTimeout(function() {
                    destroyDataTable('#table_daerah_banjir');
                    // table.clear().destroy();
                    // initializeDataTable('#table_daerah_banjir');
                    destroyDataTable('#table_detail_daerah_banjir');
                    // initializeDataTable('#table_detail_daerah_banjir');
                    // $('#table_daerah_banjir').load(window.location.href + ' #table_daerah_banjir');
                    // $('#table_detail_daerah_banjir').load(window.location.href +
                    //     ' #table_detail_daerah_banjir');
                }, 100);
                setTimeout(function() {
                    // destroyDataTable('#table_daerah_banjir');
                    initializeDataTable('#table_daerah_banjir');
                    // destroyDataTable('#table_detail_daerah_banjir');
                    initializeDataTable('#table_detail_daerah_banjir');
                }, 500);
            });
            window.addEventListener('refresh-table', function() {
                setTimeout(function() {
                    $('#table_daerah_banjir').load(window.location.href + ' #table_daerah_banjir');
                    // if ($.fn.dataTable.isDataTable('#table_daerah_banjir')) {
                    //     $('#table_daerah_banjir').DataTable().ajax.reload();  // Gunakan reload jika menggunakan DataTable dengan ajax
                    // }
                }, 300);
            });

            // hide canvas
            window.addEventListener('hide-canvas-all', function() {
                setTimeout(function() {
                    offcanvas.hide();
                    offcanvas3.hide();
                }, 300);
            });
            window.addEventListener('hide-canvas-detail', function() {
                setTimeout(function() {
                    offcanvas.hide();
                    offcanvas3.hide();
                }, 100);
                setTimeout(function() {
                    // offcanvas.show();
                }, 300);
            });

            // Open Canvas
            window.addEventListener('open-canvas-detail-daerah-banjir', function() {
                setTimeout(function() {
                    // offcanvas.show();
                }, 300);
            });
            window.addEventListener('open-canvas-detail-jalan-daerah-banjir', function() {
                setTimeout(function() {
                    $('#canvasDetailLaporanJalanBanjir').removeClass('w-50')
                    $('#canvasDetailLaporanJalanBanjir').removeClass('w-75')
                    offcanvas3.hide();

                }, 100);
                setTimeout(function() {
                    $('#canvasDetailLaporanJalanBanjir').addClass('w-75')
                    offcanvas3.show();
                }, 300);
            });


            // render map
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
                    offcanvas3.hide();
                    $('#head_1').addClass('d-none');
                    $('#p_1').addClass('d-none');
                    $('#btn-display').addClass('d-none');
                    $('#sec-1').addClass('d-none');
                    $('#canvasDetailLaporanJalanBanjir').removeClass('w-50')
                    $('#canvasDetailLaporanJalanBanjir').removeClass('w-75')
                }, 100);
                setTimeout(function() {
                    $('#canvasDetailLaporanJalanBanjir').addClass('w-50')
                    // offcanvas.show();
                    offcanvas3.show();
                }, 300);
                setTimeout(function() {
                    setBaseView("map", base.la_atitude, base.long_atitude, 13.2);
                    updateMap("map", locations, false);
                    updateMap("map", locations, true);
                }, 500);
            });
            window.addEventListener('render-map-all-base', function(event) {
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
                    offcanvas3.hide();
                    $('#head_1').addClass('d-none')
                    $('#p_1').addClass('d-none')
                    $('#btn-display').addClass('d-none')
                    $('#sec-1').addClass('d-none')
                    $('#canvasDetailLaporanJalanBanjir').removeClass('w-50')
                    $('#canvasDetailLaporanJalanBanjir').removeClass('w-75')
                }, 100);
                setTimeout(function() {
                    $('#canvasDetailLaporanJalanBanjir').addClass('w-75')
                    offcanvas3.show();
                    // $('#modalLokasiBanjir').modal('show');
                }, 300);
                // console.log(document.getElementById("map_banjir"));
                // console.log(locations);
                setTimeout(function() {
                    setBaseView("map", null, null, 13.2);
                    updateMap("map", locations, true);
                }, 500);
            });
        });

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


        function showModalLokasi(){
            $('#modalLokasiBanjir').modal('show');
        }

    </script>

@endpush
