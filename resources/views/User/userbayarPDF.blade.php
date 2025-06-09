<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Histori Pembayaran</title>
</head>
<body>
    <h1>History Pembayaran</h1> 
    <table class="table" cellpadding="5" border="1">
		<thead class="thead-primary">
			<tr class="text-center">
                <th>No</th>
                <th>User</th>
                <th>Metode Pembayaran</th>
                <th>tanggal</th>
                <th>Kode Pesanan</th>
                <th>Status Pembayaran</th>
			</tr>
		</thead>
		<tbody>
			@php $no= 1; @endphp
            @foreach($pembayaran as $row)

			@if ($row->users->id == Auth::user()->id)
            <tr>
                <td scope="row">{{ $no++ }}</td>
                    <td>{{ $row->users->name }}</td>
                    <td>{{ $row->metodePembayaran }}</td>
                    <td>{{ $row->tanggal }}</td>
                    <td>{{ $row->pesanan->kodePesanan }}</td>
                            
                    <td style="text-align: center;">
                        <span class="badge text-white {{ ($row->statusPembayaran == 'Sudah Di Konfirmasi') ? 'bg-success' : 'bg-danger'}}"
                            style="padding: 10px; font-size: 12px;">
                            {{ ($row->statusPembayaran  == 'Sudah Di Konfirmasi') ? 'Sudah Di Konfirmasi' : 'Belum Di Konfirmasi'}}
                        </span>
                    </td>
                </tr>
			@endif
            @endforeach
		</tbody>
	</table>
    </body>
</html>