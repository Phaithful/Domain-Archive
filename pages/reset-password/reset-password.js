$(document).ready(function () {

    // when submit button is clicked
    $('#resetForm').submit(function (e) {
        e.preventDefault();

        const password = $('#new_password').val();
        const confirm = $('#confirm_password').val();
        const token = $('#token').val();
        const email = $('#email').val();
        const error = $("#cPasswordError");


        // check if confirm password match password
        if (confirm != password) {
            error.html("Password Doesn't Match!").css("color", "red").fadeIn();
            $("submitBtn").prop('diasble', true);
            $("submitBtn").css('background-color', 'rgba: (0, 0, 0, 0.2)')
        }
        else{
            error.html("Password Match").css("color", "green").fadeIn();
            $("submitBtn").prop('diasble', false);
            }

            


        $.ajax({
            url: 'auth/reset-password.php',
            type: 'POST',
            data: {
                new_password: password,
                token: token,
                email: email
            },
            dataType: 'json',
            success: function (response) {
                if (typeof response === 'string') response = JSON.parse(response);
                if (response.status === 'success') {
                    alert('Password reset successful!');
                    window.location.href = 'login.php';
                } else {
                    alert(response.message || 'Reset failed.');
                }
            },
            error: function () {
                alert('Server error. Please try again.');
            }
        });
    });



    // Check if password is strong or weak
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



    // visiblity function
    $("#togglePassword").on("click", function () {
        const password = $("#new_password");
        const type = password.attr("type") === "password" ? "text" : "password";
        password.attr("type", type);

        // Toggle the icon
        $(this).toggleClass("fa-eye fa-eye-slash");
    });

    
})
