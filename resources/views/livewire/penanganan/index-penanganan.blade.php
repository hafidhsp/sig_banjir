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
                </div>
                <div class="card-body">
                    <div class="form-group w-25">
                        <label >Kecamatan</label>
                        <select class="form-control text-center select2" id="exampleFormControlSelect2" wire:model="search">
                            <option value="" selected>-- Pilih --</option>
                            @foreach ($all_kecamatan as $item)
                                <option value="{{ $item->id_kecamatan }}" >{{ $item->nama_kecamatan }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="table-responsive pt-3">
                        <table class="table table-bordered table-hover" id="table_penanganan" wire:ignore.self>
                            <thead>
                                <tr>
                                    <th class="bg-info text-center align-middle">
                                        No.
                                    </th>
                                    <th class="bg-info text-left align-middle" width="20%">
                                        Nama Penanganan
                                    </th>
                                    <th class="bg-info text-left align-middle">
                                        Kecamatan
                                    </th>
                                    <th class="bg-info text-left align-middle">
                                        Nama Pemberi Informasi
                                    </th>
                                    <th class="bg-info text-left align-middle" width="20%">
                                        Nama Petugas
                                    </th>
                                    <th class="bg-info text-center align-middle" width="20%">
                                        Tanggal
                                    </th>
                                    <th class="bg-info text-center align-middle" width="20%">
                                        Status
                                    </th>
                                    <th class="bg-info">
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                 @forelse ($data_penanganan as $penanganan)
                                    <tr>
                                        <td class="text-center">{{ $no++ }}</td>
                                        <td>{{ $penanganan->nama_penanganan }}</td>
                                        <td>{{ $penanganan->nama_kecamatan }}</td>
                                        <td>{{ $penanganan->pemberi_informasi }}</td>
                                        <td>{{ $penanganan->petugas }}</td>
                                        <td class="text-center">{{ $penanganan->waktu_mulai->translatedFormat('d F Y H:i:s') }}</td>
                                        <td class="text-center">
                                            <button type="button"  wire:click="ShowValidationStatusPenanganan({{ $penanganan->id_penanganan }})" class="btn btn-sm @if($penanganan->status_penanganan === 1) btn-primary @elseif($penanganan->status_penanganan === 2) btn-success @else btn-secondary @endif
                                                " readonly>
                                                @if ($penanganan->status_penanganan === 1)
                                                    Proses
                                                @elseif($penanganan->status_penanganan === 2)
                                                    Selesai
                                                @else
                                                    Terencana
                                                @endif
                                            </button>
                                        </td>
                                        <td align="center">
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-outline-secondary dropdown-toggle"
                                                    data-toggle="dropdown" aria-expanded="false"><i
                                                        class="bi bi-hand-index-thumb"></i> Aksi</button>
                                                <div class="dropdown-menu" x-placement="top-start"
                                                    style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, -104px, 0px);">
                                                    <button type="button" class="dropdown-item text-danger"
                                                        wire:click="show_delete_penanganan('{{ $penanganan->id_penanganan }}')"><i
                                                            class="bi bi-trash3"></i> Hapus
                                                    </button>
                                                    <button type="button" class="dropdown-item text-primary"
                                                        wire:click="showFormEditPenanganan({{ $penanganan->id_penanganan }})"><i
                                                            class="bi bi-pencil-square"></i> Ubah
                                                    </button>
                                                    <button type="button" class="dropdown-item text-info" wire:click="showModalBuktiPenanganan({{ $penanganan->id_penanganan }})">
                                                                <i class="bi bi-camera"></i> Lihat Bukti
                                                    </button>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center">Data tidak tersedia</td>
                                        <td hidden></td>
                                        <td hidden></td>
                                        <td hidden></td>
                                        <td hidden></td>
                                        <td hidden></td>
                                        <td hidden></td>
                                        <td hidden></td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Penanganan -->
    <div class="modal fade" tabindex="-1" aria-hidden="true" id="modalFormPenanganan" data-bs-backdrop="static"
        wire:ignore.self>
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title" id="staticBackdropLabel" style="font-size: 20px">{{ $title_modal }}
                        Data Penanganan</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        wire:click="refresh_page()"></button>
                </div>
                <div class="modal-body">
                    <form class="forms-sample" wire:submit.prevent="save_penanganan" enctype="multipart/form-data">
                        <input type="text" class="d-none" wire:model.defer="id_penanganan" hidden>
                        {{-- <input type="text" class="d-none" wire:model.defer="id_jalan_daerah_banjir_penanganan_info" value="{{ $hide_id_jalan_daerah_banjir }}" hidden> --}}
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
                            <label>Nama Penanganan</label>
                            <input type="text" class="form-control @error('nama_penanganan') is-invalid @enderror"
                                wire:model.defer="nama_penanganan" placeholder="Masukkan Nama Penanganan" required>
                            @error('nama_penanganan')
                                <label class="text-danger">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Waktu Mulai</label>
                                    <input type="text" id="waktu_mulai"
                                        class="form-control datetimepicker @error('waktu_mulai') is-invalid @enderror"
                                        wire:model.defer="waktu_mulai" placeholder="Pilih Waktu" required>
                                    @error('waktu_mulai')
                                        <label class="text-danger">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Waktu Selesai</label>
                                    <input type="text"  id="waktu_selesai"
                                        class="form-control @error('waktu_selesai') is-invalid @enderror"
                                        wire:model.defer="waktu_selesai" placeholder="Pilih Waktu">
                                    @error('waktu_selesai')
                                        <label class="text-danger">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="form-group col-4">
                                <label>Nama Petugas</label>
                                <input type="text"
                                    class="form-control @error('nama_petugas') is-invalid @enderror"
                                    wire:model.defer="nama_petugas" placeholder="Masukkan Nama Petugas" required>
                                @error('nama_petugas')
                                    <label class="text-danger">{{ $message }}</label>
                                @enderror
                            </div>
                            <div class="form-group col-8">
                                <label>Anggaran</label>
                                <input type="text" class="form-control @error('anggaran') is-invalid @enderror"
                                    wire:model.defer="anggaran" placeholder="Masukkan Anggaran"
                                    onkeydown="return hanyaAngka(event)"
                                    oninput="this.value = this.value.replace(/[^0-9]/g, '')" required>
                                @error('anggaran')
                                    <label class="text-danger">{{ $message }}</label>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Deskripsi</label>
                            <textarea type="text" class="form-control @error('deskripsi') is-invalid @enderror" wire:model.defer="deskripsi"></textarea>
                            @error('deskripsi')
                                <label class="text-danger">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="mb-3 form-group">
                            <label class="fw-bold">Bukti Foto</label>
                            <input type="file"
                                class="file-upload-default @error('bukti_foto_penanganan.*') is-invalid @enderror"
                                wire:model="bukti_foto_penanganan" multiple hidden id="bukti_foto_penanganan_input" wire:key="bukti_foto_penanganan_input">
                            <div class="input-group">
                                <input type="text"
                                    class="form-control file-upload-info @error('bukti_foto_penanganan.*') is-invalid @enderror"
                                    disabled placeholder="Pilih Gambar" wire:model.defer="bukti_foto_penanganan_info">
                                <span class="input-group-append">
                                    <button class="file-upload-browse btn btn-primary" type="button"
                                        onclick="document.getElementById('bukti_foto_penanganan_input').click()"
                                        wire:click="$dispatch('prosesBuktiFotoPenanganan', 'penanganan')">
                                        <span wire:loading wire:target="bukti_foto_penanganan">Mengunggah...</span>
                                        <span wire:loading.remove wire:target="bukti_foto_penanganan">Unggah</span>
                                    </button>
                                </span>
                            </div>
                            @error('bukti_foto_penanganan.*')
                                <label class="text-danger">{{ $message }}</label>
                            @enderror
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close"
                        id="btn_close" wire:click="refresh_page()">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Bukti Penanganan -->
    <div class="modal fade"  tabindex="-1" aria-hidden="true" id="modalBuktiPenanganan" data-bs-backdrop="static" data-bs-backdrop="static" wire:ignore.self>
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title" id="staticBackdropLabel" style="font-size: 20px"></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" wire:click="refresh_page()"></button>
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
                                                        <br>
                                                        <button class="btn btn-danger" type="button" wire:click="show_delete_bukti_penanganan({{ "'".$idbuktiGambar."'".","."'".$bukti."'" }})">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
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
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close" id="btn_close_bukti" wire:click="refresh_page()">Tutup</button>
                </div>
            </div>
        </div>
    </div>

