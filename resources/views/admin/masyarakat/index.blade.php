@extends('layouts.admin')

@section('title','Masyarakat')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Masyarakat</h1>
            <div class="section-header-breadcrumb">
                {{  Breadcrumbs::render('admin.masyarakat')  }}
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="text-primary">Masyarakat
                                <span>({{ $masyarakat->total() }})</span>
                                @role('admin')
                                <a href="{{ route('admin.masyarakat.pdf') }}" class="btn btn-danger">Cetak PDF <i class="fas fa-newspaper"></i></a>
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
                                            <th>NIK</th>
                                            <th>Nama Lengkap</th>
                                            <th>Username</th>
                                            <th>Telepon</th>
                                            <th>Dibuat</th>
                                            <th>Diedit</th>
                                            <th>Aksi</th>
                                        </tr>
                                     </thead>
                                        <tbody>
                                        @forelse ($masyarakat as $mst)
                                        <tr>
                                            <td>{{ $mst->nik }}</td>
                                            <td>{{ $mst->nama }}</td>
                                            <td>{{ $mst->username }}</td>
                                            <td>{{ $mst->telp }}</td>
                                            <td>{{ \Carbon\Carbon::parse($mst->created_at)->isoFormat('DD MMMM Y') }}</td>
                                            <td>{{ \Carbon\Carbon::parse($mst->updated_at)->isoFormat('DD MMMM Y') }}</td>
                                            <td>
                                                <a href="{{ route('admin.masyarakat.edit',['masyarakat' => $mst]) }}" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                                                <button class="btn btn-danger delete-confirm" data-action="{{ route('admin.masyarakat.destroy',$mst) }}"><i class="fa fa-trash"></i></button>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr class="text-center">
                                            <td colspan="7">Tidak Ada Data</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <div class="paginate">
                                {{ $masyarakat->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
