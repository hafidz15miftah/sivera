<!DOCTYPE html>
<html class="h-100" lang="id">
<title>Masuk &minus; Sistem Informasi Inventaris Barang dan Aset Desa</title>

<!-- Head -->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon.ico')}}">
    <!-- Custom Stylesheet -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>

<body class="h-100">

    <!-- Loading Progressbar -->
    @include('partials.loading')

    <div class="login-form-bg h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100">
                <div class="col-xl-6">
                    <div class="form-input-content">
                        <div class="card login-form mb-0">
                            <div class="card-body pt-5 text-center">
                                <img src="images/cilacap.png" alt="SIVERA" width="80">
                                <h4>Sistem Informasi Inventaris Barang dan Aset Desa</h4>

                                <form action="{{ route('login') }}" method="POST" class="mt-5 mb-5 login-input">
                                    @csrf

                                    @if($errors->any())
                                    <div class="alert alert-danger">
                                        @foreach ($errors->all() as $error)
                                        {{ $error }}
                                        @endforeach
                                    </div>
                                    @endif
                                    <div class="form-group">
                                        <input type="email" class="form-control" placeholder="Email" name="email" :value="old('email')" required autofocus>
                                        <input-error ::messages="$errors->get('email')" class="mt-2" />
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control" name="password" placeholder="Kata Sandi">
                                    </div>
                                    <button class="btn login-form__btn submit w-100" type="submit">Masuk</button>
                                    <button class="btn w-100"><a href="{{ route('password.request') }}" class="text-primary">Lupa Kata Sandi?</a></button>
                                </form>
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