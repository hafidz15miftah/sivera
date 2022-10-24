
<!DOCTYPE html>
<html lang="id">
<title>Tentang Sivera &minus; Sistem Informasi Inventaris Barang dan Aset Desa</title>

<!-- Head -->
@include('partials.head')

<body>

    <!-- Loading Progressbar -->
    @include('partials.loading')

    
    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <!-- Nav Header Logo -->
        @include('partials.navheaderlogo')

        <!-- Header -->
        @include('partials.header')

        <!-- Sidebar -->
        @include('partials.sidebar')

        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">

            <div class="row page-titles mx-0">
                <div class="col p-md-0">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Lainnya</a></li>
                        <li class="breadcrumb-item active"><a href="/sivera">Tentang Sivera</a></li>
                    </ol>
                </div>
            </div>
            <!-- row -->

            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class card-title>Tentang Sivera</h4>
                                <p>SIVERA atau Sistem Informasi Inventaris Barang dan Aset Desa adalah sistem informasi berbasis website yang dikembangkan untuk memudahkan perangkat desa dalam melakukan pendataan barang dan aset yang dimiliki oleh desa secara efektif dan efisien</p>
                                <p>Hak Cipta &copy; 2022 &minus; Pemerintah Desa Kedawung, Hafidz Miftah Fauzi, Politeknik Negeri Cilacap</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #/ container -->
        </div>
        <!--**********************************
            Content body end
        ***********************************-->
        
        
        <!-- Footer -->
        @include('partials.footer')
    </div>

    <!-- Script -->
    @include('partials.script')

</body>

</html>