<div>
    <div class="content-wrapper">
        <button class="btn btn-light " id="btnKecamatan" wire:click="switchKecamatanUser(true)">DATA KECAMATAN</button>
        <button class="btn btn-light active" id="btnUser" wire:click="switchKecamatanUser(false)">DATA USER</button>
        <section id="sec-kecamatan" class="" wire:ignore.self>
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-header row">
                        <div class="col-md-6">
                            <h2 >Data Kecamatan</h2>
                            <p class="card-description">
                                Dashboard /<code>{{ $title }}</code>
                            </p>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex justify-content-end">
                                <button type="button" class="btn btn-outline-success btn-icon-text mt-3 mr-3" onclick="showModalLokasi()">
                                <i class="mdi mdi-map-marker-multiple"></i>
                                Lokasi
                                </button>
                                <button type="button" class="btn btn-outline-primary btn-icon-text mt-3" onclick="showModal()">
                                <i class="mdi mdi-account-plus"></i>
                                Tambah Kecamatan
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body" id="bagian_table">
                        <div class="table-responsive pt-3">
                                <table class="table table-bordered table-hover" id="table_kecamatan" wire:ignore.self>
                                <thead>
                                    <tr>
                                    <th class="text-center bg-secondary">
                                        No
                                    </th>
                                    <th class="bg-secondary">
                                        Nama Kecamatan
                                    </th>
                                    <th class="bg-secondary text-center">
                                        Koordinat
                                    </th>
                                    <th class="bg-secondary text-center">
                                        Icon
                                    </th>
                                    <th class="bg-secondary text-center">
                                        Radius
                                    </th>
                                    <th class="bg-secondary text-center">
                                        Warna Radius
                                    </th>
                                    <th class="bg-secondary">
                                    </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data_kecamatan as $kecamatan)
                                    <tr>
                                    <td class="text-center">
                                        {{ $no++ }}
                                    </td>
                                    <td>
                                        {{ $kecamatan->nama_kecamatan }}
                                    </td>
                                    <td class="text-center">
                                        @if (isset($kecamatan->long_atitude) && isset($kecamatan->la_atitude))
                                        [{{ $kecamatan->la_atitude }},{{ $kecamatan->long_atitude }}]
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if (isset($kecamatan->icon))
                                            <i class="{{ $kecamatan->icon }}"></i>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if (isset($kecamatan->radius))
                                        {{ $kecamatan->radius }}
                                        @endif
                                    </td>
                                    <td class="text-center
                                        @if ($kecamatan->warna_radius == 'blue')
                                            bg-primary text-white
                                        @elseif ($kecamatan->warna_radius == 'green')
                                            bg-success text-white
                                        @elseif ($kecamatan->warna_radius == 'yellow')
                                            bg-warning text-white
                                        @elseif ($kecamatan->warna_radius == 'red')
                                            bg-danger text-white
                                        @else
                                            bg-white
                                        @endif
                                    )">
                                    </td>
                                    <td align="center">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-outline-secondary dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="bi bi-hand-index-thumb"></i> Aksi</button>
                                        <div class="dropdown-menu" x-placement="top-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, -104px, 0px);">
                                        <button type="button" class="dropdown-item text-danger"  wire:click="show_delete_kecamatan('{{ $kecamatan->id_kecamatan }}')"><i class="bi bi-trash3"></i> Hapus</button>
                                        <button type="button" class="dropdown-item text-primary" wire:click="showModalKecamatan({{ $kecamatan->id_kecamatan }})"><i class="bi bi-pencil-square"></i> Ubah</button>
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
        </section>
        <section id="sec-user" class="d-none" wire:ignore.self>
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-header row">
                        <div class="col-md-6">
                            <h2 >Data User</h2>
                            <p class="card-description">
                                Dashboard /<code>{{ $title }}</code>
                            </p>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex justify-content-end">
                                <button type="button" class="btn btn-outline-primary btn-icon-text mt-3" onclick="showModal()">
                                <i class="mdi mdi-account-plus"></i>
                                Tambah User
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive pt-3">
                                <table class="table table-bordered table-hover" id="table_user" wire:ignore.self>
                                <thead>
                                    <tr>
                                    <th class="text-center bg-primary">
                                        No
                                    </th>
                                    <th class="bg-primary">
                                        Nama Lengkap
                                    </th>
                                    <th class="text-left bg-primary">
                                        Email
                                    </th>
                                    <th class="bg-primary">
                                        Role
                                    </th>
                                    <th class="bg-primary">
                                    </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data_user as $user)
                                    <tr>
                                    <td class="text-center">
                                        {{ $no_user++ }}
                                    </td>
                                    <td>
                                        {{ $user->nama_lengkap }}
                                    </td>
                                    <td class="text-left">
                                        {{ $user->email }}
                                    </td>
                                    <td>
                                        {{ $user->role }}
                                    </td>
                                    <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-outline-secondary dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="bi bi-hand-index-thumb"></i> Aksi</button>
                                        <div class="dropdown-menu" x-placement="top-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, -104px, 0px);">
                                        <button type="button" class="dropdown-item text-danger"  wire:click="show_delete_user('{{ $user->id }}')"><i class="bi bi-trash3"></i> Hapus</button>
                                        <button type="button" class="dropdown-item text-primary" wire:click="showModalUser({{ $user->id }})"><i class="bi bi-pencil-square"></i> Ubah</button>
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
        </section>
    </div>
    <!-- Modal Kecamatan -->
    <div class="modal fade"  tabindex="-1" aria-hidden="true" id="modalFormKecamatan" data-bs-backdrop="static" wire:ignore.self>
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title" id="staticBackdropLabel" style="font-size: 20px">{{ $title_modal }} Data Kecamatan</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" wire:click="refresh_inputan()"></button>
            </div>
            <div class="modal-body">
                <form class="forms-sample" wire:submit.prevent="save_kecamatan">
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
                        <label >Nama Kecamatan</label>
                        <input type="text" class="form-control " wire:model.defer="id_kecamatan" hidden>
                        <input type="text" class="form-control @error('nama_kecamatan') is-invalid @enderror" wire:model.defer="nama_kecamatan" placeholder="Masukkan Nama Kecamatan" required>
                        @error('nama_kecamatan')
                            <label class="text-danger">{{ $message }}</label>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label >Latitude</label>
                        <input type="text" class="form-control @error('la_atitude') is-invalid @enderror" wire:model.defer="la_atitude" placeholder="Masukkan Latitude" required>
                        @error('la_atitude')
                            <label class="text-danger">{{ $message }}</label>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label >Longatitude</label>
                        <input type="text" class="form-control @error('long_atitude') is-invalid @enderror" wire:model.defer="long_atitude" placeholder="Masukkan Longtitude" required>
                        @error('long_atitude')
                            <label class="text-danger">{{ $message }}</label>
                        @enderror
                    </div>
                    <div class="form-group">
                        {{-- <label >Icon</label>
                        <select class="form-control @error('icon') is-invalid @enderror" id="exampleFormControlSelect2" wire:model.defer="icon"  required>
                            <option value="" class="bg-white text-dark" selected>-- Pilih --</option>
                            <option value="mdi mdi-map-marker" class="">
                                <i class="mdi mdi-map-marker"></i>
                                Default
                            </option>
                            <option value="fa-solid fa-water" class="">
                                <i class="fa-solid fa-water"></i>
                                 Banjir
                            </option>
                        </select> --}}
                        <label>Icon</label>
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
                                <input type="radio" wire:model.defer="icon" value="fa-solid fa-house-flood-water" required>
                                <i class="fa-solid fa-house-flood-water"></i> Banjir Bandang
                            </label>
                        </div>

                        {{-- <input type="text" class="form-control @error('icon') is-invalid @enderror" wire:model.defer="icon" placeholder="Masukkan Icon" required> --}}
                        @error('icon')
                            <label class="text-danger">{{ $message }}</label>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label >Radius</label>
                        <div class="row">
                            <div class="col-md-10 col-lg-10">
                                <input type="text" class="form-control @error('radius') is-invalid @enderror" wire:model.defer="radius" placeholder="Masukkan Radius" required>
                            </div>
                            <div class="col-md-2 col-lg-2 align-items-center align-middle d-flex">
                                Meter
                            </div>
                        </div>
                        @error('radius')
                            <label class="text-danger">{{ $message }}</label>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label >Warna Radius</label>
                        <select class="form-control @error('warna_radius') is-invalid @enderror" id="exampleFormControlSelect2" wire:model.defer="warna_radius" onchange="changeBackgroundColor(this)"  required>
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
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close" id="btn_close" wire:click="refresh_inputan()">Tutup</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal Lokasi -->
    <div class="modal fade"  tabindex="-1" aria-hidden="true" id="modalLokasiKecamatan" data-bs-backdrop="static" data-bs-backdrop="static" wire:ignore.self>
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title" id="staticBackdropLabel" style="font-size: 20px">Titik Lokasi Kecamatan</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" wire:click="refresh_inputan()"></button>
                </div>
                <div class="modal-body" wire:ignore.self>
                    <div id="map"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close" id="btn_close" wire:click="refresh_inputan()">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal User -->
    <div class="modal fade"  tabindex="-1" aria-hidden="true" id="modalFormUser" data-bs-backdrop="static" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title" id="staticBackdropLabel" style="font-size: 20px">{{ $title_modal_user }} Data User</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" wire:click="refresh_inputan()"></button>
            </div>
            <div class="modal-body">
                <form class="forms-sample" wire:submit.prevent="save_user">
                    <div class="form-group">
                        <label >Email</label>
                        <input type="text" class="form-control " wire:model.defer="id_user" hidden>
                        <input type="email" class="form-control @error('email_user') is-invalid @enderror" wire:model.defer="email_user" placeholder="Email" required>
                        @error('email_user')
                            <label class="text-danger">{{ $message }}</label>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label >Nama Lengkap</label>
                        <input type="text" class="form-control  @error('nama_lengkap_user') is-invalid @enderror" wire:model.defer="nama_lengkap_user" placeholder="Nama Lengkap" required>
                        @error('nama_lengkap_user')
                            <label class="text-danger">{{ $message }}</label>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label >Role</label>
                        <select class="form-control  @error('role_user') is-invalid @enderror" wire:model.defer="role_user" required>
                            <option value="">-- Pilih --</option>
                            <option value="admin">Admin</option>
                            <option value="user">User</option>
                            <option value="kepala">Kepala</option>
                        </select>
                        @error('role_user')
                            <label class="text-danger">{{ $message }}</label>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label >Password</label>
                        <input type="password" class="form-control @error('password_user') is-invalid @enderror" placeholder="Password" wire:model.defer="password_user">
                        @error('password_user')
                            <label class="text-danger">{{ $message }}</label>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label >Ulangi Password</label>
                        <input type="password" class="form-control @error('confirm_password_user') is-invalid @enderror" placeholder="Password" wire:model.defer="confirm_password_user">
                        @error('confirm_password_user')
                            <label class="text-danger">{{ $message }}</label>
                        @enderror
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close" id="btn_close_user" wire:click="refresh_inputan()">Tutup</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
                </form>
            </div>
        </div>
    </div>

