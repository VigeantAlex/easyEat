<div id="sidebar" class="four columns">
	<div class="container shd">
		<?php
			if ( is_home() or is_single() ) {
				dynamic_sidebar('blog-widgets');
			} else {
				dynamic_sidebar('page-widgets');
			}
		?>
	</div>
</div> <!-- #sidebar -->