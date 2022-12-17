<?php

add_action( 'init',function(){
	wp_register_script(
		'spyguy-script-filter', get_template_directory_uri() .'/blocks/filter/block.js',
		array(
			'wp-blocks',
			'wp-element',
			'wp-editor'    
		)
	);

	add_action('wp_enqueue_scripts', function() {
		wp_enqueue_script('spyguy-filter-front-script',
			get_template_directory_uri() .'/blocks/filter/filter-script.js',
			array('jquery'), '1.0.0', true );
	});

	$terms = get_terms([
		'taxonomy' => 'software_category',
		'hide_empty' => false,
	]);
	$software_category = array(array('label'=>'Select category','value'=>''));
	foreach( $terms as $term ){
		$num = array();
		$num['label'] = $term->name;
		$num['value'] = $term->slug;
		array_push($software_category, $num);
	}

	$terms = get_terms([
		'taxonomy' => 'software_device',
		'hide_empty' => false,
	]);
	$software_device = array(array('label'=>'Select device','value'=>''));
	foreach( $terms as $term ){
		$num = array();
		$num['label'] = $term->name;
		$num['value'] = $term->slug;
		array_push($software_device, $num);
	}

	$terms = get_terms([
		'taxonomy' => 'software_os',
		'hide_empty' => false,
	]);
	$software_os = array(array('label'=>'Select os','value'=>''));
	foreach( $terms as $term ){
		$num = array();
		$num['label'] = $term->name;
		$num['value'] = $term->slug;
		array_push($software_os, $num);
	}

	$translation_array = array( 
		'software_category' => $software_category,
		'software_device'   => $software_device,
		'software_os'       => $software_os
	);
	wp_localize_script( 'spyguy-script-filter', 'object_menu', $translation_array );



	register_block_type( 'spyguy/filter', array(
		'editor_script' => 'spyguy-script-filter',
		'render_callback' => 'spyguy_filter_html',
		'attributes' => [
			'category' => [
				'type' =>'string',
				'default' => ''
			],
			'device' => [
				'type' =>'string',
				'default' => ''
			],
			'os' => [
				'type' =>'string',
				'default' => ''
			],
		]
	) );
} );

