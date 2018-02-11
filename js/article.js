var article_api = 'api/article';
var category_id;

$(document).ready(function(){
    $btnStartWrite = $('#btnStartWrite');
    $btnStartWrite.click(function(){   

        if(!category_id) return false;

        $btnStartWrite.removeClass('active');
        $btnStartWrite.html('รอสักครู่<i class="fa fa-spinner fa-spin" aria-hidden="true"></i>');
        $progressbar.fadeIn(300);
        $progressbar.width('0%');
        $progressbar.animate({width:'70%'},500);

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
            setTimeout(function(){
                $progressbar.animate({width:'100%'},500);
                window.location = 'article/'+article_id+'/editor';
            },1000);
        });
    });

    $chooseCategory = $('.choose-category');
    $chooseCategory.click(function(){
        category_id = $(this).attr('data-id');
        $btnStartWrite.addClass('active');
        $('.choose-category').removeClass('active');
        $(this).addClass('active');
    });
});