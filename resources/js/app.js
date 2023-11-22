import './bootstrap';
import Alpine from 'alpinejs';

window.Alpine = Alpine;
Alpine.start();

// MENU PC / TABLET / MOVIL
let colorSeleccionado = null;

function aplicarEstilos(id) {
    document.querySelectorAll('.navbar a').forEach(function(el) {
        el.classList.remove('pl-10');
        el.classList.remove('bg-blue-800');
    });
    let primerMenu = document.querySelector('.navbar a.pl-10');
    if (primerMenu) {
        primerMenu.classList.remove('pl-10');
    }
    document.querySelectorAll('.navbar a[data-menu-id="' + id + '"]').forEach(function(el, index) {
        if (index === 0) {
            el.classList.add('pl-10');
        }
        el.classList.add('bg-blue-800');
    });
}

document.querySelectorAll('.navbar a').forEach(function(link) {
    link.addEventListener('click', function() {
        colorSeleccionado = this.dataset.menuId;
        aplicarEstilos(colorSeleccionado);
        guardarColorEnLocalStorage(colorSeleccionado);
    });
});

window.onload = function() {
    colorSeleccionado = localStorage.getItem('ColorDerecha');
    if (colorSeleccionado) {
        document.querySelectorAll('.navbar a').forEach(function(el) {
            el.classList.remove('pl-10');
            el.classList.remove('bg-blue-800');
        });
        document.querySelectorAll('.navbar a[data-menu-id="' + colorSeleccionado + '"]').forEach(function(el, index) {
            if (index === 0) {
                el.classList.add('pl-10');
            }
            el.classList.add('bg-blue-800');
        });
    }
};

function guardarColorEnLocalStorage(color) {
    localStorage.setItem('ColorDerecha', color);
}
