<div class="col-md-12 col-sm-6 col-xs-6 m-t-15 m-b-20 pe-0">
    <div class="c-content-title-3 c-title-md c-theme-border">
        <h3 style="font-size: 20px;">MENU TÀI KHOẢN</h3>
    </div>
    <div class="c-content-ver-nav">
        <ul class="c-menu">
            <li><a href="{{ route('profile.index') }}">Thông Tin Tài Khoản</a></li>
            @auth
                <li><a href="{{ route('auth.change.password') }}">Đổi Mật Khẩu</a></li>
            @endauth
            <li><a href="{{ route('card.index') }}">Nạp Tiền Thẻ Cào</a></li>
            <li><a href="{{ route('home.deposit') }}">Nạp Tiền ATM - Ví Điện Tử</a></li>
        </ul>
    </div>
</div>
<div class="col-md-12 col-sm-6 col-xs-6 m-t-15">
    <div class="c-content-title-3 c-title-md c-theme-border">
        <h3 style="font-size: 20px;">MENU GIAO DỊCH</h3>
    </div>
    <div class="c-content-ver-nav m-b-20">
        <ul class="c-menu">
            <li><a href="{{ route('account.tran.index') }}">Tài Khoản Đã Mua</a></li>
        </ul>
    </div>
</div>
@auth
    @if (in_array(auth()->user()->role, ['admin', 'seller']))
        <div class="col-md-12 col-sm-6 col-xs-6 m-t-15">
            <div class="c-content-title-3 c-title-md c-theme-border">
                <h3 style="font-size: 20px;">MENU GAME</h3>
            </div>
            <div class="c-content-ver-nav m-b-20">
                <ul class="c-menu">
                    <li><a href="{{ route('account.manage.index') }}">Game Ngọc Rồng</a></li>
                    <li><a href="{{ route('account.sell.history') }}">Lịch Sử Bán Nick</a></li>
                </ul>
            </div>
        </div>
    @endif
@endauth
