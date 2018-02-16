$(document).ready(function(){

    // tippy plugin
    tippy('[title]',{arrow: true});

    // Get article id
    var article_id  = $('#article_id').val();

    // Create Class
    var article = new Article(article_id);

    // Edit Article description.
    var oldDesc
    $('#description').on({
        focus: function(e) {
            oldDesc = $(this).val()
        },
        blur: function(e) {
            var now = $(this).val()
            if(oldDesc == now)
                return false
            else
                article.editDescription(now)
        }
    })

    // Set new cover image
    $('.cover-items').click(function(){
        var cover_id = $(this).attr('data-cover');

        // Send request
        article.setCover(cover_id);
        
        $('.cover-items').removeClass('active');
        $(this).addClass('active');
    });

    $('.btn-remove-tag').click(function(){
        $tag            = $(this).parent()
        var tag_id      = $tag.attr('data-id')
        var tag_name    = $tag.attr('data-name')

        if(!confirm('คุณต้องการลบ "'+tag_name+'" ใช่หรือไม่ ?'))
            return false

        article.removeTag(tag_id)
        $tag.fadeOut(300)
    });

    $('#tagForm').submit(function(event) {
        event.preventDefault();
        var tag = $('#tag-input').val()
        article.addTags(tag)
    });

    $('#articleURL').blur(function() {
        var url = $(this).val()
        article.editURL(url)
    });

    $('.btn-add-cover').click(function(){
        $('#coverImageFiles').focus().click();
    });
    $('#coverImageFiles').change(function(){
        $('#coverForm').submit();
    });
    $('#coverForm').ajaxForm({
        beforeSubmit: function(formData, jqForm, options){
            $('.btn-add-cover').html('<i class="fa fa-spinner fa-spin" aria-hidden="true"></i>');
        },
        uploadProgress: function(event,position,total,percentComplete) {
            var percent = percentComplete;
            percent = (percent * 80) / 100;
            
            console.log('Upload: '+percentComplete+' %');
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
});