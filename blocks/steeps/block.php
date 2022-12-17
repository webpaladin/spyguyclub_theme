<?php

add_action( 'init',function(){
	wp_register_script(
		'spyguy-script-steeps', get_template_directory_uri() .'/blocks/steeps/block.js',
		array(
			'wp-blocks',
			'wp-element',
			'wp-editor'    
		)
	);
	register_block_type( 'spyguy/steeps', array(
		'editor_script' => 'spyguy-script-steeps',
		'render_callback' => 'spyguy_steeps_html',
	) );
} );

function spyguy_steeps_html( $attributes, $content ) {
	return html_entity_decode($content);
}