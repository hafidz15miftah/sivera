<title>Daftar Aset Tanah/Lahan &minus; Sistem Informasi Inventaris Barang dan Aset Desa</title>
@extends('layouts.app-layout')

@section('content')

<div class="row page-titles mx-0">
    <div class="col p-md-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Fungsional Sistem</a></li>
            <li class="breadcrumb-item active"><a href="/aset">Daftar Tanah / Lahan</a></li>
        </ol>
    </div>
</div>
<!-- row -->

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Daftar Aset Tanah/Lahan</h4>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambah-lahan"><i class="fa fa-plus"></i> Tambah Aset Tanah / Lahan</button>
                    <div class="table-responsive">
                        <table id="tabel-tanah" class="table table-striped table-bordered zero-configuration">
                            <thead>
                                <tr>
                                    <th>Nama Obyek</th>
                                    <th>Alamat</th>
                                    <th>No. Sertifikat</th>
                                    <th>Luas</th>
                                    <th>Kondisi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Data Tanah / Lahan -->
<div class="modal fade" id="tambah-lahan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Aset Tanah / Lahan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @csrf
                <form id="add_lahan">
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama_obyek" class="col-form-label">Nama Obyek:</label>
                                <input type="text" class="form-control" name="nama_obyek" id="nama_obyek" require>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="no_sertifikat" class="col-form-label">Nomor Sertifikat:</label>
                                <input type="text" class="form-control" name="no_sertifikat" id="no_sertifikat" require>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="luas" class="col-form-label">Luas:</label>
                                <input class="form-control" type="number" min="0" placeholder="0" name="luas" id="luas" require>
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="alamat" class="col-form-label">Alamat:</label>
                                <input type="text" class="form-control" name="alamat" id="alamat" require>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="kondisi" class="col-form-label">Kondisi:</label>
                                <select class="form-control" id="kondisi" name="kondisi" require>
                                    <option value="" selected disabled>Silahkan Pilih ...</option>
                                    <option value="Baik">Baik</option>
                                    <option value="Rusak Ringan">Rusak Ringan</option>
                                    <option value="Rusak Berat">Rusak Berat</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="keterangan">Keterangan</label>
                                <textarea class="form-control" name="keterangan" id="keterangan"></textarea>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                <button autofocus type="button" class="btn btn-success text-white" id="simpanlahan">Simpan</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Update Tanah / Lahan -->
<div class="modal fade" id="edit-lahan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Data Aset Tanah / Lahan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <input type="hidden" id="id">
                @csrf
                <form id="edit_lahan">
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama_obyek" class="col-form-label">Nama Obyek:</label>
                                <input type="text" class="form-control" name="nama_obyek" id="nama_obyek" require>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="no_sertifikat" class="col-form-label">Nomor Sertifikat:</label>
                                <input type="text" class="form-control" name="no_sertifikat" id="no_sertifikat" require>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="luas" class="col-form-label">Luas:</label>
                                <input class="form-control" type="number" min="0" placeholder="0" name="luas" id="luas" require>
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="alamat" class="col-form-label">Alamat:</label>
                                <input type="text" class="form-control" name="alamat" id="alamat" require>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="kondisi" class="col-form-label">Kondisi:</label>
                                <select class="form-control" id="kondisi" name="kondisi" require>
                                    <option value="" selected disabled>Silahkan Pilih ...</option>
                                    <option value="Baik">Baik</option>
                                    <option value="Rusak Ringan">Rusak Ringan</option>
                                    <option value="Rusak Berat">Rusak Berat</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="keterangan">Keterangan</label>
                                <textarea class="form-control" name="keterangan" id="keterangan"></textarea>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                <button autofocus type="button" class="btn btn-success text-white" id="updatelahan">Update</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Lihat Aset Tanah / Lahan -->
<div class="modal fade" id="lihat-lahan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Lihat Detail Data Tanah / Aset</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
            </div>
            <div class="modal-body">
                <p><strong>Nama Obyek:</strong> <span id="nama_obyek"></span></p>
                <p><strong>Alamat:</strong> <span id="alamat"></span></p>
                <p><strong>No. Sertifikat:</strong> <span id="no_sertifikat"></span></p>
                <p><strong>Luas:</strong> <span id="luas"></span></p>
                <p><strong>Kondisi:</strong> <span id="kondisi"></span></p>
                <p><strong>Keterangan:</strong> <span id="keterangan"></span></p>
                <p><strong>Ditambahkan:</strong> <span id="created_at"></span></p>
                <p><strong>Terakhir Diubah:</strong> <span id="updated_at"></span></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary text-white" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
<!-- #/ container -->
@endsection