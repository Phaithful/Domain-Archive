$('#resetForm').submit(function (e) {
    e.preventDefault();

    const password = $('#new_password').val();
    const confirm = $('#confirm_password').val();
    const token = $('#token').val();
    const email = $('#email').val();

    if (password.length < 6) {
        alert('Password must be at least 6 characters.');
        return;
    }

    if (password !== confirm) {
        alert('Passwords do not match.');
        return;
    }

    $.ajax({
        url: '/domain-management-system/Access-Archive/Domain-Archive/auth/reset-password.php',
        method: 'POST',
        data: {
            new_password: password,
            token: token,
            email: email
        },
        dataType: 'json',
        success: function (response) {
            if (typeof response === 'string') response = JSON.parse(response);
            if (response.status === 'success') {
                window.location.href = '../Domain-Archive/successful-reset.php';
            } else {
                alert(response.message || 'Reset failed.');
            }
        },
        error: function () {
            alert('Server error. Please try again.');
        }
    });
});
