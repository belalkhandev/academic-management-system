(function ($) {
    "use strict";

    /*at document loading time*/ 
    jQuery(document).ready(function ($) {

        //active owl-carousel
        if ($('#welcomeSlider').length > 0) {
            $("#welcomeSlider").owlCarousel({
                items: 1,
                autoplay: true,
                loop: true,
                autoplayTimeout: 10000,
                // nav: false,
                // navText: ['<i class="fas fa-angle-left">', '<i class="fas fa-angle-right">'],
                dots: true
            });
        }

        // active responsive menu
        $('#mainMenu').slicknav({
            prependTo: '#responsive_menu',
            label: ''
        });

		
    });
    
    /*at window loading time*/    
    jQuery(window).load(function () {
        
    });
    
}(jQuery));