<?php

add_action( 'init',function(){
	wp_register_script(
		'spyguy-script-quality', get_template_directory_uri() .'/blocks/quality/block.js',
		array(
			'wp-blocks',
			'wp-element',
			'wp-editor'    
		)
	);
	register_block_type( 'spyguy/quality', array(
		'editor_script' => 'spyguy-script-quality',
		'render_callback' => 'spyguy_quality_html',
	) );
} );

function spyguy_quality_html( $attributes, $content ) {
	return $content;
}