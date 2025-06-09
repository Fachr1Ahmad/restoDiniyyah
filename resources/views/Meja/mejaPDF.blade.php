<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Meja</title>
</head>
<body>
    <h1>Data Meja</h1>
    <table cellpadding="5" border="1">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Meja</th>
                </tr>
            </thead>
            <tbody>
                @php $no= 1; @endphp
                @foreach($meja as $row)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $row->kodeMeja }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </body>
</html>