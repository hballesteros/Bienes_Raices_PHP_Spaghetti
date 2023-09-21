document.addEventListener('DOMContentLoaded', function() {
    eventListeners();
    darkMode();
});

function darkMode() {

    const prefiereDarkMode = window.matchMedia('(prefers-color-scheme: dark)');
    const botonDarkMode = document.querySelector('.dark-mode-boton');
    let src = botonDarkMode.getAttribute('src');

    if( prefiereDarkMode.matches && localStorage.getItem('dark-mode') === 'true' ) {
        document.body.classList.add('dark-mode');
        src = src.replace('light-mode.svg', 'dark-mode.svg');
    } else {
        document.body.classList.remove('dark-mode');
        src = src.replace('dark-mode.svg', 'light-mode.svg');
    }
    botonDarkMode.style.display = 'block';
    botonDarkMode.setAttribute('src', src);

    prefiereDarkMode.addEventListener('change', function() {
        if( prefiereDarkMode.matches ) {
            document.body.classList.add('dark-mode');
            src = src.replace('light-mode.svg', 'dark-mode.svg');
        } else {
            document.body.classList.remove('dark-mode');
            src = src.replace('dark-mode.svg', 'light-mode.svg');
        }
    });
    botonDarkMode.setAttribute('src', src);
    botonDarkMode.style.display = 'block';

    botonDarkMode.addEventListener('click', function() {
        document.body.classList.toggle('dark-mode');
        botonDarkMode.classList.toggle('active');

        // Guardamos el modo en local storage
        if (document.body.classList.contains('dark-mode')) {
            localStorage.setItem('dark-mode', 'true');
            src = src.replace('light-mode.svg', 'dark-mode.svg');
        } else {
            localStorage.setItem('dark-mode', 'false');
            src = src.replace('dark-mode.svg', 'light-mode.svg');
        }

        botonDarkMode.setAttribute('src', src);
        botonDarkMode.style.display = 'block';
    });
}

function eventListeners() {
    const mobileMenu = document.querySelector('.mobile-menu');
    mobileMenu.addEventListener('click', navegacionResponsive);
}

function navegacionResponsive() {
    const navegacion = document.querySelector('.navegacion');
    navegacion.classList.toggle('mostrar');
}
