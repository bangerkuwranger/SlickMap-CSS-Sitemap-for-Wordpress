jQuery(document).ready(function ($) {

	 $('.iris-color-picker-field').wpColorPicker();
	 
	 if ($('#slickmap_css_sitemap_general_padding').length) {
	 	$('.slickmap_css_sitemap_general_padding').change(function() {
	 	
	 		var paddingString = '';
	 		$('.slickmap_css_sitemap_general_padding').each(function() {
	 		
	 			paddingString += $(this).val() + ' ';
	 		
	 		});	//end $('.slickmap_css_sitemap_general_padding').each(function()
	 		$('#slickmap_css_sitemap_general_padding').val(paddingString);
	 	
	 	});	//end $('.slickmap_css_sitemap_general_padding').change(function()
	 	 
	 }	//end if ($('#slickmap_css_sitemap_general_padding').length)

});	//end jQuery(document).ready(function ($)