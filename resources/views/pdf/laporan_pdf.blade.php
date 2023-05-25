<!DOCTYPE html>
<html>

<head>
    <title>Laporan Barang Rusak Terverifikasi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
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
    <h2 style="justify-content: center; text-align: center">REKAP PELAPORAN BARANG RUSAK</h2>
    <h2 style="justify-content: center; text-align: center">{{ strtoupper(\Carbon\Carbon::now()->translatedFormat('M')) }} {{ \Carbon\Carbon::now()->translatedFormat('Y') }}</h2>
    <hr>
    <table>
        <thead>
            <tr>
                <th style="border: 1px solid #000; background-color: white; text-align: center;">NO</th>
                <th style="border: 1px solid #000; background-color: white; text-align: center;">NAMA LAPORAN</th>
                <th style="border: 1px solid #000; background-color: white; text-align: center;">TANGGAL LAPORAN</th>
                <th style="border: 1px solid #000; background-color: white; text-align: center;">STATUS</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($verifikasi as $b)
            <tr>
                <td style="border: 1px solid #000; text-align: center;">{{ $loop->iteration }}</td>
                <td style="border: 1px solid #000;">{{ $b->nama_laporan }}</td>
                <td style="border: 1px solid #000; text-align: center;">{{ $b->tanggal_dilaporkan }}</td>
                <td style="border: 1px solid #000;">@if($b->status == 0)
                    Ditolak
                    @elseif($b->status == 1)
                    Menunggu Verifikasi Sekretaris Desa
                    @elseif($b->status == 2)
                    Menunggu Persetujuan Kepala Desa
                    @else
                    Disetujui
                    @endif</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>