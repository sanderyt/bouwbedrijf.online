jQuery(function ($) {
    'use strict';

    function registerAddFatCmbSingleImage(){
        $('a.fat-add-single-image', '.fat-add-single-image-wrap').off('click').on('click', function (event) {
            event.preventDefault();

            wp.media.frames.gk_frame = wp.media({
                title: 'Select Image',
                multiple: false,
                library: {
                    type: 'image'
                }
            });
            wp.media.frames.gk_frame.clicked_button = $(this);
            wp.media.frames.gk_frame.open().on('select', function (e) {
                var img_url,
                    img_full_url,
                    img_id,
                    parent,
                    image,
                    input_id,
                    selection_image = wp.media.frames.gk_frame.state().get('selection');

                input_id =  $(wp.media.frames.gk_frame.clicked_button).attr('data-input-id');
                selection_image.each(function (attachment) {
                    image = '<div class="fat-image-thumb" data-id="%id" ><img src="%thumbnail" /><div class="fat-overlay fat-transition-30"><span><a class="fat-delete-single-image" data-id="%id" href="javascript:;"><i class="dashicons dashicons-no-alt"></i></a></span></div></div>';
                    if(typeof attachment.attributes.sizes.thumbnail != 'undefined'){
                        img_url = attachment.attributes.sizes.thumbnail.url;
                    }else{
                        img_url = attachment.attributes.url;
                    }
                    img_id = attachment.attributes.id;
                    parent = $(wp.media.frames.gk_frame.clicked_button).closest('.fat-add-single-image-wrap');
                    image = image.replace("%thumbnail",img_url);
                    image = image.replace(/%id/g,img_id);

                    if($('[data-id="' + img_id + '"]', parent).length<=0){
                        $('.fat-list-image',parent).empty();
                        $('.fat-list-image',parent).append(image);
                    }

                });
                registerDeleteFatCmbSingleImage();
                $('#' + input_id, parent).val(img_id);
            });
        })
    }
    function registerDeleteFatCmbSingleImage(){
        var $image_id = 0,
            $container,
            input_id;
        $('.fat-add-single-image-wrap').each(function(){
            $('a.fat-delete-single-image', this).off('click').on('click',function(){
                $container = $(this).closest('.fat-add-single-image-wrap');
                $image_id = $(this).attr('data-id');
                input_id =  $(this).closest('.fat-list-image').attr('data-input-id');
                $('.fat-image-thumb[data-id="' + $image_id +'"]',$container).remove();
                $('#' + input_id, $container).val('');
            });
        });
    }
    $(document).ready(function () {
        registerAddFatCmbSingleImage();
        registerDeleteFatCmbSingleImage();
    });

});