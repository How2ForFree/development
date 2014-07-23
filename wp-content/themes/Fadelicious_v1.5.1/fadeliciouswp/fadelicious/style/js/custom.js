


$(document).ready(function(){
				$('.caption.peek').hover(function(){
					$(".cover", this).stop().animate({top:'25px'},{queue:false,duration:160});
				}, function() {
					$(".cover", this).stop().animate({top:'0px'},{queue:false,duration:160});
				});
			});

$(document).ready(function(){
//Hide the tooglebox when page load
$(".togglebox").hide();
//slide up and down when click over heading 2
$("h2").click(function(){
// slide toggle effect set to slow you can set it to fast too.
$(this).toggleClass("active").next(".togglebox").slideToggle("slow");
return true;
});
});


$(document).ready(function() {

	//Default Action
	$(".tab_content").hide(); //Hide all content
	$("ul.tabs li:first").addClass("active").show(); //Activate first tab
	$(".tab_content:first").show(); //Show first tab content
	
	//On Click Event
	$("ul.tabs li").click(function() {
		$("ul.tabs li").removeClass("active"); //Remove any "active" class
		$(this).addClass("active"); //Add "active" class to selected tab
		$(".tab_content").hide(); //Hide all tab content
		var activeTab = $(this).find("a").attr("href"); //Find the rel attribute value to identify the active tab + content
		$(activeTab).fadeIn(); //Fade in the active content
		return false;
	});

});

$(function() {
	$(".ticker").jCarouselLite({
		vertical: true,
		hoverPause:true,
		visible: 1,
		auto:3500,
		speed:1400
	});
});

$(function() {
	$(".ticker2").jCarouselLite({
		vertical: true,
		hoverPause:true,
		visible: 1,
		auto:3500,
		speed:1400
	});
});


$(document).ready(function() {
	$("a.zoom img").mouseover(function(){
		$(this).stop(true,true);
		$(this).fadeTo(300, 0.6);
	});
	
	$("a.zoom img").mouseout(function(){
		$(this).fadeTo(400, 1.0);
	});

	$("a.zoom2 img").mouseover(function(){
		$(this).stop(true,true);
		$(this).fadeTo(300, 0.5);
	});
	
	$("a.zoom2 img").mouseout(function(){
		$(this).fadeTo(400, 1.0);
	});
	
	$("a.play img").mouseover(function(){
		$(this).stop(true,true);
		$(this).fadeTo(300, 0.6);
	});
	
	$("a.play img").mouseout(function(){
		$(this).fadeTo(400, 1.0);
	});

	$("a.play2 img").mouseover(function(){
		$(this).stop(true,true);
		$(this).fadeTo(300, 0.5);
	});
	
	$("a.play2 img").mouseout(function(){
		$(this).fadeTo(400, 1.0);
	});

});


// perform JavaScript after the document is scriptable.
$(function() {
	// setup ul.tabs to work as tabs for each div directly under div.panes
	$("ul.tabs").tabs("div.panes > div", {effect: 'fade'});
});



	
$(document).ready(function() {
    
            $("#tab").organicTabs();
    
        });
