<?php global $ci, $ci_defaults, $load_defaults; ?>
<?php if ($load_defaults===TRUE): ?>
<?php
	add_filter('ci_panel_tabs', 'ci_add_tab_contact_options', 50);
	if( !function_exists('ci_add_tab_contact_options') ):
		function ci_add_tab_contact_options($tabs) 
		{ 
			$tabs[sanitize_key(basename(__FILE__, '.php'))] = __('Contact Options', 'ci_theme'); 
			return $tabs; 
		}
	endif;

	// Default values for options go here.
	// $ci_defaults['option_name'] = 'default_value';
	// or
	// load_panel_snippet( 'snippet_name' );
	$ci_defaults['reservations_page']      = '';
	$ci_defaults['reservation_form_email'] = get_option( 'admin_email' );

	$ci_defaults['header_text']      = 'Make your reservation &ndash; +30 0123 456789';
	$ci_defaults['contact_show_map'] = 'enabled';

	$ci_defaults['map_tooltip']    = 'Pointblank Str. 14, 54321, California';
	$ci_defaults['map_coords']     = '33.59,-80';
	$ci_defaults['map_zoom_level'] = '6';

?>
<?php else: ?>

	<fieldset class="set">
		<p class="guide"><?php _e( 'The following text will appear on the header of your website, at the top right corner. It can be linked to a page by choosing one below.', 'ci_theme' ); ?></p>
		<?php ci_panel_input( 'header_text', __( 'Header text (e.g. your telephone number, reservations call to action, etc)', 'ci_theme' ) ); ?>

		<p class="guide"><?php _e( 'Select your Reservations or Contact page. This way your header text on the top right will be linked to this page.', 'ci_theme' ); ?></p>
		<label for="<?php echo THEME_OPTIONS; ?>[reservations_page]"><?php _e( 'Select the Contact/Availability page', 'ci_theme' ); ?></label>
		<?php wp_dropdown_pages( array(
			'show_option_none' => '&nbsp;',
			'selected'         => $ci['reservations_page'],
			'name'             => THEME_OPTIONS . '[reservations_page]'
		) ); ?>

		<p class="guide"><?php _e( 'Provide an email address that reservation requests will be emailed to. This only applies to pages that have the "Location Page" template assigned.', 'ci_theme' ); ?></p>
		<?php ci_panel_input( 'reservation_form_email', __( 'Reservation form E-mail address', 'ci_theme' ) ); ?>
	</fieldset>

	<fieldset class="set">
		<legend><?php _e( 'Map Settings', 'ci_theme' ); ?></legend>
		<p class="guide"><?php _e( 'Customize your map. Changes made here are reflected in pages that have the "Location Page" template assigned.', 'ci_theme' ); ?> </p>
		<?php
			ci_panel_checkbox( 'contact_show_map', 'enabled', __( 'Enable the map', 'ci_theme' ) );
			ci_panel_input( 'map_coords', __( 'Enter the exact coordinates of your address (you can find your coordinates based on address using <a href="http://itouchmap.com/latlong.html">this tool</a>):', 'ci_theme' ) );
			ci_panel_input( 'map_zoom_level', __( 'Enter a single number from 1 to 20 that represents the default zoom level you want on your map. Higher number means closer.', 'ci_theme' ) );
			ci_panel_input( 'map_tooltip', __( 'Enter the text you wish to display when a user clicks on the map pin that points to your address (e.g. Your actual address):', 'ci_theme' ) );
		?>
	</fieldset>
	
<?php endif; ?>