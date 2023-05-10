<title>Data Ruangan &minus; Sistem Informasi Inventaris Barang dan Aset Desa</title>
@extends('layouts.app-layout')

@section('content')

<div class="row page-titles mx-0">
    <div class="col p-md-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Fungsional Sistem</a></li>
            <li class="breadcrumb-item active"><a href="/ruangan">Data Ruangan</a></li>
        </ol>
    </div>
</div>
<!-- row -->

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Data Ruangan</h4>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambah-ruangan"><i class="fa fa-print"></i> Tambah Ruangan</button>
                    <div class="table-responsive">
                        <table id="tabel-ruangan" class="table table-striped table-bordered zero-configuration">
                            <thead>
                                <tr>
                                    <th>ID Ruang</th>
                                    <th>Nama Ruang</th>
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

<div class="modal fade" id="tambah-ruangan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Ruangan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="nama_ruang" class="col-form-label">Nama Ruangan:</label>
                        <input type="text" class="form-control" name="nama_ruang" id="nama_ruang" require>
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-nama_ruang"></div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="simpanruangan">Simpan</button>
            </div>
        </div>
    </div>
</div>
@endsection