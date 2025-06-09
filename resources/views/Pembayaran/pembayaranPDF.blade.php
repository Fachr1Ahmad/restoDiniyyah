<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Laporan Pembayaran</title>
    <link href="https://fonts.googleapis.com/css?family=Inter:400,600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', Arial, sans-serif;
            background: #f6f8fa;
            color: #222;
            margin: 0;
            padding: 0;
        }
        .kop-surat {
            text-align: left;
            display: flex;
            align-items: center;
            gap: 16px;
            margin-bottom: 18px;
            border-bottom: 2px solid #e5e7eb;
            padding-bottom: 10px;
        }
        .kop-surat img {
            max-width: 60px;
            border-radius: 8px;
        }
        .kop-surat .info {
            flex: 1;
        }
        .kop-surat h3 {
            margin: 0 0 2px 0;
            font-size: 18px;
            font-weight: 600;
            color: #004d40;
        }
        .kop-surat p {
            margin: 0;
            font-size: 12px;
            color: #6b7280;
        }
        .header {
            text-align: center;
            margin-bottom: 10px;
        }
        .header h1 {
            font-size: 20px;
            font-weight: 700;
            margin: 0;
            color: #111827;
        }
        .header p {
            font-size: 13px;
            color: #6b7280;
            margin: 2px 0 0 0;
        }
        .table-responsive {
            margin: 0 auto;
            max-width: 100%;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13px;
            background: #fff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 1px 4px rgba(0,0,0,0.04);
        }
        th, td {
            padding: 7px 8px;
            border-bottom: 1px solid #e5e7eb;
            text-align: center;
        }
        th {
            background: #004d40;
            color: #fff;
            font-weight: 600;
            font-size: 13px;
        }
        tr:last-child td {
            border-bottom: none;
        }
        td {
            background: #f9fafb;
        }
        .badge {
            display: inline-block;
            padding: 3px 10px;
            border-radius: 12px;
            font-size: 11px;
            font-weight: 600;
            background: #004d40;
            color: #fff;
            letter-spacing: 0.5px;
        }
        .text-end {
            text-align: right;
        }
        .footer {
            text-align: center;
            font-size: 11px;
            color: #9ca3af;
            margin-top: 24px;
        }
    </style>
</head>
<body>
    <div class="kop-surat" style="flex-direction: column; align-items: center; justify-content: center; text-align: center;">
        <img src="img/diniyyah.png" alt="Logo" style="margin-bottom: 8px;">
        <div class="info">
            <h3>Restoran Perguruan Diniyyah Puteri Padang Panjang</h3>
            <p>
                @if(!empty($tanggal_awal) && !empty($tanggal_akhir))
                    {{ \Carbon\Carbon::parse($tanggal_awal)->isoFormat('D MMMM YYYY') }} - {{ \Carbon\Carbon::parse($tanggal_akhir)->isoFormat('D MMMM YYYY') }}
                @else
                    {{ \Carbon\Carbon::now()->isoFormat('D MMMM YYYY') }}
                @endif
                <br>Jalan Abdul Hamid Hakim No.30, Pasar Usang, Padang Panjang Barat, Padang Panjang, Sumatera Barat
            </p>
        </div>
    </div>

    <div class="header">
        <h1>Laporan Data Pembayaran</h1> {{-- Judul diubah --}}
        <p>
            @if(!empty($tanggal_awal) && !empty($tanggal_akhir))
                Periode: {{ \Carbon\Carbon::parse($tanggal_awal)->format('d/m/Y') }} - {{ \Carbon\Carbon::parse($tanggal_akhir)->format('d/m/Y') }}
            @else
                Bulan: {{ \Carbon\Carbon::now()->format('F Y') }}
            @endif
            {{-- Gunakan variabel status pesanan --}}
            &mdash; Status Pesanan:
            <span style="color:#004d40;font-weight:600;"> {{-- Warna bisa disesuaikan --}}
                {{ empty($status_pembayaran) ? 'Semua' : ucfirst($status_pembayaran) }}
            </span>
        </p>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Pelanggan</th>
                <th>Metode Pembayaran</th>
                <th>Tanggal Bayar</th>
                <th>Order ID</th>
                <th>Status</th>
                {{-- Tambahkan kolom lain jika perlu --}}
            </tr>
        </thead>
        <tbody>
            @php $no = 1; @endphp
            @forelse($pembayaran as $row)
            <tr>
                <td class="text-center">{{ $no++ }}</td>
                <td>{{ optional($row->pesanan->user)->name ?? '-' }}</td>
                <td>{{ optional($row->metodePembayaran)->metodePembayaran ?? '-' }}</td>
                <td>{{ \Carbon\Carbon::parse($row->updated_at)->isoFormat('D MMM YYYY, HH:mm') }}</td>
                <td>{{ optional($row->pesanan)->order_id ?? optional($row->pesanan)->id ?? '-' }}</td>
                <td class="text-center">
                    @if(!empty($row->statusPembayaran))
                        <span class="badge {{ strtolower($row->statusPembayaran) }}">{{ ucfirst($row->statusPembayaran) }}</span>
                    @else
                        <span>-</span>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center">Tidak ada data pembayaran yang sesuai dengan filter yang dipilih.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        Dicetak pada: {{ \Carbon\Carbon::now()->isoFormat('D MMMM YYYY, HH:mm') }} - &copy; {{ date('Y') }} Sistem Anda
    </div>

</body>
</html>