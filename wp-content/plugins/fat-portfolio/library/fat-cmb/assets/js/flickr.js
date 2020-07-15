/**
 * Created by roninwp on 3/7/2017.
 */

jQuery(function ($) {
    'use strict';

    function Fat_cmb_flickr_init_data($flickr_wrap, $is_connect, callback){
        var $api_key = $('.flickr-api-key input',$flickr_wrap).val(),
            $user_id = $('.flickr-user-filter input',$flickr_wrap).val();

        $('.connect-success', $flickr_wrap).hide();
        $('.fat-cmb-social-list .social-error', $flickr_wrap).remove();

        if(typeof $api_key=='undefined' || $api_key =='' || typeof $user_id=='undefined' || $user_id =='' ){
            $('.fat-cmb-social-list', $flickr_wrap).append('<div class="instagram-error social-error">Please input api key and user id</div>');
        }

        var flickr = new FAT_Flickr_API({
            api_key: $api_key,
            user_id: $user_id
        });

        /** init album dropdown **/
        flickr.getListAlbum(function(albums){
            var $option = '',
                $code = albums.code,
                $data_selected = $('.flickr-album-filter select',$flickr_wrap).attr('data-selected'),
                $selected;

            if($code<0){
                $('.fat-cmb-social-list', $flickr_wrap).append('<div class="instagram-error social-error">' + albums.message + '</div>');
                return;
            }

            albums = albums.data;

            if(typeof albums!='undefined' && albums!=null && albums.photoset!=null){
                $('.flickr-album-filter select',$flickr_wrap).empty();
                for(var $i=0; $i< albums.photoset.length; $i++){
                    $selected = $data_selected == albums.photoset[$i].id ? 'selected' : '';
                    $option = '<option value="{value}" \{selected\}>{title} ({photo} photos - {video} videos)</option>';
                    $option = $option.replace('{value}', albums.photoset[$i].id);
                    $option = $option.replace('{title}', albums.photoset[$i].title._content);
                    $option = $option.replace('{photo}', albums.photoset[$i].photos);
                    $option = $option.replace('{video}', albums.photoset[$i].videos);
                    $option = $option.replace('{selected}', $selected);
                    $('.flickr-album-filter select',$flickr_wrap).append($option);
                }
            }
        });

        /** init gallery dropdown **/
        flickr.getListGallery(function(galleries){

            var $option = '',
                $code = galleries.code,
                $data_selected = $('.flickr-gallery-filter select',$flickr_wrap).attr('data-selected'),
                $selected;

            if($code<0){
                $('.fat-cmb-social-list', $flickr_wrap).append('<div class="instagram-error social-error">' + galleries.message + '</div>');
                return;
            }

            galleries = galleries.data;

            if(typeof galleries!='undefined' && galleries!=null && galleries.gallery!=null){
                $('.flickr-gallery-filter select',$flickr_wrap).empty();
                for(var $i=0; $i < galleries.gallery.length; $i++){
                    $selected = $data_selected == galleries.gallery[$i].id ? 'selected' : '';
                    $option = '<option value="{value}" \{selected\}>{title} ({photo} photos - {video} videos)</option>';
                    $option = $option.replace('{value}', galleries.gallery[$i].id);
                    $option = $option.replace('{title}', galleries.gallery[$i].title._content);
                    $option = $option.replace('{photo}', galleries.gallery[$i].count_photos);
                    $option = $option.replace('{video}', galleries.gallery[$i].count_videos);
                    $option = $option.replace('{selected}', $selected);
                    $('.flickr-gallery-filter select',$flickr_wrap).append($option);
                }
            }
        });

        /** init tag dropdown **/
        flickr.getListTags(function(tags){

            var $option = '',
                $code = tags.code,
                $data_selected = $('.flickr-tag-filter select',$flickr_wrap).attr('data-selected'),
                $selected;

            if($code<0){
                $('.fat-cmb-social-list', $flickr_wrap).append('<div class="instagram-error social-error">' + tags.message + '</div>');
                return;
            }

            tags = tags.data;

            if(typeof tags!='undefined' && tags!=null && tags.tag!=null){
                $('.flickr-tag-filter select',$flickr_wrap).empty();
                for(var $i=0; $i < tags.tag.length; $i++){
                    $selected = $data_selected == tags.tag[$i]._content ? 'selected' : '';
                    $option = '<option value="{value}" \{selected\}>{title}</option>';
                    $option = $option.replace('{value}', tags.tag[$i]._content);
                    $option = $option.replace('{title}', tags.tag[$i]._content);
                    $option = $option.replace('{selected}', $selected);
                    $('.flickr-tag-filter select',$flickr_wrap).append($option);
                }
            }
        });

        if($is_connect){
            $('.connect-success', $flickr_wrap).show();
        }
        if(callback){
            callback();
        }
    }
    function Fat_cmb_flickr_event(){
        $('.fat-cmb-flickr-wrap').each(function(){
            var $flickr_wrap = $(this);
            $('.flickr-get-by select',$flickr_wrap).off('change').on('change',function(){
                var $get_by = $(this).val();
                $get_by == 'tag' ? $('.flickr-tag-filter',$flickr_wrap).show(): $('.flickr-tag-filter',$flickr_wrap).hide();
                $get_by == 'gallery' ? $('.flickr-gallery-filter',$flickr_wrap).show(): $('.flickr-gallery-filter',$flickr_wrap).hide();
                $get_by == 'album' ? $('.flickr-album-filter',$flickr_wrap).show(): $('.flickr-album-filter',$flickr_wrap).hide();
            });

            $('a.connect-flickr', $flickr_wrap).off('click').on('click',function(){
                Fat_cmb_flickr_init_data($flickr_wrap, true);
            });

            $('.flickr-button a', $flickr_wrap).off('click').on('click',function(){
                var $get_by = $('.flickr-get-by select',$flickr_wrap).val(),
                    $api_key = $('.flickr-api-key input',$flickr_wrap).val(),
                    $user_id = $('.flickr-user-filter input',$flickr_wrap).val(),
                    $photoset_id = $('.flickr-album-filter select', $flickr_wrap).val(),
                    $gallery_id = $('.flickr-gallery-filter select', $flickr_wrap).val(),
                    $media = $('.flickr-media select', $flickr_wrap).val(),
                    $tags = $('.flickr-tag-filter select', $flickr_wrap).val(),
                    $flickr_list = $('.fat-cmb-flickr-list', $flickr_wrap),
                    $limit = $('.flickr-limit-filter input', $flickr_wrap).val();

                var flickr = new FAT_Flickr_API({
                    get_by: $get_by,
                    api_key: $api_key,
                    user_id: $user_id,
                    gallery_id: $gallery_id,
                    photoset_id: $photoset_id,
                    media: $media,
                    tags: $tags
                });

                flickr.options.per_page = typeof ($limit) !='undefined' && !isNaN($limit) && parseInt($limit) > flickr.options.per_page ? flickr.options.per_page : parseInt($limit);

                $('.fat-cmb-loading',$flickr_wrap).css('display','inline-block');

                flickr.getListPhoto(function($data){
                    $('.fat-cmb-loading',$flickr_wrap).css('display','none');
                    $('.social-error', $flickr_wrap).remove();
                    $flickr_list.empty();
                    if(typeof $data !='undefined' && $data!=null){
                        if($data.code <= 0){
                            $flickr_list.append('<div class="flickr-error social-error">' + $data.message + '</div>');
                        }else{
                            var $photos = $data.data.photo,
                                $user_id = $data.data.owner,
                                $total = parseInt($data.data.total),
                                $item;
                            if($total > 0){
                                for(var $i=0; $i < $photos.length; $i++){
                                    $item = '<div class="flickr-item social-item"><div class="flickr-img"  style="background-image: url(\{image\})"><a href="https://www.flickr.com/photos/{user_id}/{photo_id}/in/dateposted-public/" target="_blank"></a></div></div>';
                                    $item = $item.replace('{user_id}',$user_id);
                                    $item = $item.replace('{photo_id}',$photos[$i].id);
                                    $item = $item.replace('{image}',$photos[$i].url_s);
                                    $flickr_list.append($item);
                                }
                            }else{
                                $flickr_list.append('<div class="flickr-error social-error">Not found media adapt search criteria</div>');
                            }
                        }
                    }
                });
            });
        });
    }

    $('document').ready(function(){
        Fat_cmb_flickr_event();

        $('.fat-cmb-flickr-wrap').each(function(){
            var $api_key = $('.flickr-api-key input',this).val(),
                $user_id = $('.flickr-user-filter input',this).val();
            if($api_key !='' && $user_id !=''){
                Fat_cmb_flickr_init_data(this,false,function(){
                    var $this = this;
                    setTimeout(function(){
                        $('.flickr-button a', $this).trigger('click');
                    },1000);
                });
            }
        });
    });
});

