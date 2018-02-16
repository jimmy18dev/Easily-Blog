//Constructor
var Article = function (article_id){

    //private properties
    var article_api = 'api/article';
    var progressbar = $('#progressbar');
    var article_id 	= article_id;

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