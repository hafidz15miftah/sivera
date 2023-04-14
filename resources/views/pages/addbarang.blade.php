<title>Tambah Barang &minus; Sistem Informasi Inventaris Barang dan Aset Desa</title>
@extends('layouts.app-layout')

@section('content')
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
                            <form method="post" action="{{route('simpanbarang')}}">
                                @csrf
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="ruang_id">Ruang</label>
                                    <div class="col-lg-6">
                                        <select class="form-control" id="ruang_id" name="ruang">
                                            <option value="">Silahkan Pilih ...</option>
                                            @foreach($ruang as $r)
                                            <option value="{{ $r->id }}">{{ $r->nama_ruang }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="tanggal">Tanggal</label>
                                    <div class="col-lg-6">
                                        <input type="date" class="form-control" id="tanggal" name="tanggal" placeholder="Masukkan Nama Barang">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="kode">Kode Barang</label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control" id="kode" name="kode_barang" placeholder="Masukkan Kode Barang">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="nama">Nama Barang</label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control" id="nama" name="nama_barang" placeholder="Masukkan Nama Barang">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="kondisi">Kondisi</label>
                                    <div class="col-lg-6">
                                        <select class="form-control" id="kondisi" name="kondisi">
                                            <option value="">Silahkan Pilih ...</option>
                                            <option value="Baik">Baik</option>
                                            <option value="Rusak Ringan">Rusak Ringan</option>
                                            <option value="Rusak Berat">Rusak Berat</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="jumlah">Jumlah</label>
                                    <div class="col-lg-6">
                                        <input type="number" class="form-control" id="jumlah" name="jumlah" placeholder="Masukkan Jumlah Barang">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-8 ml-auto">
                                        <button type="button" class="btn btn-success text-white" data-toggle="modal" data-target="#exampleModalCenter">Simpan</button>
                                        <button type="button" class="btn btn-danger text-white">Batal</button>
                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModalCenter">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Simpan Data</h5>
                                                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Apakah data yang Anda masukkan sudah benar?</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary text-white" data-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-success text-white">Simpan</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
@endsection
