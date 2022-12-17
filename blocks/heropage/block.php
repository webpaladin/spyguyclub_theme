<?php

add_action( 'init',function(){
	wp_register_script(
		'spyguy-script-heropage', get_template_directory_uri() .'/blocks/heropage/block.js',
		array(
			'wp-blocks',
			'wp-element',
			'wp-editor'    
		)
	);
	register_block_type( 'spyguy/heropage', array(
		'editor_script' => 'spyguy-script-heropage',
		'render_callback' => 'spyguy_heropage_html',
	) );
} );

function spyguy_heropage_html( $attributes, $content ) {
	return html_entity_decode($content);
}