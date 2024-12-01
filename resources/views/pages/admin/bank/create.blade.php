@extends('layouts.admin')

@section('content')
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        Tạo giao dịch
                    </h2>
                </div>
            </div>
        </div>
    </div>

    <!-- Page body -->
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-cards">
                <form action="{{ route('banks.tran.store') }}" method="post">
                    @csrf
                    <div class="card mb-3">
                        <div class="card-header">
                            <h4 class="card-title">Cộng / Trừ tiền thành viên</h4>
                        </div>
                        <div class="card-body">
                            <div class="row g-5">
                                <div class="col-xl-12">
                                    <div class="mb-3">
                                        <label class="form-label">Tài khoản thành viên (Email)</label>
                                        <input type="email" class="form-control" name="email"
                                            placeholder="Nhập tài khoản thành viên" value="{{ old('email') }}">
                                        @error('email')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Số tiền thành viên nạp ATM</label>
                                        <input type="number" class="form-control" name="amount"
                                            placeholder="Nhập số tiền thành viên nạp ATM" value="{{ old('amount') }}">
                                        @error('amount')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Số tiền thành viên sẽ nhận</label>
                                        <input type="number" class="form-control" name="buyer_vnd"
                                            placeholder="Nhập số tiền thành viên nhận" value="{{ old('buyer_vnd') }}">
                                        @error('buyer_vnd')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <div class="form-label">Loại</div>
                                        <select class="form-select" name="type">
                                            <option value="{{ \App\Models\Admin\BankTransaction::INCREASE_TYPE }}" {{ old('type') == 1 ? 'selected' : '' }}>Cộng tiền
                                            </option>
                                            <option value="{{ \App\Models\Admin\BankTransaction::DECREASE_TYPE }}" {{ old('type') == 0 ? 'selected' : '' }}>Trừ tiền</option>
                                        </select>
                                        @error('type')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Ghi chú <span
                                                class="form-label-description">255</span></label>
                                        <textarea class="form-control" name="note" rows="2" placeholder="Ghi chú..">{{ old('note') }}</textarea>
                                        @error('note')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <div class="d-flex">
                            <button type="submit" class="btn btn-primary ms-auto">Xác nhận</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
