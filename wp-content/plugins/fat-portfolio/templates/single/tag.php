<?php
/**
 * Created by PhpStorm.
 * User: roninwp
 * Date: 5/2/2017
 * Time: 5:07 PM
 */
$tags = get_the_terms(get_the_ID(), 'fat-portfolio-tag');
$settings = function_exists('fat_get_settings') ? fat_get_settings() : array();
$archive_page_id = isset($settings['archive_tag_page']) ? $settings['archive_tag_page'] : '';
?>
<?php if (isset($tags) && is_array($tags)) { ?>
    <div class="portfolio-tag-container attr-item">
        <h6><?php echo esc_html__('Tags : ', 'fat-portfolio') ?> </h6>
        <span class="portfolio-tags">
            <?php
            $tag_index = 0;
            foreach ($tags as $tag) {
                $tag_index++;
                ?>
                <?php if ($archive_page_id != ''): ?>
                    <a href="<?php echo esc_url(get_tag_link($tag->term_id)) ?>">
                                            <span class="tag">
                                                <?php echo wp_kses_post($tag->name) ?>
                                            </span>
                    </a>
                <?php else: ?>
                    <span class="tag">
                                                <?php echo wp_kses_post($tag->name) ?>
                                            </span>
                <?php endif; ?>
                <?php echo $tag_index < count($tags) ? ',' : ''; ?>
            <?php } ?>
        </span>
    </div>
<?php } ?>

