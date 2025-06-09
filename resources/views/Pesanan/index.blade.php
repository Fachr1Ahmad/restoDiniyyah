@extends('Admin.home')

@section('content')
<div class="card mb-4">
    <h2 style="margin: 10px 0px 10px 10px;">Home</h2>
    <nav>
        <ol class="breadcrumb mb-4" style="margin-left: 10px;">
            <li class="breadcrumb-item"><a style="text-decoration: none; color: black;" href="{{ url('pesanan') }}">Data Master</a></li>
            <li class="breadcrumb-item active">Pesanan</li>
        </ol>
    </nav>
    <div class="card-header fw-bold text-light">
        <i class="fa fa-folder" style="margin-right:4px;"></i> Data Pesanan
    </div>

    <div class="mt-4 d-flex flex-row" style="margin-left: 18px;">
        <a class="btn btn-primary btn-sm me-2 d-flex align-items-center justify-content-center" title="Tambah Pesanan" 
            href="{{ route('pesanan.create') }}" style="border: none; border-radius: 20px; height: 40px; text-decoration: none; color: white; font-weight: bold;">
            <i class="fa fa-plus-circle me-2"></i> Add Pesanan
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
        <div class="col mt-4" wire:poll.keep-alive>
            @livewire('pesanan', ['pesanan' => $pesanan])
        </div>
    </div>
</div>

<!-- Modal for PDF Export -->
<div class="modal fade" id="pdfModal" tabindex="-1" aria-labelledby="pdfModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="pdfModalLabel">Filter Rentang Tanggal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ url('pesanan-pdf') }}">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="tanggal_awal_pdf" class="form-label">Tanggal Mulai</label>
                        <input type="date" name="tanggal_awal" id="tanggal_awal_pdf" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="tanggal_akhir_pdf" class="form-label">Tanggal Akhir</label>
                        <input type="date" name="tanggal_akhir" id="tanggal_akhir_pdf" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="status_pdf" class="form-label">Status Pesanan</label>
                        <select name="status" id="status_pdf" class="form-control">
                            <option value="">Semua Status</option>
                            @foreach($pesanan->pluck('status')->unique() as $status)
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

<!-- Modal for Excel Export -->
<div class="modal fade" id="excelModal" tabindex="-1" aria-labelledby="excelModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="excelModalLabel">Filter Rentang Tanggal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="GET" action="{{ url('pesanan-excel') }}">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="tanggal_awal_excel" class="form-label">Tanggal Mulai</label>
                        <input type="date" name="tanggal_awal" id="tanggal_awal_excel" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="tanggal_akhir_excel" class="form-label">Tanggal Akhir</label>
                        <input type="date" name="tanggal_akhir" id="tanggal_akhir_excel" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="status_excel" class="form-label">Status Pesanan</label>
                        <select name="status" id="status_excel" class="form-control">
                            <option value="">-- Semua Status --</option>
                            @foreach($pesanan->pluck('status')->unique() as $status)
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
                $('#formDelete').attr('action', action);
                $('#formDelete').submit();
            }
        });
    });
</script>
@endsection
