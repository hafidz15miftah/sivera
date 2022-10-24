
<!DOCTYPE html>
<html lang="id">
<title>Pusat Bantuan &minus; Sistem Informasi Inventaris Barang dan Aset Desa</title>

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
                        <li class="breadcrumb-item active"><a href="/bantuan">Pusat Bantuan</a></li>
                    </ol>
                </div>
            </div>
            <!-- row -->

            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class card-title>Pusat Bantuan</h4>
                                <p>Untuk mengunduh manual penggunaan, silahkan klik tombol di bawah ini</p>
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