<?php
	global $post;
	
	$img_url = ci_setting('default_header_bg');
	$img_id = ci_setting('default_header_bg_hidden');
	
	// Assign first the fallback image. It will be replaced next if another featured image exists.
	if( !empty($img_url) and !empty($img_id) ) {
		$img_info = wp_get_attachment_image_src($img_id, 'ci_slider_full');
	}
	
	// Replace the header image if the post/page has a featured image assigned
	if ( (is_single() and ( ci_setting('use_default_header_instead') == '' )) or is_page() or is_home() or is_singular('gallery')) {
		if ( has_post_thumbnail() )
		{
			$img_id = get_post_thumbnail_id($post->ID);
			$img_info = wp_get_attachment_image_src($img_id, 'ci_slider_full');
	
			if ( !empty($img_info) ) {
				$img_url = $img_info[0];
			}
		}
	}
?>

<section id="hero" style="background: url(<?php echo $img_url; ?>) center 0 fixed;">
	<h1>
		<?php
			if ( is_front_page() ) :
				$title       = get_bloginfo( 'name', 'display' );
				$description = get_bloginfo( 'description', 'display' );
				if ( ! empty( $description ) ) {
					$title .= ' | ' . $description;
				}
				echo $title;
			elseif ( is_page() or is_singular('gallery') or is_singular('slider') ) :
				single_post_title();
			elseif ( is_home() or is_single() ) :
				_e('From The Blog', 'ci_theme');
			elseif ( is_category() or is_tax() ) :
				single_term_title();
			elseif ( is_month()):
				single_month_title();
			elseif ( is_search() ):
				_e('Search Results', 'ci_theme');
			elseif ( is_404() ):
				_e('Oops! 404', 'ci_theme');
			endif;
		?>
	</h1>
</section>