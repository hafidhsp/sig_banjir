<div>
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-6">
                    <div class="login-wrap  p-md-4">
                        <div class="icon d-flex align-items-center justify-content-center">
                            <span class="fa fa-user-o"></span>
                        </div>
                        <form wire:submit.prevent="tambah_akun" class="login-form">
                            <div class="d-flex align-items-center justify-content-center p-3">
                                <h2 class="heading-section text-login fw-bold">Masuk</h2>
                            </div>
                            @if (session('error'))
                                <div class="alert alert-warning" role="alert">
                                    {{ session('error') }}
                                </div>
                            @endif
                            <div class="form-group">
                                <input type="text"
                                    class="form-control rounded-left  @error('nama_lengkap') is-invalid @enderror"
                                    wire:model.defer="nama_lengkap" placeholder="Nama Lengkap" name="nama_lengkap"
                                    required>
                                @error('nama_lengkap')
                                    <label class="text-danger">{{ $message }}</label>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="email"
                                    class="form-control rounded-left  @error('email') is-invalid @enderror"
                                    wire:model.defer="email" placeholder="Email" name="email" required>
                                @error('email')
                                    <label class="text-danger">{{ $message }}</label>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="password"
                                    class="form-control rounded-left  @error('email') is-invalid @enderror"
                                    wire:model.defer="password" placeholder="Password" name="password" required>
                                @error('password')
                                    <label class="text-danger">{{ $message }}</label>
                                @enderror
                            </div>
                            <div class="form-group d-md-flex">
                                <div class="w-100 text-md-left">
                                    <a href="{{ url('') }}">Kembali</a>
                                </div>
                                <div class="w-100 text-md-right">
                                    <a href="{{ url('/login') }}">Masuk</a>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary rounded submit p-3 px-5">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
