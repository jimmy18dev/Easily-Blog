var article_api = 'api/article';

$(document).ready(function(){
    $chooseCategory = $('.choose-category');
    $chooseCategory.click(function(){

        var category_id = $(this).attr('data-id');

        $.ajax({
            url         :article_api,
            cache       :false,
            dataType    :"json",
            type        :"POST",
            data:{
                request     :'create'
            },
            error: function (request, status, error){
                console.log(request.responseText);
            }
        }).done(function(data){
            console.log(data);
            var article_id = data.article_id;
            setTimeout(function(){
                window.location = 'article/editor/'+article_id;
            },1000);
        });
    });
});