/**
 * FatPortfolio - Version 1.17
 * Copyright 2016, RoninWP
 * http://roninwp.com
 */
"use strict";
(function ($) {
    var FatPortfolio = new function () {
        this.$loading_gallery = 0;
        this.$loading_portfolio = 0;
        this.$media_cache = [];
        this.$waterwheel = [];
        this.$waterwheel_options = {
            flankingItems: 3,
            movedToCenter: function ($newCenterItem) {
                var $container = $($newCenterItem).closest('.fat-3d-carousel'),
                    $style = $newCenterItem.attr('style'),
                    $fat_thumbnail = $($newCenterItem).closest('.fat-thumbnail');

                $('.fat-thumbnail', $container).removeClass('waterwheel-active');
                $('.fat-hover-wrap', $container).css('opacity', '1 !important');
                setTimeout(function () {
                    $fat_thumbnail.addClass('waterwheel-active');
                    $('.fat-hover-wrap', $container).attr('style', '');
                    $('.fat-hover-wrap', $container).css('opacity', '0');
                    $('.fat-hover-wrap', $fat_thumbnail).attr('style', $style);
                    $('.fat-hover-wrap', $fat_thumbnail).css('opacity', '');
                }, 200);
            }
        };

        this.init = function () {
            $('.fat-portfolio-shortcode.filter-isotope, .fat-portfolio-shortcode.layout-masonry, .fat-portfolio-shortcode.metro').each(function () {
                FatPortfolio.initIsotope($(this));
            });

            $('.fat-portfolio-shortcode.layout-carousel').each(function () {
                FatPortfolio.initCarousel($(this));
            });

            $('.fat-portfolio-shortcode.layout-flipster').each(function () {
                FatPortfolio.initFlipster($(this));
            });

            $('.fat-portfolio-shortcode.layout-3d-carousel').each(function () {
                FatPortfolio.init3DCarousel($(this));
            });

            FatPortfolio.initAnimation();
            this.initSlideShow();
            this.init_isotope_filter();
            this.init_paging();
            this.initLightBoxGallery();
            this.initSocialShare();

        };

        this.initSlideShow = function(){
            $('.owl-carousel.main-slide','.fat-portfolio-shortcode.layout-slideshow').each(function(){
                var self = $(this),
                    container = self.closest('.fat-portfolio-shortcode.layout-slideshow'),
                    auto_height = self.attr('data-auto-height') === '1' ? true: false;
                if ($.isFunction($.fn.owlCarousel)) {
                    $(self).imagesLoaded(function(){
                        self.owlCarousel({
                            items: 1,
                            nav: true,
                            navText: ['<i class="fa fa-long-arrow-left"></i> ', ' <i class="fa fa-long-arrow-right"></i>'],
                            dots: false,
                            loop: false,
                            margin: 0,
                            autoHeight: auto_height,
                            onTranslated:function(event){
                                var $index = event.item.index,
                                    $a_nav = $('a[data-index="' + $index + '"]'),
                                    $thumb_slide = $(".thumb-slide", container);
                                $('.thumb', container).removeClass('active');
                                $a_nav.parent().addClass('active');
                                $thumb_slide.trigger('to.owl.carousel', [$index, 300]);                }
                        });
                    })
                }else{
                    FatPortfolio.showNotified('Owl Carousel library not found. Please do not check "Owl-Carousel" in Portfolio -> Settings', 8000);
                }

            });
            $('.owl-carousel.thumb-slide','.fat-portfolio-shortcode.layout-slideshow').each(function(){
                var self = $(this),
                    container = self.closest('.fat-portfolio-shortcode.layout-slideshow');
                if ($.isFunction($.fn.owlCarousel)) {
                    $(self).imagesLoaded(function(){
                        self.owlCarousel({
                            items: 4,
                            nav: true,
                            navText: ['<i class="fa fa-long-arrow-left"></i> ', ' <i class="fa fa-long-arrow-right"></i>'],
                            margin: 15,
                            dots: false,
                            loop: false,
                            responsive:{
                                0:{
                                    items:2,
                                },
                                768:{
                                    items:3
                                },
                                992:{
                                    items:4
                                }
                            },
                            onInitialized: function () {
                                $('a.nav-thumb','.thumb-slide').bind('click',function () {
                                    var index = $(this).attr('data-index');
                                    index = parseInt(index);
                                    $(".thumb-slide", container).attr('data-current-index', index);
                                    $(".main-slide", container).trigger('to.owl.carousel', [index, 300]);
                                })
                            }
                        });
                    });
                }else{
                    FatPortfolio.showNotified('Owl Carousel library not found. Please do not check "Owl-Carousel" in Portfolio -> Settings', 8000);
                }
            });

        };

        this.showNotified = function ($message, $delay_time) {
            $('body').append('<div class="fat-portfolio-notified">' + $message + '</div>');
            $delay_time = typeof $delay_time != 'undefined' && !isNaN($delay_time) ? $delay_time : 5000;
            setTimeout(function () {
                $('.fat-portfolio-notified', 'body').fadeOut(function () {
                    $('.fat-portfolio-notified', 'body').remove();
                })
            }, $delay_time);
        };

        this.initCarousel = function ($container) {
            if ($.isFunction($.fn.owlCarousel)) {
                $('.owl-carousel', $container).trigger('destroy.owl.carousel');
                $('.owl-carousel', $container).each(function () {
                    var $owl = $(this),
                        defaults = {
                            items: 4,
                            nav: false,
                            navText: ['<i class="fa fa-angle-left"></i> ', ' <i class="fa fa-angle-right"></i>'],
                            dots: false,
                            loop: true,
                            center: false,
                            mouseDrag: true,
                            touchDrag: true,
                            pullDrag: true,
                            freeDrag: false,
                            margin: 0,
                            stagePadding: 0,
                            merge: false,
                            mergeFit: true,
                            autoWidth: false,
                            startPosition: 0,
                            rtl: false,
                            smartSpeed: 250,
                            autoplay: false,
                            autoplayTimeout: 0,
                            fluidSpeed: false,
                            dragEndSpeed: false,
                            autoplayHoverPause: true
                        };
                    var config = $.extend({}, defaults, $owl.data("owl-options"));
                    // Initialize Slider
                    $($owl).imagesLoaded(function(){
                        $owl.owlCarousel(config);
                    });
                });
            } else {
                FatPortfolio.showNotified('Owl Carousel library not found. Please do not check "Unload Owl-Carousel" in Portfolio -> Settings', 8000);
            }
        };

        this.initFlipster = function ($container) {
            var $loop = $($container).attr('data-loop'),
                $autoplay = $($container).attr('data-autoplay'),
                $style = $($container).attr('data-style'),
                $spacing = $($container).attr('data-spacing'),
                $pause = $($container).attr('data-pause'),
                $nav = $($container).attr('data-show-nav');

            $autoplay = typeof $autoplay != undefined && !isNaN($autoplay) && parseInt($autoplay) > 0 ? parseInt($autoplay) : false;

            if ($.isFunction($.fn.flipster)) {
                $($container).imagesLoaded(function () {
                    $('.fat-flipster', $container).flipster({
                        style: $style,
                        start: 'center',
                        autoplay: $autoplay,
                        fadeIn: 1000,
                        pauseOnHover: $pause,
                        loop: $loop,
                        spacing: $spacing,
                        buttons: $nav,
                        scrollwheel: false
                    });
                });
            } else {
                FatPortfolio.showNotified('Flipster library not found. Please do not check "Unload flipster carousel" in Portfolio -> Settings', 8000);
            }
        };

        this.init3DCarousel = function ($container) {
            $($container).imagesLoaded(function () {
                if ($.isFunction($.fn.waterwheelCarousel)) {
                    FatPortfolio.$waterwheel[$container.attr('id')] = $('.fat-3d-carousel .fat-item-wrap', $container).waterwheelCarousel(FatPortfolio.$waterwheel_options);
                    setTimeout(function () {
                        $('.fat-3d-carousel .fat-portfolio-item .fat-thumbnail', $container).each(function () {
                            var $style = $('img', this).attr('style'),
                                $image_center = $('img.carousel-center', $container),
                                $style = $image_center.attr('style'),
                                $fat_thumbnail = $($image_center).closest('.fat-thumbnail');
                            $(this).css('opacity', 1);
                            $fat_thumbnail.addClass('waterwheel-active');
                            $('.fat-hover-wrap', $fat_thumbnail).attr('style', $style);
                        });
                        $('.fat-hover-wrap', $container).attr('style', '');
                    }, 800);
                } else {
                    FatPortfolio.showNotified('Waterwheel Carousel library not found. Please do not check "Unload Waterwheel Carousel" in Portfolio -> Settings', 8000);
                }
            })
        };

        this.initAnimation = function () {
            $('.fat-portfolio-shortcode:not(.layout-flipster)').each(function(){
                if($(this).hasClass('has-animation')){
                    $('.fat-portfolio-item', this).addClass('has-infinite');
                    FatPortfolio.initAppearScroll($(this));
                }else{
                    $('.fat-portfolio-item', this).addClass('infinited');
                }
            });
        };

        this.initSocialShare = function () {
            $('.fat-share').each(function () {
                var $fat_share = $(this),
                    $share_popup = $('.social-share', this);
                if ($.isFunction($.fn.jsSocials)) {
                    $($share_popup).jsSocials(
                        {
                            shares: ["twitter", "facebook", "googleplus", "pinterest", "email"],
                            url: $(this).attr('data-url'),
                            text: $(this).attr('data-title'),
                            showLabel: false,
                            shareIn: "popup",
                        });
                }
                $('a.show-social-share', $fat_share).off('click').on('click', function (event) {
                    if ($share_popup.hasClass('show-popup')) {
                        $share_popup.removeClass('show-popup');
                    } else {
                        $('.social-share', '.fat-share').removeClass('show-popup');
                        $share_popup.addClass('show-popup');
                    }
                    event.preventDefault();
                    return false;
                });
                $('body, .fat-share .jssocials-shares a').click(function () {
                    $('.fat-share .social-share').removeClass('show-popup');
                });
            });
        };

        this.initLightBoxGallery = function () {

            $('a.fat-view-gallery.magnific-popup, a.fat-view-gallery.light-gallery').off('click');
            $('a.fat-view-gallery.magnific-popup, a.fat-view-gallery.light-gallery').on('click', function (event) {

                if (event) {
                    event.preventDefault();
                }

                if (FatPortfolio.$loading_gallery == 1) {
                    return;
                }
                FatPortfolio.$loading_gallery = 1;
                var $this = $(this),
                    $post_id = $this.attr('data-post-id'),
                    $post_title = $this.attr('data-post-title'),
                    $media = {},
                    $guid = $this.attr('data-guid'),
                    $item = $('#fat-item-' + $guid, '#fat-short-code-' + $guid),
                    $fat_thumbnail = $('#fat-thumbnail-' + $post_id, $item),
                    $title_image_popup = '';

                if (typeof $(this).closest('.fat-portfolio-shortcode') != 'undefined') {
                    $title_image_popup = $(this).closest('.fat-portfolio-shortcode').attr('data-title-image-popup');
                }
                $title_image_popup = typeof $title_image_popup != 'undefined' && $title_image_popup != '' ? $title_image_popup : 'image_title';

                if (typeof FatPortfolio.$media_cache[$post_id] == 'undefined') {
                    $this.addClass('show-effect');
                    $fat_thumbnail.addClass('show-hover');
                    $.ajax({
                        url: fat_ajax.ajaxurl,
                        type: 'GET',
                        data: ({
                            action: 'fat_portfolio_load_gallery',
                            post_id: $post_id
                        }),
                        success: function (data) {
                            FatPortfolio.$loading_gallery = 0;
                            $media = JSON.parse(data);
                            /** for wordpress media **/
                            if ($media.media_source == 'media') {
                                $this.removeClass('show-effect');
                                $fat_thumbnail.removeClass('show-hover');
                                FatPortfolio.$media_cache[$post_id] = $media;
                                if ($this.hasClass('magnific-popup')) {
                                    FatPortfolio.show_dynamic_maginific_popup($this, $media);
                                } else {
                                    FatPortfolio.show_dynamic_light_box($this, $media);
                                }
                                FatPortfolio.$loading_gallery = 0;
                            }

                            /** for flickr media **/
                            if ($media.media_source == 'flickr') {
                                $this.removeClass('show-effect');
                                $fat_thumbnail.removeClass('show-hover');
                                FatPortfolio.$media_cache[$post_id] = $media;
                                if ($media.media_type == 'video') {
                                    if ($this.hasClass('magnific-popup')) {
                                        FatPortfolio.show_dynamic_maginific_popup($this, $media);
                                    } else {
                                        FatPortfolio.show_dynamic_light_box($this, $media);
                                    }
                                    FatPortfolio.$loading_gallery = 0;
                                } else {
                                    FatPortfolio.getFlickrImage($media.flickr_filter, function ($images) {

                                        if ($title_image_popup == 'portfolio_title') {
                                            for (var $i = 0; $i < $images.length; $i++) {
                                                $images[$i].subHtml = $post_title;
                                            }
                                        }

                                        $media.galleries = $images;
                                        FatPortfolio.$media_cache[$post_id] = $media;
                                        if ($this.hasClass('magnific-popup')) {
                                            FatPortfolio.show_dynamic_maginific_popup($this, $media);
                                        } else {
                                            FatPortfolio.show_dynamic_light_box($this, $media);
                                        }
                                        FatPortfolio.$loading_gallery = 0;
                                    });
                                }

                            }

                            /** for instagram media **/
                            if ($media.media_source == 'instagram') {
                                $this.removeClass('show-effect');
                                $fat_thumbnail.removeClass('show-hover');
                                FatPortfolio.$media_cache[$post_id] = $media;
                                if ($media.media_type == 'video') {
                                    if ($this.hasClass('magnific-popup')) {
                                        FatPortfolio.show_dynamic_maginific_popup($this, $media);
                                    } else {
                                        FatPortfolio.show_dynamic_light_box($this, $media);
                                    }
                                    FatPortfolio.$loading_gallery = 0;
                                } else {
                                    FatPortfolio.getInstagramImage($media.instagram_filter, function ($images) {
                                        if ($title_image_popup == 'portfolio_title') {
                                            for (var $i = 0; $i < $images.length; $i++) {
                                                $images[$i].subHtml = $post_title;
                                            }
                                        }
                                        $media.galleries = $images;
                                        FatPortfolio.$media_cache[$post_id] = $media;
                                        if ($this.hasClass('magnific-popup')) {
                                            FatPortfolio.show_dynamic_maginific_popup($this, $media);
                                        } else {
                                            FatPortfolio.show_dynamic_light_box($this, $media);
                                        }
                                        FatPortfolio.$loading_gallery = 0;
                                    });
                                }
                            }



                        },
                        error: function () {
                            $this.removeClass('show-effect');
                            $fat_thumbnail.removeClass('show-hover');
                            FatPortfolio.$loading_gallery = 0;
                        }
                    });
                } else {
                    $media = FatPortfolio.$media_cache[$post_id];
                    if ($this.hasClass('magnific-popup')) {
                        FatPortfolio.show_dynamic_maginific_popup($this, $media);
                    } else {
                        FatPortfolio.show_dynamic_light_box($this, $media);
                    }
                    FatPortfolio.$loading_gallery = 0;
                }

                return false;
            });

            $('.fat-portfolio-shortcode.full-gallery a.fat-view-gallery.light-gallery').off('click').on('click',function(event){
                event.preventDefault();
                var self = $(this),
                    img_url = $(self).attr('href'),
                    parent_class = $(this).closest('div').attr('class'),
                    index = 0,
                    start_index = 0,
                    $galleries = [],
                    thumb = '',
                    item = '';

                $('.fat-portfolio-shortcode.full-gallery .' + parent_class + ' a.fat-view-gallery.light-gallery').each(function(){
                    item = jQuery(this).closest('.fat-portfolio-item');
                    thumb = $('img',item).attr('src');
                    if(jQuery(this).attr('href') == img_url){
                        start_index = index;
                    }
                    $galleries.push({
                        'src': jQuery(this).attr('href'),
                        'thumb': thumb,
                        'subHtml': jQuery(this).attr('data-post-title')
                    });
                    index++;

                });
                $(self).lightGallery({
                    downloadUrl: false,
                    dynamic: true,
                    dynamicEl: $galleries,
                    hash: false,
                    share: true,
                    zoom: true,
                    actualSize: true,
                    index: start_index,
                    counter: true
                });
                return false;
            });

            $('a.nav-slideshow','.layout-slideshow .main-slide').off('click').on('click',function(event){
                event.preventDefault();

                var $self = $(this),
                    $container = $self.closest('.layout-slideshow .main-slide'),
                    $media = {'media_type': 'magnific-popup',  galleries: []};
                $('a.nav-slideshow', $container).each(function(){
                    $media.galleries.push({
                        'subHtml' : $(this).attr('data-title'),
                        'thumb' : $(this).attr('data-thumb'),
                        'src': $(this).attr('href'),
                        'iframe' : false
                    });

                });

                FatPortfolio.show_dynamic_light_box($self, $media);

                return false;
            })
        };

        this.show_dynamic_light_box = function ($elm, $media) {
            var $media_type = $media.media_type,
                $galleries = $media.galleries,
                $index = 0,
                current_url = $($elm).attr('href');

            for(var $i=0; $i<$galleries.length; $i++){
                if($galleries[$i].src === current_url){
                    $index = $i;
                    break;
                }
            }
            if ($.isFunction($.fn.lightGallery)) {
                var $lg = $($elm).lightGallery({
                    downloadUrl: false,
                    share: true,
                    dynamic: true,
                    dynamicEl: $galleries,
                    hash: false,
                    index: $index
                });
                $lg.on('onAfterOpen.lg', function (event, index) {
                    $('.lg-thumb-outer').css('opacity', '0');
                    setTimeout(function () {
                        $('.lg-has-thumb').removeClass('lg-thumb-open');
                        $('.lg-thumb-outer').css('opacity', '1');
                    }, 700);

                });
            } else {
                FatPortfolio.showNotified('LighGallery library not found. Please do not check "Unload Light Gallery" in Portfolio -> Settings');
            }

        };

        this.show_dynamic_maginific_popup = function ($elm, $media) {
            var $items = [],
                $type = $media.media_type == 'video' ? 'iframe' : 'image',
                $current_url = $($elm).attr('href'),
                $index = 0;
            for (var $i = 0; $i < $media.galleries.length; $i++) {
                $items.push({
                    src: $media.galleries[$i].src
                });
                if($media.galleries[$i].src === $current_url){
                    $index = $i;
                }
            }
            if ($.isFunction($.fn.magnificPopup)) {
                $.magnificPopup.open({
                    gallery: {
                        enabled: true
                    },
                    items: $items,
                    type: $type,
                    mainClass: 'mfp-zoom-in',
                    removalDelay: 500, //delay removal by X to allow out-animation
                    callbacks: {
                        open: function () {
                            //overwrite default prev + next function. Add timeout for css3 crossfade animation
                            $.magnificPopup.instance.next = function () {
                                var self = this;
                                self.wrap.removeClass('mfp-image-loaded');
                                setTimeout(function () {
                                    $.magnificPopup.proto.next.call(self);
                                }, 120);
                            };
                            $.magnificPopup.instance.prev = function () {
                                var self = this;
                                self.wrap.removeClass('mfp-image-loaded');
                                setTimeout(function () {
                                    $.magnificPopup.proto.prev.call(self);
                                }, 120);
                            };
                            if($index>0){
                                $.magnificPopup.instance.goTo($index);
                            }
                        },
                        imageLoadComplete: function () {
                            var self = this;
                            setTimeout(function () {
                                self.wrap.addClass('mfp-image-loaded');
                            }, 16);
                        }
                    },
                    closeOnContentClick: true,
                    midClick: true
                });
            } else {
                FatPortfolio.showNotified('Maginific popup library not found. Please do not check "Unload Magnific Popup" in Portfolio -> Settings');
            }
        };

        this.init_isotope_filter = function () {

            /** isotope filter **/
            $('a', '.fat-portfolio-shortcode.filter-isotope .fat-portfolio-tabs').off('click').on('click', function (event) {
                var $container = $(this).closest('.fat-portfolio-shortcode');
                event.preventDefault();
                $('.fat-portfolio-tabs a', $container).removeClass('active');
                if ($.isFunction($.fn.isotope)) {
                    $(this).addClass('active');
                    var $category = $(this).attr('data-category');
                    $category = $category.split(',');
                    $('.fat-item-wrap', $container).isotope({
                        filter: function () {
                            var $is_match = false;
                            for (var $i = 0; $i < $category.length; $i++) {
                                if ($(this).hasClass($category[$i].trim()) || $category[$i] == '*') {
                                    $is_match = true;
                                    break;
                                }
                            }
                            if ($is_match) {
                                $(this).addClass('infinited');
                            } else {
                                $(this).removeClass('infinited');
                            }
                            return $is_match;
                        }
                    });
                    //remove class for Sepia theme
                    setTimeout(function(){
                        $('body').removeClass('fade-out');
                    },800);
                } else {
                    FatPortfolio.showNotified('Masonry library not found. Please do not check "Unload Isotope" in Portfolio -> Settings', 8000);
                }
            });

            /** ajax filter **/
            $('a', '.fat-portfolio-shortcode.filter-ajax .fat-portfolio-tabs').off('click').on('click', function (event) {
                var $container = $(this).closest('.fat-portfolio-shortcode'),
                    $shortcode_name = $container.attr('data-sc-name'),
                    $current_page = 1,
                    $category = $(this).attr('data-category');

                event.preventDefault();
                $('.fat-portfolio-tabs a', $container).removeClass('active');
                $(this).addClass('active');

                FatPortfolio.get_portfolio(this, $container, $shortcode_name, $current_page, $category, FatPortfolio.bindItems);

                //init hide all category
                $('.fat-portfolio-shortcode.filter-ajax.hide-all-category').each(function(){
                    var self = $(this);
                    $(self).imagesLoaded(function(){
                        $('.fat-portfolio-tabs ul li a.active', self).trigger('click');
                        setTimeout(function(){
                            self.removeClass('hide-all-category');
                            self.css('opacity',1);
                        },500)
                    });
                })
            });

            /** isotope filter for attribute **/
            $('select', '.fat-portfolio-shortcode.filter-isotope .fat-portfolio-tabs.special-attrs-filter').off('change').on('change', function (event) {
                var $container = $(this).closest('.fat-portfolio-shortcode');
                event.preventDefault();
                if ($.isFunction($.fn.isotope)) {
                    var $category = $('select[name="category-filter"]', '.special-attrs-filter').val(),
                        $country = '', $years = '', $type = '', $status = '';

                    $category = $category.split(',');

                    var $temp = $('select[name="country-filter"]', '.special-attrs-filter');
                    if (typeof $temp != 'undefined' && $temp.length > 0) {
                        $temp = $temp.val().split(',');
                        for (var $i = 0; $i < $temp.length; $i++) {
                            $country += 'country-' + $temp[$i] + ',';
                        }
                    }
                    $country = $country.slice(0, -1).split(',');

                    $temp = $('select[name="years-filter"]', '.special-attrs-filter');
                    if (typeof $temp != 'undefined' && $temp.length > 0) {
                        $temp = $temp.val().split(',');
                        for (var $i = 0; $i < $temp.length; $i++) {
                            $years += 'years-' + $temp[$i] + ',';
                        }
                    }
                    $years = $years.slice(0, -1).split(',');

                    $temp = $('select[name="type-filter"]', '.special-attrs-filter');
                    if (typeof $temp != 'undefined' && $temp.length > 0) {
                        $temp = $temp.val().split(',');
                        for (var $i = 0; $i < $temp.length; $i++) {
                            $type += 'type-' + $temp[$i] + ',';
                        }
                    }
                    $type = $type.slice(0, -1).split(',');

                    $temp = $('select[name="status-filter"]', '.special-attrs-filter');
                    if (typeof $temp != 'undefined' && $temp.length > 0) {
                        $temp = $temp.val().split(',');
                        for (var $i = 0; $i < $temp.length; $i++) {
                            $status += 'status-' + $temp[$i] + ',';
                        }
                    }
                    $status = $status.slice(0, -1).split(',');

                    $('.fat-item-wrap', $container).isotope({
                        filter: function () {
                            var $is_match_cat = false,
                                $is_match_country = false,
                                $is_match_years = false,
                                $is_match_type = false,
                                $is_match_status = false;

                            /*category*/
                            for (var $i = 0; $i < $category.length; $i++) {
                                if ($(this).hasClass($category[$i].trim()) || $category[$i] == '*') {
                                    $is_match_cat = true;
                                    break;
                                }
                            }

                            /*country*/
                            for (var $i = 0; $i < $country.length; $i++) {
                                if ($(this).hasClass($country[$i].trim()) || $country[$i] == '*') {
                                    $is_match_country = true;
                                    break;
                                }
                            }

                            /*year*/
                            for (var $i = 0; $i < $years.length; $i++) {
                                if ($(this).hasClass($years[$i].trim()) || $years[$i] == '*') {
                                    $is_match_years = true;
                                    break;
                                }
                            }

                            /*type*/
                            for (var $i = 0; $i < $type.length; $i++) {
                                if ($(this).hasClass($type[$i].trim()) || $type[$i] == '*') {
                                    $is_match_type = true;
                                    break;
                                }
                            }

                            /*status*/
                            for (var $i = 0; $i < $status.length; $i++) {
                                if ($(this).hasClass($status[$i].trim()) || $status[$i] == '*') {
                                    $is_match_status = true;
                                    break;
                                }
                            }

                            if ($is_match_cat && $is_match_country && $is_match_years && $is_match_type && $is_match_status) {
                                $(this).addClass('infinited');
                            } else {
                                $(this).removeClass('infinited');
                            }
                            return ($is_match_cat && $is_match_country && $is_match_years && $is_match_type && $is_match_status);
                        }
                    });
                    //remove class for Sepia theme
                    setTimeout(function(){
                        $('body').removeClass('fade-out');
                    },800);
                } else {
                    FatPortfolio.showNotified('Masonry library not found. Please do not check "Unload Isotope" in Portfolio -> Settings', 8000);
                }
            });

            /** ajax filter for attribute **/
            $('select', '.fat-portfolio-shortcode.filter-ajax .fat-portfolio-tabs.special-attrs-filter').off('change').on('change', function () {
                var $container = $(this).closest('.fat-portfolio-shortcode'),
                    $shortcode_name = $container.attr('data-sc-name'),
                    $current_page = 1,
                    $category = $('select[name="category-filter"]', '.special-attrs-filter').val(),
                    $country, $years, $type, $status = '';

                $country = $('select[name="country-filter"]', '.special-attrs-filter');
                $years =  $('select[name="years-filter"]', '.special-attrs-filter');
                $type = $('select[name="type-filter"]', '.special-attrs-filter');
                $status = $('select[name="category-filter"]', '.special-attrs-filter');

                $country = typeof $country !== 'undefined' ? $country.val() : '';
                $years = typeof $years !== 'undefined' ? $years.val() : '';
                $type = typeof $type !== 'undefined' ? $type.val() : '';
                $status = $status ? $status.val() : '';

                FatPortfolio.get_portfolio(this, $container, $shortcode_name, $current_page, $category, FatPortfolio.bindItems);

                //init hide all category
                $('.fat-portfolio-shortcode.filter-ajax.hide-all-category').each(function(){
                    var self = $(this);
                    $(self).imagesLoaded(function(){
                        $('.fat-portfolio-tabs ul li a.active', self).trigger('click');
                        setTimeout(function(){
                            self.removeClass('hide-all-category');
                            self.css('opacity',1);
                        },500)
                    });
                })
            });
        };

        this.init_paging = function () {
            $('a.page-numbers', '.fat-portfolio-shortcode').each(function () {
                var $this = $(this);
                $this.removeClass('ladda-button').addClass('ladda-button');
                $this.attr('data-style', 'zoom-out');
                $this.attr('data-spinner-size', '20');
            });

            $('a.page-numbers, .load-more-wrap a.load-more, .infinite-scroll-wrap a.infinite-scroll', '.fat-portfolio-shortcode').off('click').on('click', function (event) {
                event.preventDefault();
                var $container = $(this).closest('.fat-portfolio-shortcode'),
                    $shortcode_name = $container.attr('data-sc-name'),
                    $current_page = 1,
                    $item_per_page = parseInt($container.attr('data-item-per-page')),
                    $ladda = null,
                    $category = $('.fat-portfolio-tabs a.active', $container).length > 0 ? $('.fat-portfolio-tabs a.active', $container).attr('data-category') : '';

                if($container.hasClass('fat-full-gallery')){
                    $(this).addClass('process');
                    if ($(this).hasClass('ladda-button')) {
                        $ladda = Ladda.create(this);
                        $ladda.start();
                    }

                    var index = 0;
                    $category = $category.split(',');
                    var $cat_filter = '';
                    for(var $i=0;$i<$category.length;$i++){
                        $cat_filter = $category[$i]!=='' ? '.' + $category[$i] : '';
                        $('.fat-portfolio-item.fat-lazy-load' + $cat_filter,$container).each(function(){
                            if(index < $item_per_page){
                                $(this).addClass('waiting-init');
                                $('img',this).attr('src',$('img',this).attr('data-src'));
                            }
                            index++;
                        });
                    }


                    $container.imagesLoaded(function () {
                        var items = $('.fat-portfolio-item.waiting-init',$container);
                        items.removeClass('fat-lazy-load');
                        $('.fat-item-wrap', $container).isotope('insert', items);
                        $('.fat-item-wrap', $container).isotope('layout');
                        if($container.hasClass('has-animation')){
                            FatPortfolio.initAppearScroll($container);
                        }else{
                            $('.fat-portfolio-item.waiting-init',$container).removeClass('waiting-init');
                        }

                        var $cat_filter = '',
                            $is_exists_lazy_load = 0;
                        for(var $i=0;$i<$category.length;$i++){
                            $cat_filter = $category[$i]!=='' ? '.' + $category[$i] : '';
                            if($('.fat-portfolio-item.fat-lazy-load' + $cat_filter,$container).length > 0){
                                $is_exists_lazy_load = 1;
                                break;
                            }
                        }

                        if($is_exists_lazy_load==0){
                            $('.load-more-container .load-more',$container).fadeOut()
                        }
                        if($is_exists_lazy_load==1){
                            $('.infinite-scroll-wrap a.infinite-scroll',$container).removeClass('infinited');
                        }

                        if ($ladda != null) {
                            $ladda.stop();
                        }
                        $(this).removeClass('process');

                        setTimeout(function(){
                            $('body').removeClass('fade-out');
                        },800);
                    });

                }else{
                    if ($(this).hasClass('page-numbers') && typeof $(this).attr('href') != 'undefined') {
                        $current_page = FatPortfolio.getPageNumberFromHref($(this).attr('href'));
                    }

                    if ($(this).hasClass('load-more') || $(this).hasClass('infinite-scroll')) {
                        $current_page = parseInt($(this).attr('data-next-page'));
                    }
                    FatPortfolio.get_portfolio(this, $container, $shortcode_name, $current_page, $category, FatPortfolio.bindItems);

                    if ($container.hasClass('filter-isotope')) {
                        $('.fat-portfolio-tabs a.active', $container).removeClass('active');
                        $('.fat-portfolio-tabs a[data-all-category="1"]', $container).addClass('active');
                    }
                }
                return false;
            });
        };

        this.bindItems = function ($container, $data, elm) {
            var $items = $('.fat-portfolio-item', $data),
                $paging = $('.paging-navigation', $data);

            if ($container.hasClass('layout-flipster')) {
                $('.fat-flipster', $container).removeClass('flipster flipster--transform flipster--coverflow flipster--click flipster--active');
                $('.fat-flipster', $container).removeClass('flipster--carousel');
                $('.fat-item-wrap', $container).removeClass('flipster__container');
                $('.fat-item-wrap', $container).removeAttr('style');
                $('.fat-flipster button', $container).remove();
            }

            if (!$(elm).hasClass('load-more') && !$(elm).hasClass('infinite-scroll')) {
                $('.fat-item-wrap', $container).empty();
            }

            $('.load-more-container', $container).empty();
            $('.fat-paging-navigation-wrap', $container).empty();
            $('.infinite-scroll-wrap', $container).empty();

            if (typeof $paging == 'undefined' || $paging.length <= 0) {
                $paging = $('.load-more-container', $data);
            }
            if (typeof $paging == 'undefined' || $paging.length <= 0) {
                $paging = $('.infinite-scroll-wrap', $data);
            }

            if (
                ($(elm).hasClass('load-more') || $(elm).hasClass('infinite-scroll') ) &&
                ($container.hasClass('filter-isotope') || $container.hasClass('metro') || $container.hasClass('layout-masonry'))
            ) {
                if ($('.fat-item-wrap', $container).data('isotope')) {
                    $('.fat-item-wrap', $container).isotope('insert', $items);
                    $('.fat-item-wrap', $container).imagesLoaded().progress(function () {
                        $('.fat-item-wrap', $container).isotope('layout');
                    });
                }
            } else {
                $('.fat-item-wrap', $container).append($items);
            }

            if ($container.hasClass('layout-flipster')) {
                /*$('.fat-flipster', $container).removeClass('flipster flipster--transform flipster--coverflow flipster--click flipster--active');
                $('.fat-flipster button', $container).remove();*/
                FatPortfolio.initFlipster($container);
            }

            if ($container.hasClass('layout-carousel')) {
                FatPortfolio.initCarousel($container);
            }

            if ($container.hasClass('layout-3d-carousel')) {
                FatPortfolio.init3DCarousel($container);
            }

            if ($container.hasClass('has-animation')) {
                $items.addClass('has-infinite');
                FatPortfolio.initAppearScroll($container);
            }

            if ($container.hasClass('filter-isotope') || $container.hasClass('metro') || $container.hasClass('layout-masonry')) {
                if (!$(elm).hasClass('load-more') && !$(elm).hasClass('infinite-scroll')) {
                    FatPortfolio.initIsotope($container);
                }else{
                    $items.addClass('infinited');
                }
            }

            if (typeof $paging != 'undefined' && $paging.length > 0) {
                if ($($paging).hasClass('load-more-container') || $($paging).hasClass('infinite-scroll-wrap')) {
                    $container.append($paging);
                } else {
                    $('.fat-paging-navigation-wrap', $container).append($paging);
                }
                FatPortfolio.init_paging();
            }

            FatPortfolio.initLightBoxGallery();
            FatPortfolio.init_isotope_filter();
            //remove class for Sepia theme
            $('body').removeClass('fade-out');
        };

        this.get_portfolio = function (elm, $container, $shortcode_name, $page, $category, callback_success, callback_error) {
            var $ladda = null;
            var $country, $years, $type, $status = '';

            $country = $('select[name="country-filter"]', '.special-attrs-filter');
            $years =  $('select[name="years-filter"]', '.special-attrs-filter');
            $type = $('select[name="type-filter"]', '.special-attrs-filter');
            $status = $('select[name="status-filter"]', '.special-attrs-filter');

            $country = typeof $country !== 'undefined' ? $country.val() : '';
            $years = typeof $years !== 'undefined' ? $years.val() : '';
            $type = typeof $type !== 'undefined' ? $type.val() : '';
            $status = typeof $status !== 'undefined' ? $status.val() : '';


            $(elm).addClass('process');
            if ($(elm).hasClass('ladda-button')) {
                $ladda = Ladda.create(elm);
                $ladda.start();
            }

            $.ajax({
                url: fat_ajax.ajaxurl,
                type: 'POST',
                data: ({
                    action: 'fat_portfolio_get_data',
                    name: $shortcode_name,
                    page: $page,
                    category: $category,
                    country: $country,
                    years: $years,
                    type: $type,
                    status: $status
                }),
                success: function (data) {
                    if ($ladda != null) {
                        $ladda.stop();
                    }
                    if (callback_success) {
                        callback_success($container, data, elm);
                    }
                },
                error: function () {
                    if ($ladda != null) {
                        $ladda.stop();
                    }
                    if (callback_error) {
                        callback_error($container, data);
                    }
                }
            });
        };

        this.isAppear = function (elm, percent_height) {
            var windowTop = $(window).scrollTop(),
                windowBottom = windowTop + $(window).height(),
                $height = $(elm).height(),
                elemTop = $(elm).offset().top,
                elemBottom = elemTop + $height,
                $height_appear = elemBottom - windowBottom;
            if (typeof percent_height == 'undefined' || isNaN(percent_height)) {
                percent_height = 0.8;
            }
            if (( $height_appear <= 0 || $height_appear <= ($height * percent_height) ) && (elemTop >= windowTop || windowBottom > elemBottom)) {
                return true;
            }
            return false;
        };

        this.initAppearScroll = function ($container) {
            var windowTop = $(window).scrollTop(),
                windowBottom = windowTop + $(window).height(),
                $animation_duration = 100,
                elemTop, elemBottom, $items, $animation = 'fadeInUp';
            $items = [];
            $('.fat-portfolio-item.has-infinite:not(.infinited):not(.fat-lazy-load)', $container).each(function () {
                if (FatPortfolio.isAppear(this)) {
                    $items.push($(this));
                }
            });

            for (var $i = 0; $i < $items.length; $i++) {
                (function ($index) {
                    $animation_duration = $($items[$index]).closest('.fat-portfolio-shortcode').attr('data-animation-duration');
                    $animation_duration = typeof $animation_duration != 'undefined' ? parseInt($animation_duration) : 100;
                    var $delay = $animation_duration * $i;
                    setTimeout(function () {
                        $animation = $($items[$index]).closest('.fat-portfolio-shortcode').attr('data-animation');
                        $($items[$index]).addClass('animated ' + $animation);
                        $($items[$index]).removeClass('has-infinite').removeClass('waiting-init');
                        $($items[$index]).addClass('infinited');
                        setTimeout(function () {
                            $($items[$index]).removeClass($animation);
                        }, 1500);
                    }, $delay);
                })($i);
            }
        };

        this.initInfiniteScroll = function () {
            var windowTop = $(window).scrollTop(),
                windowBottom = windowTop + $(window).height(),
                elemTop, elemBottom;
            $('.infinite-scroll-wrap a.infinite-scroll:not(.infinited)').each(function () {
                elemTop = $(this).offset().top;
                elemBottom = elemTop + $(this).height();
                if ((elemBottom <= windowBottom) && (elemTop >= windowTop)) {
                    $(this).addClass('infinited');
                    $(this).trigger('click');
                }
            });
        };

        this.initIsotope = function ($container) {
            if ($.isFunction($.fn.isotope)) {
                var $col_width = '.fat-col-md-' + $($container).attr('data-fat-col'),
                    $fit_row = $container.hasClass('layout-grid') ? true : false;
                if ($('.fat-item-wrap', $container).data('isotope')) {
                    $('.fat-item-wrap', $container).isotope('destroy');
                }

                setTimeout(function () {
                    $($container).imagesLoaded(function () {
                        if($fit_row){
                            $('.fat-item-wrap', $container).isotope({
                                itemSelector: '.fat-portfolio-item:not(.fat-lazy-load)',
                                layoutMode: 'fitRows',
                                masonry: {
                                    columnWidth: $col_width
                                },
                                percentPosition: true,
                                hiddenStyle: {
                                    opacity: 0,
                                    transform: 'translate3d(0, 100px, 0)'
                                },
                                visibleStyle: {
                                    opacity: 1,
                                    transform: 'translate3d(0, 0, 0)'
                                },
                                transitionDuration: '0.5s'
                            }).isotope('layout');
                        }else{
                            jQuery('.fat-item-wrap', $container).isotope({
                                itemSelector: '.fat-portfolio-item:not(.fat-lazy-load)',
                                masonry: {
                                    columnWidth: $col_width
                                },
                                percentPosition: true,
                                hiddenStyle: {
                                    opacity: 0,
                                    transform: 'translate3d(0, 100px, 0)'
                                },
                                visibleStyle: {
                                    opacity: 1,
                                    transform: 'translate3d(0, 0, 0)'
                                },
                                transitionDuration: '0.5s'
                            }).isotope('layout');
                        }
                        FatPortfolio.initAnimation();
                        setTimeout(function(){
                            if($container.hasClass('hide-all-category')){
                                $('.fat-portfolio-tabs ul li a.active', $container).trigger('click');
                                $container.removeClass('hide-all-category');
                                $container.css('opacity',1);
                            }
                        },200)
                    });
                }, 500);

            } else {
                FatPortfolio.showNotified('Masonry library not found. Please do not check "Unload Isotope" in Portfolio -> Settings', 8000);
            }
        };

        this.getPageNumberFromHref = function ($href) {
            var $href_default = '',
                pattern = /paged=\d+/ig;
            if (new RegExp(pattern).test($href)) {
                $href_default = new RegExp(pattern).exec($href);
            } else {
                pattern = /page\/\d+/ig;
                $href_default = new RegExp(pattern).test($href) ? new RegExp(pattern).exec($href) : $href_default;
            }
            pattern = /\d+/g;
            return new RegExp(pattern).test($href_default) ? new RegExp(pattern).exec($href_default)[0] : 1;
        };

        this.getFlickrImage = function ($flick_filter, callback) {
            var flickr = new FAT_Flickr_API({
                get_by: $flick_filter.hasOwnProperty('get_by') ? $flick_filter.get_by : 'album',
                api_key: $flick_filter.hasOwnProperty('api_key') ? $flick_filter.api_key : '',
                user_id: $flick_filter.hasOwnProperty('user_id') ? $flick_filter.user_id : '',
                gallery_id: $flick_filter.hasOwnProperty('gallery_id') ? $flick_filter.gallery_id : '',
                photoset_id: $flick_filter.hasOwnProperty('album') ? $flick_filter.album : 0,
                media: $flick_filter.hasOwnProperty('media') ? $flick_filter.media : 'all',
                tags: $flick_filter.hasOwnProperty('tag_name') ? $flick_filter.tag_name : ''
            });
            flickr.options.per_page = typeof ($flick_filter.limit) != 'undefined' && !isNaN($flick_filter.limit) ? parseInt($flick_filter.limit) : 100000;

            flickr.getListPhoto(function ($data) {
                if ($data.code > 0) {
                    var $galleries = [];
                    var $photos = $data.data.photo;

                    for (var $i = 0; $i < $photos.length; $i++) {
                        $galleries[$i] = {
                            subHtml: $photos[$i].title,
                            src: $photos[$i].url_o,
                            thumb: $photos[$i].url_m
                        };
                    }
                    if (callback) {
                        callback($galleries);
                    }
                }
            });

        };

        this.getInstagramImage = function ($instagram_filter, callback) {
            var $options = {
                accessToken: $instagram_filter.hasOwnProperty('access_token') ? $instagram_filter.access_token : '',
                get: $instagram_filter.get_by,
                sortBy: $instagram_filter.hasOwnProperty('sort_by') ? $instagram_filter.sort_by : '',
                resolution: 'standard_resolution'
            };

            $('body').append('<div id="instafeed" style="display: none"></div>');
            if ($instagram_filter.get_by == 'tagged') {
                $options['tagName'] = $instagram_filter.hasOwnProperty('tag_name') ? $instagram_filter.tag_name : '';
            }

            if ($instagram_filter.get_by == 'user') {
                $options['userId'] = $instagram_filter.hasOwnProperty('user_id') ? $instagram_filter.user_id : '';
            }
            if ($instagram_filter.hasOwnProperty('limit') && $instagram_filter.limit != '' && !isNaN($instagram_filter.limit) && parseInt($instagram_filter.limit) > 0) {
                $options['limit'] = $instagram_filter.limit;
            }
            var $galleries = [];
            $options['filter'] = function (image) {
                return false;
            };
            $options['success'] = function ($data) {
                if (typeof $data.data != 'undefined' && $data.data != null) {
                    for (var $i = 0; $i < $data.data.length; $i++) {
                        $galleries.push(
                            {
                                subHtml: $data.data[$i].caption != null ? $data.data[$i].caption.text : '',
                                src: $data.data[$i].images.standard_resolution.url,
                                thumb: $data.data[$i].images.thumbnail.url,
                            }
                        )
                    }
                }
                if (callback) {
                    callback($galleries);
                }

            };

            var feed = new Instafeed($options);
            feed.run();
        };
    };

    $(document).ready(function () {
        FatPortfolio.init();
        $(window).scroll(function () {
            FatPortfolio.initAppearScroll();
            FatPortfolio.initInfiniteScroll();
        });
        $(window).resize(function () {
            setTimeout(function () {
                $('.fat-portfolio-shortcode.layout-3d-carousel').each(function () {
                    var $container = $(this);
                    $('.fat-thumbnail', $container).removeClass('.waterwheel-active');
                    $('.fat-thumbnail img', $container).removeAttr('style');
                    $('.fat-thumbnail img', $container).removeAttr('width');
                    $('.fat-thumbnail img', $container).removeAttr('height');
                    $('.fat-thumbnail img', $container).removeClass('carousel-center');
                    $('.fat-thumbnail .fat-hover-wrap', $container).removeAttr('style');
                    FatPortfolio.$waterwheel[$container.attr('id')].reload(FatPortfolio.$waterwheel_options);
                });
            }, 200)
        });

        /*$('a','.et_pb_tabs_controls').on('click',function(){
            var li = $(this).closest('li'),
                tab_class = li.attr('class'),
                fat_sc = $('.fat-portfolio-shortcode','.' + tab_class);

            if(fat_sc.hasClass('filter-isotope')){
                setTimeout(function(){
                    FatPortfolio.initIsotope(fat_sc);
                },500);
            }
        });*/
    });
    /*$( document ).ajaxComplete(function( event,request, settings ) {
        setTimeout(function(){
            FatPortfolio.init();
        },1000);
    });*/
})(jQuery);


