@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-6">

      <div class="card shadow-sm">
        <div class="card-header bg-primary text-white text-center">
          <h4 class="mb-0">📝 Daftar Akun Baru</h4>
        </div>

        <div class="card-body p-4">
          <form method="POST" action="{{ route('register') }}">
            @csrf

            {{-- NAMA --}}
            <div class="mb-3">
              <label for="name" class="form-label">Nama Lengkap</label>
              <input id="name" type="text"
                class="form-control @error('name') is-invalid @enderror"
                name="name" value="{{ old('name') }}" required autofocus>

              @error('name')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            {{-- EMAIL --}}
            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input id="email" type="email"
                class="form-control @error('email') is-invalid @enderror"
                name="email" value="{{ old('email') }}" required>

              @error('email')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            {{-- PASSWORD --}}
            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <input id="password" type="password"
                class="form-control @error('password') is-invalid @enderror"
                name="password" required>

              @error('password')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            {{-- KONFIRMASI PASSWORD --}}
            <div class="mb-3">
              <label for="password-confirm" class="form-label">
                Konfirmasi Password
              </label>
              <input id="password-confirm" type="password"
                class="form-control"
                name="password_confirmation" required>
            </div>

            {{-- BUTTON REGISTER --}}
            <div class="d-grid gap-2">
              <button type="submit" class="btn btn-primary btn-lg">
                Register
              </button>
            </div>

            {{-- DIVIDER --}}
            <div class="position-relative my-4">
              <hr>
              <span class="position-absolute top-50 start-50 translate-middle bg-white px-3 text-muted">
                atau daftar dengan
              </span>
            </div>

            {{-- GOOGLE REGISTER --}}
            <div class="d-grid gap-2">
              <a href="{{ route('auth.google') }}" class="btn btn-outline-danger btn-lg">
                <svg class="me-2" width="20" height="20" viewBox="0 0 24 24">
                  <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                  <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                  <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22z"/>
                  <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                </svg>
                Daftar dengan Google
              </a>
            </div>

            {{-- LINK LOGIN --}}
            <p class="mt-4 text-center mb-0">
              Sudah punya akun?
              <a href="{{ route('login') }}" class="fw-bold text-decoration-none">
                Login
              </a>
            </p>

          </form>
        </div>
      </div>

    </div>
  </div>
</div>
@endsection
