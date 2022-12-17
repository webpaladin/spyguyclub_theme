jQuery(function($) {

	$('.wp-block-spyguy-faqitem').on('click','.wp-block-spyguy-emptyblock.title', function(){
		$(this).toggleClass('open');
		$(this).siblings('.wp-block-spyguy-emptyblock.text').slideToggle();
	});

});