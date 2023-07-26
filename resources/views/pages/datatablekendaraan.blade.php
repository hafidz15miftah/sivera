<title>Aset Kendaraan &minus; Sistem Informasi Inventaris Barang dan Aset Desa</title>
@extends('layouts.app-layout')

@section('content')

<div class="row page-titles mx-0">
    <div class="col p-md-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Fungsional Sistem</a></li>
            <li class="breadcrumb-item active"><a href="/kendaraan">Aset Kendaraan</a></li>
        </ol>
    </div>
</div>
<!-- row -->

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Aset Kendaraan</h4>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambah-kendaraan"><i class="fa fa-plus"></i> Tambah Aset Kendaraan</button>
                    @if (Auth::user()->role_id == 2 || Auth::user()->role_id == 5)
                    <a class="btn btn-warning" style="color:white" href="{{url('kendaraan/cetak/semua')}}"><i class="fa fa-print"></i> Cetak Data Aset Kendaraan</a>
                    @endif
                    <div class="table-responsive">
                        <table id="tabel-kendaraan" class="table table-striped table-bordered zero-configuration">
                            <thead>
                                <tr>
                                    <th class="text-center">Nama Kendaraan</th>
                                    <th class="text-center">Plat</th>
                                    <th class="text-center">Merk</th>
                                    <th class="text-center">Tipe</th>
                                    <th class="text-center">Kondisi</th>
                                    <th width="28%" class="text-center">Aksi</th>
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

<!-- Modal Tambah Data Aset Kendaraan -->
<div class="modal fade" id="tambah-kendaraan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Aset Kendaraan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="callout" class="alert alert-info" role="alert">
                    <div>
                        <h5 class="mb-1">Informasi Pemilihan Kondisi</h5>
                        <p class="mb-0"><i class="fa fa-check-circle"></i> Baik, yaitu apabila kondisi kendaraan tersebut masih dalam keadaan utuh dan berfungsi dengan baik.</p>
                        <p class="mb-0"><i class="fa fa-exclamation-triangle"></i> Rusak Ringan, yaitu apabila kondisi kendaraan tersebut masih dalam keadaan utuh, tetapi kurang berfungsi dengan baik. Untuk berfungsi dengan baik memerlukan perbaikan ringan dan tidak memerlukan penggantian bagian utama/komponen pokok.</p>
                        <p class="mb-0"><i class="fa fa-times-circle"></i> Rusak Berat, yaitu apabila kondisi kendaraan tersebut tidak utuh dan tidak berfungsi lagi atau memerlukan perbaikan besar/penggantian bagian utama/komponen pokok, sehingga tidak ekonomis lagi untuk diadakan perbaikan/rehabilitasi.</p>
                    </div>
                </div>
                @csrf
                <form id="add_kendaraan">
                    <div class="form-row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="nama_kendaraan" class="col-form-label">Nama Kendaraan:</label>
                                <input type="text" class="form-control" name="nama_kendaraan" id="nama_kendaraan" require>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="plat" class="col-form-label">Nomor Plat Kepolisian:</label>
                                <input type="text" class="form-control" name="plat" id="plat" require>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="tgl_pembelian" class="col-form-label">Tanggal Pembelian:</label>
                                <input type="date" class="form-control" name="tgl_pembelian" id="tgl_pembelian" require>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="merk" class="col-form-label">Merk:</label>
                                <input type="merk" class="form-control" name="merk" id="merk" require>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="tipe" class="col-form-label">Tipe:</label>
                                <input type="tipe" class="form-control" name="tipe" id="tipe" require>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="kondisi" class="col-form-label">Kondisi:</label>
                                <select class="form-control" name="kondisi" id="kondisi" required>
                                    <option value="">Silahkan Pilih ...</option>
                                    <option value="1">Baik</option>
                                    <option value="2">Rusak Ringan</option>
                                    <option value="3">Rusak Berat</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="keterangan">Keterangan</label>
                                <textarea class="form-control" name="keterangan" placeholder="Opsional" id="keterangan"></textarea>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                <button autofocus type="button" class="btn btn-success text-white" id="simpankendaraan">Simpan</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Update Aset Kendaraan -->
