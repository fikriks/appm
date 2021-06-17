@extends('layouts.admin')

@section('title','Edit Masyarakat '.$masyarakat->nama)

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Edit Masyrakat</h1>
        <div class="section-header-breadcrumb">
            {{  Breadcrumbs::render('admin.masyarakat.edit',$masyarakat)  }}
        </div>
    </div>
    <div class="section-body">
       <div class="row">
           <div class="col-12">
               <div class="card">
                   <div class="card-header">
                       <h4>Edit {{ $masyarakat->nama }}</h4>
                   </div>
                   <div class="card-body">
                       <form method="POST" action="{{ route('admin.masyarakat.update',['masyarakat' => $masyarakat]) }}">
                        @csrf
                        @method('PUT')
                       <div class="form-group row mb-4">
                           <label for="nik" class="col-form-label text-md-right col-12 col-md-3 col-lg-3">NIK <span class="text-danger">*</span></label>
                           <div class="col-sm-12 col-md-7">
                               <input type="number" minlength="16" maxlength="16" id="nik" name="nik" class="form-control @error('nik') is-invalid @enderror" placeholder="Nomor Induk Kependudukan" value="{{ $masyarakat->nik }}" autocomplete="off">
                               @error('nik')
                               <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                               @enderror
                           </div>
                       </div>
                       <div class="form-group row mb-4">
                        <label for="nama" class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nama Lengkap <span class="text-danger">*</span></label>
                        <div class="col-sm-12 col-md-7">
                            <input type="text" id="nama" name="nama" class="form-control @error('nama') is-invalid @enderror" placeholder="Nama Lengkap" value="{{ $masyarakat->nama }}" autocomplete="off">
                            @error('nama')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label for="username" class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Username <span class="text-danger">*</span></label>
                        <div class="col-sm-12 col-md-7">
                            <input type="text" id="username" name="username" class="form-control @error('username') is-invalid @enderror" placeholder="Username" value="{{ $masyarakat->username }}" autocomplete="off">
                            @error('username')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label for="telp" class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nomor Telepon <span class="text-danger">*</span></label>
                        <div class="col-sm-12 col-md-7">
                            <input type="number" minlength="10" maxlength="13" id="telp" name="telp" class="form-control @error('telp') is-invalid @enderror" placeholder="Nomor Telepon" value="{{ $masyarakat->telp }}" autocomplete="off">
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
                    <h4>Edit Password {{ $masyarakat->nama }}</h4>
                </div>
                <div class="card-body">
                 <form method="POST" action="{{ route('admin.masyarakat.update',['masyarakat' => $masyarakat]) }}" class="needs-validation">
                     @csrf
                     @method('PUT')
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
