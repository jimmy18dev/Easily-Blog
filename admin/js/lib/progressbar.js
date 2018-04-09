$(function(){
	// Progress Bar function
    $.fn.Progressbar = function(percent) {
        // percent => (0% = Starter, 100% = Done)
        
        if(!percent) return false;

        var bar = $(this)
        bar.fadeIn(300)
        bar.width('0%')

        if(percent === '100%'){
            bar.animate({width:'100%'},300,function(){ bar.fadeOut(300) })
        }else{
            bar.animate({ width:percent },500)
        }
    }
})