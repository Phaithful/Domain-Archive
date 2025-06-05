$(document).ready(function () {

    // Auto-focus first input on page load
    $('.otp').first().focus();

    // Strip non-digits on input
    $('.otp').on('input', function () {
        this.value = this.value.replace(/\D/g, '');
    });

    // Block invalid paste data
    $('.otp').on('paste', function (e) {
        const pastedData = e.originalEvent.clipboardData.getData('text');
        if (!/^\d+$/.test(pastedData)) {
            e.preventDefault();
        }
    });

    // Allow only digit keys
    $('.otp').on('keypress', function (e) {
        const charCode = e.which || e.keyCode;
        if (charCode < 48 || charCode > 57) {
            e.preventDefault();
        }
    });

    // Move to next input when filled
    $('.otp').on('keyup', function () {
        if (this.value.length === this.maxLength) {
            $(this).next('.otp').focus();
        }
    });

    // Move to previous input on backspace
    $('.otp').on('keydown', function (e) {
        if (e.key === 'Backspace' && this.value === '') {
            $(this).prev('.otp').focus();
        }
    });

    // Smart paste into all inputs
    $('.otp').on('paste', function (e) {
        const pasteData = e.originalEvent.clipboardData.getData('text').replace(/\D/g, '');
        const otpInputs = $('.otp');

        if (pasteData.length === otpInputs.length) {
            e.preventDefault();
            otpInputs.each(function (index) {
                this.value = pasteData.charAt(index);
            });
            otpInputs.last().focus();
        }
    });

    // Clear button functionality
    $('#clearOtp').click(function () {
        $('.otp').val('');
        $('.otp').first().focus();
    });

    // Auto-submit when all boxes filled
    $('.otp').on('input', function () {
        const allFilled = $('.otp').toArray().every(input => input.value.length === 1);
        if (allFilled) {
            $('.submit').click();
        }
    });

});

// Submit OTP
$('.submit').click(function () {
    const otpInputs = $('.otp');
    let otp = '';

    otpInputs.each(function () {
        otp += $(this).val();
    });

    if (otp.length !== 6) {
        alert('Please enter all 6 digits of the OTP');
        return;
    }

    const email = $('#user-email').val();

    if (!email) {
        alert("Missing email. Cannot verify OTP.");
        return;
    }

    // Send AJAX request
    $.ajax({
        url: '/domain-management-system/Access-Archive/Domain-Archive/auth/verify-otp.php',
        method: 'POST',
        data: { otp: otp, email: email },
        dataType: 'json', // ✅ Ensures response is parsed automatically
        success: function (response) {
            console.log("Parsed OTP verification response:", response);

            if (response.status === 'success') {
                window.location.href = `../Domain-Archive/reset-password.php?token=${response.token}&email=${encodeURIComponent(response.email)}`;
            } else {
                alert(response.message || "Verification failed.");
            }
        },
        error: function (xhr, status, error) {
            console.error("AJAX error:", status, error);
            console.log("Response text:", xhr.responseText);
            alert("Server error. Please try again.");
        }
    });
});
