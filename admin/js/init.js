$(document).ready(function(){
	$overlay 		= $('.overlay');
	$progressbar 	= $('#progressbar');

	$ProfilePanel = $('#profilePanel');
	$('#btnProfile').click(function(event) {
		event.stopPropagation();
        if($ProfilePanel.is(':visible'))
        	$ProfilePanel.fadeOut(300)
        else
        	$ProfilePanel.fadeIn(300);
    });

    $optionPanel = $('#optionPanel');
    $('#btnOption').click(function(event) {
        event.stopPropagation();
        if($optionPanel.is(':visible'))
            $optionPanel.fadeOut(300)
        else
            $optionPanel.fadeIn(300);
    });

    $(window).on('click touchstart',function(event) {

    	// Get Current DOM
    	var current_id = event.target.id;
		if(current_id == '' && event.target.offsetParent != null)
			current_id = event.target.offsetParent.id;

		// Profile Panel Hidden!
		if(current_id != 'profilePanel' && $ProfilePanel.is(':visible'))
			$('#profilePanel').fadeOut(300);

		if(current_id != 'optionPanel' && $('#optionPanel').is(':visible'))
			$('#optionPanel').fadeOut(300);
    });
});