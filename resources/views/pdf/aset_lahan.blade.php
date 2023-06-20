<!DOCTYPE html>
<html>

<head>
    <title>Data Aset Tanah / Lahan Desa</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
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
            <p class="desa-address">Jl. Jend. A. Yani RT 03 RW 08 Kedawung, Kec. Kroya Telepon (0282) 494397 Kode Pos 53282</p>
        </div>
    </div>
    <h2 style="justify-content: center; text-align: center">DAFTAR ASET TANAH / LAHAN</h2>
    <h2 style="justify-content: center; text-align: center">TAHUN {{ \Carbon\Carbon::now()->translatedFormat('Y') }}</h2>
    <table>
        <thead>
            <tr>
                <th style="border: 1px solid #000; background-color: white; text-align: center;">NO</th>
                <th style="border: 1px solid #000; background-color: white; text-align: center;">NAMA OBYEK</th>
                <th style="border: 1px solid #000; background-color: white; text-align: center;">ALAMAT</th>
                <th style="border: 1px solid #000; background-color: white; text-align: center;">NO SERTIFIKAT</th>
                <th style="border: 1px solid #000; background-color: white; text-align: center;">LUAS (m<sup>2</sup>)</th>
                <th style="border: 1px solid #000; background-color: white; text-align: center;">KONDISI</th>
                <th style="border: 1px solid #000; background-color: white; text-align: center;">KETERANGAN</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($lahan as $l)
            <tr>
                <td style="border: 1px solid #000;">{{ $loop->iteration }}</td>
                <td style="border: 1px solid #000;  width: 30%;">{{ $l->nama_obyek }}</td>
                <td style="border: 1px solid #000;">{{ $l->alamat }}</td>
                <td style="border: 1px solid #000;">{{ $l->no_sertifikat }}</td>
                <td style="border: 1px solid #000;">{{ $l->luas }}</td>
                <td style="border: 1px solid #000; text-align: center"">
                @if($l->kondisi == 1)
                Baik
                @elseif($l->kondisi == 2)
                Rusak Ringan
                @else
                Rusak Berat
                @endif
                </td>
                <td style=" border: 1px solid #000;">{{ $l->keterangan }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>