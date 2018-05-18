$(function(){
	$('#btn-category').click(function(){
		$('#navigation').addClass('toggle');
		$('.overlay').fadeIn(300);
	});

	$('.overlay').click(function(){
		$('#navigation').removeClass('toggle');
		$('.overlay').fadeOut(300);
	});
});