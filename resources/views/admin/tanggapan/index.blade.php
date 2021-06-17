@extends('layouts.admin')

@section('title','Tanggapan')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Tanggapan</h1>
            <div class="section-header-breadcrumb">
                {{  Breadcrumbs::render('admin.tanggapan')  }}
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="text-primary">Tanggapan
                                <span>({{ $tanggapan->total() }})</span>
                                <a href="{{ route('admin.tanggapan.create') }}" class="btn btn-primary">Tambah <i class="fas fa-plus"></i></a>
                                @role('admin')
                                <a href="{{ route('admin.tanggapan.pdf') }}" class="btn btn-danger">Cetak PDF <i class="fas fa-newspaper"></i></a>
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
                                            <th>Tanggal Tanggapan</th>
                                            <th>Judul Pengaduan</th>
                                            <th>Tanggapan</th>
                                            <th>Yang Menanggapi</th>
                                            <th>Diedit</th>
                                            <th>Aksi</th>
                                        </tr>
                                     </thead>
                                        <tbody>
                                        @forelse ($tanggapan as $t)
                                        <tr>
                                            <td>{{ \Carbon\Carbon::parse($t->tgl_tanggapan)->isoFormat('DD MMMM Y') }}</td>
                                            <td>{{ $t->pengaduan->judul_laporan }}</td>
                                            <td>{{ $t->tanggapan }}</td>
                                            <td>{{ $t->petugas->nama_petugas }}</td>
                                            <td>{{ \Carbon\Carbon::parse($t->updated_at)->isoFormat('DD MMMM Y') }}</td>
                                            <td>
                                                <a href="{{ route('admin.tanggapan.show',['tanggapan' => $t]) }}" class="btn btn-success"><i class="fa fa-eye"></i></a>
                                                <a href="{{ route('admin.tanggapan.edit',['tanggapan' => $t]) }}" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                                                @if(!$t->pengaduan->status == 'selesai')
                                                    <button class="btn btn-danger delete-confirm" data-action="{{ route('admin.tanggapan.destroy',$t) }}"><i class="fa fa-trash"></i></button>
                                                @endif
                                            </td>
                                        </tr>
                                        @empty
                                        <tr class="text-center">
                                            <td colspan="6">Tidak Ada Data</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <div class="paginate">
                                {{ $tanggapan->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
