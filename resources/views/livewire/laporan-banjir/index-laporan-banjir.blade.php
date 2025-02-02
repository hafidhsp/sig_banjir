<div>
    <div class="content-wrapper">
         <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-header row">
                    <div class="col-md-6">
                        <h2 >Data Laporan Banjir</h2>
                        <p class="card-description">
                            Dashboard /<code>Data Laporan Banjir</code>
                        </p>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn btn-outline-primary btn-icon-text mt-3" onclick="showModal()">
                            <i class="mdi mdi-account-plus"></i>
                            Tambah Laporan Banjir
                            </button>
                        </div>
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
                                        <td class="text-center clickable-cell" wire:click="detailDaerahBanjir('{{ $daerah_banjir->id_daerah_banjir }}')">
                                            {{ $no++ }}
                                        </td>
                                        <td class="clickable-cell" wire:click="detailDaerahBanjir('{{ $daerah_banjir->id_daerah_banjir }}')">
                                            {{ $daerah_banjir->nama_kecamatan }}
                                        </td>
                                        <td class="clickable-cell" wire:click="detailDaerahBanjir('{{ $daerah_banjir->id_daerah_banjir }}')">
                                            {{ $daerah_banjir->pemberi_informasi }}
                                        </td>
                                        <td class="clickable-cell" class="text-center" wire:click="detailDaerahBanjir('{{ $daerah_banjir->id_daerah_banjir }})">
                                            {{ (($daerah_banjir->tb_daerah_banjir.$daerah_banjir->created_at != '')?$daerah_banjir->tb_daerah_banjir.$daerah_banjir->created_at->translatedFormat('d F Y'):'') }}
                                        </td>
                                        <td align="center">
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-outline-secondary dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="bi bi-hand-index-thumb"></i> Aksi</button>
                                                <div class="dropdown-menu" x-placement="top-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, -104px, 0px);">
                                                    <button type="button" class="dropdown-item text-danger"  wire:click="show_delete_daerah_banjir('{{ $daerah_banjir->id_daerah_banjir }}')"><i class="bi bi-trash3"></i> Hapus</button>
                                                    <button type="button" class="dropdown-item text-primary" wire:click="showModalLaporanBanjirPertama({{ $daerah_banjir->id_daerah_banjir }})"><i class="bi bi-pencil-square"></i> Ubah</button>
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

    <!-- Modal Laporan Banjir 1 -->
    <div class="modal fade"  tabindex="-1" aria-hidden="true" id="modalFormLaporanBanjirPertama" data-bs-backdrop="static" wire:ignore.self>
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title" id="staticBackdropLabel" style="font-size: 20px">{{ $title_modal }} Data Laporan Banjir</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" wire:click="refresh_inputan()"></button>
            </div>
            <div class="modal-body">
                <form class="forms-sample" wire:submit.prevent="save_laporan_banjir_pertama" enctype="multipart/form-data">
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
                    <div class="form-group">
                        <input type="text" class="form-control " wire:model.defer="id_daerah_banjir" hidden>
                        <label >Kecamatan</label>
                        <select class="form-control @error('kecamatan_daerah_banjir') is-invalid @enderror" id="kecamatanChoices" wire:model.defer="kecamatan_daerah_banjir" required>
                            <option value="" class="bg-white text-dark" selected>-- Pilih --</option>
                            @foreach ($data_kecamatan as $kecamatan)
                                <option value="{{ $kecamatan->id_kecamatan }}" class="form-control">{{ $kecamatan->nama_kecamatan }}</option>
                            @endforeach
                        </select>
                        @error('kecamatan_daerah_banjir')
                            <label class="text-danger">{{ $message }}</label>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label >Nama Pemberi Informasi</label>
                        <input type="text" class="form-control @error('nama_pemberi_informasi') is-invalid @enderror" wire:model.defer="nama_pemberi_informasi" placeholder="Masukkan Nama Penanggulangan" required>
                        @error('nama_pemberi_informasi')
                            <label class="text-danger">{{ $message }}</label>
                        @enderror
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close" id="btn_close" wire:click="refresh_inputan()">Tutup</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Offcanvas -->
    <div class="offcanvas offcanvas-end h-100" tabindex="-1" id="CanvasDetailBanjir" aria-labelledby="offcanvasRightLabel"  aria-hidden="true" data-bs-backdrop="static" wire:ignore.self>
        <div class="offcanvas-header">
            <div class="d-flex justify-content-between">
                    <div class="align-items-start">
                        <button type="button" id="button_detail_canvas" class="btn-close-custom-start text-reset" data-bs-dismiss="offcanvas" aria-label="Close" wire:click="refresh_inputan()">
                            <i class="bi bi-arrow-right"></i>
                        </button>
                    </div>
                <div>
                    <h3 id="offcanvasRightLabel"><b>Detail Laporan</b></h3>
                    <small class="text-muted fst-italic">30 Januari 2025</small>
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
                                {{ !empty($detailNamaKecamatan)?$detailNamaKecamatan:'-' }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td class="fw-bold">Pemberi Informasi</td>
                        <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                        <td>
                            <span style="font-size: 0.9em">
                                {{ !empty($detailPemberiInformasi)?$detailPemberiInformasi:'-' }}
                            </span>
                        </td>
                    </tr>
                </table>
            </p>
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

                            @if ($data_jalan_daerah_banjir->isEmpty())
                                <tr>
                                    <td colspan="4" class="text-center text-muted">Data tidak ada</td>
                                    <td class="d-none"></td>
                                    <td class="d-none"></td>
                                    <td class="d-none"></td>
                                </tr>
                            @else
                                @foreach ($data_jalan_daerah_banjir as $jalan_banjir)
                                    <tr>
                                        <td class="text-center">
                                            {{ $no_1 }}
                                        </td>
                                        <td wire:click="detailDaerahBanjir('')">
                                            {{ $jalan_banjir->nama_jalan }}
                                        </td>
                                        <td wire:click="detailDaerahBanjir('')">
                                            {{ $jalan_banjir->tinggi_banjir }}
                                        </td>
                                        <td align="center">
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-outline-secondary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                    <i class="bi bi-hand-index-thumb"></i> Aksi
                                                </button>
                                                <div class="dropdown-menu" x-placement="top-start">
                                                    <button type="button" class="dropdown-item text-danger" wire:click="show_delete_jalan_daerah_banjir({{ $jalan_banjir->id_jalan_daerah_banjir }})">
                                                        <i class="bi bi-trash3"></i> Hapus
                                                    </button>
                                                    <button type="button" class="dropdown-item text-primary" wire:click="showFormJalanDaerahBanjir({{ $jalan_banjir->id_jalan_daerah_banjir }})">
                                                        <i class="bi bi-pencil-square"></i> Ubah
                                                    </button>
                                                    <button type="button" class="dropdown-item text-primary" wire:click="showDetailJalanDaerahBanjir('')">
                                                        <i class="bi bi-list"></i> Detail
                                                    </button>
                                                </div>
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
                <div class="d-flex justify-content-end">
                    <button type="button" class="btn btn-outline-primary btn-icon-text mt-3" onclick="showModalJalanBanjir()">
                    <i class="mdi mdi-account-plus"></i>
                    Tambah Detail Laporan Banjir
                    </button>
                </div>
            </p>
        </div>
    </div>

    <!-- Offcanvas FORM -->
    <div class="offcanvas offcanvas-start h-100 w-50" tabindex="-1" id="canvasFormLaporanJalanBanjir" aria-labelledby="offcanvasRightLabel" wire:ignore.self>
        <div class="offcanvas-header">
            <div>
                <h3 id="offcanvasRightLabel"><b>{{ $title_modal }} Detail Laporan</b></h3>
            </div>
            <div class="d-flex">
                <div class="align-items-end">
                    <button type="button" class="btn-close-custom text-reset" data-bs-dismiss="offcanvas" aria-label="Close" id="formCanvasJalanBanjir">
                        <i class="bi bi-arrow-left"></i>
                    </button>
                </div>
            </div>
        </div>
        <div class="offcanvas-body">
            <p>
                <form wire:submit.prevent="save_jalan_daerah_banjir" enctype="multipart/form-data">
                    <div class="mb-3 form-group">
                        <label class="form-label fw-bold">Nama Jalan</label>
                        <input type="text" class="d-none" wire:model.defer="id_daerah_banjir_jalan" hidden>
                        <input type="text" class="form-control @error('nama_jalan') is-invalid @enderror" wire:model.defer="nama_jalan" placeholder="Masukkan Nama Jalan" required>
                        @error('nama_jalan')
                            <label class="text-danger">{{ $message }}</label>
                        @enderror
                    </div>
                    <div class="mb-3 form-group row">
                        <div class="col-6">
                            <label class="form-label fw-bold">Nomor Jalan</label>
                            <input type="text" class="form-control  @error('nomor_jalan') is-invalid @enderror" wire:model.defer="nomor_jalan" placeholder="Masukkan Nomor">
                            @error('nomor_jalan')
                                <label class="text-danger">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="col-6">
                            <label class="form-label fw-bold">Panjang Jalan</label>
                            <input type="text" class="form-control @error('panjang_jalan') is-invalid @enderror" wire:model.defer="panjang_jalan" placeholder="Masukkan Panjang Jalan">
                            @error('panjang_jalan')
                                <label class="text-danger">{{ $message }}</label>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 form-group row">
                        <div class="col-6">
                            <label class="form-label fw-bold">Waktu Mulai</label>
                            <input type="date" class="form-control @error('waktu_mulai') is-invalid @enderror" wire:model.defer="waktu_mulai" placeholder="Pilih Waktu" required>
                            @error('waktu_mulai')
                                <label class="text-danger">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="col-6">
                            <label class="form-label fw-bold">Waktu Selesai</label>
                            <input type="date" class="form-control @error('waktu_selesai') is-invalid @enderror" wire:model.defer="waktu_selesai" placeholder="Pilih Waktu">
                            @error('waktu_selesai')
                                <label class="text-danger">{{ $message }}</label>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 form-group row">
                        <div class="col-6">
                            <label class="form-label fw-bold">Radius Banjir</label>
                            <input type="text" class="form-control @error('radius') is-invalid @enderror" wire:model.defer="radius" placeholder="Masukkan Radius Banjir">
                            @error('radius')
                                <label class="text-danger">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="col-6">
                            <label class="form-label fw-bold">Icon</label>
                            <input type="text" class="form-control  @error('icon') is-invalid @enderror" wire:model.defer="icon" placeholder="Plih Icon">
                            @error('icon')
                                <label class="text-danger">{{ $message }}</label>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 form-group">
                    </div>
                    <div class="mb-3 form-group">
                        <label class="form-label fw-bold">Jenis Banjir</label>
                        <input type="text" class="form-control  @error('jenis_banjir') is-invalid @enderror" wire:model.defer="jenis_banjir" placeholder="Pilih Tingkat Banjir">
                        @error('jenis_banjir')
                            <label class="text-danger">{{ $message }}</label>
                        @enderror
                    </div>
                    <div class="mb-3 form-group">
                        <label class="form-label fw-bold">Tinggi Banjir</label>
                        <input type="text" class="form-control  @error('tinggi_banjir') is-invalid @enderror" wire:model.defer="tinggi_banjir" placeholder="Masukkan Tinggi Banjir">
                        @error('tinggi_banjir')
                            <label class="text-danger">{{ $message }}</label>
                        @enderror
                    </div>

                    <div class="mb-3 form-group">
                        <label class="fw-bold">Bukti Foto</label>
                        <input type="file" class="file-upload-default @error('bukti_foto.*') is-invalid @enderror"
                            wire:model="bukti_foto" multiple hidden id="bukti_foto_input">
                        <div class="input-group">
                            <input type="text" class="form-control file-upload-info @error('bukti_foto.*') is-invalid @enderror"
                                disabled placeholder="Pilih Gambar" wire:model.defer="bukti_foto_info">
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

        function showModal(){
            $('#modalFormLaporanBanjirPertama').modal('show');
        }
        function showModalJalanBanjir(){
            offcanvas2.show();
        }

        document.addEventListener('DOMContentLoaded', function() {
            initializeDataTable('#table_daerah_banjir');
            initializeDataTable('#table_detail_daerah_banjir');

            window.addEventListener('render-table', function() {
                setTimeout(function () {
                    destroyDataTable('#table_daerah_banjir');
                    initializeDataTable('#table_daerah_banjir');
                    offcanvas.hide();
                    offcanvas2.hide();
                    $('#table_daerah_banjir').load(window.location.href + ' #table_daerah_banjir');
                    $('#table_detail_daerah_banjir').load(window.location.href + ' #table_detail_daerah_banjir');
                }, 100);
            });
            window.addEventListener('open-notif-success', function() {
                setTimeout(function () {
                    $('#btn_close').click();
                    destroyDataTable('#table_daerah_banjir');
                    initializeDataTable('#table_daerah_banjir');
                }, 100);
                setTimeout(function () {
                    alertify.success('Berhasil Disimpan');
                }, 500);
            });
            window.addEventListener('open-notif-success-canvas-form', function() {
                setTimeout(function () {
                    offcanvas.hide();
                    offcanvas2.hide();
                }, 100);
                setTimeout(function () {
                    $('#formCanvasJalanBanjir').click();
                    offcanvas.show();
                    alertify.success('Berhasil Disimpan');
                }, 500);
            });
            window.addEventListener('open-notif-success-delete', function() {
                setTimeout(function () {
                    $('#btn_close').click();
                }, 100);
                setTimeout(function () {
                    destroyDataTable('#table_daerah_banjir');
                    initializeDataTable('#table_daerah_banjir');
                    alertify.success('Berhasil Dihapus');
                }, 600);
            });
            window.addEventListener('open-notif-success-delete-canvas-form', function() {
                setTimeout(function () {
                    offcanvas.hide();
                    offcanvas2.hide();
                }, 100);
                setTimeout(function () {
                    $('#formCanvasJalanBanjir').click();
                    offcanvas.show();
                    alertify.success('Berhasil Dihapus');
                }, 600);
            });
            window.addEventListener('open-modal-form-daerah-banjir', function() {
                setTimeout(function () {
                    $('#modalFormLaporanBanjirPertama').modal('show');
                }, 500);
            });
            window.addEventListener('open-modal-validation-hapus-daerah-banjir', function(event) {
                var id_daerah_banjir = event.__livewire.params[0];
                Swal.fire({
                    title: "Apakah ingin menghapus data ini?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Ya !",
                    cancelButtonText: "Tidak"
                }).then((result) => {
                    if (result.isConfirmed) {
                        Livewire.dispatch('hapusDaerahBanjir', {
                            id_daerah_banjir: id_daerah_banjir
                        })
                        Swal.fire("Berhasil Dihapus", "", "success");
                    } else {
                        Swal.fire("Dibatalkan!", "", "error");
                        setTimeout(function () {
                            destroyDataTable('#table_daerah_banjir');
                            initializeDataTable('#table_daerah_banjir');
                            $('#table_daerah_banjir').load(window.location.href + ' #table_daerah_banjir');
                        }, 100);
                    }
                });

            });
            window.addEventListener('open-modal-validation-hapus-jalan-daerah-banjir', function(event) {
                var id_jalan_daerah_banjir = event.__livewire.params[0];
                Swal.fire({
                    title: "Apakah ingin menghapus data ini?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Ya !",
                    cancelButtonText: "Tidak"
                }).then((result) => {
                    if (result.isConfirmed) {
                        Livewire.dispatch('hapusJalanDaerahBanjir', {
                            id_jalan_daerah_banjir: id_jalan_daerah_banjir
                        })
                        Swal.fire("Berhasil Dihapus", "", "success");
                    } else {
                        Swal.fire("Dibatalkan!", "", "error");
                        setTimeout(function () {
                            offcanvas.hide();
                            destroyDataTable('#table_jalan_daerah_banjir');
                            initializeDataTable('#table_jalan_daerah_banjir');
                            $('#table_jalan_daerah_banjir').load(window.location.href + ' #table_jalan_daerah_banjir');
                        }, 100);
                        setTimeout(function () {
                            offcanvas.show();
                        }, 300);
                    }
                });

            });
            window.addEventListener('open-canvas-detail-daerah-banjir', function() {
                setTimeout(function () {
                    offcanvas.show();
                }, 300);
            });
            window.addEventListener('open-canvas-detail-jalan-daerah-banjir', function() {
                setTimeout(function () {
                    offcanvas2.show();
                }, 300);
            });

            const button = document.getElementById('button_detail_canvas');
            window.addEventListener('render-canvas', function() {
                setTimeout(function () {
                    offcanvas.hide();
                    offcanvas2.hide();
                }, 100);
                setTimeout(function () {
                    offcanvas.show();
                    offcanvas2.show();
                }, 300);
            });
        });
    </script>


@endpush
