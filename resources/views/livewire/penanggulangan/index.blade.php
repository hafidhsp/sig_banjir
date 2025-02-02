<div>

    <div class="content-wrapper">
         <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-header row">
                    <div class="col-md-6">
                        <h2 >Data Penanggulangan</h2>
                        <p class="card-description">
                            Dashboard /<code>Data Penanggulangan</code>
                        </p>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn btn-outline-primary btn-icon-text mt-3" onclick="showModal()">
                            <i class="mdi mdi-account-plus"></i>
                            Tambah Penanggulangan
                            </button>
                        </div>
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
                                    {{ $penanggulangan->waktu_mulai->translatedFormat('d F Y') }}
                                    @if (!empty($penanggulangan->waktu_selesai))
                                        - {{ $penanggulangan->waktu_selesai->translatedFormat('d F Y') }}
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
                                    <button type="button" class="dropdown-item text-danger"  wire:click="show_delete_penanggulangan('{{ $penanggulangan->id_penanggulangan }}')"><i class="bi bi-trash3"></i> Hapus</button>
                                    <button type="button" class="dropdown-item text-primary" wire:click="showModalPenanggulangan({{ $penanggulangan->id_penanggulangan }})"><i class="bi bi-pencil-square"></i> Ubah</button>
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

    <!-- Modal Penanggulangan -->
    <div class="modal fade"  tabindex="-1" aria-hidden="true" id="modalFormPenanggulangan" data-bs-backdrop="static" data-bs-backdrop="static" wire:ignore.self>
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title" id="staticBackdropLabel" style="font-size: 20px">{{ $title_modal }} Data Penanggulangan</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" wire:click="refresh_inputan()"></button>
            </div>
            <div class="modal-body">
                <form class="forms-sample" wire:submit.prevent="save_penanggulangan" enctype="multipart/form-data">
                    @if (session('error'))
                        <div class="alert alert-warning" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif
                    {{-- @if ($errors->any())
                        <div class="alert alert-warning" role="alert">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif --}}

                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    <div class="form-group">
                        <input type="text" class="form-control " wire:model.defer="id_penanggulangan" hidden>
                        <label >Kecamatan</label>
                        <select class="form-control @error('kecamatan_penanggulangan') is-invalid @enderror" id="kecamatanChoices" wire:model.defer="kecamatan_penanggulangan" required>
                            <option value="" class="bg-white text-dark" selected>-- Pilih --</option>
                            @foreach ($data_kecamatan as $kecamatan)
                                <option value="{{ $kecamatan->id_kecamatan }}" class="form-control">{{ $kecamatan->nama_kecamatan }}</option>
                            @endforeach
                        </select>
                        @error('kecamatan_penanggulangan')
                            <label class="text-danger">{{ $message }}</label>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label >Nama Penanggulangan</label>
                        <input type="text" class="form-control @error('nama_penanggulangan') is-invalid @enderror" wire:model.defer="nama_penanggulangan" placeholder="Masukkan Nama Penanggulangan" required>
                        @error('nama_penanggulangan')
                            <label class="text-danger">{{ $message }}</label>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label >Jenis Penanggulangan</label>
                        <input type="text" class="form-control @error('jenis_penanggulangan') is-invalid @enderror" wire:model.defer="jenis_penanggulangan" placeholder="Masukkan Jenis Penanggulangan" required>
                        @error('jenis_penanggulangan')
                            <label class="text-danger">{{ $message }}</label>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label >Waktu Mulai</label>
                        <input type="date" class="form-control @error('waktu_mulai') is-invalid @enderror" wire:model.defer="waktu_mulai" placeholder="Pilih Waktu" required>
                        @error('waktu_mulai')
                            <label class="text-danger">{{ $message }}</label>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label >Waktu Selesai</label>
                        <input type="date" class="form-control @error('waktu_selesai') is-invalid @enderror" wire:model.defer="waktu_selesai" placeholder="Pilih Waktu">
                        @error('waktu_selesai')
                            <label class="text-danger">{{ $message }}</label>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label >Petugas</label>
                        <input type="text" class="form-control @error('petugas') is-invalid @enderror" wire:model.defer="petugas" placeholder="Masukkan Nama Petugas">
                        @error('petugas')
                            <label class="text-danger">{{ $message }}</label>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label >Anggaran</label>
                        <input type="text" class="form-control @error('anggaran_penanggulangan') is-invalid @enderror" wire:model.defer="anggaran_penanggulangan" placeholder="Masukkan Anggaran">
                        @error('anggaran_penanggulangan')
                            <label class="text-danger">{{ $message }}</label>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label >Status</label>
                        <select class="form-control @error('status_penanggulangan') is-invalid @enderror" id="select_status" wire:model.defer="status_penanggulangan" onchange="changeBackgroundColor(this)"  required>
                            <option value="" class="bg-white text-dark" selected>-- Pilih --</option>
                            <option value="0" class="bg-primary text-white">Terencana</option>
                            <option value="1" class="bg-secondary text-white">Proses</option>
                            <option value="2" class="bg-success text-white">Selesai</option>
                        </select>
                        @error('status_penanggulangan')
                            <label class="text-danger">{{ $message }}</label>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label >Deskripsi</label>
                        <textarea type="text" class="form-control @error('deskripsi_penanggulangan') is-invalid @enderror" wire:model.defer="deskripsi_penanggulangan"></textarea>
                        @error('deskripsi_penanggulangan')
                            <label class="text-danger">{{ $message }}</label>
                        @enderror
                    </div>
                    {{-- <div class="form-group">
                        <label>Unggah Gambar</label>
                        <input type="file" class="file-upload-default @error('bukti_penanggulangan') is-invalid @enderror" wire:model.defer="bukti_penanggulangan" multiple>
                        <div class="input-group col-xs-12">
                            <input type="text" class="form-control file-upload-info @error('bukti_penanggulangan') is-invalid @enderror" disabled="" placeholder="Pilih Gambar" wire:model.defer="bukti_penanggulangan_info">
                            <span class="input-group-append">
                            <button class="file-upload-browse btn btn-primary" type="button">Unggah</button>
                            </span>
                        </div>
                        @error('bukti_penanggulangan')
                            <label class="text-danger">{{ $message }}</label>
                        @enderror
                    </div> --}}
                    <div class="mb-3 form-group">
                        <label class="fw-bold">Bukti Penanggulangan</label>

                        <input type="file" class="file-upload-default @error('bukti_penanggulangan.*') is-invalid @enderror"
                            wire:model="bukti_penanggulangan" multiple hidden id="bukti_penanggulangan_input">
                        <div class="input-group">
                            <input type="text" class="form-control file-upload-info @error('bukti_penanggulangan.*') is-invalid @enderror"
                                disabled placeholder="Pilih Gambar" wire:model.defer="bukti_penanggulangan_info">

                            <span class="input-group-append">
                                <button class="file-upload-browse btn btn-primary" type="button"
                                        onclick="document.getElementById('bukti_penanggulangan_input').click()">
                                    <span wire:loading wire:target="bukti_penanggulangan">Mengunggah...</span>
                                    <span wire:loading.remove wire:target="bukti_penanggulangan">Unggah</span>
                                </button>
                            </span>
                        </div>

                        @error('bukti_penanggulangan.*')
                            <label class="text-danger">{{ $message }}</label>
                        @enderror
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close" id="btn_close" wire:click="refresh_inputan()">Tutup</button>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                        <span wire:loading wire:target="save_penanggulangan">Menyimpan data...</span>
                        <span wire:loading.remove wire:target="save_penanggulangan">Simpan</span>
                    </button>
                </div>
            </div>
                </form>
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
                                                        <br>
                                                        <button class="btn btn-danger" type="button" wire:click="show_delete_bukti_penanggulangan({{ "'".$idbuktiGambar."'".","."'".$bukti."'" }})">
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
</div>


