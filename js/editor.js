var article_api = 'api/article';
var youtube_key = 'AIzaSyB5KfCVIK9XviNJ9fNYWwAGhZfRskjGQ_M';
// Allowed file size is less than 15 MB (15728640)
var max_filesize        = $('#maximumSize').val();

$(document).ready(function(){
    $('.autosize').autosize({append: "\n"});
    tippy('[title]',{arrow: true});

    // Editor saved status
    function saveStatus(m){
        if(m == 'saved')
            $('#editor-status').html('<i class="fal fa-check"></i>');
        else
            $('#editor-status').html('');
    }

    // Get article id
    var article_id  = $('#article_id').val();

    // Create Class
    var article = new Article(article_id);

    // Choose cover image.
    $('#btnChooseCover').click(function(){
        $('#coverImageFiles').focus().click();
    });
    $('#btnRemoveCover').click(function(){
        if(!confirm('คุณต้องการลบภาพหน้าปก ใช่หรือไม่ ?')) return false
        article.removeHeadCover()
    });
    $('#coverImageFiles').change(function(){
        $('#coverForm').submit()
    });
    $('#coverForm').ajaxForm({
        beforeSubmit: function(formData, jqForm, options){
            $('#btnChooseCover').html('กำลังอัพโหลด...')
        },
        uploadProgress: function(event,position,total,percentComplete) {
            var percent = percentComplete;
            percent = (percent * 85) / 100;

            console.clear();
            console.log('Upload: '+percent+' %')
            $progressbar.Progressbar(percent+'%')
        },
        success: function() {
            console.clear();
            $progressbar.Progressbar('85%')
        },
        complete: function(xhr) {
            $progressbar.Progressbar('99.99%')
            console.log(xhr.responseJSON)
            location.reload()
        }
    });

    // Upload multiple image files
    $('#btnMultipleImages').click(function(){
        $('#multipleImageFiles').focus().click()
    });
    $('#multipleImageFiles').change(function(){
        $('#multipleImagesForm').submit()
    });
    $('#multipleImagesForm').ajaxForm({
        beforeSubmit: function(formData, jqForm, options){
            // $('.btn-add-cover').html('<i class="fa fa-spinner fa-spin" aria-hidden="true"></i>');
        },
        uploadProgress: function(event,position,total,percentComplete) {
            var percent = percentComplete;
            percent = (percent * 80) / 100;
            
            console.log('Upload: '+percentComplete+' %');
            $progressbar.Progressbar(percentComplete+'%');
        },
        success: function() {
            // $photoLoadingBar.animate({width:'100%'},300);
        },
        complete: function(xhr) {
            // console.log(xhr.responseText);
            console.log(xhr.responseJSON);
            location.reload();
        }
    });
    
    $(document).click(function(e){
        if(!$(e.target).is('.between-option')){
            $('.more-option').fadeOut(100);
            $overlay.removeClass('open');
        }
    })

    /**
    * Content events listening
    */
    // Edit Article Title.
    $title = $('#title')
    setTimeout(function(){
        var title = $('#original_title').val();
        $title.val(title).trigger("input")

        if(title.length == 0)
            document.title = 'ตั้งชื่อบทความ'
        else
            document.title = title
    },0);

    var oldTitle
    $title.on({
        'input': function(e){
            var t = $(this).val()
            if(t.length == 0)
                document.title = 'ตั้งชื่อบทความ'
            else
                document.title = $(this).val()
        },
        focus: function(e) {
            oldTitle = $(this).val()
            saveStatus()
        },
        blur: function(e) {
            var now = $(this).val()
            if(oldTitle == now)
                return false
            else{
                article.editTitle(now)
                document.title = now
                saveStatus('saved')
            }
        }
    })

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
    
    // Publish Article
    $('#btn-publish').click(function(){
        $(this).removeClass('active');

        // article.publish();
        
        setTimeout(function(){
            window.location = 'article/'+article_id;
        },1000);
    });

    $('#btn-remove').click(function(){
        if(!confirm('คุณต้องการลบบทความใช่หรือไม่ ?')){ return false; }

        article.remove();
        
        setTimeout(function(){
            window.location = 'profile';
        },1000);
    });

    $('#btn-draft').click(function(){
        if(!confirm('คุณต้องการยกเลิกเผยแพร่บทความนี้ ใช่หรือไม่ ?')){ return false; }

        article.draft();

        setTimeout(function(){
            location.reload();
        },1000);
    });

    /**
    * Content events listening
    */
    var topic;
    var body;
    var alt;

    // Change topic of Content.
    $topic = $('.topic')
    $topic.focus(function(){
        topic = $(this).val()
        saveStatus()
    })

    $topic.blur(function(){
        var content_id  = $(this).parent().attr('data-content')
        var new_topic   = $(this).val()

        if(topic == new_topic) return false

        article.editTopic(content_id,new_topic)
        saveStatus('saved')
    });

    // Google Map location Upload
    $('.lat').on('input',function(event) {
        var content_id  = $(this).parent().attr('data-content')
        var lat         = $(this).val()
        var lng         = $(this).parent().children('.lng').val()

        saveStatus('save')
        article.editLocation(content_id,lat,lng)
    })

    // Change Body of Content.
    $body = $('.body')
    $body.focus(function(){
        body = $(this).val();
        saveStatus()
    })

    $body.blur(function(){
        var content_id  = $(this).parent().attr('data-content')
        var news_body   = $(this).val()

        if(body == news_body)
            return false

        saveStatus('saved')
        article.editBody(content_id,news_body)
    });

    // Edit Image Alt
    $alt = $('.alt')
    $alt.focus(function(){
        alt = $(this).val();
        saveStatus()
    })

    $alt.blur(function(){
        var content_id  = $(this).parent().attr('data-content')
        var new_alt     = $(this).val()

        if(alt == new_alt)
            return false

        saveStatus('saved')

        article.editAlt(content_id,new_alt)
    })

    // Youtube Content
    var own_youtube_id;
    $YouTubeURL = $('.youtube_url');
    $YouTubeURL.focus(function(){
        var content_id  = $(this).parent().parent().attr('data-content');
            $YouTubeID  = $('#content'+content_id).children('.youtube_id');
        own_youtube_id  = $YouTubeID.val();

        saveStatus()

        console.log(own_youtube_id);
    });

    $YouTubeURL.on('input',function(){
        var content_id  = $(this).parent().parent().attr('data-content');
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

            console.log($YouTubePreview,embed);

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
        var content_id  = $(this).parent().parent().attr('data-content');
            $YouTubeID  = $('#content'+content_id).children('.youtube_id');
        var youtube_url = $(this).val();
        var youtube_id  = YouTubeParser(youtube_url);

        if(youtube_id == 0 || youtube_id.length != 11){
            return false
        }

        article.editVideo(content_id,youtube_id)
        saveStatus('saved')
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

            console.clear();
            $photoLoadingBar.animate({width:percent+'%'},100);
            console.log('Upload: '+percentComplete+' %');
        },
        success: function() {
            $photoLoadingBar.animate({width:'100%'},300);
        },
        complete: function(xhr) {
            console.log(xhr.responseText);
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

        article.deleteContent(content_id)
        location.reload();
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
        
        article.imageRotate(content_id)
        $img.attr('src',$img.attr('src')+'?'+Math.random()*100);
        saveStatus('saved')
    });

    $('.btn-swap').click(function(){
        $('#swap').addClass('-toggle');
        $('#overlay').addClass('open');

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
                    var html = $('<div class="swap-items '+current+'" data-id="'+v.id+'"><img src="image/upload/'+article_id+'/thumbnail/'+v.img_location+'"></div>');
                else if(v.type == 'youtube')
                    var html = $('<div class="swap-items '+current+'" data-id="'+v.id+'"><img src="http://img.youtube.com/vi/'+v.message+'/mqdefault.jpg"></div>');

                $('#swap').append(html);
            });
        });

        $('#overlay').click(function(){
            $(this).removeClass('open');
            $('#swap').removeClass('-toggle');
            $('#swap').html('');
        });
    });

    $('#swap').on('click','.swap-items',function(e){
        var target_id = $(this).attr('data-id');
        console.log(content_id,target_id);

        if(content_id == target_id) return false;

        article.swapContent(content_id,target_id)
    });

    $documentForm       = $('#documentForm');
    $btnAttachFile      = $('#btnAttachFile');
    $fileName           = $('#fileName');
    $fileInput          = $('#file');

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
        },
        uploadProgress: function(event,position,total,percentComplete) {
            var percent = percentComplete;
            percent = (percent * 85) / 100;

            console.clear();
            console.log('Upload: '+percent+' %')
            $progressbar.Progressbar(percent+'%')
        },
        success: function() {
            $progressbar.Progressbar('99%')
        },
        complete: function(xhr) {
            console.log(xhr.responseText);

            if(xhr.responseJSON){
                var file_id = xhr.responseJSON.file_id;
                location.reload();
            }else{
                alert('ไฟล์ของคุณไม่สามารถอัพโหลดเข้าระบบได้ กรุณาติดต่อผู้ดูแลระบบ');
                location.reload();
            }
        }
    });

    // Edit Image Alt
    var own_doc_title
    $document = $('.file_title')
    $document.focus(function(){
        own_doc_title = $(this).val()
        saveStatus()
    });

    $document.blur(function(){
        var file_id     = $(this).parent().parent().attr('data-file')
        var doc_title   = $(this).val()

        if(own_doc_title == doc_title) return false
        article.editDocTitle(file_id,doc_title)

        saveStatus('saved')
    });

    // Delete Delete!
    $('.btn-doc-delete').click(function(){
        var file_id  = $(this).parent().attr('data-file');
        var file_name = $(this).parent().children('.detail').children('.file_title').val();
        $thisItems = $(this).parent();
        if(!confirm('คุณต้องการลบ "'+file_name+'" ใช่หรือไม่ ?')){ return false; }

        article.deleteDoc(file_id)
        $thisItems.fadeOut(300)
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