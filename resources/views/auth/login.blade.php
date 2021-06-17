@extends('layouts.auth')

@section('title','Login')

@section('content')
<div class="card-header"><h4>{{ __("Login") }}</h4></div>

<div class="card-body">
    @if(session('errors'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
            </ul>
        </div>
    @endif
    @if (Session::has('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
    @endif
    @if (Session::has('error'))
        <div class="alert alert-danger">
            {{ Session::get('error') }}
        </div>
    @endif
    <form method="POST" action="{{ route('login') }}">
        @csrf
      <div class="form-group">
        <label for="username" class="control-label">{{ __("Username") }}</label>
        <input aria-describedby="usernameHelpBlock" id="username" type="text" class="form-control @error('username') is-invalid @enderror" placeholder="{{ __("Username") }}" name="username" tabindex="1" required autofocus>
        @error('username')
        <div class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror
      </div>

      <div class="form-group">
        <label for="password" class="control-label">{{ __("Password") }}</label>
        <input aria-describedby="passwordHelpBlock" id="password" type="password" class="form-control @error('username') is-invalid @enderror" placeholder="{{ __("Password") }}" name="password" tabindex="2" required>
        @error('password')
        <div class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror
      </div>

      <div class="form-group">
        <div class="custom-control custom-checkbox">
          <input type="checkbox" name="remember" class="custom-control-input" tabindex="3" id="remember" {{ old('remember') ? ' checked': '' }}>
          <label class="custom-control-label" for="remember">{{ __("Remember Me") }}</label>
        </div>
      </div>

      <div class="form-group">
        <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
          {{ __("Login") }}
        </button>
      </div>
    </form>
  </div>
@endsection

@section('page')
<div class="mt-5 text-muted text-center">
    Belum punya akun? daftar <a href="{{ route('register') }}">disini</a>
  </div>
@endsection
