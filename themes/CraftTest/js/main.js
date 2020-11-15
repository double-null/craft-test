$('#reg-form').submit(function(e) {
    $('.error').empty();
    var form_data = $(this).serialize();

    $.post('/async_reg/', form_data, function (data) {
        if (data['status'] === 0) {
            if (data['errors']['name']) {
                $('#name-error').text(data['errors']['name']);
            }
            if (data['errors']['email']) {
                $('#email-error').text(data['errors']['email']);
            }
            if (data['errors']['password']) {
                $('#password-error').text(data['errors']['password']);
            }
            if (data['code_error']) {
                $('#code-error').text('Код введён не верно!');
            }
        }
        if (data['status'] === 1) {
            alert('Регистрация прошла успешно! Подтвердите свой e-mail!');
            window.location.href = '/user_listing/';
        }
    }, 'json');

    e.preventDefault();
    return false;
});