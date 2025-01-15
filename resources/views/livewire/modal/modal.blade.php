<div>
     <!-- Modal User -->
<div class="modal fade" id="modalUser"  tabindex="-1" aria-hidden="true" >
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title" id="staticBackdropLabel" style="font-size: 20px">User</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="forms-sample" wire:submit.prevent="ubah_akun">
             @if (session('error'))
                <div class="alert alert-warning" role="alert">
                    {{ session('error') }}
                </div>
            @endif
            @foreach ($errors->all() as $error)
                <div class="alert alert-warning" role="alert">
                    {{ $error }}
                </div>
            @endforeach
            @if (session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif
            <input type="text" class="form-control  @error('id') is-invalid @enderror" wire:model.defer="id" id="exampleInputUsername1" required hidden>
            <div class="form-group">
                <label for="exampleInputEmail1">Email</label>
                <input type="email" class="form-control" wire:model.defer="email" readonly>
            </div>
            <div class="form-group">
                <label for="exampleInputUsername1">Nama Lengkap</label>
                <input type="text" class="form-control  @error('nama_lengkap') is-invalid @enderror" wire:model.defer="nama_lengkap" id="exampleInputUsername1" placeholder="Nama Lengkap" required>
                @error('nama_lengkap')
                    <label class="text-danger">{{ $message }}</label>
                @enderror
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" wire:model.defer="password">
            </div>
            <div class="form-group">
                <label for="exampleInputConfirmPassword1">Ulangi Password</label>
                <input type="password" class="form-control" id="exampleInputConfirmPassword1" placeholder="Password" wire:model.defer="confirm_password">
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="closeModalUser()">Tutup</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
      </div>
        </form>
    </div>
  </div>
</div>
    @push('scripts')
    <script>
        function openModalUser(){
             var modal = new bootstrap.Modal(document.getElementById('modalUser'));
             modal.show();
        }
        function closeModalUser(){
             var modal = new bootstrap.Modal(document.getElementById('modalUser'));
             modal.hide();
        }

        document.addEventListener('DOMContentLoaded', function() {
            window.addEventListener('open-modal-user', function() {
                    openModalUser();
            });
        });


    </script>
    @endpush

</div>
