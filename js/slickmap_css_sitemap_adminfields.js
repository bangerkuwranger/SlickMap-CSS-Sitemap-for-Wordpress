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
	 
	 if ($('#slickmap_css_sitemap_resetAll').length) {
	 
	 	$('#slickmap_css_sitemap_resetAll').click(function(e) {
	 	
	 		e.preventDefault();
			if (confirm("Are you sure you want to reset all of your settings to the defaults? This cannot be undone.") == true) {
			
				var thisurl = window.location.href;
				window.location.replace(thisurl + '&reset_all=true');
			
			}	//end if (confirm("Are you sure you want to reset all of your settings to the defaults? This cannot be undone.") == true)
	 	
	 	});	//end $('#slickmap_css_sitemap_resetAll').click(function()
	 
	 }	//end if ($('#slickmap_css_sitemap_resetAll').length)
	 
	 if ($('#slickmap_css_sitemap_ace_editor').length) {
	 
		var editor = ace.edit("slickmap_css_sitemap_ace_editor");
		editor.setTheme("ace/theme/chrome");
		editor.getSession().setMode("ace/mode/css");
	
	}	//end if ($('#slickmap_css_sitemap_ace_editor').length)
	
	if ($('#slickmap_css_sitemap_advanced_additional_css').length) {
	
		editor.setValue($('#slickmap_css_sitemap_advanced_additional_css').val());
		editor.getSession().on('change', function(e) {
		
			$('#slickmap_css_sitemap_advanced_additional_css').val(editor.getValue());
		
		});	//end editor.getSession().on('change', function(e)
	
	}	//end ($'#slickmap_css_sitemap_advanced_additional_css').length())

});	//end jQuery(document).ready(function ($)