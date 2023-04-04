<title>Profil Pengguna &minus; Sistem Informasi Inventaris Barang dan Aset Desa</title>
@extends('layouts.app-layout')

@section('content')
<div class="row page-titles mx-0">
    <div class="col p-md-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Profil</a></li>
            <li class="breadcrumb-item active"><a href="/profil">Data Pengguna</a></li>
        </ol>
    </div>
</div>
<!-- row -->

<div class="container-fluid">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Pengguna</h4>
                <div class="basic-form">
                    <form>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Nama</label>
                                <input type="email" class="form-control" placeholder="{{auth()->user()->name}}">
                            </div>
                            <div class="form-group col-md-6">
                                <label>NIP</label>
                                <input type="password" class="form-control" placeholder="Masukkan NIP...">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Alamat</label>
                            <input type="text" class="form-control" placeholder="Masukkan Alamat...">
                        </div>
                        <div class="form-group">
                            <label>Alamat Email</label>
                            <input type="text" class="form-control" placeholder="Email">
                        </div>
                        <button type="submit" class="btn btn-dark">Sign in</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- #/ container -->
@endsection