@push('scripts')

<script>

function showModal(){
    $('#modalFormPenanggulangan').modal('show');
}

function showModalBukti(){
    $('#modalBuktiPenanggulangan').modal('show');
}

function changeBackgroundColor(select) {
    select.classList.remove('bg-white', 'bg-primary', 'bg-success', 'bg-warning', 'bg-danger','text-dark','text-white');

    if (select.value == '') {
        select.classList.remove('bg-primary','text-white');
        select.classList.remove('bg-success','text-white');
        select.classList.remove('bg-warning','text-white');
        select.classList.remove('bg-danger','text-white');
        select.classList.add('bg-white','text-dark');
    }else if(select.value == 1){
        select.classList.add('bg-secondary','text-white');
    }else if(select.value == 2){
        select.classList.add('bg-success','text-white');
    }else if(select.value == 0){
        select.classList.add('bg-primary','text-white');
    }
}

document.addEventListener('DOMContentLoaded', function() {
    initializeDataTable('#table_penanggulangan');

    window.addEventListener('render-table', function() {
        setTimeout(function () {
            destroyDataTable('#table_penanggulangan');
            initializeDataTable('#table_penanggulangan');
            $('#table_penanggulangan').load(window.location.href + ' #table_penanggulangan');
        }, 100);
    });

    document.addEventListener('updateSelectColor', function (event) {
        const select = $('#select_status');

        select.removeClass('bg-white bg-primary bg-success bg-warning bg-danger text-dark text-white');
        setTimeout(function () {

            if (event.detail == '') {
                select.removeClass('bg-primary text-white');
                select.removeClass('bg-success text-white');
                select.removeClass('bg-warning text-white');
                select.removeClass('bg-danger text-white');
                select.addClass('bg-white text-dark');
            }else if(event.detail == '1'){
                select.addClass('bg-secondary text-white');
            }else if(event.detail == '2'){
                select.addClass('bg-success text-white');
            }else if(event.detail == '0'){
                select.addClass('bg-primary text-white');
            }
        }, 100);
    });

    window.addEventListener('open-notif-success', function() {
        setTimeout(function () {
            $('#btn_close').click();
            destroyDataTable('#table_penanggulangan');
            initializeDataTable('#table_penanggulangan');
        }, 100);
        setTimeout(function () {
            alertify.success('Berhasil Disimpan');
        }, 500);
    });
    window.addEventListener('open-notif-success-delete', function() {
        setTimeout(function () {
            $('#btn_close').click();
            $('#btn_close_bukti').click();
        }, 100);
        setTimeout(function () {
            destroyDataTable('#table_penanggulangan');
            initializeDataTable('#table_penanggulangan');
            alertify.success('Berhasil Dihapus');
        }, 600);
    });
    window.addEventListener('open-modal-form-penanggulangan', function() {
        setTimeout(function () {
            $('#modalFormPenanggulangan').modal('show');
        }, 500);
    });
    window.addEventListener('open-modal-bukti-penanggulangan', function() {
        setTimeout(function () {
            $('#modalBuktiPenanggulangan').modal('show');
        }, 500);
    });
    window.addEventListener('open-modal-validation-hapus-penanggulangan', function(event) {
        var id_penanggulangan = event.__livewire.params[0];
        Swal.fire({
            title: "Apakah ingin menghapus penanggulangan ini?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya !",
            cancelButtonText: "Tidak"
        }).then((result) => {
            if (result.isConfirmed) {
                Livewire.dispatch('hapusPenanggulangan', {
                    id_penanggulangan: id_penanggulangan
                })
                Swal.fire("Berhasil Dihapus", "", "success");
            } else {
                Swal.fire("Dibatalkan!", "", "error");
                setTimeout(function () {
                    destroyDataTable('#table_penanggulangan');
                    initializeDataTable('#table_penanggulangan');
                    $('#table_penanggulangan').load(window.location.href + ' #table_penanggulangan');
                }, 100);
            }
        });

    });
    window.addEventListener('open-modal-validation-hapus-gambar-penanggulangan', function(event) {
        var id_penanggulangan = event.__livewire.params[0].id_penanggulangan;
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
                Livewire.dispatch('hapusBuktiPenanggulangan', {
                    id_penanggulangan: id_penanggulangan,
                    namaFile: namaFile
                })
                Swal.fire({
                    title: "Berhasil Dihapus",
                    icon: "success",
                    confirmButtonText: "OK"
                }).then((result) => {
                    if (result.isConfirmed) {
                        setTimeout(function () {
                            $('#table_penanggulangan').load(window.location.href + ' #table_penanggulangan');
                        }, 300);
                    }
                });
            } else {
                Swal.fire("Dibatalkan!", "", "error");
                setTimeout(function () {
                    destroyDataTable('#table_penanggulangan');
                    initializeDataTable('#table_penanggulangan');
                    $('#table_penanggulangan').load(window.location.href + ' #table_penanggulangan');
                }, 100);
            }
        });

    });
});


</script>
@endpush
