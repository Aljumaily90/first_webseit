$(document).ready(function() {
    let navbar = $('.navbar');
    let logo = $('#logo');
    let lastScrollTop = 0;

    if ($(window).width() > 768) {
        navbar.addClass('transparent');
        logo.addClass('large');

        $(window).scroll(function() {
            let currentScroll = $(this).scrollTop();

            if (currentScroll > lastScrollTop) {
                navbar.addClass('navbar-large').removeClass('navbar-small');
                
            } else {
                navbar.addClass('navbar-small').removeClass('navbar-large');
            }
            
            if (currentScroll > 100) {
                navbar.addClass('transparent');
                logo.removeClass('large');
                
            } else {
                navbar.addClass('transparent');
                logo.addClass('large');
            }

            lastScrollTop = currentScroll;
        });
    }
});
document.getElementById('contactForm').addEventListener('submit', function(event) {
    // Verhindert das automatische Absenden, wenn Felder fehlen
    event.preventDefault();
    
    // Führe Validierung durch
    let name = document.getElementById('name').value;
    let email = document.getElementById('email').value;
    let telefon = document.getElementById('telefon').value;
    let nachricht = document.getElementById('nachricht').value;
    
    if (name === "" || email === "" || telefon === "" || nachricht === "") {
        alert("Bitte füllen Sie alle Felder aus!");
        return;
    }
    
    // Wenn die Validierung erfolgreich ist, sende das Formular
    this.submit();
});

$(document).ready(function() {
    // Holt den Pfad der aktuellen URL
    const currentPath = window.location.pathname;

    // Schleife durch alle Navigation-Links und überprüft die Übereinstimmung
    $('.navbar-nav .nav-link').each(function() {
        const linkPath = $(this).attr('href');
        if (linkPath === currentPath) {
            $(this).addClass('active'); // Fügt die Klasse "active" hinzu
        }
    });
});


