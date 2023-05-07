<title>Daftar Barang &minus; Sistem Informasi Inventaris Barang dan Aset Desa</title>
@extends('layouts.app-layout')

@section('content')

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
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambah-barang"><i class="fa fa-print"></i> Tambah Barang</button>
                    <a class="btn btn-success" style="color:white" href="{{route('tambahbarang')}}"><i class="fa fa-print"></i> Cetak Barang</a>
                    <div class="table-responsive">
                        <table id="tabel-barang" class="table table-striped table-bordered zero-configuration">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Ruang</th>
                                    <th>Kode Barang</th>
                                    <th>Nama Barang</th>
                                    <th>Kondisi</th>
                                    <th>Jumlah</th>
                                    <th>Audit Terakhir</th>
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

<div class="modal fade" id="tambah-barang" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @csrf
                <form id="add_barang">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="tanggal" class="col-form-label">Tanggal:</label>
                            <input type="date" class="form-control" name="tanggal" id="tanggal">
                            <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-tanggal"></div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="ruang" class="col-form-label">Ruang:</label>
                            <select class="form-control" id="ruang_id" name="ruang">
                                <option value="">Silahkan Pilih ...</option>
                                @foreach($ruang as $r)
                                <option value="{{ $r->id }}" name="ruang_id" id="ruang_id">{{ $r->nama_ruang }}</option>
                                @endforeach
                            </select>
                            <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-ruang_id"></div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="kode_barang" class="col-form-label">Kode Barang:</label>
                            <input type="text" class="form-control" name="kode_barang" id="kode_barang">
                            <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-kode_barang"></div>
                        </div>
                        <div class="form-group col-md-7">
                            <label for="nama_barang" class="col-form-label">Nama Barang:</label>
                            <input type="text" class="form-control" name="nama_barang" id="nama_barang">
                            <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-nama_barang"></div>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="jumlah" class="col-form-label">Jumlah:</label>
                            <input type="number" class="form-control" name="jumlah" id="jumlah">
                            <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-jumlah"></div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="kondisi" class="col-form-label">Kondisi:</label>
                        <select class="form-control" id="kondisi" name="kondisi">
                            <option value="">Silahkan Pilih ...</option>
                            <option value="Baik">Baik</option>
                            <option value="Rusak Ringan">Rusak Ringan</option>
                            <option value="Rusak Berat">Rusak Berat</option>
                        </select>
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-kondisi"></div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-success" id="simpanbarang">Simpan</button>
            </div>
        </div>
    </div>
</div>
@endsection