function spyguy_filter_html( $attributes, $content ) {

	$attrcat = $attributes['category'];
	$attrdev = $attributes['device'];
	$attros = $attributes['os'];

	global $wpdb;
	$table_name = $wpdb->prefix . "sc_software";

	$new_block = '';

	$new_block .= '<div class="filter-container">';

	$new_block .= '<div class="filter-sidebar">';

	$new_block .= '<div class="item software_os">';
	$new_block .= '<h3>os</h3>';
	$new_block .= '<ul>';
	$terms = get_terms([
		'taxonomy' => 'software_os',
		'hide_empty' => false,
	]);
	foreach ($terms as $term) {
		$term_slug = $term->slug;
		$term_name = $term->name;
		$checked = ($term_slug == $attros) ? "checked" : "";
		$new_block .= '<li><input type="checkbox" name="'.$term_slug.'" id="'.$term_slug.'" '.$checked.'><label for="'.$term_slug.'">'.$term_name.'</label></li>';
	}
	$new_block .= '</ul>';
	$new_block .= '</div>';

	$new_block .= '<div class="item software_device">';
	$new_block .= '<h3>device</h3>';
	$new_block .= '<ul>';
	$terms = get_terms([
		'taxonomy' => 'software_device',
		'hide_empty' => false,
	]);
	foreach ($terms as $term) {
		$term_slug = $term->slug;
		$term_name = $term->name;
		$checked = ($term_slug == $attrdev) ? "checked" : "";
		$new_block .= '<li><input type="checkbox" name="'.$term_slug.'" id="'.$term_slug.'" '.$checked.'><label for="'.$term_slug.'">'.$term_name.'</label></li>';
	}
	$new_block .= '</ul>';
	$new_block .= '</div>';

	$new_block .= '<div class="item period">';
	$new_block .= '<h3>PERIOD OF SUBSCRIPTION</h3>';
	$new_block .= '<ul>';
	$select_month = $wpdb->get_results("SELECT `month` FROM $table_name", ARRAY_A );
	$months = array_unique($select_month, SORT_REGULAR);
	asort($months);
	foreach ($months as $month) {
		$new_block .= '<li><input type="checkbox" name="month_'.$month['month'].'" id="month_'.$month['month'].'"><label for="month_'.$month['month'].'">'.$month['month'].'</label></li>';
	}
	$new_block .= '</ul>';
	$new_block .= '</div>';

	$new_block .= '<div class="item software_category">';
	$new_block .= '<h3>SOCIAL media</h3>';
	$new_block .= '<ul>';
	$terms = get_terms([
		'taxonomy' => 'software_category',
		'hide_empty' => true,
	]);
	foreach ($terms as $term) {
		$term_slug = $term->slug;
		$term_name = $term->name;
		$checked = ($term_slug == $attrcat) ? "checked" : "";
		$new_block .= '<li><input type="checkbox" name="'.$term_slug.'" id="'.$term_slug.'" '.$checked.'><label for="'.$term_slug.'">'.$term_name.'</label></li>';
	}
	$new_block .= '</ul>';
	$new_block .= '</div>';

	$new_block .= '<div class="item period">';
	$new_block .= '<h3>NUMBER OF DEVICES</h3>';
	$new_block .= '<ul>';
	$select_devices = $wpdb->get_results("SELECT `devices` FROM $table_name", ARRAY_A );
	$devices = array_unique($select_devices, SORT_REGULAR);
	asort($devices);
	foreach ($devices as $device) {
		$new_block .= '<li><input type="checkbox" name="device_'.$device['devices'].'" id="device_'.$device['devices'].'"><label for="device_'.$device['devices'].'">'.$device['devices'].' Month</label></li>';
	}
	$new_block .= '</ul>';
	$new_block .= '</div>';

	$new_block .= '<div class="item jailbreak">';
	$new_block .= '<h3>JAILBREAK</h3>';
	$new_block .= '<ul>';
	$new_block .= '<li><input type="checkbox" name="jailbreak_true" id="jailbreak_true"><label for="jailbreak_true">Yes</label></li>';
	$new_block .= '<li><input type="checkbox" name="jailbreak_false" id="jailbreak_false"><label for="jailbreak_false">No</label></li>';
	$new_block .= '</ul>';
	$new_block .= '</div>';

	$new_block .= '<div class="item root">';
	$new_block .= '<h3>Root</h3>';
	$new_block .= '<ul>';
	$new_block .= '<li><input type="checkbox" name="root_true" id="root_true"><label for="root_true">Yes</label></li>';
	$new_block .= '<li><input type="checkbox" name="root_false" id="root_false"><label for="root_false">No</label></li>';
	$new_block .= '</ul>';
	$new_block .= '</div>';

	$new_block .= '<div class="item brand">';
	$new_block .= '<h3>Brand</h3>';
	$new_block .= '<ul>';

	$select_brands = $wpdb->get_results("SELECT b.post_title,b.post_name
		FROM $table_name a 
		LEFT JOIN $wpdb->posts b 
		ON (a.post_id = b.ID) 
		WHERE b.post_status = 'publish'", ARRAY_A );
	$brands = array_unique($select_brands, SORT_REGULAR);
	foreach ($brands as $brand) {
		$new_block .= '<li><input type="checkbox" name="'.$brand['post_name'].'" id="'.$brand['post_name'].'"><label for="'.$brand['post_name'].'">'.$brand['post_title'].'</label></li>';
	}
	$new_block .= '</ul>';
	$new_block .= '</div>';


		$new_block .= '</div>'; // end sidebar

		$new_block .= '<div class="content-block">';
		$new_block .= '<div class="content">';

		$my_posts = new WP_Query;

		$myposts = $my_posts->query( [
			'post_type' => 'software'
		] );

		foreach ($myposts as $post) {
			$id = $post->ID;
			$softs = get_field('software', $id);
			if (is_array($softs)) {
			foreach ($softs as $soft) {
				$classes = "item";
				if ($soft['device']) {
					foreach ($soft['device'] as $device) {
						$classes .= " ".$device->slug;
					}
				}
				if ($soft['os']) {
					foreach ($soft['os'] as $os) {
						$classes .= " ".$os->slug;
					}
				}
				if ($soft['category']) {
					foreach ($soft['category'] as $category) {
						$classes .= " ".$category->slug;
					}
				}
				if ($soft['period_of_subscription']) {
					$classes .= " month_".$soft['period_of_subscription'];
				}
				if ($soft['number_of_devices']) {
					$classes .= " device_".$soft['number_of_devices'];
				}
				if ($soft['jailbreak'] == 1) {
					$classes .= " jailbreak";
				}
				if ($soft['root'] == 1) {
					$classes .= " root";
				}
				// if ($soft['post_name'] == 1) {
				// 	$classes .= " post_name";
				// }



				$new_block .= '<div class="'.$classes.'" data-postid="'.$id.'">';
				$new_block .= '<a href="'.$soft['link'].'" target="_blank">';
				if ($soft['label']) {
					$new_block .= '<div class="label"><p>'.$soft['label'].'</p></div>';
				}
				$new_block .= '<div class="image">';
				if ($soft['image']) {
					$new_block .= '<img src="'.$soft['image'].'">';
				} else {
					$new_block .= '<img src="/wp-content/themes/spyguy/img/thumb.jpg">';
				}
			$new_block .= '</div>';
			$new_block .= '<h3>'.$soft['name'].'</h3>';
			$new_block .= '<div class="price"><p class="current">'.$soft['symbol'].$soft['prise'].'</p>';
			if ($soft['old_price'] != 0) {
				$new_block .= '<p class="old">'.$soft['symbol'].$soft['old_price'].'</p>';
			}
			$new_block .= '</div>';
			$new_block .= '<button>Read More</button>';
			$new_block .= '</a>';
				$new_block .= '</div>'; // end item
			}
		}
	}

	$new_block .= '</div>'; // end content block
	$new_block .= '</div>'; // end content

	$new_block .= '</div>';

	$content = str_replace('<div class="blockforfilter"></div>', $new_block, $content);
	return html_entity_decode($content);
}