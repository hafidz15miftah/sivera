<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Data Barang</title>
    <style>
        table {
            border-collapse: collapse;
            font-size: 12px; /* ukuran teks dalam tabel */
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
        }
        th {
            background-color: #ffffff00;
            color: black;
        }

        .nama-ruang {
            font-size: 12px;
            text-align: center;
        }

        .cetak-info {
            font-family: Arial, sans-serif;
            position: fixed;
            bottom: 10px;
            left: 10px;
            font-size: 10px;
        }
        .judul {
            font-size: 18px; /* ukuran teks judul */
            text-align: center;
        }
        .tahun {
            font-size: 18px; /* ukuran teks tahun */
            text-align: center;
        }
    </style>
</head>
<body>
    <h2 class="judul">DAFTAR INVENTARIS BARANG</h2>
    <h2 class="tahun">TAHUN 2023</h2>
    <hr>
    <h3 class="nama-ruang">SEMUA RUANGAN</h3>
    <hr>
    <br>
    <table>
        <tr>
            <th rowspan="2" style="text-align: center; width: 5%">NO</th>
            <th rowspan="2" style="width: 270px">NAMA BARANG</th>
            <th rowspan="2" style="width: 100px">TANGGAL PEMBELIAN</th>
            <th rowspan="2" style="text-align: center; width: 100px">KODE BARANG</th>
            <th rowspan="2" style="text-align: center; width: 150px">RUANG</th>
            <th colspan="3" style="text-align: center; width: 15%">KONDISI</th>
            <th rowspan="2" style="text-align: center; width: 75px">JUMLAH BARANG</th>


        </tr>
        <tr>
            <th style="width: 20px">BAIK</th>
            <th style="width: 20px">RUSAK RINGAN</th>
            <th style="width: 20px">RUSAK BERAT</th>
        </tr>

        @foreach ($laporan as $l)
        <tr>
            <td style="text-align: center">{{ $loop->iteration }}</td>
            <td>{{ $l->nama_barang }}</td>
            <td style="text-align: center">{{ \Carbon\Carbon::parse($l->tgl_pembelian)->locale('id')->translatedFormat('d/m/Y') }}</td>
            <td style="text-align: center">{{ $l->kode_barang }}</td>
            <td style="text-align: center">{{ $l->nama_ruang }}</td>
            {{-- kondisi --}}
            <td style="text-align: center">{{ $l->baik }}</td>
            <td style="text-align: center">{{ $l->rusak_ringan }}</td>
            <td style="text-align: center">{{ $l->rusak_berat }}</td>
            {{-- end kondisi  --}}
            <td style="text-align: center">{{ $l->jumlah }}</td>
        </tr>
        @endforeach
    </table>
    <div class="cetak-info">Dicetak oleh Sistem Informasi Inventaris Barang dan Aset Desa - SIVERA pada {{ \Carbon\Carbon::now() }}</div>
</body>
</html>
