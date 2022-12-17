<?php

add_action( 'init',function(){
	wp_register_script(
		'spyguy-script-catlist', get_template_directory_uri() .'/blocks/catlist/block.js',
		array(
			'wp-blocks',
			'wp-element',
			'wp-editor'    
		)
	);

	$num = 0;
	$array = array();

	$terms = get_terms([
		'taxonomy' => 'software_category',
		'hide_empty' => false,
	]);
	foreach ($terms as $key => $term) {
		$term_slug = $term->slug;
		$term_name = $term->name;
		$image = get_field( "image", $term->taxonomy . '_' . $term->term_id );
		if ($key === array_key_last($terms)) {
			$class = 'item last';
		} else {
			$class = 'item';
		}
		$array[$num] = array(
			'name' => $term_name,
			'slug' => $term_slug,
			'img'  => $image,
			'class' => $class
		);
		$num++;
	}
	$terms = get_terms([
		'taxonomy' => 'software_device',
		'hide_empty' => false,
	]);
	foreach ($terms as $key => $term) {
		$term_slug = $term->slug;
		$term_name = $term->name;
		$image = get_field( "image", $term->taxonomy . '_' . $term->term_id );
		if ($key === array_key_last($terms)) {
			$class = 'item last';
		} else {
			$class = 'item';
		}
		$array[$num] = array(
			'name' => $term_name,
			'slug' => $term_slug,
			'img'  => $image,
			'class' => $class
		);
		$num++;
	}
	$terms = get_terms([
		'taxonomy' => 'software_os',
		'hide_empty' => false,
	]);
	foreach ($terms as $term) {
		$term_slug = $term->slug;
		$term_name = $term->name;
		$image = get_field( "image", $term->taxonomy . '_' . $term->term_id );
		$class = 'item';
		$array[$num] = array(
			'name' => $term_name,
			'slug' => $term_slug,
			'img'  => $image,
			'class' => $class
		);
		$num++;
	}

	$script_array = array( 
		'category_array'     => $array
	);
	wp_localize_script( 'spyguy-script-catlist', 'object', $script_array );

	register_block_type( 'spyguy/catlist', array(
		'editor_script' => 'spyguy-script-catlist',
		'render_callback' => 'spyguy_catlist_html',
	) );
} );

function spyguy_catlist_html( $attributes, $content ) {
	$newContent = '<div class="cat-list">';
	$terms = get_terms([
		'taxonomy' => 'software_category',
		'hide_empty' => false,
	]);
	$newContent .= '<div class="cl-item cl-category">';
	foreach ($terms as $term) {
		$term_slug = $term->slug;
		$term_name = $term->name;
		$image = get_field( "image", $term->taxonomy . '_' . $term->term_id );
		$newContent .= '<a class="item" href="/'.$term_slug.'"><img src="'.$image.'"><p>'.$term_name.'</p></a>';
	}
	$newContent .= '</div>';
	$terms = get_terms([
		'taxonomy' => 'software_device',
		'hide_empty' => false,
	]);
	$newContent .= '<div class="cl-item cl-device">';
	foreach ($terms as $term) {
		$term_slug = $term->slug;
		$term_name = $term->name;
		$image = get_field( "image", $term->taxonomy . '_' . $term->term_id );
		$newContent .= '<a class="item" href="/'.$term_slug.'"><img src="'.$image.'"><p>'.$term_name.'</p></a>';
	}
	$newContent .= '</div>';
	$terms = get_terms([
		'taxonomy' => 'software_os',
		'hide_empty' => false,
	]);
	$newContent .= '<div class="cl-item cl-os">';
	foreach ($terms as $term) {
		$term_slug = $term->slug;
		$term_name = $term->name;
		$image = get_field( "image", $term->taxonomy . '_' . $term->term_id );
		$newContent .= '<a class="item" href="/'.$term_slug.'"><img src="'.$image.'"><p>'.$term_name.'</p></a>';
	}
	$newContent .= '</div>';
	$newContent .= '</div>';

	$content = str_replace('<div class="cat-list"></div>', $newContent, $content);


	return html_entity_decode($content);
}