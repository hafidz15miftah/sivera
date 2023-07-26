<!DOCTYPE html>
<html>

<head>
    <title>Data Aset Jalan Desa</title>
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

        .tanda-tangan {
            margin-top: 30px;
        }

        .tanda-tangan .kanan {
            float: right;
            width: 50%;
            text-align: center;
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
    <h2 style="justify-content: center; text-align: center">DAFTAR ASET JALAN DESA</h2>
    <h2 style="justify-content: center; text-align: center">TAHUN {{ \Carbon\Carbon::now()->translatedFormat('Y') }}</h2>
    <table>
        <thead>
            <tr>
                <th style="border: 1px solid #000; background-color: white; text-align: center;">NO</th>
                <th style="border: 1px solid #000; background-color: white; text-align: center;">NAMA JALAN</th>
                <th style="border: 1px solid #000; background-color: white; text-align: center;">NO DOKUMEN</th>
                <th style="border: 1px solid #000; background-color: white; text-align: center;">PANJANG</th>
                <th style="border: 1px solid #000; background-color: white; text-align: center;">SUMBER</th>
                <th style="border: 1px solid #000; background-color: white; text-align: center;">KONDISI</th>
                <th style="border: 1px solid #000; background-color: white; text-align: center;">KETERANGAN</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($jalan as $j)
            <tr>
                <td style="border: 1px solid #000; width: 5%; text-align: center;">{{ $loop->iteration }}</td>
                <td style="border: 1px solid #000; width: 20%;">{{ $j->nama_jalan }}</td>
                <td style="border: 1px solid #000;">{{ $j->no_dokumen }}</td>
                <td style="border: 1px solid #000; text-align: center">{{ $j->panjang }}</td>
                <td style="border: 1px solid #000; text-align: center">{{ $j->sumber }}</td>
                <td style="border: 1px solid #000; text-align: center">
                @if($j->kondisi == 1)
                Baik
                @elseif($j->kondisi == 2)
                Rusak Ringan
                @else
                Rusak Berat
                @endif
                </td>
                <td style=" border: 1px solid #000;">{{ $j->keterangan }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="tanda-tangan">
        <div class="kanan">
            <p>Mengetahui,</p>
            <p>Kepala Urusan Umum dan Perencanaan</p>
            <br><br><br>
            <p style="text-decoration: underline;"><strong>{{ Auth::user()->name }}</strong></p>
        </div>
    </div>
</body>

</html>