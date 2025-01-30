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
                                <th class="bg-info">
                                    Tanggal
                                </th>
                                <th class="bg-info">
                                </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data_daerah_banjir as $daerah_banjir)
                                <tr>
                                <td class="text-center">
                                    {{ $no++ }}
                                </td>
                                <td>
                                    {{ $daerah_banjir->nama_kecamatan }}
                                </td>
                                <td>
                                    {{ $daerah_banjir->pemberi_informasi }}
                                </td>
                                <td>
                                    {{ $daerah_banjir->created_at }}
                                </td>
                                </td>
                                <td align="center">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-outline-secondary dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="bi bi-hand-index-thumb"></i> Aksi</button>
                                    <div class="dropdown-menu" x-placement="top-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, -104px, 0px);">
                                    <button type="button" class="dropdown-item text-danger"  wire:click="show_delete_daerah_banjir('{{ $daerah_banjir->id_daerah_banjir }}')"><i class="bi bi-trash3"></i> Hapus</button>
                                    <button type="button" class="dropdown-item text-primary" wire:click="showModalLaporanBanjirPertama({{ $daerah_banjir->id_daerah_banjir }})"><i class="bi bi-pencil-square"></i> Ubah</button>
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

        <!-- Modal Laporan Banjir 1 -->
    <div class="modal fade"  tabindex="-1" aria-hidden="true" id="modalFormLaporanBanjirPertama" data-bs-backdrop="static" data-bs-backdrop="static" wire:ignore.self>
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
</div>

@push('scripts')

    <script>

        function showModal(){
            $('#modalFormLaporanBanjirPertama').modal('show');
        }

        document.addEventListener('DOMContentLoaded', function() {
            initializeDataTable('#table_daerah_banjir');

            window.addEventListener('render-table', function() {
                setTimeout(function () {
                    destroyDataTable('#table_daerah_banjir');
                    initializeDataTable('#table_daerah_banjir');
                    $('#table_daerah_banjir').load(window.location.href + ' #table_daerah_banjir');
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
        });

    </script>
@endpush
