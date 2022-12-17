<?php

function sc_custom_block_category( $categories, $post ) {
	return array_merge(
		array(
			array(
				'slug' => 'spyguy-blocks',
				'title' => 'spyguy custom blocks',
			),
		),
		$categories
	);
}
add_filter( 'block_categories_all', 'sc_custom_block_category', 10, 2);

function sc_custom_block_category_secondary( $categories, $post ) {
	return array_merge(
		$categories,
		array(
			array(
				'slug' => 'spyguy-blocks-secondary',
				'title' => 'secondary blocks',
				'description' => 'secondary blocks, not used independently'
			),
		)
	);
}
add_filter( 'block_categories_all', 'sc_custom_block_category_secondary', 10, 2);

$blocks_array = array(
	'emptyblock',
	'hero',
	'catlist',
	'steeps',
	'questions',
	'howtostart',
	'heropage',
	'filter',
	'faq',
	'toc',
	'quality',

);

foreach ($blocks_array as $block) {
	include $block.'/block.php';
}

add_action( 'wp_enqueue_scripts', function(){
	wp_enqueue_style(
		'spyguy-blocks-style',
		get_template_directory_uri() .'/blocks/style.css',
		array()
	);
} );

add_action('admin_head', function(){
	wp_enqueue_style(
		'spyguy-blocks-editor-style',
		get_template_directory_uri() .'/blocks/editor.css',
		array( 'wp-edit-blocks' )
	);
});