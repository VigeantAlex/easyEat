<?php
/*
 * Template Name: Post Archives
 */
?>
<?php get_header(); ?>

<div id="main" class="row" role="main">

	<div class="eight columns">

		<?php
			global $paged;
			$arrParams = array(
				'paged' => $paged,
				'ignore_sticky_posts'=>1,
				'showposts' => ci_setting('archive_no')
			);
			query_posts($arrParams);
		?>

		<article id="post-<?php the_ID(); ?>" <?php post_class('entry'); ?>>
			<div class="container shd">
				<ul class="lst archive">
					<?php while (have_posts() ) : the_post(); ?>
						<li><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'ci_theme' ), get_the_title() ) ); ?>"><?php the_title(); ?></a> - <?php echo get_the_date(); ?><?php the_excerpt(); ?></li>
					<?php endwhile; wp_reset_query(); ?>
				</ul>

				<?php if (ci_setting('archive_week')=='enabled'): ?>
					<h3 class="hdr"><?php _e('Weekly Archive', 'ci_theme'); ?></h3>
					<ul class="lst archive"><?php wp_get_archives('type=weekly&show_post_count=1'); ?></ul>
				<?php endif; ?>

				<?php if (ci_setting('archive_month')=='enabled'): ?>
					<h3 class="hdr"><?php _e('Monthly Archive', 'ci_theme'); ?></h3>
					<ul class="lst archive"><?php wp_get_archives('type=monthly&show_post_count=1'); ?></ul>
				<?php endif; ?>

				<?php if (ci_setting('archive_year')=='enabled'): ?>
					<h3 class="hdr"><?php _e('Yearly Archive', 'ci_theme'); ?></h3>
					<ul class="lst archive"><?php wp_get_archives('type=yearly&show_post_count=1'); ?></ul>
				<?php endif; ?>
			</div>
		</article>

	</div>

	<?php get_sidebar(); ?>

</div> <!-- #main -->

<?php get_footer(); ?>