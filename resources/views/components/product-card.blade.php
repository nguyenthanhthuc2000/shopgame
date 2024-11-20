<div class="single-product-item">
    <div class="product-image">
        <a href="5G0ld.html"><img src="{{ $account['account_image'] ?? '' }}" alt=""></a>
    </div>
    <h3><b>Tên Nick :</b> {{ $account['account_name'] ?? '' }}</h3>
    <p class="product-price"> {{ $account['account_price'] ?? '' }} VND </p>
    <a href="{{ route('accounts.show', $account['id']) }}" class="cart-btn"><i class="fas fa-shopping-cart"></i> Chi
        tiết</a>
</div>
