<title>Detail Kondisi Barang &minus; Sistem Informasi Inventaris Barang dan Aset Desa</title>
@extends('layouts.app-layout')

@section('content')

<div class="row page-titles mx-0">
    <div class="col p-md-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Fungsional Sistem</a></li>
            <li class="breadcrumb-item"><a href="#">Aset Barang</a></li>
            <li class="breadcrumb-item active"><a href="/kondisibarang">Detail Kondisi</a></li>
        </ol>
    </div>
</div>
<!-- row -->

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Detail Kondisi Barang</h4>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambah-kondisi"><i class="fa fa-plus"></i> Tambah Kondisi</button>
                    <a class="btn btn-warning" style="color:white" href="{{url('barang/cetak/stiker')}}"><i class="fa fa-print"></i> Cetak Stiker</a>
                    <div class="table-responsive">
                        <table id="tabel-kondisi" class="table table-striped table-bordered zero-configuration">
                            <thead>
                                <tr>
                                    <th width="25%" class="text-center">Nama Barang</th>
                                    <th width="20%" class="text-center">ID Barang</th>
                                    <th width="25%" class="text-center">Ruang</th>
                                    <th width="10%" class="text-center">Kondisi</th>
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

<!-- Modal Tambah Barang -->
<div class="modal fade" id="tambah-kondisi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Detail Kondisi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @csrf
                <form id="add_kondisi">
                    <div class="form-row">
                        <label for="barang_id" class="col-form-label">Nama Barang:</label>
                        <select class="form-control" name="barang_id" id="barang_id" required>
                            <option value="">Silahkan Pilih ...</option>
                            @foreach ($barang as $index => $b)
                            <option value="{{ $b->id }}" data-ruang-nama="{{ $ruang[$index]->nama_ruang }}">{{ $b->nama_barang }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-row">
                        <label for="kode_detail" class="col-form-label">ID Barang:</label>
                        <input type="text" class="form-control" name="kode_detail" id="kode_detail">
                    </div>
                    <div class="form-row">
                        <label for="kondisi" class="col-form-label">Kondisi:</label>
                        <select class="form-control" name="kondisi" id="kondisi" required>
                            <option value="">Silahkan Pilih ...</option>
                            <option value="1">Baik</option>
                            <option value="2">Rusak Ringan</option>
                            <option value="3">Rusak Berat</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                <button autofocus type="button" class="btn btn-success text-white" id="simpankondisi">Simpan</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="edit-kondisi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ubah Detail Kondisi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <input type="hidden" id="id">
                @csrf
                <form id="add_kondisi">
                    <div class="form-row">
                        <label for="barang_id" class="col-form-label">Nama Barang:</label>
                        <select class="form-control" name="barang_id" id="barang_id" required disabled>
                            <option value="">Silahkan Pilih ...</option>
                            @foreach ($barang as $b)
                            <option value="{{ $b->id }}">{{ $b->nama_barang }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-row">
                        <label for="kode_detail" class="col-form-label">ID Barang:</label>
                        <input type="text" class="form-control" name="kode_detail" id="kode_detail" disabled>
                    </div>
                    <div class="form-row">
                        <label for="kondisi" class="col-form-label">Kondisi:</label>
                        <select class="form-control" name="kondisi" id="kondisi" required>
                            <option value="">Silahkan Pilih ...</option>
                            <option value="1">Baik</option>
                            <option value="2">Rusak Ringan</option>
                            <option value="3">Rusak Berat</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                <button autofocus type="button" class="btn btn-success text-white" id="updatekondisi">Update</button>
            </div>
        </div>
    </div>
</div>

<!-- Menampilkan Kode Barang -->
<script>
    document.getElementById('barang_id').addEventListener('change', function() {
        var selectElement = this;
        var selectedIndex = selectElement.selectedIndex;

        var kode_barang = '';
        var nomor = selectedIndex;

        $.ajax({
        url: 'get-jumlah-info',
        method: 'GET',
        headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
        success: function(response) {
            var count = response;
            console.log("Number of barang: " + count);
            
            if (selectedIndex !== 0) {
            var option = selectElement.options[selectedIndex];
            var kode_barang = "{!! addslashes(json_encode($barang->pluck('kode_barang')->toArray())) !!}";
            

            if (selectedIndex !== -1) {
                var kode_barang = JSON.parse(kode_barang)[selectedIndex - 1];
                var kode_detail = kode_barang + '-' + count;
                document.getElementById('kode_detail').value = kode_detail;
            }
        } else {
            document.getElementById('kode_detail').value = '';
        }
        },
        error: function(xhr, status, error) {
            console.error(error);
        }
        });

    });
</script>

<!-- Menampilkan Ruangan -->
@endsection