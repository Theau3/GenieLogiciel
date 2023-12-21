const sideMenu = document.querySelector('aside');
const menuBtn = document.getElementById('menu-btn');
const closeBtn = document.getElementById('close-btn');

const darkMode = document.querySelector('.dark-mode');

menuBtn.addEventListener('click', () => {
    sideMenu.style.display = 'block';
});

closeBtn.addEventListener('click', () => {
    sideMenu.style.display = 'none';
});

if (localStorage.getItem('dark-mode')) {
    document.body.classList.add('dark-mode-variables');
    darkMode.querySelector('span:nth-child(1)').classList.toggle('active');
    darkMode.querySelector('span:nth-child(2)').classList.toggle('active');
}

darkMode.addEventListener('click', () => {
    if (localStorage.getItem('dark-mode')) {
        localStorage.removeItem('dark-mode');
    } else {
        localStorage.setItem('dark-mode', true);
    }
    location.reload();
})


