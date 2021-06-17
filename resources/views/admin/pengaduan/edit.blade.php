@extends('layouts.admin')

@section('title','Edit Pengaduan')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Edit Pengaduan</h1>
        <div class="section-header-breadcrumb">
            @unlessrole('admin|petugas')
            {{  Breadcrumbs::render('masyarakat.pengaduan.edit',$pengaduan)  }}
            @else
            {{  Breadcrumbs::render('admin.pengaduan.edit',$pengaduan)  }}
            @endunlessrole
        </div>
    </div>
    <div class="section-body">
       <div class="row">
           <div class="col-12">
               <div class="card">
                   <div class="card-header">
                       <h4>Edit Pengaduan</h4>
                   </div>
                   <div class="card-body">
                    <form method="POST" action="@if(Auth::guard('web')->check()) {{ route('admin.pengaduan.update',['pengaduan' => $pengaduan]) }} @else {{ route('masyarakat.pengaduan.update',['pengaduan' => $pengaduan]) }} @endif">
                        @csrf
                        @method('PUT')
                        @unlessrole('admin|petugas')
                        <div class="form-group row mb-4">
                            <label for="judul_laporan" class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Judul Laporan <span class="text-danger">*</span></label>
                            <div class="col-sm-12 col-md-7">
                                <input type="text" id="judul_laporan" name="judul_laporan" class="form-control @error('judul_laporan') is-invalid @enderror" placeholder="Judul Laporan Pengaduan" autocomplete="off" value="{{ $pengaduan->judul_laporan }}">
                                @error('judul_laporan')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    <div class="form-group row mb-4">
                        <label for="isi_laporan" class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Isi Laporan <span class="text-danger">*</span></label>
                        <div class="col-sm-12 col-md-7">
                            <textarea id="isi_laporan" name="isi_laporan" class="form-control @error('isi_laporan') is-invalid @enderror" placeholder="Isi Laporan Pengaduan" autocomplete="off">{{ $pengaduan->isi_laporan }}</textarea>
                            @error('isi_laporan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                       <div class="form-group row mb-4">
                           <label for="foto" class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Foto</label>
                           <div class="col-sm-12 col-md-7">
                               <img src="{{ Storage::url('pengaduan/'.$pengaduan->foto) }}" alt="{{ $pengaduan->foto }}" class="img-fluid" width="200">
                               <input type="file" id="foto" name="foto" class="form-control @error('foto') is-invalid @enderror" accept="image/*">
                               @error('foto')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                               @enderror
                           </div>
                       </div>
                       @else
                       <div class="form-group row mb-4">
                        <label for="status" class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Status <span class="text-danger">*</span></label>
                        <div class="col-sm-12 col-md-7">
                            <select name="status" id="status" class="form-control @error('status') is-invalid @enderror">
                                <option value="proses" {{ old('status') == 'proses' ? 'selected' : '' }}>Proses</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    @endunlessrole
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

