<?php
/*
 * Template Name: Page builder
 */
?>

<?php get_header(); ?>

<div id="main" class="row" role="main">

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
  <?php the_content(); ?>
<?php endwhile; endif; ?>

</div><!-- #main -->

<?php get_footer(); ?>
