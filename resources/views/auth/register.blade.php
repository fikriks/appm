@extends('layouts.auth')

@section('title','Daftar')

@section('content')
<div class="card-header"><h4>{{ __("Daftar") }}</h4></div>

<div class="card-body">
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="form-group">
            <label for="nik" class="control-label">{{ __("NIK") }}</label>
            <input aria-describedby="nikHelpBlock" id="nik" type="number" class="form-control @error('nik') is-invalid @enderror" placeholder="{{ __("Nomor Induk Kependudukan") }}" name="nik" tabindex="1" value="{{ old('nik') }}" required autofocus>
            @error('nik')
            <div class="invalid-feedback">
                {{ $message }}
              </div>
            @enderror
          </div>

          <div class="form-group">
            <label for="nama" class="control-label">{{ __("Nama Lengkap") }}</label>
            <input aria-describedby="namaHelpBlock" id="nama" type="text" class="form-control @error('nama') is-invalid @enderror" placeholder="{{ __("Nama Lengkap") }}" name="nama" tabindex="2" value="{{ old('nama') }}" required>
            @error('nama')
            <div class="invalid-feedback">
                {{ $message }}
              </div>
            @enderror
          </div>

          <div class="form-group">
            <label for="telp" class="control-label">{{ __("No Telepon") }}</label>
            <input aria-describedby="telpHelpBlock" id="telp" type="number" class="form-control @error('telp') is-invalid @enderror" placeholder="{{ __("Nomor Telepon") }}" name="telp" tabindex="3" value="{{ old('telp') }}" required>
            @error('telp')
            <div class="invalid-feedback">
                {{ $message }}
              </div>
            @enderror
          </div>

      <div class="form-group">
        <label for="username" class="control-label">{{ __("Username") }}</label>
        <input aria-describedby="usernameHelpBlock" id="username" type="text" class="form-control @error('username') is-invalid @enderror" placeholder="{{ __("Username") }}" name="username" tabindex="4" value="{{ old('username') }}" required>
        @error('username')
        <div class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror
      </div>

      <div class="form-group">
        <label for="password" class="control-label">{{ __("Password") }}</label>
        <input aria-describedby="passwordHelpBlock" id="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="{{ __("Password") }}" name="password" tabindex="5" required>
        @error('password')
        <div class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror
      </div>

      <div class="form-group">
        <label for="password_confirmation" class="control-label">{{ __("Konfirmasi Password") }}</label>
        <input aria-describedby="password_confirmationHelpBlock" id="password_confirmation" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="{{ __("Konfirmasi Password") }}" name="password_confirmation" tabindex="6" required>
        @error('password_confirmation')
        <div class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror
        </div>

      <div class="form-group">
        <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="7">
          {{ __("Register") }}
        </button>
      </div>
    </form>
  </div>
@endsection

@section('page')
<div class="mt-5 text-muted text-center">
    Sudah punya akun? login <a href="{{ route('register') }}">disini</a>
  </div>
@endsection
