@extends('layouts.app')

@section('title', 'Đổi Mật Khẩu | NickDaoQuan.Vn')

@section('content')
    <div class="list-section app-sub-menu" style="padding-top: 130px; padding-bottom: 100px;">
        <div class="container">
            <div class="row">
                <div class="row-flex-safari game-list">
                    <section id="cardbody" class="section">
                        <div class="row">
                            {{-- LEFT MENU --}}
                            <div class="col-lg-3">
                                @include('components.app-sub-menu')
                            </div>
                            {{-- END LEFT MENU --}}

                            <div class="col-lg-9">
                                @include('components.admin.alert')
                                <div class="col-sm-12 text-center">
                                    <h1 style="font-size: 26px;">ĐỔI MẬT KHẨU</h1>
                                </div>
                                <div class="d-flex my-3 gap-3">
                                    <form id="frmDonate" method="post" action="{{ route('auth.update.password') }}">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-12 mb-3">
                                                <div class="form-group row">
                                                    <span class="col-md-3 control-label bb ar">Mật khẩu mới<span
                                                            class="text-danger">*</span></span>
                                                    <div class="col-md-9">
                                                        <input type="text" id="password" name="password"
                                                            class="form-control t14"
                                                            placeholder="Nhập mật khẩu mới"
                                                            value="">
                                                        @error('password')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <div class="form-group row">
                                                    <span class="col-md-3 control-label bb ar">Mật khẩu xác nhận<span
                                                            class="text-danger">*</span></span>
                                                    <div class="col-md-9">
                                                        <input type="text" id="password_confirmation" name="password_confirmation"
                                                            value="" class="form-control t14"
                                                            placeholder="Nhập mật khẩu xác nhận">
                                                        @error('password_confirmation')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <div class="form-group row">
                                                    <span class="col-md-3 control-label bb ar"></span>
                                                    <div class="col-md-9">
                                                        <button type="submit"
                                                            class="btn btn-primary col-xs-12 btn4">Xác Nhận</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
@endsection
