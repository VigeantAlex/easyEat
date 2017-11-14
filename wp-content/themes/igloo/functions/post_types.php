<?php
//
// Include all custom post types here (one custom post type per file)
//
add_action('after_setup_theme', 'ci_load_custom_post_type_files');
if( !function_exists('ci_load_custom_post_type_files') ):
function ci_load_custom_post_type_files()
{
	$cpt_files = apply_filters('load_custom_post_type_files', array(
		'functions/post_types/page',
		'functions/post_types/slider',
		'functions/post_types/menu_item',
		'functions/post_types/gallery',
		'functions/post_types/testimonial'
	));
	foreach($cpt_files as $cpt_file) get_template_part($cpt_file);
}
endif;

add_action( 'init', 'ci_tax_create_taxonomies');
if( !function_exists('ci_tax_create_taxonomies') ):
function ci_tax_create_taxonomies() 
{
	//
	// Create all taxonomies here.
	//

	//
	// Menu Category Taxonomy
	//
	$labels = array(
		'name'              => _x( 'Menu Categories', 'taxonomy general name', 'ci_theme' ),
		'singular_name'     => _x( 'Menu Category', 'taxonomy singular name', 'ci_theme' ),
		'search_items'      => __( 'Search Menu Categories', 'ci_theme' ),
		'all_items'         => __( 'All Menu Categories', 'ci_theme' ),
		'parent_item'       => __( 'Parent Menu Category', 'ci_theme' ),
		'parent_item_colon' => __( 'Parent Menu Category:', 'ci_theme' ),
		'edit_item'         => __( 'Edit Menu Category', 'ci_theme' ),
		'update_item'       => __( 'Update Menu Category', 'ci_theme' ),
		'add_new_item'      => __( 'Add New Menu Category', 'ci_theme' ),
		'new_item_name'     => __( 'New Menu Category Name', 'ci_theme' ),
		'menu_name'         => __( 'Categories', 'ci_theme' ),
		'view_item'         => __( 'View Menu Category', 'ci_theme' ),
		'popular_items'     => __( 'Popular Menu Categories', 'ci_theme' ),
	);
	register_taxonomy( 'menu_category', array( 'menu_item' ), array(
		'labels'            => $labels,
		'hierarchical'      => true,
		'show_admin_column' => true,
		'rewrite'           => array( 'slug' => _x( 'menu_category', 'taxonomy slug', 'ci_theme' ) ),
	) );

}
endif;


add_action('admin_enqueue_scripts', 'ci_load_post_scripts');
if( !function_exists('ci_load_post_scripts') ):
function ci_load_post_scripts($hook)
{
	//
	// Add here all scripts and styles, to load on all admin pages.
	//	
	
	if('post.php' == $hook or 'post-new.php' == $hook)
	{
		//
		// Add here all scripts and styles, specific to post edit screens.
		//
		wp_enqueue_media();
		ci_enqueue_media_manager_scripts();
	}
}
endif;

add_filter('request', 'ci_feed_request');
if( !function_exists('ci_feed_request') ):
function ci_feed_request($qv) {
	if (isset($qv['feed']) && !isset($qv['post_type'])){

		$qv['post_type'] = array();
		$qv['post_type'] = get_post_types($args = array(
	  		'public'   => true,
	  		'_builtin' => false
		));
		$qv['post_type'][] = 'post';
	}
	return $qv;
}
endif;
?>