<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Stiker Barang</title>
</head>

<style>
    body {
        font-size: 11px;
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
                        <td rowspan="4"><img src="images/cilacap.png" width="75px"></td>
                        <td colspan="2" class="center-text">BARANG MILIK PEMERINTAH DESA KEDAWUNG</td>
                    </tr>
                    <tr>
                        <th>Nama Barang</th>
                        <td>{{ $b->nama_barang }}</td>
                    </tr>
                    <tr>
                        <th>Kode Barang</th>
                        <td>{{ $b->kode_barang }}</td>
                    </tr>
                    <tr>
                        <th>Ruang</th>
                        <td>{{ $b->nama_ruang }}</td>
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
