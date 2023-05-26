<title>Beranda &minus; Sistem Informasi Inventaris Barang dan Aset Desa</title>
@extends('layouts.app-layout')

@section('content')

<div class="container-fluid mt-3">
    <div class="row">
        <div class="col-lg-3 col-sm-6">
            <div class="card bg-success">
                <div class="card-body">
                    <h3 class="card-title text-white">Baik</h3>
                    <div class="d-inline-block">
                        <h2 class="text-white">@if($totalBaik)
                            {{ $totalBaik }}
                            @else
                            0
                            @endif
                        </h2>
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
                        <h2 class="text-white">@if($totalRuring)
                            {{ $totalRuring }}
                            @else
                            0
                            @endif
                        </h2>
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
                        <h2 class="text-white">@if($totalRuber)
                            {{ $totalRuber }}
                            @else
                            0
                            @endif
                        </h2>
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
                        <h2 class="text-white">@if($jumlah)
                            {{ $jumlah }}
                            @else
                            0
                            @endif
                        </h2>
                    </div>
                    <span class="float-right display-5 opacity-5 text-white"><i class="fa fa-pie-chart"></i></span>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6 col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title text-center">Grafik Kondisi Barang</h4>
                    <canvas id="chartBarang"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-sm-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title text-center">Grafik Kondisi Aset Tanah / Lahan</h4>
                    <canvas id="chartLahan"></canvas>
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

<!-- ChartJS Pie Barang -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var ctx = document.getElementById('chartBarang').getContext('2d');
        var totalBaik = '{{ $totalBaik }}';
        var totalRuring = '{{ $totalRuring }}';
        var totalRuber = '{{ $totalRuber }}';

        var data = {
            labels: ['Baik', 'Rusak Ringan', 'Rusak Berat'],
            datasets: [{
                data: [totalBaik, totalRuring, totalRuber],
                backgroundColor: [
                    '#6fd96f',
                    '#f29d56',
                    '#FF5E5E',
                ],
            }],
        };

        var options = {
            responsive: true,
            plugins: {
                labels: {
                    render: 'percentage',
                    fontColor: ['white', 'white', 'white'],
                    precision: 2
                }
            }
        };

        new Chart(ctx, {
            type: 'pie',
            data: data,
            options: options
        });
    });
</script>

<!-- ChartJS Pie - Aset Tanah -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var ctx = document.getElementById('chartLahan').getContext('2d');
        var tbaik = '{{ $tbaik }}';
        var truring = '{{ $truring }}';
        var truber = '{{ $truber }}';

        var data = {
            labels: ['Baik', 'Rusak Ringan', 'Rusak Berat'],
            datasets: [{
                data: [tbaik, truring, truber],
                backgroundColor: [
                    '#6fd96f',
                    '#f29d56',
                    '#FF5E5E',
                ],
            }],
        };

        var options = {
            responsive: true,
            plugins: {
                labels: {
                    render: 'percentage',
                    fontColor: ['white', 'white', 'white'],
                    precision: 2
                }
            }
        };

        new Chart(ctx, {
            type: 'pie',
            data: data,
            options: options
        });
    });
</script>
@endsection