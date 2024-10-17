$(document).ready(function() {
    var navbar = $('.navbar');
    var lastScrollTop = 0;

    $(window).scroll(function() {
        var currentScroll = $(this).scrollTop();

        if (currentScroll > lastScrollTop) {
            // Scrolling down (navbar shrinks or becomes transparent)
            navbar.addClass('navbar-large').removeClass('navbar-small');
        } else {
            // Scrolling up (navbar enlarges or becomes opaque)
            navbar.addClass('navbar-small').removeClass('navbar-large');
        }
        
        // Entferne den Hintergrund (transparent) wenn nach unten gescrollt wird
        if (currentScroll > 100) {
            navbar.removeClass('transparent');
        } else {
            navbar.addClass('transparent');
        }

        lastScrollTop = currentScroll;
    });
});

