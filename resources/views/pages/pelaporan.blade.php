<title>Daftar Laporan &minus; Sistem Informasi Inventaris Barang dan Aset Desa</title>
@extends('layouts.app-layout')

@section('content')
<div class="row page-titles mx-0">
    <div class="col p-md-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Pelaporan</a></li>
            <li class="breadcrumb-item active"><a href="/pelaporan">Daftar Laporan</a></li>
        </ol>
    </div>
</div>
<!-- row -->

<!-- Modal Tambah Pelaporan -->
<div class="modal fade" id="tambah-pelaporan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Buat Laporan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="add_pelaporan" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="barang_id">Pilih ID Barang:</label>
                        <select class="form-control" name="info_id" id="info_id" required>
                            <option value="">Silahkan Pilih ...</option>
                            @foreach ($info as $i)
                            <option value="{{ $i->id }}">{{ $i->kode_detail }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="nama_laporan">Nama Laporan</label>
                                <input class="form-control" type="text" id="nama_laporan" name="nama_laporan">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="file_pdf">File Gambar Barang Rusak</label>
                                <input class="form-control" type="file" name="file_gambar" id="file_gambar" accept="image/*">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="file_pdf">File Berita Acara dalam PDF</label>
                                <input class="form-control" type="file" name="file_pdf" id="file_pdf" accept="application/pdf">
                            </div>
                        </div>
                    </div>
                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-success text-white" id="simpanPelaporan">Laporkan</button>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Daftar Laporan</h4>
                    @if (Auth::user()->role_id == 2)
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambah-pelaporan"><i class="fa fa-plus"></i> Tambah Pelaporan</button>
                    <a class="btn btn-warning" style="color:white" href="{{ url('pelaporan/cetak/bulanan') }}"><i class="fa fa-print"></i> Cetak Laporan Bulan Ini</a>
                    <!-- <a class="btn btn-warning" style="color:white" href="{{ url('pelaporan/cetak/tahunan') }}"><i class="fa fa-print"></i> Laporan Tahun Ini</a> -->
                    @endif
                    <div class="table-responsive">
                        <table id="tabel-pelaporan" class="table table-striped table-bordered zero-configuration">
                            <thead>
                                <tr>
                                    <th style="text-align: center">No</th>
                                    <th style="text-align: center">ID Barang</th>
                                    <th style="text-align: center">Nama Laporan</th>
                                    <th style="text-align: center">Tanggal Dilaporkan</th>
                                    <th style="text-align: center" width="20%">Status</th>
                                    <th style="text-align: center">Keterangan</th>
                                    <th style="text-align: center" width="35%">Aksi</th>
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

<script type="text/javascript">
    $(document).ready(function() {
        //Tabel Pelaporan
        $('#tabel-pelaporan').DataTable({
            processing: true,
            serverSide: true,
            destroy: true,
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'kode_detail',
                    name: 'kode_detail'
                },
                {
                    data: 'nama_laporan',
                    name: 'nama_laporan'
                },
                {
                    data: 'tanggal_dilaporkan',
                    name: 'tanggal_dilaporkan'
                },
                {
                    data: 'status_html',
                    name: 'status'
                },
                {
                    data: 'keterangan',
                    name: 'keterangan'
                },
                {
                    data: 'aksi',
                    name: 'aksi',
                    orderable: false,
                    searchable: false
                },
            ],
            order: [
                [2, 'desc']
            ],
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/id.json',
            }
        });
    });
</script>

