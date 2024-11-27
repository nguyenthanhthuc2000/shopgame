@extends('layouts.app')

@section('title', 'Nạp thẻ cào | NickDaoQuan.Vn')

@section('content')
    <div class="list-section app-sub-menu" style="padding-top: 130px; padding-bottom: 100px;">
        <div class="container">
            <div class="row">
                <div class="row-flex-safari game-list">
                    <section id="cardbody" class="section">
                        <div class="row">

                            {{-- LEFT MENU --}}
                            @include('components.app-sub-menu')
                            {{-- END LEFT MENU --}}

                            <div class="col-xs-12 col-md-9">
                                <div class="">
                                    <div class="panel">
                                        <div class="col-sm-12 text-center">
                                            <h1 style="font-size: 26px;">NẠP THẺ CÀO</h1>
                                        </div>
                                        <br>
                                        <form id="frmDonate" method="post" action="{{ route('postCard') }}">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-12 text-center" style="padding-bottom: 20px;">
                                                    <div class="m-auto"
                                                        style="width: 300px;padding: 10px; background-color: #AFD275;border: 1px solid #d1ef33;margin-bottom: 30px;border-radius: 6px;">
                                                        <b class="t18" style="color:#ffffff;">SỐ DƯ: 0 VNĐ</b>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 mb-4">
                                                    <div class="col-md-12 mb-3">
                                                        <div class="form-group row">
                                                            <span class="col-md-2 control-label bb ar">Nhà mạng <span
                                                                    class="text-danger">*</span></span>
                                                            <div class="col-md-10">
                                                                <select class="form-control" id="cardType" name="telco">
                                                                    <option value="">Chọn loại thẻ</option>
                                                                    @foreach ($cardTypes as $key => $val)
                                                                        @if ($key == old('telco'))
                                                                            <option value="{{ $key }}" selected>
                                                                                {{ $val }}</option>
                                                                        @else
                                                                            <option value="{{ $key }}">
                                                                                {{ $val }}</option>
                                                                        @endif
                                                                    @endforeach
                                                                </select>
                                                                @error('telco')<div class="text-danger">{{ $message }}</div>@enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 mb-3">
                                                        <div class="form-group row">
                                                            <span class="col-md-2 control-label bb ar">Mệnh giá <span
                                                                    class="text-danger">*</span></span>
                                                            <div class="col-md-10">
                                                                <select class="form-control" id="cardValue"
                                                                    name="declared_value"
                                                                    value="{{ old('declared_value') }}">
                                                                    <option value="">Chọn mệnh giá</option>
                                                                </select>
                                                                @error('declared_value')<div class="text-danger">{{ $message }}</div>@enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 mb-3">
                                                        <div class="form-group row">
                                                            <span class="col-md-2 control-label bb ar">Số seri <span
                                                                    class="text-danger">*</span></span>
                                                            <div class="col-md-10">
                                                                <input type="text" id="code" name="code"
                                                                    class="form-control t14"
                                                                    placeholder="Nhập mã serial nằm sau thẻ"
                                                                    value="{{ old('code') }}">
                                                                    @error('code')<div class="text-danger">{{ $message }}</div>@enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 mb-3">
                                                        <div class="form-group row">
                                                            <span class="col-md-2 control-label bb ar">Mã thẻ <span
                                                                    class="text-danger">*</span></span>
                                                            <div class="col-md-10">
                                                                <input type="text" id="serial" name="serial"
                                                                    value="{{ old('serial') }}" class="form-control t14"
                                                                    placeholder="Nhập mã số sau lớp bạc mỏng">
                                                                    @error('serial')<div class="text-danger">{{ $message }}</div>@enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 mb-3">
                                                        <div class="form-group row">
                                                            <span class="col-md-2 control-label bb ar"></span>
                                                            <div class="col-md-10">
                                                                @auth
                                                                    <button type="submit"
                                                                        class="btn btn-primary col-xs-12 btn4">Nạp thẻ</button>
                                                                @endauth
                                                                @guest
                                                                    <a href="{{ route('login') }}"
                                                                        class="btn btn-danger col-xs-12 btn4">Đăng nhập để nạp
                                                                        thẻ</a>
                                                                @endguest
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                        <div class="row">
                                            <div class="col-md-12 header-title-buy">
                                                <div style=" padding: 20px 15px 20px 15px;background: #AFD275;">
                                                    <p class="mb-0" style="text-align:center"><strong><span
                                                                style="color:#e74c3c"><span style="font-size:20px">NẠP
                                                                    THẺ KHÔNG CHIẾT KHẤU<br>
                                                                    Nạp 10k được 10k ...100k được
                                                                    100k</span></span></strong></p>

                                                    <p style="text-align:center"><strong><span style="color:#e74c3c"><span
                                                                    style="font-size:20px">SAI
                                                                    MỆNH GIÁ&nbsp;-50%
                                                                    THẺ</span></span></strong></p>
                                                </div>
                                                <br>
                                            </div>
                                        </div>
                                    </div>

                                    @auth
                                        <div class="panel-heading clearfix text-center"
                                            style="color: #fdfdfd; background: #AFD275; padding: 10px 15px;">
                                            <span class="t24 bb" style=""><b>LỊCH SỬ NẠP THẺ</b></span>
                                        </div>
                                        <div id="historyCard" class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Loại thẻ</th>
                                                        <th scope="col">Mã thẻ</th>
                                                        <th scope="col">Serial</th>
                                                        <th scope="col" style="min-width: 100px;">Mệnh giá</th>
                                                        <th scope="col" style="min-width: 130px;">Mệnh giá thật</th>
                                                        <th scope="col" style="min-width: 100px;">Trạng thái</th>
                                                        <th scope="col">Thời gian</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse($historyCards as $index => $item)
                                                        <tr>
                                                            <td>{{ $item->telco }}</td>
                                                            <td> {{ $item->code }}</td>
                                                            <td style="min-width: 100px;"> {{ $item->serial }}</td>
                                                            <td style="min-width: 100px;">{{ number_format($item->value, 0, ',', '.') }}</td>
                                                            <td style="min-width: 130px;">{{ number_format($item->declared_value, 0, ',', '.') }}</td>
                                                            @switch($item->status)
                                                                @case(0)
                                                                    <td class="text-info" style="min-width: 100px;">
                                                                        {{ \App\Models\CardTransaction::TRANSACTION_STATUS[$item->status] }}
                                                                    </td>
                                                                @break

                                                                @case(1)
                                                                    <td class="text-success" style="min-width: 100px;">
                                                                        {{ \App\Models\CardTransaction::TRANSACTION_STATUS[$item->status] }}
                                                                    </td>
                                                                @break

                                                                @case(2)
                                                                    <td class="text-danger" style="min-width: 100px;">
                                                                        {{ \App\Models\CardTransaction::TRANSACTION_STATUS[$item->status] }}
                                                                    </td>
                                                                @break

                                                                @default
                                                            @endswitch
                                                            <td>{{ date('d/m/Y H:i', strtotime($item->created_at)) }}</td>
                                                        </tr>
                                                        @empty
                                                            <tr>
                                                                <td colspan="5" class="text-center">Không tìm thấy dữ liệu nạp
                                                                    thẻ</td>
                                                            </tr>
                                                        @endforelse
                                                    </tbody>
                                                </table>
                                            </div>
                                        @endauth
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    @endsection


    @push('js')
        <script>
            var cardValues = {!! json_encode($cardValues) !!};
            if ($('#cardType').val()) {
                generateOptions();
            }
            $('#cardType').change(function() {
                generateOptions();
            });

            function generateOptions() {
                var options = ['<option value="">Chọn mệnh giá</option>'];
                if ($('#cardType').val()) {
                    if (cardValues[$('#cardType').val()]) {
                        cardValues[$('#cardType').val()].forEach(function(value) {
                            if ("{{ old('declared_value') }}" == value) {
                                options.push(
                                    `<option value="${value}" selected>${value.toLocaleString('it-IT')}đ</option>`);
                            } else {
                                options.push(`<option value="${value}">${value.toLocaleString('it-IT')}đ</option>`);
                            }
                        });
                    }
                }
                $('#cardValue').html(options.join(''));
            }
        </script>
    @endpush
