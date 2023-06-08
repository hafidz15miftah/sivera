<title>Aset Tanah/Lahan &minus; Sistem Informasi Inventaris Barang dan Aset Desa</title>
@extends('layouts.app-layout')

@section('content')

<div class="row page-titles mx-0">
    <div class="col p-md-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Fungsional Sistem</a></li>
            <li class="breadcrumb-item active"><a href="/aset">Aset Tanah / Lahan</a></li>
        </ol>
    </div>
</div>
<!-- row -->

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Aset Tanah/Lahan</h4>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambah-lahan"><i class="fa fa-plus"></i> Tambah Aset Tanah / Lahan</button>
                    <a class="btn btn-warning" style="color:white" href="{{url('lahan/cetak/semua')}}"><i class="fa fa-print"></i> Cetak Data Aset Tanah / Lahan</a>
                    <div class="table-responsive">
                        <table id="tabel-tanah" class="table table-striped table-bordered zero-configuration">
                            <thead>
                                <tr>
                                    <th class="text-center">Nama Obyek</th>
                                    <th class="text-center">Alamat</th>
                                    <th class="text-center">No. Sertifikat</th>
                                    <th class="text-center">Luas (m<sup>2</sup>)</th>
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

<!-- Modal Tambah Data Tanah / Lahan -->
<div class="modal fade" id="tambah-lahan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Aset Tanah / Lahan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="callout" class="alert alert-info" role="alert">
                    <div>
                        <h5 class="mb-1">Informasi Pemilihan Kondisi</h5>
                        <p class="mb-0"><i class="fa fa-check-circle"></i> Baik, yaitu apabila kondisi tanah tersebut siap dipergunakan dan/atau dimanfaatkan sesuai dengan peruntukannya.</p>
                        <p class="mb-0"><i class="fa fa-exclamation-triangle"></i> Rusak Ringan, yaitu apabila kondisi tanah tersebut karena suatu sebab tidak dapat dipergunakan dan/atau dimanfaatkan dan masih memerlukan pengolahan/perlakuan</p>
                        <p class="mb-0"><i class="fa fa-times-circle"></i> Rusak Berat, yaitu apabila kondisi tanah tersebut tidak dapat lagi dipergunakan dan/atau dimanfaatkan sesuai dengan peruntukannya karena adanya bencana alam, erosi, dan sebagainya</p>
                    </div>
                </div>
                @csrf
                <form id="add_lahan">
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama_obyek" class="col-form-label">Nama Obyek:</label>
                                <input type="text" class="form-control" name="nama_obyek" id="nama_obyek" require>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="no_sertifikat" class="col-form-label">Nomor Sertifikat:</label>
                                <input type="text" class="form-control" name="no_sertifikat" id="no_sertifikat" require>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="luas" class="col-form-label">Luas (m<sup>2</sup>):</label>
                                <input class="form-control" type="number" min="0" placeholder="0" name="luas" id="luas" require>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="alamat" class="col-form-label">Alamat:</label>
                                <input type="text" class="form-control" name="alamat" id="alamat" require>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="kategori" class="col-form-label">Kategori:</label>
                                <select class="form-control" id="kategori_id" name="kategori_id" require>
                                    <option value="">Silahkan Pilih ...</option>
                                    @foreach($kategori as $k)
                                    <option value="{{ $k->id }}">{{ $k->nama_kategori }}</option>
                                    @endforeach
                                </select>
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
                                <textarea class="form-control" name="keterangan" id="keterangan"></textarea>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                <button autofocus type="button" class="btn btn-success text-white" id="simpanlahan">Simpan</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Update Tanah / Lahan -->
