<?php
/**
 * Created by PhpStorm.
 * User: roninwp
 * Date: 1/14/2017
 * Time: 2:21 PM
 */
?>
<script type="text/html" id="tmpl-bg-processing-template">
    <div class="bg-processing">
        <div class="loading">
            <i class="{{{data.ico}}}"></i><span>{{{data.text}}}</span>
        </div>
    </div>
</script>
<script type="text/html" id="tmpl-bg-alert-template">
    <div class="bg-alert-popup">
        <div class="content-popup">
            <div class="message">
                <i class="{{{data.ico}}}"></i><span>{{{data.text}}}</span>
            </div>
            <div class="btn-group">
                <a href="javascript:" class="btn-close">Close</a>
            </div>
        </div>

    </div>
</script>
<script type="text/html" id="tmpl-bg-confirm-dialog">
    <div class="bg-dialog-popup" id="grid-confirm-dialog">
        <div class="content-popup">
            <div class="message">
                <i class="{{{data.ico}}}"></i><span>{{{data.message}}}</span>
            </div>
        </div>
    </div>
</script>
<script type="text/html" id="tmpl-bg-prompt-dialog">
    <div class="bg-dialog-popup" id="grid-prompt-dialog">
        <div class="content-popup">
            <div class="message">
                <input type="text" id="grid_name">
            </div>
        </div>
    </div>
</script>

<script type="text/html" id="tmpl-bg-prompt-change-height-dialog">
    <div class="bg-popup-change-height">
        <div class="content-popup">
            <a href="javascript:" class="close-popup"><i class="fa fa-times"></i></a>
            <div>
                <label><?php echo esc_attr('Width','grid-plus'); ?></label>
                <input type="number" min="1" max="5" value="{{data.width_ratio}}" id="txt_width" step="1">
            </div>
            <div>
                <label><?php echo esc_attr('Height','grid-plus'); ?></label>
                <input type="number" min="1" max="5" value="{{data.height_ratio}}" id="txt_height" step="1">
            </div>
            <div>
                <a href="javascript:" id="apply_change_height">Apply change</a>
            </div>
        </div>
    </div>
</script>

<script type="text/html" id="tmpl-list-shortcode-template">
    <# _.each(data, function(item, index){ #>
        <tr>
            <td class="shortcode-id">{{{index+1}}}</td>
            <td class="shortcode-name">{{{item.name}}}</td>
            <td class="shortcode">
                <span id="shortcode_{{{item.id}}}"> [fat_portfolio name="{{{item.name}}}"] </span>
                <a class="copy-clipboard" href="javascript:" title="Copy to clipboard" data-clipboard-target="#shortcode_{{{item.id}}}">
                    <i class="fa fa-clipboard"></i>
                </a>
            </td>
            <td class="actions-group">
                <div class="actions" data-id="{{{item.id}}}" data-ajax-url="<?php echo esc_url(admin_url('admin-ajax.php')) ?>">
                    <a href="<?php echo admin_url('edit.php?post_type=fat-portfolio&page=fat_portfolio_shortcode_edit&sc_id={{{item.id}}}'); ?>" class="edit-shortcode"><i class="fa fa-pencil"></i><?php esc_html_e('Edit','fat-portfolio'); ?></a>
                    <a href="javascript:" class="delete-shortcode"><i class="fa fa-trash-o"></i><?php esc_html_e('Delete','fat-portfolio'); ?></a>
                </div>
            </td>
        </tr>
        <# }) #>
</script>
