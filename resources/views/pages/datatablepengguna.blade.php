<title>Daftar Pengguna &minus; Sistem Informasi Inventaris Barang dan Aset Desa</title>
@extends('layouts.app-layout')

@section('content')

<div class="row page-titles mx-0">
    <div class="col p-md-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Fungsional Sistem</a></li>
            <li class="breadcrumb-item active"><a href="/pengguna">Daftar Pengguna</a></li>
        </ol>
    </div>
</div>
<!-- row -->

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Daftar Pengguna</h4>
                    <a class="btn btn-primary" id="tambahpengguna" style="color:white" href="javascript:void(0)"><i class="fa fa-plus"></i> Tambah Pengguna</a>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered zero-configuration">
                            <thead>
                                <tr>
                                    <th>Tanggal Dibuat</th>
                                    <th>Nama</th>
                                    <th>NIP</th>
                                    <th>Alamat</th>
                                    <th>Email</th>
                                    <th>Jabatan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $u)
                                <tr>
                                    <td>{{$u->created_at}}</td>
                                    <td>{{$u->name}}</td>
                                    <td>{{$u->nip}}</td>
                                    <td>{{$u->alamat}}</td>
                                    <td>{{$u->email}}</td>
                                    <td>{{$u->role_name}}</td>
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

<!-- Modal Tambah Data Pengguna -->
<!-- #/ container -->
@endsection