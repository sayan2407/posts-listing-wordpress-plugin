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

	jQuery('.layout_shortcode').click( function() {

		let id = jQuery(this).attr('id');
		let temp = jQuery("<input>");
		jQuery("body").append(temp);
		temp.val(jQuery('#'+id).text()).select();
		document.execCommand("copy");
		temp.remove();
		window.alert('Successfully Copied The Shortcode ' + jQuery('#'+id).text());
	} )
})