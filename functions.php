<?php 

add_theme_support('post-thumbnails'); 
set_post_thumbnail_size(301, 301, TRUE);

add_action('wp_enqueue_scripts', 'my_scripts_method');
function my_scripts_method() {
	wp_enqueue_style( 'style-googlefonts', 'https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap', array(), null );
	wp_enqueue_style("style-theme",get_bloginfo('stylesheet_directory')."/css/style.css");
	wp_enqueue_script('spyguy-script-theme', get_template_directory_uri() . '/js/main.js', array('jquery'), '1.0.0', true );
}

function my_stylesheet1(){
    wp_enqueue_style("style-admin",get_bloginfo('stylesheet_directory')."/css/style-admin.css");
    wp_enqueue_script('script-admin', get_template_directory_uri() . '/js/script-admin.js', array('jquery'), '1.0.0', true );
}
add_action('admin_head', 'my_stylesheet1');

if (function_exists('add_theme_support')) {add_theme_support('menu');}
register_nav_menus( array(
  'topmenu' => 'Top menu',
  'brandmenu' => 'Brand menu',
  'platformsmenu' => 'Platform menu',
  'operationalsystemsmenu' => 'Operational systems menu',
  'devicemenu' => 'Device menu',
) );


add_filter( 'upload_mimes', 'svg_upload_allow' );
function svg_upload_allow( $mimes ) {
    $mimes['svg']  = 'image/svg+xml';
    return $mimes;
}
add_filter( 'wp_check_filetype_and_ext', 'fix_svg_mime_type', 10, 5 );
function fix_svg_mime_type( $data, $file, $filename, $mimes, $real_mime = '' ){
    if( version_compare( $GLOBALS['wp_version'], '5.1.0', '>=' ) )
        $dosvg = in_array( $real_mime, [ 'image/svg', 'image/svg+xml' ] );
    else
        $dosvg = ( '.svg' === strtolower( substr($filename, -4) ) );
    if( $dosvg ){
        if( current_user_can('manage_options') ){
            $data['ext']  = 'svg';
            $data['type'] = 'image/svg+xml';
        }
        else {
            $data['ext'] = $type_and_ext['type'] = false;
        }
    }
    return $data;
}
add_filter( 'wp_prepare_attachment_for_js', 'show_svg_in_media_library' );
function show_svg_in_media_library( $response ) {
    if ( $response['mime'] === 'image/svg+xml' ) {
        $response['image'] = [
            'src' => $response['url'],
        ];
    }
    return $response;
}


add_action( 'init', 'create_post_soft' );
function create_post_soft() {
  register_post_type( 'software',
    array(
      'labels' => array(
        'name' => 'Brands',
        'singular_name' => 'Brands',
        'add_new' => 'Add brand',
        'add_new_item' => 'Add new brand',
        'edit' => 'Edit',
        'edit_item' => 'Edit brand',
        'new_item' => 'New brand',
        'view' => 'View',
        'view_item' => 'View brand',
        'search_items' => 'Search brand',
        'not_found' => 'Brands not found',
        'not_found_in_trash' => 'Not brand in the cart',
        'parent' => 'Parent brand',
        'menu_name' => 'Brands'
    ),
      'public' => true,
      'menu_position' => 5,
      'show_in_rest' => true,
      'supports' => array( 'title', 'editor', 'comments', 'thumbnail', 'custom-fields', ),
      'taxonomies' => array(''),
      'menu_icon' => 'dashicons-media-spreadsheet',
      'has_archive' => false,
      'rewrite' => array('slug' => 'software'),
  )
);
}

