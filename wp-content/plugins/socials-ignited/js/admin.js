jQuery(document).ready(function($) {
	$('#cisiw-admin-table tbody').sortable({
		helper: function(e, tr)
		{
			var $originals = tr.children();
			var $helper = tr.clone();
			$helper.children().each(function(index)
			{
				// Set helper cell sizes to match the original sizes
				$(this).width($originals.eq(index).width())
			});
			return $helper;
		}
	});


	//
	// ColorPickers
	//
	if( typeof($.fn.ColorPicker) === 'function' ){
		$('.cisiw-colorpckr').ColorPicker({
			onSubmit: function(hsb, hex, rgb, el) {
				$(el).val('#'+hex);
				$(el).ColorPickerHide();
			},
			onBeforeShow: function () {
				$(this).ColorPickerSetColor(this.value);
			}
		}).bind('keyup', function(){
			$(this).ColorPickerSetColor(this.value);
		});
	}

	if( typeof($.fn.wpColorPicker) === 'function' ){
		$('.cisiw-colorpckr').wpColorPicker();
	}

});
