<?php

add_action( 'init',function(){
	wp_register_script(
		'spyguy-script-emptyblock', get_template_directory_uri() .'/blocks/emptyblock/block.js',
		array(
			'wp-blocks',
			'wp-element',
			'wp-editor'    
		)
	);
	register_block_type( 'spyguy/emptyblock', array(
		'editor_script' => 'spyguy-script-emptyblock',
		'render_callback' => 'spyguy_emptyblock_html',
	) );
} );

function spyguy_emptyblock_html( $attributes, $content ) {
	return html_entity_decode($content);
}