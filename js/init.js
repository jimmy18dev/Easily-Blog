$(document).ready(function(){
	$overlay 		= $('.overlay');
	$progressbar 	= $('#progressbar');

	$progressbar.fadeIn(300);
	$progressbar.width('0%');
	$progressbar.animate({width:'100%'},500);
	$progressbar.fadeOut();
});