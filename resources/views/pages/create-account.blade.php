@extends('layouts.app')

@section('title', 'Tạo nick game | NickDaoQuan.Vn')

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
            width: 100%;
            background-color: #ccc;
        }

        .single-image-preview img {
            width: 100%;
            height: 100%;
            object-fit: contain;
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
    <div class="list-section app-sub-menu mt-5 pt-80 pb-80">
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
                                            <h1 style="font-size: 26px;">Tạo nick Ngọc Rồng</h1>
                                        </div>
                                        <br>
                                        <form action="{{ route('product.create.post') }}" method="post"
                                            enctype="multipart/form-data" class="row">
                                            @csrf
                                            <div class="mb-3 col-xl-4 col-md-6">
                                                <label for="category_id" class="form-label">Danh mục game <span
                                                        class="text-danger">*</span></label>
                                                <select class="form-select" aria-label="Nick ngọc rồng" name="category_id">
                                                    @foreach ($categories as $category)
                                                        <option value="{{ $category['id'] ?? '' }}">
                                                            {{ $category['name'] ?? '' }}</option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('category_id'))
                                                    <div class="text-danger">
                                                        {{ $errors->first('category_id') }}
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="mb-3 col-xl-4 col-md-6">
                                                <label for="class_id" class="form-label">Hành tinh <span
                                                        class="text-danger">*</span></label>
                                                <select class="form-select" aria-label="Xayda" id="class_id"
                                                    name="class_id">
                                                    @foreach ($classes as $class)
                                                        <option value="{{ $class['value'] ?? '' }}">
                                                            {{ $class['name'] ?? '' }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('class_id'))
                                                    <div class="text-danger">
                                                        {{ $errors->first('class_id') }}
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="mb-3 col-xl-4 col-md-6">
                                                <label for="regis_type" class="form-label">Loại đăng ký <span
                                                        class="text-danger">*</span></label>
                                                <select class="form-select" aria-label="Default select example"
                                                    id="regis_type" name="regis_type_id">
                                                    @foreach ($regisTypes as $type)
                                                        <option value="{{ $type['value'] ?? '' }}">{{ $type['name'] ?? '' }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('regis_type'))
                                                    <div class="text-danger">
                                                        {{ $errors->first('regis_type') }}
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="mb-3 col-xl-4 col-md-6">
                                                <label for="earring" class="form-label">Bông tai <span
                                                        class="text-danger">*</span></label>
                                                <select class="form-select" aria-label="Có" id="earring" name="earring">
                                                    @foreach ($earring as $option)
                                                        <option value="{{ $option['value'] ?? '' }}">
                                                            {{ $option['name'] ?? '' }}</option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('earring'))
                                                    <div class="text-danger">
                                                        {{ $errors->first('earring') }}
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="mb-3 col-xl-4 col-md-6">
                                                <label for="server" class="form-label">Server <span
                                                        class="text-danger">*</span></label>
                                                <select class="form-select" aria-label="Có" id="server" name="server_id">
                                                    @foreach ($servers as $server)
                                                        <option value="{{ $server['value'] ?? '' }}">
                                                            {{ $server['name'] ?? '' }}</option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('server'))
                                                    <div class="text-danger">
                                                        {{ $errors->first('server') }}
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="mb-3 col-xl-6">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <label for="username" class="form-label">Tên đăng nhập <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" id="username"
                                                            name="username" aria-describedby="usernameHelper">
                                                        @if ($errors->has('username'))
                                                            <div class="text-danger">
                                                                {{ $errors->first('username') }}
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div class="col-12">
                                                        <label for="password" class="form-label">Mật khẩu <span
                                                                class="text-danger">*</span></label>
                                                        <input type="password" class="form-control" id="password"
                                                            name="password" aria-describedby="passwordHelper">
                                                        @if ($errors->has('password'))
                                                            <div class="text-danger">
                                                                {{ $errors->first('password') }}
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div class="col-12">
                                                        <label for="price_account" class="form-label">Giá bán <span
                                                                class="text-danger">*</span></label>
                                                        <input type="number" class="form-control" id="price_account"
                                                            name="price_account">
                                                        @if ($errors->has('price_account'))
                                                            <div class="text-danger">
                                                                {{ $errors->first('price_account') }}
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div class="col-12">
                                                        <label for="description" class="form-label">Thông tin chi
                                                            tiết</label>
                                                        <textarea class="form-control" name="description" id="description" rows="3"></textarea>
                                                        @if ($errors->has('description'))
                                                            <div class="text-danger">
                                                                {{ $errors->first('description') }}
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-3 col-xl-6">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <label for="image_account" class="form-label">Ảnh banner <span
                                                                class="text-danger">*</span></label>
                                                        <br />
                                                        <button class="btn-add-single-image btn btn-success w-100"
                                                            type="button">Thêm
                                                            ảnh</button>
                                                        <input type="file" name="banner" id="single-image" hidden>
                                                        <div class="mt-2">
                                                            <div id="banner-preview-container"
                                                                class="image-preview single-image-preview"></div>
                                                        </div>
                                                        @if ($errors->has('banner'))
                                                            <div class="text-danger">
                                                                {{ $errors->first('banner') }}
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="images_account" class="form-label">Ảnh chi tiết</label>
                                                <div class="input-group">
                                                    <input type="file" class="form-control" id="images"
                                                        name="gallery[]" placeholder="Chọn hình ảnh..."
                                                        aria-label="Thêm các ảnh chi tiết" multiple>
                                                    <button class="btn btn-danger btn-clear-gallery"
                                                        type="button">X</button>
                                                </div>
                                                <div class="my-2">
                                                    <div id="preview-container" class="image-preview"></div>
                                                </div>
                                            </div>
                                            <div class="w-100 text-center">
                                                <button type="submit" class="btn btn-success w-30">Tạo mới</button>
                                            </div>
                                        </form>
                                    </div>
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

        $('.btn-clear-gallery').click(function() {
            $('#preview-container > div').remove();
            $('#images').val(null)
        })
    </script>
@endpush
