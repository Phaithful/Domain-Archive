document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("add-domain-form");

    form.addEventListener("submit", function (e) {
        e.preventDefault();

        const formData = new FormData(form);

        fetch("auth/add-domain.php", {
            method: "POST",
            body: formData
        })
        .then(res => res.text())
        .then(data => {
            if (data.trim() === 'success') {
                showAnimatedAlert("Domain added successfully!", "success");
                form.reset();
            } else {
                showAnimatedAlert("Error: " + data, "error");
            }
        })
        .catch(error => {
            console.error("Error:", error);
            showAnimatedAlert("A network error occurred. Please try again.", "error");
        });
    });

    // Animated alert
    function showAnimatedAlert(message, type = 'success') {
        const alert = document.createElement('div');
        alert.textContent = message;
        alert.className = `animated-alert ${type}`;
        document.body.appendChild(alert);

        setTimeout(() => {
            alert.classList.add('fade-out');
            alert.addEventListener('transitionend', () => alert.remove());
        }, 3000);
    }



});





















const sideMenu = document.querySelector("aside");
const menuBtn = document.querySelector("#menuBtn")
const closeBtn = document.querySelector("#closeBtn")
const themeToggler = document.querySelector(".theme-toggler")


// show side menu
closeBtn.addEventListener('click', () => {
    sideMenu.classList.remove('showMenu');
    sideMenu.classList.add('closeMenu');
    
    sideMenu.addEventListener('animationend', () => {
        sideMenu.style.display = 'none';
    }, { once: true });
})



// close side menu
menuBtn.addEventListener('click', () => {
    sideMenu.classList.remove('closeMenu');
    sideMenu.classList.add('showMenu');
    sideMenu.style.display = 'block';
})


// dark mode toggler
themeToggler.addEventListener('click', () => {
    document.body.classList.toggle('dark-theme-variables');

    themeToggler.querySelector('span:nth-child(1)').classList.toggle('active');
    themeToggler.querySelector('span:nth-child(2)').classList.toggle('active');
})


