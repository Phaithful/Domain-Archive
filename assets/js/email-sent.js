function showNotification(message, type = 'success') {
    const container = document.getElementById('notification-container');
    if (!container) {
        console.error("Notification container not found!");
        // Fallback to alert if container doesn't exist
        alert(message);
        return;
    }

    const notification = document.createElement('div');
    notification.classList.add('notification');
    notification.classList.add(type); // 'success', 'error', 'info'

    notification.textContent = message;

    container.appendChild(notification);

    // Trigger reflow to ensure animation plays
    void notification.offsetWidth;

    // Show the notification
    notification.classList.add('show');

    // Automatically hide after 5 seconds
    setTimeout(() => {
        notification.classList.remove('show');
        // Remove from DOM after transition completes
        notification.addEventListener('transitionend', () => {
            notification.remove();
        }, { once: true });
    }, 5000); // 5 seconds
};
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
        showNotification('Please enter all 6 digits of the OTP');
        return;
    }

    const email = $('#user-email').val();

    if (!email) {
        showNotification("Missing email. Cannot verify OTP.");
        return;
    }

    // Send AJAX request
    $.ajax({
        url: '/domain-management-system/Domain/Domain-Archive/auth/verify-otp.php',
        method: 'POST',
        data: { otp: otp, email: email },
        dataType: 'json', // ✅ Ensures response is parsed automatically
        success: function (response) {
            console.log("Parsed OTP verification response:", response);

                if (response.status === 'success') {
                    showNotification("OTP verified successfully! Redirecting...", 'success'); // Success notification
                    setTimeout(() => {
                        window.location.href = `../Domain-Archive/reset-password.php?token=${response.token}&email=${encodeURIComponent(response.email)}`;
                    }, 2000); // Delay redirection slightly
                } else {
                    showNotification(response.message || "Verification failed.", 'error'); // Error notification
                    // Optionally clear OTP inputs on error for re-entry
                    $('.otp').val('');
                    $('.otp').first().focus();
                }
            },
        error: function (xhr, status, error) {
            console.error("AJAX error:", status, error);
            console.log("Response text:", xhr.responseText);
            showNotification("Server error. Please try again.");
        }
    });
});
