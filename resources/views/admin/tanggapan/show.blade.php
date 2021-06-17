@extends('layouts.admin')

@section('title','Detail Tanggapan')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Detail Tanggapan</h1>
        <div class="section-header-breadcrumb">
            {{  Breadcrumbs::render('admin.tanggapan.show',$tanggapan)  }}
        </div>
    </div>
    <div class="section-body">
       <div class="row">
           <div class="col-12">
               <div class="card">
                   <div class="card-header">
                       <h4>Detail Tanggapan</h4>
                   </div>
                   <div class="card-body">
                    <form>
                        <div class="form-group row mb-4">
                            <label for="pengaduan" class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Judul Laporan</label>
                            <div class="col-sm-12 col-md-7">
                                <input type="text" class="form-control" id="pengaduan" placeholder="Judul Laporan" value="{{ $tanggapan->pengaduan->judul_laporan }}" disabled>
                            </div>
                        </div>
                    <div class="form-group row mb-4">
                        <label for="tanggapan" class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Tanggapan</label>
                        <div class="col-sm-12 col-md-7">
                            <textarea id="tanggapan" name="tanggapan" class="form-control" placeholder="Isi Tanggapan" autocomplete="off" disabled>{{ $tanggapan->tanggapan }}</textarea>
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
