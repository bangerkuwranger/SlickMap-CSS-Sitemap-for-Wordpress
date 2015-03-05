jQuery(document).ready(function ($) {

	$(".slickmap>ul").attr("id", "primaryNav");
	$("#primaryNav>li:first-child").attr("id", "home");
	var breakpoint = 768;
	if (slickmapSettings) {
	
		if (slickmapSettings.columns) {
		
			$('#primaryNav').addClass('col'+slickmapSettings.columns);
		
		}	//end if (slickmapSettings.columns)
		
		if (slickmapSettings.breakpoint) {
		
			breakpoint = slickmapSettings.breakpoint;
		
		}	//end if (slickmapSettings.breakpoint)
	
	}	//end if (slickmapSettings)
	
	function slickmapMobileWidth() {
	
		if ($(window).width() <= breakpoint) {
		
			$('#primaryNav').addClass('mobile');
		
		}
		else {
		
			$('#primaryNav').removeClass('mobile');
		
		}	//end if ($(window).width() <= breakpoint)
	
	}	//end slickmapMobileWidth()
	
	//check width and add class if necessary on load
	slickmapMobileWidth();
	
	//check width and add class if necessary on resuze
	$(window).resize(function() {
	
		slickmapMobileWidth();
	
	});

});	//end jQuery(document).ready(function ($)