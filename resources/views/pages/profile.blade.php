@extends('layouts.app')

@section('title', 'Thông tin tài khoản| NickDaoQuan.Vn')

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
                                <div class="panel">
                                    <div class="panel">
                                        <div class="col-sm-12 text-center">
                                            <h1 style="font-size: 26px;">THÔNG TIN TÀI KHOẢN</h1>
                                        </div>
                                    </div>
                                    <div class="content_post">
                                        <div class="row" style="justify-content: center;">
                                            <div class="col-lg-4 col-12">
                                            </div>
                                            <div class="col-lg-8 col-12">
                                                <div class="col-md-12 mb-2">
                                                    <div class="form-group row">
                                                        <span class="col-4 control-label bb ar">Tên tài khoản:
                                                        </span>
                                                        <span class="col-8 control-label al bb">nguyenthanhthuc
                                                        </span>
                                                    </div>
                                                </div>

                                                <div class="col-md-12 mb-2">
                                                    <div class="form-group row">
                                                        <span class="col-4 control-label bb ar">Email:</span>
                                                        <span class="col-8 control-label al">gnuye@gmail.com</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 mb-2">
                                                    <div class="form-group row">
                                                        <span class="col-4 control-label bb ar">Mật khẩu:</span>
                                                        <span class="col-8 control-label al"><a
                                                                href="/Home/ChangePassword"
                                                                style="color:#AFD275; font-weight:bold;">Nhấn đổi mật
                                                                khẩu</a></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 mb-2">
                                                    <div class="form-group row">
                                                        <span class="col-4 control-label bb ar">Số dư:</span>
                                                        <span class="col-8 control-label al bb"
                                                            style="color:#d70f0f;">100 - VNĐ</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 mb-2 hide">
                                                    <div class="form-group row">
                                                        <span class="col-4 control-label bb ar">Nhóm tài khoản:
                                                        </span>
                                                        <span class="col-8 control-label al">Người dùng</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 mb-2">
                                                    <div class="form-group row">
                                                        <span class="col-4 control-label bb ar">Ngày tham gia:
                                                        </span>
                                                        <span class="col-8 control-label al">11/25/2024 10:08:41
                                                            PM</span>
                                                    </div>
                                                </div>


                                            </div>
                                        </div>
                                    </div>


                                    <script>
                                        LoadTable('LogDonate', '/Home/LoadTable', 1);

                                        function loadDataTable(strName) {
                                            var table = $('#tb_hisser').DataTable({
                                                "lengthChange": false,
                                                "searching": false,
                                                "pageLength": 5,
                                                info: false,
                                                "ordering": false,
                                                "scrollX": true,
                                                "language": {
                                                    "sProcessing": "Đang xử lý...",
                                                    "sLengthMenu": "Xem _MENU_ mục",
                                                    "sZeroRecords": "Không có dữ liệu",
                                                    "sInfo": "Đang xem _START_ đến _END_ trong tổng số _TOTAL_ mục",
                                                    "sInfoEmpty": "Đang xem 0 đến 0 trong tổng số 0 mục",
                                                    "sInfoFiltered": "(được lọc từ _MAX_ mục)",
                                                    "sInfoPostFix": "",
                                                    "sSearch": "Tìm:",
                                                    "sUrl": "",
                                                    "oPaginate": {
                                                        "sFirst": "<<",
                                                        "sPrevious": "<",
                                                        "sNext": ">",
                                                        "sLast": ">>"
                                                    }
                                                }
                                            });

                                        }
                                    </script>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
@endsection
