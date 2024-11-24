const signUpButton = document.getElementById('signUp');
const signInButton = document.getElementById('signIn');
const container = document.getElementById('container');

signUpButton.addEventListener('click', () => {
    container.classList.add("right-panel-active");
});

signInButton.addEventListener('click', () => {
    container.classList.remove("right-panel-active");
});

$('#register-form').on('submit', function (e) {
    e.preventDefault();
    const formData = $(this).serialize();

    $.ajax({
        url: $(this).attr('action'),
        type: 'POST',
        data: formData,
        success: function (response) {
            if (response.success) {
                window.location.href = '/';
            }
        },
        error: function (xhr, status, error) {
            const errors = xhr.responseJSON.errors;
            const errorMessage = '';
            $.each(errors, function (key, value) {
                errorMessage += value[0] + '<br>';
            });
            $('#message_register').html('<div class="error">' + errorMessage + '</div>');
        }
    });
});

$('#login-form').on('submit', function (e) {
    e.preventDefault();
    const formData = $(this).serialize();

    $.ajax({
        url: $(this).attr('action'),
        type: 'POST',
        data: formData,
        success: function (response) {
            if (response.success) {
                window.location.href = '/';
            }
        },
        error: function (xhr, status, error) {
            if (xhr.responseJSON && xhr.responseJSON.errors) {
                const errors = xhr.responseJSON.errors;
                let errorMessage = '';
                $.each(errors, function (key, value) {
                    errorMessage += value[0] + '<br>';
                });
                $('#message_login').html('<div class="error">' + errorMessage + '</div>');
            } else if (xhr.responseJSON && xhr.responseJSON.message) {
                $('#message_login').html('<div class="error">' + xhr.responseJSON.message + '</div>');
            }
        }
    });
});
