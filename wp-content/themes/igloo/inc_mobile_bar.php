<div id="mobile-bar">
	<a class="menu-trigger" href="#"></a>
	<h1 class="mob-title">
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
</div>