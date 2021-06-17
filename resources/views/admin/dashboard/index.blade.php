@extends('layouts.admin')

@section('title','Dashboard')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Dashboard</h1>
        </div>
        <div class="section-body">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-12">
                <div class="card card-statistic-2">
                <div class="card-icon shadow-primary bg-danger">
                    <i class="fas fa-suitcase"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                    <h4>Total Pengaduan</h4>
                    </div>
                    <div class="card-body">
                    {{ count($pengaduanTotal) }}
                    </div>
                </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12">
                <div class="card card-statistic-2">
                    <div class="card-icon shadow-primary bg-primary">
                    <i class="fas fa-glasses"></i>
                    </div>
                    <div class="card-wrap">
                    <div class="card-header">
                        <h4>Pengaduan Ditinjau</h4>
                    </div>
                    <div class="card-body">
                        {{ count($pengaduanDitinjau) }}
                    </div>
                    </div>
                </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-12">
                <div class="card card-statistic-2">
                    <div class="card-icon shadow-primary bg-warning">
                    <i class="fas fa-wrench"></i>
                    </div>
                    <div class="card-wrap">
                    <div class="card-header">
                        <h4>Pengaduan Diproses</h4>
                    </div>
                    <div class="card-body">
                        {{ count($pengaduanDiproses) }}
                    </div>
                    </div>
                </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-12">
                <div class="card card-statistic-2">
                    <div class="card-icon shadow-primary bg-success">
                    <i class="fas fa-briefcase"></i>
                    </div>
                    <div class="card-wrap">
                    <div class="card-header">
                        <h4>Pengaduan Selesai</h4>
                    </div>
                    <div class="card-body">
                        {{ count($pengaduanSelesai) }}
                    </div>
                    </div>
                </div>
                </div>
            </div>
            @unlessrole('admin|petugas')
                <div class="card">
                    <div class="card-body p-5">
                <p class="font-weight-bold h4">Mempunya pengaduan untuk pemerintahan kami? <br><br>Silahkan ajukan pengaduan anda <a href="{{ route('masyarakat.pengaduan.create') }}"><u>disini</u></a><br><br>Pengaduan anda sangat penting bagi kami, agar kami terus meningkatkan kinerja kami, terima kasih!!</p>
            </div>
        </div>
                @endunlessrole
        </div>
    </section>
@endsection
