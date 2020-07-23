(function($) {
  var jq = jQuery.noConflict();
  jq(document).ready(function() {
    // var columnsSlides = jq(".njt-reviews-carousel-column").data("column");
    // var carouselAutoplay= jq(".njt-google-places-reviews-wap").data("carousel-autoplay");
    // var carouselAutoplaySpeed = jq(".njt-google-places-reviews-shortcode .njt-google-places-reviews-wap").data("carousel-speed");
    jq(".btn-reivew").toggle(
      function() {
        var id = jq(this).data("id");

        jq(this).text("Read less");

        jq("#" + id + " .review-item-long").show();

        jq("#" + id + " .review-item-short").hide();
      },
      function() {
        var id = jq(this).data("id");

        jq(this).text("Read more");

        jq("#" + id + " .review-item-long").hide();

        jq("#" + id + " .review-item-short").show();
      }
    );
    jQuery('.njt-google-places-reviews-wap[data-id]').each(function(index){
      var thisElement = this

      var columnsSlides = jQuery(thisElement).find(".njt-reviews-carousel-column").data("column");
      var carouselAutoplay= jQuery(thisElement).data("carousel-autoplay");
      var carouselAutoplaySpeed = jQuery(thisElement).data("carousel-speed");
      
      jQuery(thisElement).find('.njt-reviews-carousel-wrap').slick({
        show: 1,
        slidesToShow: columnsSlides,
        slidesToScroll: columnsSlides,
        responsive: [
          {
            breakpoint: 600,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1
            }
          },
        ],
        prevArrow: '<div class="njt-gr-slick-prev"></div>',
        nextArrow: '<div class="njt-gr-slick-next"></div>',
        dots: false,
        autoplay: carouselAutoplay == true ? true : false,
        autoplaySpeed: carouselAutoplaySpeed ? Number(carouselAutoplaySpeed) : 3000
      })
    })
    // jq(".njt-reviews-carousel-wrap").slick({
    //   show: 1,
    //   slidesToShow: columnsSlides,
    //   slidesToScroll: columnsSlides,
    //   prevArrow: '<div class="njt-gr-slick-prev"></div>',
    //   nextArrow: '<div class="njt-gr-slick-next"></div>',
    //   dots: false,
    //   autoplay: carouselAutoplay == true ? true : false,
    //   autoplaySpeed: carouselAutoplaySpeed ? Number(carouselAutoplaySpeed) : 3000
    // });
  });
})(jQuery);
