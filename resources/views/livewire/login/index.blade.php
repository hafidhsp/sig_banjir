<div>
    <section class="ftco-section">
        {{-- <section class=""> --}}
        <div class="container">
            {{-- <div class="row justify-content-center">
                <div class="col-md-6 text-center mb-5">
                </div>
            </div> --}}
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-6">
                    <div class="login-wrap  p-md-4">
                        <div class="icon d-flex align-items-center justify-content-center">
                            <span class="fa fa-user-o"></span>
                        </div>
                        <form wire:submit.prevent="auth_login" class="login-form">
                            <div class="d-flex align-items-center justify-content-center p-3">
                                <h2 class="heading-section text-login fw-bold">Masuk</h2>
                            </div>
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
                                <input id="email" type="email" wire:model.defer="email" name="email"
                                    class="form-control rounded-left @error('email') is-invalid @enderror"
                                    placeholder="Email" required>
                                @error('email')
                                    <label class="text-danger">{{ $message }}</label>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input id="password" type="password" wire:model.defer="password" name="password"
                                    class="form-control rounded-left @error('password') is-invalid @enderror"
                                    placeholder="Password" required>
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
                                    <a href="{{ url('/register') }}">Daftar Akun</a>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary rounded submit p-3 px-5">Masuk</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

@push('scripts')
    <script>
        const emailInput = document.getElementById('email');
        if (emailInput) {
            emailInput.focus();
        }

        function togglePassword() {
            const input = document.getElementById("password");
            const icon = document.getElementById("toggleIcon");

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
    </script>
@endpush
</div>
