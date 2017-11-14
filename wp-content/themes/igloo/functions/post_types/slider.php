<?php
//
// Slider Post Type related functions.
//
add_action( 'init', 'ci_create_cpt_slider' );
add_action( 'admin_init', 'ci_add_cpt_slider_meta' );
add_action( 'save_post', 'ci_update_cpt_slider_meta' );

if( !function_exists('ci_create_cpt_slider') ):
function ci_create_cpt_slider()
{
	$labels = array(
		'name'               => _x( 'Slider Items', 'post type general name', 'ci_theme' ),
		'singular_name'      => _x( 'Slider Item', 'post type singular name', 'ci_theme' ),
		'add_new'            => __( 'New Slider Item', 'ci_theme' ),
		'add_new_item'       => __( 'Add New Slider Item', 'ci_theme' ),
		'edit_item'          => __( 'Edit Slider Item', 'ci_theme' ),
		'new_item'           => __( 'New Slider Item', 'ci_theme' ),
		'view_item'          => __( 'View Slider Item', 'ci_theme' ),
		'search_items'       => __( 'Search Slider Items', 'ci_theme' ),
		'not_found'          => __( 'No Slider Items found', 'ci_theme' ),
		'not_found_in_trash' => __( 'No Slider Items found in the trash', 'ci_theme' ),
		'parent_item_colon'  => __( 'Parent Slider Item:', 'ci_theme' )
	);

	$args = array(
		'labels'          => $labels,
		'singular_label'  => __( 'Slider Item', 'ci_theme' ),
		'public'          => true,
		'show_ui'         => true,
		'capability_type' => 'post',
		'hierarchical'    => false,
		'has_archive'     => false,
		'rewrite'         => array( 'slug' => _x( 'slider', 'post type slug', 'ci_theme' ) ),
		'menu_position'   => 5,
		'supports'        => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments' )
	);

	register_post_type( 'slider' , $args );
}
endif;

if( !function_exists('ci_add_cpt_slider_meta') ):
function ci_add_cpt_slider_meta()
{
	add_meta_box( "ci_cpt_slider_meta", __( 'Slider Details', 'ci_theme' ), "ci_add_cpt_slider_meta_box", "slider", "normal", "high" );
}
endif;

if( !function_exists('ci_update_cpt_slider_meta') ):
function ci_update_cpt_slider_meta( $post_id )
{
	if ( !ci_can_save_meta('slider') ) return;

	update_post_meta( $post_id, "ci_cpt_slider_url", esc_url_raw($_POST["ci_cpt_slider_url"]) );
	update_post_meta( $post_id, "ci_cpt_slider_btn_text", sanitize_text_field($_POST["ci_cpt_slider_btn_text"]) );
}
endif;

if( !function_exists('ci_add_cpt_slider_meta_box') ):
function ci_add_cpt_slider_meta_box()
{
	ci_prepare_metabox('slider');

	?><p><?php _e( "Assign a Featured Image for this slider item, so that it appears on the home page slider. Also, set a URL below to redirect the user, when the slider button gets clicked. Leaving the URL blank, will redirect to the slider's own content.", 'ci_theme' ); ?></p><?php
	ci_metabox_input('ci_cpt_slider_url', __( 'Slider Item URL', 'ci_theme'), array('input_class' => 'code widefat', 'esc_func' => 'esc_url'));
	ci_metabox_input('ci_cpt_slider_btn_text', __( 'Slider Button Text', 'ci_theme'));
	
}
endif;

?>