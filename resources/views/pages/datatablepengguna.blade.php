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

<script type="text/javascript">
    $(document).ready(function() {
        //Tabel Pelaporan
        $('#tabel-pengguna').DataTable({
            processing: true,
            serverSide: true,
            destroy: true,
            columns: [{
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'nip',
                    name: 'nip'
                },
                {
                    data: 'alamat',
                    name: 'alamat',
                },
                {
                    data: 'email',
                    name: 'email',
                },
                {
                    data: 'role_name',
                    name: 'role_name',
                },
                {
                    data: 'aksi',
                    name: 'aksi',
                    orderable: false,
                    searchable: false
                }
            ],
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/id.json',
            }
        });
    });
</script>

<!-- Script Tambah Data Pengguna -->
<script>
    //button create post event
    $('body').on('click', '#simpanpengguna', function() {
        //open modal
        $('#tambah-pengguna').modal('show');
    });

    //action create post
    $('#simpanpengguna').click(function(e) {
        e.preventDefault();

        //define variable
        let name = $('#name').val();
        let nip = $('#nip').val();
        let email = $('#email').val();
        let alamat = $('#alamat').val();
        let password = $('#password').val();
        let role_id = $('#role_id').val();

        //ajax
        $.ajax({
            url: `{{url('/pengguna/simpan')}}`,
            type: "POST",
            cache: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                "name": name,
                "nip": nip,
                "email": email,
                "alamat": alamat,
                "password": password,
                "role_id": role_id,
            },
            success: function(response) {

                //show success message
                Swal.fire({
                    icon: 'success',
                    title: "Pengguna sistem berhasil ditambahkan",
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timerProgressBar: true,
                    timer: 3000
                })

                //Reset Data Form Setelah Simpan Berhasil
                $('#role_id').prop('selectedIndex', 0);
                $('#name').val('');
                $('#nip').val('');
                $('#email').val('');
                $('#alamat').val('');
                $('#password').val('');

                //Melakukan Hide Modal dan Reload DataTable Setelah Simpan Berhasil
                $('#tabel-pengguna').DataTable().clear().draw();
                $('#tambah-pengguna').modal('hide');

                //Post Data
                let post = `
                    <tr id="index_${response.data.id}">
                        <td>${response.data.name}</td>
                        <td>${response.data.nip}</td>
                        <td>${response.data.alamat}</td>
                        <td>${response.data.email}</td>
                        <td>${response.data.password}</td>
                        <td>${response.data.role_id}</td>
                    </tr>
                `;
            },
            error: function(response) {
                // Parse the JSON response
                var errorData = JSON.parse(response.responseText);

                // Access the errors array
                var errors = errorData.errors;

                // Get the error message
                var errorMessage = errors;

                Swal.fire({
                    icon: 'error',
                    title: "Gagal Menyimpan Data!",
                    text: errorMessage,
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timerProgressBar: true,
                    timer: 3000
                })
            }
        });
    });
</script>
<!-- #/ container -->
@endsection