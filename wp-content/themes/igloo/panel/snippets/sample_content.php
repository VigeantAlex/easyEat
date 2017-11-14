<?php global $ci, $ci_defaults, $load_defaults; ?>
<?php if ($load_defaults===TRUE): ?>
<?php

?>
<?php else: ?>

	<?php if ( ! CI_WHITELABEL ): ?>
		<?php $sample_content_url = apply_filters( 'ci_theme_sample_content_url',
			sprintf( 'https://www.cssigniter.com/sample_content/%s.zip', CI_THEME_NAME ),
			'https://www.cssigniter.com/sample_content/',
			CI_THEME_NAME
		); ?>
		<?php if ( ! empty( $sample_content_url ) ): ?>
			<fieldset id="ci-panel-sample-content" class="set">
				<legend><?php _e( 'Sample Content', 'ci_theme' ); ?></legend>
				<p class="guide"><?php echo sprintf( __( 'You can download sample content to help you get things started with this theme. You need to unzip the downloaded file, and then upload the resulting XML file via <a href="%s">Tools -> Import -> WordPress</a>. Please note that the images imported with the sample content are licensed, and therefore you are not allowed to use or redistribute them.', 'ci_theme' ), admin_url( 'import.php' ) ); ?></p>
				<a href="<?php echo esc_url( $sample_content_url ); ?>"><?php _e( 'Download sample content', 'ci_theme' ); ?></a>
			</fieldset>
		<?php endif; ?>
	<?php endif; ?>

<?php endif; ?>