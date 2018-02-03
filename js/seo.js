var article_api = 'api/article';
var article_id = $('#article_id').val();

$(document).ready(function(){
    $('.cover-items').click(function(){
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
});