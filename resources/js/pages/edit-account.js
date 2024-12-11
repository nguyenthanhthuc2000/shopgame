const settings = {
    imageInputEle: '#images[name="gallery[]"]',
    previewContainerEle: '#gallery-preview-container',
    maxFiles: 20,
    addedImages: [],
    previewItemsEle: '.preview-item',
    removedGalleryInput: '.removed-gallery-input',
    currentCount: 0,
    getMaxFiles: function () {
        return this.maxFiles - this.getCurrentCount();
    },
    getCurrentCount: function () {
        return this.currentCount;
    },
    setCurrentCount: function () {
        this.currentCount = ($(this.previewItemsEle).length || 0);
    },
    getAddedImages: function () {
        return this.addedImages;
    },
    setAddedImages: function (file) {
        this.addedImages.push(file);
        this.setCurrentCount();
    },
    init: function () {
        this.setCurrentCount();
    }
};

let dt = new DataTransfer();

$(function () {
    settings.init();
    // Init banner
    const singlePreviewContainer = $('#banner-preview-container');
    const existingbanner = singlePreviewContainer.data('existing-image');

    if (existingbanner) {
        const removeBtn = $('<button>&times;</button>');
        removeBtn.on('click', function () {
            $(this).closest('.preview-item').remove();
        });

        singlePreviewContainer.append(removeBtn);
    }

    // Init gallery
    const galleryPreviewContainer = $('#gallery-preview-container');
    const existingGallery = galleryPreviewContainer.find('.preview-item');

    if (existingGallery.length > 0) {
        const removeBtn = $('<button>&times;</button>');
        removeBtn.on('click', handleRemovePreviewGallery);

        galleryPreviewContainer.find('.preview-item').append(removeBtn);
    }
});


$(settings.imageInputEle).on('change', function (event) {
    const files = Array.from(event.target.files);
    const previewContainer = $(settings.previewContainerEle);

    for (const file of files) {
        if (!settings.getAddedImages().some(img => img.name === file.name)) {
            if (settings.getAddedImages().length >= settings.getMaxFiles()) {
                alert('Bạn chỉ có thể thêm tối đa ' + settings.maxFiles + ' ảnh.');
                break;
            }

            settings.setAddedImages(file);
            dt.items.add(file);

            const reader = new FileReader();
            reader.onload = function (e) {
                const div = $('<div></div>').addClass('preview-item');
                const img = $('<img>').attr('src', e.target.result).addClass('preview-img');
                const removeBtn = $('<button>&times;</button>').addClass('remove-btn');


                removeBtn.on('click', function () {
                    const index = addedImages.findIndex(img => img.name === file.name);
                    if (index !== -1) {
                        addedImages.splice(index, 1);
                        dt.items.remove(index);
                        $('#images')[0].files = dt.files;
                        div.remove();
                    }
                });

                div.append(img).append(removeBtn);
                previewContainer.append(div);
            };
            reader.readAsDataURL(file);
        }
    }

    $(settings.imageInputEle)[0].files = dt.files;
});

$('.btn-clear-gallery').on('click', function () {
    $('#preview-container').empty();
    settings.addedImages = [];
    dt = new DataTransfer();
    $('#images')[0].files = dt.files;
    $('#images').val(null);
});


$('.btn-add-single-image').click(function () {
    $('#single-image').click();
});

// For banner
function addPreview(file, container) {
    const reader = new FileReader();
    reader.onload = function (e) {
        const img = $('<img>').attr('src', e.target.result);
        const removeBtn = $('<button>&times;</button>');

        removeBtn.on('click', function () {
            $('#single-image').val('');
            container.empty();
        });

        container.empty();
        container.append(img).append(removeBtn);
    };
    reader.readAsDataURL(file);
}

$('#single-image').on('change', function (event) {
    const file = event.target.files[0];
    const singlePreviewContainer = $('#banner-preview-container');

    if (file) {
        addPreview(file, singlePreviewContainer);
    }
});

function handleRemovePreviewGallery(event) {
    event.preventDefault();
    const $this = $(event.target);
    const removedGalleryInput = $(settings.removedGalleryInput);
    const previewItem = $this.closest(settings.previewItemsEle)
    const imageId = previewItem.find('img').data('image-id');

    let removedGalleryData = removedGalleryInput.val() || '';
    removedGalleryData = removedGalleryData ? `${removedGalleryData};${imageId}` : imageId;
    removedGalleryInput.val(removedGalleryData);
    previewItem.remove();
    settings.setCurrentCount();
}
