<title>Ubah Kata Sandi &minus; Sistem Informasi Inventaris Barang dan Aset Desa</title>
@extends('layouts.app-layout')

@section('content')
<div class="row page-titles mx-0">
    <div class="col p-md-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Profil</a></li>
            <li class="breadcrumb-item active"><a href="/ubahpassword">Ubah Kata Sandi</a></li>
        </ol>
    </div>
</div>
<!-- row -->

<div class="container-fluid">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Ubah Kata Sandi</h4>
                <div class="basic-form">
                    <form action="/ubah-kata-sandi" method="POST">
                        @csrf
                        
                        <div class="form-group">
                            <label for="current_password">Kata Sandi Saat Ini</label>
                            <input type="password" id="current_password" name="current_password" class="form-control">
                        </div>
                        
                        <div class="form-group">
                            <label for="new_password">Kata Sandi Baru</label>
                            <input type="password" id="new_password" name="new_password" class="form-control">
                        </div>
                        
                        <div class="form-group">
                            <label for="confirm_password">Konfirmasi Kata Sandi Baru</label>
                            <input type="password" id="confirm_password" name="confirm_password" class="form-control">
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Ubah Kata Sandi</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- #/ container -->
@endsection