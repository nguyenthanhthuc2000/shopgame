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
        <form action="" method="post">
          <div class="card mb-3">
            <div class="card-header">
              <h4 class="card-title">Cộng / Trừ tiền thành viên</h4>
            </div>
            <div class="card-body">
                <div class="row g-5">
                    <div class="col-xl-12">
                        <div class="mb-3">
                            <label class="form-label">Tài khoản thành viên (Email)</label>
                            <input type="email" class="form-control" name="email" placeholder="Nhập tài khoản thành viên">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Số tiền thành viên nạp ATM</label>
                            <input type="number" class="form-control" name="amount" placeholder="Nhập số tiền thành viên nạp ATM">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Số tiền thành viên nhận CARD</label>
                            <input type="number" class="form-control" name="buyer_vnd" placeholder="Nhập số tiền thành viên nhận CARD">
                        </div>
                        <div class="mb-3">
                            <div class="form-label">Loại</div>
                                <select class="form-select" name="tye">
                                    <option value="1">Cộng tiền</option>
                                    <option value="2">Trừ tiền</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Ghi chú <span class="form-label-description">255</span></label>
                            <textarea class="form-control" name="note" rows="2" placeholder="Ghi chú.."></textarea>
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