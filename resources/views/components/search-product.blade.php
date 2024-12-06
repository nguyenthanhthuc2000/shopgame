<form id="frmBuy" name="frmBuy" class="mb-4">
    <input id="id" name="id" type="hidden" value="6eb90801-4193-4506-a132-d59ae8fbe6db">
    <input id="GameID" name="GameID" type="hidden" value="9ace6f9f-1fa3-4c38-898f-933556294c08">

    <div class="content_post">
        <div class="row g-3 align-items-end">
            <!-- Mã Số -->
            <div class="col-md-2">
                <label for="Code" class="form-label">Mã Số</label>
                <input type="text" id="Code" name="Code" class="form-control" placeholder="Nhập Mã Số">
            </div>

            <!-- Giá -->
            <div class="col-md-2">
                <label for="Money" class="form-label">Giá</label>
                <select id="Money" name="Money" class="form-select">
                    <option value="" selected>Tất cả</option>
                    <option value="0 200000">Dưới 200k</option>
                    <option value="200000 400000">200k - 400k</option>
                    <option value="400000 600000">400k - 600k</option>
                    <option value="600000 1000000">600k - 1M</option>
                    <option value="1000000 1500000">1M - 1.5M</option>
                    <option value="1500000 2000000">1.5M - 2M</option>
                    <option value="2000000 99999999">Trên 2M</option>
                </select>
            </div>

            <!-- Trạng thái -->
            <div class="col-md-2">
                <label for="Stage" class="form-label">Trạng thái</label>
                <select id="Stage" name="Stage" class="form-select">
                    <option value="">Tất cả</option>
                    <option value="ChuaBan">Chưa bán</option>
                    <option value="DaBan">Đã bán</option>
                    <option value="DaDacCoc">Đặt cọc</option>
                </select>
            </div>

            <!-- Máy chủ -->
            <div class="col-md-2">
                <label for="Field01" class="form-label">Máy chủ</label>
                <select id="Field01" name="Field01" class="form-select">
                    <option value="">Tất cả</option>
                    <option value="1">Server 1</option>
                    <option value="2">Server 2</option>
                    <option value="3">Server 3</option>
                    <option value="4">Server 4</option>
                    <option value="5">Server 5</option>
                    <option value="6">Server 6</option>
                    <option value="7">Server 7</option>
                    <option value="8">Server 8</option>
                    <option value="9">Server 9</option>
                    <option value="10">Server 10</option>
                </select>
            </div>

            <!-- Hành tinh -->
            <div class="col-md-2">
                <label for="Field02" class="form-label">Hành tinh</label>
                <select id="Field02" name="Field02" class="form-select">
                    <option value="">Tất cả</option>
                    <option value="TD">Trái đất</option>
                    <option value="XD">Xay da</option>
                    <option value="NM">Na mek</option>
                </select>
            </div>

            <!-- Tìm kiếm -->
            <div class="col-md-1 text-end">
                <button type="submit" class="btn btn-primary w-100 d-flex justify-content-center align-items-center">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
    </div>
</form>