add_action('init', 'software_category');
function software_category(){
    $labels = array(
        'name'              => 'Category',
        'singular_name'     => 'Category',
        'search_items'      => 'Search category',
        'all_items'         => 'All category',
        'parent_item'       => null,
        'parent_item_colon' => null,
        'edit_item'         => 'Edit category',
        'update_item'       => 'Update category',
        'add_new_item'      => 'Add new category',
        'new_item_name'     => 'New name for category',
        'menu_name'         => 'Category',
    ); 
    $args = array(
        'label'                 => '',
        'labels'                => $labels,
        'public'                => true,
        'publicly_queryable'    => null,
        'show_in_nav_menus'     => true,
        'show_ui'               => true,
        'show_tagcloud'         => true,
        'hierarchical'          => true,
        'update_count_callback' => '',
        'rewrite'               => true,
        'capabilities'          => array(),
        'meta_box_cb'           => null,
        'show_admin_column'     => true,
        '_builtin'              => false,
        'show_in_quick_edit'    => null,
        'show_in_rest'          => false,
    );
    register_taxonomy('software_category', array('software'), $args );
}


add_action('init', 'software_device');
function software_device(){
    $labels = array(
        'name'              => 'Device',
        'singular_name'     => 'Device',
        'search_items'      => 'Search device',
        'all_items'         => 'All device',
        'parent_item'       => null,
        'parent_item_colon' => null,
        'edit_item'         => 'Edit device',
        'update_item'       => 'Update device',
        'add_new_item'      => 'Add new device',
        'new_item_name'     => 'New name for device',
        'menu_name'         => 'Device',
    ); 
    $args = array(
        'label'                 => '',
        'labels'                => $labels,
        'public'                => true,
        'publicly_queryable'    => null,
        'show_in_nav_menus'     => true,
        'show_ui'               => true,
        'show_tagcloud'         => true,
        'hierarchical'          => true,
        'update_count_callback' => '',
        'rewrite'               => true,
        'capabilities'          => array(),
        'meta_box_cb'           => null,
        'show_admin_column'     => false,
        '_builtin'              => false,
        'show_in_quick_edit'    => null,
        'show_in_rest'          => false,
    );
    register_taxonomy('software_device', array('software'), $args );
}

add_action('init', 'software_os');
function software_os(){
    $labels = array(
        'name'              => 'Os',
        'singular_name'     => 'Os',
        'search_items'      => 'Search os',
        'all_items'         => 'All os',
        'parent_item'       => null,
        'parent_item_colon' => null,
        'edit_item'         => 'Edit os',
        'update_item'       => 'Update os',
        'add_new_item'      => 'Add new os',
        'new_item_name'     => 'New name for os',
        'menu_name'         => 'Os',
    ); 
    $args = array(
        'label'                 => '',
        'labels'                => $labels,
        'public'                => true,
        'publicly_queryable'    => null,
        'show_in_nav_menus'     => true,
        'show_ui'               => true,
        'show_tagcloud'         => true,
        'hierarchical'          => true,
        'update_count_callback' => '',
        'rewrite'               => true,
        'capabilities'          => array(),
        'meta_box_cb'           => null,
        'show_admin_column'     => false,
        '_builtin'              => false,
        'show_in_quick_edit'    => null,
        'show_in_rest'          => false,
    );
    register_taxonomy('software_os', array('software'), $args );
}


function custom_column_header( $columns ){
  $columns['header_name'] = 'Image'; 
  return $columns;
}
add_filter( "manage_edit-software_category_columns", 'custom_column_header', 10);
add_filter( "manage_edit-software_device_columns", 'custom_column_header', 10);
add_filter( "manage_edit-software_os_columns", 'custom_column_header', 10);
function custom_column_content( $value, $column_name, $tax_id ){
    $term = get_term( $tax_id );
    $value = get_field( "image", $term->taxonomy . '_' . $term->term_id );
    return '<img src="'.$value.'" width="48">';
}
add_action( "manage_software_category_custom_column", 'custom_column_content', 10, 3);
add_action( "manage_software_device_custom_column", 'custom_column_content', 10, 3);
add_action( "manage_software_os_custom_column", 'custom_column_content', 10, 3);



