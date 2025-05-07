@extends('adminlte::auth.login') {{-- Atau layout master AdminLTE Anda jika tidak menggunakan package --}}

@section('auth_header', __('Login ke Akun Anda')) {{-- Judul di atas form, jika package mendukung --}}

@section('auth_body') {{-- Atau 'content' jika layout master Anda menggunakan section 'content' --}}
    <form action="{{ url('login') }}" method="post">
        @csrf

        {{-- Username field --}}
        <div class="input-group mb-3">
            <input type="username" name="username" class="form-control @error('username') is-invalid @enderror"
                   value="{{ old('username') }}" placeholder="{{ __('Username') }}" autofocus>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                </div>
            </div>
            @error('username')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        {{-- Password field --}}
        <div class="input-group mb-3">
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                   placeholder="{{ __('Password') }}">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                </div>
            </div>
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        {{-- Remember me & Login button --}}
        <div class="row">
            <div class="col-8">
                <div class="icheck-primary"> {{-- Pastikan iCheck atau Bootstrap checkbox styling aktif --}}
                    <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label for="remember">
                        {{ __('Ingat Saya') }}
                    </label>
                </div>
            </div>
            <div class="col-4">
                <button type="submit" class="btn btn-primary btn-block">
                    {{ __('Login') }}
                </button>
            </div>
        </div>
    </form>
@stop

@section('auth_footer') {{-- Atau bagian footer jika package mendukung --}}
    {{-- Forgot password link --}}
    @if (Route::has('password.request'))
        <p class="my-3">
            <a href="{{ route('password.request') }}">
                {{ __('Lupa password Anda?') }}
            </a>
        </p>
    @endif

    {{-- Register link --}}
    @if (Route::has('register'))
        <p class="mb-0">
            <a href="{{ route('register') }}" class="text-center">
                {{ __('Daftar akun baru') }}
            </a>
        </p>
    @endif
@stop