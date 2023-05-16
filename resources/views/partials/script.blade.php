<script src="plugins/common/common.min.js"></script>
<script src="js/custom.min.js"></script>
<script src="js/settings.js"></script>
<script src="js/gleek.js"></script>
<script src="js/styleSwitcher.js"></script>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.js"></script>
<!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script> -->

<!-- Chartjs -->
<script src="/plugins/chart.js/Chart.bundle.min.js"></script>
<!-- Circle progress -->
<script src="/plugins/circle-progress/circle-progress.min.js"></script>
<!-- DataTable -->
<script src="/plugins/tables/js/jquery.dataTables.min.js"></script>
<script src="/plugins/tables/js/datatable/dataTables.bootstrap4.min.js"></script>
<script src="/plugins/tables/js/datatable-init/datatable-basic.min.js"></script>
<!-- SweetAlert -->
<script src="{{ asset('/vendors/sweetalert2/sweetalert2.all.min.js') }}"></script>

<!-- Script Tampilkan Data Barang YajraDataTables -->
<script type="text/javascript">
    $(document).ready(function() {
        $('#tabel-barang').DataTable({
            processing: true,
            serverSide: true,
            destroy: true,
            columns: [{
                    data: 'tanggal',
                    name: 'tanggal'
                },
                {
                    data: 'nama_ruang',
                    name: 'nama_ruang'
                },
                {
                    data: 'kode_barang',
                    name: 'kode_barang'
                },
                {
                    data: 'nama_barang',
                    name: 'nama_barang'
                },
                {
                    data: 'kondisi',
                    name: 'kondisi'
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
        let tanggal = $('#tanggal').val();
        let ruang_id = $('#ruang_id').val();
        let kode_barang = $('#kode_barang').val();
        let nama_barang = $('#nama_barang').val();
        let kondisi = $('#kondisi').val();
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
                "tanggal": tanggal,
                "ruang_id": ruang_id,
                "kode_barang": kode_barang,
                "nama_barang": nama_barang,
                "kondisi": kondisi,
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
                    timer: 3000
                })

                //Reset Data Form Setelah Simpan Berhasil
                $('#tanggal').val('');
                $('#kode_barang').val('');
                $('#nama_barang').val('');
                $('#jumlah').val('');
                $('#kondisi').prop('selectedIndex', 0);
                $('#ruang_id').prop('selectedIndex', 0);

                //Melakukan Hide Modal dan Reload DataTable Setelah Simpan Berhasil
                $('#tabel-barang').DataTable().clear().draw();
                $('#tambah-barang').modal('hide');

                //Post Data
                let post = `
                    <tr id="index_${response.data.id}">
                        <td>${response.data.tanggal}</td>
                        <td>${response.data.ruang}</td>
                        <td>${response.data.kode_barang}</td>
                        <td>${response.data.nama_barang}</td>
                        <td>${response.data.kondisi}</td>
                        <td>${response.data.jumlah}</td>
                    </tr>
                `;
            },
            error: function(error) {

                if (error.responseJSON.tanggal[0]) {

                    //show alert
                    $('#alert-tanggal').removeClass('d-none');
                    $('#alert-tanggal').addClass('d-block');

                    //add message to alert
                    $('#alert-tanggal').html('Data Tanggal Perlu Dipilih');
                }

                if (error.responseJSON.ruang_id[0]) {

                    //show alert
                    $('#alert-ruang_id').removeClass('d-none');
                    $('#alert-ruang_id').addClass('d-block');

                    //add message to alert
                    $('#alert-ruang_id').html('Data Ruang Perlu Dipilih');
                }

                if (error.responseJSON.kode_barang[0]) {

                    //show alert
                    $('#alert-kode_barang').removeClass('d-none');
                    $('#alert-kode_barang').addClass('d-block');

                    //add message to alert
                    $('#alert-kode_barang').html('Kolom Kode Barang Perlu Diisi');
                }

                if (error.responseJSON.nama_barang[0]) {

                    //show alert
                    $('#alert-nama_barang').removeClass('d-none');
                    $('#alert-nama_barang').addClass('d-block');

                    //add message to alert
                    $('#alert-nama_barang').html('Kolom Nama Barang Perlu Diisi');
                }

                if (error.responseJSON.kondisi[0]) {

                    //show alert
                    $('#alert-kondisi').removeClass('d-none');
                    $('#alert-kondisi').addClass('d-block');

                    //add message to alert
                    $('#alert-kondisi').html('Data Kondisi Perlu Dipilih');
                }

                if (jumlah == 0) {

                    //show alert
                    $('#alert-jumlah').removeClass('d-none');
                    $('#alert-jumlah').addClass('d-block');

                    //add message to alert
                    $('#alert-jumlah').html('Jumlah Barang Harus Lebih dari 0');
                }
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
                $('#lihat-barang #tanggal').text(new Date(response[0].tanggal).toLocaleDateString('id-ID', {
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric'
                }));
                $('#lihat-barang #kode_barang').text(response[0].kode_barang);
                $('#lihat-barang #nama_barang').text(response[0].nama_barang);
                $('#lihat-barang #kondisi').text(response[0].kondisi);
                $('#lihat-barang #jumlah').text(response[0].jumlah);
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
                $('#edit-barang #tanggal').val(response[0].tanggal);
                $('#edit-barang #kode_barang').val(response[0].kode_barang);
                $('#edit-barang #nama_barang').val(response[0].nama_barang);
                $('#edit-barang #kondisi').val(response[0].kondisi);
                $('#edit-barang #jumlah').val(response[0].jumlah);
                $('#edit-barang #ruang_id').val(response[0].ruang_id);
            }
        });
    };

    $('#updatebarang').click(function(e) {
        e.preventDefault();

        let id = $('#edit-barang #id').val();
        let tanggal = $('#edit-barang #tanggal').val();
        let ruang_id = $('#edit-barang #ruang_id').val();
        let kode_barang = $('#edit-barang #kode_barang').val();
        let nama_barang = $('#edit-barang #nama_barang').val();
        let kondisi = $('#edit-barang #kondisi').val();
        let jumlah = $('#edit-barang #jumlah').val();

        $.ajax({
            url: `/updatebarang/` + id,
            type: "PUT",
            cache: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                "tanggal": tanggal,
                "ruang_id": ruang_id,
                "kode_barang": kode_barang,
                "nama_barang": nama_barang,
                "kondisi": kondisi,
                "jumlah": jumlah,
            },
            success: function(response) {

                //show success message
                Swal.fire({
                    icon: 'success',
                    title: "Data barang berhasil diperbarui",
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timerProgressBar: true,
                    timer: 3000
                })

                //Melakukan Hide Modal dan Reload DataTable Setelah Simpan Berhasil
                $('#tabel-barang').DataTable().clear().draw();
                $('#update-barang').modal('close');

                //Post Data
                let post = `
                    <tr id="index_${response.data.id}">
                        <td>${response.data.tanggal}</td>
                        <td>${response.data.ruang_id}</td>
                        <td>${response.data.kode_barang}</td>
                        <td>${response.data.nama_barang}</td>
                        <td>${response.data.kondisi}</td>
                        <td>${response.data.jumlah}</td>
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
                        Swal.fire(
                            'Gagal!',
                            'Terjadi kesalahan saat menghapus data.',
                            'error'
                        );
                    }
                });
            }
        });
    }
</script>

<!-- Script Tampilkan Data Ruangan YajraDataTables -->
<script type="text/javascript">
    $(document).ready(function() {
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
                    name: 'nama_ruang'
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
            error: function(error) {
                if (error.responseJSON.nama_ruang[0]) {
                    $('#alert-nama_ruang').removeClass('d-none');
                    $('#alert-nama_ruang').addClass('d-block');

                    //add message to alert
                    $('#alert-nama_ruang').html('Nama Ruangan Wajib Diisi!');
                }
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
                            $('#tabel-ruangan').DataTable().ajax.reload();;
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
                            title: "Data ruangan " + name + " gagal dihapus",
                            text: "Pastikan tidak ada barang yang ada di ruangan!",
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
                    title: "Data ruangan berhasil diperbarui",
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timerProgressBar: true,
                    timer: 3000
                })
                } else {
                    Swal.fire({
                    icon: 'error',
                    title: "Data ruangan sudah ada",
                    text: "Pastikan nama ruangan berbeda dari ruangan yang sudah ada!",
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