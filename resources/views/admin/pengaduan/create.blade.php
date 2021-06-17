@extends('layouts.admin')

@section('title','Tambah Pengaduan')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Tambah Pengaduan</h1>
        <div class="section-header-breadcrumb">
            {{  Breadcrumbs::render('masyarakat.pengaduan.create')  }}
        </div>
    </div>
    <div class="section-body">
       <div class="row">
           <div class="col-12">
               <div class="card">
                   <div class="card-header">
                       <h4>Tambah Pengaduan</h4>
                   </div>
                   <div class="card-body">
                    <form method="POST" action="{{ route('masyarakat.pengaduan.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row mb-4">
                            <label for="judul_laporan" class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Judul Laporan <span class="text-danger">*</span></label>
                            <div class="col-sm-12 col-md-7">
                                <input type="text" id="judul_laporan" name="judul_laporan" class="form-control @error('judul_laporan') is-invalid @enderror" placeholder="Judul Laporan Pengaduan" autocomplete="off" value="{{ old('judul_laporan') }}">
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
                            <textarea id="isi_laporan" name="isi_laporan" rows="10" style="height:100%;" class="form-control @error('isi_laporan') is-invalid @enderror" placeholder="Isi Laporan Pengaduan" autocomplete="off">{{ old('isi_laporan') }}</textarea>
                            @error('isi_laporan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                       <div class="form-group row mb-4">
                           <label for="foto" class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Foto <span class="text-danger">*</span></label>
                           <div class="col-sm-12 col-md-7">
                               <input type="file" id="foto" name="foto" class="form-control @error('foto') is-invalid @enderror" accept="image/*" capture="user">
                               @error('foto')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                               @enderror
                               <div class="form-text text-muted">Ukuran maksimum file 1MB</div>
                           </div>
                       </div>
                    <div class="form-grup row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                        <div class="col-sm-12 col-md-7">
                            <button type="submit" class="btn btn-primary">Tambah</button>
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
