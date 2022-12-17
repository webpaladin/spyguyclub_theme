jQuery(function($) {

	$('header .block-menu a').each(function(){
		let link = $(this).attr('href');
		if (link == '#') {
			let text = $(this).text();
			$(this).replaceWith('<span>'+text+'</span>');
		}
	});

	$('.mmenu').click(function(){
		$(this).toggleClass('mmmenuopen');
		$('header .container .block-menu, #bg').slideToggle({
			start: function() {
				$(this).css('display','block')
			}
		});
	});

	$( "header .block-menu li" ).hover(
		function() {
			if(window.innerWidth>750) {
				$(this).children('.sub-menu').css('display', 'block');
			}			},
			function() {
				if(window.innerWidth>750) {
					$(this).children('.sub-menu').css('display', 'none');
				}
			}
			);

	$('header .block-menu li').on('click',function(){
		if(window.innerWidth<751) {
			$(this).children('.sub-menu').slideToggle();
		}	
	});

	if(window.innerWidth<751) {
		$('.wp-block-spyguy-filter .filter-container').prepend('<p class="mobile-filter">Filter</p>');
	}

	$('.wp-block-spyguy-filter').on('click','.mobile-filter',function(){
		$(this).toggleClass('open');
		$(this).siblings('.filter-sidebar').slideToggle();
	});

	$('.wp-block-spyguy-filter .filter-container .filter-sidebar .item').on('click','h3',function(){
		if(window.innerWidth<751) {
			$(this).siblings('ul').slideToggle();
		}
	});

});