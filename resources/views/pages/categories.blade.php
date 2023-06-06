<title>Kategori Aset &minus; Sistem Informasi Inventaris Barang dan Aset Desa</title>
@extends('layouts.app-layout')

@section('content')

<div class="row page-titles mx-0">
    <div class="col p-md-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Fungsional Sistem</a></li>
            <li class="breadcrumb-item active"><a href="/kategori">Kategori</a></li>
        </ol>
    </div>
</div>
<!-- row -->

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Kategori Aset</h4>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambah-kategori"><i class="fa fa-plus"></i> Tambah Kategori</button>
                    <div class="table-responsive">
                        <table id="tabel-kategori" class="table table-striped table-bordered zero-configuration">
                            <thead>
                                <tr>
                                    <th width="40%" class="text-center">Nama Kategori</th>
                                    <th width="20%" class="text-center">Kode Kategori</th>
                                    <th width="15%" class="text-center">Aksi</th>
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

<!-- Modal Tambah Kategori -->
<div class="modal fade" id="tambah-kategori" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Kategori</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="nama_kategori" class="col-form-label">Nama Kategori:</label>
                        <input type="text" class="form-control" name="nama_kategori" id="nama_kategori" require>
                    </div>
                </form>
                <form>
                    <div class="form-group">
                        <label for="kode_kategori" class="col-form-label">Kode Kategori:</label>
                        <input type="text" class="form-control" name="kode_kategori" id="kode_kategori" require>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger text-white" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-success text-white" id="simpankategori">Simpan</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Ubah Kategori -->
<div class="modal fade" id="edit-kategori" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Kategori</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="id">
                @csrf
                <form id="edit_kategori">
                    <form>
                        <div class="form-group">
                            <label for="nama_kategori" class="col-form-label">Nama Kategori:</label>
                            <input type="text" class="form-control" data-id="" name="nama_kategori" id="nama_kategori" require>
                        </div>
                    </form>
                    <form>
                        <div class="form-group">
                            <label for="kode_kategori" class="col-form-label">Kode Kategori:</label>
                            <input type="text" class="form-control" name="kode_kategori" id="kode_kategori" require>
                        </div>
                    </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-success text-white" id="updatekategori">Update</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        // Your code here
        //Tabel Barang
        $('#tabel-kategori').DataTable({
            processing: true,
            serverSide: true,
            destroy: true,
            columns: [{
                    data: 'nama_kategori',
                    name: 'nama_kategori'
                },
                {
                    data: 'kode_kategori',
                    name: 'kode_kategori'
                },
                {
                    data: 'aksi',
                    name: 'aksi',
                    orderable: false,
                    searchable: false
                },
            ],
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/id.json',
            }
        });
    });
</script>

<!-- Script Tambah Data Kategori -->
<script>
    $('body').on('click', '#tambahkategori', function() {

        //open modal
        $('#tambah-kategori').modal('show');
    });

    $('#simpankategori').click(function(e) {
        e.preventDefault();

        let nama_kategori = $('#nama_kategori').val();
        let kode_kategori = $('#kode_kategori').val();

        $.ajax({
            url: `{{url('/kategori/simpan')}}`,
            type: "POST",
            cache: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                "nama_kategori": nama_kategori,
                "kode_kategori": kode_kategori,
            },
            success: function(response) {
                Swal.fire({
                    icon: 'success',
                    title: "Kategori berhasil ditambahkan",
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timerProgressBar: true,
                    timer: 3000
                })

                $('#nama_kategori').val('');
                $('#kode_kategori').val('');


                $('#tabel-kategori').DataTable().ajax.reload();
                $('#tambah-kategori').modal('hide');

                let post = `
                    <tr id="index_${response.data.id}">
                        <td>${response.data.nama_kategori}</td>
                        <td>${response.data.kode_kategori}</td>
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

<!-- Script Update Kategori -->
<script>
    function lihatkategori(e) {
        event.preventDefault();
        var modal = document.getElementById("edit-kategori");
        var modale = new bootstrap.Modal(modal);

        // Open the modal
        modale.show();
        let id = e.getAttribute('data-id');

        $.ajax({
            url: `{{url("/kategori/lihat")}}/` + id,
            type: "GET",
            cache: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                //fill data to form
                $('#edit-kategori #id').val(response.id);
                $('#edit-kategori #nama_kategori').val(response.kategori.nama_kategori);
                $('#edit-kategori #kode_kategori').val(response.kategori.kode_kategori);
                $('#edit-kategori #nama_kategori').attr('data-id', id);
            }
        });
    };

    $('#updatekategori').click(function(e) {
        e.preventDefault();

        let id = $('#edit-kategori #nama_kategori').data('id');
        console.log(id);
        let nama_kategori = $('#edit-kategori #nama_kategori').val();
        let kode_kategori = $('#edit-kategori #kode_kategori').val();

        $.ajax({
            url: '/kategori/update/' + id,
            type: "PUT",
            cache: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                "nama_kategori": nama_kategori,
                "kode_kategori": kode_kategori,
            },
            success: function(response) {

                //show success message
                if (response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil Memperbarui Data',
                        text: "Kategori berhasil diperbarui",
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timerProgressBar: true,
                        timer: 3000
                    })
                } else {
                    Swal.fire({
                        icon: 'warning',
                        title: "Kategori sudah ada",
                        text: "Mohon gunakan nama kategori lainnya",
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timerProgressBar: true,
                        timer: 5000
                    })
                }

                //Melakukan Hide Modal dan Reload DataTable Setelah Simpan Berhasil
                $('#tabel-kategori').DataTable().clear().draw();
                $('#edit-kategori').modal('hide');

                //Post Data
                let post = `
                    <tr id="index_${response.data.id}">
                        <td>${response.data.nama_kategori}</td>
                        <td>${response.data.kode_kategori}</td>
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
            },
        })
    })
</script>

<!-- Script Hapus Data Kategori -->
<script>
    function deleteKategori(e) {
        event.preventDefault();
        let id = e.getAttribute('data-id');
        let name = e.getAttribute('data-name');
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Kategori " + name + " akan dihapus secara permanen!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/kategori/hapus/' + id,
                    type: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: "Kategori " + name + " berhasil dihapus",
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timerProgressBar: true,
                                timer: 3000
                            })
                            $('#tabel-kategori').DataTable().clear().draw();
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
                            title: "Gagal Menghapus Kategori",
                            text: "Kategori digunakan dalam data aset",
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timerProgressBar: true,
                            timer: 5000
                        })
                    }
                });
            }
        });
    }
</script>
@endsection