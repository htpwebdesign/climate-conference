/**
 * Slick Carousel/Slider Base Code for Hero Slider on front-page.php
 *
 * 
 * @package Canadian_Climate_Conference
 */

//Slick Carousel/Slider Base Code for Hero Slider on front-page.php
//issue with `$` not registering despite script enqueuing, using `jQuery` until issue sorted
jQuery(document).ready(function($){

    //home page slider settings
    $('.hero-slider').slick({
        dots: false,
        infinite: true,
        arrows: true,
        fade: true,
        autoplay: false,
        slidesToShow: 1,
        slidesToScroll: 1,

        responsive: [
            {
                breakpoint: 768,
                settings: {
                    arrows: false
                }
            }
        ]


    })

    //checks for window size width, if true, check to see if slick class applied, if also true, ensure set with slick settings. 
    //if not, remove slider
    function handleSlick() {
        if ($(window).width() < 768) {
            if (!$('.speaker-slider').hasClass('slick-initialized')) {
                $('.speaker-slider').slick({
                    dots: false,
                    arrows: true,
                    infinite: true,
                    fade: true,
                    slidesToShow: 1,
                    slidesToScroll: 1,
                })
            }
            else {
                if ($('.speaker-slider').hasClass('slick-initialized')) {
                    $('.speaker-slider').slick('unslick');
                }
            }
        }
    }

    handleSlick();
    $(window).resize(handleSlick);

})