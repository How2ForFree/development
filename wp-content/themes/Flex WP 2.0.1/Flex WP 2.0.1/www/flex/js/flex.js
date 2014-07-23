
jQuery(document).ready(function($) {
	
	jQuery(".ceebox").ceebox();
	
	/* Cufon Font Replacement */
	Cufon.replace('#navigation ul li, h1, h2, h3, h4, h5, #sidebar .title', { fontFamily: 'League Gothic' });
	Cufon.replace('#navigation ul li', { color: '#ffffff' });
	Cufon.replace('.current_page_item li a', {color: '#ffffff'});
	
	
	/* Superfish Font Replacement */
	$("ul.sf-menu").superfish({
		autoArrows: false,
		delay: 600, // delay on mouseout
		animation: {opacity:'toggle', height:'show'}, // fade-in and slide-down animation
		speed: 350, // faster animation speed
		autoArrows: false, // disable generation of arrow mark-up
		dropShadows: false // disable drop shadows
	});
	
		
	
	/* JQUERY GRID ACTIVATION */
	$("#grid-content").vgrid({
		easeing: "easeOutQuint",
		time: 500,
		delay: 0
	});
	
	$(window).load(function () {
		$("#grid-content").vgrid({
			easeing: "easeOutQuint",
			time: 400,
			delay: 5,
			fadeIn: {
				time: 500,
				delay: 5
			}
		});
		
	var hsort_flg = false;
	$("#hsort").click(function(e){
		hsort_flg = !hsort_flg;
		$("#grid-content").vgsort(function(a, b){
			var _a = $(a).find('div').text();
			var _b = $(b).find('div').text();
			var _c = hsort_flg ? 1 : -1 ;
			return (_a > _b) ? _c * -1 : _c ;
		}, "easeInOutExpo", 300, 0);
		return false;
	});

	$("#rsort").click(function(e){
		$("#grid-content").vgsort(function(a, b){
			return Math.random() > 0.5 ? 1 : -1 ;
		}, "easeInOutExpo", 300, 50);
		return false;
	});


	});
	
	
	

	


});

