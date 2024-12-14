<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Nhập NickDaoQuan.vn - Shop Nick Ngọc Rồng Uy Tín Chất Lượng</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/images/favicon.ico') }}">
    <meta name="description"
        content="Đăng nhập vào NickDaoQuan.vn để quản lý tài khoản RMNAF của bạn, thực hiện giao dịch mua bán nick game RMNAF một cách nhanh chóng và bảo mật. Nếu bạn chưa có tài khoản, hãy đăng ký ngay để nhận ưu đãi đặc biệt. Đăng nhập dễ dàng với email và mật khẩu đã đăng ký.">
    <meta name="keywords"
        content="đăng nhập, tài khoản ngọc rồng, shop nick ngọc rồng online, ngọc rồng online, đăng nhập NickDaoQuan.vn, tài khoản game uy tín, hệ thống đăng nhập, shop nick ngọc rồng uy tín">
    <meta name="author" content="Nguyễn Thành Thức">
    @vite('resources/sass/pages/_login.scss')
</head>

<body>
    @yield('content')
    {{-- <h2 class="font-lg">Chào mừng bạn đến với <a href="/" class="font-lg">nickdaoquan.vn</a></h2>
    <div class="container" id="container">
        <div class="form-container sign-up-container">
            <form action="{{ route('auth.register') }}" id="register-form" method="POST">
                <h1>Tạo tài khoản</h1>
                @csrf
                <a href=""></a>
                <div id="message_register"></div>
                <input type="text" placeholder="Tên" name="name" />
                <input type="email" placeholder="Email" name="email" />
                <input type="password" placeholder="Mật khẩu" name="password" />
                <input type="password" name="password_confirmation" placeholder="Nhập mật khẩu xác nhận" />
                <button>Đăng ký</button>
            </form>
        </div>
        <div class="form-container sign-in-container">
            <form action="{{ route('auth.login') }}" id="login-form" method="POST">
                <h1>Đăng nhập</h1>
                @csrf
                <a href=""></a>
                <div id="message_login"></div>
                <input type="email" name="email" placeholder="Nhập tài khoản" />
                <input type="password" name="password" placeholder="Nhập mật khẩu" />
                <button>Đăng Nhập</button>
            </form>
        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1>Chào bạn!</h1>
                    <p>Để giao dịch nhanh chóng tự động an toàn, vui lòng đăng nhập bằng thông tin cá nhân của bạn</p>
                    <button class="ghost" id="signIn">Đăng Nhập Ngay</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1>Chào bạn!</h1>
                    <p>Nhập thông tin cá nhân của bạn và bắt đầu tìm nick ngon giá rẽ của chúng tôi.</p>
                    <button class="ghost" id="signUp">Đăng Ký Ngay</button>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <p>
            Copyright &copy; 2024 | Nguyễn Thành Thức <i class="fa fa-heart text-danger"></i>
            <a href="/" class="link-secondary">nickdaoquan.vn</a>
        </p>
    </footer> --}}
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    @vite('resources/js/pages/login.js')
</body>

</html>
