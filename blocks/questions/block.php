<?php

add_action( 'init',function(){
	wp_register_script(
		'spyguy-script-questions', get_template_directory_uri() .'/blocks/questions/block.js',
		array(
			'wp-blocks',
			'wp-element',
			'wp-editor'    
		)
	);
	register_block_type( 'spyguy/questions', array(
		'editor_script' => 'spyguy-script-questions',
		'render_callback' => 'spyguy_questions_html',
	) );

	add_action('wp_enqueue_scripts', function() {
		wp_enqueue_script('spyguy-questions-front-script',
		get_template_directory_uri() .'/blocks/questions/questions-script.js',
			array('jquery'), '1.0.0', true );
	});
	
} );

function spyguy_questions_html( $attributes, $content ) {
	return html_entity_decode($content);
}