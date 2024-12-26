
$(function () {
	$('.btn-delete').on('click', confirmDelete)
})

function confirmDelete(event) {
	event.preventDefault();
	Swal.fire({
		title: 'Bạn có chắc chắn?',
		text: "Hành động này không thể hoàn tác!",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#d33',
		cancelButtonColor: '#3085d6',
		confirmButtonText: 'Xóa',
		cancelButtonText: 'Hủy'
	}).then((result) => {
		if (result.isConfirmed) {
			const uuid = $(event.currentTarget).data('id');
			const url = $(event.currentTarget).data('url');
			handleDelete(url, uuid);
		}
	});
}

function handleDelete(url, uuid) {
	$.ajax({
		url: url,
		type: 'delete',
		success: function (response) {
			Swal.fire({
				title: 'Thông báo!',
				text: response.message,
				icon: response.status,
				confirmButtonColor: '#3085d6',
				confirmButtonText: 'OK'
			});
			setTimeout(() => {
				window.location.reload();
			}, 2000);
		},
		error: function (error) {
			Swal.fire({
				title: 'Thông báo!',
				text: error.message || '{{ __("messages.common_error") }}',
				icon: error.status || 'error',
				confirmButtonColor: '#3085d6',
				confirmButtonText: 'OK',
			});
		},
	})
}
