<title>Aset Jalan &minus; Sistem Informasi Inventaris Barang dan Aset Desa</title>
@extends('layouts.app-layout')

@section('content')

<div class="row page-titles mx-0">
    <div class="col p-md-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Fungsional Sistem</a></li>
            <li class="breadcrumb-item active"><a href="/jalan">Aset Jalan</a></li>
        </ol>
    </div>
</div>
<!-- row -->

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Aset Jalan</h4>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambah-jalan"><i class="fa fa-plus"></i> Tambah Aset Jalan</button>
                    @if (Auth::user()->role_id == 2 || Auth::user()->role_id == 5)
                    <button type="button" class="btn btn-warning" style="color:white" data-toggle="modal" data-target="#downloadModal"><i class="fa fa-print"></i> Cetak Aset Jalan</button>
                    @endif
                    <div class="table-responsive">
                        <table id="tabel-jalan" class="table table-striped table-bordered zero-configuration">
                            <thead>
                                <tr>
                                    <th class="text-center">Nama Jalan</th>
                                    <th class="text-center">No. Dokumen</th>
                                    <th class="text-center">Panjang Ruas (m)</th>
                                    <th class="text-center">Sumber</th>
                                    <th class="text-center">Kondisi</th>
                                    <th class="text-center">Tgl. Inventarisir</th>
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

<!-- Modal Download -->
<div class="modal fade" id="downloadModal" tabindex="-1" role="dialog" aria-labelledby="downloadModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="downloadModalLabel">Cetak Laporan Aset Jalan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="downloadForm" method="GET" action="{{ route('cetak_jalan') }}" target="_blank">
                    @csrf
                    <div class="form-group">
                        <label for="downloadOption">Pilih Opsi:</label>
                        <select class="form-control" id="downloadOption" name="download_option">
                            <option value="all">Semua Data</option>
                            <option value="by_tahunini">Data Tahun Ini</option>
                            <option value="by_inventarisir">Berdasarkan Tahun Inventarisir</option>
                        </select>
                    </div>
                    <div id="tahunForm" style="display: none;">
                        <div class="form-group">
                            <label for="selectedTahun">Masukkan Tahun Inventarisir:</label>
                            <input type="text" class="form-control" id="selectedTahun" name="selected_tahun" placeholder="Contoh: 2023">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Cetak Data</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Data Jalan -->
<div class="modal fade" id="tambah-jalan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Aset Jalan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="callout" class="alert alert-info" role="alert">
                    <div>
                        <h5 class="mb-1">Informasi Pemilihan Kondisi</h5>
                        <p class="mb-0"><i class="fa fa-check-circle"></i> Baik, yaitu apabila kondisi jalan dalam keadaan utuh dan berfungsi dengan baik.</p>
                        <p class="mb-0"><i class="fa fa-exclamation-triangle"></i> Rusak Ringan, yaitu apabila kondisi jalan dalam keadaan utuh namun memerlukan perbaikan ringan agar dapat digunakan sebagaimana mestinya.</p>
                        <p class="mb-0"><i class="fa fa-times-circle"></i> Rusak Berat, yaitu apabila kondisi jalan dalam keadaan tidak utuh/tidak berfungsi dengan baik dan memerlukan perbaikan dengan biaya besar.</p>
                    </div>
                </div>
                @csrf
                <form id="add_jalan">
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama_jalan" class="col-form-label">Nama Jalan:</label>
                                <input type="text" class="form-control" name="nama_jalan" id="nama_jalan" require>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="no_dokumen" class="col-form-label">Nomor Dokumen:</label>
                                <input type="text" class="form-control" name="no_dokumen" id="no_dokumen" require>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="panjang" class="col-form-label">Panjang Ruas (m):</label>
                                <input class="form-control" type="number" min="0" placeholder="0" name="panjang" id="panjang" require>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="sumber" class="col-form-label">Sumber</label>
                                <select class="form-control" id="sumber" name="sumber" require>
                                    <option value="" selected disabled>Silahkan Pilih ...</option>
                                    <option value="Anggaran Dana Desa (ADD)">Anggaran Dana Desa (ADD)</option>
                                    <option value="Bagi Hasil Pajak (BHP)">Bagi Hasil Pajak (BHP)</option>
                                    <option value="Bagi Hasil Pajak dan Retribusi (BHR)">Bagi Hasil Pajak dan Retribusi (BHR)</option>
                                    <option value="Bantuan Provinsi">Bantuan Provinsi</option>
                                    <option value="Bantuan Kabupaten">Bantuan Kabupaten</option>
                                    <option value="Bantuan Pihak Ketiga">Bantuan Pihak Ketiga</option>
                                    <option value="Hibah">Hibah</option>
                                    <option value="Lainnya">Lainnya</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="inventarisir" class="col-form-label">Tgl. Inventarisir:</label>
                                <input class="form-control" type="date" name="inventarisir" id="inventarisir" require>
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
                <button autofocus type="button" class="btn btn-success text-white" id="simpanjalan">Simpan</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Update Aset Jalan -->
