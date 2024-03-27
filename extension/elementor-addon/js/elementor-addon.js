(function ($) {
    /* Start Carousel slider */
    let ElementCarouselSlider = function ($scope, $) {
        let element_slides = $scope.find('.custom-owl-carousel');

        $(document).general_owlCarousel_custom(element_slides);
    };

    $(window).on('elementor/frontend/init', function () {
        /* Element slider */
        elementorFrontend.hooks.addAction('frontend/element_ready/smartcity-slides.default', ElementCarouselSlider);

        /* Element post carousel */
        elementorFrontend.hooks.addAction('frontend/element_ready/smartcity-post-carousel.default', ElementCarouselSlider);

        /* Element testimonial slider */
        elementorFrontend.hooks.addAction('frontend/element_ready/smartcity-testimonial-slider.default', ElementCarouselSlider);

        /* Element carousel images */
        elementorFrontend.hooks.addAction('frontend/element_ready/smartcity-carousel-images.default', ElementCarouselSlider);

        /* custom menu anchor */
        elementorFrontend.hooks.addFilter( 'frontend/handlers/menu_anchor/scroll_top_distance', function( scrollTop ) {
            return scrollTop - 115;
        } );
    });

})(jQuery);