<!-- Hiển thị thông báo thành công -->
@if(session('success'))
<div class="alert alert-success" role="alert">
    <div class="d-flex" style="align-items: center;">
        <div>
            <!-- Icon thành công -->
            <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24" viewBox="0 0 24 24"
                stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M5 12l5 5l10 -10" />
            </svg>
        </div>
        <div>
            {{ session('success') }}
        </div>
    </div>
</div>
@endif

<!-- Hiển thị thông báo lỗi -->
@if($errors->has('error'))
<div class="alert alert-danger" role="alert">
    <div class="d-flex" style="align-items: center;">
        <div>
            <!-- Icon lỗi -->
            <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24" viewBox="0 0 24 24"
                stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" />
                <path d="M12 8v4" />
                <path d="M12 16h.01" />
            </svg>
        </div>
        <div>
            {{ $errors->first('error') }}
        </div>
    </div>
</div>
@endif
