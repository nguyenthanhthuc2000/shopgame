@extends('layouts.admin')

@section('content')

<!-- Page header -->
<div class="page-header d-print-none">
  <div class="container-xl">
    <div class="row g-2 align-items-center">
      <div class="col">
        <h2 class="page-title">
          Cộng / trừ tiền
        </h2>
      </div>
    </div>
  </div>
</div>

<!-- Page body -->
<div class="page-body">
  <div class="container-xl">
    <div class="row row-deck row-cards">
      <div class="col-12">
        <div class="card">
          <div class="card-header" style="justify-content: space-between; gap: 8px;">
            <h3 class="card-title">Lịch sử cộng / trừ tiền</h3>
            <div class="my-2 my-md-0 flex-grow-1 flex-md-grow-0 order-first order-md-last">
            </div>
          </div>
          <div class="table-responsive">
            <table class="table card-table table-vcenter text-nowrap datatable">
                <thead>
                    <tr>
                        <th class="w-1">ID</th>
                        <th>Email</th>
                        <th>Admin nhận qua ATM</th>
                        <th>Thành viên nhận</th>
                        <th>Loại</th>
                        <th>Ghi chú</th>
                        <th>Ngày tạo</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($banks as $key => $bank)
                        <tr>
                            <td>{{ $bank->id }}</td>
                            <td>
                              <a href="/">{{ $bank->user->email }}</a>
                            </td>
                            <td>{{ number_format($bank->amount, 0, ',', '.') }}</td>
                            <td>{{ number_format($bank->buyer_vnd, 0, ',', '.') }}</td>
                            <td>
                              @if ($bank->type === \App\Models\CardTransaction::IS_SUCCESS_TRANSACTION)
                                Cộng tiền
                              @else
                                Trừ tiền
                              @endif
                          </td>
                          <td>{{ $bank->note }}</td>
                          <td>{{ $bank->created_at }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer d-flex align-items-center">
            <div class="ms-auto">
                {{ $banks->links('pagination::bootstrap-5') }}
            </div>
        </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection