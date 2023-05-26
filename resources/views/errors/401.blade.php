<!DOCTYPE html>
<html class="h-100" lang="id">
<title>Error 401 &minus; Sistem Informasi Inventaris Barang dan Aset Desa</title>

<!-- Head -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon.ico')}}">
    <!-- Pignose Calender -->
    <link href="{{ asset('plugins/pg-calendar/css/pignose.calendar.min.css')}}" rel="stylesheet">
    <!-- Chartist -->
    <link rel="stylesheet" href="{{ asset('plugins/chartist/css/chartist.min.css')}}">
    <link rel="stylesheet" href="{{ asset('plugins/chartist-plugin-tooltips/css/chartist-plugin-tooltip.css')}}">
    <!-- Custom Stylesheet -->
    <link href="{{ asset('plugins/tables/css/datatable/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <!-- Load SweetAlert CSS -->
    <link rel="stylesheet" href="">
</head>

<body class="h-100">
    
    <!-- Loading Progressbar -->
    @include('partials.loading')

    <div class="login-form-bg h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100">
                <div class="col-xl-6">
                    <div class="error-content">
                        <div class="card mb-0">
                            <div class="card-body text-center pt-5">
                                <h1 class="error-text text-primary">401</h1>
                                <h4 class="mt-4"><i class="fa fa-thumbs-down text-danger"></i> Akses Dibatasi</h4>
                                <p>Anda tidak memiliki akses untuk membuka halaman ini</p>
                                <form class="mt-5 mb-5">
                                    
                                    <div class="text-center mb-4 mt-4"><a href="/dashboard" class="btn btn-primary">Kembali ke Halaman Awal</a>
                                    </div>
                                </form>
                                <div class="text-center">
                                    <p>Hak Cipta &copy; 2023 <a href="https://kedawung-kroya.cilacapkab.go.id">Pemerintah Desa Kedawung</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Script -->
    @include('partials.script')
</body>
</html>