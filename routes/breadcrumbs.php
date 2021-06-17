<?php
use Diglactic\Breadcrumbs\Breadcrumbs;

Breadcrumbs::for('dashboard', function ($trail) {
    $trail->push('Dashboard', route('admin.dashboard'));
});

Breadcrumbs::for('masyarakat.dashboard', function ($trail) {
    $trail->push('Dashboard', route('dashboard'));
});

// Masyarakat
Breadcrumbs::for('admin.masyarakat', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Masyarakat', route('admin.masyarakat'));
});

// Masyarakat Edit
Breadcrumbs::for('admin.masyarakat.edit', function ($trail,$masyarakat) {
    $trail->parent('admin.masyarakat');
    $trail->push($masyarakat->nama);
});

// Admin Pengaduan
Breadcrumbs::for('admin.pengaduan', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Pengaduan', route('admin.pengaduan'));
});

// Admin Pengaduan Show
Breadcrumbs::for('admin.pengaduan.show', function ($trail,$pengaduan) {
    $trail->parent('admin.pengaduan');
    $trail->push($pengaduan->judul_laporan);
});

// Admin Pengaduan Edit
Breadcrumbs::for('admin.pengaduan.edit', function ($trail,$pengaduan) {
    $trail->parent('admin.pengaduan');
    $trail->push($pengaduan->judul_laporan);
});


// Pengaduan
Breadcrumbs::for('masyarakat.pengaduan', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Pengaduan', route('masyarakat.pengaduan'));
});

// Pengaduan Create
Breadcrumbs::for('masyarakat.pengaduan.create', function ($trail) {
    $trail->parent('masyarakat.pengaduan');
    $trail->push('Tambah Pengaduan');
});

// Pengaduan Show
Breadcrumbs::for('masyarakat.pengaduan.show', function ($trail,$pengaduan) {
    $trail->parent('masyarakat.pengaduan');
    $trail->push($pengaduan->judul_laporan);
});

// Pengaduan Edit
Breadcrumbs::for('masyarakat.pengaduan.edit', function ($trail,$pengaduan) {
    $trail->parent('masyarakat.pengaduan');
    $trail->push($pengaduan->judul_laporan);
});

// Tanggapan
Breadcrumbs::for('admin.tanggapan', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Tanggapan', route('admin.tanggapan'));
});

// Tanggapan Create
Breadcrumbs::for('admin.tanggapan.create', function ($trail) {
    $trail->parent('admin.tanggapan');
    $trail->push('Tambah Tanggapan');
});

// Tanggapan Edit
Breadcrumbs::for('admin.tanggapan.edit', function ($trail,$tanggapan) {
    $trail->parent('admin.tanggapan');
    $trail->push($tanggapan->pengaduan->judul_laporan);
});

// Tanggapan Show
Breadcrumbs::for('admin.tanggapan.show', function ($trail,$tanggapan) {
    $trail->parent('admin.tanggapan');
    $trail->push($tanggapan->pengaduan->judul_laporan);
});

// Petugas
Breadcrumbs::for('admin.petugas', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Petugas', route('admin.petugas'));
});

// Pertugas Create
Breadcrumbs::for('admin.petugas.create', function ($trail) {
    $trail->parent('admin.petugas');
    $trail->push('Tambah Petugas');
});

// Petugas Edit
Breadcrumbs::for('admin.petugas.edit', function ($trail,$petugas) {
    $trail->parent('admin.petugas');
    $trail->push($petugas->nama_petugas);
});

// Profile User
Breadcrumbs::for('admin.profiles', function ($trail,$petugas) {
    $trail->parent('dashboard');
    $trail->push('Profil', route('profiles'));
    $trail->push($petugas);
});
