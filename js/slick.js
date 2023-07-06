/**
 * Slick Carousel/Slider Base Code for Hero Slider
 *
 * 
 * @package Canadian_Climate_Conference
 */


$(document).ready(function(){

    $('.hero-slider').slick({
        dots: false,
        arrows: true,
        infinite: false,
        slidesToShow: 1,
        slidesToScroll: 1,
        fade: true
    })
})