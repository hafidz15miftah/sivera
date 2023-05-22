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
    </style>
</head>
<body>
    <h2 style="justify-content: center; text-align: center; font-family: 'Times New Roman', Times, serif;">BERITA ACARA BARANG RUSAK</h2>
    <P style="text-indent: 30px; font-size: 14px; font-family: 'Times New Roman', Times, serif;"> Pada hari ini {{ Carbon\Carbon::now()->locale('id')->translatedFormat('l') }}, tanggal {{ Carbon\Carbon::now()->locale('id')->translatedFormat('d M Y') }} telah dilaksanakan
    inventarisasi ulang atas aset/barang yang ada di Pemerintah Desa Kedaung di wilayah Kabupaten Cilacap dan Kecamatan Kroya. Adapun hasil inventarisasi mengenai keberadaan barang di bawah ini diyakini RUSAK :</P>

    <br>
    <table>
        <thead>
            <tr>
                <th style="border: 1px solid #000; background-color: white; text-align: center;">NO</th>
                <th style="border: 1px solid #000; background-color: white; text-align: center;">NAMA BARANG</th>
                <th style="border: 1px solid #000; background-color: white; text-align: center;">KODE BARANG</th>
                <th style="border: 1px solid #000; background-color: white; text-align: center;">TAHUN PEROLEH</th>
                <th style="border: 1px solid #000; background-color: white; text-align: center;">JUMLAH</th>
                <th style="border: 1px solid #000; background-color: white; text-align: center;">RUANGAN</th>
                <th style="border: 1px solid #000; background-color: white; text-align: center;">KETERANGAN</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($berita as $b)
        <tr>
            <td style="border: 1px solid #000; background-color: white;">{{ $loop->iteration }}</td>
            <td style="border: 1px solid #000; background-color: white;">{{ $b->nama_barang }}</td>
            <td style="border: 1px solid #000; background-color: white; text-align: center;">{{ $b->kode_barang }}</td>
            <td style="border: 1px solid #000; background-color: white; text-align: center;">{{ \Carbon\Carbon::parse($b->tgl_pembelian)->locale('id')->translatedFormat('Y') }}</td>
            <td style="border: 1px solid #000; background-color: white; text-align: center;">{{ $rusak_ringan + $rusak_berat }}</td>
            <td style="border: 1px solid #000; background-color: white;">{{ $b->nama_ruang }}</td>
            <td style="border: 1px solid #000; background-color: white;">{{ $b->keterangan }}</td>
        </tr>
        @endforeach
        <tr>
            <td colspan="7" style="border: none" class="ttd"></td>
        </tr>
        <tr>
            <td colspan="7" style="border: none" class="ttd"></td>
        </tr>
        <tr>
            <td colspan="5" style="border: none; text-align: center" class="ttd"></td>
            <td colspan="2" style="border: none; text-align: center" class="ttd">Kepala Urusan Umum dan Perencanaan</td>
        </tr>
        <tr>
            <td colspan="5" style="border: none" class="ttd"></td>
        </tr>
        <tr>
            <td colspan="5" style="border: none; text-align: center" class="ttd"></td>
            <td colspan="2" style="border: none; text-align: center; text-decoration: underline" class="ttd"><strong>{{ Auth::user()->name }}</strong></td>
        </tr>
        </tbody>
    </table>
</body>
</html>
