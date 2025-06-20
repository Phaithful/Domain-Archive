
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


// '// dark mode toggler
// themeToggler.addEventListener('click', () => {
//     document.body.classList.toggle('dark-theme-variables');

//     themeToggler.querySelector('span:nth-child(1)').classList.toggle('active');
//     themeToggler.querySelector('span:nth-child(2)').classList.toggle('active');
// })







// Apply saved theme on page load
document.addEventListener("DOMContentLoaded", () => {
    const savedTheme = localStorage.getItem("theme");

    if (savedTheme === "dark") {
        document.documentElement.classList.add("dark-theme-variables");
        themeToggler.querySelector('span:nth-child(1)').classList.add('active');
        themeToggler.querySelector('span:nth-child(2)').classList.remove('active');
    } else {
        document.documentElement.classList.remove("dark-theme-variables");
        themeToggler.querySelector('span:nth-child(1)').classList.remove('active');
        themeToggler.querySelector('span:nth-child(2)').classList.add('active');
    }
});

// Dark mode toggler logic
// const themeToggler = document.querySelector(".theme-toggler");

themeToggler.addEventListener('click', () => {
    const isDark = document.documentElement.classList.toggle("dark-theme-variables");


    // Toggle active states for the icons
    themeToggler.querySelector('span:nth-child(1)').classList.toggle('active');
    themeToggler.querySelector('span:nth-child(2)').classList.toggle('active');

    // Save to localStorage
    localStorage.setItem("theme", isDark ? "dark" : "light");
});



