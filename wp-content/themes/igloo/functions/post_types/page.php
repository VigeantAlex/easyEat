<?php
//
// Page listing template meta box
//

add_action('admin_init', 'ci_add_page_gallery_listing_meta');
add_action('save_post', 'ci_update_page_gallery_listing_meta');

if( !function_exists('ci_add_page_gallery_listing_meta') ):
function ci_add_page_gallery_listing_meta(){
	add_meta_box("ci_page_gallery_listing_meta", __('Gallery Listing Options', 'ci_theme'), "ci_add_page_gallery_listing_meta_box", "page", "normal", "high");
	add_meta_box("ci_page_menu_template_meta", __('Base Menu Category', 'ci_theme'), "ci_add_page_menu_template_meta_box", "page", "normal", "high");
}
endif;

if( !function_exists('ci_update_page_gallery_listing_meta') ):
function ci_update_page_gallery_listing_meta($post_id)
{
	if ( !ci_can_save_meta('page') ) return;

	update_post_meta($post_id, "gallery_listing_columns", sanitize_html_class($_POST["gallery_listing_columns"]));
	update_post_meta($post_id, "base_menu_category", intval($_POST["base_menu_category"]));
}
endif;

if( !function_exists('ci_add_page_gallery_listing_meta_box') ):
function ci_add_page_gallery_listing_meta_box($post)
{
	ci_prepare_metabox('page');

	$options = array(
		'six' => __('Two', 'ci_theme'),
		'four' => __('Three', 'ci_theme'),
		'three' => __('Four', 'ci_theme'),
	);
	ci_metabox_dropdown('gallery_listing_columns', $options, __('Gallery listing columns:', 'ci_theme'));

	ci_bind_metabox_to_page_template('ci_page_gallery_listing_meta', 'template-galleries.php', 'page_galleries_metabox');
}
endif;

if( !function_exists('ci_add_page_menu_template_meta_box') ):
function ci_add_page_menu_template_meta_box($post)
{
	ci_prepare_metabox('page');

	$category = get_post_meta($post->ID, 'base_menu_category', true);
	?>
	<p><?php _e('Select the base menu category. Only items and sub-categories of the selected category will be displayed. If you don\'t select one (i.e. empty) all menu categories will be shown.', 'ci_theme'); ?></p>
	<label for="base_menu_category"><?php _e('Select a base category', 'ci_theme'); ?></label>
	<?php wp_dropdown_categories(array(
		'selected'=>$category,
		'id' => 'base_menu_category',
		'name' => 'base_menu_category',
		'show_option_none' => ' ',
		'taxonomy' => 'menu_category',
		'hierarchical' => 1,
		'show_count' => 1,
		'hide_empty' => 0
	)); ?>
	<?php

	ci_bind_metabox_to_page_template('ci_page_menu_template_meta', 'template-menu.php', 'page_menu_metabox');
}
endif;

?>