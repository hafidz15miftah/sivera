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
    </style>
</head>

<body>
    <h2 style="justify-content: center; text-align: center">DAFTAR ASET TANAH / LAHAN</h2>
    <h2 style="justify-content: center; text-align: center">TAHUN {{ \Carbon\Carbon::now()->translatedFormat('Y') }}</h2>
    <hr>
    <table>
        <thead>
            <tr>
                <th style="border: 1px solid #000; background-color: white; text-align: center;">NO</th>
                <th style="border: 1px solid #000; background-color: white; text-align: center;">NAMA OBYEK</th>
                <th style="border: 1px solid #000; background-color: white; text-align: center;">ALAMAT</th>
                <th style="border: 1px solid #000; background-color: white; text-align: center;">NO SERTIFIKAT</th>
                <th style="border: 1px solid #000; background-color: white; text-align: center;">LUAS</th>
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
                <td style="border: 1px solid #000;">{{ $l->kondisi }}</td>
                <td style="border: 1px solid #000;">{{ $l->keterangan }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>