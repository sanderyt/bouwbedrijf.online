jQuery(function ($) {
    'use strict';

    function setFatCmbImageSortable(){
        if ($.isFunction($.fn.sortable)){
            $('.fat-list-image').sortable({
                update: function(){
                    var input_id = $(this).attr('data-input-id'),
                        parent = $(this).closest('.fat-add-image-wrap');
                    setFatCmbImageId(parent, input_id);
                }
            });
        }
    }
    function setFatCmbImageId($container, input_id){
        var ids = '',
            thumbnails = '',
            urls = '';
        $('.fat-image-thumb', $container).each(function(){
            ids += $(this).attr('data-id') + ',';
        });
        $('#' + input_id).val(ids.slice(0,-1));
    }
    function registerAddFatCmbImage(){
        $('a.fat-add-image', '.fat-cmb-images-wrap').off('click').on('click', function (event) {
            event.preventDefault();

            // check for media manager instance
           /* if (wp.media.frames.gk_frame) {
                wp.media.frames.gk_frame.multiple = true;
                wp.media.frames.gk_frame.open();
                wp.media.frames.gk_frame.clicked_button = $(this);
                return;
            }*/

            wp.media.frames.gk_frame = wp.media({
                title: 'Select Image',
                multiple: true,
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
                    image = '<div class="fat-image-thumb" data-id="%id" ><img src="%thumbnail" /><div class="fat-overlay fat-transition-30"><span><a class="fat-delete-image" data-id="%id" href="javascript:;"><i class="dashicons dashicons-no-alt"></i></a></span></div></div>';
                    if(typeof attachment.attributes.sizes.thumbnail != 'undefined'){
                        img_url = attachment.attributes.sizes.thumbnail.url;
                    }else{
                        img_url = attachment.attributes.url;
                    }
                    img_id = attachment.attributes.id;
                    parent = $(wp.media.frames.gk_frame.clicked_button).closest('.fat-add-image-wrap');
                    image = image.replace("%thumbnail",img_url);
                    image = image.replace(/%id/g,img_id);

                    if($('[data-id="' + img_id + '"]', parent).length<=0){
                        $('.fat-list-image',parent).append(image);
                    }

                });
                setFatCmbImageSortable();
                registerDeleteFatCmbImage();
                setFatCmbImageId(parent, input_id);
            });
        })
    }
    function registerDeleteFatCmbImage(){
        var $image_id = 0,
            $container,
            input_id;
        $('.fat-add-image-wrap').each(function(){
            $container = $(this);
            $('a.fat-delete-image').off('click').on('click',function(){
                $image_id = $(this).attr('data-id');
                input_id =  $(this).closest('.fat-list-image').attr('data-input-id');
                $('.fat-image-thumb[data-id="' + $image_id +'"]',$container).remove();
                setFatCmbImageId($container, input_id);
            });
        });
    }
    $(document).ready(function () {
        setFatCmbImageSortable();
        registerAddFatCmbImage();
        registerDeleteFatCmbImage();
    });

});