add_action('template_redirect', 'rudr_old_term_redirect3');
function rudr_old_term_redirect3() {
    $taxonomy_name = 'software';
    $taxonomy_slug = 'software';
    $pt = get_post_type();
    if( strpos( $_SERVER['REQUEST_URI'], $taxonomy_slug ) === FALSE)
        return;
    if( ( is_single() && $pt == $taxonomy_name )) :
        wp_redirect( site_url( str_replace($taxonomy_slug, '', $_SERVER['REQUEST_URI']) ), 301 );
        exit();
    endif;
}

include 'blocks/blocks.php';

add_action('create_software_category', 'create_tax_page', 10, 2);
add_action('create_software_device', 'create_tax_page', 10, 2);
add_action('create_software_os', 'create_tax_page', 10, 2);
function create_tax_page($term_id, $taxonomy_term_id) {
    $term = get_term( $term_id );
    $term_name = $term->name;
    $term_slug = $term->slug;
    $img = get_field( "image", $term->taxonomy . '_' . $term->term_id );
    $cat = '';
    if ($term->taxonomy == 'software_category') {
        $cat = 'category';
    } else if ($term->taxonomy == 'software_device') {
        $cat = 'device';
    } else if ($term->taxonomy == 'software_os') {
        $cat = 'os';
    }
    $content = '
    <!-- wp:spyguy/heropage {"title":"'.$term_name.'","mediaID":11,"mediaURL":"'.$img.'","mediaTitle":"'.$term_name.'"} -->
    <div class="wp-block-spyguy-heropage"><div class="container"><div class="text"><div class="header"><div class="image"><img src="'.$img.'" alt="" title="'.$term_name.'"/></div><h1>'.$term_name.'</h1></div></div></div></div>
    <!-- /wp:spyguy/heropage -->

    <!-- wp:spyguy/filter {"'.$cat.'":"'.$term_slug.'"} -->
    <div class="wp-block-spyguy-filter"><div class="blockforfilter"></div></div>
    <!-- /wp:spyguy/filter -->';
    $page_id = wp_insert_post(
        array(
            'comment_status' => 'close',
            'ping_status'    => 'close',
            'post_author'    => 1,
            'post_title'     => $term_name,
            'post_name'      => $term_slug,
            'post_status'    => 'publish',
            'post_content'   => $content,
            'post_type'      => 'page',
            'post_parent'    => ''
        )
    );
    add_term_meta( $term_id, 'term_page', $page_id, false );
    update_post_meta( $page_id, 'page_term', $term_id );
}

add_action('pre_delete_term', 'delete_tax_page', 10, 2);
function delete_tax_page($term, $taxonomy ) {
    if ($taxonomy == 'software_category'  || $taxonomy == 'software_device' || $taxonomy == 'software_os') {
        $page_id = get_term_meta( $term, 'term_page', true );
        if (!empty($page_id)) {
            wp_delete_post( $page_id, true );
        }
    }
}

add_action('edited_software_category', 'update_term_page', 10, 2);
add_action('edited_software_device', 'update_term_page', 10, 2);
add_action('edited_software_os', 'update_term_page', 10, 2);
function update_term_page($term_id, $tt_id ) {
    $page_id = get_term_meta( $term_id, 'term_page', true );
    if (!empty($page_id)) {
        $term_slug = get_term( $term_id )->slug;
        wp_update_post(
            array(
                'ID' => $page_id,
                'post_name' => $term_slug
            )
        );
    }
}

function na_remove_slug( $post_link, $post, $leavename ) {
    if ( 'software' != $post->post_type || 'publish' != $post->post_status ) {
        return $post_link;
    }
    $post_link = str_replace( '/' . $post->post_type . '/', '/', $post_link );
    return $post_link;
}
add_filter( 'post_type_link', 'na_remove_slug', 10, 3 );

function na_parse_request( $query ) {
    if ( ! $query->is_main_query() || 2 != count( $query->query ) || ! isset( $query->query['page'] ) ) {
        return;
    }
    if ( ! empty( $query->query['name'] ) ) {
        $query->set( 'post_type', array( 'post', 'software', 'page' ) );
    }
}
add_action( 'pre_get_posts', 'na_parse_request' );



