/**
 * FatPortfolio - Version 1.15.2
 * Copyright 2016, RoninWP
 * http://roninwp.com
 */
"use strict";
(function ($) {
    var FatPortfolioSingle = new function () {

        this.init = function () {
            this.init_single_carousel();
            this.init_play_video();
            this.init_flickr_carousel();
            this.init_instagram_carousel();
            this.initSocialShare();
            this.initContentFloatScroll();
            this.initIsotope();
            if ($('.fat-portfolio-single').hasClass('light-gallery')) {
                this.init_lightbox_popup();
            } else {
                this.init_maginific_popup();
            }
        };

        this.init_single_carousel = function () {
            $('.owl-carousel.main-slide:not(.social-media)').each(function () {
                var self = $(this),
                    auto_height = self.attr('data-auto-height') === '1' ? true : false;

                $(self).imagesLoaded(function () {
                    self.trigger('destroy.owl.carousel');
                    self.owlCarousel({
                        items: 1,
                        nav: true,
                        navText: ['<i class="fa fa-long-arrow-left"></i> ', ' <i class="fa fa-long-arrow-right"></i>'],
                        dots: false,
                        loop: false,
                        margin: 0,
                        autoHeight: auto_height,
                        onTranslated: function (event) {
                            var $index = event.item.index,
                                $a_nav = $('a[data-index="' + $index + '"]'),
                                $thumb_slide = $(".thumb-slide", ".fat-portfolio-single");
                            $('.thumb', '.fat-portfolio-single').removeClass('active');
                            $a_nav.parent().addClass('active');
                            $thumb_slide.trigger('to.owl.carousel', [$index, 300]);
                        }
                    });
                });

            });

            if ($.isFunction($.fn.owlCarousel)) {
               $('.owl-carousel.thumb-slide:not(.social-media)').trigger('destroy.owl.carousel');
               $('.owl-carousel.thumb-slide:not(.social-media)').owlCarousel({
                    items: 4,
                    nav: false,
                    margin: 15,
                    dots: false,
                    loop: false,
                    responsive: {
                        0: {
                            items: 2,
                        },
                        768: {
                            items: 3
                        },
                        992: {
                            items: 4
                        }
                    },
                    onInitialized: function () {
                        $('a.nav-thumb', '.thumb-slide').off('click').on('click', function () {
                            var index = $(this).attr('data-index');
                            index = parseInt(index);
                            $(".thumb-slide", ".fat-portfolio-single").attr('data-current-index', index);
                            $(".main-slide", ".fat-portfolio-single").trigger('to.owl.carousel', [index, 300]);
                        })
                    }
                });

                var $col_related = $('.owl-carousel', '.portfolio-related-container').attr('data-fat-col'),
                    $col_480 = $col_related,
                    $col_768 = $col_related;

                if ($col_related <= 2) {
                    $col_480 = 1;
                } else {
                    $col_480 = 2;
                    $col_768 = $col_related - 1;
                }
                $('.owl-carousel', '.portfolio-related-container').owlCarousel({
                    items: $col_related,
                    nav: true,
                    navText: ['<i class="fa fa-long-arrow-left"></i> ', ' <i class="fa fa-long-arrow-right"></i>'],
                    margin: 15,
                    dots: false,
                    loop: false,
                    responsive: {
                        0: {
                            items: 1,
                        },
                        480: {
                            items: $col_480,
                        },
                        768: {
                            items: $col_768
                        },
                        992: {
                            items: $col_related
                        }
                    }
                });
            }else{
                console.log('Owl Carousel library not found');
            }

        };

        this.init_play_video = function () {
            $('.play-video', '.fat-portfolio-single').bind('click', function () {
                var $index = $(this).attr('data-index');
                $(".main-slide", ".fat-portfolio-single").trigger('to.owl.carousel', [$index, 100]);
                setTimeout(function () {
                    var $iframe = $('iframe', '.main-slide a[data-index="' + $index + '"]');
                    if ($iframe.length > 0 && $iframe[0].src.indexOf('?') > -1) {
                        $iframe[0].src += "&autoplay=1";
                    } else {
                        $iframe[0].src += "?autoplay=1";
                    }
                }, 500);

            });
        };

        this.init_flickr_carousel = function () {
            $('.flickr-media-wrap').each(function () {
                var $option = $(this).attr('data-flickr'),
                    $main_slider = $('.main-slide', this),
                    $thumb_slider = $('.thumb-slide', this),
                    $image_click_action;

                $option = JSON.parse($option);

                $image_click_action = $option.hasOwnProperty('media_click_action') ? $option.media_click_action : 'none';
                var flickr = new FAT_Flickr_API({
                    get_by: $option.hasOwnProperty('get_by') ? $option.get_by : 'album',
                    api_key: $option.hasOwnProperty('api_key') ? $option.api_key : '',
                    user_id: $option.hasOwnProperty('user_id') ? $option.user_id : '',
                    gallery_id: $option.hasOwnProperty('gallery_id') ? $option.gallery_id : '',
                    photoset_id: $option.hasOwnProperty('album') ? $option.album : 0,
                    media: $option.hasOwnProperty('media') ? $option.media : 'all',
                    tags: $option.hasOwnProperty('tag_name') ? $option.tag_name : '',
                });
                flickr.options.per_page = typeof ($option.limit) != 'undefined' && !isNaN($option.limit) ? parseInt($option.limit) : 100000;
                flickr.getListPhoto(function ($data) {
                    if ($data.code > 0) {
                        var $photos = $data.data.photo,
                            $user_id = $data.data.owner,
                            $total = parseInt($data.data.total),
                            $item, $item_thumb;
                        if ($total > 0) {
                            for (var $i = 0; $i < $photos.length; $i++) {
                                $item = '<div class="item" style="background-image: url(\{image\});"><a class="nav-slideshow {image_click_action}" href="{link}" target="{target}"></a></div>';
                                $item_thumb = '<div class="thumb {active}" style="background-image: url(\{image\});"><a class="nav-thumb" href="javascript:;" data-index="{index}"></a><div class="bg-overlay fat-overlay transition"></div></div>';

                                if ($image_click_action == 'open_new_window' || $image_click_action == 'open_same_window') {
                                    $item = $item.replace('{link}', 'https://www.flickr.com/photos/{user_id}/{photo_id}/in/dateposted-public/');
                                } else {
                                    $item = $item.replace('{link}', $photos[$i].url_o);
                                }
                                $item = $item.replace('{user_id}', $user_id);
                                $item = $item.replace('{photo_id}', $photos[$i].id);
                                $item = $item.replace('{image}', $photos[$i].url_o);
                                $item = $item.replace('{image_click_action}', $image_click_action);
                                if ($image_click_action == 'open_new_window') {
                                    $item = $item.replace('{target}', '_blank');
                                } else {
                                    $item = $item.replace('{target}', '_self');
                                }
                                $item_thumb = $item_thumb.replace('{image}', $photos[$i].url_m);
                                $item_thumb = $item_thumb.replace('{index}', $i);
                                $item_thumb = $i == 0 ? $item_thumb.replace('{active}', 'active') : $item_thumb.replace('{active}', '');
                                $main_slider.append($item);
                                if ($thumb_slider.length > 0) {
                                    $thumb_slider.append($item_thumb);
                                }
                            }

                            $main_slider.removeClass('social-media');

                            if ($thumb_slider.length > 0) {
                                $thumb_slider.removeClass('social-media');
                                $thumb_slider.attr('data-total-items', $total);
                            }
                            if ($main_slider.hasClass('owl-carousel')) {
                                FatPortfolioSingle.init_single_carousel();
                            }
                            if ($image_click_action == 'open_popup_gallery') {
                                FatPortfolioSingle.init_maginific_popup();
                            }

                        } else {
                            $main_slider.append('<div class="flickr-error social-error">Not found media adapt search criteria</div>');
                        }
                    }
                });
            })
        };

        this.init_instagram_carousel = function () {
            $('.instagram-media-wrap').each(function () {
                var $instagram_media_wrap = $(this),
                    $data_instagram = $(this).attr('data-instagram'),
                    $main_slider = $('.main-slide', this),
                    $thumb_slider = $('.thumb-slide', this),
                    $main_slider_id = $main_slider.attr('id'),
                    $thumb_slider_id = $thumb_slider.length > 0 ? $thumb_slider.attr('id') : '',
                    $image_click_action = '',
                    $options = {};

                $data_instagram = JSON.parse($data_instagram);
                $image_click_action = $data_instagram.image_click_action;
                $options = {
                    accessToken: $data_instagram.hasOwnProperty('access_token') ? $data_instagram.access_token : '',
                    get: $data_instagram.get_by,
                    sortBy: $data_instagram.hasOwnProperty('sort_by') ? $data_instagram.sort_by : '',
                    resolution: 'standard_resolution'
                };

                if ($data_instagram.get_by == 'tagged') {
                    $options['tagName'] = $data_instagram.hasOwnProperty('tag_name') ? $data_instagram.tag_name : '';
                }
                if ($data_instagram.get_by == 'user') {
                    $options['userId'] = $data_instagram.hasOwnProperty('user_id') ? $data_instagram.user_id : '';
                }
                if ($data_instagram.hasOwnProperty('limit') && $data_instagram.limit != '' && !isNaN($data_instagram.limit) && parseInt($data_instagram.limit) > 0) {
                    $options['limit'] = $data_instagram.limit;
                }

                if ($image_click_action == 'open_popup_gallery') {
                    $options['template'] = '<div class="item" style="background-image:url(\{{image}})"><a class="nav-slideshow {image_click_action}" href="{{image}}" target="{target}"></a></div>';
                } else {
                    $options['template'] = '<div class="item" style="background-image:url(\{{image}})"><a class="nav-slideshow {image_click_action}" href="{{link}}" target="{target}"></a></div>';
                }

                $options['template'] = $options['template'].replace('{image_click_action}', $image_click_action);
                if ($image_click_action == 'open_new_window') {
                    $options['template'] = $options['template'].replace('{target}', '_blank');
                } else {
                    $options['template'] = $options['template'].replace('{target}', '_self');
                }

                $options['target'] = $main_slider_id;
                $options['after'] = function () {
                    $('.main-slide', $instagram_media_wrap).removeClass('social-media');
                    FatPortfolioSingle.init_single_carousel();
                    if ($image_click_action == 'open_popup_gallery') {
                        FatPortfolioSingle.init_maginific_popup();
                    }
                };
                var feed = new Instafeed($options);
                feed.run();

                //set for thumb
                if ($thumb_slider.length > 0) {
                    $options['template'] = '<div class="thumb" style="background-image: url(\{{image}});"><a class="nav-thumb" href="javascript:;" data-index="0"></a><div class="bg-overlay fat-overlay transition"></div></div>';
                    $options['target'] = $thumb_slider_id;
                    $options['after'] = function () {
                        $('.thumb-slide', $instagram_media_wrap).removeClass('social-media');
                        $('.thumb-slide', $instagram_media_wrap).attr('data-total-items', $('.thumb-slide .thumb', $instagram_media_wrap).length);
                        $('.thumb-slide .thumb', $instagram_media_wrap).each(function ($index, $item) {
                            if ($index == 0) {
                                $($item).addClass('active');
                            }
                            $('a', $item).attr('data-index', $index);
                        });
                        FatPortfolioSingle.init_single_carousel();
                    };
                    feed = new Instafeed($options);
                    feed.run();
                }
            });
        };

        this.init_maginific_popup = function () {
            $('.fat-portfolio-single .image-gallery .main-slide .item > a').magnificPopup({
                gallery: {
                    enabled: true
                },
                image: {
                    titleSrc: function (item) {
                        return item.el.attr('data-description');
                    }
                },
                type: 'image',
                mainClass: 'mfp-zoom-in',
                removalDelay: 500, //delay removal by X to allow out-animation
                callbacks: {
                    beforeOpen: function () {
                        $('#portfolio a').each(function () {
                            $(this).attr('title', $(this).find('img').attr('alt'));
                        });
                    },
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
        };

        this.init_lightbox_popup = function () {
            $('.fat-portfolio-single .image-gallery .main-slide .item > a').on('click', function (event) {
                event.preventDefault();
                var self = $(this),
                    galleries = [],
                    current_src = $(this).attr('href'),
                    $index = 0,
                    $slide_index = 0;
                $('.fat-portfolio-single .image-gallery .main-slide .item > a').each(function () {
                    if (current_src === $(this).attr('href')) {
                        $slide_index = $index;
                    }
                    galleries.push({
                        'downloadUrl': $(this).attr('href'),
                        'subHtml': $(this).attr('data-description'),
                        'thumb': $(this).attr('href'),
                        'src': $(this).attr('href'),
                        'iframe': false
                    });
                    $index++;
                });
                if ($.isFunction($.fn.lightGallery)) {
                    var $lg = $(self).lightGallery({
                        downloadUrl: false,
                        dynamic: true,
                        dynamicEl: galleries,
                        hash: false,
                        index: $slide_index
                    });
                    $lg.on('onAfterOpen.lg', function (event, index) {
                        $('.lg-thumb-outer').css('opacity', '0');
                        setTimeout(function () {
                            $('.lg-has-thumb').removeClass('lg-thumb-open');
                            $('.lg-thumb-outer').css('opacity', '1');
                        }, 700);

                    });
                }
                return false;
            })
        };

        this.initSocialShare = function () {

            $('a','.shares-wrap').off('click').on('click',function(){
                var self = $(this),
                    social = self.attr('data-social'),
                    title = self.closest('shares-wrap').attr('data-title'),
                    url = self.closest('shares-wrap').attr('data-url'),
                    window_title = '';
                if(typeof social!=='undefined' && social!==''){
                    var window_url = '';
                    if(social==='facebook'){
                        window_url = 'https://www.facebook.com/sharer.php?s=100&amp;p[url]=' + url;
                        window_title = 'Facebook share';
                    }
                    if(social === 'twitter'){
                        window_url = 'http://twitter.com/home?text=' + title + '&url=' + url;
                        window_title = 'Twitter share';
                    }
                    if(social === 'google'){
                        window_url = 'https://plus.google.com/share?url=' + url;
                        window_title = 'Google+ share';
                    }
                    if(social === 'pinterest'){
                        window_url = 'https://pinterest.com/pin/create/button/?url=' + url + '&description=' + title;
                        window_title = 'Pinterest share';
                    }
                    var left = (screen.width/2)-(500/2);
                    var top = (screen.height/2)-(450/2);
                    window.open(window_url,window_title,'width=500,height=450,resizable=0,top=' + top +',left=' + left).focus();
                }
            });

            $('.fat-share').each(function () {
                var $fat_share = $(this),
                    $share_popup = $('.social-share', this);
                if ($.isFunction($.fn.jsSocials)) {
                    $($share_popup).jsSocials(
                        {
                            shares: ["twitter", "facebook", "googleplus", "pinterest"],
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

        this.initContentFloatScroll = function () {
            if ($.isFunction($.fn.perfectScrollbar)) {
                $('.detail-container', '.fat-portfolio-content-float').perfectScrollbar({
                    wheelSpeed: 0.5,
                    suppressScrollX: true
                });
            }
            $('a', '.fat-portfolio-single-content-float-icon').on('click', function () {
                var $float_content = $(this).closest('.fat-portfolio-content-float'),
                    $show_title = $(this).attr('data-show-title'),
                    $hide_title = $(this).attr('data-hide-title');
                if ($float_content.hasClass('fat-show-up')) {
                    $float_content.removeClass('fat-show-up');
                    $('span', this).html($show_title);
                    $('i', this).removeClass('fa-angle-left').addClass('fa-angle-right');

                } else {
                    $float_content.addClass('fat-show-up');
                    $('span', this).html($hide_title);
                    $('i', this).removeClass('fa-angle-right').addClass('fa-angle-left');
                }
            });
        };

        this.initIsotope = function () {
            if ($.isFunction($.fn.isotope)) {
                var container = $('.fat-portfolio-row[data-disable-crop="1"]');
                container.imagesLoaded(function () {
                    container.isotope({
                        itemSelector: '.item'
                    });
                });
            }
        }
    };

    $(document).ready(function () {
        FatPortfolioSingle.init();
    })
})(jQuery);
