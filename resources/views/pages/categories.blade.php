<title>Kategori Aset &minus; Sistem Informasi Inventaris Barang dan Aset Desa</title>
@extends('layouts.app-layout')

@section('content')

<div class="row page-titles mx-0">
    <div class="col p-md-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Fungsional Sistem</a></li>
            <li class="breadcrumb-item active"><a href="/kategori">Kategori</a></li>
        </ol>
    </div>
</div>
<!-- row -->

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Kategori Aset</h4>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambah-barang"><i class="fa fa-plus"></i> Tambah Barang</button>
                    <div class="table-responsive">
                        <table id="tabel-kategori" class="table table-striped table-bordered zero-configuration">
                            <thead>
                                <tr>
                                    <th width="25%" class="text-center">Nama Kategori</th>
                                    <th width="20%" class="text-center">Kode Kategori</th>
                                    <th width="30%" class="text-center">Aksi</th>
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

<script type="text/javascript">
    $(document).ready(function() {
        // Your code here
        //Tabel Barang
        $('#tabel-kategori').DataTable({
            processing: true,
            serverSide: true,
            destroy: true,
            columns: [{
                    data: 'nama_kategori',
                    name: 'nama_kategori'
                },
                {
                    data: 'kode_kategori',
                    name: 'kode_kategori'
                },
                {
                    data: 'aksi',
                    name: 'aksi',
                    orderable: false,
                    searchable: false
                },
            ],
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/id.json',
            }
        });
    });
</script>
@endsection