(function($) {
    $.fn.filePreview = function(options) {
        // Thiết lập cấu hình mặc định
        const settings = $.extend({
            maxFiles: 20,                     // Giới hạn file tối đa
            previewContainer: '#preview-container', // Container để hiển thị preview
            button: null,                     // Selector của button để trigger input
            hideInput: false                  // Ẩn input file nếu true
        }, options);

        return this.each(function() {
            const $inputFile = $(this);       // `this` là input file
            let addedImages = [];            // Mảng lưu trữ các file đã chọn
            let dt = new DataTransfer();     // Dùng để cập nhật lại input file

            // Xử lý ẩn/hiện input
            if (settings.hideInput) {
                $inputFile.hide();
            } else {
                $inputFile.show();
            }

            // Nếu có button được chỉ định, thêm sự kiện click
            if (settings.button) {
                $(settings.button).on('click', function() {
                    $inputFile.trigger('click');
                });
            }

            // Xử lý sự kiện 'change' khi người dùng chọn file
            $inputFile.on('change', function(event) {
                const files = event.target.files; // Lấy danh sách file từ input
                const previewContainer = $(settings.previewContainer); // Container preview

                for (let i = 0; i < files.length; i++) {
                    const file = files[i];

                    // Kiểm tra nếu file đã tồn tại trong danh sách
                    if (!addedImages.some(img => img.name === file.name)) {
                        if (addedImages.length >= settings.maxFiles) {
                            alert('Bạn chỉ có thể thêm tối đa ' + settings.maxFiles + ' ảnh.');
                            break;
                        }

                        addedImages.push(file); // Thêm file vào danh sách
                        dt.items.add(file); // Thêm file vào DataTransfer

                        const reader = new FileReader();
                        reader.onload = function(e) {
                            const div = $('<div></div>').addClass('preview-item');
                            const img = $('<img>').attr('src', e.target.result).addClass('preview-img');
                            const removeBtn = $('<button>&times;</button>').addClass('remove-btn');

                            // Xử lý xóa file
                            removeBtn.on('click', function() {
                                const index = addedImages.findIndex(img => img.name === file.name);
                                if (index !== -1) {
                                    addedImages.splice(index, 1);  // Xóa file khỏi danh sách
                                    dt.items.remove(index); // Xóa file khỏi DataTransfer
                                    $inputFile[0].files = dt.files; // Cập nhật lại input file
                                    div.remove();  // Xóa preview khỏi giao diện
                                }
                            });

                            div.append(img).append(removeBtn);
                            previewContainer.append(div);
                        };
                        reader.readAsDataURL(file);
                    }
                }

                // Cập nhật lại input với danh sách file mới
                $inputFile[0].files = dt.files;
            });

            // Sự kiện xóa tất cả ảnh trong preview và reset input
            $('.btn-clear-gallery').click(function() {
                $(settings.previewContainer + ' > div').remove();  // Xóa tất cả preview
                addedImages = [];  // Reset danh sách file
                dt = new DataTransfer(); // Reset DataTransfer
                $inputFile[0].files = dt.files;  // Cập nhật lại input file
                $inputFile.val(null);  // Reset giá trị input file
            });
        });
    };
})(jQuery);
