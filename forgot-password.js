$('#submit_btn').click(function () {
    const email = $('#email').val().trim();
    console.log("Email being sent:", email);

    if (!email) {
        alert("Please enter your email.");
        return;
    }

$.ajax({
    url: 'auth/forgot-password.php',
    method: 'POST',
    data: { email: email },
    dataType: 'json', // ✅ Tell jQuery to parse the response as JSON
    success: function (response) {
        console.log("Parsed server response:", response);

        if (response.status === 'success') {
            window.location.href = `email-sent.php?email=${encodeURIComponent(email)}`;
        } else {
            alert(response.message || "Something went wrong.");
        }
    },
    error: function (xhr, status, error) {
        console.error("AJAX error:", status, error);
        console.log("Response text:", xhr.responseText); // 📋 Debug actual content
        alert("Server error. Please try again.");
    }
});

});
