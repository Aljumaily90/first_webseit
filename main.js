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



