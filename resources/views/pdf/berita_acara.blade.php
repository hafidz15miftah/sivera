<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Berita Acara</title>
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

        .ttd {
            text-align: right;
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
            <p class="desa-address">Jl. Jend. A. Yani No. 11 Desa Kedawung, Kec. Kroya Telepon (0282) 494397 Kode Pos 53282</p>
        </div>
    </div>
    <h2 style="text-align: center; font-family: Arial, sans-serif">BERITA ACARA BARANG RUSAK</h2>
    <p style="text-indent: 30px; font-size: 14px; font-family: Arial, sans-serif">
        Pada hari ini {{ Carbon\Carbon::now()->locale('id')->translatedFormat('l') }},
        tanggal {{ Carbon\Carbon::now()->locale('id')->translatedFormat('d M Y') }} telah dilaksanakan inventarisasi ulang atas aset/barang yang ada di Pemerintah Desa Kedawung, Kecamatan Kroya, Kabupaten Cilacap, Provinsi Jawa Tengah. Adapun hasil inventarisasi mengenai keberadaan barang di bawah ini diyakini RUSAK:
    </p>

    <br>
    <table>
        <thead>
            <tr>
                <th style="border: 1px solid #000; background-color: white; text-align: center;">NO</th>
                <th style="border: 1px solid #000; background-color: white; text-align: center;">NAMA BARANG</th>
                <th style="border: 1px solid #000; background-color: white; text-align: center;">MERK</th>
                <th style="border: 1px solid #000; background-color: white; text-align: center;">ID BARANG</th>
                <th style="border: 1px solid #000; background-color: white; text-align: center; width: 60px;">PEROLEHAN</th>
                <th style="border: 1px solid #000; background-color: white; text-align: center;">RUANGAN</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($berita as $b)
            <tr>
                <td style="border: 1px solid #000; text-align: center;">{{ $loop->iteration }}</td>
                <td style="border: 1px solid #000; padding-left: 10px;">{{ $b->nama_barang }}</td>
                <td style="border: 1px solid #000; text-align: center;">{{ $b->merk }}</td>
                <td style="border: 1px solid #000; text-align: center;">{{ $b->kode_detail }}</td>
                <td style="border: 1px solid #000; text-align: center; width: 60px;">{{ \Carbon\Carbon::parse($b->tgl_perolehan)->locale('id')->translatedFormat('Y') }}</td>
                <td style="border: 1px solid #000; text-align: center;">{{ $b->nama_ruang }}</td>
            </tr>
            @endforeach
            <tr>
                <td colspan="6" style="border: none" class="ttd"></td>
            </tr>
            <tr>
                <td colspan="6" style="border: none" class="ttd"></td>
            </tr>
            <tr>
                <td colspan="4" style="border: none; text-align: center" class="ttd"></td>
                <td colspan="2" style="border: none; text-align: center" class="ttd">Kepala Urusan Umum dan Perencanaan</td>
            </tr>
            <tr>
                <td colspan="4" style="border: none" class="ttd"></td>
            </tr>
            <tr>
                <td colspan="4" style="border: none; text-align: center" class="ttd"></td>
                <td colspan="2" style="border: none; text-align: center; text-decoration: underline" class="ttd"><strong>{{ Auth::user()->name }}</strong></td>
            </tr>
        </tbody>
    </table>
</body>

</html>