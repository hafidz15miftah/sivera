<!DOCTYPE html>
<html lang="id">
<title>Tambah Barang &minus; Sistem Informasi Inventaris Barang dan Aset Desa</title>

<!-- Head -->
@include('partials.head')

<body>

    <!-- Loading -->
    @include('partials.loading')


    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <!-- Nav Header -->
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
                        <li class="breadcrumb-item"><a href="#">Fungsional Sistem</a></li>
                        <li class="breadcrumb-item"><a href="#">Tabel</a></li>
                        <li class="breadcrumb-item"><a href="/barang">Daftar Barang</a></li>
                        <li class="breadcrumb-item active"><a href="/tambah-barang">Tambah Barang</a></li>
                    </ol>
                </div>
            </div>
            <!-- row -->

            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Tambah Barang</h4>
                                <div class="card-body">
                                    <div class="form-validation">
                                        <form class="form-valide" action="#" method="post">
                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label" for="val-kode">Kode Barang</label>
                                                <div class="col-lg-6">
                                                    <input type="text" class="form-control" id="val-kode" name="val-kode" placeholder="Masukkan Kode Barang">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label" for="val-nama">Nama Barang</label>
                                                <div class="col-lg-6">
                                                    <input type="text" class="form-control" id="val-nama" name="val-nama" placeholder="Masukkan Nama Barang">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label" for="val-kondisi">Kondisi</label>
                                                <div class="col-lg-6">
                                                    <select class="form-control" id="val-kondisi" name="val-skill">
                                                        <option value="">Silahkan Pilih ...</option>
                                                        <option value="baik">Baik</option>
                                                        <option value="ruring">Rusak Ringan</option>
                                                        <option value="rusber">Rusak Berat</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label" for="val-jumlah">Jumlah</label>
                                                <div class="col-lg-6">
                                                    <input type="password" class="form-control" id="val-jumlah" name="val-jumlah" placeholder="Masukkan Jumlah Barang">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label" for="val-deskripsi">Deskripsi</label>
                                                <div class="col-lg-6">
                                                    <textarea class="form-control" id="val-deskripsi" name="val-deskripsi" rows="5" placeholder="Masukkan Informasi / Deskripsi Barang"></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-lg-8 ml-auto">
                                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
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