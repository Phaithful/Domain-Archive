// In signup.js
document.addEventListener("DOMContentLoaded", function () {


    // Password Visibility Toggle
    const togglePassword = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('password');

    togglePassword.addEventListener('click', function () {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);

        // Toggle icon
        this.classList.toggle('fa-eye');
        this.classList.toggle('fa-eye-slash');
    });



    const form = document.getElementById("signupForm");
    const messageDiv = document.getElementById("signupMessage");

    if (!form) {
        console.error("Signup form not found");
        return;
    }

    form.addEventListener("submit", function (e) {
        e.preventDefault();
        console.log("Form submission intercepted!");  // DEBUG

        const formData = new FormData(form);

        fetch("auth/signup.php", {
            method: "POST",
            body: formData
        })
        .then(res => res.text())
        .then(data => {
            messageDiv.innerHTML = data;

            const alert = messageDiv.querySelector(".alert");
            if (alert) {
                setTimeout(() => {
                    alert.style.transition = "opacity 0.5s ease";
                    alert.style.opacity = "0";
                    setTimeout(() => alert.remove(), 500);
                }, 4000);
            }

            if (data.includes("Registration successful")) {
                setTimeout(() => {
                    window.location.href = "../Domain-Archive/login.php";
                }, 2000);
            }
        })
        .catch(error => {
            console.error("Error:", error);
            messageDiv.innerHTML = "<div class='alert alert-danger'>An error occurred. Please try again.</div>";
        });
    });
});
