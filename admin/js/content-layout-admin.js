jQuery(document).ready(function() {
	jQuery('input[name="layout_view"]').click(function() {
		let val = jQuery('input[name="layout_view"]:checked').val();

		if ( val == "0" ) {
			jQuery('.if_choose_grid').css('display', 'block');
		} else {
			jQuery('.if_choose_grid').css('display', 'none');

		}

		console.log('value', val);
	})
})