<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Đăng Nhập NickDaoQuan.vn - Shop Nick Ngọc Rồng Uy Tín Chất Lượng</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
        <link rel="icon" type="image/x-icon" href="{{ asset('assets/images/favicon.ico') }}">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description"
            content="Đăng nhập vào NickDaoQuan.vn để quản lý tài khoản RMNAF của bạn, thực hiện giao dịch mua bán nick game RMNAF một cách nhanh chóng và bảo mật. Nếu bạn chưa có tài khoản, hãy đăng ký ngay để nhận ưu đãi đặc biệt. Đăng nhập dễ dàng với email và mật khẩu đã đăng ký.">
        <meta name="keywords"
            content="đăng nhập, tài khoản ngọc rồng, shop nick ngọc rồng online, ngọc rồng online, đăng nhập NickDaoQuan.vn, tài khoản game uy tín, hệ thống đăng nhập, shop nick ngọc rồng uy tín">
        <meta name="author" content="Nguyễn Thành Thức">

        <link rel="icon" type="image/x-icon" href="{{ asset('assets/images/favicon.ico') }}">

        <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
        @vite('resources/sass/pages-exclusive/login/index.scss')
    </head>

    <body class="account-body accountbg">

        <div class="row vh-100 ">
            <div class="col-12 align-self-center">
                <div class="auth-page">
                    <div class="card auth-card shadow-lg">
                        <div class="card-body">
                            <div class="px-3">
                                <div class="auth-logo-box">
                                    <a href="/" class="logo logo-admin"><img src="{{ asset('assets/images/avatar.jpg') }}" height="55" alt="logo" class="auth-logo"></a>
                                </div>

                                <div class="text-center auth-logo-text">
                                    <h1 class="mb-3 mt-5">Đăng Nhập</h1>
                                    <p class="text-muted mb-0">Chào mừng bạn đến shop nick game uy tín giá rẻ.</p>
                                </div>
                                <form class="form-horizontal auth-form my-4" action="{{ route('auth.login') }}" id="login-form" method="POST">
                                    @include('components.admin.alert')
                                    @csrf
                                    <div class="form-group">
                                        <label for="email">Tài khoản</label>
                                        <div class="input-group mb-3">
                                            <span class="auth-form-icon">
                                                <i class="dripicons-user"></i>
                                            </span>
                                            <input type="text" class="form-control" id="email" name="email" placeholder="Nhập tài khoản">
                                        </div>
                                        @error('email')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="password">Mật khẩu</label>
                                        <div class="input-group mb-3">
                                            <span class="auth-form-icon">
                                                <i class="dripicons-lock"></i>
                                            </span>
                                            <input type="password" name="password" class="form-control" id="password" placeholder="Nhập mật khẩu">
                                        </div>
                                        @error('password')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group row mt-4">
                                        <div class="col-sm-6">
                                            <div class="custom-control custom-switch switch-success">
                                                <input type="checkbox" class="custom-control-input" id="remember" name="remember">
                                                <label class="custom-control-label text-muted" for="remember">Ghi nhớ</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group mb-0 row">
                                        <div class="col-12 mt-2">
                                            <button class="btn btn-gradient-primary btn-round btn-block waves-effect waves-light" type="submit">Đăng Nhập <i class="fas fa-sign-in-alt ml-1"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="m-3 text-center text-muted">
                                <p class="">Bạn chưa có tài khoản?  <a href="/dang-ky" class="text-primary ml-2">Đăng Kí Ngay</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
        <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('assets/js/metisMenu.min.js') }}"></script>
        <script src="{{ asset('assets/js/waves.min.js') }}"></script>
        <script src="{{ asset('assets/js/jquery.slimscroll.min.js') }}"></script>

        @vite('resources/js/pages-exclusive/login.js')
    </body>
</html>
