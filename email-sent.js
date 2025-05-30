$(document).ready(function () {

    // first input box is selected as page loads
    $('.otp').first().focus();


    // Strip non-digit characters on input
    $('.otp').on('input', function () {
        this.value = this.value.replace(/\D/g, '');
    });


    // Block paste if it’s not all digits
    $('.otp').on('paste', function (value) {
        const pastedData = value.originalEvent.clipboardData.getData('text');
        if (!/^\d+$/.test(pastedData)) {
            value.preventDefault();
        }
    });

    // Only allow digit keys
    $('.otp').on('keypress', function (value) {
        const charCode = value.which ? value.which : value.keyCode;
        if (charCode < 48 || charCode > 57) {
            value.preventDefault();
        }
    });


    // automaticall moves to next input box after typing
    $('.otp').on('keyup', function () {
        if (this.value.length === this.maxLength) {
            $(this).next('.otp').focus();
        }
    });


    // Backspace automatically moves focus to previous input box
    $('.otp').on('keydown', function (e) {
    if (e.key === 'Backspace' && this.value === '') {
        $(this).prev('.otp').focus();
    }
    });


    // when a user pastes it automaticall pastes in all input boxes (as it supposed to naww oga)
    $('.otp').on('paste', function (e) {
    const pasteData = e.originalEvent.clipboardData.getData('text').replace(/\D/g, '');
    const otpInputs = $('.otp');

    if (pasteData.length === otpInputs.length) {
        e.preventDefault();
        otpInputs.each(function (index) {
        this.value = pasteData.charAt(index);
        });
        otpInputs.last().focus(); // Optional: Focus last input
    }
    });


    // clear code button to clear all code
    $('#clearOtp').click(function () {
        $('.otp').val('');
        $('.otp').first().focus();
    });


    // Auto Submit when all fields are filled up
    $('.otp').on('input', function () {
    const allFilled = $('.otp').toArray().every(input => input.value.length === 1);
    if (allFilled) {
        // Trigger your submit function
        $('.submit').click();
    }
    });


});

// Handle Submit button click
$('.submit').click(function () {
    const otpInputs = $('.otp');
    let otp = '';

    // Concatenate all 6 digits
    otpInputs.each(function () {
        otp += $(this).val();
    });

    if (otp.length !== 6) {
        alert('Please enter all 6 digits of the OTP');
        return;
    }

    // Get the email — either from URL or a hidden input
        const email = $('#user-email').val();


    if (!email) {
        alert("Missing email. Cannot verify OTP.");
        return;
    }

    // Send AJAX request to verify OTP
    $.ajax({
        url: 'auth/verify-otp.php',
        type: 'POST',
        data: {
            otp: otp,
            email: email
        },
        dataType: 'json',
        success: function (response) {
            const res = JSON.parse(response);
            if (res.status === 'success') {
                // Redirect to reset-password page with token
                window.location.href = `reset-password.php?token=${res.token}&email=${res.email}`;
            } else {
                alert(res.message);
            }
        },
        error: function () {
            alert("Something went wrong. Please try again.");
        }
    });
});
