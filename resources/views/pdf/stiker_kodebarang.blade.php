<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Stiker Barang</title>
</head>

<style>
    body {
        font-size: 13px;
        font-family: Arial, Helvetica, sans-serif;
    }

    th {
        text-align: center;
    }

    .page-break {
        page-break-after: always;
    }

    .center-table {
        margin-left: auto;
        margin-right: auto;
    }

    .center-text {
        text-align: center;
    }
</style>

<body>
    <table class="center-table">
        <tr>
            <td>
                @foreach($stiker as $key => $b)
                <table border="1" cellpadding="0" cellspacing="0">
                    <tr>
                        <td rowspan="7" class="center-text" style="width: 80px; height: 80px"><img src="images/cilacap.png" width="50px"></td>
                        <td colspan="2" class="center-text" style="width: 600px;">BARANG MILIK PEMERINTAH DESA KEDAWUNG</td>
                    </tr>
                    <tr>
                        <th style="width: 100px;">Nama Barang</th>
                        <td>{{ $b->nama_barang }}</td>
                    </tr>
                    <tr>
                        <th style="width: 100px;">Merk</th>
                        <td>{{ $b->merk }}</td>
                    </tr>
                    <tr>
                        <th style="width: 100px;">ID Barang</th>
                        <td>{{ $b->kode_detail }}</td>
                    </tr>
                    <tr>
                        <th style="width: 100px;">Ruang</th>
                        <td>{{ $b->nama_ruang }}</td>
                    </tr>
                    <tr>
                        <th style="width: 100px;">Tgl. Perolehan</th>
                        <td>{{ \Carbon\Carbon::parse($b->tgl_perolehan)->isoFormat('D MMMM Y') }}</td>
                    </tr>
                    <tr>
                        <th style="width: 100px;">Sumber</th>
                        <td>{{ $b->sumber }}</td>
                    </tr>
                </table>
                <br>
                @if ($key != 0)
                    @if (($key + 1) % 9 == 0)
                        </td>
                        <td>
                    @endif
                    @if (($key + 1) % 5 == 0)
                        </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="page-break"></div>
                            </td>
                        </tr>
                    @endif
                @endif
                @endforeach
            </td>
        </tr>
    </table>
</body>

</html>
