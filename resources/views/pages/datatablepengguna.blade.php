<title>Daftar Pengguna &minus; Sistem Informasi Inventaris Barang dan Aset Desa</title>
@extends('layouts.app-layout')

@section('content')

<div class="row page-titles mx-0">
    <div class="col p-md-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Fungsional Sistem</a></li>
            <li class="breadcrumb-item active"><a href="/pengguna">Daftar Pengguna</a></li>
        </ol>
    </div>
</div>
<!-- row -->

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Daftar Pengguna</h4>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambah-pengguna"><i class="fa fa-plus"></i> Tambah Pengguna</button>
                    <div class="table-responsive">
                        <table id="tabel-pengguna" class="table table-striped table-bordered zero-configuration">
                            <thead>
                                <tr>
                                    <th class="text-center">Nama</th>
                                    <th class="text-center">NIP</th>
                                    <th class="text-center">Alamat</th>
                                    <th class="text-center">Email</th>
                                    <th class="text-center">Jabatan</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Data Pengguna -->
<div class="modal fade" id="tambah-pengguna" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Pengguna</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @csrf
                <form id="add_pengguna">
                    <div class="form-row">
                        <label for="role_id" class="col-form-label">Role:</label>
                        <select class="form-control" id="role_id" name="role_id" require>
                            <option value="">Silahkan Pilih ...</option>
                            @foreach($roles as $u)
                            <option value="{{ $u->id }}" name="role_id" id="role_id">{{ $u->role_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-row">
                        <label for="name" class="col-form-label">Nama:</label>
                        <input type="text" class="form-control" name="name" id="name" require>
                    </div>
                    <div class="form-row">
                        <label for="nip" class="col-form-label">NIP:</label>
                        <input type="text" class="form-control" name="nip" id="nip" require>
                    </div>
                    <div class="form-row">
                        <label for="alamat" class="col-form-label">Alamat:</label>
                        <input type="text" class="form-control" name="alamat" id="alamat" require>
                    </div>
                    <div class="form-row">
                        <label for="email" class="col-form-label">Email:</label>
                        <input type="email" class="form-control" name="email" id="email" require>
                    </div>
                    <div class="form-row">
                        <label for="password" class="col-form-label">Kata Sandi:</label>
                        <input type="password" class="form-control" name="password" id="password" require>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                <button autofocus type="button" class="btn btn-success text-white" id="simpanpengguna">Simpan</button>
            </div>
        </div>
    </div>
</div>

<!-- Script Hapus Data Pengguna -->
<script>
function deleteDataUser(e) {
    event.preventDefault();
    let id = e.getAttribute('data-id');
    let name = e.getAttribute('data-name');
    
    // Validasi jika pengguna mencoba menghapus dirinya sendiri
    if (id === '{{ auth()->user()->id }}') {
        Swal.fire({
            icon: 'error',
            title: 'Gagal Menghapus Pengguna',
            text: 'Anda tidak dapat menghapus pengguna yang sedang terautentikasi ke sistem ini',
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timerProgressBar: true,
            timer: 5000
        });
        return;
    }
    
    Swal.fire({
        title: 'Apakah Anda yakin?',
        text: "Pengguna " + name + " akan dihapus secara permanen!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, hapus!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '{{url("/pengguna/hapus")}}/' + id,
                type: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: "Pengguna " + name + " berhasil dihapus",
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timerProgressBar: true,
                            timer: 3000
                        });
                        $('#tabel-pengguna').DataTable().clear().draw();
                    } else {
                        Swal.fire(
                            'Gagal!',
                            response.message,
                            'error'
                        );
                    }
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal Menghapus Pengguna',
                        text: 'Pengguna ' + name + ' sedang digunakan',
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timerProgressBar: true,
                        timer: 5000
                    });
                }
            });
        }
    });
}
</script>
<!-- #/ container -->
@endsection