@push('scripts')

<script>
var locations = [
            @foreach ( $data_kecamatan as  $lokasi )
                @if (!empty($lokasi->la_atitude) && !empty($lokasi->long_atitude))

                    { lat: {!! json_encode($lokasi->la_atitude ?? "") !!},
                      lng: {!! json_encode($lokasi->long_atitude ?? "") !!},
                      name: "{{ $lokasi->nama_kecamatan }}",
                      category: "{{ $lokasi->icon }}", radius: {!! json_encode($lokasi->radius ?? "") !!},
                      color: "{{ $lokasi->warna_radius }}",icon: "{{ $lokasi->icon }}" },

                @endif
            @endforeach
        ];
var baseLocation = null;
setBaseView("map",null,null);
updateMap("map",locations, "all");
document.addEventListener('DOMContentLoaded', function() {
    destroyDataTable('#table_kecamatan');
    destroyDataTable('#table_user');
    initializeDataTable('#table_kecamatan');
    initializeDataTable('#table_user');

    document.addEventListener('updateSelectColor', function (event) {
        const select = $('#exampleFormControlSelect2');

        select.removeClass('bg-white bg-primary bg-success bg-warning bg-danger text-dark text-white');
        setTimeout(function () {
            if (event.detail == '') {
                select.removeClass('bg-primary text-white');
                select.removeClass('bg-success text-white');
                select.removeClass('bg-warning text-white');
                select.removeClass('bg-danger text-white');
                select.addClass('bg-white text-dark');
            }else if(event.detail == 'green'){
                select.addClass('bg-success text-white');
            }else if(event.detail == 'yellow'){
                select.addClass('bg-warning text-white');
            }else if(event.detail == 'red'){
                select.addClass('bg-danger text-white');
            }else if(event.detail == 'blue'){
                select.addClass('bg-primary text-white');
            }
        }, 100);
    });

    window.addEventListener('render-table', function() {
        setTimeout(function () {
            destroyDataTable('#table_kecamatan');
            initializeDataTable('#table_kecamatan');
            $('#table_kecamatan').load(window.location.href + ' #table_kecamatan');
            updateMap("map",locations, false);
            destroyDataTable('#table_user');
            initializeDataTable('#table_user');
            $('#table_user').load(window.location.href + ' #table_user');
        }, 100);
    });
    window.addEventListener('open-notif-success', function() {
        setTimeout(function () {
            $('#btn_close').click();
            initializeDataTable('#table_kecamatan');
            destroyDataTable('#table_kecamatan');
            $('#btn_close_user').click();
            destroyDataTable('#table_user');
        }, 100);
        setTimeout(function () {
            initializeDataTable('#table_user');
            $('#table_kecamatan').load(window.location.href + ' #table_kecamatan');
            $('#table_user').load(window.location.href + ' #table_user');
            alertify.success('Berhasil Disimpan');
        }, 600);
    });
    window.addEventListener('open-notif-success-delete', function() {
        setTimeout(function () {
            $('#btn_close').click();
        }, 100);
        setTimeout(function () {
            destroyDataTable('#table_kecamatan');
            initializeDataTable('#table_kecamatan');
            alertify.success('Berhasil Dihapus');
        }, 600);
    });
    window.addEventListener('open-modal-form-kecamatan', function() {
        setTimeout(function () {
            $('#modalFormKecamatan').modal('show');
        }, 500);
    });
    window.addEventListener('open-modal-validation-hapus-kecamatan', function(event) {
        var id_kecamatan = event.__livewire.params[0];
        Swal.fire({
            title: "Apakah ingin menghapus kecamatan ini?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya !",
            cancelButtonText: "Tidak"
        }).then((result) => {
            if (result.isConfirmed) {
                Livewire.dispatch('hapusKecamatan', {
                    id_kecamatan: id_kecamatan
                })
                Swal.fire("Berhasil Dihapus", "", "success");
            } else {
                Swal.fire("Dibatalkan!", "", "error");
            }
        });

    });

    // Sessi User
    window.addEventListener('close-modal-form-user', function() {
        setTimeout(function () {
            $('#modalFormUser').modal('hide');
            $('#btn_close').click();
        }, 100);
    });
    window.addEventListener('open-modal-form-user', function() {
        setTimeout(function () {
            $('#modalFormUser').modal('hide');
            // $('#btn_close').click();
        }, 100);
        setTimeout(function () {
            $('#modalFormUser').modal('show');
        }, 700);
    });
    window.addEventListener('open-modal-validation-hapus-user', function(event) {
        var id_user = event.__livewire.params[0];
        Swal.fire({
            title: "Apakah ingin menghapus user ini?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya !",
            cancelButtonText: "Tidak"
        }).then((result) => {
            if (result.isConfirmed) {
                Livewire.dispatch('hapusUser', {
                    id_user: id_user
                })
                Swal.fire("Berhasil Dihapus", "", "success");
            } else {
                Swal.fire("Dibatalkan!", "", "error");
            }
        });
    });

    window.addEventListener('open-user', function() {
        setTimeout(function () {

            // Menghapus kelas 'active' dari tombol sebelumnya
            $('#btnKecamatan').addClass('active');
            $('#btnUser').addClass('active');

            // Menyembunyikan semua section
            $('#sec-user').removeClass('d-none');
            $('#sec-kecamatan').addClass('d-none');


            destroyDataTable('#table_user');
            destroyDataTable('#table_kecamatan');
        }, 100);
        setTimeout(function () {
            $('#btnUser').removeClass('active');
            $('#sec-user').removeClass('d-none');
            initializeDataTable('#table_user');
            $('#table_user').load(window.location.href + ' #table_user');
        }, 300);
    });
    window.addEventListener('open-kecamatan', function() {
        setTimeout(function () {

            // Menghapus kelas 'active' dari tombol sebelumnya
            $('#btnKecamatan').addClass('active');
            $('#btnUser').addClass('active');

            // menyembunyikan semua section
            $('#sec-user').addClass('d-none');
            $('#sec-kecamatan').addClass('d-none');

            destroyDataTable('#table_user');
            destroyDataTable('#table_kecamatan');
        }, 100);
        setTimeout(function () {
            $('#btnKecamatan').removeClass('active');
            $('#sec-kecamatan').removeClass('d-none');
            initializeDataTable('#table_kecamatan');
            $('#table_kecamatan').load(window.location.href + ' #table_kecamatan');
        }, 300);
    });

    @if (session('success'))
            alertify.success("'"+{{ session('success') }}+"'");
    @endif

    // // Ketika tombol "DATA KECAMATAN" diklik
    // $('#btnKecamatan').click(function(e) {
    //     e.preventDefault(); // Mencegah default action dari <a href="">

    //     // Menghapus kelas 'active' dari tombol sebelumnya
    //     $('#btnUser').addClass('active');

    //     // Menambahkan kelas 'active' pada tombol yang diklik
    //     $(this).removeClass('active');

    //     // Menampilkan section "sec-kecamatan" dan menyembunyikan "sec-user"
    //     $('#sec-kecamatan').removeClass('d-none');
    //     $('#sec-user').addClass('d-none');
    //     destroyDataTable('#table_kecamatan');
    //     initializeDataTable('#table_kecamatan');
    //     $('#table_kecamatan').load(window.location.href + ' #table_kecamatan');
    // });

    // // Ketika tombol "DATA USER" diklik
    // $('#btnUser').click(function(e) {

    // });

});
function changeBackgroundColor(select) {
    select.classList.remove('bg-white', 'bg-primary', 'bg-success', 'bg-warning', 'bg-danger','text-dark','text-white');

    if (select.value == '') {
        select.classList.remove('bg-primary','text-white');
        select.classList.remove('bg-success','text-white');
        select.classList.remove('bg-warning','text-white');
        select.classList.remove('bg-danger','text-white');
        select.classList.add('bg-white','text-dark');
    }else if(select.value == 'green'){
        select.classList.add('bg-success','text-white');
    }else if(select.value == 'yellow'){
        select.classList.add('bg-warning','text-white');
    }else if(select.value == 'red'){
        select.classList.add('bg-danger','text-white');
    }else if(select.value == 'blue'){
        select.classList.add('bg-primary','text-white');
    }
}

function showModal(){
        $('#modalFormKecamatan').modal('show');
}
function showModalLokasi(){
        $('#modalLokasiKecamatan').modal('show');
}
function showModal(){
        $('#modalFormUser').modal('show');
}
</script>
@endpush

</div>
