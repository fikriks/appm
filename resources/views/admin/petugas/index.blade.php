@extends('layouts.admin')

@section('title','Petugas')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Petugas</h1>
            <div class="section-header-breadcrumb">
                {{  Breadcrumbs::render('admin.petugas')  }}
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="text-primary">Petugas
                                <span>({{ $petugas->total() }})</span>
                                <a href="{{ route('admin.petugas.create') }}" class="btn btn-primary">Tambah <i class="fas fa-plus"></i></a>
                            </h4>
                            <div class="card-header-form">
                                <form action={{ route(request()->route()->getName()) }}>
                                    <div class="input-group">
                                      <input type="text" class="form-control" placeholder="Cari" name="search" value="{{ request()->get('search') }}">
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
                                            <th>Nama</th>
                                            <th>Nama Pengguna</th>
                                            <th>Hak Akses</th>
                                            <th>Dibuat</th>
                                            <th>Diedit</th>
                                            <th>Aksi</th>
                                        </tr>
                                     </thead>
                                        <tbody>
                                        @forelse ($petugas as $p)
                                        <tr>
                                            <td>{{ $p->nama_petugas }}</td>
                                            <td>{{ $p->username }}</td>
                                            <td>
                                                @forelse ($p->roles as $role)
                                                    {{ ucfirst($role->name) }}
                                                @empty
                                                   {!! '<i>NULL</i>'  !!}
                                                @endforelse
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($p->created_at)->isoFormat('DD MMMM Y') }}</td>
                                            <td>{{ \Carbon\Carbon::parse($p->updated_at)->isoFormat('DD MMMM Y') }}</td>
                                            <td>
                                                <a href="@if($p->id != Auth::id()) {{ route('admin.petugas.edit',['petuga' => $p]) }} @else {{ route('profiles') }} @endif" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                                                @if($p->id != Auth::id())
                                                <button class="btn btn-danger delete-confirm" data-action="{{ route('admin.petugas.destroy',$p) }}"><i class="fa fa-trash"></i></button>
                                                @endif
                                            </td>
                                        </tr>
                                        @empty
                                        <tr class="text-center">
                                            <td colspan="5">Tidak Ada Data</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <div class="paginate">
                                {{ $petugas->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
