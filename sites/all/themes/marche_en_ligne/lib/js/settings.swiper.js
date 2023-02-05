Drupal.behaviors.drupalBookOwlCarousel = {
  attach: function (context, settings) {

    const slider = document.querySelector('.views-slideshow-controls-bottom');
    const sliderWrap = document.getElementById('widget_pager_bottom_views_slideshow_ad-block_1');
    const slides = document.querySelectorAll('.views-slideshow-pager-field-item');
    const Test = document.querySelector('.view-id-views_slideshow_ad');
    const nextArrow = document.createElement('div');
    const prevArrow = document.createElement('div');
    nextArrow.classList.add('swiper-button-next');
    prevArrow.classList.add('swiper-button-prev');
    Test.append(prevArrow, nextArrow);

    slides.forEach((slide) => {
      slide.classList.add('swiper-slide');
    });
    slider.classList.add('swiper');
    sliderWrap.classList.add('swiper-wrapper');


  const swiper = new Swiper('.swiper', {
    // Optional parameters
    direction: 'horizontal',
    loop: false,
    slidesPerView: 4,
    spaceBetween: 15,
    hashNav:false,

    // If we need pagination
    // pagination: {
    //   el: '.swiper-pagination',
    // },

    // Navigation arrows
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },

    // And if we need scrollbar

  });

  }
};
