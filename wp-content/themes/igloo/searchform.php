<form action="<?php echo esc_url(home_url('/')); ?>" method="get" role="search" class="searchform">
	<div>
		<label for="s" class="screen-reader-text"><?php _e('Search for:', 'ci_theme'); ?></label>
		<input type="text" id="s" name="s" value="" placeholder="<?php echo (get_search_query()!="" ? get_search_query() : __('SEARCH', 'ci_theme') ); ?>">
		<input type="submit" value="<?php _e('GO', 'ci_theme'); ?>" class="searchsubmit action-btn">
	</div>
</form>