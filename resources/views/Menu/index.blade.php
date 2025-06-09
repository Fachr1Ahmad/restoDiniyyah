@extends('Admin.home')
@section('content')
<div class="card mb-4">
    <h2 style="margin: 10px 0px 10px 10px; ">Home</h2>
        <nav>
            <ol class="breadcrumb mb-4 " style="margin-left: 10px;">
                <li class="breadcrumb-item"><a style="text-decoration: none; color: black;" href="{{ url('menu') }}">Data Master</a></li>
                <li class="breadcrumb-item active">Menu</li>
            </ol>
        </nav>
        <div class="card-header text-light d-flex align-items-center justify-content-between" style="border-bottom: 2px solid #dee2e6;">
            <h5 class="fw-bold mb-0">
                <i class="fa fa-folder me-2"></i>Data Menu
            </h5>
        </div>

    <div class="mt-4" style="margin-left:18px; max-width: 140px;">
        @if(Auth::user()->role != 'Customer')
        <a class="btn btn-primary btn-sm d-flex align-items-center" title="Tambah Menu" 
            href="{{ route('menu.create') }}" style="border: none; border-radius: 20px; padding: 8px 20px; text-decoration: none; color: white; font-weight: bold;">
            <i class="fa fa-plus-circle me-2"></i> Add Menu
        </a>
        @endif
    </div>

    <br />
            @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
            @endif
    <div class="card mb-4 shadow-sm border-light" >
        <table id="datatablesSimple" class="table table-striped table-hover align-middle">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Menu</th>
                    <th>Status</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Nama Kategori</th>
                    <th>Foto</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php 
					$no= 1; 
						
					function rupiah($angka){
                        $hasil_rupiah = "Rp " . number_format($angka,2,',','.');
                        return $hasil_rupiah;
                    }
				@endphp
                @foreach($menu as $row)
                <tr>
                    <th scope="row">{{ $no++ }}</th>
                    <td>{{ $row->namaMenu }}</td>
                    <td>{{ $row->status }}</td>
                    <td>{{ rupiah($row->harga) }}</td>
                    <td>{{ $row->stok }}</td>
                    <td>{{ $row->kategori->namaKategori }}</td>
                    <td width="7%"> 
                        @empty($row->foto)
                        <img src="{{ url('assets/img/menu/nophoto.png') }}" width="100%" alt="Profile" style="border-radius: 5px;">
                        @else
                        <img src="{{ url('assets/img/menu/'.$row->foto) }}" width="100%" alt="Profile" style="border-radius: 5px;">
                        @endempty
                    </td>
                    <td width="15%">
                        <form method="POST" id="formDelete">
                            @csrf
                            @method('DELETE')
                            <a class="btn btn-dark btn-sm" title="Detail Menu"
                                href=" {{ route('menu.show',$row->id) }}">
                                <i class="fa fa-eye"></i>
                            </a>
                            &nbsp;
                            @if(Auth::user()->role != 'Customer')
                            <a class="btn btn-warning btn-sm" title="Ubah Menu"
                                href=" {{ route('menu.edit',$row->id) }}">
                                <i class="fa fa-pencil"></i>
                            </a>
                            &nbsp;
                            <button type="submit" class="btn btn-danger btn-sm btnDelete" title="Hapus Menu"
                                data-action="{{ route('menu.destroy',$row->id) }}">
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