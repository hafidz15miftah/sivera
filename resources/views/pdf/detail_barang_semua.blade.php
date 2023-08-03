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
            margin: 0 auto;
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
    <h2 class="tahun">SEMUA DATA INVENTARISIR</h2>
    <hr>
    <h3 class="nama-ruang">PEMERINTAH DESA KEDAWUNG</h3>
    <hr>
    <br>
    <table>
        <tr>
            <th style="text-align: center; width: 5%">NO</th>
            <th style="text-align: center; width: 100px">ID BARANG</th>
            <th style="text-align: center; width: 10px">TANGGAL INVENTARISIR</th>
            <th style="text-align: center; width: 10px">TANGGAL PEROLEHAN</th>
            <th style="text-align: center; width: 100px">RUANG</th>
            <th style="text-align: center; width: 100px">KONDISI</th>
            <th style="text-align: center; width: 100px">NAMA BARANG</th>
            <th style="text-align: center; width: 100px">MERK</th>
            <th style="text-align: center; width: 100px">SUMBER</th>
        </tr>

        @foreach ($laporan as $l)
        <tr>
            <td style="text-align: center">{{ $loop->iteration }}</td>
            <td style="text-align: center">{{ $l->kode_detail }}</td>
            <td style="text-align: center">{{ \Carbon\Carbon::parse($l->inventarisir)->locale('id')->translatedFormat('d/m/Y') }}</td>
            <td style="text-align: center">{{ \Carbon\Carbon::parse($l->tgl_perolehan)->locale('id')->translatedFormat('d/m/Y') }}</td>
            <th style="text-align: center">{{ $l->nama_ruang }}</th>
            <td>
                @if($l->kondisi == 1)
                    Baik
                @elseif($l->kondisi == 2)
                    Rusak Ringan
                @else
                    Rusak Berat
                @endif
            </td>
            <td>{{ $l->nama_barang }}</td>
            <td>{{ $l->merk }}</td>
            <td style="text-align: center">{{ $l->sumber }}</td>
        </tr>
        @endforeach
    </table>
    <div class="cetak-info">Dicetak oleh Sistem Informasi Inventaris Barang dan Aset Desa - SIVERA pada {{ \Carbon\Carbon::now() }}</div>
</body>
</html>
