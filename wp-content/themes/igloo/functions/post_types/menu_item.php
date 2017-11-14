<?php
//
// Menu Item Post Type related functions.
//
add_action('init', 'ci_create_cpt_menu_item');
add_action('admin_init', 'ci_add_cpt_menu_item_meta');
add_action('save_post', 'ci_update_cpt_menu_item_meta');

if( !function_exists('ci_create_cpt_menu_item') ):
function ci_create_cpt_menu_item() {
	$labels = array(
		'name'               => _x( 'Menu Items', 'post type general name', 'ci_theme' ),
		'singular_name'      => _x( 'Menu Item', 'post type singular name', 'ci_theme' ),
		'add_new'            => __( 'New Menu Item', 'ci_theme' ),
		'add_new_item'       => __( 'Add New Menu Item', 'ci_theme' ),
		'edit_item'          => __( 'Edit Menu Item', 'ci_theme' ),
		'new_item'           => __( 'New Menu Item', 'ci_theme' ),
		'view_item'          => __( 'View Menu Item', 'ci_theme' ),
		'search_items'       => __( 'Search Menu Items', 'ci_theme' ),
		'not_found'          => __( 'No Menu Items found', 'ci_theme' ),
		'not_found_in_trash' => __( 'No Menu Items found in the trash', 'ci_theme' ),
		'parent_item_colon'  => __( 'Parent Menu Item:', 'ci_theme' )
	);

	$args = array(
		'labels'          => $labels,
		'singular_label'  => __( 'Menu Item', 'ci_theme' ),
		'public'          => true,
		'show_ui'         => true,
		'capability_type' => 'post',
		'hierarchical'    => false,
		'has_archive'     => false,
		'rewrite'         => array( 'slug' => _x( 'menu_item', 'post type slug', 'ci_theme' ) ),
		'menu_position'   => 5,
		'supports'        => array( 'title', 'editor', 'thumbnail' )
	);

	register_post_type( 'menu_item' , $args );
}
endif;

if( !function_exists('ci_add_cpt_menu_item_meta') ):
function ci_add_cpt_menu_item_meta(){
	add_meta_box("ci_cpt_menu_item_meta",__('Menu Item Price', 'ci_theme'), "ci_add_cpt_menu_item_meta_box", "menu_item", "normal", "high");
}
endif;

if( !function_exists('ci_update_cpt_menu_item_meta') ):
function ci_update_cpt_menu_item_meta($post_id)
{
	if ( !ci_can_save_meta('menu_item') ) return;

	update_post_meta($post_id, "ci_cpt_menu_item_price", (isset($_POST["ci_cpt_menu_item_price"]) ? $_POST["ci_cpt_menu_item_price"] : '') );
}
endif;

if( !function_exists('ci_add_cpt_menu_item_meta_box') ):
function ci_add_cpt_menu_item_meta_box()
{
	ci_prepare_metabox('menu_item');

	$label = __('The price of the menu item. If empty, it will not be displayed at all. (Usefull when something is temporarily out of stock)', 'ci_theme');
	ci_metabox_input('ci_cpt_menu_item_price', $label);

}
endif;

//
// Menu Item post type custom admin list
//
add_filter("manage_edit-menu_item_columns", "menu_item_edit_columns");  
add_action("manage_posts_custom_column",  "menu_item_custom_columns");  

if( !function_exists('menu_item_edit_columns') ):
function menu_item_edit_columns($columns){  

	$new_columns = array(  
		"cb" => $columns['cb'],
		"title" => __('Item Name', 'ci_theme'),
		"taxonomy-menu_category" => __('Menu Category', 'ci_theme'),
		"price" => __("Price", 'ci_theme')
	);  

	return $new_columns;  
}  
endif;
  
if( !function_exists('menu_item_custom_columns') ):
function menu_item_custom_columns($column){  
	global $post, $wp_version;  
	
	if('menu_item' != get_post_type($post))
		return;
	
	switch ($column)  
	{  
		case "price":  
			$price = get_post_meta($post->ID, 'ci_cpt_menu_item_price', true);
			if (!empty($price))
				echo format_price($price);
		break;  
	}
}
endif;

?>