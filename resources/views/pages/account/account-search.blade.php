<form class="d-flex gap-2" id="search-form">
    <div class="form-group">
        <select class="form-select" aria-label="planet" name="class">
            <option value="" @if (empty($class['value'])) {{ 'selected' }} @endif>Tất cả hành tinh</option>
            @foreach ($classes as $class)
                <option value="{{ $class['value'] ?? '' }}" @if ($class['value'] == request('class')) {{ 'selected' }} @endif>
                    {{ $class['name'] ?? '' }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <input type="search" name="account_name" value="{{ request('account_name') }}" class="form-control" placeholder="Tên tài khoản...">
    </div>
    <button class="btn btn-success">
        <i class="fas fa-search"></i>
    </button>
</form>
