/**
 * Attach event when document is ready!
 */
(function($) {
    $(function() {

        function initGallery() {

            for (var i = 0; i < carouselGalleries.length; i++) {

                var gallery = carouselGalleries[i];

                gallery.selector = '#tx-carouselgallery-' + gallery.id;
                gallery.rootElement = $(gallery.selector);
                gallery.bodyElement = gallery.rootElement.find('.swiper-wrapper');

                for (var j = 0; j < gallery.images.length; j++) {
                    var slide = $('<div class="swiper-slide swiper-lazy"></div>')
                        .attr('data-background', gallery.images[j].enlarged)
                        .append('<div class="swiper-lazy-preloader"></div>');

                    gallery.bodyElement.append(slide);
                }

                gallery.swiper = new Swiper(gallery.rootElement.selector, {
                    pagination: '.swiper-pagination',
                    nextButton: '.swiper-button-next',
                    prevButton: '.swiper-button-prev',

                    loop: gallery.loop,
                    speed: gallery.transitionTime,
                    autoplay: gallery.waitTime, // @todo : implement gallery.autoplay setting
                    autoplayDisableOnInteraction: gallery.autoReplay,
                    slidesPerView: gallery.slidesPerView,

                    spaceBetween: gallery.margin,
                    paginationClickable: true,
                    keyboardControl: true,
                    centeredSlides: true,
                    grabCursor: true,

                    preloadImages: false,
                    lazyLoading: true,
                    lazyLoadingInPrevNext: true,

                    freeMode: gallery.freeMode,
                    freeModeSticky: true
                });

            }

        }

        initGallery();

    });
})(jQuery);