function sc_load_wp_media_files() {
    wp_enqueue_media();
}
add_action( 'admin_enqueue_scripts', 'sc_load_wp_media_files' );



function edit_admin_menus() {
    global $menu;
    $menu[5][0] = 'Blog';
}
add_action( 'admin_menu', 'edit_admin_menus' );

if( function_exists('acf_add_local_field_group') ):

    acf_add_local_field_group(array(
        'key' => 'group_62d2a1908bc77',
        'title' => 'Categories image',
        'fields' => array(
            array(
                'key' => 'field_62d2a1f5ce34d',
                'label' => 'Image',
                'name' => 'image',
                'type' => 'image',
                'instructions' => '',
                'required' => 1,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'return_format' => 'url',
                'preview_size' => 'thumbnail',
                'library' => 'all',
                'min_width' => '',
                'min_height' => '',
                'min_size' => '',
                'max_width' => '',
                'max_height' => '',
                'max_size' => '',
                'mime_types' => '',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'taxonomy',
                    'operator' => '==',
                    'value' => 'software_category',
                ),
            ),
            array(
                array(
                    'param' => 'taxonomy',
                    'operator' => '==',
                    'value' => 'software_device',
                ),
            ),
            array(
                array(
                    'param' => 'taxonomy',
                    'operator' => '==',
                    'value' => 'software_os',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => true,
        'description' => '',
        'show_in_rest' => 0,
    ));

    acf_add_local_field_group(array(
        'key' => 'group_6356f1b5ba405',
        'title' => 'Software',
        'fields' => array(
            array(
                'key' => 'field_6356f1d79af02',
                'label' => 'software',
                'name' => 'software',
                'type' => 'repeater',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'collapsed' => '',
                'min' => 0,
                'max' => 0,
                'layout' => 'table',
                'button_label' => '',
                'sub_fields' => array(
                    array(
                        'key' => 'field_6356f1ef9af03',
                        'label' => 'Image',
                        'name' => 'image',
                        'type' => 'image',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'return_format' => 'url',
                        'preview_size' => 'medium',
                        'library' => 'all',
                        'min_width' => '',
                        'min_height' => '',
                        'min_size' => '',
                        'max_width' => '',
                        'max_height' => '',
                        'max_size' => '',
                        'mime_types' => '',
                    ),
                    array(
                        'key' => 'field_6356f20f9af04',
                        'label' => 'Name',
                        'name' => 'name',
                        'type' => 'text',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'maxlength' => '',
                    ),
                    array(
                        'key' => 'field_6356f21a9af05',
                        'label' => 'Symbol',
                        'name' => 'symbol',
                        'type' => 'text',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => '$',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'maxlength' => '',
                    ),
                    array(
                        'key' => 'field_6356f2379af06',
                        'label' => 'Price',
                        'name' => 'prise',
                        'type' => 'number',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => '0.00',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'min' => '0.00',
                        'max' => '',
                        'step' => '0.01',
                    ),
                    array(
                        'key' => 'field_6356f2729af07',
                        'label' => 'Old price',
                        'name' => 'old_price',
                        'type' => 'number',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => '0.00',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'min' => '0.00',
                        'max' => '',
                        'step' => '0.01',
                    ),
                    array(
                        'key' => 'field_6356f29f9af08',
                        'label' => 'Link',
                        'name' => 'link',
                        'type' => 'text',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'maxlength' => '',
                    ),
                    array(
                        'key' => 'field_6356f2aa9af09',
                        'label' => 'Device',
                        'name' => 'device',
                        'type' => 'taxonomy',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'taxonomy' => 'software_device',
                        'field_type' => 'multi_select',
                        'allow_null' => 0,
                        'add_term' => 1,
                        'save_terms' => 0,
                        'load_terms' => 0,
                        'return_format' => 'object',
                        'multiple' => 0,
                    ),
                    array(
                        'key' => 'field_6356f2de9af0a',
                        'label' => 'Os',
                        'name' => 'os',
                        'type' => 'taxonomy',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'taxonomy' => 'software_os',
                        'field_type' => 'multi_select',
                        'allow_null' => 0,
                        'add_term' => 1,
                        'save_terms' => 0,
                        'load_terms' => 0,
                        'return_format' => 'object',
                        'multiple' => 0,
                    ),
                    array(
                        'key' => 'field_6356ff2373688',
                        'label' => 'Category',
                        'name' => 'category',
                        'type' => 'taxonomy',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'taxonomy' => 'software_category',
                        'field_type' => 'multi_select',
                        'allow_null' => 0,
                        'add_term' => 1,
                        'save_terms' => 0,
                        'load_terms' => 0,
                        'return_format' => 'object',
                        'multiple' => 0,
                    ),
                    array(
                        'key' => 'field_6356f2fd9af0b',
                        'label' => 'period of subscription',
                        'name' => 'period_of_subscription',
                        'type' => 'number',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => 1,
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'min' => '',
                        'max' => '',
                        'step' => '',
                    ),
                    array(
                        'key' => 'field_6356f3129af0c',
                        'label' => 'number of devices',
                        'name' => 'number_of_devices',
                        'type' => 'number',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => 1,
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'min' => '',
                        'max' => '',
                        'step' => '',
                    ),
                    array(
                        'key' => 'field_6356f31e9af0d',
                        'label' => 'jailbreak',
                        'name' => 'jailbreak',
                        'type' => 'true_false',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'message' => '',
                        'default_value' => 0,
                        'ui' => 0,
                        'ui_on_text' => '',
                        'ui_off_text' => '',
                    ),
                    array(
                        'key' => 'field_6356f33b9af0e',
                        'label' => 'root',
                        'name' => 'root',
                        'type' => 'true_false',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'message' => '',
                        'default_value' => 0,
                        'ui' => 0,
                        'ui_on_text' => '',
                        'ui_off_text' => '',
                    ),
                    array(
                        'key' => 'field_6356f37a9af0f',
                        'label' => 'label',
                        'name' => 'label',
                        'type' => 'text',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'maxlength' => '',
                    ),
                ),
),
),
'location' => array(
    array(
        array(
            'param' => 'post_type',
            'operator' => '==',
            'value' => 'software',
        ),
    ),
),
'menu_order' => 0,
'position' => 'normal',
'style' => 'default',
'label_placement' => 'top',
'instruction_placement' => 'label',
'hide_on_screen' => '',
'active' => true,
'description' => '',
'show_in_rest' => 0,
));

acf_add_local_field_group(array(
    'key' => 'group_63074e437a48f',
    'title' => 'User image',
    'fields' => array(
        array(
            'key' => 'field_63074e6d16f25',
            'label' => 'User avatar',
            'name' => 'user_avatar',
            'type' => 'image',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'return_format' => 'url',
            'preview_size' => 'thumbnail',
            'library' => 'all',
            'min_width' => '',
            'min_height' => '',
            'min_size' => '',
            'max_width' => '',
            'max_height' => '',
            'max_size' => '',
            'mime_types' => '',
        ),
    ),
    'location' => array(
        array(
            array(
                'param' => 'user_form',
                'operator' => '==',
                'value' => 'all',
            ),
        ),
    ),
    'menu_order' => 0,
    'position' => 'normal',
    'style' => 'default',
    'label_placement' => 'top',
    'instruction_placement' => 'label',
    'hide_on_screen' => '',
    'active' => true,
    'description' => '',
    'show_in_rest' => 0,
));

endif;      


//This code removes noreferrer from your new or updated posts
function im_targeted_link_rel($rel_values) {
    return 'noopener';
}
add_filter('wp_targeted_link_rel', 'im_targeted_link_rel',999);

//remove noreferrer on the frontend, but will still show in the editor
function im_formatter($content) {
    $replace = array(" noreferrer" => "" ,"noreferrer " => "");
    $new_content = strtr($content, $replace);
    return $new_content;
}
add_filter('the_content', 'im_formatter', 999);