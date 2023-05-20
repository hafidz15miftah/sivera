<!DOCTYPE html>
<html>

<head>
    <title>Laporan Inventaris Barang</title>
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
    </style>
</head>

<body>
    <h2 style="justify-content: center; text-align: center">DAFTAR INVENTARIS RUANGAN</h2>
    <h2 style="justify-content: center; text-align: center">TAHUN 2023</h2>
    <hr>
    <h3>RUANGAN: </h3>
    <table>
        <thead>
            <tr>
                <th style="border: 1px solid #000; background-color: white;">NO</th>
                <th style="border: 1px solid #000; background-color: white;">TANGGAL</th>
                <th style="border: 1px solid #000; background-color: white;">NAMA RUANGAN</th>
                <th style="border: 1px solid #000; background-color: white;">KODE BARANG</th>
                <th style="border: 1px solid #000; background-color: white;">NAMA BARANG</th>
                <th style="border: 1px solid #000; background-color: white;">KONDISI</th>
                <th style="border: 1px solid #000; background-color: white;">JUMLAH</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($barang as $b)
            <tr>
                <td style="border: 1px solid #000;">{{ $loop->iteration }}</td>
                <td style="border: 1px solid #000;">{{ \Carbon\Carbon::parse($b->tanggal)->locale('id')->translatedFormat('d/m/Y')}}</td>
                <td style="border: 1px solid #000;">{{ $b->nama_ruang }}</td>
                <td style="border: 1px solid #000;">{{ $b->kode_barang }}</td>
                <td style="border: 1px solid #000;  width: 30%;">{{ $b->nama_barang }}</td>
                <td style="border: 1px solid #000; width: 20%;">{{ $b->kondisi }}</td>
                <td style="border: 1px solid #000; text-align: center; width: 2%">{{ $b->jumlah }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</body>

</html>
