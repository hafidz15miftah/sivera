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
                        <h2 class="text-white">@if($bbaik)
                            {{ $bbaik }}
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
                        <h2 class="text-white">@if($bruring)
                            {{ $bruring }}
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
                        <h2 class="text-white">@if($bruber)
                            {{ $bruber }}
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
                        <h2 class="text-white">@if($bbarang)
                            {{ $bbarang }}
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
        <div class="col-lg-6 col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title text-center">Grafik Kondisi Aset Jalan</h4>
                    <canvas id="chartJalan"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-sm-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title text-center">Grafik Kondisi Aset Kendaraan</h4>
                    <canvas id="chartKendaraan"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title text-center">Grafik Jumlah Laporan Barang Bulanan</h4>
                    <canvas id="chartLaporan"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ChartJS Pie Barang -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var ctx = document.getElementById('chartBarang').getContext('2d');
        var totalBaik = '{{ $bbaik }}';
        var totalRuring = '{{ $bruring }}';
        var totalRuber = '{{ $bruber }}';

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

<!-- ChartJS Pie - Aset Jalan -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var ctx = document.getElementById('chartJalan').getContext('2d');
        var jlBaik = '{{ $jlBaik }}';
        var jlRR = '{{ $jlRR }}';
        var jlRB = '{{ $jlRB }}';

        var data = {
            labels: ['Baik', 'Rusak Ringan', 'Rusak Berat'],
            datasets: [{
                data: [jlBaik, jlRR, jlRB],
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

<!-- ChartJS Pie - Aset Kendaraan -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var ctx = document.getElementById('chartKendaraan').getContext('2d');
        var kBaik = '{{ $kBaik }}';
        var kRR = '{{ $kRR }}';
        var kRB = '{{ $kRB }}';

        var data = {
            labels: ['Baik', 'Rusak Ringan', 'Rusak Berat'],
            datasets: [{
                data: [kBaik, kRR, kRB],
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

<!-- ChartJS Bar - Laporan -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Data untuk chart
        var data = {
            labels: <?php echo json_encode($labels); ?>,
            datasets: [{
                label: 'Jumlah Laporan',
                data: <?php echo json_encode($dataLaporan); ?>,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.5)',
                    'rgba(54, 162, 235, 0.5)',
                    'rgba(255, 206, 86, 0.5)',
                    'rgba(75, 192, 192, 0.5)',
                    'rgba(153, 102, 255, 0.5)',
                    'rgba(255, 159, 64, 0.5)',
                    'rgba(255, 99, 132, 0.5)',
                    'rgba(54, 162, 235, 0.5)',
                    'rgba(255, 206, 86, 0.5)',
                    'rgba(75, 192, 192, 0.5)',
                    'rgba(153, 102, 255, 0.5)',
                    'rgba(255, 159, 64, 0.5)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)',
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        };

        // Konfigurasi chart
        var options = {
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 0.5
                    }
                }
            },
        };

        // Membuat bar chart
        var ctx = document.getElementById('chartLaporan').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: data,
            options: options
        });
    });
</script>
@endsection