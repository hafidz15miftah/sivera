<!DOCTYPE html>
<html lang="id">
<title>Daftar Barang &minus; Sistem Informasi Inventaris Barang dan Aset Desa</title>

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
                        <li class="breadcrumb-item active"><a href="/barang">Daftar Barang</a></li>
                    </ol>
                </div>
            </div>
            <!-- row -->

            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Daftar Barang</h4>
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered zero-configuration">
                                        <thead>
                                            <tr>
                                                <th>Ruang</th>
                                                <th>Tanggal</th>
                                                <th>Kode Barang</th>
                                                <th>Nama Barang</th>
                                                <th>Kondisi</th>
                                                <th>Jumlah</th>
                                                <th>Deskripsi</th>
                                                <th>Audit Terakhir</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($barang as $b)
                                            <tr>
                                                <td>{{$b->ruang}}</td>
                                                <td>{{$b->tanggal}}</td>
                                                <td>{{$b->kode_barang}}</td>
                                                <td>{{$b->nama_barang}}</td>
                                                <td>{{$b->kondisi}}</td>
                                                <td>{{$b->jumlah}}</td>
                                                <td>{{$b->deskripsi}}</td>
                                                <td>{{$b->updated_at}}</td>
                                                <td>Hapus</td>
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