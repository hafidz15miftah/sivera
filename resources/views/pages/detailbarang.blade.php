<title>Detail Barang dan Laporan &minus; Sistem Informasi Inventaris Barang dan Aset Desa</title>
@extends('layouts.app-layout')

@section('content')
<div class="row page-titles mx-0">
    <div class="col p-md-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Fungsional Sistem</a></li>
            <li class="breadcrumb-item"><a href="#">Aset Barang</a></li>
            <li class="breadcrumb-item active"><a href="/barang">Detail Barang dan Laporan</a></li>
        </ol>
    </div>
</div>
<!-- row -->

<!-- Modal Download-->
<div class="modal fade" id="downloadModal" tabindex="-1" role="dialog" aria-labelledby="downloadModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="downloadModalLabel">Cetak Laporan Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="downloadForm" method="GET" action="{{ route('cetak_semua_laporan') }}">
                    @csrf
                    <div class="form-group">
                        <label for="downloadOption">Pilih Opsi:</label>
                        <select class="form-control" id="downloadOption" name="download_option">
                            <option value="all">Semua Data</option>
                            <option value="by_ruang">Berdasarkan Ruang</option>
                            <option value="by_month">Berdasarkan Tanggal Perolehan</option>
                        </select>
                    </div>
                    <div id="ruangForm" style="display: none;">
                        <div class="form-group">
                            <label for="selectedMonthe">Pilih Ruang:</label>
                            <select class="form-control" id="downloadOption" name="selected_ruang">
                                <option value="">Silahkan Pilih ...</option>
                                @foreach ($ruang as $r)
                                <option value="{{ $r->id }}">{{ $r->nama_ruang }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div id="monthForm" style="display: none;">
                        <div class="form-group">
                            <label for="selectedMonth">Pilih Tanggal Perolehan:</label>
                            <input type="date" class="form-control" id="selectedMonth" name="selected_date">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Cetak Data</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Berita Acara-->
<div class="modal fade" id="BeritaAcaraModal" tabindex="-1" role="dialog" aria-labelledby="downloadModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="downloadModalLabel">Cetak Berita Acara</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="BeritaAcara" method="POST" action="{{ route('cetak_berita_acara') }}">
                    @csrf
                    <div id="">
                        <div class="form-group">
                            <label for="">Pilih ID Barang:</label>
                            <select class="form-control" id="downloadOption" name="barang_dipilih">
                                <option value="">Silahkan Pilih ...</option>
                                @foreach ($info as $i)
                                <option value="{{ $i->id }}">{{ $i->kode_detail }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Cetak</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Barang -->
<div class="modal fade" id="tambah-laporan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Detail Data Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @csrf
                <form id="add_barang">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="nama_barang">Kode Barang</label>
                                <select class="form-control" id="info_id" name="info_id" require>
                                    <option value="">Silahkan Pilih ...</option>
                                    @foreach ($info as $i)
                                    <option value="{{ $i->id }}">{{ $i->kode_detail }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="tgl_perolehan">Tanggal Perolehan</label>
                                <input class="form-control" type="date" name="tgl_perolehan" id="tgl_perolehan">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="sumber">Sumber</label>
                                <select class="form-control" id="sumber" name="sumber" require>
                                    <option value="" selected disabled>Silahkan Pilih ...</option>
                                    <option value="Anggaran Dana Desa">Anggaran Dana Desa</option>
                                    <option value="Hibah">Hibah</option>
                                    <option value="Lainnya">Lainnya</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="merk">Merk</label>
                                <input type="text" class="form-control" name="merk" id="merk">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="harga">Harga (Rp)</label>
                                <input class="form-control" type="number" min="0" placeholder="0" name="harga" id="harga">
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
                <button type="button" class="btn btn-success text-white" id="simpanLaporan">Simpan</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit Barang -->
<div class="modal fade" id="edit-laporan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Detail Data Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="id">
                @csrf
                <form id="edit_barang">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="nama_barang">Kode Barang</label>
                                <select class="form-control" id="info_id" name="info_id" require disabled>
                                    <option value="">Silahkan Pilih ...</option>
                                    @foreach ($info as $i)
                                    <option value="{{ $i->id }}">{{ $i->kode_detail }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="tgl_perolehan">Tanggal Perolehan</label>
                                <input class="form-control" type="date" name="tgl_perolehan" id="tgl_perolehan">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="sumber">Sumber</label>
                                <select class="form-control" id="sumber" name="sumber" require>
                                    <option value="" selected disabled>Silahkan Pilih ...</option>
                                    <option value="Anggaran Dana Desa">Anggaran Dana Desa</option>
                                    <option value="Hibah">Hibah</option>
                                    <option value="Lainnya">Lainnya</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="merk">Merk</label>
                                <input type="text" class="form-control" name="merk" id="merk">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="harga">Harga (Rp)</label>
                                <input class="form-control" type="number" min="0" placeholder="0" name="harga" id="harga">
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
                <button type="button" class="btn btn-success text-white" id="updatedetail">Update</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Lihat Laporan Data Barang -->
<div class="modal fade" id="lihat-laporanbar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Lihat Detail Data Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
            </div>
            <div class="modal-body">
                <p><strong>ID Barang:</strong> <span id="kode_detail"></span></p>
                <p><strong>Nama Barang:</strong> <span id="nama_barang"></span></p>
                <p><strong>Merk:</strong> <span id="merk"></span></p>
                <p><strong>Kondisi:</strong> <span id="kondisi"></span></p>
                <p><strong>Ruang:</strong> <span id="ruang_id"></span></p>
                <p><strong>Sumber:</strong> <span id="sumber"></span></p>
                <p><strong>Tanggal Perolehan:</strong> <span id="tgl_perolehan"></span></p>
                <p><strong>Harga (Rp):</strong> <span id="harga"></span></p>
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

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Detail Barang dan Laporan</h4>
                    <button type="button" class="btn btn-primary" style="color:white" data-toggle="modal" data-target="#tambah-laporan"><i class="fa fa-plus"></i> Tambah Detail Barang</button>
                    <button class="btn btn-warning" style="color:white" data-toggle="modal" data-target="#downloadModal"><i class="fa fa-print"></i> Cetak Laporan Barang</button>
                    <button class="btn btn-danger" style="color:white" data-toggle="modal" data-target="#BeritaAcaraModal"><i class="fa fa-print"></i> Cetak Berita Acara</button>
                    <div class="table-responsive">
                        <table id="tabel-laporan" class="table table-striped table-bordered zero-configuration">
                            <thead>
                                <tr>
                                    <th class="text-center">ID Barang</th>
                                    <th class="text-center">Nama Barang</th>
                                    <th class="text-center">Kategori</th>
                                    <th class="text-center">Ruang</th>
                                    <th class="text-center">Tanggal Perolehan</th>
                                    <th class="text-center">Sumber</th>
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

<script type="text/javascript">
    $(document).ready(function() {
        //Tabel Laporan Detail Barang
        $('#tabel-laporan').DataTable({
            processing: true,
            serverSide: true,
            destroy: true,
            columns: [{
                    data: 'kode_detail',
                    name: 'kode_detail',
                },
                {
                    data: 'nama_barang',
                    name: 'nama_barang',
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
                    data: 'tgl_perolehan',
                    name: 'tgl_perolehan'
                },
                {
                    data: 'sumber',
                    name: 'sumber'
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

<!-- Script Tambah Detail Data Barang -->
<script>
    //action create post
    $('#simpanLaporan').click(function(e) {
        e.preventDefault();

        //define variable
        let info_id = $('#info_id').val();
        let tgl_perolehan = $('#tgl_perolehan').val();
        let sumber = $('#sumber').val();
        let merk = $('#merk').val();
        let harga = $('#harga').val();
        let keterangan = $('#keterangan').val();

        //ajax
        $.ajax({
            url: `{{url('/simpanlaporan')}}`,
            type: "POST",
            cache: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                "info_id": info_id,
                "tgl_perolehan": tgl_perolehan,
                "sumber": sumber,
                "merk": merk,
                "harga": harga,
                "keterangan": keterangan,
            },
            success: function(response) {

                //show success message
                Swal.fire({
                    icon: 'success',
                    title: "Detail data barang berhasil ditambahkan",
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timerProgressBar: true,
                    timer: 3000
                })

                //Reset Data Form Setelah Simpan Berhasil
                $('#info_id').prop('selectedIndex', 0);
                $('#tgl_perolehan').val('');
                $('#sumber').val('');
                $('#merk').val('');
                $('#harga').val('');
                $('#keterangan').val('');

                //Melakukan Hide Modal dan Reload DataTable Setelah Simpan Berhasil
                $('#tabel-laporan').DataTable().clear().draw();
                $('#tambah-laporan').modal('hide');

                //Post Data
                let post = `
                    <tr id="index_${response.data.id}">
                        <td>${response.data.info_id}</td>
                        <td>${response.data.sumber}</td>
                        <td>${response.data.tgl_perolehan}</td>
                        <td>${response.data.merk}</td>
                        <td>${response.data.harga}</td>
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

<!-- Script Update Detail Data Barang -->
<script>
    function updateDetailBarang(e) {
        event.preventDefault();
        var modal = document.getElementById("edit-laporan");
        var modale = new bootstrap.Modal(modal);

        // Open the modal
        modale.show();
        let id = e.getAttribute('data-id');

        $.ajax({
            url: `{{url("/lihatdetailbar")}}/` + id,
            type: "GET",
            cache: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                //fill data to form
                $('#edit-laporan #id').val(response[0].id);
                $('#edit-laporan #info_id').val(response[0].info_id);
                $('#edit-laporan #tgl_perolehan').val(response[0].tgl_perolehan);
                $('#edit-laporan #sumber').val(response[0].sumber);
                $('#edit-laporan #merk').val(response[0].merk);
                $('#edit-laporan #harga').val(response[0].harga);
                $('#edit-laporan #keterangan').val(response[0].keterangan);
            }
        });
    };

    $('#updatedetail').click(function(e) {
        e.preventDefault();

        let id = $('#edit-laporan #id').val();
        let info_id = $('#edit-laporan #info_id').val();
        let tgl_perolehan = $('#edit-laporan #tgl_perolehan').val();
        let sumber = $('#edit-laporan #sumber').val();
        let merk = $('#edit-laporan #merk').val();
        let harga = $('#edit-laporan #harga').val();
        let keterangan = $('#edit-laporan #keterangan').val();

        $.ajax({
            url: `{{url("/updatedetailbar")}}/` + id,
            type: "PUT",
            cache: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                "info_id": info_id,
                "tgl_perolehan": tgl_perolehan,
                "sumber": sumber,
                "merk": merk,
                "harga": harga,
                "keterangan": keterangan,
            },
            success: function(response) {

                //show success message
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil Memperbarui Data',
                    text: "Detail barang berhasil diperbarui",
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timerProgressBar: true,
                    timer: 3000
                })

                //Melakukan Hide Modal dan Reload DataTable Setelah Simpan Berhasil
                $('#tabel-laporan').DataTable().clear().draw();
                $('#edit-laporan').modal('hide');

                //Post Data
                let post = `
                    <tr id="index_${response.data.id}">
                    <td>${response.data.info_id}</td>
                        <td>${response.data.tgl_perolehan}</td>
                        <td>${response.data.sumber}</td>
                        <td>${response.data.merk}</td>
                        <td>${response.data.harga}</td>
                        <td>${response.data.jumlah}</td>
                    </tr>
                `;
            },
        })
    })
</script>

<script>
    function lihatlapbar(e) {
        event.preventDefault();
        var modal = document.getElementById("lihat-laporanbar");
        var modale = new bootstrap.Modal(modal);

        // Open the modal
        modale.show();
        let id = e.getAttribute('data-id');

        $.ajax({
            url: `{{url("/lihatdetailbar")}}/` + id,
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

                var kondisiNames = {
                    1: "Baik",
                    2: "Rusak Ringan",
                    3: "Rusak Berat"
                };

                var kondisiText = kondisiNames[response[4]] || "Dalam Perbaikan";

                //Mengubah updated_at menjadi tanggal local
                let updatedAt = new Date(response[0].updated_at);
                let updatedAtDate = updatedAt.toLocaleDateString(locale, options);

                //fill data to form
                $('#lihat-laporanbar #id').text(response.id);
                $('#lihat-laporanbar #kode_detail').text(response[3]);
                $('#lihat-laporanbar #nama_barang').text(response[2]);
                $('#lihat-laporanbar #ruang_id').text(response[1]);
                $('#lihat-laporanbar #kondisi').text(kondisiText);
                $('#lihat-laporanbar #tgl_perolehan').text(new Date(response[0].tgl_perolehan).toLocaleDateString('id-ID', {
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric'
                }));
                $('#lihat-laporanbar #merk').text(response[0].merk);
                $('#lihat-laporanbar #sumber').text(response[0].sumber);
                $('#lihat-laporanbar #harga').text(response[0].harga);
                $('#lihat-laporanbar #jumlah').text(response[0].jumlah);
                $('#lihat-laporanbar #keterangan').text(response[0].keterangan);
                document.getElementById("created_at").innerHTML = formattedDate;
                document.getElementById("updated_at").innerHTML = updatedAtDate;
            }
        });
    };
</script>

<!-- Script Hapus Detail Barang -->
<script>
    function deleteDetailBarang(e) {
        event.preventDefault();
        let id = e.getAttribute('data-id');
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Detail barang ini akan dihapus secara permanen!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/hapusdetailbar/' + id,
                    type: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: "Detail barang berhasil dihapus",
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timerProgressBar: true,
                                timer: 3000
                            })
                            $('#tabel-laporan').DataTable().clear().draw();
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
                            title: "Gagal Menghapus Detail Barang",
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

<!-- Tampilkan Modal Cetak -->
<script>
    // Tampilkan atau sembunyikan form bulan berdasarkan pilihan opsi
    $(document).ready(function() {
        $('#downloadOption').on('change', function() {
            var selectedOption = $(this).val();
            var downloadForm = $('#downloadForm');
            var monthForm = $('#monthForm');
            var barangForm = $('#barangForm');
            var ruangForm = $('#ruangForm');

            if (selectedOption === 'by_month') {
                barangForm.hide();
                ruangForm.hide();
                monthForm.show();
                downloadForm.attr('method', 'POST');
                downloadForm.attr('action', "{{ route('cetak_laporan_bytanggal') }}");

            } else if (selectedOption === 'by_barang') {
                barangForm.show();
                monthForm.hide();
                ruangForm.hide();
                downloadForm.attr('method', 'POST');
                downloadForm.attr('action', "{{ route('cetak_laporan_bybarang') }}");

            } else if (selectedOption === 'by_ruang') {
                barangForm.hide();
                monthForm.hide();
                ruangForm.show();
                downloadForm.attr('method', 'POST');
                downloadForm.attr('action', "{{ route('cetak_laporan_byruang') }}");

            } else {
                barangForm.hide();
                monthForm.hide();
                ruangForm.hide();
                downloadForm.attr('method', 'GET');
                downloadForm.attr('action', "{{ route('cetak_semua_laporan') }}");
            }
        });
    });
</script>
<!-- #/ container -->
@endsection