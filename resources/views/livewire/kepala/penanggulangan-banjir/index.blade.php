<div>

    <div class="content-wrapper">
         <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-header row">
                    <div class="col-md-6">
                        <h2 >Data Penanggulangan</h2>
                        <p class="card-description">
                            Dashboard /<code>{{ $title }}</code>
                        </p>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive pt-3">
                            <table class="table table-bordered table-hover" id="table_penanggulangan" wire:ignore.self>
                            <thead>
                                <tr>
                                <th class="bg-info text-center align-middle">
                                    No
                                </th>
                                <th class="bg-info text-center align-middle">
                                    Kecamatan
                                </th>
                                <th class="bg-info">
                                    Nama Penanggulangan
                                </th>
                                <th class="bg-info">
                                    Jenis Penanggulangan
                                </th>
                                <th class="bg-info text-center align-middle">
                                    Waktu
                                </th>
                                <th class="bg-info align-middle">
                                    Petugas
                                </th>
                                <th class="bg-info text-center align-middle">
                                    Status
                                </th>
                                <th class="bg-info">
                                </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data_penanggulangan as $penanggulangan)
                                    <tr>
                                        <td class="text-center">
                                            {{ $no++ }}
                                        </td>
                                        <td>
                                            {{ $penanggulangan->nama_kecamatan }}
                                        </td>
                                        <td>
                                            {{ $penanggulangan->nama_penanggulangan }}
                                        </td>
                                        <td>
                                            {{ $penanggulangan->jenis_penanggulangan }}
                                        </td>
                                        <td>
                                            {{ $penanggulangan->waktu_mulai->translatedFormat('d F Y H:i:s') }}
                                            @if (!empty($penanggulangan->waktu_selesai))
                                                - {{ $penanggulangan->waktu_selesai->translatedFormat('d F Y H:i:s') }}
                                            @endif
                                        </td>
                                        <td>
                                            {{ $penanggulangan->petugas }}
                                        </td>
                                        <td class="text-center
                                            @if ($penanggulangan->status_penanggulangan == 0)
                                                bg-primary text-white
                                            @elseif($penanggulangan->status_penanggulangan == 1)
                                                bg-secondary text-white
                                            @elseif($penanggulangan->status_penanggulangan == 2)
                                                bg-success text-white
                                            @endif
                                        ">
                                        <b>
                                            @if ($penanggulangan->status_penanggulangan == 0)
                                                Terencana
                                            @elseif($penanggulangan->status_penanggulangan == 1)
                                                Proses
                                            @elseif($penanggulangan->status_penanggulangan == 2)
                                                Selesai
                                            @endif
                                        </b>
                                        </td>
                                        <td align="center">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-outline-secondary dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="bi bi-hand-index-thumb"></i> Aksi</button>
                                            <div class="dropdown-menu" x-placement="top-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, -104px, 0px);">
                                                <button type="button" class="dropdown-item text-primary" wire:click="showDetailPenanggulanganBanjir({{ $penanggulangan->id_penanggulangan }})"><i class="bi bi-list"></i> Detail</button>
                                                <button type="button" class="dropdown-item text-info" wire:click="showModalBuktiPenanggulangan({{ $penanggulangan->id_penanggulangan }})"><i class="bi bi-camera"></i> Lihat Bukti</button>
                                            </div>
                                        </div>
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

    <!-- Modal Bukti Penanggulangan -->
    <div class="modal fade"  tabindex="-1" aria-hidden="true" id="modalBuktiPenanggulangan" data-bs-backdrop="static" data-bs-backdrop="static" wire:ignore.self>
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
                                <button class="btn btn-outline-dark" data-bs-target="#carouselExample" data-bs-slide="prev">
                                    <i class="fa fa-chevron-left"></i>
                                </button>
                            </div>

                            <!-- Carousel Images -->
                            <div class="col text-center">
                                <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
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
                                                        <a href="{{ asset('storage/penanggulangan/'.$bukti) }}" data-lightbox="bukti-penanggulangan">
                                                            <img src="{{ asset('storage/penanggulangan/'.$bukti) }}" class="d-block mx-auto w-50 shadow-lg" alt="Bukti {{ $no_gbr }}">
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
                                <button class="btn btn-outline-dark" data-bs-target="#carouselExample" data-bs-slide="next">
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
    <div class="offcanvas offcanvas-end h-100 w-50" tabindex="-1" id="CanvasDetailPenanggulangan"
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
                    <h3 id="offcanvasRightLabel"><b>Detail Penanggulangan</b></h3>
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
                        <td >
                            <span style="font-size: 0.9em">
                                {{ $detailNamaKecamatan ?? '-' }}
                            </span>
                        </td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="fw-bold">Nama Penanggulangan</td>
                        <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                        <td >
                            <span style="font-size: 0.9em">
                                {{ $detailNamaPenanggulangan ?? '-' }}
                            </span>
                        </td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="fw-bold">Jenis Penanggulangan</td>
                        <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                        <td >
                            <span style="font-size: 0.9em">
                                {{ $detailJenisPenanggulangan ?? '-' }}
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
                            <form wire:submit.prevent="save_catatan_penanggulangan" class="w-100">
                                <input type="text" hidden wire:model.defer="id_penanggulangan">
                                <textarea class="form-control w-100 @error('penanggulangan_catatan_kepala') is-invalid @enderror" wire:model.defer="penanggulangan_catatan_kepala" rows="5">
                                </textarea>
                                @error('penanggulangan_catatan_kepala')
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
        </div>
    </div>
</div>

@push('scripts')
<script>
    var offcanvasElement = document.getElementById('CanvasDetailPenanggulangan');
    var offcanvas = new bootstrap.Offcanvas(offcanvasElement, {
        backdrop: 'static',
        keyboard: false
    });

    document.addEventListener('DOMContentLoaded', function() {
        destroyDataTable('#table_penanggulangan');
        initializeDataTable('#table_penanggulangan');
        window.addEventListener('open-modal-bukti-penanggulangan', function() {
            setTimeout(function () {
                $('#modalBuktiPenanggulangan').modal('show');
            }, 500);
        });
        window.addEventListener('render-table', function() {
            setTimeout(function () {
                destroyDataTable('#table_penanggulangan');
                initializeDataTable('#table_penanggulangan');
                $('#table_penanggulangan').load(window.location.href + ' #table_penanggulangan');
            }, 100);
        });
        window.addEventListener('open-canvas-utama', function() {
            setTimeout(function() {
                offcanvas.hide();
            }, 100);
            setTimeout(function() {
                offcanvas.show();
            }, 300);
        });
        window.addEventListener('open-notif-success-canvas', function() {
            setTimeout(function() {
                offcanvas.hide();
            }, 100);
            setTimeout(function() {
                offcanvas.show();
                alertify.success('Berhasil Disimpan');
            }, 500);
        });
    });

    function showModalBukti(){
        $('#modalBuktiPenanggulangan').modal('show');
    }

</script>

@endpush
