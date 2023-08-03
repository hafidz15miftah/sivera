<title>Detail Kondisi Barang &minus; Sistem Informasi Inventaris Barang dan Aset Desa</title>
@extends('layouts.app-layout')

@section('content')

<div class="row page-titles mx-0">
    <div class="col p-md-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Fungsional Sistem</a></li>
            <li class="breadcrumb-item"><a href="#">Aset Barang</a></li>
            <li class="breadcrumb-item active"><a href="/kondisibarang">Detail Kondisi</a></li>
        </ol>
    </div>
</div>
<!-- row -->

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Detail Kondisi Barang</h4>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambah-kondisi"><i class="fa fa-plus"></i> Tambah Kondisi</button>
                    <div class="table-responsive">
                        <table id="tabel-kondisi" class="table table-striped table-bordered zero-configuration">
                            <thead>
                                <tr>
                                    <th width="25%" class="text-center">Nama Barang</th>
                                    <th width="25%" class="text-center">Kategori</th>
                                    <th width="20%" class="text-center">ID Barang</th>
                                    <th width="25%" class="text-center">Ruang</th>
                                    <th width="10%" class="text-center">Kondisi</th>
                                    <th width="10%" class="text-center">Aksi</th>
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

<!-- Modal Tambah Barang -->
<div class="modal fade" id="tambah-kondisi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Detail Kondisi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="callout" class="alert alert-info" role="alert">
                    <div>
                        <h5 class="mb-1">Informasi Pemilihan Kondisi</h5>
                        <p class="mb-0"><i class="fa fa-check-circle"></i> Baik, yaitu apabila kondisi barang tersebut masih dalam keadaan utuh dan berfungsi dengan baik.</p>
                        <p class="mb-0"><i class="fa fa-exclamation-triangle"></i> Rusak Ringan, yaitu apabila kondisi barang tersebut masih dalam keadaan utuh, tetapi kurang berfungsi dengan baik. Untuk berfungsi dengan baik memerlukan perbaikan ringan dan tidak memerlukan penggantian bagian utama/komponen pokok.</p>
                        <p class="mb-0"><i class="fa fa-times-circle"></i> Rusak Berat, yaitu apabila kondisi barang tersebut tidak utuh dan tidak berfungsi lagi atau memerlukan perbaikan besar/penggantian bagian utama/komponen pokok, sehingga tidak ekonomis lagi untuk diadakan perbaikan/rehabilitasi.</p>
                    </div>
                </div>
                @csrf
                <form id="add_kondisi">
                    <div class="form-row">
                        <label for="barang_id" class="col-form-label">Nama Barang:</label>
                        <select class="form-control" name="barang_id" id="barang_id">
                            <option value="">Silahkan Pilih ...</option>
                            @foreach ($barang as $b)
                            <option value="{{ $b->id }}">{{ $b->nama_barang }} - {{ $b->ruang->nama_ruang }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-row">
                        <label for="kode_detail" class="col-form-label">ID Barang:</label>
                        <input type="text" class="form-control" name="kode_detail" id="kode_detail" disabled>
                    </div>
                    <div class="form-row">
                        <label for="kondisi" class="col-form-label">Kondisi:</label>
                        <select class="form-control" name="kondisi" id="kondisi" required>
                            <option value="">Silahkan Pilih ...</option>
                            <option value="1">Baik</option>
                            <option value="2">Rusak Ringan</option>
                            <option value="3">Rusak Berat</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                <button autofocus type="button" class="btn btn-success text-white" id="simpankondisi">Simpan</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit Kondisi -->
<div class="modal fade" id="edit-kondisi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ubah Detail Kondisi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="callout" class="alert alert-info" role="alert">
                    <div>
                        <h5 class="mb-1">Informasi Pemilihan Kondisi</h5>
                        <p class="mb-0"><i class="fa fa-check-circle"></i> Baik, yaitu apabila kondisi barang tersebut masih dalam keadaan utuh dan berfungsi dengan baik.</p>
                        <p class="mb-0"><i class="fa fa-exclamation-triangle"></i> Rusak Ringan, yaitu apabila kondisi barang tersebut masih dalam keadaan utuh, tetapi kurang berfungsi dengan baik. Untuk berfungsi dengan baik memerlukan perbaikan ringan dan tidak memerlukan penggantian bagian utama/komponen pokok.</p>
                        <p class="mb-0"><i class="fa fa-times-circle"></i> Rusak Berat, yaitu apabila kondisi barang tersebut tidak utuh dan tidak berfungsi lagi atau memerlukan perbaikan besar/penggantian bagian utama/komponen pokok, sehingga tidak ekonomis lagi untuk diadakan perbaikan/rehabilitasi.</p>
                    </div>
                </div>
                <input type="hidden" id="id">
                @csrf
                <form id="add_kondisi">
                    <div class="form-row">
                        <label for="barang_id" class="col-form-label">Nama Barang:</label>
                        <select class="form-control" name="barang_id" id="barang_id" required disabled>
                            <option value="">Silahkan Pilih ...</option>
                            @foreach ($barang as $b)
                            <option value="{{ $b->id }}">{{ $b->nama_barang }} - {{ $b->ruang->nama_ruang }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-row">
                        <label for="kode_detail" class="col-form-label">ID Barang:</label>
                        <input type="text" class="form-control" name="kode_detail" id="kode_detail" disabled>
                    </div>
                    <div class="form-row">
                        <label for="kondisi" class="col-form-label">Kondisi:</label>
                        <select class="form-control" name="kondisi" id="kondisi" required>
                            <option value="">Silahkan Pilih ...</option>
                            <option value="1">Baik</option>
                            <option value="2">Rusak Ringan</option>
                            <option value="3">Rusak Berat</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                <button autofocus type="button" class="btn btn-success text-white" id="updatekondisi">Update</button>
            </div>
        </div>
    </div>
</div>

<!-- Menampilkan Kode Barang -->
<script>
    document.getElementById('barang_id').addEventListener('change', function() {
        var selectElement = this;
        var selectedIndex = selectElement.selectedIndex;

        var kode_barang = '';
        var nomor = selectedIndex;

        $.ajax({
            url: 'get-jumlah-info',
            method: 'GET',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                var count = response;
                console.log("Number of barang: " + count);

                if (selectedIndex !== 0) {
                    var option = selectElement.options[selectedIndex];
                    var kode_barang = "{!! addslashes(json_encode($barang->pluck('kode_barang')->toArray())) !!}";


                    if (selectedIndex !== -1) {
                        var kode_barang = JSON.parse(kode_barang)[selectedIndex - 1];
                        var kode_detail = kode_barang + '.' + count;
                        document.getElementById('kode_detail').value = kode_detail;
                    }
                } else {
                    document.getElementById('kode_detail').value = '';
                }
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });

    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        //Tabel Pelaporan
        $('#tabel-kondisi').DataTable({
            processing: true,
            serverSide: true,
            destroy: true,
            columns: [{
                    data: 'nama_barang',
                    name: 'nama_barang'
                },
                {
                    data: 'nama_kategori',
                    name: 'nama_kategori',
                },
                {
                    data: 'kode_detail',
                    name: 'kode_detail'
                },
                {
                    data: 'nama_ruang',
                    name: 'nama_ruang',
                },
                {
                    data: 'kondisi',
                    name: 'kondisi',
                },
                {
                    data: 'aksi',
                    name: 'aksi',
                    orderable: false,
                    searchable: false
                },
            ],
            columnDefs: [
                // targets may be classes
                {
                    targets: [1],
                    searchable: false
                }
            ],
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/id.json',
            }
        });
    });
</script>

<!-- Script Tambah Data Kondisi Aset -->
<script>
    //button create post event
    $('body').on('click', '#tambahkondisi', function() {
        //open modal
        $('#tambah-kondisi').modal('show');
    });

    //action create post
    $('#simpankondisi').click(function(e) {
        e.preventDefault();

        //define variable
        let kode_detail = $('#kode_detail').val();
        let kondisi = $('#kondisi').val();
        let barang_id = $('#barang_id').val();

        //ajax
        $.ajax({
            url: `{{url('/kondisi/simpan')}}`,
            type: "POST",
            cache: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                "kode_detail": kode_detail,
                "kondisi": kondisi,
                "barang_id": barang_id,
            },
            success: function(response) {

                //show success message
                Swal.fire({
                    icon: 'success',
                    title: "Data kondisi berhasil ditambahkan",
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timerProgressBar: true,
                    timer: 3000
                })

                //Reset Data Form Setelah Simpan Berhasil
                $('#kode_detail').val('');
                $('#kondisi').prop('selectedIndex', 0);
                $('#barang_id').prop('selectedIndex', 0);
                $('#ruang_id').prop('selectedIndex', 0);

                //Melakukan Hide Modal dan Reload DataTable Setelah Simpan Berhasil
                $('#tabel-kondisi').DataTable().clear().draw();
                $('#tambah-kondisi').modal('hide');

                //Post Data
                let post = `
                    <tr id="index_${response.data.id}">
                        <td>${response.data.kode_detail}</td>
                        <td>${response.data.kondisi}</td>
                        <td>${response.data.ruang_id}</td>
                        <td>${response.data.barang_id}</td>
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

<!-- Script Update Data Kondisi -->
<script>
    function ubahdatakondisi(e) {
        event.preventDefault();
        var modal = document.getElementById("edit-kondisi");
        var modale = new bootstrap.Modal(modal);

        // Open the modal
        modale.show();
        let id = e.getAttribute('data-id');

        $.ajax({
            url: `{{url("/kondisi/lihat")}}/` + id,
            type: "GET",
            cache: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                //fill data to form
                $('#edit-kondisi #id').val(response[0].id);
                $('#edit-kondisi #barang_id').val(response[0].barang_id);
                $('#edit-kondisi #ruang_id').val(response[0].ruang_id);
                $('#edit-kondisi #kode_detail').val(response[0].kode_detail);
                $('#edit-kondisi #kondisi').val(response[0].kondisi);
            }
        });
    };

    $('#updatekondisi').click(function(e) {
        e.preventDefault();
        let id = $('#edit-kondisi #id').val();
        let ruang_id = $('#edit-kondisi #ruang_id').val();
        let barang_id = $('#edit-kondisi #barang_id').val();
        let kode_detail = $('#edit-kondisi #kode_detail').val();
        let kondisi = $('#edit-kondisi #kondisi').val();

        $.ajax({
            url: `/kondisi/update/` + id,
            type: "PUT",
            cache: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                "barang_id": barang_id,
                "ruang_id": ruang_id,
                "kode_detail": kode_detail,
                "kondisi": kondisi,
            },
            success: function(response) {

                //show success message
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil Memperbarui Data',
                    text: "Kondisi barang berhasil diperbarui",
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timerProgressBar: true,
                    timer: 3000
                })

                //Melakukan Hide Modal dan Reload DataTable Setelah Simpan Berhasil
                $('#tabel-kondisi').DataTable().clear().draw();
                $('#edit-kondisi').modal('hide');

                //Post Data
                let post = `
                    <tr id="index_${response.data.id}">
                    <td>${response.data.barang_id}</td>
                        <td>${response.data.ruang_id}</td>
                        <td>${response.data.kode_detail}</td>
                        <td>${response.data.kondisi}</td>
                    </tr>
                `;
            },
        })
    })
</script>

<!-- Script Hapus Data Kondisi -->
<script>
    function deleteDataKondisi(e) {
        event.preventDefault();
        let id = e.getAttribute('data-id');
        let name = e.getAttribute('data-name');
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Data kondisi " + name + " akan dihapus secara permanen!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/kondisi/hapus/' + id,
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
                            $('#tabel-kondisi').DataTable().clear().draw();
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
                            title: 'Gagal Menghapus Barang',
                            text: 'Kondisi barang ' + name + ' sudah dilaporkan dalam detail barang',
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
<!-- Menampilkan Ruangan -->
@endsection