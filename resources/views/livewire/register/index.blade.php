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
                                <h2 class="heading-section text-login fw-bold">Daftar Akun</h2>
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
                                    class="form-control rounded-left  @error('password') is-invalid @enderror"
                                    wire:model.defer="password" placeholder="Password" name="password" id="password" required>
                                <span class="position-absolute" onclick="togglePassword()"
                                    style="top: 50%; right: 10px; transform: translateY(-50%); cursor: pointer;">
                                    <i id="toggleIcon" class="fas fa-eye"></i>
                                </span>
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

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        window.togglePassword = function () {
            const input = document.getElementById("password");
            const icon = document.getElementById("toggleIcon");

            if (!input) return console.error("Password input not found");

            if (input.type === "password") {
                input.type = "text";
                icon.classList.remove("fa-eye");
                icon.classList.add("fa-eye-slash");
            } else {
                input.type = "password";
                icon.classList.remove("fa-eye-slash");
                icon.classList.add("fa-eye");
            }
        }
    });
</script>
@endpush

