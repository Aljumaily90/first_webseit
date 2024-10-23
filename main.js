$(document).ready(function() {
    var navbar = $('.navbar');
    var logo = $('#logo');
    var lastScrollTop = 0;
    navbar.addClass('transparent'); // Set the navbar to transparent on load

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
            navbar.addClass('transparent');
            logo.addClass('large'); // Increase logo size when scrolled
        } else {
            navbar.removeClass('transparent');
            
            logo.removeClass('large'); // Reset logo size when at top
        }

        lastScrollTop = currentScroll;
    });
});