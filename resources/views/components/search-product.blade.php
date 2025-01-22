<form id="accountSearch" class="mb-4" action="{{ route('category.index', ['category' => $category->slug]) }}">
    {{-- @csrf --}}
    <div class="content_post">
        <div class="row g-3 align-items-end">

            <div class="col-md-2 col-6">
                <label for="code" class="form-label">Mã Số</label>
                <input type="text" id="code" name="code" class="form-control" placeholder="Nhập Mã Số">
            </div>

            <div class="col-md-2 col-6">
                <label for="price" class="form-label">Giá</label>
                <select id="price" name="price" class="form-select">
                    <option value="" selected>Tất cả</option>
                    @if (!empty($prices))
                        @foreach ($prices as $price)
                            <option value="{{ $price['value'] }}"
                                {{ $price['value'] == request('price') ? 'selected' : '' }}>
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
                        <option value="{{ $stt['value'] }}" {{ $stt['value'] == request('status') ? 'selected' : '' }}>
                            {{ $stt['name'] }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-2 col-6">
                <label for="server-game" class="form-label">Máy chủ</label>
                <select id="server-game" name="server_game" class="form-select">
                    <option value="">Tất cả</option>
                    @foreach ($servers as $server)
                        <option value="{{ $server['value'] }}"
                            {{ $server['value'] == request('server_game') ? 'selected' : '' }}>
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
                        <option value="{{ $class['value'] }}"
                            {{ $class['value'] == request('class') ? 'selected' : '' }}>
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
