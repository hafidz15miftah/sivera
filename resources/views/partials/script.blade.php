<script src="plugins/common/common.min.js"></script>
<script src="js/custom.min.js"></script>
<script src="js/settings.js"></script>
<script src="js/gleek.js"></script>
<script src="js/styleSwitcher.js"></script>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

<!-- Chartjs -->
<script src="/plugins/chart.js/Chart.bundle.min.js"></script>
<!-- Circle progress -->
<script src="/plugins/circle-progress/circle-progress.min.js"></script>
<!-- Datamap -->
<script src="/plugins/d3v3/index.js"></script>
<script src="/plugins/topojson/topojson.min.js"></script>
<script src="/plugins/datamaps/datamaps.world.min.js"></script>
<!-- Morrisjs -->
<script src="/plugins/raphael/raphael.min.js"></script>
<script src="/plugins/morris/morris.min.js"></script>
<!-- Pignose Calender -->
<script src="/plugins/moment/moment.min.js"></script>
<script src="/plugins/pg-calendar/js/pignose.calendar.min.js"></script>
<!-- ChartistJS -->
<script src="/plugins/chartist/js/chartist.min.js"></script>
<script src="/plugins/chartist-plugin-tooltips/js/chartist-plugin-tooltip.min.js"></script>
<script src="/js/dashboard/dashboard-1.js"></script>
<!-- DataTable -->
<script src="/plugins/tables/js/jquery.dataTables.min.js"></script>
<script src="/plugins/tables/js/datatable/dataTables.bootstrap4.min.js"></script>
<script src="/plugins/tables/js/datatable-init/datatable-basic.min.js"></script>
<!-- SweetAlert -->
<script src="{{ asset('/vendors/sweetalert2/sweetalert2.all.min.js') }}"></script>


<script type="text/javascript">
    $(document).ready(function() {
        $('.dropdown-toggle').dropdown();
    });
</script>
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
                    data: 'updated_at',
                    name: 'updated_at'
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
                    type: 'success',
                    icon: 'success',
                    title: `${response.message}`,
                    showConfirmButton: false,
                    timer: 2000
                })

                //Reset Data Form Setelah Simpan Berhasil
                $('#tanggal').val('');
                $('#kode_barang').val('');
                $('#nama_barang').val('');
                $('#kondisi').val('');
                $('#jumlah').val('');
                $('#kondisi').prop('selectedIndex',0);
                $('#ruang_id').prop('selectedIndex',0);

                //Melakukan Hide Modal dan Reload DataTable Setelah Simpan Berhasil
                $('#tambah-barang').modal('hide');
                $('#tabel-barang').DataTable().ajax.reload();

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
                    $('#alert-tanggal').html(error.responseJSON.tanggal[0]);
                }

                if (error.responseJSON.ruang_id[0]) {

                    //show alert
                    $('#alert-ruang_id').removeClass('d-none');
                    $('#alert-ruang_id').addClass('d-block');

                    //add message to alert
                    $('#alert-ruang_id').html(error.responseJSON.ruang_id[0]);
                }

                if (error.responseJSON.kode_barang[0]) {

                    //show alert
                    $('#alert-kode_barang').removeClass('d-none');
                    $('#alert-kode_barang').addClass('d-block');

                    //add message to alert
                    $('#alert-kode_barang').html(error.responseJSON.kode_barang[0]);
                }

                if (error.responseJSON.nama_barang[0]) {

                    //show alert
                    $('#alert-nama_barang').removeClass('d-none');
                    $('#alert-nama_barang').addClass('d-block');

                    //add message to alert
                    $('#alert-nama_barang').html(error.responseJSON.nama_barang[0]);
                }

                if (error.responseJSON.kondisi[0]) {

                    //show alert
                    $('#alert-kondisi').removeClass('d-none');
                    $('#alert-kondisi').addClass('d-block');

                    //add message to alert
                    $('#alert-kondisi').html(error.responseJSON.kondisi[0]);
                }

                if (error.responseJSON.jumlah[0]) {

                    //show alert
                    $('#alert-jumlah').removeClass('d-none');
                    $('#alert-jumlah').addClass('d-block');

                    //add message to alert
                    $('#alert-jumlah').html(error.responseJSON.jumlah[0]);
                }
            }

        });

    });
</script>

<!-- Script Hapus Data Barang -->
<script>
    function deleteData(e) {
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
                            Swal.fire(
                                'Berhasil!',
                                response.message,
                                'success'
                            )
                            $('#tabel-barang').DataTable().ajax.reload();;
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