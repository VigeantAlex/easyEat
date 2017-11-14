<?php get_header(); ?>

<div id="main" class="row" role="main">
	<div class="eight columns">

		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

			<article id="post-<?php the_ID(); ?>" <?php post_class('entry'); ?>>
				<div class="container shd">
					<h1><a title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'ci_theme' ), get_the_title() ) ); ?>" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
					<div class="entry-meta">
						<time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo get_the_date(); ?></time> &mdash;
						<?php _e('Posted in:', 'ci_theme'); ?> <?php the_category(', '); ?>
					</div>

					<?php if ( ci_has_image_to_show() ) : ?>
						<figure class="entry-thumb">
							<a title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'ci_theme' ), get_the_title() ) ); ?>" href="<?php the_permalink(); ?>"><?php the_post_thumbnail('ci_featured_single'); ?></a>
						</figure>
					<?php endif; ?>


					<div class="entry-excerpt">
						<?php ci_e_content(); ?>
					</div>

					<a title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'ci_theme' ), get_the_title() ) ); ?>" class="read-more" href="<?php the_permalink(); ?>"><?php ci_e_setting('read_more_text'); ?></a>
				</div>
			</article>

		<?php endwhile; endif; ?>

		<div class="pagination container shd">
			<?php ci_pagination(); ?>
		</div>

	</div>

	<?php get_sidebar(); ?>
</div> <!-- #main -->

<?php get_footer(); ?>