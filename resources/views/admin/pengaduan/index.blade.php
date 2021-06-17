@extends('layouts.admin')

@section('title','Pengaduan')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Pengaduan</h1>
            <div class="section-header-breadcrumb">
                @unlessrole('admin|petugas')
                    {{  Breadcrumbs::render('masyarakat.pengaduan')  }}
                @else
                    {{  Breadcrumbs::render('admin.pengaduan')  }}
                @endunlessrole
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="text-primary">Pengaduan
                                <span>({{ $pengaduan->total() }})</span>
                                @unlessrole('admin|petugas')
                                    <a href="{{ route('masyarakat.pengaduan.create') }}" class="btn btn-primary">Tambah <i class="fas fa-plus"></i></a>
                                @endunlessrole
                                @role('admin')
                                <a href="{{ route('admin.pengaduan.pdf') }}" class="btn btn-danger">Cetak PDF <i class="fas fa-newspaper"></i></a>
                                @endrole
                            </h4>
                            <div class="card-header-form">
                                <form action={{ route(request()->route()->getName()) }}>
                                    <div class="input-group">
                                      <input type="text" class="form-control" placeholder="Cari" name="cari" value="{{ request()->get('search') }}">
                                      <div class="input-group-btn">
                                        <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                      </div>
                                    </div>
                                  </form>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive table-invoice">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Tanggal Pengaduan</th>
                                            <th>Diajukan Oleh</th>
                                            <th>Judul Laporan</th>
                                            <th>Isi Laporan</th>
                                            <th>Foto</th>
                                            <th>Status</th>
                                            <th>Diedit</th>
                                            <th>Aksi</th>
                                        </tr>
                                     </thead>
                                        <tbody>
                                        @forelse ($pengaduan as $p)
                                        <tr>
                                            <td>{{ \Carbon\Carbon::parse($p->tgl_pengaduan)->isoFormat('DD MMMM Y') }}</td>
                                            <td>{{ $p->masyarakat->nama }}</td>
                                            <td>{{ $p->judul_laporan }}</td>
                                            <td>{{ Str::limit($p->isi_laporan,100,'...') }}</td>
                                            <td><img src="{{ Storage::url('pengaduan/'.$p->foto) }}" alt="{{ $p->foto }}" width="50"></td>
                                            <td>
                                                @if($p->status == '0')
                                                <span class="badge badge-primary">Dalam Peninjauan</span>
                                                @elseif($p->status == 'proses')
                                                <span class="badge badge-warning">Dalam Proses</span>
                                                @elseif($p->status == 'selesai')
                                                <span class="badge badge-success">Selesai Diproses</span>
                                                @endif
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($p->created_at)->isoFormat('DD MMMM Y') }}</td>
                                            <td>
                                                <a href="@if(Auth::guard('web')->check()) {{ route('admin.pengaduan.show',['pengaduan' => $p]) }} @else {{ route('masyarakat.pengaduan.show',['pengaduan' => $p]) }} @endif" class="btn btn-success"><i class="fa fa-eye"></i></a>
                                                @if(!$p->status == 'proses' || !$p->status == 'selesai')
                                                    <a href="@if(Auth::guard('web')->check()) {{ route('admin.pengaduan.edit',['pengaduan' => $p]) }} @else {{ route('masyarakat.pengaduan.edit',['pengaduan' => $p]) }} @endif" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                                                    @unlessrole('admin|petugas')
                                                    <button class="btn btn-danger delete-confirm" data-action="{{ route('masyarakat.pengaduan.destroy',$p) }}"><i class="fa fa-trash"></i></button>
                                                    @endunlessrole
                                                @endif
                                            </td>
                                        </tr>
                                        @empty
                                        <tr class="text-center">
                                            <td colspan="8">Tidak Ada Data</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <div class="paginate">
                                {{ $pengaduan->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
