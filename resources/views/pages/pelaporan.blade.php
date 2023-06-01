<title>Daftar Laporan &minus; Sistem Informasi Inventaris Barang dan Aset Desa</title>
@extends('layouts.app-layout')

@section('content')
<div class="row page-titles mx-0">
    <div class="col p-md-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Pelaporan</a></li>
            <li class="breadcrumb-item active"><a href="/pelaporan">Daftar Laporan</a></li>
        </ol>
    </div>
</div>
<!-- row -->

<!-- Modal Tambah Pelaporan -->
<div class="modal fade" id="tambah-pelaporan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Buat Laporan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="add_pelaporan" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="barang_id">Pilih ID Barang:</label>
                        <select class="form-control" name="info_id" id="info_id" required>
                            <option value="">Silahkan Pilih ...</option>
                            @foreach ($info as $i)
                            <option value="{{ $i->id }}">{{ $i->kode_detail }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="nama_laporan">Nama Laporan</label>
                                <input class="form-control" type="text" id="nama_laporan" name="nama_laporan">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="file_pdf">File Gambar Barang Rusak</label>
                                <input class="form-control" type="file" name="file_gambar" id="file_gambar" accept="image/*">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="file_pdf">File Berita Acara dalam PDF</label>
                                <input class="form-control" type="file" name="file_pdf" id="file_pdf" accept="application/pdf">
                            </div>
                        </div>
                    </div>
                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-success text-white" id="simpanPelaporan">Laporkan</button>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Daftar Laporan</h4>
                    @if (Auth::user()->role_id == 2)
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambah-pelaporan"><i class="fa fa-plus"></i> Tambah Pelaporan</button>
                    <a class="btn btn-warning" style="color:white" href="{{ url('pelaporan/cetak/bulanan') }}"><i class="fa fa-print"></i> Cetak Laporan Bulan Ini</a>
                    <!-- <a class="btn btn-warning" style="color:white" href="{{ url('pelaporan/cetak/tahunan') }}"><i class="fa fa-print"></i> Laporan Tahun Ini</a> -->
                    @endif
                    <div class="table-responsive">
                        <table id="tabel-pelaporan" class="table table-striped table-bordered zero-configuration">
                            <thead>
                                <tr>
                                    <th style="text-align: center">No</th>
                                    <th style="text-align: center">ID Barang</th>
                                    <th style="text-align: center">Nama Laporan</th>
                                    <th style="text-align: center">Tanggal Dilaporkan</th>
                                    <th style="text-align: center" width="20%">Status</th>
                                    <th style="text-align: center">Keterangan</th>
                                    <th style="text-align: center" width="35%">Aksi</th>
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