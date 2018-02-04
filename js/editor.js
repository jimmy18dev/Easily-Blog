var article_api = 'api/article';
var youtube_key = 'AIzaSyB5KfCVIK9XviNJ9fNYWwAGhZfRskjGQ_M';
// Allowed file size is less than 15 MB (15728640)
var max_filesize        = $('#maximumSize').val();
var api_document        = 'api/document';
var current_article_id;

$(document).ready(function(){
    current_article_id = $('#article_id').val();

    $('.autosize').autosize({append: "\n"});
    tippy('[title]',{arrow: true});

    $('#btnPublish').click(function(event) {
        console.log('btnPublish click');
        $('#publishPanel').fadeIn(300);
    });

    $('#btnProfile').click(function(event) {
        $('#profilePanel').fadeIn(300);
    });

    function inprogress(action){
        $title  = $('#editorTitle');
        $icon   = $('#editorIcon');

        switch (action){
            case 'editing':
                $title.html('แก้ไข');
                $icon.html('<i class="fa fa-keyboard-o" aria-hidden="true"></i>');
                break;
            case 'fail':
                $title.html('ลองอีกครั้ง!');
                $progressbar.animate({width:'0%'},500);
                $progressbar.fadeOut();
                break;
            case 'progress':
                $title.html('กำลังบันทึก...');
                $icon.html('<i class="fa fa-spinner fa-spin" aria-hidden="true"></i>');
                $progressbar.fadeIn(300);
                $progressbar.width('0%');
                $progressbar.animate({width:'70%'},500);
                break;
            case 'complete':
                $progressbar.animate({width:'100%'},500);
                $progressbar.fadeOut(function(){
                    $title.html('บันทึกแล้ว');
                    $icon.html('<i class="fa fa-check-circle" aria-hidden="true"></i>');
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
            $overlay.removeClass('open');
        }
        
        if(!$(e.target).is('#swap') && !$(e.target).is('.fa-sort')){
            $('#swap').removeClass('-toggle');
        }

        // console.log(e.target);
    });



    /**
    * Content events listening
    */
    var article_id  = $('#article_id').val(); // Current Article ID
    var title;
    var description;

    // Edit Article Title.
    $title = $('#title');
    $description = $('#description');

    setTimeout(function(){
        var title = $('#original_title').val();
        $title.val(title).trigger("input");

        if(title.length == 0)
            document.title = 'ตั้งชื่อบทความ';
        else
            document.title = title;
    },0);

    $title.focus(function(){
        title = $(this).val();
        inprogress('editing');
    });
    $title.on('input',function(event) {
        var t = $(this).val();

        if(t.length == 0)
            document.title = 'ตั้งชื่อบทความ';
        else
            document.title = $(this).val();
    });

    $title.blur(function(){
        var now_value = $(this).val();

        console.log('Title '+title);

        if(now_value)
            $description.removeClass('hidden');
        else
            $description.addClass('hidden');

        if(title == now_value){
            inprogress();
            return false;
        }

        document.title = now_value;

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

        if(!action) return false;

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

    // Google Map location Upload
    $('.lat').on('input',function(event) {
        var content_id  = $(this).parent().attr('data-content');
        var lat         = $(this).val();
        var lng         = $(this).parent().children('.lng').val();

        inprogress('progress');

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

    // Youtube Content
    var own_youtube_id;
    $YouTubeURL = $('.youtube_url');
    $YouTubeURL.focus(function(){
        var content_id  = $(this).parent().attr('data-content');
            $YouTubeID  = $('#content'+content_id).children('.youtube_id');
        own_youtube_id  = $YouTubeID.val();

        console.log(own_youtube_id);
    });

    $YouTubeURL.on('input',function(){
        var content_id  = $(this).parent().attr('data-content');
            $YouTubeID  = $('#content'+content_id).children('.youtube_id');
        var youtube_url = $(this).val();
        var youtube_id  = YouTubeParser(youtube_url);

        if(own_youtube_id == youtube_id){
            console.log('YouTube ID Not Change!');
            return false;
        }

        if(youtube_id != 0 && youtube_id.length == 11){
            $YouTubePreview = $('#content'+content_id).children('.videoWrapper');
            $YouTubeAlt     = $('#content'+content_id).children('.alt');
            $YouTubeID.val(youtube_id);
            var embed = '<iframe src="https://www.youtube.com/embed/'+youtube_id+'?rel=0&amp;controls=0&amp;showinfo=0"></iframe>';
            $YouTubePreview.html(embed);
            $YouTubePreview.fadeIn(300);
            $YouTubeAlt.fadeIn(300);

            // Calling YouTube API With Access Key.
            var youtube_api = 'https://www.googleapis.com/youtube/v3/videos?part=snippet&id='+youtube_id+'&key='+youtube_key;
            $.getJSON(youtube_api,function(data){
                console.log(data.items.length,data);

                if(data.items.length != 0){
                    var video_title = data.items[0].snippet.title;
                    console.log(video_title);
                }else{
                    console.log('Video not found!');
                }
            });
        }
    });

    function YouTubeParser(url){
        var videoid = url.match(/(?:https?:\/{2})?(?:w{3}\.)?youtu(?:be)?\.(?:com|be)(?:\/watch\?v=|\/)([^\s&]+)/);

        if(videoid != null) {
            return videoid[1];
        }else{
            return 0;
        }
    }

    $YouTubeURL.blur(function(){
        var content_id  = $(this).parent().attr('data-content');
            $YouTubeID  = $('#content'+content_id).children('.youtube_id');
        var youtube_url = $(this).val();
        var youtube_id  = YouTubeParser(youtube_url);

        if(youtube_id == 0 || youtube_id.length != 11){
            return false;
        }

        inprogress('progress');

        $.ajax({
            url         :article_api,
            cache       :false,
            dataType    :"json",
            type        :"POST",
            data:{
                request     :'edit_video_id',
                article_id  :article_id,
                content_id  :content_id,
                video_id    :youtube_id
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
    $photoAlt           = null;
    $photoForm.ajaxForm({
        beforeSubmit: function(formData, jqForm, options){
            $photoLoading       = $('#loading'+content_id);
            $photoLoadingBar    = $('#bar'+content_id);
            $photoAlt           = $('#alt'+content_id);

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
            $photoAlt.fadeIn(300);
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
        $overlay.addClass('open');
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

    $documentForm       = $('#documentForm');
    $btnAttachFile      = $('#btnAttachFile');
    $fileName           = $('#fileName');
    $fileInput          = $('#file');
    $documentProgress   = $('#documentProgress');
    $documentProgressBar = $('#documentProgressBar');

    $btnAttachFile.click(function(){
        $fileInput.focus().click();
    });

    $fileInput.change(function(){
        var files       = this.files;
        var file        = files[0];
        var size        = file.size;
        var filename    = file.name.substring(0,file.name.lastIndexOf('.'));
        var extension   = file.name.substring(file.name.lastIndexOf('.')+1);

        if(!FileType(extension)){
            alert('ระบบยังไม่รองรับไฟล์ประเภท .'+extension);
            location.reload();
            return false;
        }else if(!FileSize(size)){
            alert('ไฟล์ของคุณมีขนาด '+numeral(size).format('0.0 b')+' ซึ่งต้องไม่เกิน '+(max_filesize/1048576)+' MB');
            location.reload();
            return false;
        }else{
            $fileName.html(file.name);
            $documentForm.submit();
        }
    });

    $documentForm.ajaxForm({
        beforeSubmit: function(formData, jqForm, options){

            if(!formData[0].value){
                console.log('File input is empty!');
                return false;
            }

            var filename        = formData[0].value.name;
            var filesize        = formData[0].value.size;
            var extension       = filename.substring(filename.lastIndexOf('.')+1);
            var title           = formData[1].value;

            if(!FileSize(filesize)) return false;
            if(!FileType(extension)) return false;
            if(!title || !filename) return false;

            $documentForm.fadeIn(300);
            $documentProgress.fadeIn(300);
            $documentProgressBar.width('0%');
        },
        uploadProgress: function(event,position,total,percentComplete) {
            var percent = percentComplete;
            percent = (percent * 80) / 100;
            $documentProgressBar.animate({width:percent+'%'},0);
        },
        success: function() {
            $documentProgressBar.animate({width:'90%'},100);
        },
        complete: function(xhr) {
            console.log(xhr.responseText);
            if(xhr.responseJSON){

                var file_id = xhr.responseJSON.file_id;

                $documentProgressBar.animate({width:'100%'},300,function(){
                    location.reload();
                });
            }else{
                alert('ไฟล์ของคุณไม่สามารถอัพโหลดเข้าระบบได้ กรุณาติดต่อผู้ดูแลระบบ');
                location.reload();
            }
        }
    });

    // Edit Image Alt
    var own_doc_title;
    $document = $('.file_title');
    $document.focus(function(){
        own_doc_title = $(this).val();
        inprogress('editing');
    });

    $document.blur(function(){
        var file_id  = $(this).parent().parent().attr('data-file');
        var doc_title = $(this).val();

        if(own_doc_title == doc_title){
            inprogress();
            return false;
        }

        inprogress('progress');

        $.ajax({
            url         :api_document,
            cache       :false,
            dataType    :"json",
            type        :"POST",
            data:{
                request     :'edit_title',
                file_id  :file_id,
                title     :doc_title
            },
            error: function (request, status, error){
                console.log(request.responseText);
            }
        }).done(function(data){
            console.log(data);
            inprogress('complete');
        });
    });

    // Delete Delete!
    $('.btn-doc-delete').click(function(){
        var file_id  = $(this).parent().attr('data-file');
        var file_name = $(this).parent().children('.detail').children('.file_title').val();
        $thisItems = $(this).parent();
        if(!confirm('คุณต้องการลบ "'+file_name+'" ใช่หรือไม่ ?')){ return false; }

        $.ajax({
            url         :api_document,
            cache       :false,
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
            $thisItems.fadeOut(300);
        });
    });
});

function FileSize(fsize){
    if(fsize > max_filesize)
        return false;
    else
        return true;
}
function FileType(extension){
    switch(extension){
        case 'pdf': case 'txt': case 'doc': case 'docx': case 'ppt': case 'pptx': case 'xls': case 'xlsx': case 'zip':
            break;
        default:
            return false
        }

    return true;
}