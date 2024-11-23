@extends('layouts.admin')

@section('content')

<!-- Page header -->
<div class="page-header d-print-none">
  <div class="container-xl">
    <div class="row g-2 align-items-center">
      <div class="col">
        <h2 class="page-title">
          Nick game
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
            <h3 class="card-title">Lịch sử mua nick game</h3>
            <div class="my-2 my-md-0 flex-grow-1 flex-md-grow-0 order-first order-md-last">
              <form action="{{ route('accounts.tran.index') }}" method="get" autocomplete="off" novalidate>
                <div class="input-icon">
                    <span class="input-icon-addon">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                            <path d="M21 21l-6 -6" />
                        </svg>
                    </span>
                    <input type="text" name="uuid" value="{{ request('uuid') }}" class="form-control" placeholder="Tìm kiếm mã giao dịch..." aria-label="">
                </div>
              </form>
            </div>
          </div>
          <div class="table-responsive">
            <table class="table card-table table-vcenter text-nowrap datatable">
                <thead>
                    <tr>
                        <th class="w-1">ID</th>
                        <th>Mã giao dịch</th>
                        <th>Email</th>
                        <th>Mã nick</th>
                        <th>Giá bán</th>
                        <th>CTV nhận (CARD)</th>
                        <th>Chiếc khấu bán nick</th>
                        <th>Trạng thái</th>
                        <th>Ngày tạo</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($accounts as $key => $account)
                        <tr>
                            <td>{{ $account->id }}</td>
                            <td>{{ $account->uuid }}</td>
                            <td>{{ $account->account_id }}</td>
                            <td>
                              <a href="/">{{ $account->user->email }}</a>
                            </td>
                            <td>{{ number_format($account->price, 0, ',', '.') }}</td>
                            <td>{{ number_format($account->seller_profit, 0, ',', '.') }}</td>
                            <td>{{ $account->profit_rate }}%</td>
                            <td>
                              @if ($card->status === 1)
                                <span class="badge bg-success me-1"></span>Thành công
                              @elseif ($card->status === 2)
                                <span class="badge bg-warning me-1"></span>Hủy
                              @else
                                <span class="badge bg-danger me-1"></span>Đang xử lí
                              @endif
                            </td>
                          <td>{{ $account->note }}</td>
                          <td>{{ $account->created_at }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer d-flex align-items-center">
            <div class="ms-auto">
                {{ $accounts->links('pagination::bootstrap-5') }}
            </div>
        </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection