<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Metode Pembayaran</title>
</head>
<body>
    <h1>Data Metode Pembayaran</h1>
    <table cellpadding="5" border="1">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Metode Pembayaran</th>
                </tr>
            </thead>
            <tbody>
                @php $no= 1; @endphp
                @foreach($metodepembayaran as $row)
                <tr>
                    <th scope="row">{{ $no++ }}</th>
                    <td>{{ $row->metodePembayaran }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </body>
</html>