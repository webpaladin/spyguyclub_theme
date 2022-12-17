<?php

add_action( 'init',function(){
	wp_register_script(
		'spyguy-script-faq', get_template_directory_uri() .'/blocks/faq/block.js',
		array(
			'wp-blocks',
			'wp-element',
			'wp-editor'    
		)
	);
	wp_localize_script( 'spyguy-script-faq', 'folder', array(
		'img' => get_template_directory_uri() .'/blocks/img/',
	));
	register_block_type( 'spyguy/faq', array(
		'editor_script' => 'spyguy-script-faq',
		'render_callback' => 'spyguy_faq_html',
	) );

	add_action('wp_enqueue_scripts', function() {
		wp_enqueue_script('spyguy-faq-front-script',
			get_template_directory_uri() .'/blocks/faq/spyguy-faq-front-script.js',
			array('jquery'), '1.0.0', true );
	});
} );

function spyguy_faq_html( $attributes, $content ) {
	preg_match_all('#<div class="wp-block-spyguy-emptyblock title">(.+?)</div>#is', $content, $arr);
	preg_match_all('#<div class="wp-block-spyguy-emptyblock text">(.+?)</div>#is', $content, $arr2);

	$faq = '<script type="application/ld+json">
	{
		"@context": "https://schema.org",
		"@type": "FAQPage",
		"mainEntity": [';
		for ($i=0; $i < count($arr[1]); $i++) { 
			$faq .= '{
				"@type": "Question",
				"name": "'.strip_tags(trim($arr[1][$i])).'",
				"acceptedAnswer": {
					"@type": "Answer",
					"text": "'.strip_tags(trim($arr2[1][$i])).'"
				}
			},';

		}
		$faq = substr($faq, 0, -1);
		$faq .= ']
	}
	</script>';

	$newcontent = $faq;
	$newcontent .= $content;

	return html_entity_decode($newcontent);
}