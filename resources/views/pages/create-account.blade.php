@extends('layouts.app')

@section('title', 'NickDaoQuan.VN | Shop Nick Ngọc Rồng Online Giá Rẻ, Uy Tín')

@push('css')
    <style>
        .preview-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .image-preview {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(100px, 1fr));
            gap: 10px;
            max-width: 600px;
            margin: auto;
        }

        .image-preview div {
            width: 100px;
            height: 100px;
            border: 1px solid #ccc;
            border-radius: 5px;
            overflow: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
        }
    </style>
@endpush

@section('content')
    <div class="list-section mt-5 pt-80 pb-80">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <h3 class="text-bold text-center">Tạo tài khoản mới</h3>
                    <form method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <select class="form-select" aria-label="Default select example">
                                <option selected>Danh mục game</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="username" class="form-label">Tên tài khoản</label>
                            <input type="text" class="form-control" id="username" aria-describedby="usernameHelper">
                            <div id="usernameHelper" class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Mật khẩu</label>
                            <input type="password" class="form-control" id="password" aria-describedby="passwordHelper">
                            <div id="passwordHelper" class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="price_account" class="form-label">Giá bán</label>
                            <input type="number" class="form-control" id="price_account">
                            <div id="passwordHelper" class="form-text"></div>
                        </div>
                        <div class="input-group mb-3">
                            <button class="btn btn-outline-secondary" type="button" id="button-addon-images">Chọn
                                ảnh</button>
                            <input type="text" class="form-control" placeholder="Chọn hình ảnh..." disabled
                                aria-label="Example text with button addon" aria-describedby="button-addon-images">
                                <input type="file" name="image" hidden multiple>
                        </div>
                        <div class="mb-3">
                            <div id="preview-container" class="image-preview"></div>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $('#images').on('change', function(event) {
            const files = event.target.files;
            const previewContainer = $('#preview-container');
            previewContainer.empty();
            const maxFiles = 20;

            for (let i = 0; i < Math.min(files.length, maxFiles); i++) {
                const file = files[i];
                const reader = new FileReader();

                reader.onload = function(e) {
                    const div = $('<div></div>');
                    const img = $('<img>').attr('src', e.target.result).addClass('preview-img');
                    div.append(img);
                    previewContainer.append(div);
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
@endpush
