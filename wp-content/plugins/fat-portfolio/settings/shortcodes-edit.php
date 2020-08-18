<?php
/**
 * Created by PhpStorm.
 * User: roninwp
 * Date: 3/9/2017
 * Time: 2:23 PM
 */

$cols = array(
    '2' => esc_html__('2 columns', 'fat-portfolio'),
    '3' => esc_html__('3 columns', 'fat-portfolio'),
    '4' => esc_html__('4 columns', 'fat-portfolio'),
    '5' => esc_html__('5 columns', 'fat-portfolio'),
    '6' => esc_html__('6 columns', 'fat-portfolio')
);

$layout = array(
    'flipster-coverflow' => array(
        'title' => esc_html__('Flipster Coverflow', 'fat-portfolio'),
        'image' => FAT_PORTFOLIO_ASSET_IMAGES_URL . 'layouts/flipster-coverflow.jpg'
    ),
    'flipster-carousel' => array(
        'title' => esc_html__('Flipster Carousel', 'fat-portfolio'),
        'image' => FAT_PORTFOLIO_ASSET_IMAGES_URL . 'layouts/flipster-carousel.jpg'
    ),
    '3d-carousel' => array(
        'title' => esc_html__('3D Carousel', 'fat-portfolio'),
        'image' => FAT_PORTFOLIO_ASSET_IMAGES_URL . 'layouts/3d-carousel.jpg'
    ),
    'carousel' => array(
        'title' => esc_html__('Carousel', 'fat-portfolio'),
        'image' => FAT_PORTFOLIO_ASSET_IMAGES_URL . 'layouts/carousel.jpg'
    ),
    'slideshow' => array(
        'title' => esc_html__('Slide show', 'fat-portfolio'),
        'image' => FAT_PORTFOLIO_ASSET_IMAGES_URL . 'layouts/slideshow.jpg'
    ),
    'grid' => array(
        'title' => esc_html__('Grid', 'fat-portfolio'),
        'image' => FAT_PORTFOLIO_ASSET_IMAGES_URL . 'layouts/grid.jpg'
    ),
    'masonry' => array(
        'title' => esc_html__('Masonry', 'fat-portfolio'),
        'image' => FAT_PORTFOLIO_ASSET_IMAGES_URL . 'layouts/masonry.jpg'
    ),
    'metro-style-one' => array(
        'title' => esc_html__('Metro style one', 'fat-portfolio'),
        'image' => FAT_PORTFOLIO_ASSET_IMAGES_URL . 'layouts/metro-style-01.jpg'
    ),
    'metro-style-two' => array(
        'title' => esc_html__('Metro style two', 'fat-portfolio'),
        'image' => FAT_PORTFOLIO_ASSET_IMAGES_URL . 'layouts/metro-style-02.jpg'
    ),
    'metro-style-three' => array(
        'title' => esc_html__('Metro style three', 'fat-portfolio'),
        'image' => FAT_PORTFOLIO_ASSET_IMAGES_URL . 'layouts/metro-style-03.jpg'
    )
);

$skins = array(
    'thumb-icon-title-cat-hover' => array(
        'title' => esc_html__('Thumbnail, icon - title - category hover', 'fat-portfolio'),
        'image' => FAT_PORTFOLIO_ASSET_IMAGES_URL . 'skins/thumb-icon-title-cat-hover.jpg'
    ),
    'thumb-icon-hover' => array(
        'title' => esc_html__('Thumbnail, icon hover', 'fat-portfolio'),
        'image' => FAT_PORTFOLIO_ASSET_IMAGES_URL . 'skins/thumb-icon-hover.jpg'
    ),
    'thumb-icon-title-hover' => array(
        'title' => esc_html__('Thumbnail, icon - title hover', 'fat-portfolio'),
        'image' => FAT_PORTFOLIO_ASSET_IMAGES_URL . 'skins/thumb-icon-title-hover.jpg'
    ),
    'thumb-icon-gallery-hover' => array(
        'title' => esc_html__('Thumbnail, icon gallery hover', 'fat-portfolio'),
        'image' => FAT_PORTFOLIO_ASSET_IMAGES_URL . 'skins/thumb-icon-gallery-hover.jpg'
    ),
    'thumb-link-gallery' => array(
        'title' => esc_html__('Image gallery click able', 'fat-portfolio'),
        'image' => FAT_PORTFOLIO_ASSET_IMAGES_URL . 'skins/thumb-link-gallery.jpg'
    ),
    'thumb-link-detail' => array(
        'title' => esc_html__('Image to detail click able', 'fat-portfolio'),
        'image' => FAT_PORTFOLIO_ASSET_IMAGES_URL . 'skins/thumb-link-detail.jpg'
    ),
    'thumb-title-cat-hover' => array(
        'title' => esc_html__('Thumbnail, title - category hover', 'fat-portfolio'),
        'image' => FAT_PORTFOLIO_ASSET_IMAGES_URL . 'skins/thumb-title-cat-hover.jpg'
    ),
    'thumb-both-title-excerpt-hover' => array(
        'title' => esc_html__('Thumbnail, title & excerpt hover', 'fat-portfolio'),
        'image' => FAT_PORTFOLIO_ASSET_IMAGES_URL . 'skins/thumb-both-title-excerpt-hover.jpg'
    ),
    'thumb-title-excerpt-hover' => array(
        'title' => esc_html__('Thumbnail, title - excerpt - hover', 'fat-portfolio'),
        'image' => FAT_PORTFOLIO_ASSET_IMAGES_URL . 'skins/thumb-title-excerpt-hover.jpg'
    ),

    'thumb-title-cat-center' => array(
        'title' => esc_html__('Thumbnail, title - category - center', 'fat-portfolio'),
        'image' => FAT_PORTFOLIO_ASSET_IMAGES_URL . 'skins/thumb-title-cat-center.jpg'
    ),
    'thumb-title-cat-left' => array(
        'title' => esc_html__('Thumbnail, title - category - left', 'fat-portfolio'),
        'image' => FAT_PORTFOLIO_ASSET_IMAGES_URL . 'skins/thumb-title-cat-left.jpg'
    ),
    'thumb-cat-title-excerpt' => array(
        'title' => esc_html__('Thumbnail, category - title - excerpt', 'fat-portfolio'),
        'image' => FAT_PORTFOLIO_ASSET_IMAGES_URL . 'skins/thumb-cat-title-excerpt.jpg'
    ),
    'thumb-title-date-excerpt' => array(
        'title' => esc_html__('Thumbnail, title - date - excerpt', 'fat-portfolio'),
        'image' => FAT_PORTFOLIO_ASSET_IMAGES_URL . 'skins/thumb-title-date-excerpt.jpg'
    ),

);

$gutter = array(
    '0' => esc_html__('None', 'fat-portfolio'),
    '5' => esc_html__('5 pixel', 'fat-portfolio'),
    '10' => esc_html__('10 pixel', 'fat-portfolio'),
    '15' => esc_html__('15 pixel', 'fat-portfolio'),
    '20' => esc_html__('20 pixel', 'fat-portfolio'),
    '30' => esc_html__('30 pixel', 'fat-portfolio')
);

$animations = array(
    'none' => esc_html__('None', 'fat-portfolio'),
    'bounceInDown' => 'bounceInDown',
    'bounceInLeft' => 'bounceInLeft',
    'bounceInRight' => 'bounceInRight',
    'bounceInUp' => 'bounceInUp',
    'fadeInUp' => 'fadeInUp',
    'fadeInDown' => 'fadeInDown',
    'fadeInLeft' => 'fadeInLeft',
    'fadeInRight' => 'fadeInRight',
    'flipInX' => 'flipInX',
    'slideInUp' => 'slideInUp',
    'zoomIn' => 'zoomIn'
);

$portfolios = Fat_Portfolio_Base::get_portfolios();
$categories = Fat_Portfolio_Base::get_portfolio_categories();
$authors = Fat_Portfolio_Base::get_authors();

$first_key = current(array_keys($skins));
$image_preview = isset($skins[$first_key]['image']) ? $skins[$first_key]['image'] : '';

if (isset($_GET['sc_id'])) {
    $shortcode = get_option(FAT_PORTFOLIO_SHORTCODE_OPTION_KEY . '_' . $_GET['sc_id'], array());

}
$sc_id = isset($shortcode['id']) ? $shortcode['id'] : '';
$sc_name = isset($shortcode['name']) ? $shortcode['name'] : '';
if (isset($_GET['sc_name']) && isset($_GET['clone']) && $_GET['clone'] == '1') {
    $sc_id = '';
    $sc_name = isset($_GET['sc_name']) ? $_GET['sc_name'] : 'New shortcode';
}

$settings = FAT_Portfolio::get_settings();

$country_tax = $years_tax = $type_tax = $status_tax = array();
if (isset($settings['enable_special_attribute']) && $settings['enable_special_attribute'] == '1') {
    $country_tax = Fat_Portfolio_Base::get_portfolio_taxonomy(FAT_PORTFOLIO_COUNTRY_TAXONOMY);
    $years_tax = Fat_Portfolio_Base::get_portfolio_taxonomy(FAT_PORTFOLIO_YEARS_TAXONOMY);
    $type_tax = Fat_Portfolio_Base::get_portfolio_taxonomy(FAT_PORTFOLIO_TYPE_TAXONOMY);
    $status_tax = Fat_Portfolio_Base::get_portfolio_taxonomy(FAT_PORTFOLIO_STATUS_TAXONOMY);
}