<div class="modal fade" id="edit-jalan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Data Aset Jalan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="callout" class="alert alert-info" role="alert">
                    <div>
                        <h5 class="mb-1">Informasi Pemilihan Kondisi</h5>
                        <p class="mb-0"><i class="fa fa-check-circle"></i> Baik, yaitu apabila kondisi jalan dalam keadaan utuh dan berfungsi dengan baik.</p>
                        <p class="mb-0"><i class="fa fa-exclamation-triangle"></i> Rusak Ringan, yaitu apabila kondisi jalan dalam keadaan utuh namun memerlukan perbaikan ringan agar dapat digunakan sebagaimana mestinya.</p>
                        <p class="mb-0"><i class="fa fa-times-circle"></i> Rusak Berat, yaitu apabila kondisi jalan dalam keadaan tidak utuh/tidak berfungsi dengan baik dan memerlukan perbaikan dengan biaya besar.</p>
                    </div>
                </div>
                <input type="hidden" id="id">
                @csrf
                <form id="edit_jalan">
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama_jalan" class="col-form-label">Nama Jalan:</label>
                                <input type="text" class="form-control" name="nama_jalan" id="nama_jalan" require>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="no_dokumen" class="col-form-label">Nomor Dokumen:</label>
                                <input type="text" class="form-control" name="no_dokumen" id="no_dokumen" require>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="panjang" class="col-form-label">Panjang (m):</label>
                                <input class="form-control" type="number" min="0" placeholder="0" name="panjang" id="panjang" require>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="sumber" class="col-form-label">Sumber</label>
                                <select class="form-control" id="sumber" name="sumber" require>
                                    <option value="" selected disabled>Silahkan Pilih ...</option>
                                    <option value="Anggaran Dana Desa (ADD)">Anggaran Dana Desa (ADD)</option>
                                    <option value="Bagi Hasil Pajak (BHP)">Bagi Hasil Pajak (BHP)</option>
                                    <option value="Bagi Hasil Pajak dan Retribusi (BHR)">Bagi Hasil Pajak dan Retribusi (BHR)</option>
                                    <option value="Bantuan Provinsi">Bantuan Provinsi</option>
                                    <option value="Bantuan Kabupaten">Bantuan Kabupaten</option>
                                    <option value="Bantuan Pihak Ketiga">Bantuan Pihak Ketiga</option>
                                    <option value="Hibah">Hibah</option>
                                    <option value="Lainnya">Lainnya</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="inventarisir" class="col-form-label">Tgl. Inventarisir:</label>
                                <input class="form-control" type="date" name="inventarisir" id="inventarisir" require disabled>
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
                <button autofocus type="button" class="btn btn-success text-white" id="updatejalan">Update</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Lihat Aset Tanah / Lahan -->
