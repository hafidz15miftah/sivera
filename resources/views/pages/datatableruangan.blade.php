<title>Data Ruangan &minus; Sistem Informasi Inventaris Barang dan Aset Desa</title>
@extends('layouts.app-layout')

@section('content')

<div class="row page-titles mx-0">
    <div class="col p-md-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Fungsional Sistem</a></li>
            <li class="breadcrumb-item"><a href="#">Aset Barang</a></li>
            <li class="breadcrumb-item active"><a href="/ruangan">Data Ruangan</a></li>
        </ol>
    </div>
</div>
<!-- row -->

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Data Ruangan</h4>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambah-ruangan"><i class="fa fa-plus"></i> Tambah Ruangan</button>
                    <div class="table-responsive">
                        <table id="tabel-ruangan" class="table table-striped table-bordered zero-configuration">
                            <thead>
                                <tr>
                                    <th class="text-center">Nama Ruang</th>
                                    <th class="text-center">Kode Ruang</th>
                                    <th class="text-center" width="20%">Aksi</th>
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

<!-- Modal Tambah Ruangan -->
<div class="modal fade" id="tambah-ruangan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Ruangan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="nama_ruang" class="col-form-label">Nama Ruangan:</label>
                        <input type="text" class="form-control" name="nama_ruang" id="nama_ruang" require>
                    </div>
                </form>
                <form>
                    <div class="form-group">
                        <label for="kode_ruang" class="col-form-label">Kode Ruangan:</label>
                        <input type="text" class="form-control" name="kode_ruang" id="kode_ruang" require>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger text-white" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-success text-white" id="simpanruangan">Simpan</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Ubah Ruangan -->
<div class="modal fade" id="edit-ruangan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Data Ruangan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="id">
                @csrf
                <form id="edit_ruangan">
                    <form>
                        <div class="form-group">
                            <label for="nama_ruang" class="col-form-label">Nama Ruangan:</label>
                            <input type="text" class="form-control" data-id="" name="nama_ruang" id="nama_ruang" require>
                        </div>
                    </form>
                    <form>
                        <div class="form-group">
                            <label for="kode_ruang" class="col-form-label">Kode Ruangan:</label>
                            <input type="text" class="form-control" name="kode_ruang" id="kode_ruang" require>
                        </div>
                    </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-success text-white" id="updateruangan">Update</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        //Tabel Ruangan
        $('#tabel-ruangan').DataTable({
            processing: true,
            serverSide: true,
            destroy: true,
            columns: [{
                    data: 'nama_ruang',
                    name: 'nama_ruang',
                },
                {
                    data: 'kode_ruang',
                    name: 'kode_ruang'
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

<!-- Script Tambah Data Ruangan -->
<script>
    $('body').on('click', '#tambahruangan', function() {

        //open modal
        $('#tambah-ruangan').modal('show');
    });

    $('#simpanruangan').click(function(e) {
        e.preventDefault();

        let nama_ruang = $('#nama_ruang').val();
        let kode_ruang = $('#kode_ruang').val();

        $.ajax({
            url: `{{url('/simpanruangan')}}`,
            type: "POST",
            cache: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                "nama_ruang": nama_ruang,
                "kode_ruang": kode_ruang,
            },
            success: function(response) {
                Swal.fire({
                    icon: 'success',
                    title: "Data ruangan berhasil ditambahkan",
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timerProgressBar: true,
                    timer: 3000
                })

                $('#nama_ruang').val('');
                $('#kode_ruang').val('');


                $('#tabel-ruangan').DataTable().ajax.reload();
                $('#tambah-ruangan').modal('hide');

                let post = `
                    <tr id="index_${response.data.id}">
                        <td>${response.data.nama_ruang}</td>
                        <td>${response.data.kode_ruang}</td>
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

<!-- Script Update Data Ruangan -->
<script>
    function lihatruangan(e) {
        event.preventDefault();
        var modal = document.getElementById("edit-ruangan");
        var modale = new bootstrap.Modal(modal);

        // Open the modal
        modale.show();
        let id = e.getAttribute('data-id');

        $.ajax({
            url: `{{url("/lihatruangan")}}/` + id,
            type: "GET",
            cache: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                //fill data to form
                $('#edit-ruangan #id').val(response.id);
                $('#edit-ruangan #nama_ruang').val(response.ruang.nama_ruang);
                $('#edit-ruangan #kode_ruang').val(response.ruang.kode_ruang);
                $('#edit-ruangan #nama_ruang').attr('data-id', id);
                console.log(response.ruang.nama_ruang);
            }
        });
    };

    $('#updateruangan').click(function(e) {
        e.preventDefault();

        let id = $('#edit-ruangan #nama_ruang').data('id');
        console.log(id);
        let nama_ruang = $('#edit-ruangan #nama_ruang').val();
        let kode_ruang = $('#edit-ruangan #kode_ruang').val();

        $.ajax({
            url: '/updateruangan/' + id,
            type: "PUT",
            cache: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                "nama_ruang": nama_ruang,
                "kode_ruang": kode_ruang,
            },
            success: function(response) {

                //show success message
                if (response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil Memperbarui Data',
                        text: "Nama ruangan berhasil diperbarui",
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timerProgressBar: true,
                        timer: 3000
                    })
                } else {
                    Swal.fire({
                        icon: 'warning',
                        title: "Data ruangan sudah ada",
                        text: "Mohon gunakan nama ruangan lainnya",
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timerProgressBar: true,
                        timer: 5000
                    })
                }

                //Melakukan Hide Modal dan Reload DataTable Setelah Simpan Berhasil
                $('#tabel-ruangan').DataTable().clear().draw();
                $('#edit-ruangan').modal('hide');

                //Post Data
                let post = `
                    <tr id="index_${response.data.id}">
                        <td>${response.data.nama_ruang}</td>
                        <td>${response.data.kode_ruang}</td>
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

<!-- Script Hapus Data Ruangan -->
<script>
    function deleteDataRuangan(e) {
        event.preventDefault();
        let id = e.getAttribute('data-id');
        let name = e.getAttribute('data-name');
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Data " + name + " akan dihapus secara permanen!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/hapusruangan/' + id,
                    type: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: "Data " + name + " berhasil dihapus",
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timerProgressBar: true,
                                timer: 3000
                            })
                            $('#tabel-ruangan').DataTable().clear().draw();
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
                            title: "Gagal Menghapus Ruangan",
                            text: "Pastikan tidak terdapat barang di ruang " + name,
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