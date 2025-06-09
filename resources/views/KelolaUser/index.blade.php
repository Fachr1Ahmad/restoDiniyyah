@extends('Admin.home')
@section('content')
@if(Auth::user()->role == 'Admin')
<div class="card mb-4">
    <h2 style="margin: 10px 0px 10px 10px; ">Administrator</h2>
        <nav>
            <ol class="breadcrumb mb-4 " style="margin-left: 10px;">
                <li class="breadcrumb-item"><a style="text-decoration: none; color: black;" href="{{ url('kelola_user') }}">User</a></li>
                <li class="breadcrumb-item active">Kelola Users</li>
            </ol>
        </nav>
    <div class="card-header text-light fw-bold">
        <i class="fa fa-user" style="margin-right:4;"></i>
        Kelola Data Users
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
                    <th>Nama Lengkap</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Is Active</th>
                    <th>No HP</th>
                    <th>Alamat</th>
                    <th>Foto</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php $no= 1; @endphp
                @foreach($user as $row)
                <tr>
                    <th scope="row">{{ $no++ }}</th>
                    <td>{{ $row->name }}</td>
                    <td>{{ $row->email }}</td>
                    <td>{{ $row->role}}</td>
                    <td style="text-align: center;">
                        <span class="badge text-white {{ ($row->isactive == 1) ? 'bg-success' : 'bg-danger'}}">
                        {{ ($row->isactive == 1) ? 'Aktif' : 'Tidak Aktif'}}
                        </span>
                    </td>
                    <td>{{ $row->no_hp}}</td>
                    <td>{{ $row->alamat}}</td>
                    <td width="7%">
                        @empty($row->foto)
                        <img src="{{ url('assets/img/user/nophoto.png') }}" width="100%" alt="Profile" style="border-radius: 5px;">
                        @else
                        <img src="{{ url('assets/img/user/'.$row->foto) }}" width="100%" alt="Profile" style="border-radius: 5px;">
                        @endempty
                    </td>
                    <td width="15%">
                        <form method="POST" id="formDelete">
                            @csrf
                            @method('DELETE')

                            <a class="btn btn-dark btn-sm" title="Detail Users"
                                href=" {{ route('kelola_user.show',$row->id) }}">
                                <i class="fa fa-eye"></i>
                            </a>
                            &nbsp;
                            <a class="btn btn-warning btn-sm" title="Ubah Users"
                                href=" {{ route('kelola_user.edit',$row->id) }}">
                                <i class="fa fa-pencil"></i>
                            </a>
                            &nbsp;
                            <button type="submit" data-action="{{ route('kelola_user.destroy',$row->id) }}"
                                class="btn btn-danger btn-sm btnDelete" title="Hapus Users">
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
@else
    @include('Admin.access_denied')
@endif
@endsection