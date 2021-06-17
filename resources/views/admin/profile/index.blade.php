@extends('layouts.admin')

@section('title','Profil Saya')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Profil</h1>
        <div class="section-header-breadcrumb">
            @unlessrole('admin|petugas')
            {{  Breadcrumbs::render('admin.profiles', auth('masyarakat')->user()->nama)  }}
            @else
            {{  Breadcrumbs::render('admin.profiles',Auth::user()->nama_petugas)  }}
            @endunlessrole
        </div>
    </div>

    <div class="section-body">
       <div class="row">
           <div class="col-12">
               <div class="card">
                   <div class="card-header">
                       <h4>Edit Informasi Profil</h4>
                   </div>
                   <div class="card-body">
                    <form method="POST" action="{{ route('profiles.update', ['profile' => Auth::guard('web')->check() ? Auth::user() : auth('masyarakat')->user() ]) }}">
                        @csrf
                        @method('PUT')
                        @unlessrole('admin|petugas')
                        <div class="form-group row mb-4">
                            <label for="nik" class="col-form-label text-md-right col-12 col-md-3 col-lg-3">NIK <span class="text-danger">*</span></label>
                            <div class="col-sm-12 col-md-7">
                                <input type="text" id="nik" name="nik" class="form-control @error('nik') is-invalid @enderror" placeholder="Nomor Induk Penduduk" autocomplete="off" value="{{ auth('masyarakat')->user()->nik }}">
                                @error('nik')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        @endunlessrole
                        @role('admin|petugas')
                    <div class="form-group row mb-4">
                        <label for="nama_petugas" class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nama Petugas <span class="text-danger">*</span></label>
                        <div class="col-sm-12 col-md-7">
                            <input type="text" id="nama_petugas" name="nama_petugas" class="form-control @error('nama_petugas') is-invalid @enderror" placeholder="Nama" autocomplete="off" value="@if(Auth::guard('web')->check()) {{ Auth::user()->nama_petugas }} @else {{ auth('masyarakat')->user()->nama }} @endif">
                            @error('nama_petugas')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    @endrole
                    @unlessrole('admin|petugas')
                    <div class="form-group row mb-4">
                        <label for="nama" class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nama <span class="text-danger">*</span></label>
                        <div class="col-sm-12 col-md-7">
                            <input type="text" id="nama" name="nama" class="form-control @error('nama') is-invalid @enderror" placeholder="Nama" autocomplete="off" value="@if(Auth::guard('web')->check()) {{ Auth::user()->nama }} @else {{ auth('masyarakat')->user()->nama }} @endif">
                            @error('nama')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                        @endunlessrole
                    <div class="form-group row mb-4">
                        <label for="username" class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nama Pengguna <span class="text-danger">*</span></label>
                        <div class="col-sm-12 col-md-7">
                            <input type="text" id="username" name="username" class="form-control @error('username') is-invalid @enderror" placeholder="Nama Pengguna" autocomplete="off" value="@if(Auth::guard('web')->check()) {{ Auth::user()->username }} @else {{ auth('masyarakat')->user()->username }} @endif" disabled>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label for="telp" class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nomor Telepon <span class="text-danger">*</span></label>
                        <div class="col-sm-12 col-md-7">
                            <input type="text" id="telp" name="telp" class="form-control @error('telp') is-invalid @enderror" placeholder="Nomor Telepon" autocomplete="off" value="@if(Auth::guard('web')->check()) {{ Auth::user()->telp }} @else {{ auth('masyarakat')->user()->telp }} @endif">
                            @error('telp')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-grup row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                        <div class="col-sm-12 col-md-7">
                            <button type="submit" class="btn btn-primary">Edit</button>
                        </div>
                    </div>
                    </form>
                   </div>
               </div>
           </div>
           <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Edit Password</h4>
                </div>
                <div class="card-body">
                 <form method="POST" action="{{ route('profiles.update', ['profile' => Auth::guard('web')->check() ? Auth::user() : auth('masyarakat')->user() ]) }}">
                     @csrf
                     @method('PUT')
                     <div class="form-group row mb-4">
                        <label for="current_password" class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Password Sekarang <span class="text-danger">*</span></label>
                        <div class="col-sm-12 col-md-7">
                            <input type="password" id="current_password" name="current_password" class="form-control @error('current_password') is-invalid @enderror" placeholder="Password Sekarang">
                            @error('current_password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                     <div class="form-group row mb-4">
                        <label for="password" class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Password <span class="text-danger">*</span></label>
                        <div class="col-sm-12 col-md-7">
                            <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password">
                            @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label for="password_confirmation" class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Konfirmasi Password <span class="text-danger">*</span></label>
                        <div class="col-sm-12 col-md-7">
                            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="Konfirmasi Password">
                            @error('password_confirmation')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                 <div class="form-grup row mb-4">
                     <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                     <div class="col-sm-12 col-md-7">
                         <button type="submit" class="btn btn-primary">Edit</button>
                     </div>
                 </div>
                 </form>
                </div>
            </div>
        </div>
       </div>
    </div>
</section>
@endsection
