<?php

add_action( 'init',function(){
	wp_register_script(
		'spyguy-script-howtostart', get_template_directory_uri() .'/blocks/howtostart/block.js',
		array(
			'wp-blocks',
			'wp-element',
			'wp-editor'    
		)
	);
	register_block_type( 'spyguy/howtostart', array(
		'editor_script' => 'spyguy-script-howtostart',
		'render_callback' => 'spyguy_howtostart_html',
	) );
	
} );

function spyguy_howtostart_html( $attributes, $content ) {
	return html_entity_decode($content);
}