<!DOCTYPE html>
<html>

<head>
    <title>Laporan Barang Rusak Terverifikasi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
        .kop-surat {
            margin-bottom: 30px;
            text-align: center;
            font-family: Arial, sans-serif;
            border-bottom: 3px solid #000;
            padding-bottom: 10px;
        }

        .logo {
            float: left;
            margin-right: 20px;
        }

        .logo img {
            width: 80px;
        }

        .pemkab-name {
            margin: 2;
            font-size: 18px;
            font-weight: bold;
        }

        .desa-name {
            margin: 4;
            font-size: 22px;
            font-weight: bold;
        }

        .desa-address {
            margin: 0;
            font-size: 14px;
        }
    </style>
</head>

<body>
<div class="kop-surat">
        <div class="logo">
        <img src="images/cilacap.png">
        </div>
        <div class="desa-info">
            <h1 class="pemkab-name">PEMERINTAH KABUPATEN CILACAP</h1>
            <h1 class="pemkab-name">KECAMATAN KROYA</h1>
            <h1 class="desa-name">DESA KEDAWUNG</h1>
            <p class="desa-address">Jl. Jend. A. Yani Desa Kedawung, Kecamatan Kroya, Kabupaten Cilacap, Jawa Tengah 53282</p>
        </div>
    </div>
    <h2 style="justify-content: center; text-align: center">REKAP PELAPORAN BARANG RUSAK</h2>
    <h2 style="justify-content: center; text-align: center">{{ strtoupper(\Carbon\Carbon::now()->translatedFormat('M')) }} {{ \Carbon\Carbon::now()->translatedFormat('Y') }}</h2>
    <table>
        <thead>
            <tr>
                <th style="border: 1px solid #000; background-color: white; text-align: center;">NO</th>
                <th style="border: 1px solid #000; background-color: white; text-align: center;">NAMA LAPORAN</th>
                <th style="border: 1px solid #000; background-color: white; text-align: center;">TANGGAL LAPORAN</th>
                <th style="border: 1px solid #000; background-color: white; text-align: center;">STATUS</th>
                <th style="border: 1px solid #000; background-color: white; text-align: center;">KETERANGAN</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($verifikasi as $b)
            <tr>
                <td style="border: 1px solid #000; text-align: center;">{{ $loop->iteration }}</td>
                <td style="border: 1px solid #000;">{{ $b->nama_laporan }}</td>
                <td style="border: 1px solid #000; text-align: center;">{{ \Carbon\Carbon::parse($b->tanggal_dilaporkan)->locale('id')->translatedFormat('d/m/Y') }}</td>
                <td style="border: 1px solid #000;">@if($b->status == 0)
                    Ditolak
                    @elseif($b->status == 1)
                    Menunggu Verifikasi Sekretaris Desa
                    @elseif($b->status == 2)
                    Menunggu Persetujuan Kepala Desa
                    @else
                    Disetujui
                    @endif</td>
                    <td style="border: 1px solid #000;">{{ $b->keterangan }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>