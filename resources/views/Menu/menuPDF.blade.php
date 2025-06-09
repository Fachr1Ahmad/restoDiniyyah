<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Menu</title>
</head>
<body>
    <h1>Data Menu</h1>
    <table cellpadding="5" border="1">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Menu</th>
                    <th>Status</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Nama Kategori</th>
                </tr>
            </thead>
            <tbody>
                @php $no= 1; @endphp
                @foreach($menu as $row)
                <tr>
                    <th scope="row">{{ $no++ }}</th>
                    <td>{{ $row->namaMenu }}</td>
                    <td>{{ $row->status }}</td>
                    <td>{{ $row->harga }}</td>
                    <td>{{ $row->stok }}</td>
                    <td>{{ $row->kategori->namaKategori }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </body>
</html>