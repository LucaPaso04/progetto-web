document.getElementById('btn-theme-toggle').addEventListener('click', () => {
    const htmlElement = document.documentElement;
    const icon = document.getElementById('theme-icon');

    if(htmlElement.getAttribute('data-bs-theme') === 'dark') {
        htmlElement.setAttribute('data-bs-theme', 'light');
        icon.className = 'bi bi-moon-fill';
    }
    else{
        htmlElement.setAttribute('data-bs-theme', 'dark');
        icon.className = 'bi bi-sun-fill';
    }
});