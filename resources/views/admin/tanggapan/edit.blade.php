@extends('layouts.admin')

@section('title','Edit Tanggapan')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Edit Tanggapan</h1>
        <div class="section-header-breadcrumb">
            {{  Breadcrumbs::render('admin.tanggapan.edit',$tanggapan)  }}
        </div>
    </div>
    <div class="section-body">
       <div class="row">
           <div class="col-12">
               <div class="card">
                   <div class="card-header">
                       <h4>Edit Tanggapan</h4>
                   </div>
                   <div class="card-body">
                    <form method="POST" action="{{ route('admin.tanggapan.update',['tanggapan' => $tanggapan]) }}">
                        @csrf
                        @method('PUT')
                        <div class="form-group row mb-4">
                            <label for="pengaduan" class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Judul Laporan <span class="text-danger">*</span></label>
                            <div class="col-sm-12 col-md-7">
                               <select name="pengaduan" class="form-control @error('pengaduan') is-invalid @enderror" id="pengaduan" disabled>
                                   @forelse ($pengaduan as $p)
                                       <option value="{{ $p->id }}" {{ $p->id == $tanggapan->pengaduan_id ? 'selected' : '' }}>{{ $p->judul_laporan }}</option>
                                   @empty
                                    <option value="">Tidak ada data</option>
                                   @endforelse
                               </select>
                                @error('pengaduan')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    <div class="form-group row mb-4">
                        <label for="tanggapan" class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Tanggapan <span class="text-danger">*</span></label>
                        <div class="col-sm-12 col-md-7">
                            <textarea id="tanggapan" name="tanggapan" class="form-control @error('tanggapan') is-invalid @enderror" placeholder="Isi Tanggapan" autocomplete="off">{{ $tanggapan->tanggapan }}</textarea>
                            @error('tanggapan')
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
