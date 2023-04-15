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
                    <a class="btn btn-success" style="color:white" href="/tambahruangan"><i class="fa fa-plus"></i> Tambah Ruangan</a>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered zero-configuration">
                            <thead>
                                <tr>
                                    <th>ID Ruang</th>
                                    <th>Nama Ruang</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($ruangan as $r)
                                <tr>
                                    <td>{{$r->id}}</td>
                                    <td>{{$r->nama_ruang}}</td>
                                    <td>
                                        <a href="/updatebarang/" style="color: white" class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i></a>
                                        <button data-id="{{ $r->id }}" data-name="{{ $r->nama_ruang }}" onclick="deleteData(this)" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
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