<!-- Script Tambah Pelaporan -->
<script>
    //action create post
    $('#simpanPelaporan').click(function(e) {
        e.preventDefault();

        // Define variable
        var form = document.getElementById('add_pelaporan');
        var formData = new FormData(form);

        // Ajax
        $.ajax({
            url: "{{ url('/uploadPDF') }}",
            type: "POST",
            cache: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                // Show success message
                Swal.fire({
                    icon: 'success',
                    title: "Laporan berhasil dibuat",
                    text: "Silahkan menunggu konfirmasi Sekretaris Desa dan Kepala Desa",
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timerProgressBar: true,
                    timer: 5000
                });

                // Reset Data Form Setelah Simpan Berhasil
                $('#add_pelaporan')[0].reset();

                // Melakukan Hide Modal dan Reload DataTable Setelah Simpan Berhasil
                $('#tabel-pelaporan').DataTable().clear().draw();
                $('#tambah-pelaporan').modal('hide');

                // Post Data
                let post = `
                <tr id="index_${response.data.id}">
                <td>${response.data.info_id}</td>
                    <td>${response.data.nama_laporan}</td>
                    <td>${response.data.file_pdf}</td>
                    <td>${response.data.file_gambar}</td>
                </tr>
            `;
            },
            error: function(xhr, status, error) {
                // Parse the JSON response
                var errorData = JSON.parse(xhr.responseText);

                // Access the errors array
                var errors = errorData.errors;

                // Get the first error message
                var errorMessage = Object.values(errors)[0][0];

                Swal.fire({
                    icon: 'error',
                    title: "Gagal Menyimpan Data!",
                    text: errorMessage,
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timerProgressBar: true,
                    timer: 3000
                });
            }
        });
    });
</script>

<script>
    function deleteDataLaporan(e) {
        event.preventDefault();
        let id = e.getAttribute('data-id');
        let name = e.getAttribute('data-name');
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Laporan " + name + " akan dihapus secara permanen!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/pelaporan/hapus/' + id,
                    type: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: "Berhasil Menghapus Laporan",
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timerProgressBar: true,
                                timer: 3000
                            })
                            $('#tabel-pelaporan').DataTable().clear().draw();
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
                            title: "Gagal Menghapus Laporan",
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

<!-- Menolak dan Menyetujui Laporan -->
<script>
    function tolakLaporan(e) {
        let id = e.getAttribute('data-id');

        Swal.fire({
            title: 'Tolak Laporan',
            text: 'Masukkan keterangan penolakan laporan',
            icon: 'info',
            input: 'text',
            showCancelButton: true,
            confirmButtonText: 'Tolak',
            cancelButtonText: 'Batal',
            showLoaderOnConfirm: true,
            allowOutsideClick: () => !Swal.isLoading(),
        }).then((result) => {
            if (result.isConfirmed) {
                let keterangan = result.value;

                $.ajax({
                    url: '/pelaporan/tolak/' + id,
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        keterangan: keterangan // Mengirim keterangan ke server
                    },
                    success: function(response) {
                        // Tampilkan pesan sukses
                        Swal.fire({
                            icon: 'success',
                            title: response.message,
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timerProgressBar: true,
                            timer: 3000
                        });

                        // Lakukan refresh atau reload tabel laporan
                        $('#tabel-pelaporan').DataTable().ajax.reload();
                    },
                    error: function(xhr, status, error) {
                        // Tampilkan pesan error
                        var errorMessage = xhr.responseJSON.message;
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal Menolak Laporan',
                            text: errorMessage,
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timerProgressBar: true,
                            timer: 3000
                        });
                    }
                });
            }
        });
    }

    function setujuLaporan(e) {
        let id = e.getAttribute('data-id');

        Swal.fire({
            title: 'Konfirmasi',
            text: 'Apakah Anda yakin akan menyetujui laporan ini?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Setuju',
            cancelButtonText: 'Batal',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/pelaporan/setuju/' + id,
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        // Tampilkan pesan sukses
                        Swal.fire({
                            icon: 'success',
                            title: response.message,
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timerProgressBar: true,
                            timer: 3000
                        });

                        // Lakukan refresh atau reload tabel laporan
                        $('#tabel-pelaporan').DataTable().ajax.reload();
                    },
                    error: function(xhr, status, error) {
                        // Tampilkan pesan error
                        var errorMessage = xhr.responseJSON.message;
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal Menyetujui Laporan',
                            text: errorMessage,
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timerProgressBar: true,
                            timer: 3000
                        });
                    }
                });
            }
        });
    }
</script>
<!-- #/ container -->
@endsection