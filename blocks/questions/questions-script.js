jQuery(function($) {

	$('.wp-block-spyguy-questionsitem').on('click','h4',function(){
		$(this).siblings('.questions-bg').css('display','flex');
	});

	$('.questions-bg').on('click',function(){
		$(this).css('display','none');
	});

});