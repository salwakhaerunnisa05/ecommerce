@extends('layouts.app')

@section('content')
<div class="container min-vh-100 d-flex align-items-center justify-content-center">
    <div class="col-md-6 col-lg-5">

        <div class="card shadow border-0">
            {{-- Header --}}
            <div class="card-header bg-primary text-white text-center py-3">
                <h4 class="mb-0">🔐 Login Akun</h4>
                <small>Masuk untuk melanjutkan</small>
            </div>

            {{-- Body --}}
            <div class="card-body p-4">
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    {{-- Email --}}
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input
                            type="email"
                            name="email"
                            class="form-control @error('email') is-invalid @enderror"
                            value="{{ old('email') }}"
                            placeholder="nama@email.com"
                            required
                            autofocus
                        >
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Password --}}
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input
                            type="password"
                            name="password"
                            class="form-control @error('password') is-invalid @enderror"
                            placeholder="••••••••"
                            required
                        >
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Remember --}}
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember">
                            <label class="form-check-label" for="remember">
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
                        <button class="btn btn-primary btn-lg">
                            Login
                        </button>
                    </div>

                    {{-- Divider --}}
                    <div class="text-center text-muted my-3">
                        <small>atau</small>
                    </div>

                    {{-- Google Login --}}
                    <div class="d-grid mb-3">
                        <a href="{{ route('auth.google') }}" class="btn btn-outline-danger">
                            <img
                                src="https://www.svgrepo.com/show/475656/google-color.svg"
                                width="20"
                                class="me-2"
                            >
                            Login dengan Google
                        </a>
                    </div>

                    {{-- Register --}}
                    <p class="text-center mb-0">
                        Belum punya akun?
                        <a href="{{ route('register') }}" class="fw-bold text-decoration-none">
                            Daftar Sekarang
                        </a>
                    </p>
                </form>
            </div>
        </div>

    </div>
</div>
@endsection
