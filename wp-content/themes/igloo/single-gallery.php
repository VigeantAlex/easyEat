<?php get_header(); ?>

<div id="main" class="row" role="main">
	<div class="twelve columns">

		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<article class="entry">
	
				<div class="container shd">
					<div class="row">
	
						<?php $attachments = ci_featgal_get_attachments(); ?>
		
						<?php while ( $attachments->have_posts() ) : $attachments->the_post(); ?>
							<?php
								$image_full = wp_get_attachment_image_src($post->ID, 'full');
								$image_thumb = wp_get_attachment_image_src($post->ID, 'ci_thumb');
							?>
							<figure id="post-<?php the_ID(); ?>" <?php post_class('entry-thumb four columns'); ?>>
								<a title="<?php the_title_attribute(); ?>" data-fancybox-group="gallery" class="fancybox" href="<?php echo $image_full[0]; ?>">
									<img src="<?php echo $image_thumb[0]; ?>">
									<div class="overlay"></div>
								</a>
							</figure>
						<?php endwhile; wp_reset_postdata(); ?>
	
					</div>
				</div>

			</article>
		<?php endwhile; endif; ?>

	</div>
</div> <!-- #main -->

<?php get_footer(); ?>