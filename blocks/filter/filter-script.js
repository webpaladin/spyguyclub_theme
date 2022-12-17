jQuery(function($) {

	$('.filter-sidebar input').on('change','',function(){
		softFilter();
	});
	$(document).ready(function(){
		softFilter();
	});

	function softFilter() {
		let id_arr = [];
		let inputs = $('.filter-container').find('.filter-sidebar').find('input');
		let items = $('.filter-container').find('.content-block').find('.item');
		$(inputs).each(function(){
			if ($(this).is(':checked')) {
				id_arr.push($(this).attr('id'));
			}
		});
		if (id_arr.length > 0) {
			$(items).fadeOut();
			let num = 0;
			$(items).each(function() {
				num++;
				let item = $(this);
				for (var i = 0; i < id_arr.length; i++) {
					if ($(item).hasClass(id_arr[i])) {
						$(item).fadeIn();
					}
				}
			});
		} else {
			$(items).fadeIn();
		}
	}

});