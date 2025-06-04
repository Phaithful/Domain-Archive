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

            // Auto-hide the alert after 4 seconds
            const alert = messageDiv.querySelector('.alert');
            if (alert) {
                setTimeout(() => {
                    alert.style.transition = "opacity 0.5s ease";
                    alert.style.opacity = '0';
                    setTimeout(() => {
                        alert.remove();
                    }, 500); // remove from DOM after fade out
                }, 2000); // 2 seconds
            }

            if (data.includes("Login successful")) {
                setTimeout(() => {
                    window.location.href = "../Domain-Archive/admin/dashboard.php";
                }, 2000);
            }
        })

        .catch(error => {
            console.error("Error:", error);
            messageDiv.innerHTML = "<div class='alert alert-danger'>An error occurred. Please try again.</div>";
        });
    });
});
