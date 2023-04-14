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
                    <a class="btn btn-primary" style="color:white" href="{{route('tambahbarang')}}"><i class="fa fa-plus"></i> Tambah Barang</a>
                    <a class="btn btn-success" style="color:white" href="{{route('tambahbarang')}}"><i class="fa fa-print"></i> Cetak Barang</a>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered zero-configuration">
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
                                @foreach($barang as $b)
                                <tr>
                                    <td>{{$b->tanggal}}</td>
                                    <td>{{$b->ruang->nama_ruang}}</td>
                                    <td>{{$b->kode_barang}}</td>
                                    <td>{{$b->nama_barang}}</td>
                                    <td>{{$b->kondisi}}</td>
                                    <td>{{$b->jumlah}}</td>
                                    <td>{{$b->updated_at}}</td>
                                    <td>
                                        <a href="/updatebarang/{{$b->id}}" style="color: white" class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i></a>
                                        <button data-id="{{ $b->id }}" data-name="{{ $b->nama_barang }}" onclick="deleteData(this)" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                    </td>
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
@endsection
