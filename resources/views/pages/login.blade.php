<!DOCTYPE html>
<html class="h-100" lang="en">
<title>Masuk &minus; Sistem Informasi Inventaris Barang dan Aset Desa</title>

<!-- Head -->
@include('partials.head')

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
                                    <h4>Sistem Informasi Inventaris Barang dan Aset Desa</h4>

                                <form action="/login" method="POST" class="mt-5 mb-5 login-input">
                                    @csrf
                                    <div class="form-group">
                                        <input type="email" class="form-control" placeholder="Email">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control" placeholder="Kata Sandi">
                                    </div>
                                    <button class="btn login-form__btn submit w-100" type="submit">Masuk</button>
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