<div class="modal fade" id="edit-kendaraan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Data Aset Kendaraan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="callout" class="alert alert-info" role="alert">
                    <div>
                        <h5 class="mb-1">Informasi Pemilihan Kondisi</h5>
                        <p class="mb-0"><i class="fa fa-check-circle"></i> Baik, yaitu apabila kondisi kendaraan tersebut masih dalam keadaan utuh dan berfungsi dengan baik.</p>
                        <p class="mb-0"><i class="fa fa-exclamation-triangle"></i> Rusak Ringan, yaitu apabila kondisi kendaraan tersebut masih dalam keadaan utuh, tetapi kurang berfungsi dengan baik. Untuk berfungsi dengan baik memerlukan perbaikan ringan dan tidak memerlukan penggantian bagian utama/komponen pokok.</p>
                        <p class="mb-0"><i class="fa fa-times-circle"></i> Rusak Berat, yaitu apabila kondisi kendaraan tersebut tidak utuh dan tidak berfungsi lagi atau memerlukan perbaikan besar/penggantian bagian utama/komponen pokok, sehingga tidak ekonomis lagi untuk diadakan perbaikan/rehabilitasi.</p>
                    </div>
                </div>
                <input type="hidden" id="id">
                @csrf
                <form id="edit_kendaraan">
                    <div class="form-row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="nama_kendaraan" class="col-form-label">Nama Kendaraan:</label>
                                <input type="text" class="form-control" name="nama_kendaraan" id="nama_kendaraan" require>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="plat" class="col-form-label">Nomor Plat Kepolisian:</label>
                                <input type="text" class="form-control" name="plat" id="plat" require>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="tgl_pembelian" class="col-form-label">Tanggal Pembelian:</label>
                                <input type="date" class="form-control" name="tgl_pembelian" id="tgl_pembelian" require>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="merk" class="col-form-label">Merk:</label>
                                <input type="merk" class="form-control" name="merk" id="merk" require>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="tipe" class="col-form-label">Tipe:</label>
                                <input type="tipe" class="form-control" name="tipe" id="tipe" require>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="kondisi" class="col-form-label">Kondisi:</label>
                                <select class="form-control" name="kondisi" id="kondisi" required>
                                    <option value="">Silahkan Pilih ...</option>
                                    <option value="1">Baik</option>
                                    <option value="2">Rusak Ringan</option>
                                    <option value="3">Rusak Berat</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="keterangan">Keterangan</label>
                                <textarea class="form-control" name="keterangan" placeholder="Opsional" id="keterangan"></textarea>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                <button autofocus type="button" class="btn btn-success text-white" id="updatekendaraan">Update</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Lihat Aset Kendaraan -->
<div class="modal fade" id="lihat-kendaraan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Lihat Detail Data Aset Kendaraan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
            </div>
            <div class="modal-body">
                <p><strong>Nama Kendaraan:</strong> <span id="nama_kendaraan"></span></p>
                <p><strong>Nomor Plat Kepolisian:</strong> <span id="plat"></span></p>
                <p><strong>Tanggal Pembelian:</strong> <span id="tgl_pembelian"></span></p>
                <p><strong>Merk:</strong> <span id="merk"></span></p>
                <p><strong>Tipe:</strong> <span id="tipe"></span></p>
                <p><strong>Kondisi:</strong> <span id="kondisi"></span></p>
                <p><strong>Keterangan:</strong> <span id="keterangan"></span></p>
                <p><strong>Ditambahkan:</strong> <span id="created_at"></span></p>
                <p><strong>Terakhir Diubah:</strong> <span id="updated_at"></span></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary text-white" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        //Tabel Lahan/Tanah
        $('#tabel-kendaraan').DataTable({
            processing: true,
            serverSide: true,
            destroy: true,
            columns: [{
                    data: 'nama_kendaraan',
                    name: 'nama_kendaraan',
                },
                {
                    data: 'plat',
                    name: 'plat',
                },
                {
                    data: 'merk',
                    name: 'merk',
                },
                {
                    data: 'tipe',
                    name: 'tipe',
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
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/id.json',
            }
        });
    });
