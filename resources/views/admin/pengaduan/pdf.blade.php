
<!DOCTYPE html>
<html>
<head>
 <title>Pengaduan</title>
 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <div class="row">
        <div class="text-center m-5">
            <h2>Data Pengaduan</h2>
        </div>
    </div>
</div>
<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Tanggal Pengaduan</th>
                <th>Diajukan Oleh</th>
                <th>Judul Laporan</th>
                <th>Isi Laporan</th>
                <th>Foto</th>
                <th>Status</th>
            </tr>
         </thead>
            <tbody>
            @forelse ($data["pengaduan"] as $p)
            <tr>
                <td>{{ \Carbon\Carbon::parse($p->tgl_pengaduan)->isoFormat('DD MMMM Y') }}</td>
                <td>{{ $p->masyarakat->nama }}</td>
                <td>{{ $p->judul_laporan }}</td>
                <td>{{ $p->isi_laporan }}</td>
                <td><img src="{{ storage_path('app/public/pengaduan/'.$p->foto) }}" alt="{{ $p->foto }}" width="50"></td>
                <td>
                    @if($p->status == '0')
                    <span class="badge badge-primary">Dalam Peninjauan</span>
                    @elseif($p->status == 'proses')
                    <span class="badge badge-warning">Dalam Proses</span>
                    @elseif($p->status == 'selesai')
                    <span class="badge badge-success">Selesai Diproses</span>
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
</body>
</html>