</div>
{{-- End Livewire --}}

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            initializeDataTable('#table_penanganan');

            window.addEventListener('open-notif-success', function() {
                setTimeout(function() {
                    $('#modalFormPenanganan').modal('hide');
                }, 100);
                setTimeout(function() {
                    alertify.success('Berhasil Disimpan');
                }, 500);
            });

            window.addEventListener('open-notif-success-delete', function() {
                setTimeout(function() {
                    $('#modalFormPenanganan').modal('hide');
                }, 100);
                setTimeout(function() {
                    alertify.success('Berhasil Terhapus');
                }, 500);
            });

            window.addEventListener('render-table', function() {
                setTimeout(function() {
                    $('#modalFormPenanganan').modal('hide');
                }, 100);
                setTimeout(function() {
                    destroyDataTable('#table_penanganan');
                    initializeDataTable('#table_penanganan');
                    $('#table_penanganan').load(window.location.href + ' #table_penanganan');
                }, 300);
            });
            window.addEventListener('refresh-table', function() {
                setTimeout(function() {
                    destroyDataTable('#table_penanganan');
                    initializeDataTable('#table_penanganan');
                    $('.select2').select2({
                        theme: 'bootstrap5'
                    });
                }, 300);
            });

            window.addEventListener('open-modal-form-penanganan', function() {
                setTimeout(function() {
                    $('#modalFormPenanganan').modal('show');
                }, 500);
            });

            window.addEventListener('open-modal-validation-hapus-penanganan', function(event) {
                var id_penanganan = event.__livewire.params[0].id_penanganan;

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
                        Livewire.dispatch('hapusPenanganan', {
                            id_penanganan: id_penanganan,
                        })
                        Swal.fire({
                            title: "Berhasil Dihapus",
                            icon: "success",
                            confirmButtonText: "OK"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                setTimeout(function() {
                                    destroyDataTable('#table_penanganan');
                                    initializeDataTable('#table_penanganan');
                                    $('#table_penanganan').load(window.location.href +
                                        ' #table_penanganan');
                                }, 100);
                                setTimeout(function() {
                                }, 300);
                            }
                        });
                    } else {
                        Swal.fire("Dibatalkan!", "", "error");
                        setTimeout(function() {
                            destroyDataTable('#table_penanganan');
                            initializeDataTable('#table_penanganan');
                            $('#table_penanganan').load(window.location.href + ' #table_penanganan');
                        }, 100);
                        setTimeout(function() {
                        }, 300);
                    }
                });
            });

            window.addEventListener('open-modal-bukti-penanganan', function() {
                setTimeout(function () {
                    $('#modalBuktiPenanganan').modal('show');
                }, 500);
            });

            window.addEventListener('open-modal-validation-ubah-status-penanganan', function(event) {
                let id_penanganan = event.__livewire.params[0].id_penanganan;
                let status_penanganan = event.__livewire.params[0].status_penanganan;
                Swal.fire({
                    title: "Apakah ingin status?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Ya !",
                    cancelButtonText: "Tidak"
                }).then(async (result) => {
                    if (result.isConfirmed) {
                        const { value: fruit } = await Swal.fire({
                            title: "Status Penanganan",
                            input: "select",
                                inputOptions: {
                                    0: "Terencana",
                                    1: "Proses",
                                    2: "Selesai"
                                },
                            inputValue: String(status_penanganan),
                            inputPlaceholder: "-- Pilih Status -- ",
                            showCancelButton: true,
                            inputValidator: (value) => {
                                return new Promise((resolve) => {
                                if (value !== "") {
                                    Livewire.dispatch('ActionUbahStatusPenanganan', {
                                        id_penanganan: id_penanganan,
                                        status_penanganan: value
                                    })
                                    // alertify.success('Berhasil Diubah');
                                    resolve();
                                } else {
                                    resolve("Status Belum Terpilih :)");
                                }
                                });
                            }
                        });
                    } else {
                        Swal.fire("Dibatalkan!", "", "error");
                        setTimeout(function() {
                            destroyDataTable('#table_penanganan');
                            initializeDataTable('#table_penanganan');
                            $('#table_penanganan').load(window.location.href +
                                ' #table_penanganan');
                        }, 100);
                    }
                });

            });

            window.addEventListener('open-modal-validation-hapus-gambar-penanganan', function(event) {
                var id_penanganan = event.__livewire.params[0].id_penanganan;
                var namaFile = event.__livewire.params[0].namaFile;

                Swal.fire({
                    title: "Apakah ingin menghapus gambar ini?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Ya !",
                    cancelButtonText: "Tidak"
                }).then((result) => {
                    if (result.isConfirmed) {
                        Livewire.dispatch('hapusBuktiPenanganan', {
                            id_penanganan: id_penanganan,
                            namaFile: namaFile
                        })
                        Swal.fire({
                            title: "Berhasil Dihapus",
                            icon: "success",
                            confirmButtonText: "OK"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                setTimeout(function () {
                                    $('#table_penanganan').load(window.location.href + ' #table_penanganan');
                                    $('#btn_close_bukti').click();
                                }, 300);
                            }
                        });
                    } else {
                        Swal.fire("Dibatalkan!", "", "error");
                        setTimeout(function () {
                            destroyDataTable('#table_penanganan');
                            initializeDataTable('#table_penanganan');
                            $('#table_penanganan').load(window.location.href + ' #table_penanganan');
                        }, 100);
                    }
                });
            });

            $('#exampleFormControlSelect2').on('change', function(e) {
                var selected = $(this).val();
                @this.set('search', selected); // Mengupdate nilai search pada Livewire
            });
        });
    </script>
@endpush
