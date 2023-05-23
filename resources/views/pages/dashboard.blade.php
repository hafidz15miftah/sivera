<title>Dasbor &minus; Sistem Informasi Inventaris Barang dan Aset Desa</title>
@extends('layouts.app-layout')

@section('content')

<div class="container-fluid mt-3">
    @if(auth()->user()->role_id == 2)
    <div class="row">
        <div class="col-lg-3 col-sm-6">
            <div class="card bg-success">
                <div class="card-body">
                    <h3 class="card-title text-white">Disetujui</h3>
                    <div class="d-inline-block">
                        <h2 class="text-white">{{ $disetujui }}</h2>
                    </div>
                    <span class="float-right display-5 opacity-5 text-white"><i class="fa fa-check-circle"></i></span>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
            <div class="card bg-warning">
                <div class="card-body">
                    <h3 class="card-title text-white">Dalam Peninjauan</h3>
                    <div class="d-inline-block">
                        <h2 class="text-white">{{ $ditinjau }}</h2>
                    </div>
                    <span class="float-right display-5 opacity-5 text-white"><i class="fa fa-warning"></i></span>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
            <div class="card bg-danger">
                <div class="card-body">
                    <h3 class="card-title text-white">Ditolak</h3>
                    <div class="d-inline-block">
                        <h2 class="text-white">{{ $ditolak }}</h2>
                    </div>
                    <span class="float-right display-5 opacity-5 text-white"><i class="fa fa-times-circle"></i></span>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
            <div class="card bg-primary">
                <div class="card-body">
                    <h3 class="card-title text-white">Jumlah Laporan</h3>
                    <div class="d-inline-block">
                        <h2 class="text-white">{{ $jumlahlaporan }}</h2>
                    </div>
                    <span class="float-right display-5 opacity-5 text-white"><i class="fa fa-pie-chart"></i></span>
                </div>
            </div>
        </div>
    </div>
    @endif
    @if(auth()->user()->role_id == 1) || if(auth()->user()->role_id == 3 )
    <div class="row">
        <div class="col-lg-3 col-sm-6">
            <div class="card bg-success">
                <div class="card-body">
                    <h3 class="card-title text-white">Baik</h3>
                    <div class="d-inline-block">
                        <h2 class="text-white">{{ $totalBaik }}</h2>
                    </div>
                    <span class="float-right display-5 opacity-5 text-white"><i class="fa fa-check-circle"></i></span>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
            <div class="card bg-warning">
                <div class="card-body">
                    <h3 class="card-title text-white">Rusak Ringan</h3>
                    <div class="d-inline-block">
                        <h2 class="text-white">{{ $totalRuring }}</h2>
                    </div>
                    <span class="float-right display-5 opacity-5 text-white"><i class="fa fa-warning"></i></span>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
            <div class="card bg-danger">
                <div class="card-body">
                    <h3 class="card-title text-white">Rusak Berat</h3>
                    <div class="d-inline-block">
                        <h2 class="text-white">{{ $totalRuber }}</h2>
                    </div>
                    <span class="float-right display-5 opacity-5 text-white"><i class="fa fa-times-circle"></i></span>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
            <div class="card bg-primary">
                <div class="card-body">
                    <h3 class="card-title text-white">Jumlah</h3>
                    <div class="d-inline-block">
                        <h2 class="text-white">{{ $jumlah }}</h2>
                    </div>
                    <span class="float-right display-5 opacity-5 text-white"><i class="fa fa-pie-chart"></i></span>
                </div>
            </div>
        </div>
    </div>
    @endif

    <div class="row">
        <div class="col-lg-6 col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title text-center">Grafik Kondisi Aset</h4>
                    <div id="pie-chart2" class="ct-chart ct-golden-section"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-sm-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title text-center">Grafik Kondisi Aset</h4>
                    <div id="pie-chart2" class="ct-chart ct-golden-section"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title text-center">Informasi Laporan Terkini</h4>
                    <div class="active-member">
                        <div class="table-responsive">
                            <table class="table table-xs mb-0">
                                <thead>
                                    <tr>
                                        <th>Nama Laporan</th>
                                        <th>Tanggal Dilaporkan</th>
                                        <th>Status</th>
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
</div>
@endsection