</script>

<!-- Script Tambah Data Aset Kendaraan -->
<script>
    //button create post event
    $('body').on('click', '#tambahkendaraan', function() {
        //open modal
        $('#tambah-kendaraan').modal('show');
    });

    //action create post
    $('#simpankendaraan').click(function(e) {
        e.preventDefault();

        //define variable
        let nama_kendaraan = $('#nama_kendaraan').val();
        let plat = $('#plat').val();
        let tgl_pembelian = $('#tgl_pembelian').val();
        let merk = $('#merk').val();
        let tipe = $('#tipe').val();
        let kondisi = $('#kondisi').val();
        let keterangan = $('#keterangan').val();

        //ajax
        $.ajax({
            url: `{{url('/simpankendaraan')}}`,
            type: "POST",
            cache: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                "nama_kendaraan": nama_kendaraan,
                "plat": plat,
                "tgl_pembelian": tgl_pembelian,
                "merk": merk,
                "tipe": tipe,
                "kondisi": kondisi,
                "keterangan": keterangan,

            },
            success: function(response) {

                //show success message
                Swal.fire({
                    icon: 'success',
                    title: "Berhasil Menambahkan Data",
                    text: "Aset kendaraan berhasil ditambahkan",
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timerProgressBar: true,
                    timer: 3000
                })

                //Reset Data Form Setelah Simpan Berhasil
                $('#nama_kendaraan').val('');
                $('#plat').val('');
                $('#tgl_pembelian').val('');
                $('#merk').val('');
                $('#tipe').val('');
                $('#kondisi').prop('selectedIndex', 0);
                $('#keterangan').val('');

                //Melakukan Hide Modal dan Reload DataTable Setelah Simpan Berhasil
                $('#tabel-kendaraan').DataTable().clear().draw();
                $('#tambah-kendaraan').modal('hide');

                //Post Data
                let post = `
                    <tr id="index_${response.data.id}">
                        <td>${response.data.nama_kendaraan}</td>
                        <td>${response.data.plat}</td>
                        <td>${response.data.tgl_pembelian}</td>
                        <td>${response.data.merk}</td>
                        <td>${response.data.tipe}</td>
                        <td>${response.data.kondisi}</td>
                        <td>${response.data.keterangan}</td>
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

<!-- Script Lihat Data Kendaraan -->
<script>
    function lihatdatakendaraan(e) {
        event.preventDefault();
        var modal = document.getElementById("lihat-kendaraan");
        var modale = new bootstrap.Modal(modal);

        // Open the modal
        modale.show();
        let id = e.getAttribute('data-id');

        $.ajax({
            url: `{{url("/lihatkendaraan")}}/` + id,
            type: "GET",
            cache: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {

                let pembelian = new Date(response[0].tgl_pembelian);
                let pengaturan = {
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric'
                }
                let lokal = 'id-ID';
                let dateFormatted = pembelian.toLocaleDateString(lokal, pengaturan);

                //Mengubah created_at menjadi tanggal local
                let createdAt = new Date(response[0].created_at);
                let options = {
                    weekday: 'long',
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric',
                    hour: 'numeric',
                    minute: 'numeric'
                };
                let locale = 'id-ID';
                let formattedDate = createdAt.toLocaleDateString(locale, options);

                //Mengubah updated_at menjadi tanggal local
                let updatedAt = new Date(response[0].updated_at);
                let updatedAtDate = updatedAt.toLocaleDateString(locale, options);

                // Map the "kondisi" value to its respective label
                let kondisiLabel = " ";
                if (response[0].kondisi == 1) {
                    kondisiLabel = "Baik";
                } else if (response[0].kondisi == 2) {
                    kondisiLabel = "Rusak Ringan";
                } else {
                    kondisiLabel = "Rusak Berat"
                }

                // Fill data to form
                $('#lihat-kendaraan #id').text(response.id);
                $('#lihat-kendaraan #nama_kendaraan').text(response[0].nama_kendaraan);
                $('#lihat-kendaraan #plat').text(response[0].plat);
                $('#lihat-kendaraan #tgl_pembelian').text(dateFormatted);
                $('#lihat-kendaraan #merk').text(response[0].merk);
                $('#lihat-kendaraan #tipe').text(response[0].tipe);
                $('#lihat-kendaraan #kondisi').text(kondisiLabel); // Use the mapped label
                $('#lihat-kendaraan #keterangan').text(response[0].keterangan);
                document.getElementById("created_at").innerHTML = formattedDate;
                document.getElementById("updated_at").innerHTML = updatedAtDate;
            }
        });
    };
</script>

<!-- Script Update Data Kendaraan -->
<script>
    function updatedatakendaraan(e) {
        event.preventDefault();
        var modal = document.getElementById("edit-kendaraan");
        var modale = new bootstrap.Modal(modal);

        // Open the modal
        modale.show();
        let id = e.getAttribute('data-id');

        $.ajax({
            url: `{{url("/lihatkendaraan")}}/` + id,
            type: "GET",
            cache: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                //fill data to form
                $('#edit-kendaraan #id').val(response[0].id);
                $('#edit-kendaraan #nama_kendaraan').val(response[0].nama_kendaraan);
                $('#edit-kendaraan #plat').val(response[0].plat);
                $('#edit-kendaraan #tgl_pembelian').val(response[0].tgl_pembelian);
                $('#edit-kendaraan #merk').val(response[0].merk);
                $('#edit-kendaraan #tipe').val(response[0].tipe);
                $('#edit-kendaraan #kondisi').val(response[0].kondisi);
                $('#edit-kendaraan #keterangan').val(response[0].keterangan);
            }
        });
    };

    $('#updatekendaraan').click(function(e) {
        e.preventDefault();

        let id = $('#edit-kendaraan #id').val();
        let nama_kendaraan = $('#edit-kendaraan #nama_kendaraan').val();
        let plat = $('#edit-kendaraan #plat').val();
        let tgl_pembelian = $('#edit-kendaraan #tgl_pembelian').val();
        let merk = $('#edit-kendaraan #merk').val();
        let tipe = $('#edit-kendaraan #tipe').val();
        let kondisi = $('#edit-kendaraan #kondisi').val();
        let keterangan = $('#edit-kendaraan #keterangan').val();

        $.ajax({
            url: `{{url("/updatekendaraan")}}/` + id,
            type: "PUT",
            cache: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                "nama_kendaraan": nama_kendaraan,
                "plat": plat,
                "tgl_pembelian": tgl_pembelian,
                "merk": merk,
                "tipe": tipe,
                "kondisi": kondisi,
                "keterangan": keterangan,
            },
            success: function(response) {

                //show success message
                Swal.fire({
                    icon: 'success',
                    title: "Berhasil Memperbarui Data",
                    text: 'Data kendaraan berhasil diperbarui',
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timerProgressBar: true,
                    timer: 3000
                })

                //Melakukan Hide Modal dan Reload DataTable Setelah Simpan Berhasil
                $('#tabel-kendaraan').DataTable().clear().draw();
                $('#edit-kendaraan').modal('hide');

                //Post Data
                let post = `
                    <tr id="index_${response.data.id}">
                    <td>${response.data.nama_kendaraan}</td>
                        <td>${response.data.plat}</td>
                        <td>${response.data.tgl_pembelian}</td>
                        <td>${response.data.merk}</td>
                        <td>${response.data.tipe}</td>
                        <td>${response.data.kondisi}</td>
                        <td>${response.data.keterangan}</td>
                    </tr>
                `;
            },
        })
    })
</script>

<!-- Script Hapus Data Lahan -->
<script>
    function deleteDataKendaraan(e) {
        event.preventDefault();
        let id = e.getAttribute('data-id');
        let name = e.getAttribute('data-name');
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Data kendaraan " + name + " akan dihapus secara permanen!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/hapuskendaraan/' + id,
                    type: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: "Berhasil Menghapus Data Aset Kendaraan",
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timerProgressBar: true,
                                timer: 3000
                            })
                            $('#tabel-kendaraan').DataTable().clear().draw();
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
                            title: "Gagal Menghapus Aset Kendaraan",
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