<?php
/**
 * Created by PhpStorm.
 * User: roninwp
 * Date: 3/9/2017
 * Time: 1:53 PM
 */

$shortcodes = get_option(FAT_PORTFOLIO_SHORTCODE_OPTION_KEY, array());
if(is_array($shortcodes)){
    $shortcodes = array_reverse($shortcodes);
}

?>

<div class="wrap">
    <h1></h1>
    <h1 class="setting-title">FAT Portfolio Shortcodes</h1>
    <div class="fat-portfolio-list-shortcode">
        <table cellpadding="0" cellspacing="0" id="table_list_shortcode">
            <thead>
            <tr>
                <td width="100px"><?php esc_html_e('ID','fat-portfolio'); ?></td>
                <td width="35%"><?php esc_html_e('Name','fat-portfolio'); ?></td>
                <td width="35%"><?php esc_html_e('Shortcode','fat-portfolio'); ?></td>
                <td width="300px"><?php esc_html_e('Actions','fat-portfolio'); ?></td>
            </tr>
            </thead>
            <tbody>
            <?php
            $index = 1;
            $url_edit = $url_clone = '';
            foreach($shortcodes as $shortcode){
                $url_edit = sprintf('edit.php?post_type=fat-portfolio&page=fat_portfolio_shortcode_edit&sc_id=%s',$shortcode['id'] );
                $url_clone = sprintf('edit.php?post_type=fat-portfolio&page=fat_portfolio_shortcode_edit&clone=1&sc_id=%s&sc_name=',$shortcode['id'] );
                ?>
                <tr>
                    <td class="shortcode-id"><?php echo esc_html($index++); ?></td>
                    <td class="shortcode-name"><?php echo esc_html($shortcode['name']); ?></td>
                    <td class="shortcode">
                        <span id="<?php echo sprintf('shortcode_%s',$shortcode['id']); ?>"> [fat_portfolio name="<?php echo esc_html($shortcode['name']); ?>"] </span>
                        <a class="copy-clipboard" href="javascript:" title="Copy to clipboard" data-clipboard-target="#<?php echo sprintf('shortcode_%s',$shortcode['id']); ?>">
                            <i class="fa fa-clipboard"></i>
                        </a>
                    </td>
                    <td class="actions-group">
                        <div class="actions" data-id="<?php echo esc_attr($shortcode['id']); ?>" data-ajax-url="<?php echo esc_url(admin_url('admin-ajax.php')) ?>">
                            <a href="<?php echo admin_url($url_edit); ?>" class="edit-shortcode"><i class="fa fa-pencil"></i><?php esc_html_e('Edit','fat-portfolio'); ?></a>
                            <a href="javascript:void(0);" data-url="<?php echo esc_url($url_clone); ?>" class="clone-shortcode"><i class="fa fa-clone"></i><?php esc_html_e('Clone','fat-portfolio'); ?></a>
                            <a href="javascript:" class="delete-shortcode"><i class="fa fa-trash-o"></i><?php esc_html_e('Delete','fat-portfolio'); ?></a>
                        </div>
                    </td>
                </tr>
            <?php } ?>

            </tbody>
        </table>
    </div>
</div>

<?php
$template_path = FAT_PORTFOLIO_DIR_PATH .'settings/tmpl.php';
if(file_exists($template_path)){
    include_once $template_path;
}
?>
