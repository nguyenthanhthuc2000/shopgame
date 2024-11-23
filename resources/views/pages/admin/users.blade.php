@extends('layouts.admin')

@section('content')

<!-- Page header -->
<div class="page-header d-print-none">
  <div class="container-xl">
    <div class="row g-2 align-items-center">
      <div class="col">
        <h2 class="page-title">
          Thành viên
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
          <div class="card-header" style="justify-content: space-between;">
            <h3 class="card-title">Danh sách thành viên</h3>
            <div class="my-2 my-md-0 flex-grow-1 flex-md-grow-0 order-first order-md-last">
              <form action="{{ route('users.index') }}" method="get" autocomplete="off" novalidate>
                <div class="input-icon">
                    <span class="input-icon-addon">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                            <path d="M21 21l-6 -6" />
                        </svg>
                    </span>
                    <input type="text" name="email" value="{{ request('email') }}" class="form-control" placeholder="Tìm kiếm email..." aria-label="">
                </div>
              </form>
            </div>
          </div>
          <div class="table-responsive">
            <table class="table card-table table-vcenter text-nowrap datatable">
                <thead>
                    <tr>
                        <th class="w-1">ID</th>
                        <th>Tài khoản</th>
                        <th>Tên</th>
                        <th>Quyền</th>
                        <th>Số dư (card)</th>
                        <th>Số dư (vnđ)</th>
                        <th>Chiếc khấu bán nick</th>
                        <th>Card sang VND</th>
                        <th>Trạng thái</th>
                        <th>Ngày tạo</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $key => $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->role }}</td>
                            <td>{{ number_format($user->seller_vnd, 0, ',', '.') }}</td>
                            <td>{{ number_format($user->buyer_vnd, 0, ',', '.') }}</td>
                            <td>{{ $user->profit_rate }}%</td>
                            <td>{{ $user->buyer_to_seller_rate }}%</td>
                            <td>
                                @if ($user->status === 1)
                                  <span class="badge bg-success me-1"></span>Hoạt động
                                @else
                                  <span class="badge bg-warning me-1"></span>Đã khóa
                                @endif
                            </td>
                            <td>{{ $user->created_at->format('d/m/Y') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer d-flex align-items-center">
            <div class="ms-auto">
                {{ $users->links('pagination::bootstrap-5') }}
            </div>
        </div>
        
        </div>
      </div>
    </div>
  </div>
</div>

@endsection