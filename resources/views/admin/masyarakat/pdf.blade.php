
<!DOCTYPE html>
<html>
<head>
 <title>Masyarakat</title>
 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>NIK</th>
                <th>Nama Lengkap</th>
                <th>Username</th>
                <th>Telepon</th>
            </tr>
         </thead>
            <tbody>
            @forelse ($data["masyarakat"] as $mst)
            <tr>
                <td>{{ $mst->nik }}</td>
                <td>{{ $mst->nama }}</td>
                <td>{{ $mst->username }}</td>
                <td>{{ $mst->telp }}</td>
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

