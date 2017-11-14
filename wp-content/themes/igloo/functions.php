<?php
	get_template_part('panel/constants');

	load_theme_textdomain( 'ci_theme', get_template_directory() . '/lang' );

	// This is the main options array. Can be accessed as a global in order to reduce function calls.
	$ci = get_option(THEME_OPTIONS);
	$ci_defaults = array();

	// The $content_width needs to be before the inclusion of the rest of the files, as it is used inside of some of them.
	if ( ! isset( $content_width ) ) $content_width = 770;


	//
	// Let's bootstrap the theme.
	//
	get_template_part('panel/bootstrap');
	get_template_part('functions/shortcodes');

	//
	// Let WordPress manage the title.
	//
	add_theme_support( 'title-tag' );

	//
	// HTML5 Support for galleries
	//
	add_theme_support( 'html5', array('gallery') );

	//
	// Define our various image sizes.
	//
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'ci_slider_full', 1920, 420, true);
	add_image_size( 'ci_slider_fixed', 1240, 420, true );
	add_image_size( 'ci_thumb', 770, 520, true );

	add_fancybox_support();

	// Let the theme know that we have WP-PageNavi styled.
	add_ci_theme_support('wp_pagenavi');

	// Let the user choose a color scheme on each post individually.
	add_ci_theme_support('post-color-scheme', array('page', 'post', 'menu_item', 'slider'));

	if ( ! function_exists( 'ci_theme_print_menu_category' ) ):
	function ci_theme_print_menu_category( $base_category, $categories, $Hlevel = 1 ) {
		$base_term     = get_term( intval( $base_category ), 'menu_category' );
		$section_title = $base_term->name;
		$section_id    = $base_term->term_id;

		if ( 1 == $Hlevel ) {
			?>
			<section id="menu-term-<?php echo $section_id; ?>" class="container shd menu-group">
				<h1 class="menu-group-title"><span><?php echo $section_title; ?></span></h1>
			<?php
		} else {
			?>
			<div class="menu-subcategory">
			<h<?php echo $Hlevel; ?> class="menu-group-title"><span><?php echo $section_title; ?></span></h<?php echo $Hlevel; ?>>
			<?php
		}

		// Retrieve all menu items in the category
		$args = array(
			'post_type'      => 'menu_item',
			'posts_per_page' => -1,
			'tax_query'      => array(
				array(
					'taxonomy'         => 'menu_category',
					'terms'            => intval( $base_category ),
					'field'            => 'term_id',
					'include_children' => false
				)
			)
		);
		$menu_items = new WP_Query($args);

		while ( $menu_items->have_posts() ) : $menu_items->the_post();
			ci_theme_print_menu_item();
		endwhile;
		wp_reset_postdata();

		foreach ( $categories as $c ) {
			if ( $c->parent == $base_category ) {
				ci_theme_print_menu_category( $c->term_id, $categories, $Hlevel + 1 );
			}
		}

		if ( 1 == $Hlevel ) {
			?></section><?php
		} else {
			?></div><?php
		}

	}
	endif;

	if( !function_exists('ci_theme_print_menu_item') ):
	function ci_theme_print_menu_item()
	{
		global $post;
		?>
		<article class="entry menu-entry row">
			<?php if ( has_post_thumbnail() ) : ?>
				<figure class="entry-thumb three columns">
					<a href="<?php echo ci_get_featured_image_src('full'); ?>" class="fancybox">
						<?php the_post_thumbnail('ci_thumb'); ?>
						<div class="overlay"></div>
					</a>
				</figure>
			<?php endif; ?>

			<div class="nine columns">
				<div class="menu-title group">
					<h1><?php the_title(); ?></h1>
					<span><?php echo get_post_meta($post->ID, 'ci_cpt_menu_item_price', true); ?></span>
				</div>
				<?php the_content(); ?>
			</div>
		</article>
		<?php
	}
	endif;

	if ( ! function_exists( 'format_price' ) ):
	/**
	 * Formats a price (amount of money) with a currency symbol, according to the setting specified in the panel.
	 *
	 * @access public
	 * @param float $amount An amount of money to format.
	 * @return string
	 */
	function format_price( $amount, $return_empty = false ) {
		if ( $return_empty === false && empty( $amount ) ) {
			return false;
		}

		if ( ci_setting( 'price_currency' ) ) {
			if ( ci_setting( 'currency_position' ) == 'before' ) {
				return ci_setting( 'price_currency' ) . $amount;
			} else {
				return $amount . ci_setting( 'price_currency' );
			}
		}

		return $amount;
	}
	endif;