<div class="modal fade" id="edit-lahan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Data Aset Tanah / Lahan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <div id="callout" class="alert alert-info" role="alert">
                    <div>
                        <h5 class="mb-1">Informasi Pemilihan Kondisi</h5>
                        <p class="mb-0"><i class="fa fa-check-circle"></i> Baik, yaitu apabila kondisi tanah tersebut siap dipergunakan dan/atau dimanfaatkan sesuai dengan peruntukannya.</p>
                        <p class="mb-0"><i class="fa fa-exclamation-triangle"></i> Rusak Ringan, yaitu apabila kondisi tanah tersebut karena suatu sebab tidak dapat dipergunakan dan/atau dimanfaatkan dan masih memerlukan pengolahan/perlakuan</p>
                        <p class="mb-0"><i class="fa fa-times-circle"></i> Rusak Berat, yaitu apabila kondisi tanah tersebut tidak dapat lagi dipergunakan dan/atau dimanfaatkan sesuai dengan peruntukannya karena adanya bencana alam, erosi, dan sebagainya</p>
                    </div>
                </div>
                <input type="hidden" id="id">
                @csrf
                <form id="edit_lahan">
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama_obyek" class="col-form-label">Nama Obyek:</label>
                                <input type="text" class="form-control" name="nama_obyek" id="nama_obyek" require>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="no_sertifikat" class="col-form-label">Nomor Sertifikat:</label>
                                <input type="text" class="form-control" name="no_sertifikat" id="no_sertifikat" require>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="luas" class="col-form-label">Luas (m<sup>2</sup>):</label>
                                <input class="form-control" type="number" min="0" placeholder="0" name="luas" id="luas" require>
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="alamat" class="col-form-label">Alamat:</label>
                                <input type="text" class="form-control" name="alamat" id="alamat" require>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="kategori" class="col-form-label">Kategori:</label>
                                <select class="form-control" id="kategori_id" name="kategori_id" required disabled>
                                    <option value="">Silahkan Pilih ...</option>
                                    @foreach($kategori as $k)
                                    <option value="{{ $k->id }}">{{ $k->nama_kategori }}</option>
                                    @endforeach
                                </select>
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
                                <textarea class="form-control" name="keterangan" id="keterangan"></textarea>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                <button autofocus type="button" class="btn btn-success text-white" id="updatelahan">Update</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Lihat Aset Tanah / Lahan -->
