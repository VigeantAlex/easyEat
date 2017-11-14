<?php get_header(); ?>

<div id="main" class="row" role="main">
	<div class="eight columns">
		<article class="entry">
			<div class="container shd">
				<h3><?php _e('Page not found. Perhaps try searching?', 'ci_theme'); ?></h3>
				<div class="widget_search">
					<?php get_search_form(); ?>
				</div>
			</div>
		</article>
	</div>

	<?php get_sidebar(); ?>
</div> <!-- #main -->

<?php get_footer(); ?>