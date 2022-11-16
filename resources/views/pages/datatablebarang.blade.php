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
                    <a class="btn btn-success" style="color:white" href="{{route('tambahbarang')}}"><i class="fa fa-plus"></i> Tambah Barang</a>
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
                                    <td style="margin: auto;">
                                        <p class="badge badge-success" style="justify-content: center; align-items: center; align-content: center; margin-left: 15px; color:white; padding: 8px;">{{$b->kondisi}}</p>
                                    </td>
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
@endsection