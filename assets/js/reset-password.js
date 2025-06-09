// Toggle password visibility
const togglePassword = document.getElementById('togglePassword');
const passwordInput = document.getElementById('new_password');

togglePassword.addEventListener('click', function () {
    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
    passwordInput.setAttribute('type', type);

    // Toggle icon
    this.classList.toggle('fa-eye');
    this.classList.toggle('fa-eye-slash');
});




// Check if password is strong or weakAdd commentMore actions
// getting password input
$("#new_password").on("input", function () {
    let password = $("#new_password").val();

    // Check password patterns
    let hasLower = /[a-z]/.test(password);
    let hasUpper = /[A-Z]/.test(password);
    let hasNumber = /\d/.test(password);
    let hasSymbol = /[\W_]/.test(password);
    let length = password.length;

    let score = 0;
    if (hasLower) score++;
    if (hasUpper) score++;
    if (hasNumber) score++;
    if (hasSymbol) score++;
    if (length > 8) score++;

    
    // Update password strength bar
    if (password == ""){
        $("#weak").css({background: "#8a8a8a" });
        $("#average").css({background: "#8a8a8a" });
        $("#strong").css({background: "#8a8a8a" });
        $("#password").css('border-bottom-color', '#8a8a8a')
    } else if (score > 0 && score <= 2) {
        $("#weak").css({background: "red" });
        $("#average").css({background: "#8a8a8a" });
        $("#strong").css({background: "#8a8a8a" });
        $("#password").css('border-bottom-color', 'red')
    } else if (score === 3 || score === 4) {
        $("#weak").css({background: "#ffd908" });
        $("#average").css({background: "#ffd908" });
        $("#strong").css({background: "#8a8a8a" });
        $("#password").css('border-bottom-color', '#ffd908')
    } else {
        $("#weak").css({background: "#41b029" });
        $("#average").css({background: "#41b029" });
        $("#strong").css({background: "#41b029" });
        $("#password").css('border-bottom-color', '#41b029')
    }
});





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
