<?php
/**
 * Theme Specific Shortcodes.
 *
 * @version		1.0.0
 * @package		functions/
 * @category	Shortcodes
 * @author 		CSSIgniter
 */

/**
 * Used to output a shortcode without executing it.
 *
 * @access public
 * @param array $atts
 * @return string
 */

if ( !function_exists('ci_shortcode') ) {
function ci_shortcode($atts, $content = null ) {
	return '<code>' . $content .  '</code>';
}
} // function_exists('ci_shortcode')
add_shortcode('ci_shortcode', 'ci_shortcode');


/**
 * Outputs <div class="row"></div> container
 *
 * @access public
 * @param array $atts
 * @return string
 */

if ( !function_exists('ci_row') ):
function ci_row($atts, $content = null ) {
	return '<div class="row">' . do_shortcode($content) . '</div>';
}
endif;
add_shortcode('ci_row', 'ci_row');
add_shortcode('ci_row2', 'ci_row');
add_shortcode('ci_row3', 'ci_row');


/**
 * Outputs columns markup
 *
 * @access public
 * @param array $atts
 * @return string
 */

if ( !function_exists('ci_column') ):
function ci_column($atts, $content = null ) {
	extract(shortcode_atts(
		array(
			'span' => '',
			'mobile_span' => ''
		), $atts ));

	return '<div class="'. $span . ' ' . $mobile_span . ' columns">' . do_shortcode($content) . '</div>';
}
endif;
add_shortcode('ci_column', 'ci_column');

/**
 * Outputs specified entry (user defined post type)
 *
 * @access public
 * @param array $atts
 * @return string
 */

if ( !function_exists('ci_entry') ):
function ci_entry($atts, $content = null ) {

	extract(shortcode_atts(
		array(
			'type' => '',
			'id' => '',
			'slug' => ''
		), $atts ));

	$args = array (
		'post_type' => $type,
		'posts_per_page' => 1,
		'post_status' => 'publish',
		'ignore_sticky_posts' => true,
		'supress_filters' => false
	);

	if(empty($id) and empty($slug))
	{
		$args['p'] = $post->ID;
	}
	elseif(!empty($id) and $id > 0)
	{
		$args['p'] = $id;
	}
	elseif(!empty($slug))
	{
		$args['name'] = sanitize_title_with_dashes($slug, '', 'save');
	}
	global $post;

	$r = new WP_Query($args);

	if ( $r->have_posts() ) :
		while ( $r-> have_posts() ) : $r->the_post();
			$output =
				'<div class="block shd">'.
				'<figure class="block-thumb">'.
				'<a href="' . get_permalink() . '">' . get_the_post_thumbnail($post->ID, "ci_thumb") . '<div class="overlay"></div></a>'.
				'</figure>'.
				'<div class="block-title">'.
				'<h3><a href="' . get_permalink() . '">' . get_the_title() . '</a></h3>'.
				'</div></div>';
		endwhile;
	endif;
	wp_reset_postdata();
	return $output;
}
endif;
add_shortcode('ci_entry', 'ci_entry');

/**
 * Outputs specified page
 *
 * @access public
 * @param array $atts
 * @return string
 */

if ( !function_exists('ci_page') ):
function ci_page($atts, $content = null ) {

	extract(shortcode_atts(
		array(
			'id' => '',
			'slug' => '',
			'limit' => '-1'
		), $atts ));

	$args = array (
		'post_type' => 'page',
		'posts_per_page' => 1,
		'post_status' => 'publish',
		'ignore_sticky_posts' => true,
		'supress_filters' => false
	);

	if(empty($id) and empty($slug))
	{
		$args['p'] = $post->ID;
	}
	elseif(!empty($id) and $id > 0)
	{
		$args['p'] = $id;
	}
	elseif(!empty($slug))
	{
		$args['name'] = sanitize_title_with_dashes($slug, '', 'save');
	}
	global $post;

	$r = new WP_Query($args);

	if ( $r->have_posts() ) :
		while ( $r-> have_posts() ) : $r->the_post();
			$output =
				'<div class="block shd">'.
				'<figure class="block-thumb">'.
				'<a href="' . get_permalink() . '">' . get_the_post_thumbnail($post->ID, "gallery_thumb") . '<div class="overlay"></a>'.
				'</figure>'.
				'<div class="block-title">'.
				'<h3><a href="' . get_permalink() . '">' . get_the_title() . '</a></h3>'.
				'</div></div>';
		endwhile;
	endif;
	wp_reset_postdata();
	return $output;
}
endif;
add_shortcode('ci_page', 'ci_page');