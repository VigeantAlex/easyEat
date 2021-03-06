<?php global $ci, $ci_defaults, $load_defaults, $content_width; ?>
<?php if ($load_defaults===TRUE): ?>
<?php
	
	$ci_defaults['internal_slider_autoslide'] 	= 'enabled';
	$ci_defaults['internal_slider_effect'] 		= 'fade';
	$ci_defaults['internal_slider_direction'] 	= 'horizontal';
	$ci_defaults['internal_slider_speed'] 		= 3000;
	$ci_defaults['internal_slider_duration']	= 600;

?>
<?php else: ?>
		
	<fieldset id="ci-panel-slider-flexslider-internal" class="set">
		<legend><?php _e('Internal Slider', 'ci_theme'); ?></legend>
		<p class="guide"><?php _e('The following options control the internal slider. You may enable or disable auto-sliding by checking the appropriate option and further control its behavior.' , 'ci_theme'); ?></p>
		<fieldset id="internal-flexslider-slider-autoslide">
			<?php ci_panel_checkbox('internal_slider_autoslide', 'enabled', __('Enable auto-slide', 'ci_theme')); ?>
		</fieldset>
		<fieldset id="internal-flexslider-slider-effect">
			<?php 
				$slider_effects = array(
					'fade' => _x('Fade', 'slider effect', 'ci_theme'),
					'slide' => _x('Slide','slider effect', 'ci_theme')
				);
				ci_panel_dropdown('internal_slider_effect', $slider_effects, __('Slider Effect', 'ci_theme'));
			?>
		</fieldset>
		<fieldset id="internal-flexslider-slider-direction">
			<?php 
				$slider_direction = array(
					'horizontal' => _x('Horizontal', 'slider direction', 'ci_theme'),
					'vertical' => _x('Vertical','slider direction', 'ci_theme')
				);
				ci_panel_dropdown('internal_slider_direction', $slider_direction, __('Slide Direction (only for <b>Slide</b> effect)', 'ci_theme'));
			?>
		</fieldset>
		<fieldset id="internal-flexslider-slider-speed">
			<?php ci_panel_input('internal_slider_speed', __('Slideshow speed in milliseconds (smaller number means faster)', 'ci_theme')); ?>
		</fieldset>
		<fieldset id="internal-flexslider-slider-duration">
			<?php ci_panel_input('internal_slider_duration', __('Animation duration in milliseconds (smaller number means faster)', 'ci_theme')); ?>
		</fieldset>
	</fieldset>
		
<?php endif; ?>