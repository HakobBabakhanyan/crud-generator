window.jquery = $ = require('jquery');
window.Swiper = require('swiper/js/swiper.min');

require('./custom');
var mySwiper = new Swiper ('.slider-home', {
    // Optional parameters
    // direction: 'vertical',
    loop: true,

    // If we need pagination
    pagination: {
        el: '.swiper-pagination',
    },
    // Navigation arrows
    navigation: {
        nextEl: '.slider-home-next',
        prevEl: '.slider-home-prev',
    },

    // And if we need scrollbar
    scrollbar: {
        el: '.swiper-scrollbar',
    },
});

//
// new Swiper('.slider-school-services',{
//     direction:"horizontal",
//     slidesPerView:4,
//     slidesPerColumn:2,
//     slidesPerColumnFill:'row',
//     scrollbar: {
//         el: '.swiper-school',
//     },
// });

new Swiper ('.slider-school-services', {
    loop: true,
    pagination: {
        el: '.swiper-school',
        clickable: 'true',
        bulletElement:'button'
    }

});

new Swiper('.slider-new-sport-complex', {
    slidesPerView: 6,
    spaceBetween: 25,
    navigation: {
        nextEl: '.new-sport-complex-button-next',
        prevEl: '.new-sport-complex-button-prev',
    },

});
