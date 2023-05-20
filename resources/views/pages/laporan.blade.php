<title>Daftar Laporan &minus; Sistem Informasi Inventaris Barang dan Aset Desa</title>
@extends('layouts.app-layout')

@section('content')
    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Fungsional Sistem</a></li>
                <li class="breadcrumb-item"><a href="#">Tabel</a></li>
                <li class="breadcrumb-item active"><a href="/aset">Daftar Laporan</a></li>
            </ol>
        </div>
    </div>
    <!-- row -->

    <!-- Modal -->
    <div class="modal fade" id="downloadModal" tabindex="-1" role="dialog" aria-labelledby="downloadModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="downloadModalLabel">Pilihan Download</h5>
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
                                <option value="by_month">Berdasarkan Tanggal Pembelian</option>
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
                                <label for="selectedMonth">Pilih Tanggal Pembelian:</label>
                                <input type="date" class="form-control" id="selectedMonth" name="selected_date">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Download</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Barang -->
    <div class="modal fade" id="tambah-laporan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Laporan Data Barang</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @csrf
                    <form id="add_barang">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="nama_barang">Nama Barang</label>
                                    <select class="form-control" id="barang_id" name="barang_id" require>
                                        <option value="">Silahkan Pilih ...</option>
                                        @foreach ($barang as $r)
                                            <option value="{{ $r->id }}">{{ $r->nama_barang }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="tgl_pembelian">Tanggal Pembelian</label>
                                    <input class="form-control" type="date" name="tgl_pembelian" id="tgl_pembelian">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="sumber_dana">Sumber Dana</label>
                                    <select class="form-control" id="sumber_dana" name="sumber_dana" require>
                                        <option value="" selected disabled>Silahkan Pilih ...</option>
                                        <option value="Anggaran Dana Desa">Anggaran Dana Desa</option>
                                        <option value="Hibah">Hibah</option>
                                        <option value="Lainnya">Lainnya</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="baik">Baik</label>
                                    <input class="form-control" type="number" min="0" placeholder="0"
                                        name="baik" id="baik">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="rusak_ringan">Rusak Ringan</label>
                                    <input class="form-control" type="number" min="0" placeholder="0"
                                        name="rusak_ringan" id="rusak_ringan">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="rusak_berat">Rusak Berat</label>
                                    <input class="form-control" type="number" min="0" placeholder="0"
                                        name="rusak_berat" id="rusak_berat">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="keterangan">Keterangan</label>
                                    <textarea class="form-control" name="keterangan" id="keterangan"></textarea>
                                </div>
                            </div>
                            {{-- <div class="col-md-4">
                                <div class="form-group">
                                    <label for="rusak_berat">Foto</label>
                                    <input class="form-control" type="file" min="0" placeholder="0"
                                        value="{{ old('rusak_berat') }}">
                                </div>
                            </div> --}}
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

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Daftar Laporan</h4>
                        <button type="button" class="btn btn-primary" data-toggle="modal"
                            data-target="#tambah-laporan"><i class="fa fa-plus"></i> Tambah Laporan</button>
                        <button class="btn btn-success" style="color:white" data-toggle="modal"
                            data-target="#downloadModal"><i class="fa fa-print"></i> Cetak Laporan Barang</button>
                        <div class="table-responsive">
                            <table id="tabel-laporan" class="table table-striped table-bordered zero-configuration">
                                <thead>
                                    <tr>
                                        <th>Kode Barang</th>
                                        <th>Nama Barang</th>
                                        <th>Ruang</th>
                                        <th>Sumber Dana</th>
                                        <th>Kondisi Baik</th>
                                        <th>Kondisi Rusak Ringan</th>
                                        <th>Kondisi Rusak Berat</th>
                                        <th>Jumlah</th>
                                        <th>keterangan</th>
                                        <th>Aksi</th>
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
