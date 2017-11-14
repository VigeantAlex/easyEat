jQuery(document).ready(function($) {

	//
	// Page edit scripts
	//
	if($('#page_template').length > 0) {
		var template_box = $('#page_template');

		var gallery_listing_metabox = $('div#ci_page_gallery_listing_meta');

		gallery_listing_metabox.hide();
		if( template_box.val() == 'template-galleries.php')
			gallery_listing_metabox.show();

		// show only the custom fields we need in the post screen
		$('#page_template').change(function(){

			if( template_box.val() == 'template-galleries.php')
					gallery_listing_metabox.show();
				else
					gallery_listing_metabox.hide();

		});

	}

});
