<?php 
add_filter('ci_footer_credits', 'ci_theme_footer_credits');
if( !function_exists('ci_theme_footer_credits') ):
function ci_theme_footer_credits($string){

	if ( ! CI_WHITELABEL ) {
		return sprintf( __( '<a href="%s">Powered by WordPress</a> - A theme by <a href="%s">CSSIgniter.com</a>', 'ci_theme' ),
			esc_url( 'https://wordpress.org' ),
			esc_url( 'http://www.cssigniter.com' )
		);
	} else {
		/* translators: %2$s is replaced by the website's name. */
		return sprintf( __( '<a href="%1$s">%2$s</a> - <a href="%3$s">Powered by WordPress</a>', 'ci_theme' ),
			esc_url( home_url() ),
			get_bloginfo( 'name' ),
			esc_url( 'https://wordpress.org' )
		);
	}

}
endif;

add_filter('ci_pagination_default_args', 'ci_theme_change_pagination_default_args');
if( !function_exists('ci_theme_change_pagination_default_args') ):
function ci_theme_change_pagination_default_args($args)
{
	$new_args = wp_parse_args( array(
		'container_class' => 'group',
		'prev_text' => __('Previous', 'ci_theme'),
		'next_text' => __('Next', 'ci_theme')
	), $args );

	return $new_args;
}
endif;

// Intercepts the request and injects the appropriate posts_per_page parameter according to the request.
add_filter( 'pre_get_posts', 'ci_menu_taxonomy_paging_request' );
if( !function_exists('ci_menu_taxonomy_paging_request') ):
function ci_menu_taxonomy_paging_request( $query )
{
	//We don't want to mess other post types or with the admin panel.
	if( (!is_tax('menu_category') and !is_post_type_archive('menu_item')) or is_admin() ) return;

	// Don't mess with the posts if the query is explicit.
	if (!isset($query->query_vars['posts_per_page']))
	{
		$query->set( 'posts_per_page', -1 );
	}

	return $query;
}
endif;

?>