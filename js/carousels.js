/**
 * Slick Carousel/Slider Base Code for Hero Slider on front-page.php
 *
 * 
 * @package Canadian_Climate_Conference
 */

//Slick Carousel/Slider Base Code for Hero Slider on front-page.php
//issue with `$` not registering despite script enqueuing, using `jQuery` until issue sorted
jQuery(document).ready(function(){

    jQuery('.hero-slider').slick({
        dots: false,
        arrows: true,
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        fade: true,

        responsive: [
            {
                breakpoint: 699,
                settings: {
                    autoplay: true,
                    autoplaySpeed: 7000,
                    arrows: false
                }
            },
            {
                breakpoint: 700,
                settings: {
                    autoplay: false,
                    arrows: true
                }
            }
        ]


    })

    jQuery('.speaker-slider').slick({
        dots: false,
        arrows: true,
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        fade: true,
    })
})