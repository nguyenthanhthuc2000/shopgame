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

        .image-preview div button {
            position: absolute;
            top: 5px;
            right: 5px;
            background-color: rgb(255, 255, 255, .5);
            color: white;
            border: none;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 12px;
            cursor: pointer;
        }

        .single-image-preview {
            width: 150px;
            height: 150px;
            border: 1px solid #ccc;
            border-radius: 5px;
            overflow: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: auto;
            position: relative;
        }

        .single-image-preview img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .single-image-preview button {
            position: absolute;
            top: 5px;
            right: 5px;
            background-color: rgb(255, 255, 255, .5);
            ;
            color: white;
            border: none;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 12px;
            cursor: pointer;
        }

        .single-image-preview::after {
            content: '+';
            font-size: 2rem;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
    </style>
@endpush

@section('content')
    <div class="list-section mt-5 pt-80 pb-80">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <h3 class="text-bold text-center">Tạo tài khoản mới</h3>
                    <form action="{{ route('product.create.post') }}" method="post" enctype="multipart/form-data" class="row">
                        @csrf
                        <div class="mb-3 col-xl-3 col-md-6">
                            <select class="form-select" aria-label="Default select example">
                                <option selected disabled>Danh mục game</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category['id'] ?? '' }}">{{ $category['name'] ?? '' }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3 col-xl-3 col-md-6">
                            <select class="form-select" aria-label="Default select example">
                                <option selected disabled>Hành tinh</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category['id'] ?? '' }}">{{ $category['name'] ?? '' }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3 col-xl-3 col-md-6">
                            <select class="form-select" aria-label="Default select example">
                                <option selected disabled>Loại đăng ký</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category['id'] ?? '' }}">{{ $category['name'] ?? '' }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3 col-xl-3 col-md-6">
                            <select class="form-select" aria-label="Default select example">
                                <option selected disabled>Bông tai</option>
                                <option value="1">Có</option>
                                <option value="0">Không</option>
                            </select>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="username" class="form-label">Tên tài khoản</label>
                            <input type="text" class="form-control" id="username" aria-describedby="usernameHelper">
                            <div id="usernameHelper" class="form-text"></div>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="password" class="form-label">Mật khẩu</label>
                            <input type="password" class="form-control" id="password" aria-describedby="passwordHelper">
                            <div id="passwordHelper" class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="price_account" class="form-label">Giá bán</label>
                            <input type="number" class="form-control" id="price_account">
                            <div id="passwordHelper" class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="image_account" class="form-label">Ảnh banner</label>
                            <br />
                            <button class="btn-add-single-image btn btn-success" type="button">Thêm ảnh</button>
                            <input type="file" name="banner" id="single-image" hidden>
                            <div class="mb-3">
                                <div id="banner-preview-container" class="image-preview single-image-preview"></div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="images_account" class="form-label">Ảnh chi tiết</label>
                            <div class="input-group">
                                <button class="btn btn-outline-secondary btn-add-images" type="button"
                                    id="button-addon-images">Chọn ảnh</button>
                                <input type="text" class="form-control btn-add-images" placeholder="Chọn hình ảnh..."
                                    disabled aria-label="Thêm các ảnh chi tiết" aria-describedby="button-addon-images">
                                <input type="file" name="image" id="images" hidden multiple>
                            </div>
                            <div class="mb-3">
                                <div id="preview-container" class="image-preview"></div>
                            </div>
                        </div>
                        <div class="w-100 text-center">
                            <button type="submit" class="btn btn-primary w-30">Tạo</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $('.btn-add-images').click(function() {
            $('#images').click();
        })

        let addedImages = [];

        $('#images').on('change', function(event) {
            const files = event.target.files;
            const previewContainer = $('#preview-container');
            const maxFiles = 20;

            for (let i = 0; i < files.length; i++) {
                if (addedImages.length >= maxFiles) {
                    alert('Bạn chỉ có thể thêm tối đa 20 ảnh.');
                    break;
                }

                const file = files[i];
                if (!addedImages.some(img => img.name === file.name)) {
                    addedImages.push(file);

                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const div = $('<div></div>');
                        const img = $('<img>').attr('src', e.target.result).addClass('preview-img');
                        const removeBtn = $('<button>&times;</button>');

                        removeBtn.on('click', function() {
                            const index = addedImages.findIndex(img => img.name === file.name);
                            if (index !== -1) {
                                addedImages.splice(index, 1);
                                div.remove();
                            }
                        });

                        div.append(img).append(removeBtn);
                        previewContainer.append(div);
                    };
                    reader.readAsDataURL(file);
                }
            }

            $(this).val('');
        });

        $('.btn-add-single-image').click(function() {
            $('#single-image').click();
        })

        $('#single-image').on('change', function(event) {
            const file = event.target.files[0];
            const singlePreviewContainer = $('#banner-preview-container');
            singlePreviewContainer.empty(); // Clear previous preview

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = $('<img>').attr('src', e.target.result);
                    const removeBtn = $('<button>&times;</button>');

                    removeBtn.on('click', function() {
                        $('#single-image').val(''); // Clear input
                        singlePreviewContainer.empty(); // Clear preview
                    });

                    singlePreviewContainer.append(img).append(removeBtn);
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
@endpush
