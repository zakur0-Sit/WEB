document.addEventListener('DOMContentLoaded', () => {
       
    const menuBtn = document.querySelector('.menu-btn');
    const navLinks = document.querySelector('.nav-links');

    menuBtn.addEventListener('click', () => {
    navLinks.classList.toggle('open');
    });

window.addEventListener('resize', () => {
    if (window.innerWidth > 850) {
        navLinks.classList.remove('open');
    }
    });
});