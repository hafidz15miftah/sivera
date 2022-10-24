<!DOCTYPE html>
<html lang="id">
<title>Daftar Aset &minus; Sistem Informasi Inventaris Barang dan Aset Desa</title>

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
                        <li class="breadcrumb-item"><a href="#">Fungsional Sistem</a></li>
                        <li class="breadcrumb-item"><a href="#">Tabel</a></li>
                        <li class="breadcrumb-item active"><a href="/aset">Daftar Aset</a></li>
                    </ol>
                </div>
            </div>
            <!-- row -->

            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Daftar Aset</h4>
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered zero-configuration">
                                        <thead>
                                            <tr>
                                                <th>Nama Aset</th>
                                                <th>Kondisi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($aset as $a)
                                            <tr>
                                                <td>{{$a->nama_aset}}</td>
                                                <td>{{$a->kondisi}}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
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