<div class="modal fade" id="lihat-jalan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Lihat Detail Aset Jalan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
            </div>
            <div class="modal-body">
                <p><strong>Nama Jalan:</strong> <span id="nama_jalan"></span></p>
                <p><strong>No. Dokumen:</strong> <span id="no_dokumen"></span></p>
                <p><strong>Panjang (m):</strong> <span id="panjang"></span></p>
                <p><strong>Sumber:</strong> <span id="sumber"></span></p>
                <p><strong>Kondisi:</strong> <span id="kondisi"></span></p>
                <p><strong>Keterangan:</strong> <span id="keterangan"></span></p>
                <p><strong>Tanggal Inventarisir:</strong> <span id="inventarisir"></span></p>
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
        $('#tabel-jalan').DataTable({
            processing: true,
            serverSide: true,
            destroy: true,
            columns: [{
                    data: 'nama_jalan',
                    name: 'nama_jalan',
                },
                {
                    data: 'no_dokumen',
                    name: 'no_dokumen',
                },
                {
                    data: 'panjang',
                    name: 'panjang',
                },
                {
                    data: 'sumber',
                    name: 'sumber',
                },
                {
                    data: 'kondisi',
                    name: 'kondisi',
                },
                {
                    data: 'inventarisir',
                    name: 'inventarisir',
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

<!-- Script Tambah Data Jalan -->
<script>
    //button create post event
    $('body').on('click', '#tambahjalan', function() {
        //open modal
        $('#tambah-jalan').modal('show');
    });

    //action create post
    $('#simpanjalan').click(function(e) {
        e.preventDefault();

        //define variable
        let nama_jalan = $('#nama_jalan').val();
        let no_dokumen = $('#no_dokumen').val();
        let panjang = $('#panjang').val();
        let sumber = $('#sumber').val();
        let inventarisir = $('#inventarisir').val();
        let kondisi = $('#kondisi').val();
        let keterangan = $('#keterangan').val();

        //ajax
        $.ajax({
            url: `{{url('/simpanjalan')}}`,
            type: "POST",
            cache: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                "nama_jalan": nama_jalan,
                "no_dokumen": no_dokumen,
                "panjang": panjang,
                "sumber": sumber,
                "kondisi": kondisi,
                "inventarisir": inventarisir,
                "keterangan": keterangan,

            },
            success: function(response) {

                //show success message
                Swal.fire({
                    icon: 'success',
                    title: "Berhasil Menambahkan Data",
                    text: "Aset jalan berhasil ditambahkan",
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timerProgressBar: true,
                    timer: 3000
                })

                //Reset Data Form Setelah Simpan Berhasil
                $('#nama_jalan').val('');
                $('#no_dokumen').val('');
                $('#panjang').val('');
                $('#sumber').prop('selectedIndex', 0);
                $('#kondisi').prop('selectedIndex', 0);
                $('#inventarisir').val('');
                $('#keterangan').val('');

                //Melakukan Hide Modal dan Reload DataTable Setelah Simpan Berhasil
                $('#tabel-jalan').DataTable().clear().draw();
                $('#tambah-jalan').modal('hide');

                //Post Data
                let post = `
                    <tr id="index_${response.data.id}">
                        <td>${response.data.nama_jalan}</td>
                        <td>${response.data.no_dokumen}</td>
                        <td>${response.data.panjang}</td>
                        <td>${response.data.sumber}</td>
                        <td>${response.data.kondisi}</td>
                        <td>${response.data.inventarisir}</td>
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

<!-- Script Lihat Data Jalan -->
<script>
    function lihatdatajalan(e) {
        event.preventDefault();
        var modal = document.getElementById("lihat-jalan");
        var modale = new bootstrap.Modal(modal);

        // Open the modal
        modale.show();
        let id = e.getAttribute('data-id');

        $.ajax({
            url: `{{url("/lihatjalan")}}/` + id,
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
                $('#lihat-jalan #id').text(response.id);
                $('#lihat-jalan #nama_jalan').text(response[0].nama_jalan);
                $('#lihat-jalan #no_dokumen').text(response[0].no_dokumen);
                $('#lihat-jalan #panjang').text(response[0].panjang);
                $('#lihat-jalan #sumber').text(response[0].sumber);
                $('#lihat-jalan #kondisi').text(kondisiLabel); // Use the mapped label
                $('#lihat-jalan #inventarisir').text(new Date(response[0].inventarisir).toLocaleDateString('id-ID', {
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric'
                }));
                $('#lihat-jalan #keterangan').text(response[0].keterangan);
                document.getElementById("created_at").innerHTML = formattedDate;
                document.getElementById("updated_at").innerHTML = updatedAtDate;
            }
        });
    };
</script>

<!-- Script Update Data Lahan -->
<script>
    function updatedatajalan(e) {
        event.preventDefault();
        var modal = document.getElementById("edit-jalan");
        var modale = new bootstrap.Modal(modal);

        // Open the modal
        modale.show();
        let id = e.getAttribute('data-id');

        $.ajax({
            url: `{{url("/lihatjalan")}}/` + id,
            type: "GET",
            cache: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                //fill data to form
                $('#edit-jalan #id').val(response[0].id);
                $('#edit-jalan #nama_jalan').val(response[0].nama_jalan);
                $('#edit-jalan #no_dokumen').val(response[0].no_dokumen);
                $('#edit-jalan #panjang').val(response[0].panjang);
                $('#edit-jalan #sumber').val(response[0].sumber);
                $('#edit-jalan #kondisi').val(response[0].kondisi);
                $('#edit-jalan #inventarisir').val(response[0].inventarisir);
                $('#edit-jalan #keterangan').val(response[0].keterangan);
            }
        });
    };

    $('#updatejalan').click(function(e) {
        e.preventDefault();

        let id = $('#edit-jalan #id').val();
        let nama_jalan = $('#edit-jalan #nama_jalan').val();
        let no_dokumen = $('#edit-jalan #no_dokumen').val();
        let panjang = $('#edit-jalan #panjang').val();
        let sumber = $('#edit-jalan #sumber').val();
        let kondisi = $('#edit-jalan #kondisi').val();
        let inventarisir = $('#edit-jalan #inventarisir').val();
        let keterangan = $('#edit-jalan #keterangan').val();

        $.ajax({
            url: `{{url("/updatejalan")}}/` + id,
            type: "PUT",
            cache: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                "nama_jalan": nama_jalan,
                "no_dokumen": no_dokumen,
                "panjang": panjang,
                "sumber": sumber,
                "kondisi": kondisi,
                "inventarisir": inventarisir,
                "keterangan": keterangan,
            },
            success: function(response) {

                //show success message
                Swal.fire({
                    icon: 'success',
                    title: "Berhasil Memperbarui Data",
                    text: 'Data jalan berhasil diperbarui',
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timerProgressBar: true,
                    timer: 3000
                })

                //Melakukan Hide Modal dan Reload DataTable Setelah Simpan Berhasil
                $('#tabel-jalan').DataTable().clear().draw();
                $('#edit-jalan').modal('hide');

                //Post Data
                let post = `
                    <tr id="index_${response.data.id}">
                    <td>${response.data.nama_jalan}</td>
                        <td>${response.data.no_dokumen}</td>
                        <td>${response.data.panjang}</td>
                        <td>${response.data.sumber}</td>
                        <td>${response.data.kondisi}</td>
                        <td>${response.data.inventarisir}</td>                        
                        <td>${response.data.keterangan}</td>
                    </tr>
                `;
            },
        })
    })
</script>

<!-- Script Hapus Data Lahan -->
<script>
    function deleteDataJalan(e) {
        event.preventDefault();
        let id = e.getAttribute('data-id');
        let name = e.getAttribute('data-name');
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Data jalan " + name + " akan dihapus secara permanen!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/hapusjalan/' + id,
                    type: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: "Berhasil Menghapus Data Aset Jalan",
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timerProgressBar: true,
                                timer: 3000
                            })
                            $('#tabel-jalan').DataTable().clear().draw();
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
                            title: "Gagal Menghapus Aset Jalan",
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

<script>
    $(document).ready(function() {
        $('#downloadOption').on('change', function() {
            var selectedOption = $(this).val();
            var downloadForm = $('#downloadForm');
            var tahunForm = $('#tahunForm');

            if (selectedOption === 'by_inventarisir') {
                tahunForm.show();
                downloadForm.attr('method', 'POST');
                downloadForm.attr('action', "{{ route('cetak_jalan_byinventarisir') }}");

            } else if (selectedOption === 'by_tahunini') {
                tahunForm.hide();
                downloadForm.attr('method', 'POST');
                downloadForm.attr('action', "{{ route('cetak_tanah_tahunini') }}");

            } else {
                tahunForm.hide();
                downloadForm.attr('method', 'GET');
                downloadForm.attr('action', "{{ route('cetak_jalan') }}");
            }
        });
    });
</script>
@endsection