<div class="modal fade" id="lihat-lahan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Lihat Detail Data Tanah / Aset</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
            </div>
            <div class="modal-body">
                <p><strong>Nama Obyek:</strong> <span id="nama_obyek"></span></p>
                <p><strong>Alamat:</strong> <span id="alamat"></span></p>
                <p><strong>No. Sertifikat:</strong> <span id="no_sertifikat"></span></p>
                <p><strong>Luas (m<sup>2</sup>):</strong> <span id="luas"></span></p>
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
        $('#tabel-tanah').DataTable({
            processing: true,
            serverSide: true,
            destroy: true,
            columns: [{
                    data: 'nama_obyek',
                    name: 'nama_obyek',
                },
                {
                    data: 'alamat',
                    name: 'alamat',
                },
                {
                    data: 'no_sertifikat',
                    name: 'no_sertifikat',
                },
                {
                    data: 'luas',
                    name: 'luas',
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

<!-- Script Tambah Data Aset Tanah / Lahan -->
<script>
    //button create post event
    $('body').on('click', '#tambahlahan', function() {
        //open modal
        $('#tambah-lahan').modal('show');
    });

    //action create post
    $('#simpanlahan').click(function(e) {
        e.preventDefault();

        //define variable
        let kategori_id = $('#kategori_id').val();
        let nama_obyek = $('#nama_obyek').val();
        let alamat = $('#alamat').val();
        let no_sertifikat = $('#no_sertifikat').val();
        let luas = $('#luas').val();
        let kondisi = $('#kondisi').val();
        let keterangan = $('#keterangan').val();

        //ajax
        $.ajax({
            url: `{{url('/simpanlahan')}}`,
            type: "POST",
            cache: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                "kategori_id": kategori_id,
                "nama_obyek": nama_obyek,
                "alamat": alamat,
                "no_sertifikat": no_sertifikat,
                "luas": luas,
                "kondisi": kondisi,
                "keterangan": keterangan,

            },
            success: function(response) {

                //show success message
                Swal.fire({
                    icon: 'success',
                    title: "Berhasil Menambahkan Data",
                    text: "Lahan/Tanah berhasil ditambahkan",
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timerProgressBar: true,
                    timer: 3000
                })

                //Reset Data Form Setelah Simpan Berhasil
                $('#kategori_id').prop('selectedIndex', 0);
                $('#nama_obyek').val('');
                $('#alamat').val('');
                $('#no_sertifikat').val('');
                $('#luas').val('');
                $('#kondisi').prop('selectedIndex', 0);
                $('#keterangan').val('');

                //Melakukan Hide Modal dan Reload DataTable Setelah Simpan Berhasil
                $('#tabel-tanah').DataTable().clear().draw();
                $('#tambah-lahan').modal('hide');

                //Post Data
                let post = `
                    <tr id="index_${response.data.id}">
                    <td>${response.data.kategori_id}</td>
                        <td>${response.data.nama_obyek}</td>
                        <td>${response.data.alamat}</td>
                        <td>${response.data.no_sertifikat}</td>
                        <td>${response.data.luas}</td>
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

<script>
    function lihatdatalahan(e) {
        event.preventDefault();
        var modal = document.getElementById("lihat-lahan");
        var modale = new bootstrap.Modal(modal);

        // Open the modal
        modale.show();
        let id = e.getAttribute('data-id');

        $.ajax({
            url: `{{url("/lihatlahan")}}/` + id,
            type: "GET",
            cache: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {

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

                //fill data to form
                $('#lihat-lahan #id').text(response.id);
                $('#lihat-lahan #kategori_id').text(response[0].kategori_id);
                $('#lihat-lahan #nama_obyek').text(response[0].nama_obyek);
                $('#lihat-lahan #alamat').text(response[0].alamat);
                $('#lihat-lahan #no_sertifikat').text(response[0].no_sertifikat);
                $('#lihat-lahan #luas').text(response[0].luas);
                $('#lihat-lahan #kondisi').text(response[0].kondisi);
                $('#lihat-lahan #keterangan').text(response[0].keterangan);
                document.getElementById("created_at").innerHTML = formattedDate;
                document.getElementById("updated_at").innerHTML = updatedAtDate;
            }
        });
    };
</script>

<!-- Script Update Data Lahan -->
<script>
    function updatedatalahan(e) {
        event.preventDefault();
        var modal = document.getElementById("edit-lahan");
        var modale = new bootstrap.Modal(modal);

        // Open the modal
        modale.show();
        let id = e.getAttribute('data-id');

        $.ajax({
            url: `{{url("/lihatlahan")}}/` + id,
            type: "GET",
            cache: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                //fill data to form
                $('#edit-lahan #id').val(response[0].id);
                $('#edit-lahan #kategori_id').val(response[0].kategori_id);
                $('#edit-lahan #nama_obyek').val(response[0].nama_obyek);
                $('#edit-lahan #alamat').val(response[0].alamat);
                $('#edit-lahan #no_sertifikat').val(response[0].no_sertifikat);
                $('#edit-lahan #luas').val(response[0].luas);
                $('#edit-lahan #kondisi').val(response[0].kondisi);
                $('#edit-lahan #keterangan').val(response[0].keterangan);
            }
        });
    };

    $('#updatelahan').click(function(e) {
        e.preventDefault();

        let id = $('#edit-lahan #id').val();
        let kategori_id = $('#edit-lahan #kategori_id').val();
        let nama_obyek = $('#edit-lahan #nama_obyek').val();
        let alamat = $('#edit-lahan #alamat').val();
        let no_sertifikat = $('#edit-lahan #no_sertifikat').val();
        let luas = $('#edit-lahan #luas').val();
        let kondisi = $('#edit-lahan #kondisi').val();
        let keterangan = $('#edit-lahan #keterangan').val();

        $.ajax({
            url: `{{url("/updatelahan")}}/` + id,
            type: "PUT",
            cache: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                "kategori_id": kategori_id,
                "nama_obyek": nama_obyek,
                "alamat": alamat,
                "no_sertifikat": no_sertifikat,
                "luas": luas,
                "kondisi": kondisi,
                "keterangan": keterangan,
            },
            success: function(response) {

                //show success message
                Swal.fire({
                    icon: 'success',
                    title: "Berhasil Memperbarui Data",
                    text: 'Data lahan berhasil diperbarui',
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timerProgressBar: true,
                    timer: 3000
                })

                //Melakukan Hide Modal dan Reload DataTable Setelah Simpan Berhasil
                $('#tabel-lahan').DataTable().clear().draw();
                $('#edit-lahan').modal('hide');

                //Post Data
                let post = `
                    <tr id="index_${response.data.id}">
                    <td>${response.data.kategori_id}</td>
                    <td>${response.data.nama_obyek}</td>
                        <td>${response.data.alamat}</td>
                        <td>${response.data.no_sertifikat}</td>
                        <td>${response.data.luas}</td>
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
    function deleteDataLahan(e) {
        event.preventDefault();
        let id = e.getAttribute('data-id');
        let name = e.getAttribute('data-name');
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Data lahan " + name + " akan dihapus secara permanen!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/hapuslahan/' + id,
                    type: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: "Berhasil Menghapus Data Lahan",
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timerProgressBar: true,
                                timer: 3000
                            })
                            $('#tabel-tanah').DataTable().clear().draw();
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
<!-- #/ container -->
@endsection