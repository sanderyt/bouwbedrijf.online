(function ($) {
    "use strict";

    function Fat_portfolio_shortcode_delete($id){
        FatUtil.showLoading('Deleting shortcode information');
        $.ajax({
            url: shortcode_data.ajax_url,
            type: 'POST',
            data: ({
                action: 'fat_portfolio_shortcode_delete',
                sc_id: $id
            }),
            success: function (data) {
                var $data = JSON.parse(data);
                if (typeof $data.code != 'undefined' && $data.code == '-1') {
                    FatUtil.closeLoading(0);
                    FatUtil.popupAlert('fa fa-exclamation-triangle', $data.message);
                } else {
                    FatUtil.changeLoadingStatus('fa fa-check-square-o', 'Shortcode has been saved');
                    FatUtil.closeLoading();

                    var template = wp.template('list-shortcode-template');
                    $('tbody', '#table_list_shortcode').empty();
                    if (typeof $data != 'undefined' && $data.length > 0) {
                       $('tbody', '#table_list_shortcode').append(template($data));
                    }
                    setTimeout(function(){
                        Fat_portfolio_shortcode_register_event();
                    },500);

                }
            },
            error: function () {
                FatUtil.changeLoadingStatus('fa fa-exclamation-triangle', 'Have error when delete information');
                FatUtil.closeLoading();
            }
        });
    }

    function Fat_portfolio_shortcode_register_event() {

        $('a.delete-shortcode', '.fat-portfolio-list-shortcode').off('click').on('click', function () {
            var $id = $(this).closest('.actions').attr('data-id');
            if(typeof $id !='undefined'){
                FatUtil.confirmDialog('Confirm', 'Confirm delete shortcode', function () {
                    Fat_portfolio_shortcode_delete($id);
                });
            }
        });

        $('a.clone-shortcode','.fat-portfolio-list-shortcode').off('click').on('click',function(){
            var $shortcode_name = prompt("Please enter shortcode name", "");
            if ($shortcode_name != '' && $shortcode_name != null) {
                var $clone_url = $(this).attr('data-url') + $shortcode_name;
                window.location.href = $clone_url;
                return true;
            }else{
                el.preventDefault();
                return false;
            }
        });

        var clipboard = new Clipboard('.copy-clipboard');
        clipboard.on('success', function (e) {
            $(e.trigger).append('<i class="fa fa-check active"></i>');
            e.clearSelection();
            setTimeout(function () {
                $('i.active', e.trigger).fadeOut(function () {
                    $(this).remove();
                });
            }, 2000);
        });
    }

    $(document).ready(function () {
        Fat_portfolio_shortcode_register_event();
    });
})(jQuery);
