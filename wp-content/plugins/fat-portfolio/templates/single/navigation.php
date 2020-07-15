<?php
/**
 * @package   Fat_Portfolio
 * @author    roninwp <kenus.ronin@gmail.com>
 * @copyright 2016 RoninWP
 */
$nav_in_same_category = isset($settings['navigation_in_same_category']) && $settings['navigation_in_same_category'] === '1' ? true : false;
if (get_next_post($nav_in_same_category, '', FAT_PORTFOLIO_CATEGORY_TAXONOMY) || get_previous_post($nav_in_same_category, '', FAT_PORTFOLIO_CATEGORY_TAXONOMY)):
    ?>
    <nav class="fat-portfolio-navigation fat-mg-top-50" role="navigation">
        <div class="nav-links clearfix">
            <?php
            previous_post_link('<div class="nav-previous">%link</div>', _x('<i class="fa fa-long-arrow-left"></i><span>Previous</span>', 'Previous Link', 'fat-portfolio'), $nav_in_same_category, '', FAT_PORTFOLIO_CATEGORY_TAXONOMY); ?>
           <!-- <div class="back-archive-wrap">
                <a href="<?php /*echo get_post_type_archive_link(FAT_PORTFOLIO_POST_TYPE) */?>"><?php /*echo esc_html__('Back to archive','fat-portfolio'); */?></a>

            </div>-->
            <?php next_post_link('<div class="nav-next">%link</div>', _x('Next <i class="fa fa-long-arrow-right"></i>', 'Next Link', 'fat-portfolio'), $nav_in_same_category, '', FAT_PORTFOLIO_CATEGORY_TAXONOMY); ?>

        </div>
    </nav>
<?php endif; ?>

