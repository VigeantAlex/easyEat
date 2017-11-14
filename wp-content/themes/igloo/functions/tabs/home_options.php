<?php global $ci, $ci_defaults, $load_defaults; ?>
<?php if ($load_defaults===TRUE): ?>
<?php
	add_filter('ci_panel_tabs', 'ci_add_tab_homepage_options', 40);
	if( !function_exists('ci_add_tab_homepage_options') ):
		function ci_add_tab_homepage_options($tabs) 
		{ 
			$tabs[sanitize_key(basename(__FILE__, '.php'))] = __('Homepage Options', 'ci_theme'); 
			return $tabs; 
		}
	endif;

	// Default values for options go here.
	// $ci_defaults['option_name'] = 'default_value';
	// or
	// load_panel_snippet( 'snippet_name' );

	load_panel_snippet('slider_flexslider');
	$ci_defaults['disable_slider'] = '';
	
?>
<?php else: ?>

	<fieldset class="set">
		<p class="guide"><?php _e("Check the following option if you don't wish to display a slider on your homepage", 'ci_theme'); ?></p>
		<?php ci_panel_checkbox( 'disable_slider', 'enabled', __('Disable the homepage slider', 'ci_theme') ); ?>
	</fieldset>

	<?php load_panel_snippet('slider_flexslider'); ?>

<?php endif; ?>