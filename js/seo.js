var article_api = 'api/article';
var article_id = $('#article_id').val();

$(document).ready(function(){
    $('.cover-items').click(function(){
        $this = $(this);
        var cover_id = $(this).attr('data-cover');

        $.ajax({
            url         :article_api,
            cache       :false,
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
            $('.cover-items').removeClass('active');
            $this.addClass('active');
        });
    });

    $('#articleURL').on('blur',function(event) {
        var url = $(this).val();
        console.log(url);
        
        $.ajax({
            url         :article_api,
            cache       :false,
            dataType    :"json",
            type        :"POST",
            data:{
                request     :'edit_url',
                article_id  :article_id,
                url    :url
            },
            error: function (request, status, error){
                console.log(request.responseText);
            }
        }).done(function(data){
            console.log(data);
        });
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
                status: 'published'
            },
            error: function (request, status, error){
                console.log(request.responseText);
            }
        }).done(function(data){
            console.log(data);
            $progressbar.animate({width:'100%'},500);
            $progressbar.fadeOut();

            setTimeout(function(){
                window.location = 'article/'+article_id;
            },1000);
        });
    });
});