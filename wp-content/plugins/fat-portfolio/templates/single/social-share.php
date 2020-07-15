<?php
/**
 * Created by PhpStorm.
 * User: PhuongTH
 * Date: 3/23/2018
 * Time: 8:50 AM
 */
?>
<div class="shares-wrap" data-title="<?php echo urlencode(get_the_title()); ?>" data-url="<?php echo get_permalink(); ?>">
    <span class="meta-label"><?php echo esc_html__('SHARE:  ', 'fat-portfolio'); ?></span>
    <a href="javascript:void(0)" data-social="facebook" class="mg-right-5"><i class="fa fa-facebook"></i></a>
    <a href="javascript:void(0)" data-social="twitter" class="mg-right-5"><i class="fa fa-twitter"></i></a>
    <a href="javascript:void(0)" data-social="google"><i class="fa fa-google-plus"></i></a>
</div>
