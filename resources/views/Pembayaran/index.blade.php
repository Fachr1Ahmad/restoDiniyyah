@extends('Admin.home')
@section('content')
<div class="card mb-4">
    <h2 style="margin: 10px 0px 10px 10px; ">Home</h2>
    <nav>
        <ol class="breadcrumb mb-4 " style="margin-left: 10px;">
            <li class="breadcrumb-item"><a style="text-decoration: none; color: black;"
                    href="{{ url('pembayaran') }}">Data Master</a></li>
            <li class="breadcrumb-item active">Pembayaran</li>
        </ol>
    </nav>
    <div class="card-header fw-bold text-light">
        <i class="fa fa-folder" style="margin-right:4;"></i>
        Data Pembayaran
    </div>

    <div class="mt-4 d-flex flex-row" style="margin-left: 18px;">
        <a class="btn btn-primary btn-sm me-2 d-flex align-items-center justify-content-center" title="Tambah Pesanan" 
            href="{{ route('pembayaran.create') }}" style="border: none; border-radius: 20px; height: 40px; text-decoration: none; color: white; font-weight: bold;">
            <i class="fa fa-plus-circle me-2"></i> Add Pembayaran
        </a>

        <button class="btn btn-danger btn-sm me-2 d-flex align-items-center justify-content-center" title="Export to PDF Pesanan" 
            data-bs-toggle="modal" data-bs-target="#pdfModal" style="border: none; border-radius: 20px; height: 40px; text-decoration: none; color: white; font-weight: bold;">
            <i class="fas fa-file-pdf me-2"></i> Export to PDF
        </button>

        <button class="btn btn-success btn-sm d-flex align-items-center justify-content-center" title="Export to Excel Pesanan" 
            data-bs-toggle="modal" data-bs-target="#excelModal" style="border: none; border-radius: 20px; height: 40px; text-decoration: none; color: white; font-weight: bold;">
            <i class="fas fa-file-excel me-2"></i> Export to Excel
        </button>
    </div>

    <br />
    @if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
    @endif
    <div class="card-body">
        <table id="datatablesSimple">
            <thead>
                <tr class="text-center">
                    <th class="text-center align-middle">No</th>
                    <th class="text-center align-middle">User</th>
                    <th class="text-center align-middle">Metode Pembayaran</th>
                    <th class="text-center align-middle">Total</th>
                    <th class="text-center align-middle">Tanggal</th>
                    <th class="text-center align-middle">Kode Pesanan</th>
                    <th class="text-center align-middle">Bukti Pembayaran</th>
                    <th class="text-center align-middle">Status Pembayaran</th>
                    <th class="text-center align-middle" scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pembayaran as $index => $row)
                <tr class="text-center align-middle">
                    <th scope="row">{{ $index+1 }}</th>
                    <td>{{ $row->pesanan->user->name }}</td>
                    <td>{{ $row->metodePembayaran->metodePembayaran }}</td>
                    <td>Rp {{ number_format($row->pesanan->total_harga, 0, ',', '.') }}</td>
                    <td>{{ $row->updated_at }}</td>
                    <td>{{ $row->pesanan->order_id }}</td>
                    <td width="7%">
                        @empty($row->buktiPembayaran)
                        <img src="{{ url('assets/img/bukti/nophoto.png') }}" alt="Profile"
                            style="border-radius: 5px; width: 60px; height: 60px;">
                        @else
                        <img src="{{ url('assets/img/bukti/'.$row->buktiPembayaran) }}" alt="Profile"
                            style="border-radius: 5px; width: 60px; height: 60px;">
                        @endempty
                    </td>
                    <td style="text-align: center;">
                        <span class="badge text-white 
                            @switch($row->statusPembayaran)
                                @case(Pembayaran::STATUS_CONFIRMED) bg-success @break
                                @case(Pembayaran::STATUS_UNCONFIRMED) bg-warning @break
                                @case(Pembayaran::STATUS_DENIED) bg-danger @break
                                @default bg-info
                            @endswitch
                        ">
                            {{ $row->statusPembayaran }}
                        </span>
                    </td>
                    <td width="15%">
                        <form method="POST" id="formAction">
                            @csrf
                            @method('DELETE')
                            <a class="btn btn-dark btn-sm" title="Detail Pembayaran"
                                href=" {{ route('pembayaran.show',$row->id) }}">
                                <i class="fa fa-eye"></i>
                            </a>
                            &nbsp;
                            <a class="btn btn-warning btn-sm" title="Ubah Pembayaran"
                                href=" {{ route('pembayaran.edit',$row->id) }}">
                                <i class="fa fa-pencil"></i>
                            </a>
                            &nbsp;
                            <button type="submit" class="btn btn-danger btn-sm btnDelete" title="Hapus Pembayaran"
                                data-action="{{ route('pembayaran.destroy',$row->id) }}">
                                <i class="fa fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<!-- Modal for Date Range Filter -->
<div class="modal fade" id="pdfModal" tabindex="-1" aria-labelledby="pdfModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="pdfModalLabel">Filter Rentang Tanggal & Status</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="GET" action="{{ url('pembayaran-pdf') }}">
                @csrf
                @method("GET")
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="tanggal_awal" class="form-label">Tanggal Mulai</label>
                        <input type="date" name="tanggal_awal" id="tanggal_awal" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="tanggal_akhir" class="form-label">Tanggal Akhir</label>
                        <input type="date" name="tanggal_akhir" id="tanggal_akhir" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="status_pembayaran" class="form-label">Status Pembayaran</label>
                        <select name="status_pembayaran" id="status_pembayaran" class="form-control">
                            <option value="">Semua Status</option>
                            @php
                                $statusList = $pembayaran->pluck('statusPembayaran')->unique()->filter()->values();
                            @endphp
                            @foreach($statusList as $status)
                                <option value="{{ $status }}">{{ ucfirst($status) }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Export PDF</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal for Date Range Filter -->
<div class="modal fade" id="excelModal" tabindex="-1" aria-labelledby="excelModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="excelModalLabel">Filter Rentang Tanggal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="GET" action="{{ url('pembayaran-excel') }}">
                @csrf
                @method("GET")
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="tanggal_awal" class="form-label">Tanggal Mulai</label>
                        <input type="date" name="tanggal_awal" id="tanggal_awal" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="tanggal_akhir" class="form-label">Tanggal Akhir</label>
                        <input type="date" name="tanggal_akhir" id="tanggal_akhir" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="status_pembayaran" class="form-label">Status Pembayaran</label>
                        <select name="status_pembayaran" id="status_pembayaran" class="form-control">
                            <option value="">Semua Status</option>
                            @php
                                $statusList = $pembayaran->pluck('statusPembayaran')->unique()->filter()->values();
                            @endphp
                            @foreach($statusList as $status)
                                <option value="{{ $status }}">{{ ucfirst($status) }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Export Excel</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script type="text/javascript">
    $('body').on('click', '.btnDelete', function(e) {
    e.preventDefault();
    var action = $(this).data('action');
    Swal.fire({
        title: 'Apakah Anda yakin ingin menghapus data ini?',
        text: "Data yang sudah dihapus tidak bisa dikembalikan lagi",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Batal',
        confirmButtonText: 'Yakin'
    }).then((result) => {
        if (result.isConfirmed) {
            $('#formAction').attr('action', action);
            $('#formAction').submit();
        }
    })
})
</script>
@endsection