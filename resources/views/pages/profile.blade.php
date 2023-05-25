<title>Profil Pengguna &minus; Sistem Informasi Inventaris Barang dan Aset Desa</title>
@extends('layouts.app-layout')

@section('content')
<div class="row page-titles mx-0">
    <div class="col p-md-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Profil</a></li>
            <li class="breadcrumb-item active"><a href="/profil">Profil Pengguna</a></li>
        </ol>
    </div>
</div>
<!-- row -->

<div class="container-fluid">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Profil Pengguna</h4>
                <div class="basic-form">
                    <form action="{{ route('editprofil', ['id' => Auth::user()->id]) }}" method="POST">
                        @csrf
                        @foreach ($user as $u)
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Nama</label>
                                <input type="text" class="form-control" value="{{$u -> name }}" name="name">
                            </div>
                            <div class="form-group col-md-6">
                                <label>NIP / NIPD / NIKD</label>
                                <input type="number" class="form-control" value="{{$u -> nip }}" name="nip">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Alamat</label>
                            <input type="text" class="form-control" value="{{$u -> alamat }}" name="alamat">
                        </div>
                        <div class="form-group">
                            <label>Alamat Email</label>
                            <input type="email" class="form-control" value="{{$u -> email }}" name="email">
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="current_password">Kata Sandi Saat Ini</label>
                                <input type="password" id="password" name="password" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="new_password">Kata Sandi Baru</label>
                                <input type="password" id="new_password" name="new_password" class="form-control">
                            </div>
                        </div>
                        @endforeach
                        <button type="submit" class="btn btn-dark">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- #/ container -->
@endsection