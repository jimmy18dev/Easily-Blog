var article_api = 'api/article';

$(document).ready(function(){
    $('.autosize').autosize({append: "\n"});

    /**
    * Content events listening
    */
    var article_id  = $('#article_id').val(); // Current Article ID
    var article_title;
    var article_description;

    $(document).click(function(e){
        if(!$(e.target).is('.between-option')){
            $('.more-option').fadeOut(100);
        }
        
        if(!$(e.target).is('#swap') && !$(e.target).is('.fa-sort')){
            $('#swap').removeClass('-toggle');
        }

        console.log(e.target);
    });

    // Edit Article Title.
    $articleTitle = $('#articleTitle');
    setTimeout(function(){
        var title = $('#realtitle').val();
        $articleTitle.val(title).trigger("input");
    },100); 
    $articleTitle.focus(function(){
        article_title = $(this).val();
    });
    $articleTitle.blur(function(){
        var now_value = $(this).val();

        if(article_title == now_value) return false;

        $.ajax({
            url         :article_api,
            cache       :false,
            dataType    :"json",
            type        :"POST",
            data:{
                request     :'edit_title',
                article_id  :article_id,
                title       :now_value
            },
            error: function (request, status, error){
                console.log(request.responseText);
            }
        }).done(function(data){
            console.log(data);
        });
    });

    // Edit Article description.
    $articleDescription = $('#articleDescription');
    $articleDescription.focus(function(){
        article_description = $(this).val();
    });
    $articleDescription.blur(function(){
        var now_value = $(this).val();

        if(article_description == now_value) return false;

        $.ajax({
            url         :article_api,
            cache       :false,
            dataType    :"json",
            type        :"POST",
            data:{
                request     :'edit_description',
                article_id  :article_id,
                description :now_value
            },
            error: function (request, status, error){
                console.log(request.responseText);
            }
        }).done(function(data){
            console.log(data);
        });
    });

    // Add New Content Box.
    $btnAction = $('.btnAction');
    $btnAction.click(function(){
        var action      = $(this).attr('data-action');
        var content_id  = $(this).attr('data-content');

        console.log(article_id);
        $.ajax({
            url         :article_api,
            cache       :false,
            dataType    :"json",
            type        :"POST",
            data:{
                request     :'create_content',
                article_id  :article_id,
                content_id  :content_id,
                type        :action
            },
            error: function (request, status, error){
                console.log(request.responseText);
            }
        }).done(function(data){
            console.log(data);
            location.reload();
        });
    });

    /**
    * Content events listening
    */
    var topic;
    var body;
    var img_alt;

    // Change topic of Content.
    $topicInput = $('.topic-input');
    $topicInput.focus(function(){
        topic = $(this).val();
    });

    $topicInput.blur(function(){
        var content_id = $(this).parent().attr('data-content');
        var new_topic = $(this).val();

        console.log(topic);
        console.log(new_topic);

        if(topic == new_topic) return false;

        $.ajax({
            url         :article_api,
            cache       :false,
            dataType    :"json",
            type        :"POST",
            data:{
                request     :'edit_topic',
                article_id  :article_id,
                content_id  :content_id,
                topic       :new_topic
            },
            error: function (request, status, error){
                console.log(request.responseText);
            }
        }).done(function(data){
            console.log(data);
        });
    });

    // Change Body of Content.
    $bodyInput = $('.body-input');
    $bodyInput.focus(function(){
        body = $(this).val();
    });

    $bodyInput.blur(function(){
        var content_id  = $(this).parent().attr('data-content');
        var news_body = $(this).val();

        if(body == news_body) return false;

        $.ajax({
            url         :article_api,
            cache       :false,
            dataType    :"json",
            type        :"POST",
            data:{
                request     :'edit_body',
                article_id  :article_id,
                content_id  :content_id,
                body        :news_body
            },
            error: function (request, status, error){
                console.log(request.responseText);
            }
        }).done(function(data){
            console.log(data);
        });
    });

    // Edit Image Alt
    $imageAlt = $('.image-alt');
    $imageAlt.focus(function(){
        img_alt = $(this).val();
    });

    $imageAlt.blur(function(){
        var content_id  = $(this).parent().attr('data-content');
        var new_img_alt = $(this).val();

        if(img_alt == new_img_alt) return false;

        $.ajax({
            url         :article_api,
            cache       :false,
            dataType    :"json",
            type        :"POST",
            data:{
                request     :'edit_img_alt',
                article_id  :article_id,
                content_id  :content_id,
                img_alt     :new_img_alt
            },
            error: function (request, status, error){
                console.log(request.responseText);
            }
        }).done(function(data){
            console.log(data);
        });
    });

    ////////////////////////////
    // Image Form
    var content_id;
    // $imagePreview = $('.imgpreview');
    $('.btn-choose-image').click(function(){
        content_id = $(this).parent().parent().parent().attr('data-content');
        console.log('btn choose image clicked! with content '+content_id);
        $('#imageFiles'+content_id).focus().click();
    });

    $('.btn-change-image').click(function(){
        content_id = $(this).parent().parent().attr('data-content');
        $('#imageFiles'+content_id).focus().click();
    });

    $('.image-file').change(function(){
        // var content_id  = $(this).parent().attr('data-content');
        $imagePreview   = $('#imagePreview'+content_id);
        $imageForm      = $('#imageForm'+content_id)

        console.log('content '+content_id);
        var files   = this.files;

        $imagePreview.html(''); // Clear thumbnail container.

        var file    = files[0];
        var imageType = /image.*/

        console.log('file',file);

        if(!file.type.match(imageType)){
            console.log("Not an Image");
            // continue;
        }

        var image = document.createElement("img");

        image.file = file;
        $imagePreview.append(image);
        var reader = new FileReader();

        reader.onload = (function(aImg){
            return function(e){ aImg.src = e.target.result; };
        }(image));

        var ret = reader.readAsDataURL(file);
        var canvas = document.createElement("canvas");
        ctx = canvas.getContext("2d");

        image.onload= function(){ ctx.drawImage(image,100,100); }
        $imageForm.submit();
    });

    // Upload a Photo
    $photoForm          = $('.photoForm');
    $photoLoading       = null;
    $photoLoadingBar    = null;
    $photoForm.ajaxForm({
        beforeSubmit: function(formData, jqForm, options){
            $photoLoading = $('#loading'+content_id);
            $photoLoadingBar = $('#bar'+content_id);
            $photoLoading.fadeIn(300);
            
            $photoForm.clearForm();
        },
        uploadProgress: function(event,position,total,percentComplete) {
            var percent = percentComplete;
            percent = (percent * 80) / 100;
            $photoLoadingBar.animate({width:percent+'%'},100);
            
            console.log('Upload: '+percentComplete+' %');
        },
        success: function() {
            $photoLoadingBar.animate({width:'100%'},300);
        },
        complete: function(xhr) {
            // console.log(xhr.responseText);
            console.log(xhr.responseJSON);

            // var image_file  = xhr.responseJSON.image_file;
            // var content_id  = xhr.responseJSON.content_id;
            // var alt         = xhr.responseJSON.alt;

            $photoLoading.fadeOut(300);
        }
    });
    ////////////////////////////////

    // Delete Content Box.
    $btnDeleteContent = $('.btnDeleteContent');
    $btnDeleteContent.click(function(){
        var content_id = $(this).parent().parent().attr('data-content');
        if(!confirm('Delete this Content #'+content_id+' ?')){ return false; }

        $.ajax({
            url         :article_api,
            cache       :false,
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
            location.reload();
        });
    });

    $('.between-option').click(function(){
        $moreOption = $(this).children('.more-option');
        $moreOption.fadeIn(300);
    });

    $('.btn-rotate-image').click(function(){
        content_id = $(this).parent().parent().attr('data-content');
        $img = $('#imagePreview'+content_id).children('img');

        console.log($img);

        // $img = $imagePreview.children('img');

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
            $img.attr('src',$img.attr('src')+'?'+Math.random()*100);
        });
    });

    $('.btn-swap').click(function(){
        $('#swap').addClass('-toggle');
        $('#swapFilter').fadeIn(300);

        var article_id = $('#article_id').val();
        content_id = $(this).parent().parent().attr('data-content');

        $.ajax({
            url         :article_api,
            cache       :false,
            dataType    :"json",
            type        :"GET",
            data:{
                request     :'get',
                article_id  :article_id,
            },
            error: function (request, status, error){
                console.log(request, status, error);
            }
        }).done(function(data){
            console.log(data);
            $('#swap').html('');

            $.each(data.dataset.contents,function(k,v){
                var current     = '';
                if(content_id == v.id) current = '-active';

                if(v.type == 'textbox')
                    var html = $('<div class="swap-items text '+current+'" data-id="'+v.id+'">'+v.body+'</div>');
                else if(v.type == 'image')
                    var html = $('<div class="swap-items '+current+'" data-id="'+v.id+'"><img src="image/upload/thumbnail/'+v.img_location+'"></div>');
                else if(v.type == 'youtube')
                    var html = $('<div class="swap-items '+current+'" data-id="'+v.id+'"><img src="http://img.youtube.com/vi/'+v.message+'/mqdefault.jpg"></div>');

                $('#swap').append(html);
            });
        });

        $('#swapFilter').click(function(){
            $(this).fadeOut(300);
            $('#swap').removeClass('-toggle');
        });
    });

    $('#swap').on('click','.swap-items',function(e){
        var target_id = $(this).attr('data-id');
        console.log(content_id,target_id);

        if(content_id == target_id) return false;

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
        });
    });
});