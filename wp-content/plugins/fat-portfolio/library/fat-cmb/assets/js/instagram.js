jQuery(function ($) {
    'use strict';

    function Fat_cmb_get_image_from_instagram($instagram_wrap) {
        var $access_token = $('.instagram-access-token input', $instagram_wrap).val(),
            $get_by = $('.instagram-get-by select', $instagram_wrap).val(),
            $tag = $('.instagram-tag-filter input', $instagram_wrap).val(),
            $user_id = $('.instagram-user-filter input', $instagram_wrap).val(),
            $limit = $('.instagram-limit-filter input', $instagram_wrap).val(),
            $sort_by = $('.instagram-sort-by select', $instagram_wrap).val(),
            $instagram_id = $('.fat-cmb-instagram-list', $instagram_wrap).attr('id'),
            el = $('#' + $instagram_id),
            $options = {};

        if ($access_token != '') {
            $('.fat-cmb-loading',$instagram_wrap).css('display','inline-block');
            $options['accessToken'] = $access_token;
            $options['get'] = $get_by;
            $options['sortBy'] = $sort_by;
            if ($tag != '' && typeof $tag != 'undefined' && $get_by == 'tagged') {
                $options['tagName'] = $tag;
            }
            if ($user_id != '' && typeof $user_id != 'undefined' && $get_by == 'user') {
                $options['userId'] = $user_id;
            }
            if ($limit != '' && typeof $limit != 'undefined') {
                $options['limit'] = parseInt($limit) <= 15 ? $limit : 15;
            }

            $options['template'] = '<div class="instagram-item social-item"><a href="{{link}}" target="_blank"><img src="{{image}}" /></a></div>';

            $options['success'] = function () {
                $('.instagram-error', el).remove();
                $('.fat-cmb-loading',$instagram_wrap).css('display','none');
                $('.instagram-item', el).remove();
            };

            $options['after'] = function () {
                if (typeof el != 'undefined') {
                    $('.instagram-item:last', el).append('<div class="overlay-has-more"><div class="has-more-outer"><div class="has-more-inner">More + </div></div></div>');
                }
            };
            $options['error'] = function (error_message) {
                if (typeof el != 'undefined') {
                    $('.social-error', el).remove();
                    el.append('<div class="instagram-error social-error">' + error_message + '</div>')
                }
                $('.fat-cmb-loading',$instagram_wrap).css('display','none');
            };

            $options['target'] = $instagram_id;
            var feed = new Instafeed($options);
            feed.run();

        } else {
            $('.fat-cmb-instagram-list', $instagram_wrap).append('<div class="instagram-error social-error">Please input access token and another filter information before get image</div>')
        }
    }

    $(document).ready(function () {
        $('.fat-cmb-instagram-wrap').each(function () {
            var $this = $(this);
            $('.instagram-get-by select', $this).change(function () {
                var $get_by = $(this).val();
                $get_by == 'tagged' ? $('.instagram-tag-filter', $this).show() : $('.instagram-tag-filter', $this).hide();
                $get_by == 'user' ? $('.instagram-user-filter', $this).show() : $('.instagram-user-filter', $this).hide();
            });
            Fat_cmb_get_image_from_instagram($this);
        });

        $('.fat-cmb-instagram-wrap').each(function () {
            var $instagram_wrap = $(this);
            $('.instagram-button a', this).off('click').on('click', function () {
                Fat_cmb_get_image_from_instagram($instagram_wrap);
            });
        });

      /*  userId: 94764,
            accessToken: '94764.1677ed0.c6256a27eddf41709ddf29af3469a4e5',*/
    });
});
