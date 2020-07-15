var FAT_Flickr_API = function(params){
    var option, value;
    this.options={
        get_by: 'album',
        'url': 'https://api.flickr.com/services/rest',
        api_key: '',
        user_id: 0,
        extras: ' description,media,url_o,url_m,url_s',
        gallery_id: '',
        media: 'all',
        photoset_id: 0, //album id
        tags: '',
        tag_mode: 'all',
        per_page: 15
    };
    if (typeof params === 'object') {
        for (option in params) {
            value = params[option];
            this.options[option] = value;
        }
    }
};
jQuery(function ($) {
    'use strict';

    FAT_Flickr_API.prototype.getListAlbum = function(callback){
        var $response;
        if(this.options['api_key']=='' || this.options['user_id'] == 0){
            if(callback){
                callback( {code: -1, message: 'Please input api key and user id'});
            }
        }else{
            $.ajax({
                url: this.options['url'],
                type: 'GET',
                data:({
                    method: 'flickr.photosets.getList',
                    api_key: this.options['api_key'],
                    user_id: this.options['user_id'],
                    format: 'json',
                    nojsoncallback: 1
                }),
                dataType: 'json',
                crossDomain: true,
                success: function(data){
                    if(typeof data == 'undefined' || typeof data.stat == 'undefined'){
                        $response = {code: -1, message: 'Have problem when get information from flickr'};
                    }
                    if(data.stat=='fail'){
                        $response = {code: -1 , message: data.message};
                    }else{
                        $response = {code: 1, data: data.photosets};
                    }
                    if(callback){
                        callback($response);
                    }
                },
                error: function(){
                    if(callback){
                        callback({code: -1, message: 'Have problem when get information from flickr'});
                    }
                }
            });
        }
    };

    FAT_Flickr_API.prototype.getListGallery = function(callback){
        var $response;
        if(this.options['api_key']=='' || this.options['user_id'] ==0){
            if(callback){
                callback({code: -1, message: 'Please input api key and user id'});
            }
        }else{
            $.ajax({
                url: this.options['url'],
                type: 'GET',
                data:({
                    method: 'flickr.galleries.getList',
                    api_key: this.options['api_key'],
                    user_id: this.options['user_id'],
                    format: 'json',
                    nojsoncallback: 1
                }),
                dataType: 'json',
                crossDomain: true,
                success: function(data){
                    if(typeof data == 'undefined' || typeof data.stat == 'undefined'){
                        $response = {code: -1, message: 'Have problem when get information from Flickr'};
                    }
                    if(data.stat=='fail'){
                        $response = {code: -1 , message: data.message};
                    }else{
                        $response = {code: 1, data: data.galleries};
                    }
                    if(callback){
                        callback($response);
                    }
                },
                error: function(){
                    if(callback){
                        callback({code: -1, message: 'Have problem when get information from Flickr'});
                    }
                }
            });
        }
    };

    FAT_Flickr_API.prototype.getListTags = function(callback){
        var $response;
        if(this.options['api_key']=='' || this.options['user_id'] ==0){
            if(callback){
                callback({code: -1, message: 'Please input api key and user id'});
            }
        }else{
            $.ajax({
                url: this.options['url'],
                type: 'GET',
                data:({
                    method: 'flickr.tags.getListUser',
                    api_key: this.options['api_key'],
                    user_id: this.options['user_id'],
                    format: 'json',
                    nojsoncallback: 1
                }),
                dataType: 'json',
                crossDomain: true,
                success: function(data){
                    if(typeof data == 'undefined' || typeof data.stat == 'undefined'){
                        $response = {code: -1, message: 'Have problem when get information from Flickr'};
                    }
                    if(data.stat=='fail'){
                        $response = {code: -1 , message: data.message};
                    }else{
                        $response = {code: 1, data: data.who.tags};
                    }
                    if(callback){
                        callback($response);
                    }
                },
                error: function(){
                    if(callback){
                        callback({code: -1, message: 'Have problem when get information from Flickr'});
                    }
                }
            });
        }
    };

    FAT_Flickr_API.prototype.getListPhotoByAlbum = function(callback){
        var $response;
        if(this.options['api_key']=='' || this.options['user_id'] ==0 || this.options['photoset_id'] == ''){
            if(callback){
                callback({code: -1, message: 'Please input api key and user id and album'});
            }
        }else{
            $.ajax({
                url: this.options['url'],
                type: 'GET',
                data:({
                    method: 'flickr.photosets.getPhotos',
                    api_key: this.options['api_key'],
                    user_id: this.options['user_id'],
                    photoset_id: this.options['photoset_id'],
                    per_page: this.options['per_page'],
                    media: this.options['media'],
                    extras: this.options['extras'],
                    format: 'json',
                    nojsoncallback: 1
                }),
                dataType: 'json',
                crossDomain: true,
                success: function(data){
                    if(typeof data == 'undefined' || typeof data.stat == 'undefined'){
                        $response = {code: -1, message: 'Have problem when get information from Flickr'};
                    }
                    if(data.stat=='fail'){
                        $response = {code: -1 , message: data.message};
                    }else{
                        $response = {code: 1, data: data.photoset};
                    }
                    if(callback){
                        callback($response);
                    }
                },
                error: function(){
                    if(callback){
                        callback({code: -1, message: 'Have problem when get information from Flickr'});
                    }
                }
            });
        }
    };

    FAT_Flickr_API.prototype.getListPhotoByTags = function(callback){
        var $response;
        if(this.options['api_key']=='' || this.options['user_id'] ==0){
            if(callback){
                callback({code: -1, message: 'Please input api key and user id and album'});
            }
        }else{
            $.ajax({
                url: this.options['url'],
                type: 'GET',
                data:({
                    method: 'flickr.photos.search',
                    api_key: this.options['api_key'],
                    user_id: this.options['user_id'],
                    tags: this.options['tags'],
                    tag_mode: this.options['tag_mode'],
                    per_page: this.options['per_page'],
                    media: this.options['media'],
                    extras: this.options['extras'],
                    format: 'json',
                    nojsoncallback: 1
                }),
                dataType: 'json',
                crossDomain: true,
                success: function(data){
                    if(typeof data == 'undefined' || typeof data.stat == 'undefined'){
                        $response = {code: -1, message: 'Have problem when get information from Flickr'};
                    }
                    if(data.stat=='fail'){
                        $response = {code: -1 , message: data.message};
                    }else{
                        $response = {code: 1, data: data.photos};
                    }
                    if(callback){
                        callback($response);
                    }
                },
                error: function(){
                    if(callback){
                        callback({code: -1, message: 'Have problem when get information from Flickr'});
                    }
                }
            });
        }
    };

    FAT_Flickr_API.prototype.getListPhotoByGallery = function(callback){
        var $response;
        if(this.options['api_key']=='' || this.options['user_id'] ==0 || this.options['photoset_id'] == ''){
            if(callback){
                callback({code: -1, message: 'Please input api key and user id and album'});
            }
        }
        $.ajax({
            url: this.options['url'],
            type: 'GET',
            data:({
                method: 'flickr.galleries.getPhotos',
                api_key: this.options['api_key'],
                gallery_id: this.options['gallery_id'],
                per_page: this.options['per_page'],
                media: this.options['media'],
                extras: this.options['extras'],
                format: 'json',
                nojsoncallback: 1
            }),
            dataType: 'json',
            crossDomain: true,
            success: function(data){
                if(typeof data == 'undefined' || typeof data.stat == 'undefined'){
                    $response = {code: -1, message: 'Have problem when get information from Flickr'};
                }
                if(data.stat=='fail'){
                    $response = {code: -1 , message: data.message};
                }else{
                    $response = {code: 1, data: data.photos};
                }
                if(callback){
                    callback($response);
                }
            },
            error: function(){
                if(callback){
                    callback({code: -1, message: 'Have problem when get information from Flickr'});
                }
            }
        });
    };

    FAT_Flickr_API.prototype.getListPhoto = function(callback){
        if(this.options.get_by=='tag'){
            this.getListPhotoByTags(callback);
        }
        if(this.options.get_by=='album'){
            this.getListPhotoByAlbum(callback);
        }
        if(this.options.get_by=='gallery'){
            this.getListGallery(callback);
        }
    }
});
