<title>Daftar Barang &minus; Sistem Informasi Inventaris Barang dan Aset Desa</title>
@extends('layouts.app-layout')

@section('content')

<div class="row page-titles mx-0">
    <div class="col p-md-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Fungsional Sistem</a></li>
            <li class="breadcrumb-item"><a href="#">Aset Barang</a></li>
            <li class="breadcrumb-item active"><a href="/barang">Daftar Barang</a></li>
        </ol>
    </div>
</div>
<!-- row -->

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Daftar Barang</h4>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambah-barang"><i class="fa fa-plus"></i> Tambah Barang</button>
                    <div class="table-responsive">
                        <table id="tabel-barang" class="table table-striped table-bordered zero-configuration">
                            <thead>
                                <tr>
                                    <th width="25%" class="text-center">Nama Barang</th>
                                    <th width="20%" class="text-center">Kode Barang</th>
                                    <th width="20%" class="text-center">Kategori</th>
                                    <th width="25%" class="text-center">Ruang</th>
                                    <th width="30%" class="text-center">Aksi</th>
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
<div class="modal fade" id="tambah-barang" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @csrf
                <form id="add_barang">
                    <div class="form-row">
                        <label for="ruang" class="col-form-label">Ruang:</label>
                        <select class="form-control" id="ruang_id" name="ruang" require>
                            <option value="">Silahkan Pilih ...</option>
                            @foreach($ruang as $r)
                            <option value="{{ $r->id }}" name="ruang_id" id="ruang_id">{{ $r->nama_ruang }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-row">
                        <label for="ruang" class="col-form-label">Kategori:</label>
                        <select class="form-control" id="kategori_id" name="kategori" require>
                            <option value="">Silahkan Pilih ...</option>
                            @foreach($kategori as $k)
                            <option value="{{ $k->id }}" name="kategori_id" id="kategori_id">{{ $k->nama_kategori }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-row">
                        <label for="kode_barang" class="col-form-label">Kode Barang:</label>
                        <input type="text" class="form-control" name="kode_barang" id="kode_barang" require>
                    </div>

                    <div class="form-row">
                        <label for="nama_barang" class="col-form-label">Nama Barang:</label>
                        <input type="text" class="form-control" name="nama_barang" id="nama_barang" require>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                <button autofocus type="button" class="btn btn-success text-white" id="simpanbarang">Simpan</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Lihat Data Barang -->
<div class="modal fade" id="lihat-barang" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Lihat Data Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
            </div>
            <div class="modal-body">
                <p><strong>Kode Barang:</strong> <span id="kode_barang"></span></p>
                <p><strong>Nama Barang:</strong> <span id="nama_barang"></span></p>
                <p><strong>Kategori:</strong> <span id="kategori_id"></span></p>
                <p><strong>Ruang:</strong> <span id="ruang_id"></span></p>
                <p><strong>Ditambahkan:</strong> <span id="created_at"></span></p>
                <p><strong>Terakhir Diubah:</strong> <span id="updated_at"></span></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary text-white" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Update Data Barang -->
<div class="modal fade" id="edit-barang" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Data Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="id">
                @csrf
                <form id="edit_barang">
                    <div class="form-row">
                        <label for="ruang" class="col-form-label">Ruang:</label>
                        <select class="form-control" id="ruang_id" name="ruang" require disabled>
                            <option value="">Silahkan Pilih ...</option>
                            @foreach($ruang as $r)
                            <option value="{{ $r->id }}" name="ruang_id" id="ruang_id">{{ $r->nama_ruang }}</option>
                            @endforeach
                        </select>
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-ruang_id"></div>
                    </div>
                    <div class="form-row">
                        <label for="ruang" class="col-form-label">Kategori:</label>
                        <select class="form-control" id="kategori_id" name="kategori" require disabled>
                            <option value="">Silahkan Pilih ...</option>
                            @foreach($kategori as $k)
                            <option value="{{ $k->id }}" name="kategori_id" id="kategori_id">{{ $k->nama_kategori }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-row">
                        <label for="kode_barang" class="col-form-label">Kode Barang:</label>
                        <input type="text" class="form-control" name="kode_barang" id="kode_barang" require>
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-kode_barang"></div>
                    </div>

                    <div class="form-row">
                        <label for="nama_barang" class="col-form-label">Nama Barang:</label>
                        <input type="text" class="form-control" name="nama_barang" id="nama_barang" require>
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-nama_barang"></div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                <button autofocus type="button" class="btn btn-success text-white" id="updatebarang">Update</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        //Tabel Barang
        $('#tabel-barang').DataTable({
            processing: true,
            serverSide: true,
            destroy: true,
            columns: [{
                    data: 'nama_barang',
                    name: 'nama_barang'
                },
                {
                    data: 'kode_barang',
                    name: 'kode_barang'
                },
                {
                    data: 'nama_kategori',
                    name: 'nama_kategori',
                },
                {
                    data: 'nama_ruang',
                    name: 'nama_ruang',
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
        $('#nama_ruang').change(function() {
            table.draw();
        });
    });
</script>

<!-- Script Tambah Data Barang -->
<script>
    //button create post event
    $('body').on('click', '#tambahbarang', function() {
        //open modal
        $('#tambah-barang').modal('show');
    });

    //action create post
    $('#simpanbarang').click(function(e) {
        e.preventDefault();

        //define variable
        let ruang_id = $('#ruang_id').val();
        let kategori_id = $('#kategori_id').val();
        let kode_barang = $('#kode_barang').val();
        let nama_barang = $('#nama_barang').val();
        let jumlah = $('#jumlah').val();

        //ajax
        $.ajax({
            url: `{{url('/simpanbarang')}}`,
            type: "POST",
            cache: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                "ruang_id": ruang_id,
                "kategori_id": kategori_id,
                "kode_barang": kode_barang,
                "nama_barang": nama_barang,
                "jumlah": jumlah,
            },
            success: function(response) {

                //show success message
                Swal.fire({
                    icon: 'success',
                    title: "Data barang berhasil ditambahkan",
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timerProgressBar: true,
                    timer: 3000
                })

                //Reset Data Form Setelah Simpan Berhasil
                $('#kode_barang').val('');
                $('#nama_barang').val('');
                $('#jumlah').val('');
                $('#kategori_id').prop('selectedIndex', 0);
                $('#ruang_id').prop('selectedIndex', 0);

                //Melakukan Hide Modal dan Reload DataTable Setelah Simpan Berhasil
                $('#tabel-barang').DataTable().clear().draw();
                $('#tambah-barang').modal('hide');

                //Post Data
                let post = `
                    <tr id="index_${response.data.id}">
                        <td>${response.data.ruang}</td>
                        <td>${response.data.kode_barang}</td>
                        <td>${response.data.nama_barang}</td>
                        <td>${response.data.jumlah}</td>
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

<!-- Script Tambah Lihat Barang -->
<script>
    function lihatdata(e) {
        event.preventDefault();
        var modal = document.getElementById("lihat-barang");
        var modale = new bootstrap.Modal(modal);

        // Open the modal
        modale.show();
        let id = e.getAttribute('data-id');

        $.ajax({
            url: `{{url("/lihatdata")}}/` + id,
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
                $('#lihat-barang #id').text(response.id);
                $('#lihat-barang #kode_barang').text(response[0].kode_barang);
                $('#lihat-barang #nama_barang').text(response[0].nama_barang);
                $('#lihat-barang #kategori_id').text(response[2]);
                $('#lihat-barang #ruang_id').text(response[1]);
                document.getElementById("created_at").innerHTML = formattedDate;
                document.getElementById("updated_at").innerHTML = updatedAtDate;

            }
        });
    };
</script>

<!-- Script Update Data Barang -->
<script>
    function lihatdatabarang(e) {
        event.preventDefault();
        var modal = document.getElementById("edit-barang");
        var modale = new bootstrap.Modal(modal);

        // Open the modal
        modale.show();
        let id = e.getAttribute('data-id');

        $.ajax({
            url: `{{url("/lihatdata")}}/` + id,
            type: "GET",
            cache: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                //fill data to form
                $('#edit-barang #id').val(response[0].id);
                $('#edit-barang #kategori_id').val(response[0].kategori_id);
                $('#edit-barang #kode_barang').val(response[0].kode_barang);
                $('#edit-barang #nama_barang').val(response[0].nama_barang);
                $('#edit-barang #ruang_id').val(response[0].ruang_id);
            }
        });
    };

    $('#updatebarang').click(function(e) {
        e.preventDefault();

        let id = $('#edit-barang #id').val();
        let kategori_id = $('#edit-barang #kategori_id').val();
        let ruang_id = $('#edit-barang #ruang_id').val();
        let kode_barang = $('#edit-barang #kode_barang').val();
        let nama_barang = $('#edit-barang #nama_barang').val();

        $.ajax({
            url: `/updatebarang/` + id,
            type: "PUT",
            cache: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                "kategori_id": kategori_id,
                "ruang_id": ruang_id,
                "kode_barang": kode_barang,
                "nama_barang": nama_barang,
            },
            success: function(response) {

                //show success message
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil Memperbarui Data',
                    text: "Data barang berhasil diperbarui",
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timerProgressBar: true,
                    timer: 3000
                })

                //Melakukan Hide Modal dan Reload DataTable Setelah Simpan Berhasil
                $('#tabel-barang').DataTable().clear().draw();
                $('#edit-barang').modal('hide');

                //Post Data
                let post = `
                    <tr id="index_${response.data.id}">
                    <td>${response.data.kategori_id}</td>
                        <td>${response.data.ruang_id}</td>
                        <td>${response.data.kode_barang}</td>
                        <td>${response.data.nama_barang}</td>
                    </tr>
                `;
            },
        })

    })
</script>

<!-- Script Hapus Data Barang -->
<script>
    function deleteDataBarang(e) {
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
                    url: '/hapusbarang/' + id,
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
                            $('#tabel-barang').DataTable().clear().draw();
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
                            text: 'Barang ' + name + ' sudah dilaporkan dalam detail barang',
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