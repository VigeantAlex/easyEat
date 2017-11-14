<!doctype html>
<!--[if IE 8]> <html class="no-js lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<head>

	<!-- Basic Page Needs
  ================================================== -->
	<meta charset="<?php bloginfo( 'charset' ); ?>">

	<!-- Mobile Specific Metas
  ================================================== -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>
<?php do_action('after_open_body_tag'); ?>
<?php get_template_part('inc_mobile_bar'); ?>

<div id="page">

	<div class="row">
		<header id="header" class="twelve columns">
			<div id="tophead">
				<div class="row">
					<div class="six columns">
						<?php dynamic_sidebar('header-widgets'); ?>
					</div>

					<div class="six columns text-right">
						<?php
							if ( ci_setting('reservations_page')) {
								echo '<a href="' . get_permalink(ci_setting('reservations_page')) . '">';
							}
							echo ci_setting('header_text');
							if ( ci_setting('reservations_page') ) {
								echo '</a>';
							}
						?>
					</div>
				</div>
			</div>

			<div id="mainhead" class="shd">
				<div class="row">
					<div id="logo" class="four columns">
						<?php ci_e_logo('<h1>', '</h1>'); ?>
						<?php ci_e_slogan('<h2>', '</h2>'); ?>
					</div>

					<nav id="nav">
						<?php
							wp_nav_menu( array(
								'theme_location' 	=> 'ci_main_menu',
								'fallback_cb' 		=> '',
								'container' 		=> '',
								'menu_id' 			=> 'navigation',
								'menu_class' 		=> 'group'
							));
						?>
					</nav><!-- #nav -->

				</div>
			</div>
		</header>
	</div>

	<?php
		if ( !is_page_template( array('template-front-fullwidth-slider.php','template-front-fixed-slider.php','template-builder.php') ) ) {
			get_template_part('inc_hero');
		}
	?>