<script src="plugins/common/common.min.js"></script>
<script src="js/custom.min.js"></script>
<script src="js/settings.js"></script>
<script src="js/gleek.js"></script>
<script src="js/styleSwitcher.js"></script>
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

<!-- Menampilkan Info Profil Gagal Diupdate -->
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

<!-- Script Menampilkan Info Profil Berhasil Diubah -->
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