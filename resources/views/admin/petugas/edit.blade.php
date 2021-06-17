@extends('layouts.admin')

@section('title','Edit Petugas')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Edit Petugas</h1>
        <div class="section-header-breadcrumb">
            {{  Breadcrumbs::render('admin.petugas.edit',$petuga)  }}
        </div>
    </div>
    <div class="section-body">
       <div class="row">
           <div class="col-12">
               <div class="card">
                   <div class="card-header">
                       <h4>Edit Petugas</h4>
                   </div>
                   <div class="card-body">
                    <form method="POST" action="{{ route('admin.petugas.update',['petuga' => $petuga]) }}">
                        @csrf
                        @method('PUT')
                    <div class="form-group row mb-4">
                        <label for="nama_petugas" class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nama Petugas <span class="text-danger">*</span></label>
                        <div class="col-sm-12 col-md-7">
                            <input type="text" id="nama_petugas" name="nama_petugas" class="form-control @error('nama_petugas') is-invalid @enderror" placeholder="Nama" autocomplete="off" value="{{ $petuga->nama_petugas }}">
                            @error('nama_petugas')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label for="username" class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nama Pengguna <span class="text-danger">*</span></label>
                        <div class="col-sm-12 col-md-7">
                            <input type="text" id="username" name="username" class="form-control @error('username') is-invalid @enderror" placeholder="Nama Pengguna" autocomplete="off" value="{{ $petuga->username }}">
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
                            <input type="number" id="telp" name="telp" class="form-control @error('telp') is-invalid @enderror" placeholder="Nomor Telepon" autocomplete="off" value="{{ $petuga->telp }}">
                            @error('telp')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label for="role" class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Hak Akses <span class="text-danger">*</span></label>
                        <div class="col-sm-12 col-md-7">
                            <select name="role" id="role" class="form-control @error('role') is-invalid @enderror select2">
                                @forelse ($roles as $role)
                                <option value="{{ $role->id }}" {{ $petuga->roles[0]->id == $role->id ? 'selected' : '' }}>{{ ucfirst($role->name) }}</option>
                                @empty
                                <option disabled>Tidak ada data</option>
                                @endforelse
                            </select>
                            @error('role')
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
                    <h4>Edit Password Pengguna</h4>
                </div>
                <div class="card-body">
                 <form method="POST" action="{{ route('admin.petugas.update',['petuga' => $petuga]) }}">
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
