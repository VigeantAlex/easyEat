<?php global $ci, $ci_defaults, $load_defaults, $content_width; ?>
<?php if ($load_defaults===TRUE): ?>
<?php
	add_filter('ci_panel_tabs', 'ci_add_tab_display_options', 20);
	if( !function_exists('ci_add_tab_display_options') ):
		function ci_add_tab_display_options($tabs) 
		{ 
			$tabs[sanitize_key(basename(__FILE__, '.php'))] = __('Display Options', 'ci_theme');
			return $tabs; 
		}
	endif;
	
	// Default values for options go here.
	// $ci_defaults['option_name'] = 'default_value';
	// or
	// load_panel_snippet( 'snippet_name' );
	load_panel_snippet('pagination');
	load_panel_snippet('excerpt');
	load_panel_snippet('comments');
	$ci_defaults['default_header_bg'] 			= ''; // Holds the URL of the image file to use as header background
	$ci_defaults['default_header_bg_hidden'] 	= ''; // Holds the attachment ID of the image file to use as header background
	$ci_defaults['use_default_header_instead'] 	= 'enabled';

	load_panel_snippet('featured_image_single');

	// Set our full width template width and options.
	add_filter('ci_full_template_width', 'ci_fullwidth_width');
	if( !function_exists('ci_fullwidth_width') ):
	function ci_fullwidth_width()
	{ 
		return 1020;
	}
	endif;
	load_panel_snippet('featured_image_fullwidth');

	// Change the ci_read_more() markup
	add_filter('ci-read-more-link', 'ci_theme_readmore', 10, 3);
	function ci_theme_readmore($html, $text, $link)
	{
		return '<a class="read-more" href="'.$link.'">'.$text.'</a>';
	}

?>
<?php else: ?>

	<fieldset class="set">
		<p class="guide"><?php _e('Upload or select an image to be used as the default header background on your blog section. This will be displayed only on listing pages and when the currently showing post has no featured image attached. For best results, use a high resolution image, more than 1920 pixels wide.', 'ci_theme'); ?></p>
		<fieldset>
			<?php ci_panel_upload_image('default_header_bg', __('Upload a header image', 'ci_theme')); ?>
			<input type="hidden" class="uploaded-id" name="<?php echo THEME_OPTIONS; ?>[default_header_bg_hidden]" value="<?php echo $ci['default_header_bg_hidden']; ?>" />
		</fieldset>

		<fieldset>
			<p class="guide"><?php _e('This options allows you to override the single posts featured image and always show the above image instead. Useful if you do not plan on having high resolution images for your blog posts', 'ci_theme'); ?></p>
			<?php ci_panel_checkbox('use_default_header_instead', 'enabled', __('Use default header instead of featured?', 'ci_theme')); ?>
		</fieldset>
	</fieldset>

	<?php load_panel_snippet('pagination'); ?>

	<?php load_panel_snippet('excerpt'); ?>

	<?php load_panel_snippet('comments'); ?>

	<?php load_panel_snippet('featured_image_single'); ?>

	<?php load_panel_snippet('featured_image_fullwidth'); ?>

<?php endif; ?>