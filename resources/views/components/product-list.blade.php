<div class="single-product-item">
    <div class="product-image">
        <a href="5G0ld.html"><img src="{{ $product['account_image'] ?? '' }}" alt="" loading="lazy"></a>
    </div>
    <h3><b>Tên Nick :</b> {{ $product['account_name'] ?? '' }}</h3>
    <p class="product-price"> {{ $product['account_price'] ?? '' }} VND </p>
    <a href="{{ route('product', $product['id']) }}" class="cart-btn"><i class="fas fa-shopping-cart"></i> Chi
        tiết</a>
</div>
