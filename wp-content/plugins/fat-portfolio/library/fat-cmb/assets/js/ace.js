jQuery(function ($) {
    'use strict';
    $(document).ready(function () {
        $('.fat-cmb-ace-editor').each(function(){
            if(typeof ace !='undefined'){
                var $mode = "ace/mode/" + $(this).attr('data-mode'),
                    $id = $(this).attr('id'),
                    $ace = ace.edit($id);
                $ace.getSession().setMode($mode);
                $ace.setAutoScrollEditorIntoView(true);
                $ace.getSession().on('change', function(e) {
                    var $container = $($ace.container).closest('.fat-cmb-field');
                    $('textarea', $container).html($ace.getValue());
                });
            }
        });
    });
});
