document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("loginForm");
    const messageDiv = document.getElementById("loginMessage");

    form.addEventListener("submit", function (e) {
        e.preventDefault();

        const formData = new FormData(form);

        fetch("auth/login.php", {
            method: "POST",
            body: formData
        })
        .then(res => res.text())
        .then(data => {
            messageDiv.innerHTML = data;

            const alert = messageDiv.querySelector('.alert');

            // Clear input fields if login fails (based on known error keywords)
            if (data.includes("Incorrect password") || data.includes("No account found") || data.includes("Invalid email")) {
                form.reset(); // ✅ Clear email & password fields
            }

            // Auto-hide alert after 2 seconds
            if (alert) {
                setTimeout(() => {
                    alert.style.transition = "opacity 0.5s ease";
                    alert.style.opacity = '0';
                    setTimeout(() => {
                        alert.remove();
                    }, 500);
                }, 2000);
            }

            // Redirect on successful login
            if (data.includes("Login successful")) {
                setTimeout(() => {
                    window.location.href = "../Domain-Archive/admin/dashboard.php";
                }, 2000);
            }
        })
        .catch(error => {
            console.error("Error:", error);
            messageDiv.innerHTML = "<div class='alert alert-danger'>An error occurred. Please try again.</div>";
            form.reset(); // Also reset on network error
        });
    });
});
