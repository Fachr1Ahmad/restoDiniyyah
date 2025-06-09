@extends('Admin.home')
@section('content')
<div class="card mb-4">
    <h2 style="margin: 10px 0px 10px 10px; ">Home</h2>
        <nav>
            <ol class="breadcrumb mb-4 " style="margin-left: 10px;">
                <li class="breadcrumb-item"><a style="text-decoration: none; color: black;" href="{{ url('meja') }}">Data Master</a></li>
                <li class="breadcrumb-item active">Meja</li>
            </ol>
        </nav>
        <div class="card-header text-light d-flex align-items-center justify-content-between" style="border-bottom: 2px solid #dee2e6;">
            <h5 class="fw-bold mb-0">
                <i class="fa fa-folder me-2"></i>Data Meja
            </h5>
        </div>

    <div class="mt-4" style="margin-left:18px; max-width: 140px;">
        @if(Auth::user()->role != 'Customer')
        <a class="btn btn-primary btn-sm d-flex align-items-center" title="Tambah Meja" 
            href="{{ route('meja.create') }}" style="border: none; border-radius: 20px; padding: 8px 20px; text-decoration: none; color: white; font-weight: bold;">
            <i class="fa fa-plus-circle me-2"></i> Add Meja
        </a>
        @endif
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
                <tr>
                    <th>No</th>
                    <th>Kode Meja</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php $no= 1; @endphp
                @foreach($meja as $row)
                <tr>
                    <th scope="row">{{ $no++ }}</th>
                    <td>{{ $row->kodeMeja }}</td>
                    <td width="15%">
                        <form method="POST" id="formDelete">
                            @csrf
                            @method('DELETE')
                            @if(Auth::user()->role != 'Customer')
                            <a class="btn btn-warning btn-sm" title="Ubah Meja"
                                href=" {{ route('meja.edit',$row->id) }}">
                                <i class="fa fa-pencil"></i>
                            </a>
                            &nbsp;
                            <button type="submit" class="btn btn-danger btn-sm btnDelete" title="Hapus Meja"
                                data-action="{{ route('meja.destroy',$row->id) }}" >
                                <i class="fa fa-trash"></i>
                            </button>
                            @endif
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
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
            $('#formDelete').attr('action', action);
            $('#formDelete').submit();
        }
    })
})
</script>
@endsection