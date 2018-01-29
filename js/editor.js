var article_api = 'api/article';

$(document).ready(function(){
    $('.autosize').autosize({append: "\n"});

    $('#btnPublish').click(function(event) {
        console.log('btnPublish click');
        $('#publishPanel').fadeIn(300);
    });

    $('#btnProfile').click(function(event) {
        $('#profilePanel').fadeIn(300);
    });

    function inprogress(action){
        $title = $('#editorTitle');
        switch (action){
            case 'editing':
                $title.html('[แก้ไข]');
                break;
            case 'fail':
                $title.html('ลองอีกครั้ง!');
                $progressbar.animate({width:'0%'},500);
                $progressbar.fadeOut();
                break;
            case 'progress':
                $title.html('กำลังบันทึก...');
                $progressbar.fadeIn(300);
                $progressbar.width('0%');
                $progressbar.animate({width:'70%'},500);
                break;
            case 'complete':
                $progressbar.animate({width:'100%'},500);
                $progressbar.fadeOut(function(){
                    $title.html('บันทึกแล้ว');
                });
                break;
            default:
                $title.html('เขียนบทความ');
                break;
        }
    }
    $(document).click(function(e){
        if(!$(e.target).is('.between-option')){
            $('.more-option').fadeOut(100);
        }
        
        if(!$(e.target).is('#swap') && !$(e.target).is('.fa-sort')){
            $('#swap').removeClass('-toggle');
        }

        // console.log(e.target);
    });

    // Publish Article
    $('#btn-publish').click(function(){
        
        $progressbar.fadeIn(300);
        $progressbar.width('0%');
        $progressbar.animate({width:'70%'},500);

        $.ajax({
            url         :article_api,
            cache       :false,
            dataType    :"json",
            type        :"POST",
            data:{
                request     :'change_status',
                article_id  :article_id,
                status: 'publish'
            },
            error: function (request, status, error){
                console.log(request.responseText);
            }
        }).done(function(data){
            console.log(data);
            $progressbar.animate({width:'100%'},500);
            $progressbar.fadeOut();
        });
    });



    /**
    * Content events listening
    */
    var article_id  = $('#article_id').val(); // Current Article ID
    var title;
    var description;

    // Edit Article Title.
    $title = $('#title');

    setTimeout(function(){
        var title = $('#original_title').val();
        $title.val(title).trigger("input");
    },0);

    $title.focus(function(){
        title = $(this).val();
        inprogress('editing');
    });
    $title.blur(function(){
        var now_value = $(this).val();

        if(title == now_value){
            inprogress();
            return false;
        }

        inprogress('progress');

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
            inprogress('complete');
        });
    });

    // Edit Article description.
    $description = $('#description');
    $description.focus(function(){
        description = $(this).val();
        inprogress('editing');
    });
    $description.blur(function(){
        var now_value = $(this).val();

        if(description == now_value){
            inprogress();
            return false;
        }

        inprogress('progress');

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
            inprogress('complete');
        });
    });

    // Add Content Box.
    $btnAction = $('.btnAction');
    $btnAction.click(function(){
        var action      = $(this).attr('data-action');
        var content_id  = $(this).attr('data-content');

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
            var content_id = data.content_id;
            var page_url = window.location.pathname+'#content'+content_id;
            console.log(page_url);

            window.location.href = page_url;
            window.location.reload(true)
        });
    });

    /**
    * Content events listening
    */
    var topic;
    var body;
    var alt;

    // Change topic of Content.
    $topic = $('.topic');
    $topic.focus(function(){
        topic = $(this).val();
        inprogress('editing');
    });

    $topic.blur(function(){
        var content_id = $(this).parent().attr('data-content');
        var new_topic = $(this).val();

        if(topic == new_topic){
            inprogress();
            return false;
        }

        inprogress('progress');

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
            inprogress('complete');
        });
    });

    // Change Body of Content.
    $body = $('.body');
    $body.focus(function(){
        body = $(this).val();
        inprogress('editing');
    });

    $body.blur(function(){
        var content_id  = $(this).parent().attr('data-content');
        var news_body = $(this).val();

        if(body == news_body){
            inprogress();
            return false;
        }

        inprogress('progress');

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
            inprogress('complete');
        });
    });

    // Edit Image Alt
    $alt = $('.alt');
    $alt.focus(function(){
        alt = $(this).val();
        inprogress('editing');
    });

    $alt.blur(function(){
        var content_id  = $(this).parent().attr('data-content');
        var new_alt = $(this).val();

        if(alt == new_alt){
            inprogress();
            return false;
        }

        inprogress('progress');

        $.ajax({
            url         :article_api,
            cache       :false,
            dataType    :"json",
            type        :"POST",
            data:{
                request     :'edit_img_alt',
                article_id  :article_id,
                content_id  :content_id,
                img_alt     :new_alt
            },
            error: function (request, status, error){
                console.log(request.responseText);
            }
        }).done(function(data){
            console.log(data);
            inprogress('complete');
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
        $imageForm      = $('#content'+content_id)

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
    $photoForm          = $('.content');
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
            $('#content'+content_id).fadeOut(500);
        });
    });

    $('.between-option').click(function(){
        $moreOption = $(this).children('.more-option');
        $moreOption.fadeIn(300);
    });

    $('.btn-rotate-image').click(function(){
        content_id = $(this).parent().parent().attr('data-content');
        $img = $('#imagePreview'+content_id).children('img');

        document.querySelector('#imagePreview'+content_id).scrollIntoView({behavior: 'smooth'});

        inprogress('progress');

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
            inprogress('complete');
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