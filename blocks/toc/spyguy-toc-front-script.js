jQuery(function($) {

	$("ul.toc-list").on("click","a", function (event) {
		event.preventDefault();
		var id  = $(this).attr('href'),
		top = $(id).offset().top - 50;
		$('body,html').animate({scrollTop: top}, 1500);
	});

	var scInhalt = $('ul.toc-list');
	if (scInhalt.length > 0) {
		$('main h2, main h3').each(function(){
			var text = $(this).text().replace(/[^a-zA-Z ]/g, "");
			if ($(this).hasClass('toc-title') || !text || text == ' ') { 
				return;
			}
			var text2 = text.toLowerCase().replace(/ /g,"-");
			$(this).attr('id',text2);
			var text = $(this).text();
			scInhalt.append('<li><a href="#'+text2+'">'+text+'</a></li>');
		});
	}

});