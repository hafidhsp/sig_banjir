<div>
    <div class="content-wrapper">
         <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-header row">
                    <div class="col-md-6">
                        <h2 >Data User</h2>
                        <p class="card-description">
                            Dashboard /<code>Data User</code>
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
                            <table class="table table-bordered table-hover" id="table_user">
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
                                    {{ $no++ }}
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
    </div>
         <!-- Modal User -->
    <div class="modal fade"  tabindex="-1" aria-hidden="true" id="modalFormUser" data-bs-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title" id="staticBackdropLabel" style="font-size: 20px">{{ $title_modal }} Data User</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" wire:click="closeModalUser()"></button>
            </div>
            <div class="modal-body">
                <form class="forms-sample" wire:submit.prevent="save_user">
                    @if (session('error'))
                        <div class="alert alert-warning" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif
                    {{-- @if ($errors->all())
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
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close" id="btn_close" wire:click="closeModalUser()">Tutup</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')

<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/2.0.2/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.0.2/js/dataTables.bootstrap5.js"></script>
<script>

document.addEventListener('DOMContentLoaded', function() {
    $('#table_user').DataTable({
        ordering: false,
        pageLength: 10,
        info: true,
        lengthChange: true,
        language: {
            lengthMenu: "_MENU_ Data dimuat",
            info: "Menampilkan _START_ hingga _END_ dari total _TOTAL_ data"
        },
        layout: {
            topEnd: 'search'
        },
        rowCallback: function (row, data, index) {
            if (index % 2 === 0) { // Baris genap
                $(row).css('background-color', '#ffffff');
            } else { // Baris ganjil
                $(row).css('background-color', '#f9f9f9');
            }
        }
    });

    window.addEventListener('close-modal-form-user', function() {
        $('#modalFormUser').modal('hide');
        $('#btn_close').click();
    });
    window.addEventListener('render-table', function() {
        setTimeout(function () {
        $('#table_user').html();
        }, 500);
    });
    window.addEventListener('open-notif-success', function() {
        setTimeout(function () {
            alertify.success('Berhasil Disimpan');
        }, 600);
    });
    window.addEventListener('open-notif-success-delete', function() {
        setTimeout(function () {
            alertify.success('Berhasil Dihapus');
        }, 600);
    });
    window.addEventListener('open-modal-form-user', function() {
        setTimeout(function () {
            $('#modalFormUser').modal('show');
        }, 500);
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

    @if (session('success'))
            $('#table_user').html();
            alertify.success("'"+{{ session('success') }}+"'");
    @endif
});

function showModal(){
        $('#modalFormUser').modal('show');
}

</script>
@endpush
</div>
