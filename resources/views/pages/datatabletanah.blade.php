<title>Daftar Aset Tanah/Lahan &minus; Sistem Informasi Inventaris Barang dan Aset Desa</title>
@extends('layouts.app-layout')

@section('content')

<div class="row page-titles mx-0">
    <div class="col p-md-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Fungsional Sistem</a></li>
            <li class="breadcrumb-item"><a href="#">Tabel</a></li>
            <li class="breadcrumb-item active"><a href="/aset">Daftar Aset</a></li>
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
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered zero-configuration">
                            <thead>
                                <tr>
                                    <th>Nama Obyek</th>
                                    <th>Alamat</th>
                                    <th>No. Sertifikat</th>
                                    <th>Luas</th>
                                    <th>Kondisi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($tanah as $t)
                                <tr>
                                    <td>{{$t->nama_obyek}}</td>
                                    <td>{{$t->alamat}}</td>
                                    <td>{{$t->no_sertifikat}}</td>
                                    <td>{{$t->luas}}</td>
                                    <td>{{$t->kondisi}}</td>

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
<!-- #/ container -->
@endsection