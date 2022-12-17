<?php

add_action( 'init',function(){
	wp_register_script(
		'spyguy-script-hero', get_template_directory_uri() .'/blocks/hero/block.js',
		array(
			'wp-blocks',
			'wp-element',
			'wp-editor'    
		)
	);
	register_block_type( 'spyguy/hero', array(
		'editor_script' => 'spyguy-script-hero',
		'render_callback' => 'spyguy_hero_html',
	) );
} );

function spyguy_hero_html( $attributes, $content ) {
	return html_entity_decode($content);
}