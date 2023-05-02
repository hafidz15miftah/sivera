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

<!-- Script Tambah Data Barang -->
<script>
    //button create post event
    $('body').on('click', '#tambahbarang', function() {
        //open modal
        $('#exampleModal').modal('show');
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
        // let token = $('#token').val();
        console.log(tanggal + '-' + ruang_id + kode_barang + nama_barang + kondisi + jumlah);


        //ajax
        $.ajax({
            url: `{{url('/simpanbarang')}}`,
            type: "POST",
            cache: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                // "token": token,
                "tanggal": tanggal,
                "ruang_id": ruang_id,
                "kode_barang": kode_barang,
                "nama_barang": nama_barang,
                "kondisi": kondisi,
                "jumlah": jumlah,
            },
            // success: function(response) {
            //     if (response.errors) {
            //         console.log(response.errors);
            //     }
            // }
            success: function(response) {

                //show success message
                Swal.fire({
                    type: 'success',
                    icon: 'success',
                    title: `${response.message}`,
                    showConfirmButton: false,
                    timer: 3000
                }).then((result) => {
                    location.reload();
                });;

                //data post
                let post = `
                    <tr id="index_${response.data.id}">
                        <td>${response.data.tanggal}</td>
                        <td>${response.data.ruang}</td>
                        <td>${response.data.kode_barang}</td>
                        <td>${response.data.nama_barang}</td>
                        <td>${response.data.kondisi}</td>
                        <td>${response.data.jumlah}</td>
                        <td class="text-center">
                            <a href="javascript:void(0)" id="btn-edit-post" data-id="${response.data.id}" class="btn btn-primary btn-sm">EDIT</a>
                            <a href="javascript:void(0)" id="btn-delete-post" data-id="${response.data.id}" class="btn btn-danger btn-sm">DELETE</a>
                        </td>
                    </tr>
                `;

                //append to table
                $('#tabelbarang').prepend(post);

                //close modal
                $('#exampleModal').modal('hide');
            },
            error: function(error) {

                if (error.responseJSON.title[0]) {

                    //show alert
                    $('#alert-title').removeClass('d-none');
                    $('#alert-title').addClass('d-block');

                    //add message to alert
                    $('#alert-title').html(error.responseJSON.title[0]);
                }

                if (error.responseJSON.content[0]) {

                    //show alert
                    $('#alert-content').removeClass('d-none');
                    $('#alert-content').addClass('d-block');

                    //add message to alert
                    $('#alert-content').html(error.responseJSON.content[0]);
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
                            ).then((result) => {
                                location.reload();
                            });
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