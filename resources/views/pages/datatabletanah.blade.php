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
<!-- #/ container -->
@endsection