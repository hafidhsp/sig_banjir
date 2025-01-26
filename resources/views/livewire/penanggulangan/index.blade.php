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
                <div class="card-body" id="bagian_table">
                    <div class="table-responsive pt-3">
                            <table class="table table-bordered table-hover" id="table_penanggulangan">
                            <thead>
                                <tr>
                                <th class="text-center bg-primary">
                                    No
                                </th>
                                <th class="bg-primary">
                                    Nama Penanggulangan
                                </th>
                                <th class="bg-primary">
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
                                    {{ $penanggulangan->nama_penanggulangan }}
                                </td>
                                <td align="center">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-outline-secondary dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="bi bi-hand-index-thumb"></i> Aksi</button>
                                    <div class="dropdown-menu" x-placement="top-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, -104px, 0px);">
                                    <button type="button" class="dropdown-item text-danger"  wire:click="show_delete_kecamatan('{{ $kecamatan->id_penanggulangan }}')"><i class="bi bi-trash3"></i> Hapus</button>
                                    <button type="button" class="dropdown-item text-primary" wire:click="showModalKecamatan({{ $kecamatan->id_penanggulangan }})"><i class="bi bi-pencil-square"></i> Ubah</button>
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
</div>
