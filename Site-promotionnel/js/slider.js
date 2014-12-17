jQuery(function ($){
    "use strict";
    
	$('#slider').addClass("slider");
	
	$('#navigation-slider, #nav').on("click","a",function(event){
		event.preventDefault();
		
		var quelSlide=$(this).attr("href");
		
		var slide=$(quelSlide);
		
		slide.parent().children().removeClass();
		
		slide.addClass("courant");
		
		slide.prevAll().addClass("avant");
		
		slide.nextAll().addClass("apres");
		
	});
	
	$('#navigation-slider').on("click","li",function(event){
		event.preventDefault();
		
		$(".actif").removeClass("actif");
		$(this).toggleClass("actif");
	});
})
	
jQuery(function ($){	
	
	$("#dialog1, #dialog2, #dialog3").dialog({
		autoOpen: false,
		modal: true,
		width: 665,
		buttons: {
			Ok: function() {
				$( this ).dialog( "close" );
			}
		}
	});
 
	$(".opener").click(function() {
		$('#' + $(this).data("dialogOpener")).dialog('open');
 
		return false;
	});
})