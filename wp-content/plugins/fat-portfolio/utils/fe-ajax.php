<?php
/**
 * @package   Fat_Portfolio
 * @author    roninwp <kenus.ronin@gmail.com>
 * @copyright 2016 RoninWP
 */

if (!function_exists('load_gallery_callback')) {
    function load_gallery_callback()
    {
        $settings = get_option(FAT_PORTFOLIO_POST_TYPE . '-settings');
        $post_id = $_REQUEST['post_id'];
        $post_title = get_the_title($post_id);
        $gallery_type = get_post_meta($post_id, 'fat-meta-box-gallery-type', true);
        $media_type = isset($gallery_type['fat_mb_gallery_type']) ? $gallery_type['fat_mb_gallery_type'] : 'image';
        $media_source = isset($gallery_type['fat_mb_media_source']) ? $gallery_type['fat_mb_media_source'] : 'media';

        $portfolio_gallery = isset($gallery_type['fat_mb_image_gallery']) ? $gallery_type['fat_mb_image_gallery'] : array();
        $portfolio_gallery = explode(',', $portfolio_gallery);
        $galleries = $media = array();

        $media['media_type'] = $media_type;
        $media['media_source'] = $media_source;

        if ($media_type === 'image' && $media_source === 'media' && has_post_thumbnail($post_id)) {
            $thumbnail_id = get_post_thumbnail_id($post_id);
            array_unshift($portfolio_gallery, $thumbnail_id);
        }

        if ($media_type === 'image' && $media_source === 'media' && is_array($portfolio_gallery) && count($portfolio_gallery) > 0) {
            $args_attachment = array(
                'orderby'        => 'post__in',
                'post__in'       => $portfolio_gallery,
                'post_type'      => 'attachment',
                'posts_per_page' => '-1',
                'post_status'    => 'inherit');

            $attachments = new WP_Query($args_attachment);
            global $post;
            $subHtml = $post_title;
            while ($attachments->have_posts()) : $attachments->the_post();
                if(isset($settings['title_image_popup_gallery']) && $settings['title_image_popup_gallery'] === 'image_title'){
                    $subHtml = $post->post_title;
                }
                if(isset($settings['title_image_popup_gallery']) && $settings['title_image_popup_gallery'] === 'image_caption'){
                    $subHtml = $post->post_excerpt;
                }
                $galleries[] = array(
                    'subHtml'     => $subHtml,
                    'thumb'       => $post->guid,
                    'src'         => $post->guid,
                    'href'        => $post->guid,
                    'downloadUrl' => $post->guid
                );
            endwhile;
            wp_reset_postdata();
        }

        if ($media_type === 'image' && $media_source === 'flickr') {
            $flickr_gallery_filter = isset($gallery_type['fat_mb_flickr_gallery']) ? $gallery_type['fat_mb_flickr_gallery'] : array();
            $media['flickr_filter'] = $flickr_gallery_filter;
        }

        if ($media_type === 'image' && $media_source === 'instagram') {
            $instagram_gallery_filter = isset($gallery_type['fat_mb_instagram_gallery']) ? $gallery_type['fat_mb_instagram_gallery'] : array();
            $media['instagram_filter'] = $instagram_gallery_filter;
        }

        if ($media_type === 'video') {
            $portfolio_videos = isset($gallery_type['fat_mb_video_gallery']) ? $gallery_type['fat_mb_video_gallery'] : array();
            if (is_array($portfolio_videos) && count($portfolio_videos) > 0) {
                $video_url = '';
                for ($i = 0; $i < count($portfolio_videos['link_video']); $i++) {
                    $video_url = $portfolio_videos['link_video'][$i];
                    preg_match('/src="([^"]+)"/', $video_url, $match);
                    $video_url = isset($match[1]) ? $match[1] : $video_url;
                    $thumb_url = str_replace('player.vimeo.com/video', 'vimeo.com', $video_url);
                    if ($video_url != $thumb_url) {
                        $galleries[] = array(
                            'subHtml' => '',
                            'src'     => $thumb_url,
                            'iframe'  => false
                        );
                    } else {
                        $galleries[] = array(
                            'subHtml'              => '',
                            'src'                  => $video_url,
                            'iframe'               => true,
                            'loadYoutubeThumbnail' => true,
                            'youtubeThumbSize'     => 'default',
                        );
                    }
                }
            }
        }
        $media['galleries'] = $galleries;
        echo json_encode($media);
        wp_die();
    }

    ;

    add_action("wp_ajax_nopriv_fat_portfolio_load_gallery", 'load_gallery_callback');
    add_action("wp_ajax_fat_portfolio_load_gallery", 'load_gallery_callback');
}

if (!function_exists('fat_portfolio_get_data_callback')) {
    function fat_portfolio_get_data_callback()
    {
        $shortcode_name = isset($_POST['name']) ? $_POST['name'] : '';
        $category = isset($_POST['category']) && $_POST['category'] != '' ? $_POST['category'] : '';

        $country = isset($_POST['country']) && $_POST['country'] != '' ? $_POST['country'] : '';
        $years = isset($_POST['years']) && $_POST['years'] != '' ? $_POST['years'] : '';
        $type = isset($_POST['type']) && $_POST['type'] != '' ? $_POST['type'] : '';
        $status = isset($_POST['status']) && $_POST['status'] != '' ? $_POST['status'] : '';

        $page = isset($_POST['page']) ? $_POST['page'] : '';
        if ($category == '' || $category == '*' ) {
            $shortcode = sprintf('[fat_portfolio name="%s" current_page="%s" country="%s" years="%s" type="%s" status="%s" ajax=1]', $shortcode_name, $page, $country, $years, $type, $status);
        } else {
            $shortcode = sprintf('[fat_portfolio name="%s" current_page="%s" category="%s" country="%s" years="%s" type="%s" status="%s" ajax=1]', $shortcode_name, $page, $category, $country, $years, $type, $status);
        }
        echo do_shortcode($shortcode);
        die();
    }

    ;

    add_action("wp_ajax_nopriv_fat_portfolio_get_data", 'fat_portfolio_get_data_callback');
    add_action("wp_ajax_fat_portfolio_get_data", 'fat_portfolio_get_data_callback');
}
