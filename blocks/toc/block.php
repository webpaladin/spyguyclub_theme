<?php

add_action( 'init',function(){
	wp_register_script(
		'spyguy-script-toc', get_template_directory_uri() .'/blocks/toc/block.js',
		array(
			'wp-blocks',
			'wp-element',
			'wp-editor'    
		)
	);
	wp_localize_script( 'spyguy-script-toc', 'folder', array(
		'img' => get_template_directory_uri() .'/blocks/img/',
	));
	register_block_type( 'spyguy/toc', array(
		'editor_script' => 'spyguy-script-toc',
		'render_callback' => 'spyguy_toc_html',
	) );

	add_action('wp_enqueue_scripts', function() {
		wp_enqueue_script('spyguy-toc-front-script',
			get_template_directory_uri() .'/blocks/toc/spyguy-toc-front-script.js',
			array('jquery'), '1.0.0', true );
	});
} );

function spyguy_toc_html( $attributes, $content ) {
	return $content;
}