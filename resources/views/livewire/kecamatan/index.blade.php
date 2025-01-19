<div>
       <div class="content-wrapper">
         <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-header row">
                    <div class="col-md-6">
                        <h2 >Data Kecamtan</h2>
                        <p class="card-description">
                            Dashboard /<code>Data Kecamatan</code>
                        </p>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn btn-outline-primary btn-icon-text mt-3" onclick="showModal()">
                            <i class="mdi mdi-account-plus"></i>
                            Tambah Kecataman
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive pt-3">
                            <table class="table table-bordered table-hover" id="table_kecamatan">
                            <thead>
                                <tr>
                                <th class="text-center bg-primary">
                                    No
                                </th>
                                <th class="bg-primary">
                                    Nama Kecamatan
                                </th>
                                <th class="bg-primary">
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
                                <td align="center">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-outline-secondary dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="bi bi-hand-index-thumb"></i> Aksi</button>
                                    <div class="dropdown-menu" x-placement="top-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, -104px, 0px);">
                                    <button type="button" class="dropdown-item text-danger"  wire:click="show_delete_kecamatan('{{ $kecamatan->id }}')"><i class="bi bi-trash3"></i> Hapus</button>
                                    <button type="button" class="dropdown-item text-primary" wire:click="showModalKecamatan({{ $kecamatan->id }})"><i class="bi bi-pencil-square"></i> Ubah</button>
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
         <!-- Modal Kecamatan -->
    <div class="modal fade"  tabindex="-1" aria-hidden="true" id="modalFormKecamatan" data-bs-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title" id="staticBackdropLabel" style="font-size: 20px">{{ $title_modal }} Data Kecamatan</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" wire:click="closeModalKecamatan()"></button>
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
                        <input type="text" class="form-control @error('nama_kecamatan') is-invalid @enderror" wire:model.defer="nama_kecamatan" required>
                        @error('nama_kecamatan')
                            <label class="text-danger">{{ $message }}</label>
                        @enderror
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close" id="btn_close" wire:click="closeModalKecamatan()">Tutup</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
                </form>
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
    $('#table_kecamatan').DataTable({
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

    window.addEventListener('close-modal-form-kecamatan', function() {
        $('#modalFormKecamatan').modal('hide');
        $('#btn_close').click();
        setTimeout(function () {
        $('#table_kecamatan').html();
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
    window.addEventListener('open-modal-form-kecamatan', function() {
        setTimeout(function () {
            $('#modalFormKecamatan').modal('show');
        }, 500);
    });
    window.addEventListener('render-table', function() {
        setTimeout(function () {
        $('#table_kecamatan').html();
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
});

function showModal(){
        $('#modalFormKecamatan').modal('show');
}

</script>
@endpush

</div>
