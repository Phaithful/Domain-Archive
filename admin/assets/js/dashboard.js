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


// fill recent domains table
Domains.forEach(domain => {

    const expiry = new Date(domain.expiryDate); // Dte must be in YY-MM-DD Format
    const today = new Date();

    const timeDiff = expiry.getTime() - today.getTime();

    // Convert milliseconds to days
    const daysLeft = Math.ceil(timeDiff / (1000 * 60 * 60 * 24));

    // console.log(`Expiry Date: ${expiry.toDateString()}`); // displsay as date in domain page
    console.log(`Days Left: ${daysLeft}`);
    
    if(daysLeft > 30){
        statusColor = "success"
        currStatus = "Active"
    }
    else if(daysLeft > 0 && daysLeft <= 30){
        statusColor = "warning"
        currStatus = "Warning"
    }
    else{
        statusColor = "danger"
        currStatus = "Expired"
    };

    console.log(statusColor)

    const tr = document.createElement('tr');
    const trContent = `
                        <td>${domain.domainName}</td>
                        <td class="${statusColor}">${currStatus}</td>
                        <td>${domain.expiryDate}</td>
                        <td>${domain.autoRenew}</td>
                        <td>${domain.registrar}</td>
                        <td class="primary">Action</td>
                        `

    tr.innerHTML = trContent;
    document.querySelector('table tbody').appendChild(tr);

})





Domains.forEach(domain => {

    
});