?>
<div class="wrap fat-portfolio-setting fat-portfolio-tabs fat-shortcode-edit-wrap">
    <h1></h1>

    <h1 class="setting-title"><?php esc_html_e('FAT portfolio shortcodes generator', 'fat-portfolio'); ?></h1>

    <ul class="tab-settings-nav">
        <li class="active">
            <a href="#"
               data-tab="tab-layout">
                <i class="fa fa-cogs"></i>
                <span><?php echo esc_html__('Layout', 'fat-portfolio'); ?></span>
            </a>
        </li>
        <li><a href="#" data-tab="tab-data-source">
                <i class="fa fa-database"></i>
                <span><?php echo esc_html__('Data source', 'fat-portfolio'); ?></a></span>
        </li>
        <li><a href="#" data-tab="tab-filter">
                <i class="fa fa-sliders"></i>
                <span><?php echo esc_html__('Filter / Sort', 'fat-portfolio'); ?></a></span>
        </li>
        <li class="tab-paging" data-dependence-id="sc_layout_type"
            data-value="grid,masonry,metro-style-one,metro-style-two,metro-style-three">
            <a href="#" data-tab="tab-paging">
                <i class="fa fa-ellipsis-h"></i>
                <span><?php echo esc_html__('Pagination', 'fat-portfolio'); ?></a></span>
        </li>

        <li class="tab-carousel" data-dependence-id="sc_layout_type"
            data-value="flipster-coverflow,flipster-carousel,carousel">
            <a href="#" data-tab="tab-carousel">
                <i class="fa fa-ellipsis-h"></i>
                <span><?php echo esc_html__('Slider config', 'fat-portfolio'); ?></a></span>
        </li>

        <li>
            <a href="#" data-tab="tab-skin">
                <i class="fa fa-paint-brush" aria-hidden="true"></i>
                <span><?php echo esc_html__('Skin & Animation', 'fat-portfolio'); ?></span>
            </a>
        </li>

        <li>
            <a href="#" data-tab="tab-font-style">
                <i class="fa fa-font" aria-hidden="true"></i>
                <span><?php echo esc_html__('Font & Color', 'fat-portfolio'); ?></span>
            </a>
        </li>

        <li><a href="#" data-tab="tab-custom-css">
                <i class="fa fa-paint-brush" aria-hidden="true"></i>
                <span><?php echo esc_html__('Custom CSS', 'fat-portfolio'); ?></span>
            </a></li>
    </ul>

    <div class="tab-setting active" id="tab-layout">
        <ul>
            <li class="field-group">
                <div class="fat-title"><?php echo esc_attr__('Shortcode:', 'fat-portfolio'); ?></div>
                <div class="fat-field">
                    <input type="hidden" id="sc_id" value="<?php echo esc_attr($sc_id); ?>">
                    <span
                            id="layout_shortcode"><?php echo sprintf('[fat_portfolio name="%s"]', $sc_name); ?></span>
                    <a href="javascript:" class="copy-clipboard" data-clipboard-target="#layout_shortcode"><i
                                class="fa fa-clipboard"></i></a>
                </div>
            </li>

            <li class="field-group">
                <div class="fat-title"><?php echo esc_attr__('Shortcode name:', 'fat-portfolio'); ?></div>
                <div class="fat-field">
                    <input type="text" name="shortcode_name" id="sc_name" value="<?php echo esc_html($sc_name); ?>">
                </div>
            </li>

            <li class="field-group">
                <div class="fat-title"><?php echo esc_attr__('Light box gallery:', 'fat-portfolio'); ?></div>
                <div class="fat-field">
                    <select id="sc_light_box_gallery">
                        <option value="light-gallery" <?php echo isset($shortcode['light_box_gallery']) && $shortcode['light_box_gallery'] === 'light-gallery' ? 'selected' : ''; ?> ><?php esc_html_e('Light box gallery', 'fat-portfolio'); ?></option>
                        <option value="magnific-popup" <?php echo isset($shortcode['light_box_gallery']) && $shortcode['light_box_gallery'] === 'magnific-popup' ? 'selected' : ''; ?> ><?php esc_html_e('Magnific popup gallery', 'fat-portfolio'); ?></option>
                    </select>
                </div>
            </li>

            <li class="field-group">
                <div class="fat-title"><?php echo esc_attr__('Layout:', 'fat-portfolio'); ?></div>
                <div class="fat-field layout-wrap fat-image-wrap col-4">

                    <?php foreach ($layout as $key => $value) { ?>
                        <div
                                class="image-item <?php echo isset($shortcode['layout_type']) && $shortcode['layout_type'] === $key ? 'active' : ''; ?>"
                                data-value="<?php echo esc_attr($key); ?>">
                            <div class="image-item-inner">
                                <img src="<?php echo esc_url($value['image']); ?>"
                                     title="<?php echo esc_attr($value['title']); ?>">
                                <a class="select-layout"><i class="fa fa-check-square-o"></i></a>
                                <span class="layout-title"><?php echo esc_html($value['title']); ?></span>
                            </div>
                        </div>
                    <?php }; ?>

                    <input type="hidden" class="dependence" name="sc_layout_type" id="sc_layout_type"
                           value="<?php echo isset($shortcode['layout_type']) ? $shortcode['layout_type'] : ''; ?>"/>
                </div>
            </li>

            <li class="field-group sc-columns field-hidden" data-dependence-id="sc_layout_type"
                data-value="grid,masonry">
                <div class="fat-title"><?php echo esc_attr__('Columns:', 'fat-portfolio'); ?></div>
                <div class="fat-field">
                    <select id="sc_columns" class="form-control manual"
                            data-selected="<?php echo isset($shortcode['columns']) ? $shortcode['columns'] : ''; ?>">
                        <?php foreach ($cols as $key => $val) { ?>
                            <option value="<?php echo esc_attr($key); ?>">
                                <?php echo esc_html($val); ?>
                            </option>
                        <?php }; ?>
                    </select>
                </div>
            </li>

            <li class="field-group sc-gutter field-hidden" data-dependence-id="sc_layout_type"
                data-value="grid,carousel,masonry">
                <div class="fat-title"><?php echo esc_attr__('Gutter:', 'fat-portfolio'); ?></div>
                <div class="fat-field">
                    <select id="sc_gutter" class="form-control manual"
                            data-selected="<?php echo isset($shortcode['gutter']) ? $shortcode['gutter'] : ''; ?>">
                        <?php foreach ($gutter as $key => $val) { ?>
                            <option value="<?php echo esc_attr($key); ?>">
                                <?php echo esc_html($val); ?>
                            </option>
                        <?php }; ?>
                    </select>
                </div>
            </li>

            <li class="field-group sc-title-from ">
                <div class="fat-title"><?php echo esc_attr__('Get title hover from:', 'fat-portfolio'); ?></div>
                <div class="fat-field">
                    <select id="sc_title_from" class="form-control"
                            data-selected="<?php echo isset($shortcode['title_from']) ? $shortcode['title_from'] : 'portfolio-title'; ?>">
                        <option value="portfolio-title">
                            <?php echo esc_html('Portfolio title', 'fat-portfolio'); ?>
                        </option>
                        <option value="image-title">
                            <?php echo esc_html('Image title', 'fat-portfolio'); ?>
                        </option>
                    </select>
                </div>
            </li>

            <li class="field-group sc-columns field-hidden" data-dependence-id="sc_layout_type"
                data-value="flipster-coverflow,flipster-carousel,3d-carousel,3d-split-carousel,diamond,feature-image-slide,grid,carousel">
                <div class="fat-title"><?php echo esc_attr__('Image size (width x height):', 'fat-portfolio'); ?></div>
                <div class="fat-field field-width-140">
                    <input type="number" id="sc_image_width"
                           value="<?php echo isset($shortcode['image_width']) ? $shortcode['image_width'] : 375; ?>">
                    x
                    <input type="number"
                           value="<?php echo isset($shortcode['image_height']) ? $shortcode['image_height'] : 275; ?>"
                           id="sc_image_height"> (pixel)
                </div>
            </li>
            <li class="field-group sc-columns " data-dependence-id="sc_layout_type"
                data-value="grid,carousel">
                <div class="fat-title"><?php echo esc_attr__('Disable crop image:', 'fat-portfolio'); ?></div>
                <div class="fat-field">
                    <input type="checkbox"
                           id="sc_disable_crop_image" <?php echo isset($shortcode['disable_crop_image']) && $shortcode['disable_crop_image'] == 'true' ? 'checked' : ''; ?>
                           value="1">
                </div>
            </li>
            <li class="field-group sc-columns field-hidden" data-dependence-id="sc_layout_type" data-value="masonry">
                <div class="fat-title"><?php echo esc_attr__('Dynamic crop image:', 'fat-portfolio'); ?></div>
                <div class="fat-field">
                    <input type="checkbox"
                           id="sc_crop_image" <?php echo isset($shortcode['crop_image']) && $shortcode['crop_image'] == 'true' ? 'checked' : ''; ?>
                           value="1">
                </div>
            </li>
            <li class="field-group sc-columns ">
                <div class="fat-title"><?php echo esc_attr__('Display full gallery:', 'fat-portfolio'); ?></div>
                <div class="fat-field">
                    <input type="checkbox"
                           id="sc_full_gallery" <?php echo isset($shortcode['full_gallery']) && $shortcode['full_gallery'] == 'true' ? 'checked' : ''; ?>
                           value="1">
                </div>
            </li>
            <li class="field-group">
                <div class="fat-title">&nbsp;</div>
                <div class="fat-field">
                    <input class="button sc-save button-large button-primary" type="button"
                           value="<?php esc_attr_e('Save', 'fat-portfolio'); ?>"/>
                </div>
            </li>

        </ul>
    </div>

    <div class="tab-setting" id="tab-data-source">
        <ul>
            <li class="field-group">
                <div class="fat-title"><?php echo esc_attr__('From:', 'fat-portfolio'); ?></div>
                <div class="fat-field">
                    <select class="dependence manual" id="sc_data_source"
                            data-selected="<?php echo isset($shortcode['data_source']) ? $shortcode['data_source'] : 'categories'; ?>">
                        <option value="categories"><?php esc_html_e('Categories', 'fat-portfolio'); ?></option>
                        <option value="ids"><?php esc_html_e('List portfolio', 'fat-portfolio'); ?></option>
                        <?php if (isset($settings['enable_special_attribute']) && $settings['enable_special_attribute'] == '1') { ?>
                            <option value="categories_attrs"><?php esc_html_e('Categories and special attribute', 'fat-portfolio'); ?></option>
                        <?php } ?>
                    </select>
                </div>
            </li>
            <li class="field-group" data-dependence-id="sc_data_source" data-value="categories,categories_attrs">
                <div class="fat-title"><?php echo esc_attr__('Categories:', 'fat-portfolio'); ?></div>
                <div class="fat-field">
                    <select id="sc_data_source_categories" class="selectize manual"
                            data-selected="<?php echo isset($shortcode['categories']) && is_array($shortcode['categories']) ? implode(',', $shortcode['categories']) : ''; ?>"
                            multiple>
                        <option value=""><?php esc_html_e('All categories', 'fat-portfolio'); ?></option>
                        <?php foreach ($categories as $key => $value) { ?>
                            <option value="<?php echo esc_attr($key); ?>"><?php echo esc_html($value); ?></option>
                        <?php } ?>
                    </select>
                </div>
            </li>

            <!-- start show special attribute -->
            <?php if (isset($settings['enable_special_attribute']) && $settings['enable_special_attribute'] == '1')  : ?>

                <!-- country -->
                <li class="field-group" data-dependence-id="sc_data_source" data-value="categories_attrs">
                    <div class="fat-title"><?php echo esc_attr__('Country:', 'fat-portfolio'); ?></div>
                    <div class="fat-field">
                        <select id="sc_data_source_country" class="selectize manual"
                                data-selected="<?php echo isset($shortcode['ds_country']) && is_array($shortcode['ds_country']) ? implode(',', $shortcode['ds_country']) : ''; ?>"
                                multiple>
                            <option value=""><?php esc_html_e('All country', 'fat-portfolio'); ?></option>
                            <?php foreach ($country_tax as $key => $value) { ?>
                                <option value="<?php echo esc_attr($key); ?>"><?php echo esc_html($value); ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </li>

                <!--years-->
                <li class="field-group" data-dependence-id="sc_data_source" data-value="categories_attrs">
                    <div class="fat-title"><?php echo esc_attr__('Years:', 'fat-portfolio'); ?></div>
                    <div class="fat-field">
                        <select id="sc_data_source_years" class="selectize manual"
                                data-selected="<?php echo isset($shortcode['ds_years']) && is_array($shortcode['ds_years']) ? implode(',', $shortcode['ds_years']) : ''; ?>"
                                multiple>
                            <option value=""><?php esc_html_e('All Years', 'fat-portfolio'); ?></option>
                            <?php foreach ($years_tax as $key => $value) { ?>
                                <option value="<?php echo esc_attr($key); ?>"><?php echo esc_html($value); ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </li>

                <!--Type-->
                <li class="field-group" data-dependence-id="sc_data_source" data-value="categories_attrs">
                    <div class="fat-title"><?php echo esc_attr__('Type:', 'fat-portfolio'); ?></div>
                    <div class="fat-field">
                        <select id="sc_data_source_type" class="selectize manual"
                                data-selected="<?php echo isset($shortcode['ds_type']) && is_array($shortcode['ds_type']) ? implode(',', $shortcode['ds_type']) : ''; ?>"
                                multiple>
                            <option value=""><?php esc_html_e('All Type', 'fat-portfolio'); ?></option>
                            <?php foreach ($type_tax as $key => $value) { ?>
                                <option value="<?php echo esc_attr($key); ?>"><?php echo esc_html($value); ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </li>

                <!--Status-->
                <li class="field-group" data-dependence-id="sc_data_source" data-value="categories_attrs">
                    <div class="fat-title"><?php echo esc_attr__('Status:', 'fat-portfolio'); ?></div>
                    <div class="fat-field">
                        <select id="sc_data_source_status" class="selectize manual"
                                data-selected="<?php echo isset($shortcode['ds_status']) && is_array($shortcode['ds_status']) ? implode(',', $shortcode['ds_status']) : ''; ?>"
                                multiple>
                            <option value=""><?php esc_html_e('All Type', 'fat-portfolio'); ?></option>
                            <?php foreach ($status_tax as $key => $value) { ?>
                                <option value="<?php echo esc_attr($key); ?>"><?php echo esc_html($value); ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </li>
            <?php endif; ?>
            <!-- end show special attribute -->

            <li class="field-group" data-dependence-id="sc_data_source" data-value="ids">
                <div class="fat-title"><?php echo esc_attr__('Select portfolio:', 'fat-portfolio'); ?></div>
                <div class="fat-field">
                    <select id="sc_data_source_ids" class="selectize manual"
                            data-selected="<?php echo isset($shortcode['ids']) && is_array($shortcode['ids']) ? implode(',', $shortcode['ids']) : ''; ?>"
                            multiple>
                        <option value=""><?php esc_html_e('All portfolio', 'fat-portfolio'); ?></option>
                        <?php foreach ($portfolios as $key => $value) { ?>
                            <option value="<?php echo esc_attr($key); ?>"><?php echo esc_html($value); ?></option>
                        <?php } ?>
                    </select>
                </div>
            </li>
            <li class="field-group">
                <div class="fat-title"><?php echo esc_attr__('Author(s):', 'fat-portfolio'); ?></div>
                <div class="fat-field">
                    <select id="sc_data_source_author" class="selectize manual"
                            data-selected="<?php echo isset($shortcode['author']) && is_array($shortcode['author']) ? implode(',', $shortcode['author']) : ''; ?>"
                            multiple>
                        <option value=""><?php esc_html_e('All author', 'fat-portfolio'); ?></option>
                        <?php foreach ($authors as $key => $value) { ?>
                            <option value="<?php echo esc_attr($key); ?>"><?php echo esc_html($value); ?></option>
                        <?php } ?>
                    </select>
                </div>
            </li>
            <li class="field-group">
                <div class="fat-title"><?php echo esc_attr__('Exclude post:', 'fat-portfolio'); ?></div>
                <div class="fat-field">
                    <select id="sc_data_source_exclude_post" class="manual"
                            data-selected="<?php echo isset($shortcode['exclude_post']) && is_array($shortcode['exclude_post']) ? implode(',', $shortcode['exclude_post']) : ''; ?>"
                            multiple>
                        <option value=""><?php esc_html_e('None', 'fat-portfolio'); ?></option>
                        <?php foreach ($portfolios as $key => $value) { ?>
                            <option value="<?php echo esc_attr($key); ?>"><?php echo esc_html($value); ?></option>
                        <?php } ?>
                    </select>
                </div>
            </li>

            <li class="field-group">
                <div class="fat-title">&nbsp;</div>
                <div class="fat-field">
                    <input class="button sc-save button-large button-primary" type="button"
                           value="<?php esc_attr_e('Save', 'fat-portfolio'); ?>"/>
                </div>
            </li>
        </ul>
    </div>

    <div class="tab-setting" id="tab-filter">
        <ul>
            <li class="field-group">
                <div class="fat-title"><?php echo esc_attr__('Filter type:', 'fat-portfolio'); ?></div>
                <div class="fat-field">
                    <select id="sc_filter_type" class="manual"
                            data-selected="<?php echo isset($shortcode['filter_type']) ? $shortcode['filter_type'] : ''; ?>">
                        <option value="isotope"><?php echo esc_attr__('Isotope', 'fat-portfolio'); ?></option>
                        <option value="ajax"><?php echo esc_attr__('Ajax', 'fat-portfolio'); ?></option>
                    </select>
                </div>
            </li>
            <li class="field-group">
                <div class="fat-title"><?php echo esc_attr__('Show filter:', 'fat-portfolio'); ?></div>
                <div class="fat-field">
                    <select id="sc_show_category" class="manual"
                            data-selected="<?php echo isset($shortcode['show_category']) ? $shortcode['show_category'] : ''; ?>">
                        <option value="none"><?php echo esc_attr__('None', 'fat-portfolio'); ?></option>
                        <option value="center"><?php echo esc_attr__('Center', 'fat-portfolio'); ?></option>
                        <option value="left"><?php echo esc_attr__('Left', 'fat-portfolio'); ?></option>
                        <option value="right"><?php echo esc_attr__('Right', 'fat-portfolio'); ?></option>
                    </select>
                </div>
            </li>

            <li class="field-group sc-columns ">
                <div class="fat-title"><?php echo esc_attr__('Hide All Category:', 'fat-portfolio'); ?></div>
                <div class="fat-field">
                    <input type="checkbox"
                           id="sc_hide_all_category" <?php echo isset($shortcode['hide_all_category']) && $shortcode['hide_all_category'] == '1' ? 'checked' : ''; ?>
                           value="1">
                </div>
            </li>

            <li class="field-group">
                <div class="fat-title"><?php echo esc_attr__('Order:', 'fat-portfolio'); ?></div>
                <div class="fat-field">
                    <select id="sc_order" class="manual"
                            data-selected="<?php echo isset($shortcode['order']) ? $shortcode['order'] : ''; ?>">
                        <option value="ASC"><?php esc_html_e('Ascending', 'fat-portfolio'); ?></option>
                        <option value="DESC"><?php esc_html_e('Descending', 'fat-portfolio'); ?></option>
                    </select>
                </div>
            </li>

            <li class="field-group">
                <div class="fat-title"><?php echo esc_attr__('Order by:', 'fat-portfolio'); ?></div>
                <div class="fat-field">
                    <select id="sc_order_by" class="selectize manual"
                            data-selected="<?php echo isset($shortcode['order_by']) && is_array($shortcode['order_by']) ? implode(',', $shortcode['order_by']) : ''; ?>"
                            multiple>
                        <option value="ID"><?php esc_html_e('By post id', 'fat-portfolio'); ?></option>
                        <option value="author"><?php esc_html_e('By author', 'fat-portfolio'); ?></option>
                        <option value="title"><?php esc_html_e('By title', 'fat-portfolio'); ?></option>
                        <option
                                value="name"><?php echo esc_html_e('By post name (post slug)', 'fat-portfolio'); ?></option>
                        <option value="date"><?php esc_html_e('By date', 'fat-portfolio'); ?></option>
                        <option value="rand"><?php esc_html_e('Random order', 'fat-portfolio'); ?></option>
                        <option
                                value="menu_order"><?php esc_html_e('By Page Order (Menu Order)', 'fat-portfolio'); ?></option>
                    </select>
                </div>
            </li>

            <li class="field-group">
                <div class="fat-title">&nbsp;</div>
                <div class="fat-field">
                    <input class="button sc-save button-large button-primary" type="button"
                           value="<?php esc_attr_e('Save', 'fat-portfolio'); ?>"/>
                </div>
            </li>

        </ul>
    </div>

    <div class="tab-setting" id="tab-paging">
        <ul>
            <li class="field-group">
                <div class="fat-title"><?php echo esc_attr__('Paging type:', 'fat-portfolio'); ?></div>
                <div class="fat-field">
                    <select id="sc_paging_type" class="dependence manual"
                            data-selected="<?php echo isset($shortcode['paging_type']) ? $shortcode['paging_type'] : 'paging'; ?>">
                        <option value="paging"><?php echo esc_attr__('Page Numbers', 'fat-portfolio'); ?></option>
                        <option value="load_more"><?php echo esc_attr__('Load more', 'fat-portfolio'); ?></option>
                        <option
                                value="infinity_scroll"><?php echo esc_attr__('Infinite scroll', 'fat-portfolio'); ?></option>
                        <option value="show_all"><?php echo esc_attr__('Show all', 'fat-portfolio'); ?></option>
                    </select>
                </div>
            </li>

            <li class="field-group sc-item-per-page" data-dependence-id="sc_paging_type"
                data-value="paging,load_more,infinity_scroll">
                <div class="fat-title"><?php echo esc_attr__('Item per page:', 'fat-portfolio'); ?></div>
                <div class="fat-field">
                    <input type="number" id="sc_item_per_page"
                           value="<?php echo isset($shortcode['item_per_page']) ? $shortcode['item_per_page'] : ''; ?>">
                </div>
            </li>

            <li class="field-group sc-total-item" data-dependence-id="sc_paging_type"
                data-value="paging,load_more,infinity_scroll">
                <div class="fat-title"><?php echo esc_attr__('Total items:', 'fat-portfolio'); ?></div>
                <div class="fat-field">
                    <input type="number" id="sc_total_item"
                           value="<?php echo isset($shortcode['total_item']) ? $shortcode['total_item'] : ''; ?>">
                    <span class="description"><?php esc_html_e('Set empty for display all', 'fat-portfolio'); ?></span>
                </div>
            </li>

            <li class="field-group sc-prev-text" data-dependence-id="sc_paging_type" data-value="paging">
                <div class="fat-title"><?php echo esc_attr__('Prev text:', 'fat-portfolio'); ?></div>
                <div class="fat-field">
                    <input type="text" id="sc_prev_text"
                           value="<?php echo isset($shortcode['prev_text']) ? $shortcode['prev_text'] : esc_attr__('Previous', 'fat-portfolio'); ?>">
                </div>
            </li>

            <li class="field-group sc-next-text" data-dependence-id="sc_paging_type" data-value="paging">
                <div class="fat-title"><?php echo esc_attr__('Next text:', 'fat-portfolio'); ?></div>
                <div class="fat-field">
                    <input type="text" id="sc_next_text"
                           value="<?php echo isset($shortcode['next_text']) ? $shortcode['next_text'] : esc_attr__('Next', 'fat-portfolio'); ?>">
                </div>
            </li>

            <li class="field-group sc-paging-position" data-dependence-id="sc_paging_type" data-value="paging">
                <div class="fat-title"><?php echo esc_attr__('Position:', 'fat-portfolio'); ?></div>
                <div class="fat-field">
                    <select id="sc_paging_position">
                        <option value="center" <?php echo isset($shortcode['paging_position']) && $shortcode['paging_position'] == 'center' ? 'selected' : ''; ?> ><?php echo esc_html__('Center', 'fat-portfolio'); ?></option>
                        <option value="left" <?php echo isset($shortcode['paging_position']) && $shortcode['paging_position'] == 'left' ? 'selected' : ''; ?> ><?php echo esc_html__('Left', 'fat-portfolio'); ?></option>
                        <option value="right" <?php echo isset($shortcode['paging_position']) && $shortcode['paging_position'] == 'right' ? 'selected' : ''; ?> ><?php echo esc_html__('Right', 'fat-portfolio'); ?></option>
                    </select>
                </div>
            </li>

            <li class="field-group sc-prev-text" data-dependence-id="sc_paging_type" data-value="load_more">
                <div class="fat-title"><?php echo esc_attr__('Load more text:', 'fat-portfolio'); ?></div>
                <div class="fat-field">
                    <input type="text" id="sc_load_more_text"
                           value="<?php echo isset($shortcode['load_more']) ? $shortcode['load_more'] : esc_attr__('Load more', 'fat-portfolio'); ?>">
                </div>
            </li>

            <li class="field-group" data-dependence-id="sc_paging_type" data-value="paging">
                <div class="fat-title"><?php esc_html_e('Background active/hover color :', 'fat-portfolio'); ?> </div>
                <div class="fat-field">
                    <div class="input-group colorpicker-component  colorpicker-element">
                        <input type="text" id="sc_paging_background_color"
                               value="<?php echo isset($shortcode['paging_background_color']) ? $shortcode['paging_background_color'] : '#343434'; ?>"
                               class="colorPicker form-control"/>
                        <span class="input-group-addon"><i></i></span>
                    </div>

                </div>
            </li>

            <li class="field-group" data-dependence-id="sc_paging_type" data-value="paging">
                <div class="fat-title"><?php esc_html_e('Text active/hover color :', 'fat-portfolio'); ?> </div>
                <div class="fat-field">
                    <div class="input-group colorpicker-component  colorpicker-element">
                        <input type="text" id="sc_paging_text_color"
                               value="<?php echo isset($shortcode['paging_text_color']) ? $shortcode['paging_text_color'] : '#fff'; ?>"
                               class="colorPicker form-control"/>
                        <span class="input-group-addon"><i></i></span>
                    </div>

                </div>
            </li>

            <li class="field-group" data-dependence-id="sc_paging_type" data-value="load_more">
                <div class="fat-title"><?php esc_html_e('Background color :', 'fat-portfolio'); ?> </div>
                <div class="fat-field">
                    <div class="input-group colorpicker-component  colorpicker-element">
                        <input type="text" id="sc_load_more_background_color"
                               value="<?php echo isset($shortcode['load_more_background_color"']) ? $shortcode['load_more_background_color"'] : '#343434'; ?>"
                               class="colorPicker form-control"/>
                        <span class="input-group-addon"><i></i></span>
                    </div>

                </div>
            </li>

            <li class="field-group" data-dependence-id="sc_paging_type" data-value="load_more">
                <div class="fat-title"><?php esc_html_e('Text color :', 'fat-portfolio'); ?> </div>
                <div class="fat-field">
                    <div class="input-group colorpicker-component  colorpicker-element">
                        <input type="text" id="sc_load_more_text_color"
                               value="<?php echo isset($shortcode['load_more_text_color']) ? $shortcode['load_more_text_color'] : '#fff'; ?>"
                               class="colorPicker form-control"/>
                        <span class="input-group-addon"><i></i></span>
                    </div>

                </div>
            </li>

            <li class="field-group" data-dependence-id="sc_paging_type" data-value="load_more">
                <div class="fat-title"><?php esc_html_e('Background hover color :', 'fat-portfolio'); ?> </div>
                <div class="fat-field">
                    <div class="input-group colorpicker-component  colorpicker-element">
                        <input type="text" id="sc_load_more_background_hover_color"
                               value="<?php echo isset($shortcode['load_more_background_hover_color"']) ? $shortcode['load_more_background_hover_color"'] : '#343434'; ?>"
                               class="colorPicker form-control"/>
                        <span class="input-group-addon"><i></i></span>
                    </div>

                </div>
            </li>

            <li class="field-group" data-dependence-id="sc_paging_type" data-value="load_more">
                <div class="fat-title"><?php esc_html_e('Text active/hover color :', 'fat-portfolio'); ?> </div>
                <div class="fat-field">
                    <div class="input-group colorpicker-component  colorpicker-element">
                        <input type="text" id="sc_load_more_text_hover_color"
                               value="<?php echo isset($shortcode['load_more_text_hover_color']) ? $shortcode['load_more_text_hover_color'] : '#fff'; ?>"
                               class="colorPicker form-control"/>
                        <span class="input-group-addon"><i></i></span>
                    </div>

                </div>
            </li>

            <li class="field-group" data-dependence-id="sc_paging_type" data-value="infinity_scroll">
                <div class="fat-title"><?php esc_html_e('Loading color :', 'fat-portfolio'); ?> </div>
                <div class="fat-field">
                    <div class="input-group colorpicker-component  colorpicker-element">
                        <input type="text" id="sc_infinity_loading_color"
                               value="<?php echo isset($shortcode['infinity_loading_color']) ? $shortcode['infinity_loading_color'] : '#343434'; ?>"
                               class="colorPicker form-control"/>
                        <span class="input-group-addon"><i></i></span>
                    </div>

                </div>
            </li>

            <li class="field-group">
                <div class="fat-title">&nbsp;</div>
                <div class="fat-field">
                    <input class="button sc-save button-large button-primary" type="button"
                           value="<?php esc_attr_e('Save', 'fat-portfolio'); ?>"/>
                </div>
            </li>
        </ul>
    </div>

    <div class="tab-setting" id="tab-carousel">
        <ul class="carousel-config" data-dependence-id="sc_layout_type" data-value="carousel">

            <li class="field-group ">
                <div class="fat-title"><?php echo esc_attr__('Total items:', 'fat-portfolio'); ?></div>
                <div class="fat-field">
                    <input type="number" id="sc_slider_total_item"
                           value="<?php echo isset($shortcode['slider_total_item']) ? $shortcode['slider_total_item'] : ''; ?>">
                    <span class="description"><?php esc_html_e('Set empty for display all', 'fat-portfolio'); ?></span>
                </div>
            </li>

            <li class="field-group">
                <div class="fat-title"><?php echo esc_attr__('Desktop large columns:', 'fat-portfolio'); ?></div>
                <div class="fat-field">
                    <input type="number" id="sc_slider_desktop_large_column"
                           value="<?php echo isset($shortcode['slider_desktop_large_column']) ? $shortcode['slider_desktop_large_column'] : 4; ?>">
                </div>
            </li>

            <li class="field-group  field-width-125">
                <div class="fat-title"><?php echo esc_attr__('Desktop medium columns:', 'fat-portfolio'); ?></div>
                <div class="fat-field">
                    <input type="number" id="sc_slider_desktop_medium_column"
                           value="<?php echo isset($shortcode['slider_desktop_medium_column']) ? $shortcode['slider_desktop_medium_column'] : 4; ?>">
                    <span><?php esc_html_e('Width:', 'fat-portfolio'); ?></span>
                    <input type="number" id="sc_slider_desktop_medium_width"
                           value="<?php echo isset($shortcode['slider_desktop_medium_width']) ? $shortcode['slider_desktop_medium_width'] : 1200; ?>">
                </div>
            </li>

            <li class="field-group field-width-125">
                <div class="fat-title"><?php echo esc_attr__('Desktop small columns:', 'fat-portfolio'); ?></div>
                <div class="fat-field">
                    <input type="number" id="sc_slider_desktop_small_column"
                           value="<?php echo isset($shortcode['slider_desktop_small_column']) ? $shortcode['slider_desktop_small_column'] : 4; ?>">
                    <span><?php esc_html_e('Width:', 'fat-portfolio'); ?></span>
                    <input type="number" id="sc_slider_desktop_small_width"
                           value="<?php echo isset($shortcode['slider_desktop_small_width']) ? $shortcode['slider_desktop_small_width'] : 980; ?>">
                </div>
            </li>

            <li class="field-group field-width-125">
                <div class="fat-title"><?php echo esc_attr__('Tablet columns:', 'fat-portfolio'); ?></div>
                <div class="fat-field">
                    <input type="number" id="sc_slider_tablet_column"
                           value="<?php echo isset($shortcode['slider_tablet_column']) ? $shortcode['slider_tablet_column'] : 3; ?>">
                    <span><?php esc_html_e('Width:', 'fat-portfolio'); ?></span>
                    <input type="number" id="sc_slider_tablet_width"
                           value="<?php echo isset($shortcode['slider_tablet_width']) ? $shortcode['slider_tablet_width'] : 768; ?>">
                </div>
            </li>

            <li class="field-group field-width-125">
                <div class="fat-title"><?php echo esc_attr__('Tablet small columns:', 'fat-portfolio'); ?></div>
                <div class="fat-field">
                    <input type="number" id="sc_slider_tablet_small_column"
                           value="<?php echo isset($shortcode['slider_tablet_small_column']) ? $shortcode['slider_tablet_small_column'] : 2; ?>">
                    <span><?php esc_html_e('Width:', 'fat-portfolio'); ?></span>
                    <input type="number" id="sc_slider_tablet_small_width"
                           value="<?php echo isset($shortcode['slider_tablet_small_width']) ? $shortcode['slider_tablet_small_width'] : 480; ?>">
                </div>
            </li>

            <li class="field-group field-width-125">
                <div class="fat-title"><?php echo esc_attr__('Mobile columns:', 'fat-portfolio'); ?></div>
                <div class="fat-field">
                    <input type="number" id="sc_slider_mobile_column"
                           value="<?php echo isset($shortcode['slider_mobile_column']) ? $shortcode['slider_mobile_column'] : 1; ?>">
                    <span><?php esc_html_e('Width:', 'fat-portfolio'); ?></span>
                    <input type="number" id="sc_slider_mobile_width"
                           value="<?php echo isset($shortcode['slider_mobile_width']) ? $shortcode['slider_mobile_width'] : 320; ?>">
                </div>
            </li>

            <li class="field-group">
                <div class="fat-title"><?php echo esc_attr__('Display dot navigation:', 'fat-portfolio'); ?></div>
                <div class="fat-field">
                    <input type="checkbox"
                           id="sc_slider_show_dot" <?php echo isset($shortcode['slider_show_dot']) && $shortcode['slider_show_dot'] == 'true' ? 'checked' : ''; ?>
                           value="1">
                </div>
            </li>

            <li class="field-group">
                <div class="fat-title"><?php echo esc_attr__('Display prev & next navigation:', 'fat-portfolio'); ?></div>
                <div class="fat-field">
                    <input type="checkbox"
                           id="sc_slider_show_nav_text" <?php echo isset($shortcode['slider_show_nav_text']) && $shortcode['slider_show_nav_text'] == 'true' ? 'checked' : ''; ?>
                           value="1">
                </div>
            </li>

            <li class="field-group">
                <div class="fat-title"><?php esc_html_e('Navigation background color :', 'fat-portfolio'); ?> </div>
                <div class="fat-field">
                    <div class="input-group colorpicker-component  colorpicker-element">
                        <input type="text" id="sc_slider_nav_bg_color"
                               value="<?php echo isset($shortcode['slider_nav_bg_color']) ? $shortcode['slider_nav_bg_color'] : 'rgba(0,0,0,0.2)'; ?>"
                               class="colorPicker form-control"/>
                        <span class="input-group-addon"><i></i></span>
                    </div>

                </div>
            </li>
            <li class="field-group">
                <div class="fat-title"><?php esc_html_e('Navigation text color :', 'fat-portfolio'); ?> </div>
                <div class="fat-field">
                    <div class="input-group colorpicker-component  colorpicker-element">
                        <input type="text" id="sc_slider_nav_text_color"
                               value="<?php echo isset($shortcode['slider_nav_text_color']) ? $shortcode['slider_nav_text_color'] : '#fff'; ?>"
                               class="colorPicker form-control"/>
                        <span class="input-group-addon"><i></i></span>
                    </div>

                </div>
            </li>
            <li class="field-group">
                <div
                        class="fat-title"><?php esc_html_e('Navigation background hover/active color :', 'fat-portfolio'); ?> </div>
                <div class="fat-field">
                    <div class="input-group colorpicker-component  colorpicker-element">
                        <input type="text" id="sc_slider_nav_bg_hover_color"
                               value="<?php echo isset($shortcode['slider_nav_bg_hover_color']) ? $shortcode['slider_nav_bg_hover_color'] : 'rgba(0,0,0,0.8)'; ?>"
                               class="colorPicker form-control"/>
                        <span class="input-group-addon"><i></i></span>
                    </div>
                </div>
            </li>
            <li class="field-group">
                <div class="fat-title"><?php esc_html_e('Navigation text hover color :', 'fat-portfolio'); ?> </div>
                <div class="fat-field">
                    <div class="input-group colorpicker-component  colorpicker-element">
                        <input type="text" id="sc_slider_nav_text_hover_color"
                               value="<?php echo isset($shortcode['slider_nav_text_hover_color']) ? $shortcode['slider_nav_text_hover_color'] : '#fff'; ?>"
                               class="colorPicker form-control"/>
                        <span class="input-group-addon"><i></i></span>
                    </div>

                </div>
            </li>

            <li class="field-group">
                <div class="fat-title"><?php echo esc_attr__('Loop:', 'fat-portfolio'); ?></div>
                <div class="fat-field">
                    <input type="checkbox"
                           id="sc_slider_loop" <?php echo isset($shortcode['slider_loop']) && $shortcode['slider_loop'] == 'true' ? 'checked' : ''; ?>
                           value="1">
                </div>
            </li>

            <li class="field-group">
                <div class="fat-title"><?php echo esc_attr__('Auto play:', 'fat-portfolio'); ?></div>
                <div class="fat-field">
                    <input type="checkbox"
                           id="sc_slider_auto_play" <?php echo isset($shortcode['slider_auto_play']) && $shortcode['slider_auto_play'] == 'true' ? 'checked' : ''; ?>
                           value="1">
                </div>
            </li>
            <li class="field-group ">
                <div class="fat-title"><?php echo esc_attr__('Auto play time:', 'fat-portfolio'); ?></div>
                <div class="fat-field">
                    <input type="number" id="sc_slider_auto_play_time"
                           value="<?php echo isset($shortcode['slider_auto_play_time']) ? $shortcode['slider_auto_play_time'] : 2000; ?>">
                    <span class="description"><?php esc_html_e('miliseconds', 'fat-portfolio'); ?></span>
                </div>
            </li>

            <li class="field-group ">
                <div class="fat-title"><?php echo esc_attr__('Right to left (RTL):', 'fat-portfolio'); ?></div>
                <div class="fat-field">
                    <input type="checkbox"
                           id="sc_slider_rtl" <?php echo isset($shortcode['slider_rtl']) && $shortcode['slider_rtl'] == 'true' ? 'checked' : ''; ?>
                           value="1">
                </div>
            </li>

            <li class="field-group">
                <div class="fat-title">&nbsp;</div>
                <div class="fat-field">
                    <input class="button sc-save button-large button-primary" type="button"
                           value="<?php esc_attr_e('Save', 'fat-portfolio'); ?>"/>
                </div>
            </li>
        </ul>

        <ul class="flipster-config" data-dependence-id="sc_layout_type"
            data-value="flipster-coverflow,flipster-carousel">

            <li class="field-group ">
                <div class="fat-title"><?php echo esc_attr__('Total items:', 'fat-portfolio'); ?></div>
                <div class="fat-field">
                    <input type="number" id="sc_flipster_total_item" min="0" max="1000"
                           value="<?php echo isset($shortcode['flispter_total_item']) ? $shortcode['flispter_total_item'] : ''; ?>">
                    <span class="description"><?php esc_html_e('Set empty for display all', 'fat-portfolio'); ?></span>
                </div>
            </li>

            <li class="field-group">
                <div class="fat-title"><?php echo esc_attr__('Loop:', 'fat-portfolio'); ?></div>
                <div class="fat-field">
                    <input type="checkbox"
                           id="sc_flispter_loop" <?php echo isset($shortcode['flispter_loop']) && $shortcode['flispter_loop'] == 'true' ? 'checked' : ''; ?>
                           value="1">
                </div>
            </li>

            <li class="field-group">
                <div class="fat-title"><?php echo esc_attr__('Auto play time:', 'fat-portfolio'); ?></div>
                <div class="fat-field">
                    <input type="number" id="sc_flipster_autoplay" min="3000" max="10000" step="500"
                           value="<?php echo isset($shortcode['flipster_autoplay']) ? $shortcode['flipster_autoplay'] : ''; ?>">
                    (milisecond)
                    <span class="description"><?php esc_html_e('Set empty or 0 for disable auto play', 'fat-portfolio'); ?></span>
                </div>
            </li>

            <li class="field-group">
                <div class="fat-title"><?php echo esc_attr__('Pause on hover:', 'fat-portfolio'); ?></div>
                <div class="fat-field">
                    <input type="checkbox"
                           id="sc_flispter_pause_on_hover" <?php echo isset($shortcode['flispter_pause_on_hover']) && $shortcode['flispter_pause_on_hover'] == 'true' ? 'checked' : ''; ?>
                           value="1">
                </div>
            </li>

            <li class="field-group">
                <div class="fat-title"><?php echo esc_attr__('Item spacing:', 'fat-portfolio'); ?></div>
                <div class="fat-field">
                    <input type="number" id="sc_flispter_item_spacing" min="-0.6" max="0" step="0.1"
                           value="<?php echo isset($shortcode['flispter_item_spacing']) ? $shortcode['flispter_item_spacing'] : '-0.6'; ?>">
                </div>
            </li>

            <li class="field-group">
                <div class="fat-title"><?php echo esc_attr__('Show prev & next :', 'fat-portfolio'); ?></div>
                <div class="fat-field">
                    <input type="checkbox"
                           id="sc_flispter_nav" <?php echo isset($shortcode['flispter_nav']) && $shortcode['flispter_nav'] == 'true' ? 'checked' : ''; ?>
                           value="1">
                </div>
            </li>

            <li class="field-group">
                <div class="fat-title"><?php esc_html_e('Navigation color :', 'fat-portfolio'); ?> </div>
                <div class="fat-field">
                    <div class="input-group colorpicker-component  colorpicker-element">
                        <input type="text" id="sc_flipster_nav_color"
                               value="<?php echo isset($shortcode['flipster_nav_color']) ? $shortcode['flipster_nav_color'] : '#343434'; ?>"
                               class="colorPicker form-control"/>
                        <span class="input-group-addon"><i></i></span>
                    </div>

                </div>
            </li>

            <li class="field-group">
                <div class="fat-title">&nbsp;</div>
                <div class="fat-field">
                    <input class="button sc-save button-large button-primary" type="button"
                           value="<?php esc_attr_e('Save', 'fat-portfolio'); ?>"/>
                </div>
            </li>
        </ul>
    </div>

    <div class="tab-setting" id="tab-skin">
        <ul>
            <li class="field-group sc-skins">
                <div class="fat-title"><?php echo esc_attr__('Skin:', 'fat-portfolio'); ?></div>
                <div class="fat-field skins-wrap fat-image-wrap col-4">
                    <?php foreach ($skins as $key => $value) { ?>
                        <div
                                class="image-item  <?php echo isset($shortcode['skin']) && $shortcode['skin'] === $key ? 'active' : ''; ?>"
                                data-value="<?php echo esc_attr($key); ?>"
                                data-img="<?php echo esc_url($value['image']); ?>">
                            <div class="image-item-inner">
                                <img src="<?php echo esc_url($value['image']); ?>"
                                     title="<?php echo esc_attr($value['title']); ?>">
                                <a class="select-layout"><i class="fa fa-check-square-o"></i></a>
                                <span class="skin-title"><?php echo esc_html($value['title']); ?></span>
                            </div>
                        </div>
                    <?php }; ?>

                    <input type="hidden" name="sc_skin" id="sc_skin"
                           value="<?php echo isset($shortcode['skin']) ? $shortcode['skin'] : ''; ?>"/>
                </div>
            </li>

            <li class="field-group">
                <div class="fat-title"><?php echo esc_attr__('Limit words in excerpt:', 'fat-portfolio'); ?></div>
                <div class="fat-field">
                    <input type="number" id="sc_limit_words_excerpt" min="0" max="50" step="5"
                           value="<?php echo isset($shortcode['limit_words_excerpt']) ? $shortcode['limit_words_excerpt'] : ''; ?>">
                    <span class="description"><?php esc_html_e('Input number of words to display excerpt. Set empty to display default', 'fat-portfolio'); ?></span>
                </div>
            </li>

            <li class="field-group sc-animation" data-dependence-id="sc_layout_type"
                data-value="flipster-coverflow,grid,grid,masonry,metro-style-one,metro-style-two,metro-style-three,carousel,3d-carousel">
                <div class="fat-title"><?php echo esc_attr__('Animation:', 'fat-portfolio'); ?></div>
                <div class="fat-field">
                    <select id="sc_animation" class="manual"
                            data-selected="<?php echo isset($shortcode['animation']) ? $shortcode['animation'] : ''; ?>">
                        <?php foreach ($animations as $key => $value) { ?>
                            <option value="<?php echo esc_attr($key); ?>"><?php echo esc_html($value); ?></option>
                        <?php } ?>
                    </select>
                    <a class="preview-animation" href="javascript:"><i
                                class="fa fa-play-circle-o"></i><?php esc_attr_e('Preview', 'grid-plus'); ?></a>
                </div>
            </li>
            <li class="field-group sc-animation" data-dependence-id="sc_layout_type"
                data-value="flipster-coverflow,grid,grid,masonry,metro-style-one,metro-style-two,metro-style-three">
                <div class="fat-title"><?php echo esc_attr__('Animation duration between items:', 'fat-portfolio'); ?></div>
                <div class="fat-field">
                    <input type="number" id="sc_animation_duration" min="100" max="1000" step="10"
                           value="<?php echo isset($shortcode['animation_duration']) ? $shortcode['animation_duration'] : 200; ?>"> <?php esc_html_e('(minisecond)', 'fat-portfolio'); ?>
                </div>
            </li>
            <li class="field-group sc-animation" data-dependence-id="sc_layout_type"
                data-value="flipster-coverflow,grid,grid,masonry,metro-style-one,metro-style-two,metro-style-three,carousel,3d-carousel">
                <div class="fat-title">&nbsp;</div>
                <div class="fat-field">
                    <div class="animation-wrap">
                        <img src="<?php echo esc_url($image_preview); ?>">
                    </div>
                </div>
            </li>

            <li class="field-group">
                <div class="fat-title">&nbsp;</div>
                <div class="fat-field">
                    <input class="button sc-save button-large button-primary" type="button"
                           value="<?php esc_attr_e('Save', 'fat-portfolio'); ?>"/>
                </div>
            </li>
        </ul>
    </div>

    <div class="tab-setting" id="tab-font-style">
        <ul>
            <li class="field-group">
                <div class="fat-title">Category filter font size:</div>
                <div class="fat-field">
                    <div class="ranger-slider-container">
                        <div class="ranger-slider" style="width: 300px">
                            <input id="sc_category_filter_font_size" type="range" min="10" max="50" step="1"
                                   value="<?php echo isset($shortcode['category_filter_font_size']) ? $shortcode['category_filter_font_size'] : '14'; ?>"
                                   data-output-id="rg-output-category-filter-font-size"
                                   name="category_filter_font_size"/>
                        </div>
                        <input id="rg-output-category-filter-font-size" data-range-id="sc_category_filter_font_size"
                               type="number"
                               value="<?php echo isset($shortcode['category_filter_font_size']) ? $shortcode['category_filter_font_size'] : '14'; ?>">
                        (px)
                    </div>
                </div>
            </li>
            <li class="field-group">
                <div class="fat-title"><?php esc_html_e('Category filter style:', 'fat-portfolio'); ?> </div>
                <div class="fat-field">
                    <select name="sc_category_filter_style" class="manual" id="sc_category_filter_style"
                            data-selected="<?php echo isset($shortcode['category_filter_style']) ? $shortcode['category_filter_style'] : ''; ?>">
                        <option value="normal"><?php echo esc_html__('Normal', 'fat-portfolio') ?></option>
                        <option value="italic"><?php echo esc_html__('Italic', 'fat-portfolio') ?></option>
                    </select>
                </div>
            </li>
            <li class="field-group">
                <div class="fat-title"><?php esc_html_e('Category filter weight:', 'fat-portfolio'); ?> </div>
                <div class="fat-field">
                    <select name="sc_category_filter_weight" class="manual" id="sc_category_filter_weight"
                            data-selected="<?php echo isset($shortcode['category_filter_weight']) ? $shortcode['category_filter_weight'] : ''; ?>">
                        <option value="400"><?php echo esc_html__('Normal', 'fat-portfolio') ?></option>
                        <option value="500"><?php echo esc_html__('Semibold', 'fat-portfolio') ?></option>
                        <option value="600"><?php echo esc_html__('Medium', 'fat-portfolio') ?></option>
                        <option value="700"><?php echo esc_html__('Bold', 'fat-portfolio') ?></option>
                    </select>
                </div>
            </li>
            <li class="field-group">
                <div class="fat-title"><?php esc_html_e('Category filter text transform:', 'fat-portfolio'); ?> </div>
                <div class="fat-field">
                    <select name="sc_category_filter_text_transform" id="sc_category_filter_text_transform"
                            class="manual"
                            data-selected="<?php echo isset($shortcode['category_filter_text_transform']) ? $shortcode['category_filter_text_transform'] : ''; ?>">
                        <option value="none"><?php echo esc_html__('None', 'fat-portfolio') ?></option>
                        <option value="uppercase"><?php echo esc_html__('Uppercase', 'fat-portfolio') ?></option>
                        <option value="lowercase"><?php echo esc_html__('Lowercase', 'fat-portfolio') ?></option>
                    </select>
                </div>
            </li>

            <li class="field-group">
                <div class="fat-title"><?php esc_html_e('Category filter letter spacing:', 'fat-portfolio'); ?></div>
                <div class="fat-field">
                    <div class="ranger-slider-container">
                        <div class="ranger-slider" style="width: 300px">
                            <input id="sc_category_filter_letter_spacing" type="range" min="1" max="5" step="1"
                                   value="<?php echo isset($shortcode['category_filter_letter_spacing']) ? $shortcode['category_filter_letter_spacing'] : '1'; ?>"
                                   data-output-id="rg-output-category-filter-letter-spacing"
                                   name="category_filter_letter_spacing"/>
                        </div>
                        <input id="rg-output-category-filter-letter-spacing"
                               data-range-id="sc_category_filter_letter_spacing" type="number"
                               value="<?php echo isset($shortcode['category_filter_letter_spacing']) ? $shortcode['category_filter_letter_spacing'] : '1'; ?>">
                        (px)
                    </div>
                </div>
            </li>

            <li class="field-group">
                <div class="fat-title"><?php esc_html_e('Category filter text color :', 'fat-portfolio'); ?> </div>
                <div class="fat-field">
                    <div class="input-group colorpicker-component  colorpicker-element">
                        <input type="text" id="sc_category_filter_text_color"
                               value="<?php echo isset($shortcode['category_filter_text_color']) ? $shortcode['category_filter_text_color'] : '#343434'; ?>"
                               class="colorPicker form-control"/>
                        <span class="input-group-addon"><i></i></span>
                    </div>

                </div>
            </li>
            <li class="field-group">
                <div
                        class="fat-title"><?php esc_html_e('Category filter text hover/active color :', 'fat-portfolio'); ?> </div>
                <div class="fat-field">
                    <div class="input-group colorpicker-component  colorpicker-element">
                        <input type="text" id="sc_category_filter_text_hover_color"
                               value="<?php echo isset($shortcode['category_filter_text_hover_color']) ? $shortcode['category_filter_text_hover_color'] : '#343434'; ?>"
                               class="colorPicker form-control"/>
                        <span class="input-group-addon"><i></i></span>
                    </div>
                </div>
            </li>

            <li class="field-group">
                <div class="fat-title"><?php esc_html_e('Category font size:', 'fat-portfolio'); ?> </div>
                <div class="fat-field">
                    <div class="ranger-slider-container">
                        <div class="ranger-slider" style="width: 300px">
                            <input id="sc_category_font_size" type="range" min="10" max="50" step="1"
                                   value="<?php echo isset($shortcode['category_font_size']) ? $shortcode['category_font_size'] : '14'; ?>"
                                   data-output-id="rg-output-category-font-size" name="category_font_size"/>
                        </div>
                        <input id="rg-output-category-font-size" data-range-id="sc_category_font_size" type="number"
                               value="<?php echo isset($shortcode['category_font_size']) ? $shortcode['category_font_size'] : '14'; ?>">
                        (px)
                    </div>
                </div>
            </li>
            <li class="field-group">
                <div class="fat-title"><?php esc_html_e('Category style:', 'fat-portfolio'); ?></div>
                <div class="fat-field">
                    <select name="sc_category_style" id="sc_category_style" class="manual"
                            data-selected="<?php echo isset($shortcode['category_style']) ? $shortcode['category_style'] : ''; ?>">
                        <option value="normal"><?php echo esc_html__('Normal', 'fat-portfolio') ?></option>
                        <option value="italic"><?php echo esc_html__('Italic', 'fat-portfolio') ?></option>
                    </select>
                </div>
            </li>
            <li class="field-group">
                <div class="fat-title"><?php esc_html_e('Category style weight:', 'fat-portfolio'); ?> </div>
                <div class="fat-field">
                    <select name="sc_category_style_weight" class="manual" id="sc_category_style_weight"
                            data-selected="<?php echo isset($shortcode['category_style_weight']) ? $shortcode['category_style_weight'] : ''; ?>">
                        <option value="400"><?php echo esc_html__('Normal', 'fat-portfolio') ?></option>
                        <option value="500"><?php echo esc_html__('Semibold', 'fat-portfolio') ?></option>
                        <option value="600"><?php echo esc_html__('Medium', 'fat-portfolio') ?></option>
                        <option value="700"><?php echo esc_html__('Bold', 'fat-portfolio') ?></option>
                    </select>
                </div>
            </li>
            <li class="field-group">
                <div class="fat-title"><?php esc_html_e('Category text transform:', 'fat-portfolio'); ?></div>
                <div class="fat-field">
                    <select id="sc_category_text_transform" class="manual"
                            data-selected="<?php echo isset($shortcode['category_text_transform']) ? $shortcode['category_text_transform'] : ''; ?>">
                        <option value="none"><?php echo esc_html__('None', 'fat-portfolio') ?></option>
                        <option
                                value="uppercase"><?php echo esc_html__('Uppercase', 'fat-portfolio') ?></option>
                        <option
                                value="lowercase"><?php echo esc_html__('Lowercase', 'fat-portfolio') ?></option>
                    </select>
                </div>
            </li>

            <li class="field-group">
                <div class="fat-title"><?php esc_html_e('Category letter spacing:', 'fat-portfolio'); ?></div>
                <div class="fat-field">
                    <div class="ranger-slider-container">
                        <div class="ranger-slider" style="width: 300px">
                            <input id="sc_category_letter_spacing" type="range" min="1" max="5" step="1"
                                   value="<?php echo isset($shortcode['category_letter_spacing']) ? $shortcode['category_letter_spacing'] : '1'; ?>"
                                   data-output-id="rg-output-category-letter-spacing" name="category_letter_spacing"/>
                        </div>
                        <input id="rg-output-category-letter-spacing" data-range-id="sc_category_letter_spacing"
                               type="number"
                               value="<?php echo isset($shortcode['category_letter_spacing']) ? $shortcode['category_letter_spacing'] : '1'; ?>">
                        (px)
                    </div>
                </div>
            </li>

            <li class="field-group">
                <div class="fat-title"><?php esc_html_e('Category text color :', 'fat-portfolio'); ?></div>
                <div class="fat-field">
                    <div class="input-group colorpicker-component  colorpicker-element">
                        <input type="text" id='sc_category_text_color'
                               value="<?php echo isset($shortcode['category_text_color']) ? $shortcode['category_text_color'] : '#343434'; ?>"
                               class="colorPicker form-control"/>
                        <span class="input-group-addon"><i></i></span>
                    </div>

                </div>
            </li>

            <li class="field-group">
                <div class="fat-title"><?php esc_html_e('Title font size:', 'fat-portfolio'); ?></div>
                <div class="fat-field">
                    <div class="ranger-slider-container">
                        <div class="ranger-slider" style="width: 300px">
                            <input id="sc_title_font_size" type="range" min="10" max="50" step="1"
                                   value="<?php echo isset($shortcode['title_font_size']) ? $shortcode['title_font_size'] : '14'; ?>"
                                   data-output-id="rg-output-title-font-size" name="title_font_size"/>
                        </div>
                        <input id="rg-output-title-font-size" data-range-id="sc_title_font_size" type="number"
                               value="<?php echo isset($shortcode['title_font_size']) ? $shortcode['title_font_size'] : '14'; ?>">
                        (px)
                    </div>
                </div>
            </li>

            <li class="field-group">
                <div class="fat-title"><?php esc_html_e('Title style:', 'fat-portfolio'); ?></div>
                <div class="fat-field">
                    <select id="sc_title_style" class="manual"
                            data-selected="<?php echo isset($shortcode['title_style']) ? $shortcode['title_style'] : ''; ?>">
                        <option value="normal"><?php echo esc_html__('Normal', 'fat-portfolio') ?></option>
                        <option value="italic"><?php echo esc_html__('Italic', 'fat-portfolio') ?></option>
                    </select>
                </div>
            </li>

            <li class="field-group">
                <div class="fat-title"><?php esc_html_e('Title style weight:', 'fat-portfolio'); ?> </div>
                <div class="fat-field">
                    <select name="sc_title_style_weight" class="manual" id="sc_title_style_weight"
                            data-selected="<?php echo isset($shortcode['title_style_weight']) ? $shortcode['title_style_weight'] : ''; ?>">
                        <option value="400"><?php echo esc_html__('Normal', 'fat-portfolio') ?></option>
                        <option value="500"><?php echo esc_html__('Semibold', 'fat-portfolio') ?></option>
                        <option value="600"><?php echo esc_html__('Medium', 'fat-portfolio') ?></option>
                        <option value="700"><?php echo esc_html__('Bold', 'fat-portfolio') ?></option>
                    </select>
                </div>
            </li>

            <li class="field-group">
                <div class="fat-title"><?php esc_html_e('Title text transform:', 'fat-portfolio'); ?></div>
                <div class="fat-field">
                    <select id="sc_title_text_transform" class="manual"
                            data-selected="<?php echo isset($shortcode['title_text_transform']) ? $shortcode['title_text_transform'] : ''; ?>">
                        <option value="none"><?php echo esc_html__('None', 'fat-portfolio') ?></option>
                        <option value="uppercase"><?php echo esc_html__('Uppercase', 'fat-portfolio') ?></option>
                        <option value="lowercase"><?php echo esc_html__('Lowercase', 'fat-portfolio') ?></option>
                    </select>
                </div>
            </li>

            <li class="field-group">
                <div class="fat-title"><?php esc_html_e('Title letter spacing:', 'fat-portfolio'); ?></div>
                <div class="fat-field">
                    <div class="ranger-slider-container">
                        <div class="ranger-slider" style="width: 300px">
                            <input id="sc_title_letter_spacing" type="range" min="1" max="5" step="1"
                                   value="<?php echo isset($shortcode['title_letter_spacing']) ? $shortcode['title_letter_spacing'] : '1'; ?>"
                                   data-output-id="rg-output-title-letter-spacing" name="title_letter_spacing"/>
                        </div>
                        <input id="rg-output-title-letter-spacing" data-range-id="sc_title_letter_spacing" type="number"
                               value="<?php echo isset($shortcode['title_letter_spacing']) ? $shortcode['title_letter_spacing'] : '1'; ?>">
                        (px)
                    </div>
                </div>
            </li>

            <li class="field-group">
                <div class="fat-title"><?php esc_html_e('Title text color :', 'fat-portfolio'); ?></div>
                <div class="fat-field">
                    <div class="input-group colorpicker-component  colorpicker-element">
                        <input type="text" id="sc_title_text_color"
                               value="<?php echo isset($shortcode['title_text_color']) ? $shortcode['title_text_color'] : '#343434'; ?>"
                               class="colorPicker form-control"/>
                        <span class="input-group-addon"><i></i></span>
                    </div>

                </div>
            </li>

            <li class="field-group">
                <div class="fat-title"><?php esc_html_e('Icon/Excerpt size:', 'fat-portfolio'); ?></div>
                <div class="fat-field">
                    <div class="ranger-slider-container">
                        <div class="ranger-slider" style="width: 300px">
                            <input id="sc_icon_font_size" type="range" min="10" max="50" step="1"
                                   value="<?php echo isset($shortcode['icon_font_size']) ? $shortcode['icon_font_size'] : '14'; ?>"
                                   data-output-id="rg-output-icon-font-size" name="icon_font_size"/>
                        </div>
                        <input id="rg-output-icon-font-size" data-range-id="sc_icon_font_size" type="number"
                               value="<?php echo isset($shortcode['icon_font_size']) ? $shortcode['icon_font_size'] : '14'; ?>">
                        (px)
                        <span class="description">Appy to excerpt in skin 'Thumb - title - excerpt hover'</span>
                    </div>
                </div>
            </li>

            <li class="field-group">
                <div class="fat-title"><?php esc_html_e('Icon/Excerpt color :', 'fat-portfolio'); ?></div>
                <div class="fat-field">
                    <div class="input-group colorpicker-component  colorpicker-element">
                        <input type="text" name="sc_icon_color" id="sc_icon_color"
                               value="<?php echo isset($shortcode['icon_color']) ? $shortcode['icon_color'] : '#ffffff'; ?>"
                               class="colorPicker form-control"/>
                        <span class="input-group-addon"><i></i></span>
                        <span class="description">Appy to excerpt in skin 'Thumb - title - excerpt hover'</span>
                    </div>

                </div>
            </li>

            <li class="field-group">
                <div class="fat-title"><?php esc_html_e('Icon hover color :', 'fat-portfolio'); ?></div>
                <div class="fat-field">
                    <div class="input-group colorpicker-component  colorpicker-element">
                        <input type="text" id="sc_icon_hover_color"
                               value="<?php echo isset($shortcode['icon_hover_color']) ? $shortcode['icon_hover_color'] : '#ffffff'; ?>"
                               class="colorPicker form-control"/>
                        <span class="input-group-addon"><i></i></span>
                    </div>

                </div>
            </li>

            <li class="field-group">
                <div class="fat-title"><?php esc_html_e('Loading color :', 'fat-portfolio'); ?></div>
                <div class="fat-field">
                    <div class="input-group colorpicker-component  colorpicker-element">
                        <input type="text" id="sc_loading_color"
                               value="<?php echo isset($shortcode['loading_color']) ? $shortcode['loading_color'] : '#343434'; ?>"
                               class="colorPicker form-control"/>
                        <span class="input-group-addon"><i></i></span>
                    </div>

                </div>
            </li>

            <li class="field-group">
                <div class="fat-title"><?php esc_html_e('Background hover color :', 'fat-portfolio'); ?></div>
                <div class="fat-field">
                    <div class="input-group colorpicker-component  colorpicker-element">
                        <input type="text" name="sc_bg_hover_color" id="sc_bg_hover_color"
                               value="<?php echo isset($shortcode['bg_hover_color']) ? $shortcode['bg_hover_color'] : 'rgba(0,0,0,0.5)'; ?>"
                               class="colorPicker form-control"/>
                        <span class="input-group-addon"><i></i></span>
                    </div>

                </div>
            </li>

            <li class="field-group">
                <div class="fat-title">&nbsp;</div>
                <div class="fat-field"><input class="button sc-save button-large button-primary" type="button"
                                              value="<?php esc_attr_e('Save', 'fat-portfolio'); ?>"/></div>
            </li>
        </ul>
    </div>

    <div class="tab-setting" id="tab-custom-css">
        <ul>
            <li class="field-group">
                <div class="fat-title"><?php esc_html_e('Custom Css'); ?></div>
                <div class="fat-field">
                    <textarea id="sc_custom_css"
                              style="display: none"><?php echo isset($shortcode['custom_css']) ? $shortcode['custom_css'] : ''; ?></textarea>
                    <pre id="pre_custom_css" data-mode="css"
                         class="ace-editor custom-css"><?php echo isset($shortcode['custom_css']) ? $shortcode['custom_css'] : ''; ?></pre>
                </div>
            </li>
            <li class="field-group">
                <div class="fat-title">&nbsp;</div>
                <div class="fat-field"><input class="button sc-save button-large button-primary" type="button"
                                              value="<?php esc_attr_e('Save', 'fat-portfolio'); ?>"/></div>
            </li>
        </ul>
    </div>
</div>

<?php
$template_path = FAT_PORTFOLIO_DIR_PATH . 'settings/tmpl.php';
if (file_exists($template_path)) {
    include_once $template_path;
}
?>
