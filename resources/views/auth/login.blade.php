@extends('layouts.app')

@section('content')
<div class="bglogin d-flex align-items-center justify-content-center" style="min-height: 80vh; padding: 20px 0;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                
                <div class="card shadow border-0" style="border-radius: 15px;">
                    {{-- Header --}}
                    <div class="bgteks login p-4 pb-0 text-center">
                        <h4 class="fw-bold mb-1">Login Akun</h4>
                        <p class="text-muted small">Masuk untuk melanjutkan</p>
                    </div>

                    {{-- Body --}}
                    <div class="card-body p-4">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            {{-- Email --}}
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Email</label>
                                <input
                                    type="email"
                                    name="email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    value="{{ old('email') }}"
                                    placeholder="nama@email.com"
                                    required
                                    autofocus
                                    style="border-radius: 8px;"
                                >
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Password --}}
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Password</label>
                                <input
                                    type="password"
                                    name="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    placeholder="••••••••"
                                    required
                                    style="border-radius: 8px;"
                                >
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Remember & Forgot Password --}}
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember">
                                    <label class="form-check-label small" for="remember">
                                        Ingat Saya
                                    </label>
                                </div>

                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}" class="small text-decoration-none">
                                        Lupa Password?
                                    </a>
                                @endif
                            </div>

                            {{-- Button Login --}}
                            <div class="d-grid mb-3">
                                <button class="btn btn-primary btn-lg fw-bold" style="border-radius: 8px; background-color: #c94c4c; border: none;">
                                    Login
                                </button>
                            </div>

                            {{-- Divider --}}
                            <div class="position-relative my-4">
                                <hr class="text-muted">
                                <span class="position-absolute top-50 start-50 translate-middle bg-white px-2 small text-muted">atau</span>
                            </div>

                            {{-- Google Login --}}
                            <div class="d-grid mb-4">
                                <a href="{{ route('auth.google') }}" class="btn btn-outline-secondary py-2" style="border-radius: 8px;">
                                    <img
                                        src="https://www.svgrepo.com/show/475656/google-color.svg"
                                        width="20"
                                        class="me-2"
                                        alt="Google Icon"
                                    >
                                    <span class="small fw-semibold">Login dengan Google</span>
                                </a>
                            </div>

                            {{-- Register --}}
                            <p class="text-center mb-0 small">
                                Belum punya akun?
                                <a href="{{ route('register') }}" class="fw-bold text-decoration-none" style="color: #c94c4c;">
                                    Daftar Sekarang
                                </a>
                            </p>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection