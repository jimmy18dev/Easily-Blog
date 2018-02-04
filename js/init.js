$(document).ready(function(){
	$overlay 		= $('.overlay');
	$progressbar 	= $('#progressbar');

	$progressbar.fadeIn(300);
	$progressbar.width('0%');
	$progressbar.animate({width:'100%'},500);
	$progressbar.fadeOut();

	$ProfilePanel = $('#profilePanel');
	$('#btnProfile').click(function(event) {
		event.stopPropagation();
        if($ProfilePanel.is(':visible'))
        	$ProfilePanel.fadeOut(300)
        else
        	$ProfilePanel.fadeIn(300);
    });

    $(window).on('click touchstart',function(event) {

    	// Get Current DOM
    	var current_id = event.target.id;
		if(current_id == '' && event.target.offsetParent != null)
			current_id = event.target.offsetParent.id;

		// Profile Panel Hidden!
		if(current_id != 'profilePanel' && $ProfilePanel.is(':visible'))
			$('#profilePanel').fadeOut(300);
    });
});