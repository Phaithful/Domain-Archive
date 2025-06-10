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
}
$('#submit_btn').click(function () {
    const email = $('#email').val().trim();
    console.log("Email being sent:", email);

    if (!email) {
        showNotification("Please enter your email.", "error"); // Use the new function
        return;
    }
    console.log(email);
    $.ajax({
        url: '/domain-management-system/Domain/Domain-Archive/auth/forgot-password.php',
        method: 'POST',
        data: { email: email },
        dataType: 'json',
        success: function (response) {
            console.log("Parsed server response:", response);

            if (response.status === 'success') {
                // Display success message before redirecting
                showNotification("OTP sent! Redirecting to password reset page...", "success");
                
                // Delay redirection slightly to allow user to see the message
                setTimeout(() => {
                    window.location.href = `email-sent.php?email=${encodeURIComponent(email)}`;
                }, 2000); // Redirect after 2 seconds
            } else {
                $('#email').val('');
                showNotification(response.message || "Something went wrong.", "error"); // Use for errors
            }
        },
        error: function (xhr, status, error) {
            console.error("AJAX error:", status, error);
            console.log("Response text:", xhr.responseText);
            showNotification("Server error. Please try again.", "error"); // Use for server errors
        }
    });
});
