$(function(){
	$('#btn-category').click(function(){
		$('#navigation').addClass('active');
		$('.overlay').fadeIn(300);
	});

	$('.overlay').click(function(){
		$('#navigation').removeClass('active');
		$('.overlay').fadeOut(300);
	});
});