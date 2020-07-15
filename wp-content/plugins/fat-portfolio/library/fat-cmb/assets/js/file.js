jQuery(function ($) {
    'use strict';

    function registerAddFatCmbFile(){
        $('a.fat-add-file', '.fat-add-file-wrap').off('click').on('click', function (event) {
            event.preventDefault();
            wp.media.frames.gk_frame = wp.media({
                title: 'Select File',
                multiple: false,
                library: {
                    type: fat_file.type
                }
            });
            wp.media.frames.gk_frame.clicked_button = $(this);
            wp.media.frames.gk_frame.open().on('select', function (e) {
                var file_url,
                    file_title,
                    file_id,
                    file_type,
                    image_url,
                    parent,
                    selection_file = wp.media.frames.gk_frame.state().get('selection');

                selection_file.each(function (attachment) {
                    file_url = attachment.attributes.url;
                    file_type = attachment.type;
                    file_id = attachment.id;
                    if(attachment.attributes.type === 'image' && typeof  attachment.attributes.url !== 'undefined'  ){
                        image_url = attachment.attributes.url;
                        file_title = attachment.attributes.title;
                    }else{
                        image_url = attachment.attributes.icon;

                    }
                    if(typeof attachment.attributes.title !== 'undefined'){
                        file_title = attachment.attributes.title;
                    }

                    parent = $(wp.media.frames.gk_frame.clicked_button).closest('.fat-add-file-wrap');
                    $('.fat-cmb-file-icon',parent).empty();
                    $('.fat-cmb-file-icon',parent).append('<img src="' + image_url + '"/>');

                });
                registerDeleteFatCmbFile();
                $('input.fat-cmb-file-path',parent).val(file_url);
                $('input.fat-cmb-file-title',parent).val(file_title);
                $('input.fat-cmb-file-type',parent).val(file_type);
                $('input.fat-cmb-file-icon',parent).val(image_url);
                $('input.fat-cmb-file-id',parent).val(file_id);
            });
        })
    }
    function registerDeleteFatCmbFile(){
        $('a.fat-delete-file', '.fat-add-file-wrap').off('click').on('click',function(){
            var $container = $(this).closest('.fat-add-file-wrap');
            $('.fat-cmb-file-icon',$container).empty();
            $('input.fat-cmb-file-path',$container).val('');
            $('input.fat-cmb-file-title',$container).val('');
            $('input.fat-cmb-file-type',$container).val('');
            $('input.fat-cmb-file-icon',$container).val('');
            $('input.fat-cmb-file-id',$container).val('');
        });
    }
    $(document).ready(function () {
        registerAddFatCmbFile();
        registerDeleteFatCmbFile();
    });

});