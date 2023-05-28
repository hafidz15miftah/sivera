<title>Detail Barang dan Laporan &minus; Sistem Informasi Inventaris Barang dan Aset Desa</title>
@extends('layouts.app-layout')

@section('content')
<div class="row page-titles mx-0">
    <div class="col p-md-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Fungsional Sistem</a></li>
            <li class="breadcrumb-item"><a href="#">Aset Barang</a></li>
            <li class="breadcrumb-item active"><a href="/barang">Detail Barang dan Laporan</a></li>
        </ol>
    </div>
</div>
<!-- row -->

<!-- Modal Download-->
<div class="modal fade" id="downloadModal" tabindex="-1" role="dialog" aria-labelledby="downloadModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="downloadModalLabel">Cetak Laporan Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="downloadForm" method="GET" action="{{ route('cetak_semua_laporan') }}">
                    @csrf
                    <div class="form-group">
                        <label for="downloadOption">Pilih Opsi:</label>
                        <select class="form-control" id="downloadOption" name="download_option">
                            <option value="all">Semua Data</option>
                            <option value="by_barang">Berdasarkan Barang</option>
                            <option value="by_ruang">Berdasarkan Ruang</option>
                            <option value="by_month">Berdasarkan Tanggal Perolehan</option>
                        </select>
                    </div>
                    <div id="barangForm" style="display: none;">
                        <div class="form-group">
                            <label for="downloadOptions">Pilih Barang:</label>
                            <select class="form-control" id="downloadOption" name="selected_barang">
                                <option value="">Silahkan Pilih ...</option>
                                @foreach ($barang as $b)
                                <option value="{{ $b->id }}">{{ $b->nama_barang }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div id="ruangForm" style="display: none;">
                        <div class="form-group">
                            <label for="selectedMonthe">Pilih Ruang:</label>
                            <select class="form-control" id="downloadOption" name="selected_ruang">
                                <option value="">Silahkan Pilih ...</option>
                                @foreach ($ruang as $r)
                                <option value="{{ $r->id }}">{{ $r->nama_ruang }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div id="monthForm" style="display: none;">
                        <div class="form-group">
                            <label for="selectedMonth">Pilih Tanggal Perolehan:</label>
                            <input type="date" class="form-control" id="selectedMonth" name="selected_date">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Cetak Data</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Berita Acara-->
<div class="modal fade" id="BeritaAcaraModal" tabindex="-1" role="dialog" aria-labelledby="downloadModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="downloadModalLabel">Cetak Berita Acara</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="BeritaAcara" method="POST" action="{{ route('cetak_berita_acara') }}">
                    @csrf
                    <div id="">
                        <div class="form-group">
                            <label for="">Pilih ID Barang:</label>
                            <select class="form-control" id="downloadOption" name="barang_dipilih">
                                <option value="">Silahkan Pilih ...</option>
                                @foreach ($info as $i)
                                <option value="{{ $i->id }}">{{ $i->kode_detail }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Cetak</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Barang -->
<div class="modal fade" id="tambah-laporan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Detail Data Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @csrf
                <form id="add_barang">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="nama_barang">Kode Barang</label>
                                <select class="form-control" id="info_id" name="info_id" require>
                                    <option value="">Silahkan Pilih ...</option>
                                    @foreach ($info as $i)
                                    <option value="{{ $i->id }}">{{ $i->kode_detail }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="tgl_perolehan">Tanggal Perolehan</label>
                                <input class="form-control" type="date" name="tgl_perolehan" id="tgl_perolehan">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="sumber">Sumber</label>
                                <select class="form-control" id="sumber" name="sumber" require>
                                    <option value="" selected disabled>Silahkan Pilih ...</option>
                                    <option value="Anggaran Dana Desa">Anggaran Dana Desa</option>
                                    <option value="Hibah">Hibah</option>
                                    <option value="Lainnya">Lainnya</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="merk">Merk</label>
                                <input type="text" class="form-control" name="merk" id="merk">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="harga">Harga (Rp)</label>
                                <input class="form-control" type="number" min="0" placeholder="0" name="harga" id="harga">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="keterangan">Keterangan</label>
                                <textarea class="form-control" name="keterangan" id="keterangan"></textarea>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-success text-white" id="simpanLaporan">Simpan</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit Barang -->
<div class="modal fade" id="edit-laporan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Detail Data Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="id">
                @csrf
                <form id="edit_barang">
                <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="nama_barang">Kode Barang</label>
                                <select class="form-control" id="info_id" name="info_id" require disabled>
                                    <option value="">Silahkan Pilih ...</option>
                                    @foreach ($info as $i)
                                    <option value="{{ $i->id }}">{{ $i->kode_detail }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="tgl_perolehan">Tanggal Perolehan</label>
                                <input class="form-control" type="date" name="tgl_perolehan" id="tgl_perolehan">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="sumber">Sumber</label>
                                <select class="form-control" id="sumber" name="sumber" require>
                                    <option value="" selected disabled>Silahkan Pilih ...</option>
                                    <option value="Anggaran Dana Desa">Anggaran Dana Desa</option>
                                    <option value="Hibah">Hibah</option>
                                    <option value="Lainnya">Lainnya</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="merk">Merk</label>
                                <input type="text" class="form-control" name="merk" id="merk">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="harga">Harga (Rp)</label>
                                <input class="form-control" type="number" min="0" placeholder="0" name="harga" id="harga">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="keterangan">Keterangan</label>
                                <textarea class="form-control" name="keterangan" id="keterangan"></textarea>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-success text-white" id="updatedetail">Update</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Lihat Laporan Data Barang -->
<div class="modal fade" id="lihat-laporanbar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Lihat Detail Data Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
            </div>
            <div class="modal-body">
                <p><strong>Kode Barang:</strong> <span id="kode_detail"></span></p>
                <p><strong>Nama Barang:</strong> <span id="nama_barang"></span></p>
                <p><strong>Merk:</strong> <span id="merk"></span></p>
                <p><strong>Kondisi:</strong> <span id="kondisi"></span></p>
                <p><strong>Ruang:</strong> <span id="ruang_id"></span></p>
                <p><strong>Sumber:</strong> <span id="sumber"></span></p>
                <p><strong>Tanggal Perolehan:</strong> <span id="tgl_perolehan"></span></p>
                <p><strong>Harga (Rp):</strong> <span id="harga"></span></p>
                <p><strong>Keterangan:</strong> <span id="keterangan"></span></p>
                <p><strong>Ditambahkan:</strong> <span id="created_at"></span></p>
                <p><strong>Terakhir Diubah:</strong> <span id="updated_at"></span></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary text-white" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Detail Barang dan Laporan</h4>
                    <button type="button" class="btn btn-primary" style="color:white" data-toggle="modal" data-target="#tambah-laporan"><i class="fa fa-plus"></i> Tambah Detail Barang</button>
                    <button class="btn btn-warning" style="color:white" data-toggle="modal" data-target="#downloadModal"><i class="fa fa-print"></i> Cetak Laporan Barang</button>
                    <button class="btn btn-danger" style="color:white" data-toggle="modal" data-target="#BeritaAcaraModal"><i class="fa fa-print"></i> Cetak Berita Acara</button>
                    <div class="table-responsive">
                        <table id="tabel-laporan" class="table table-striped table-bordered zero-configuration">
                            <thead>
                                <tr>
                                    <th class="text-center">ID Barang</th>
                                    <th class="text-center">Nama Barang</th>
                                    <th class="text-center">Ruang</th>
                                    <th class="text-center">Tanggal Perolehan</th>
                                    <th class="text-center">Sumber</th>
                                    <th class="text-center">Aksi</th>
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
<!-- #/ container -->
@endsection