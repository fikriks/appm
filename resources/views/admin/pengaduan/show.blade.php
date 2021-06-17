@extends('layouts.admin')

@section('title','Detail Pengaduan '.$pengaduan->judul_laporan)

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Detail Pengaduan</h1>
        <div class="section-header-breadcrumb">
            @unlessrole('admin|petugas')
                {{  Breadcrumbs::render('masyarakat.pengaduan.show',$pengaduan)  }}
            @else
                {{  Breadcrumbs::render('admin.pengaduan.show',$pengaduan)  }}
            @endunlessrole
        </div>
    </div>
    <div class="section-body">
       <div class="row">
           <div class="col-12">
               <div class="card">
                   <div class="card-header">
                       <h4>Detail Pengaduan</h4>
                   </div>
                   <div class="card-body">
                    <form>
                        <div class="form-group row mb-4">
                            <label for="tgl_laporan" class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Tanggal Pengaduan</label>
                            <div class="col-sm-12 col-md-7">
                                <input type="text" id="tgl_laporan" name="tgl_laporan" class="form-control" placeholder="Tanggal Laporan Pengaduan" value="{{ \Carbon\Carbon::parse($pengaduan->tgl_pengaduan)->isoFormat('dddd, D MMMM Y') }}" disabled>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label for="judul_laporan" class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Judul Laporan</label>
                            <div class="col-sm-12 col-md-7">
                                <input type="text" id="judul_laporan" name="judul_laporan" class="form-control" placeholder="Judul Laporan Laporan" value="{{ $pengaduan->judul_laporan }}" disabled>
                            </div>
                        </div>
                    <div class="form-group row mb-4">
                        <label for="isi_laporan" class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Isi Laporan</label>
                        <div class="col-sm-12 col-md-7">
                            <textarea id="isi_laporan" name="isi_laporan" class="form-control" placeholder="Isi Laporan Pengaduan" disabled>{{ $pengaduan->isi_laporan }}</textarea>
                        </div>
                    </div>
                       <div class="form-group row mb-4">
                           <label for="foto" class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Foto</label>
                           <div class="col-sm-12 col-md-7">
                               <img src="{{ Storage::url('pengaduan/'.$pengaduan->foto) }}" alt="{{ $pengaduan->foto }}" class="img-fluid" width="200">
                           </div>
                       </div>
                       <div class="form-group row mb-4">
                        <label for="status" class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Status</label>
                        <div class="col-sm-12 col-md-7">
                            @if($pengaduan->status == '0')
                            <p><span class="badge badge-primary">Ditinjau</span></p>
                           @elseif($pengaduan->status == 'proses')
                            <p><span class="badge badge-warning">{{ ucfirst($pengaduan->status) }}</span></p>
                           @elseif($pengaduan->status == 'selesai')
                            <p><span class="badge badge-success">{{ ucfirst($pengaduan->status) }}</span></p>
                           @endif
                        </div>
                    </div>
                    </form>
                   </div>
               </div>
           </div>
           <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Tanggapan</h4>
                </div>
                <div class="card-body">
                    @if ($pengaduan->status == '0')
                    <strong>Harap bersabar, pengaduan masih ditinjau</strong>
                    @elseif($pengaduan->status == 'proses')
                    <strong>Pengaduan sudah ditinjau dan sedang diproses</strong>
                    @elseif($pengaduan->status == 'selesai')
                 <form>
                    <div class="form-group row mb-4">
                        <label for="pengaduan" class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Judul Laporan</label>
                        <div class="col-sm-12 col-md-7">
                            <input type="text" class="form-control" id="pengaduan" placeholder="Judul Laporan" value="{{ $pengaduan->judul_laporan }}" disabled>
                        </div>
                    </div>
                <div class="form-group row mb-4">
                    <label for="tanggapan" class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Tanggapan</label>
                    <div class="col-sm-12 col-md-7">
                        <textarea id="tanggapan" name="tanggapan" class="form-control" disabled>{{ $pengaduan->tanggapan->tanggapan }}</textarea>
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <label for="oleh" class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Ditanggapi Oleh</label>
                    <div class="col-sm-12 col-md-7">
                        <input type="text" id="oleh" name="oleh" class="form-control" value="{{ $pengaduan->tanggapan->petugas->nama_petugas }}" disabled>
                    </div>
                </div>
                 </form>
                 @endif
                </div>
            </div>
        </div>
       </div>
    </div>
</section>
@endsection

