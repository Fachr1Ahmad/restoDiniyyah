<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Users</title>
</head>
<body>
    <h1>Data Users</h1>
    <table cellpadding="5" border="1">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Lengkap</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Is Active</th>
                    <th>No HP</th>
                    <th>Alamat</th>
                </tr>
            </thead>
            <tbody>
                @php $no= 1; @endphp
                @foreach($users as $row)
                <tr>
                    <th>{{ $no++ }}</th>
                    <td>{{ $row->name }}</td>
                    <td>{{ $row->email }}</td>
                    <td>{{ $row->role}}</td>
                    <td>{{ $row->isactive }}</td>
                    <td>{{ $row->no_hp}}</td>
                    <td>{{ $row->alamat}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </body>
</html>