//Constructor
var Article = function (article_id){

    //private properties
    var article_api = 'api/article';
    var api_document = 'api/document';
    var progressbar = $('#progressbar');
    var article_id 	= article_id;

    this.deleteDoc = function(file_id){
    	progressbar.Progressbar('70%');
    	$.ajax({
            url         :api_document,
            cache       :false,
            async 		:false,
            dataType    :"json",
            type        :"POST",
            data:{
                request :'delete',
                file_id :file_id
            },
            error: function (request, status, error){
                console.log(request.responseText);
            }
        }).done(function(data){
            console.log(data);
            progressbar.Progressbar('100%');
        });
    }

    // Edit document title
    this.editDocTitle = function(file_id,title){
    	progressbar.Progressbar('70%');
    	$.ajax({
            url         :api_document,
            cache       :false,
            dataType    :"json",
            type        :"POST",
            data:{
                request     :'edit_title',
                file_id  :file_id,
                title     :title
            },
            error: function (request, status, error){
                console.log(request.responseText);
            }
        }).done(function(data){
            console.log(data);
            progressbar.Progressbar('100%');
        });
    }

    // CONTENT
    this.imageRotate = function(content_id){
    	progressbar.Progressbar('70%');
    	$.ajax({
            url         :article_api,
            cache       :false,
            dataType    :"json",
            type        :"POST",
            data:{
                request     :'rotate_image',
                content_id  :content_id,
            },
            error: function (request, status, error){
                console.log(request.responseText);
            }
        }).done(function(data){
            console.log(data);
            progressbar.Progressbar('100%');
        });
    }
    // Swap between content box
    this.swapContent = function(content_id,target_id){
    	progressbar.Progressbar('70%');
    	$.ajax({
            url         :article_api,
            cache       :false,
            dataType    :"json",
            type        :"POST",
            data:{
                request     :'swap_content',
                current_id  :content_id,
                target_id   :target_id,
            },
            error: function (request, status, error){
                console.log(request.responseText);
            }
        }).done(function(data){
            location.reload();
            progressbar.Progressbar('100%');
        });
    }

    // Delete Content Box
    this.deleteContent = function(content_id){
    	progressbar.Progressbar('70%');
    	$.ajax({
            url         :article_api,
            cache       :false,
            async 		:false,
            dataType    :"json",
            type        :"POST",
            data:{
                request     :'delete_content',
                article_id  :article_id,
                content_id  :content_id
            },
            error: function (request, status, error){
                console.log(request.responseText);
            }
        }).done(function(data){
            console.log(data); 
            progressbar.Progressbar('100%');
        });
    }

    // Edit Video ID (YouTube)
    this.editVideo = function(content_id,video_id){
    	progressbar.Progressbar('70%');
    	$.ajax({
            url         :article_api,
            cache       :false,
            dataType    :"json",
            type        :"POST",
            data:{
                request     :'edit_video_id',
                article_id  :article_id,
                content_id  :content_id,
                video_id    :video_id
            },
            error: function (request, status, error){
                console.log(request.responseText);
            }
        }).done(function(data){
            console.log(data);
            progressbar.Progressbar('100%');
        });
    }

    // Edit Alt
    this.editAlt = function(content_id,alt){
    	progressbar.Progressbar('70%');
    	$.ajax({
            url         :article_api,
            cache       :false,
            dataType    :"json",
            type        :"POST",
            data:{
                request     :'edit_img_alt',
                article_id  :article_id,
                content_id  :content_id,
                img_alt     :alt
            },
            error: function (request, status, error){
                console.log(request.responseText);
            }
        }).done(function(data){
            console.log(data);
            progressbar.Progressbar('100%');
        });
    }

    // Edit Article address.
    this.editAddress = function(district_id,amphur_id,province_id){
        progressbar.Progressbar('70%');
        $.ajax({
            url         :article_api,
            cache       :false,
            async       :false,
            dataType    :"json",
            type        :"POST",
            data:{
                request     :'edit_address',
                article_id  :article_id,
                province_id :province_id,
                amphur_id   :amphur_id,
                district_id :district_id
            },
            error: function (request, status, error) {
                console.log("Request Error");
            }
        }).done(function(data){
            console.log(data);
            progressbar.Progressbar('100%');

            setTimeout(function(){
                location.reload();
            },1000);
        });
    }

    // Edit location (Google Map)
    this.editLocation = function(content_id,lat,lng){
    	progressbar.Progressbar('70%');
    	$.ajax({
            url         :article_api,
            cache       :false,
            dataType    :"json",
            type        :"POST",
            data:{
                request     :'edit_map_location',
                article_id  :article_id,
                content_id  :content_id,
                lat         :parseFloat(lat),
                lng         :parseFloat(lng)
            },
            error: function (request, status, error){
                console.log(request.responseText);
            }
        }).done(function(data){
            console.log(data);
            progressbar.Progressbar('100%');
        });
    }

    // Edit content body.
    this.editBody = function(content_id,body){
    	progressbar.Progressbar('70%');
    	$.ajax({
            url         :article_api,
            cache       :false,
            dataType    :"json",
            type        :"POST",
            data:{
                request     :'edit_body',
                article_id  :article_id,
                content_id  :content_id,
                body        :body
            },
            error: function (request, status, error){
                console.log(request.responseText);
            }
        }).done(function(data){
            console.log(data);
            progressbar.Progressbar('100%');
        });
    }

    this.removeHeadCover = function(){
        progressbar.Progressbar('70%');
        $.ajax({
            url         :article_api,
            cache       :false,
            dataType    :"json",
            type        :"POST",
            data:{
                request     :'remove_head_cover',
                article_id  :article_id
            },
            error: function (request, status, error){
                console.log(request.responseText);
            }
        }).done(function(data){
            console.log(data);
            progressbar.Progressbar('100%');
            setTimeout(function(){
                location.reload();
            },1000);
        });
    }

    // Edit content topic.
    this.editTopic = function(content_id,topic){
    	progressbar.Progressbar('70%');
    	$.ajax({
            url         :article_api,
            cache       :false,
            dataType    :"json",
            type        :"POST",
            data:{
                request     :'edit_topic',
                article_id  :article_id,
                content_id  :content_id,
                topic       :topic
            },
            error: function (request, status, error){
                console.log(request.responseText);
            }
        }).done(function(data){
            console.log(data);
            progressbar.Progressbar('100%');
        });
    }

    // Create new Article
    this.create = function(category_id){
    	progressbar.Progressbar('70%');
    	$.ajax({
            url         :article_api,
            cache       :false,
            dataType    :"json",
            type        :"POST",
            data:{
                request     :'create',
                category_id :category_id
            },
            error: function (request, status, error){
                console.log(request.responseText);
            }
        }).done(function(data){
            console.log(data);

            var article_id = data.article_id;
            progressbar.Progressbar('100%');

            setTimeout(function(){
                window.location = 'article/'+article_id+'/editor';
            },1000);
        });
    }

    // Article Remove (set status to deleted)
    this.remove = function(){
    	progressbar.Progressbar('70%');
    	$.ajax({
            url         :article_api,
            cache       :false,
            async 		:false,
            dataType    :"json",
            type        :"POST",
            data:{
                request     :'change_status',
                article_id  :article_id,
                status      :'deleted'
            },
            error: function (request, status, error){
                console.log(request.responseText);
            }
        }).done(function(data){
            console.log(data);
            progressbar.Progressbar('100%');
        });
    }

    // Article status to draft!
    this.draft = function(){
    	progressbar.Progressbar('70%');
    	$.ajax({
            url         :article_api,
            cache       :false,
            async 		:false,
            dataType    :"json",
            type        :"POST",
            data:{
                request     :'change_status',
                article_id  :article_id,
                status      :'draft'
            },
            error: function (request, status, error){
                console.log(request.responseText);
            }
        }).done(function(data){
            console.log(data);
            progressbar.Progressbar('100%');
        });
    }

    // Article status to publish.
    this.publish = function(){
    	progressbar.Progressbar('70%');
    	$.ajax({
            url         :article_api,
            cache       :false,
            async 		:false,
            dataType    :"json",
            type        :"POST",
            data:{
                request     :'change_status',
                article_id  :article_id,
                status      :'published'
            },
            error: function (request, status, error){
                console.log(request.responseText);
            }
        }).done(function(data){
            console.log(data);
            progressbar.Progressbar('100%')
        });
    }

    // Edit article title.
    this.editTitle = function(title){
    	progressbar.Progressbar('70%');
    	$.ajax({
            url         :article_api,
            cache       :false,
            dataType    :"json",
            type        :"POST",
            data:{
                request     :'edit_title',
                article_id  :article_id,
                title       :title
            },
            error: function (request, status, error){
                console.log(request.responseText);
            }
        }).done(function(data){
            console.log(data);
            progressbar.Progressbar('100%');
        });
    }

    // Edit article link (URL)
    this.editURL = function(url){
    	progressbar.Progressbar('70%');
    	$.ajax({
            url         :article_api,
            cache       :false,
            dataType    :"json",
            type        :"POST",
            data:{
                request     :'edit_url',
                article_id  :article_id,
                url    		:url
            },
            error: function (request, status, error){
                console.log(request.responseText);
            }
        }).done(function(data){
            console.log(data);
            progressbar.Progressbar('100%');
        });
    }

    // Set article cover image
    this.setCover = function(cover_id){
    	progressbar.Progressbar('70%');
    	$.ajax({
            url         :article_api,
            cache       :false,
            async 		:false,
            dataType    :"json",
            type        :"POST",
            data:{
                request     :'set_cover',
                article_id  :article_id,
                cover_id    :cover_id
            },
            error: function (request, status, error){
                console.log(request.responseText);
            }
        }).done(function(data){
            console.log(data);
            progressbar.Progressbar('100%');
        });
    }

    // Edit Article description.
    this.editDescription = function(text){
    	progressbar.Progressbar('70%');
    	$.ajax({
            url         :article_api,
            cache       :false,
            dataType    :"json",
            type        :"POST",
            data:{
                request     :'edit_description',
                article_id  :article_id,
                description :text
            },
            error: function (request, status, error){
                console.log(request.responseText);
            }
        }).done(function(data){
            console.log(data);
            progressbar.Progressbar('100%');
        });
    }

    // TAGS
    // Add article tags.
    this.addTags = function(tag){
    	progressbar.Progressbar('70%');
    	$.ajax({
            url         :article_api,
            cache       :false,
            dataType    :"json",
            type        :"POST",
            data:{
                request     :'add_tag',
                article_id  :article_id,
                tag         :tag
            },
            error: function (request, status, error){
                console.log(request.responseText);
            }
        }).done(function(data){
        	progressbar.Progressbar('100%');
            console.log(data);
            location.reload();
        });
    }

    // Remove article tag.
    this.removeTag = function(tag_id){
    	progressbar.Progressbar('70%');
    	$.ajax({
            url         :article_api,
            cache       :false,
            async 		:false,
            dataType    :"json",
            type        :"POST",
            data:{
                request     :'remove_tag',
                article_id  :article_id,
                tag_id      :tag_id
            },
            error: function (request, status, error){
                console.log(request.responseText);
            }
        }).done(function(data){
            console.log(data);
            progressbar.Progressbar('100%');
        });
    }
}