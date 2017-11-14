<?php
/*
 * Template Name: Galleries Listing
 */
?>

<?php get_header(); ?>

<?php $cols = get_post_meta( get_the_ID(), 'gallery_listing_columns', true ); ?>

<div id="main" class="row" role="main">
	<div class="twelve columns">

		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

			<div class="container shd">
				<div class="row listing">
					<?php
						$args = array(
							'post_type' => 'gallery',
							'posts_per_page' => -1
						);

						$galleries = new WP_Query($args);
					?>
					
					<?php while ( $galleries->have_posts() ) : $galleries->the_post(); ?>
						<div class="<?php echo $cols; ?> columns">
							<div class="block shd">
								<figure class="block-thumb">
									<a  title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'ci_theme' ), get_the_title() ) ); ?>" href="<?php the_permalink(); ?>">
										<?php the_post_thumbnail('ci_thumb'); ?>
										<div class="overlay"></div>
									</a>
								</figure>
								<div class="block-title">
									<h3><a  title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'ci_theme' ), get_the_title() ) ); ?>" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
								</div>
							</div>
						</div>
					<?php endwhile; wp_reset_postdata(); ?>
				</div><!-- .row .listing -->
			</div><!-- .container .shd -->

		<?php endwhile; endif; ?>

	</div>
</div> <!-- #main -->

<?php get_footer(); ?>