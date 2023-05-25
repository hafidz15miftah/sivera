<!DOCTYPE html>
<html>

<head>
    <title>Laporan Barang Rusak</title>
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
    <h2 style="justify-content: center; text-align: center">DAFTAR PELAPORAN BARANG RUSAK</h2>
    <h2 style="justify-content: center; text-align: center">TAHUN {{ \Carbon\Carbon::now()->translatedFormat('Y') }}</h2>
    <hr>
    <h3>RUANGAN: {{ $nama }}</h3>
    <table>
        <thead>
            <tr>
                <th style="border: 1px solid #000; background-color: white;">NO</th>
                <th style="border: 1px solid #000; background-color: white;">NAMA BARANG</th>
                <th style="border: 1px solid #000; background-color: white;">KODE BARANG</th>
                <th style="border: 1px solid #000; background-color: white;">NAMA RUANGAN</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($barang as $b)
            <tr>
                <td style="border: 1px solid #000;">{{ $loop->iteration }}</td>
                <td style="border: 1px solid #000;  width: 30%;">{{ $b->nama_barang }}</td>
                <td style="border: 1px solid #000;">{{ $b->kode_barang }}</td>
                <td style="border: 1px solid #000;">{{ $b->nama_ruang }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</body>

</html>
