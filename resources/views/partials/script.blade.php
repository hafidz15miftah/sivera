<script src="plugins/common/common.min.js"></script>
<script src="js/custom.min.js"></script>
<script src="js/settings.js"></script>
<script src="js/gleek.js"></script>
<script src="js/styleSwitcher.js"></script>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<!-- DataTable -->
<script src="/plugins/tables/js/jquery.dataTables.min.js"></script>
<script src="/plugins/tables/js/datatable/dataTables.bootstrap4.min.js"></script>
<script src="/plugins/tables/js/datatable-init/datatable-basic.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.js"></script>

<!-- Chartjs -->
<script src="/plugins/chart.js/Chart.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-labels"></script>
<!-- Circle progress -->
<script src="/plugins/circle-progress/circle-progress.min.js"></script>

<!-- SweetAlert -->
<script src="{{ asset('/vendors/sweetalert2/sweetalert2.all.min.js') }}"></script>

<!-- Script Tampilkan Data YajraDataTables -->
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
        })

        //Tabel Ruangan
        $('#tabel-ruangan').DataTable({
            processing: true,
            serverSide: true,
            destroy: true,
            columns: [{
                    data: 'id',
                    name: 'id'
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
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/id.json',
            }

        });

        //Tabel Laporan Detail Barang
        $('#tabel-laporan').DataTable({
            processing: true,
            serverSide: true,
            destroy: true,
            columns: [{
                    data: 'kode_barang',
                    name: 'kode_barang',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'nama_barang',
                    name: 'nama_barang',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'nama_ruang',
                    name: 'nama_ruang',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'baik',
                    name: 'baik'
                },
                {
                    data: 'rusak_ringan',
                    name: 'rusak_ringan'
                },
                {
                    data: 'rusak_berat',
                    name: 'rusak_berat'
                },
                {
                    data: 'jumlah',
                    name: 'jumlah'
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
                    title: "Data barang berhasil ditambahkan",
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timerProgressBar: true,
                    timer: 3000
                })

                //Reset Data Form Setelah Simpan Berhasil
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
        let kode_barang = $('#kode_barang').val();
        let nama_barang = $('#nama_barang').val();

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
                "kode_barang": kode_barang,
                "nama_barang": nama_barang,
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

<!-- Script Tambah Data Laporan -->
<script>
    //button create post event
    $('body').on('click', '#simpanLaporan', function() {
        //open modal
        $('#tambah-laporan').modal('show');
    });

    //action create post
    $('#simpanLaporan').click(function(e) {
        e.preventDefault();

        //define variable
        let barang_id = $('#barang_id').val();
        let tgl_pembelian = $('#tgl_pembelian').val();
        let sumber_dana = $('#sumber_dana').val();
        let baik = $('#baik').val();
        let rusak_ringan = $('#rusak_ringan').val();
        let rusak_berat = $('#rusak_berat').val();
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
                "barang_id": barang_id,
                "tgl_pembelian": tgl_pembelian,
                "sumber_dana": sumber_dana,
                "baik": baik,
                "rusak_ringan": rusak_ringan,
                "rusak_berat": rusak_berat,
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
                $('#barang_id').prop('selectedIndex', 0);
                $('#sumber_dana').val('');
                $('#tgl_pembelian').val('');
                $('#baik').val('');
                $('#rusak_ringan').val('');
                $('#rusak_berat').val('');
                $('#keterangan').val('');

                //Melakukan Hide Modal dan Reload DataTable Setelah Simpan Berhasil
                $('#tabel-laporan').DataTable().clear().draw();
                $('#tambah-laporan').modal('hide');

                //Post Data
                let post = `
                    <tr id="index_${response.data.id}">
                        <td>${response.data.barang_id}</td>
                        <td>${response.data.sumber_dana}</td>
                        <td>${response.data.tgl_pembelian}</td>
                        <td>${response.data.baik}</td>
                        <td>${response.data.rusak_ringan}</td>
                        <td>${response.data.rusak_berat}</td>
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

<!-- Script Lihat Data Barang -->
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
                $('#lihat-barang #ruang_id').text(response[1]);
                document.getElementById("created_at").innerHTML = formattedDate;
                document.getElementById("updated_at").innerHTML = updatedAtDate;

            }
        });
    };

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

                //Mengubah updated_at menjadi tanggal local
                let updatedAt = new Date(response[0].updated_at);
                let updatedAtDate = updatedAt.toLocaleDateString(locale, options);

                //fill data to form
                $('#lihat-laporanbar #id').text(response.id);
                $('#lihat-laporanbar #kode_barang').text(response[3]);
                $('#lihat-laporanbar #nama_barang').text(response[2]);
                $('#lihat-laporanbar #ruang_id').text(response[1]);
                $('#lihat-laporanbar #tgl_pembelian').text(new Date(response[0].tgl_pembelian).toLocaleDateString('id-ID', {
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric'
                }));
                $('#lihat-laporanbar #sumber_dana').text(response[0].sumber_dana);
                $('#lihat-laporanbar #jumlah').text(response[0].jumlah);
                $('#lihat-laporanbar #keterangan').text(response[0].keterangan);
                document.getElementById("created_at").innerHTML = formattedDate;
                document.getElementById("updated_at").innerHTML = updatedAtDate;
            }
        });
    };

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
                $('#edit-barang #kode_barang').val(response[0].kode_barang);
                $('#edit-barang #nama_barang').val(response[0].nama_barang);
                $('#edit-barang #ruang_id').val(response[0].ruang_id);
            }
        });
    };

    $('#updatebarang').click(function(e) {
        e.preventDefault();

        let id = $('#edit-barang #id').val();
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
                        <td>${response.data.ruang_id}</td>
                        <td>${response.data.kode_barang}</td>
                        <td>${response.data.nama_barang}</td>
                    </tr>
                `;
            },
        })

    })
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
                $('#edit-laporan #barang_id').val(response[0].barang_id);
                $('#edit-laporan #tgl_pembelian').val(response[0].tgl_pembelian);
                $('#edit-laporan #sumber_dana').val(response[0].sumber_dana);
                $('#edit-laporan #baik').val(response[0].baik);
                $('#edit-laporan #rusak_ringan').val(response[0].rusak_ringan);
                $('#edit-laporan #rusak_berat').val(response[0].rusak_berat);
                $('#edit-laporan #keterangan').val(response[0].keterangan);
            }
        });
    };

    $('#updatedetail').click(function(e) {
        e.preventDefault();

        let id = $('#edit-laporan #id').val();
        let barang_id = $('#edit-laporan #barang_id').val();
        let tgl_pembelian = $('#edit-laporan #tgl_pembelian').val();
        let sumber_dana = $('#edit-laporan #sumber_dana').val();
        let baik = $('#edit-laporan #baik').val();
        let rusak_ringan = $('#edit-laporan #rusak_ringan').val();
        let rusak_berat = $('#edit-laporan #rusak_berat').val();
        let jumlah = $('#edit-laporan #jumlah').val();
        let keterangan = $('#edit-laporan #keterangan').val();

        $.ajax({
            url: `{{url("/updatedetailbar")}}/` + id,
            type: "PUT",
            cache: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                "barang_id": barang_id,
                "tgl_pembelian": tgl_pembelian,
                "sumber_dana": sumber_dana,
                "baik": baik,
                "rusak_ringan": rusak_ringan,
                "rusak_berat": rusak_berat,
                "keterangan": keterangan,
                "jumlah": jumlah,
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
                    <td>${response.data.barang_id}</td>
                        <td>${response.data.tgl_pembelian}</td>
                        <td>${response.data.sumber_dana}</td>
                        <td>${response.data.baik}</td>
                        <td>${response.data.rusak_ringan}</td>
                        <td>${response.data.rusak_berat}</td>
                        <td>${response.data.keterangan}</td>
                        <td>${response.data.jumlah}</td>
                    </tr>
                `;
            },
        })
    })
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

<!-- Script Tambah Data Ruangan -->
<script>
    $('body').on('click', '#tambahruangan', function() {

        //open modal
        $('#tambah-ruangan').modal('show');
    });

    $('#simpanruangan').click(function(e) {
        e.preventDefault();

        let nama_ruang = $('#nama_ruang').val();

        $.ajax({
            url: `{{url('/simpanruangan')}}`,
            type: "POST",
            cache: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                "nama_ruang": nama_ruang,
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

                $('#tabel-ruangan').DataTable().ajax.reload();
                $('#tambah-ruangan').modal('hide');

                let post = `
                    <tr id="index_${response.data.id}">
                        <td>${response.data.nama_ruang}</td>
                    </tr>
                `;
            },
            error: function() {
                Swal.fire({
                    icon: 'error',
                    title: "Gagal Menyimpan Data!",
                    text: 'Mohon isikan nama ruangan',
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
                    url: '/hapusdatalaporan/' + id,
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

        $.ajax({
            url: '/updateruangan/' + id,
            type: "PUT",
            cache: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                "nama_ruang": nama_ruang,
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
                    </tr>
                `;
            },
        })

    })
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

<script>
    $(document).ready(function() {
        var showToast = "{{ session('showToast') ?? false }}";
        if (showToast) {
            var error = "{{ session('error') }}";
            Swal.fire({
                icon: 'error',
                title: 'Gagal Mengubah Kata Sandi',
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timerProgressBar: true,
                timer: 3000,
                text: error
            });
        }
    });
</script>

<script>
    $(document).ready(function() {
        var tampilkanBerhasil = "{{ session('tampilkanBerhasil') ?? false }}";
        if (tampilkanBerhasil) {
            var successMessage = "{{ session('success') }}";
            Swal.fire({
                icon: 'success',
                title: 'Berhasil Mengubah Profil',
                text: 'Data profil berhasil diperbarui',
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timerProgressBar: true,
                timer: 3000,
            });
        }
    });
</script>