<!DOCTYPE html>
<html lang="id">
<title>Pengguna &minus; Sistem Informasi Inventaris Barang dan Aset Desa</title>

<!-- Head -->
@include('partials.head')

<body>
    <!-- Loading -->
    @include('partials.loading')

    <div id="main-wrapper">

        <!-- Navheader Logo -->
        @include('partials.navheaderlogo')

        <!-- Header -->
        @include('partials.header')

        <!-- Sidebar -->
        @include('partials.sidebar')

        <!-- Content Body -->
        <div class="content-body">

            <div class="row page-titles mx-0">
                <div class="col p-md-0">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Lainnya</a></li>
                        <li class="breadcrumb-item active"><a href="/pengguna">Pengguna</a></li>
                    </ol>
                </div>
            </div>
            <!-- row -->

            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Daftar Pengguna</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #/ container -->
        </div>

        <!-- Footer -->
        @include('partials.footer')
    </div>

    <!-- Script -->
    @include('partials.script')
</body>

</html>