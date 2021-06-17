
<!DOCTYPE html>
<html>
<head>
 <title>Tanggapan</title>
 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Tanggal Tanggapan</th>
                <th>Judul Pengaduan</th>
                <th>Tanggapan</th>
                <th>Yang Menanggapi</th>
            </tr>
            </thead>
            <tbody>
            @forelse ($data["tanggapan"] as $t)
            <tr>
                <td>{{ \Carbon\Carbon::parse($t->tgl_tanggapan)->isoFormat('DD MMMM Y') }}</td>
                <td>{{ $t->pengaduan->judul_laporan }}</td>
                <td>{{ $t->tanggapan }}</td>
                <td>{{ $t->petugas->nama_petugas }}</td>
            </tr>
            @empty
            <tr class="text-center">
                <td colspan="4">Tidak Ada Data</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
</body>
</html>

