/* ================================================================= */
/* CSS Style Switcher By FIFO THEMES
====================================================================== */

window.console = window.console || (function(){
	var c = {}; c.log = c.warn = c.debug = c.info = c.error = c.time = c.dir = c.profile = c.clear = c.exception = c.trace = c.assert = function(){};
	return c;
})();


jQuery(document).ready(function($) {
	
		// Color Changer
		
		$(".blue" ).click(function(){
			$(".colors" ).attr("href", "css/colors/blue.css" );
			return false;
		});
		
		$(".green" ).click(function(){
			$(".colors" ).attr("href", "css/colors/green.css" );
			return false;
		});
		
		$(".orange" ).click(function(){
			$(".colors" ).attr("href", "css/colors/orange.css" );
			return false;
		});
		
		
		$(".purple" ).click(function(){
			$(".colors" ).attr("href", "css/colors/purple.css" );
			return false;
		});

		$(".red" ).click(function(){
			$(".colors" ).attr("href", "css/colors/red.css" );
			return false;
		});

		$(".magenta" ).click(function(){
			$(".colors" ).attr("href", "css/colors/magenta.css" );
			return false;
		});
		
		
		$(".brown" ).click(function(){
			$(".colors" ).attr("href", "css/colors/brown.css" );
			return false;
		});
		
		$(".gray" ).click(function(){
			$(".colors" ).attr("href", "css/colors/gray.css" );
			return false;
		});
		
		$(".teal" ).click(function(){
			$(".colors" ).attr("href", "css/colors/teal.css" );
			return false;
		});
		
		$(".golden" ).click(function(){
			$(".colors" ).attr("href", "css/colors/golden.css" );
			return false;
		});
		
	
		
	

		$("#style-switcher h2 a").click(function(e){
			e.preventDefault();
			var div = $("#style-switcher");
			console.log(div.css("left"));
			if (div.css("left") === "-206px") {
				$("#style-switcher").animate({
					left: "0px"
				}); 
			} else {
				$("#style-switcher").animate({
					left: "-206px"
				});
			}
		});






		

		

		$("#layout-switcher").on('change', function() {
			$('#layout').attr('href', $(this).val() + '.css');
		});

		$(".colors li a").click(function(e){
			e.preventDefault();
			$(this).parent().parent().find("a").removeClass("active");
			$(this).addClass("active");
		});
			

	});