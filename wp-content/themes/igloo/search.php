<?php get_header(); ?>

<?php
	global $wp_query;

	$found = $wp_query->found_posts;
	$none  = __( 'No results found. Please broaden your terms and search again.', 'ci_theme' );
	$one   = __( 'Just one result found. We either nailed it, or you might want to broaden your terms and search again.', 'ci_theme' );
	$many  = sprintf( _n( '%d result found.', '%d results found.', $found, 'ci_theme' ), $found );
?>

<div id="main" class="row" role="main">
	<div class="eight columns">

		<div class="small container shd">
			<h3><?php ci_e_inflect($found, $none, $one, $many); ?></h3>
			<?php if($found==0): ?>
				<div class="widget_search">
					<?php get_search_form(); ?>
				</div>
			<?php endif; ?>
		</div>

		<?php if ( $found ) : ?>
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
				<article id="post-<?php the_ID(); ?>" <?php post_class('entry'); ?>>
					<div class="container shd">
						<h1><a title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'ci_theme' ), get_the_title() ) ); ?>" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
		
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
		<?php endif; // $found ?>
	</div>

	<?php get_sidebar(); ?>
</div> <!-- #main -->

<?php get_footer(); ?>