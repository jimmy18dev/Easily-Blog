var article_api = 'api/article';
var category_id;

$(document).ready(function(){
    // Get article id
    var article_id  = $('#article_id').val();

    // Create Class
    var article = new Article(article_id);

    // Publish Article
    $('#btn-publish').click(function(){
        article.publish();
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

    $chooseCategory = $('.choose-category');
    $chooseCategory.click(function(){
        category_id = $(this).attr('data-id');
        $btnStartWrite.addClass('active');
        $('.choose-category').removeClass('active');
        $(this).addClass('active');
    });

    $btnStartWrite = $('#btnStartWrite');
    $btnStartWrite.click(function(){   

        if(!category_id) return false;

        $btnStartWrite.removeClass('active');
        $btnStartWrite.html('กำลังสร้าง<i class="fal fa-spinner fa-pulse"></i>');

        // Create new Article.
        article.create(category_id)
    });
});