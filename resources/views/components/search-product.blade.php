    <!-- Search by Name -->
    <div class="col-md-4">
        <div class="input-group">
            <input type="text" id="searchBox" class="form-control" placeholder="Tìm kiếm theo tên sản phẩm...">
            <div class="input-group-append">
            </div>
        </div>
    </div>

    <!-- Filter by Price Options -->
    <div class="col-md-4">
        <select id="filterPriceRange" class="form-control">
            <option value="">Lọc theo giá</option>
            <option value="50000">50.000đ</option>
            <option value="100000">100.000đ</option>
            <option value="200000">200.000đ</option>
        </select>
    </div>

    <!-- Custom Option Filter -->
    <div class="col-md-3">
        <select id="filterCustomOption" class="form-control">
            <option value="">Lọc theo tùy chọn</option>
            <option value="1">Option 1</option>
            <option value="2">Option 2</option>
        </select>
    </div>

    <!-- Search Button -->
    <div class="col-md-1">
        <button data-url="{{ route('product') }}" id="applyFilters" class="btn btn-primary w-100">
            Tìm
        </button>

    </div>

    {{-- ///// --}}
    <script>
        document.getElementById('applyFilters').addEventListener('click', function() {
            // Lấy URL từ thuộc tính data-url
            const url = this.getAttribute('data-url');

            // Thu thập dữ liệu từ các bộ lọc
            const searchValue = document.getElementById('searchBox').value;
            const selectedPrice = document.getElementById('filterPriceRange').value;
            const selectedOption = document.getElementById('filterCustomOption').value;

            // Gửi yêu cầu AJAX đến server
            fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                            .content // Bắt buộc cho Laravel
                    },
                    body: JSON.stringify({
                        searchValue: searchValue,
                        selectedPrice: selectedPrice,
                        selectedOption: selectedOption
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Xóa danh sách cũ và hiển thị sản phẩm mới
                        const productContainer = document.querySelector('.row.product-section .row:last-child');
                        productContainer.innerHTML = '';

                        // Hiển thị danh sách sản phẩm mới
                        data.data.forEach((product) => {
                            const productHTML = `
                    <div class="col-lg-3 col-md-6 text-center product-item">
                        <div class="single-product-item">
                            <div class="product-image">
                                <a href="${product.account_url}">
                                    <img src="${product.account_image}" alt="Hình ảnh sản phẩm" loading="lazy">
                                </a>
                            </div>
                            <h3><b>Tên Nick :</b> ${product.account_name}</h3>
                            <p class="product-price"> ${product.account_price} VND </p>
                            <a href="${product.account_url}" class="cart-btn">
                                <i class="fas fa-shopping-cart"></i> Chi tiết
                            </a>
                        </div>
                    </div>
                `;
                            productContainer.insertAdjacentHTML('beforeend', productHTML);
                        });
                    } else {
                        alert('Không tìm thấy sản phẩm phù hợp!');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        });
    </script>
