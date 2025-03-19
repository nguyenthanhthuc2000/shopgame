<form id="accountSearch" class="mb-4" action="{{ route('category.index', ['category' => $category->slug]) }}">
    <div class="content_post">
        <div class="row g-3 align-items-end">

            <div class="col-md-2 col-6">
                <label for="id" class="form-label">Mã Số</label>
                <input type="text" id="id" name="id" class="form-control" placeholder="Nhập Mã Số"
                    value="{{ request('id', '') }}">
            </div>

            <div class="col-md-2 col-6">
                <label for="price" class="form-label">Giá</label>
                <input type="hidden" name="price_op" value="between">
                <select id="price" name="price" class="form-select">
                    <option value="" selected>Tất cả</option>
                    @if (!empty($prices))
                        @foreach ($prices as $price)
                            <option value="{{ $price['value'] }}" @selected($price['value'] == request('price'))>
                                {{ $price['name'] }}
                            </option>
                        @endforeach
                    @endif
                </select>
            </div>

            <div class="col-md-2 col-6">
                <label for="status" class="form-label">Trạng thái</label>
                <select id="status" name="status" class="form-select">
                    @foreach ($status as $stt)
                        <option value="{{ $stt['value'] }}" @selected($stt['value'] == request('status', 1))>
                            {{ $stt['name'] }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-2 col-6">
                <label for="server" class="form-label">Máy chủ</label>
                <input type="hidden" name="server_op" value="eq">
                <select id="server" name="server" class="form-select">
                    <option value="">Tất cả</option>
                    @foreach ($servers as $server)
                        <option value="{{ $server['value'] }}" @selected($server['value'] == request('server'))>
                            {{ $server['name'] }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-2 col-6">
                <label for="class" class="form-label">Hành tinh</label>
                <select id="class" name="class" class="form-select">
                    <option value="">Tất cả</option>
                    @foreach ($classes as $class)
                        <option value="{{ $class['value'] }}" @selected($class['value'] == request('class'))>
                            {{ $class['name'] }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-2 col-6">
                <button type="submit" class="btn btn-primary w-100">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
    </div>
</form>