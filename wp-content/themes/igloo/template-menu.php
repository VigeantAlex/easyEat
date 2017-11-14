<?php
/*
* Template Name: Menu Template
*/
?>
<?php get_header(); ?>

<div id="main" class="row" role="main">
	<div class="twelve columns">
		<?php
			// Retrieve the terms of the menu taxonomy
			$base_category = get_post_meta( $post->ID, 'base_menu_category', true );
			$base_category = ( empty( $base_category ) or $base_category == - 1 ) ? 0 : $base_category;
			if ( is_tax() ) {
				$main_term     = get_term_by( 'slug', $wp_query->get( 'term' ), 'menu_category' );
				$base_category = $main_term->term_id;
			}

			$categories = get_terms( 'menu_category', array(
				'taxonomy'   => 'menu_category',
				'pad_counts' => true,
				'orderby'    => 'id',
				'child_of'   => intval( $base_category ),
			) );

			if ( $base_category == 0 ) {
				foreach ( $categories as $c ) {
					if ( $c->parent == $base_category ) {
						ci_theme_print_menu_category( $c->term_id, $categories );
					}
				}
			} else {
				$cat        = get_term( intval( $base_category ), 'menu_category' );
				$categories = array_merge( array( $cat ), $categories );
				foreach ( $categories as $c ) {
					if ( $c->term_id == $base_category ) {
						ci_theme_print_menu_category( $c->term_id, $categories );
						break;
					}
				}
			}
		?>
	</div><!-- .twelve .columns -->
</div> <!-- #main -->

<?php get_footer(); ?>