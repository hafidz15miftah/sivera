
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Data Barang</title>
    <style>
        table {
            border-collapse: collapse;
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
    </style>
</head>
<body>
    <h2 style="justify-content: center; text-align: center">DAFTAR INVENTARIS BARANG</h2>
    <h2 style="justify-content: center; text-align: center">TAHUN 2023</h2>
    <hr>
    <br>
    <table>
        <tr>
            <th rowspan="2" style="text-align: center; width: 1%">No</th>
            <th rowspan="2" style="width: 10%">NAMA BARANG</th>
            <th rowspan="2" style="width: 1%">TANGGAL PEMBELIAN</th>
            <th rowspan="2" style="text-align: center; width: 1%">JUMLAH BARANG</th>
            <th colspan="3" style="text-align: center">Kondisi</th>
            <th rowspan="2" style="text-align: center">KODE BARANG</th>
            <th rowspan="2" style="text-align: center">RUANGAN</th>
            <th rowspan="2" style="text-align: center">KETERANGAN</th>
        </tr>
        <tr>
            <th>Baik</th>
            <th>Rusak Ringan</th>
            <th>Rusak Berat</th>
        </tr>

        @foreach ($laporan as $l)
        <tr>
            <td style="text-align: center">{{ $loop->iteration }}</td>
            <td>{{ $l->nama_barang }}</td>
            <td style="text-align: center">{{ \Carbon\Carbon::parse($l->tgl_pembelian)->locale('id')->translatedFormat('d/m/Y') }}</td>
            <td style="text-align: center">{{ $l->jumlah }}</td>
            {{-- kondisi --}}
            <td style="text-align: center">{{ $l->baik }}</td>
            <td style="text-align: center">{{ $l->rusak_ringan }}</td>
            <td style="text-align: center">{{ $l->rusak_berat }}</td>
            {{-- end kondisi  --}}
            <td style="text-align: center">{{ $l->kode_barang }}</td>
            <td style="text-align: center">{{ $l->nama_ruang }}</td>
            <td style="text-align: left">{{ $l->keterangan }}</td>
        </tr>
        @endforeach
    </table>
</body>
</html>
