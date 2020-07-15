<style type='text/css' id="fat-portfolio-custom-css-<?php echo isset($custom_css['id']) ? $custom_css['id'] : ''; ?>">

    /** category filter **/
    .fat-shortcode-<?php echo esc_attr($custom_css['id']); ?> .fat-portfolio-tabs li a{
        font-size:  <?php echo isset($custom_css['category_filter_font_size']) ? $custom_css['category_filter_font_size'] : '14'; ?>px;
        font-style: <?php echo isset($custom_css['category_filter_style']) ? $custom_css['category_filter_style'] : 'normal'; ?>;
        font-weight: <?php echo isset($custom_css['category_filter_weight']) ? $custom_css['category_filter_weight'] : 400; ?>;
        text-transform: <?php echo isset($custom_css['category_filter_text_transform'])? $custom_css['category_filter_text_transform'] : 'normal'; ?>;
        color: <?php echo isset($custom_css['category_filter_text_color']) && $custom_css['category_filter_text_color'] ? $custom_css['category_filter_text_color'] : '#343434'; ?>;
        letter-spacing:  <?php echo isset($custom_css['category_filter_letter_spacing']) ? $custom_css['category_filter_letter_spacing'] : '1'; ?>px;
    }

    .fat-shortcode-<?php echo esc_attr($custom_css['id']); ?> .fat-portfolio-tabs li a:hover,
    .fat-shortcode-<?php echo esc_attr($custom_css['id']); ?> .fat-portfolio-tabs li a.active{
        color:  <?php echo isset($custom_css['category_filter_text_hover_color']) && $custom_css['category_filter_text_hover_color'] ? $custom_css['category_filter_text_hover_color'] : '#343434'; ?>;
    }

    /** portfolio item **/
    .fat-shortcode-<?php echo esc_attr($custom_css['id']); ?> .fat-portfolio-item .category{
        font-size: <?php echo isset($custom_css['category_font_size']) ? $custom_css['category_font_size'] : '14'; ?>px;
        font-style: <?php echo isset($custom_css['category_style']) ? $custom_css['category_style'] : 'normal'; ?>;
        font-weight: <?php echo isset($custom_css['category_style_weight']) ? $custom_css['category_style_weight'] : 400; ?>;
        text-transform: <?php echo isset($custom_css['category_text_transform'])? $custom_css['category_text_transform'] : 'normal'; ?>;
        color: <?php echo isset($custom_css['category_text_color']) && $custom_css['category_text_color'] ? $custom_css['category_text_color'] : '#fff'; ?>;
        letter-spacing:  <?php echo isset($custom_css['category_letter_spacing']) ? $custom_css['category_letter_spacing'] : '1'; ?>px;
    }

    .fat-shortcode-<?php echo esc_attr($custom_css['id']); ?> .fat-portfolio-item .title,
    .fat-shortcode-<?php echo esc_attr($custom_css['id']); ?> .fat-portfolio-item .title a{
        font-size: <?php echo isset($custom_css['title_font_size']) ? $custom_css['title_font_size'] : '14'; ?>px;
        font-style: <?php echo isset($custom_css['title_style']) ? $custom_css['title_style'] : 'normal'; ?>;
        font-weight: <?php echo isset($custom_css['title_style_weight']) ? $custom_css['title_style_weight'] : 400; ?>;
        text-transform: <?php echo isset($custom_css['title_text_transform'])? $custom_css['title_text_transform'] : 'normal'; ?>;
        color: <?php echo isset($custom_css['title_text_color']) && $custom_css['title_text_color'] ? $custom_css['title_text_color'] : '#fff'; ?>;
        letter-spacing:  <?php echo isset($custom_css['title_letter_spacing']) ? $custom_css['title_letter_spacing'] : '1'; ?>px;
    }

    .fat-shortcode-<?php echo esc_attr($custom_css['id']); ?> .fat-portfolio-item .fat-excerpt,
    .fat-shortcode-<?php echo esc_attr($custom_css['id']); ?> .fat-portfolio-item .fat-excerpt a,
    .fat-shortcode-<?php echo esc_attr($custom_css['id']); ?> .fat-portfolio-item .fat-excerpt a:hover,
    .fat-shortcode-<?php echo esc_attr($custom_css['id']); ?> .fat-portfolio-item .fat-excerpt p,
    .fat-shortcode-<?php echo esc_attr($custom_css['id']); ?> .fat-portfolio-item .icon a{
        font-size: <?php echo isset($custom_css['icon_font_size']) ? $custom_css['icon_font_size'] : '14'; ?>px;
        color: <?php echo isset($custom_css['icon_color']) && $custom_css['icon_color'] ? $custom_css['icon_color'] : '#fff'; ?> !important;
    }
    .fat-shortcode-<?php echo esc_attr($custom_css['id']); ?> .fat-portfolio-item .icon a:hover{
        color: <?php echo isset($custom_css['icon_hover_color']) && $custom_css['icon_hover_color'] ? $custom_css['icon_hover_color'] : '#fff'; ?>;
    }

    .fat-shortcode-<?php echo esc_attr($custom_css['id']); ?> .fat-portfolio-item .fat-hover-wrap{
        background-color: <?php echo isset($custom_css['bg_hover_color']) && $custom_css['bg_hover_color'] ? $custom_css['bg_hover_color'] : 'rgba(0,0,0,0.5)'; ?>;
    }

    .fat-shortcode-<?php echo esc_attr($custom_css['id']); ?> .fat-paging-navigation-wrap .page-numbers.process,
    .fat-shortcode-<?php echo esc_attr($custom_css['id']); ?> .fat-paging-navigation-wrap .page-numbers.current,
    .fat-shortcode-<?php echo esc_attr($custom_css['id']); ?> .fat-paging-navigation-wrap .page-numbers:hover{
        background-color: <?php echo isset($custom_css['paging_background_color']) && $custom_css['paging_background_color'] ? $custom_css['paging_background_color'] : '#343434'; ?>;
        color: <?php echo isset($custom_css['paging_text_color']) && $custom_css['paging_text_color'] ? $custom_css['paging_text_color'] : '#fff'; ?>;
    }


    .fat-shortcode-<?php echo esc_attr($custom_css['id']); ?> .fat-paging-navigation-wrap .next.page-numbers.process,
    .fat-shortcode-<?php echo esc_attr($custom_css['id']); ?> .fat-paging-navigation-wrap .prev.page-numbers.process,
    .fat-shortcode-<?php echo esc_attr($custom_css['id']); ?> .fat-paging-navigation-wrap .next.page-numbers:hover,
    .fat-shortcode-<?php echo esc_attr($custom_css['id']); ?> .fat-paging-navigation-wrap .prev.page-numbers:hover{
        background-color: transparent;
        color: <?php echo isset($custom_css['paging_background_color']) && $custom_css['paging_background_color'] ? $custom_css['paging_background_color'] : '#343434'; ?>;
    }


    .fat-shortcode-<?php echo esc_attr($custom_css['id']); ?> .fat-paging-navigation-wrap .page-numbers .ladda-spinner div[role='progressbar'] > div > div,
    .fat-shortcode-<?php echo esc_attr($custom_css['id']); ?> .fat-paging-navigation-wrap .page-numbers .ladda-spinner div[role='progressbar'] > div > div{
        background-color: <?php echo isset($custom_css['paging_text_color']) && $custom_css['paging_text_color'] ? $custom_css['paging_text_color'] : '#fff'; ?> !important;
    }

    .fat-shortcode-<?php echo esc_attr($custom_css['id']); ?> .fat-paging-navigation-wrap .next.page-numbers .ladda-spinner div[role='progressbar'] > div > div,
    .fat-shortcode-<?php echo esc_attr($custom_css['id']); ?> .fat-paging-navigation-wrap .prev.page-numbers .ladda-spinner div[role='progressbar'] > div > div{
        background-color: <?php echo isset($custom_css['paging_background_color']) && $custom_css['paging_background_color'] ? $custom_css['paging_background_color'] : '#343434'; ?> !important;
     }

    .fat-shortcode-<?php echo esc_attr($custom_css['id']); ?> .fat-portfolio-tabs a.active .ladda-spinner div[role='progressbar'] > div > div{
        background-color: <?php echo isset($custom_css['category_filter_text_hover_color']) && $custom_css['category_filter_text_hover_color'] ? $custom_css['category_filter_text_hover_color'] : '#343434'; ?> !important;
    }

    .fat-shortcode-<?php echo esc_attr($custom_css['id']); ?> .owl-carousel .owl-prev,
    .fat-shortcode-<?php echo esc_attr($custom_css['id']); ?> .owl-carousel .owl-next,
    .fat-shortcode-<?php echo esc_attr($custom_css['id']); ?> .owl-carousel .owl-dots .owl-dot{
        background-color: <?php echo isset($custom_css['slider_nav_bg_color']) && $custom_css['slider_nav_bg_color'] ? $custom_css['slider_nav_bg_color'] : 'rgba(0,0,0,0.5)'; ?> !important;
    }

    .fat-shortcode-<?php echo esc_attr($custom_css['id']); ?> .owl-carousel .owl-prev,
    .fat-shortcode-<?php echo esc_attr($custom_css['id']); ?> .owl-carousel .owl-next{
        color: <?php echo isset($custom_css['slider_nav_text_color']) && $custom_css['slider_nav_text_color'] ? $custom_css['slider_nav_text_color'] : '#fff'; ?> !important;
    }

    .fat-shortcode-<?php echo esc_attr($custom_css['id']); ?> .owl-carousel .owl-prev:hover,
    .fat-shortcode-<?php echo esc_attr($custom_css['id']); ?> .owl-carousel .owl-next:hover,
    .fat-shortcode-<?php echo esc_attr($custom_css['id']); ?> .owl-carousel .owl-dots .owl-dot.active,
    .fat-shortcode-<?php echo esc_attr($custom_css['id']); ?> .owl-carousel .owl-dots .owl-dot:hover{
        background-color: <?php echo isset($custom_css['slider_nav_bg_hover_color']) && $custom_css['slider_nav_bg_hover_color'] ? $custom_css['slider_nav_bg_hover_color'] : 'rgba(0,0,0,0.5)'; ?> !important;
    }

    .fat-shortcode-<?php echo esc_attr($custom_css['id']); ?> .owl-carousel .owl-prev:hover,
    .fat-shortcode-<?php echo esc_attr($custom_css['id']); ?> .owl-carousel .owl-next:hover{
        color: <?php echo isset($custom_css['slider_nav_text_hover_color']) && $custom_css['slider_nav_text_hover_color'] ? $custom_css['slider_nav_text_hover_color'] : '#fff'; ?> !important;
    }

    .fat-shortcode-<?php echo esc_attr($custom_css['id']); ?> .flipster__button svg{
       color: <?php echo isset($custom_css['flipster_nav_color']) && $custom_css['flipster_nav_color'] ? $custom_css['flipster_nav_color'] : '#343434'; ?> !important;
    }

    /** load more **/
    .fat-shortcode-<?php echo esc_attr($custom_css['id']); ?> .load-more-wrap a{
        color:  <?php echo isset($custom_css['load_more_text_color']) && $custom_css['load_more_text_color'] ? $custom_css['load_more_text_color'] : '#fff'; ?>;
    }
    .fat-shortcode-<?php echo esc_attr($custom_css['id']); ?> .load-more-wrap a:hover{
        color:  <?php echo isset($custom_css['load_more_text_hover_color']) && $custom_css['load_more_text_hover_color'] ? $custom_css['load_more_text_hover_color'] : '#fff'; ?>;
    }

    .fat-shortcode-<?php echo esc_attr($custom_css['id']); ?> .load-more-wrap .ladda-spinner div[role='progressbar'] > div > div{
        background-color: <?php echo isset($custom_css['load_more_text_hover_color']) && $custom_css['load_more_text_hover_color'] ? $custom_css['load_more_text_hover_color'] : '#fff'; ?> !important;
    }

    .fat-shortcode-<?php echo esc_attr($custom_css['id']); ?> .load-more-wrap{
        background-color:  <?php echo isset($custom_css['load_more_background_color']) && $custom_css['load_more_background_color'] ? $custom_css['load_more_background_color'] : '#343434'; ?>;
    }
    .fat-shortcode-<?php echo esc_attr($custom_css['id']); ?> .load-more-wrap:hover{
        background-color:  <?php echo isset($custom_css['load_more_background_hover_color']) && $custom_css['load_more_background_hover_color'] ? $custom_css['load_more_background_hover_color'] : '#343434'; ?>;
    }

    /** infinite scroll **/
    .fat-shortcode-<?php echo esc_attr($custom_css['id']); ?> .infinite-scroll-wrap .ladda-spinner div[role='progressbar'] > div > div{
        background-color: <?php echo isset($custom_css['infinity_loading_color']) && $custom_css['infinity_loading_color'] ? $custom_css['infinity_loading_color'] : '#343434'; ?> !important;
    }

    <?php echo isset($custom_css['custom_css']) && $custom_css['custom_css'] !='' ? str_replace("\\","",$custom_css['custom_css']) : ''; ?>

</style>