<?php
/*
 * Template Name: Frontpage Fixed Slider
 */
?>
<?php get_header(); ?>

<?php if ( ci_setting('disable_slider') == '' ) : ?>
	<?php $q = new WP_Query( array(
		'post_type'=>'slider',
		'posts_per_page' => -1
	)); ?>

	<?php if ( $q->have_posts() ) : ?>
		<div class="row">
			<div id="home-hero" class="twelve columns">
				<div id="homeslider" class="flexslider">
					<ul class="slides">
						<?php while ( $q->have_posts() ) : $q->the_post(); ?>
							<?php
								$img = wp_get_attachment_image_src( get_post_thumbnail_id(), 'ci_slider_fixed' );
								$url = get_post_meta( get_the_ID(), 'ci_cpt_slider_url', true );
								$url = ! empty( $url ) ? $url : get_permalink();
							?>
							<li>
								<div class="slide" style="background: url('<?php echo $img[0]; ?>') center center">
									<h3 class="slide-title"><?php the_title(); ?></h3>
									<p class="btn-container">
										<a class="slide-btn" href="<?php echo esc_url( $url ); ?>"><?php echo get_post_meta( get_the_ID(), 'ci_cpt_slider_btn_text', true ); ?></a>
									</p>
								</div>
							</li>
						<?php endwhile; ?>
					</ul>
				</div>
			</div> <!-- #home-hero -->
		</div>
	<?php endif; // slider have_posts() ?>

	<?php wp_reset_postdata(); ?>
<?php endif; // disable slider ?>

<div id="main" class="row" role="main">
	<div class="twelve columns">
		<div class="home-widget-row-1">
			<?php dynamic_sidebar('front-row-1'); ?>
		</div>

		<?php if ( is_active_sidebar('front-row-2') ) : ?>
			<div class="row">
				<?php dynamic_sidebar('front-row-2'); ?>
			</div>
		<?php endif; ?>

		<?php if ( is_active_sidebar('front-row-3') ) : ?>
			<div class="row">
				<?php dynamic_sidebar('front-row-3'); ?>
			</div>
		<?php endif; ?>
	</div>
</div> <!-- #main -->

<?php get_footer(); ?>