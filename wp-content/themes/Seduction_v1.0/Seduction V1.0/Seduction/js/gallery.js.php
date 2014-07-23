<?php
session_start();
?>
var galleryInfo = [<?php
  $comma = '';
  foreach($_SESSION['galleryInfo'] AS $g) {
    echo $comma . '[' . $g . ']';
    $comma = ', ';
  }
	//echo implode('), new Array(', $_SESSION['galleryInfo']);

?>];

var galleryIndex = 0;
<?php if($_SESSION['galleryFade']==1){ echo "fadeOutTime = 400;fadeInTime = 800; fadeDelay2 = 500; fadeInTime2 = 300;";}else{echo "fadeOutTime = 0;fadeInTime = 0;  fadeDelay2 = 0; fadeInTime2 = 0;";} ?>
var galleryDiaInterval = <?php echo $_SESSION['galleryDiaInterval']*1000; ?>;
var galleryMax = <?php echo $_SESSION['galleryDiaInterval'] ?>;

imageHistory = new Array();

/* Load new Gallery item */
function loadGalleryItem(id) {

  
  if (jQuery('img#bgimg').length > 0){
    imageHistory.push(jQuery('#bgimg')[0].src);
  }
  
  if (jQuery('object#bgimg').length > 0){
    imageHistory.push(jQuery('#bgimg object param[flashvars]').val());
  }

  if (jQuery('embed#bgimg').length > 0){
    imageHistory.push(jQuery('#bgimg object param[flashvars]').val());
  }
  

  if(id != undefined) {
    galleryIndex = id;
  }

  
  jQuery('#gallery').fadeOut(fadeOutTime, function() {
    jQuery('#gallery-main h2').html(galleryInfo[galleryIndex][0]);
    jQuery('#gallery-main p').html(galleryInfo[galleryIndex][1]);
    jQuery('#bgholder').fadeOut(fadeOutTime, function() {
      if(galleryInfo[galleryIndex][4] != '' && galleryInfo[galleryIndex][4] != 'false') {
        jQuery(this).html('<iframe src="' + galleryInfo[galleryIndex][4] + '"></iframe>');
        iframeResize();
        jQuery(this).fadeIn(fadeInTime);
        jQuery('#gallery').delay(fadeDelay2).fadeIn(fadeInTime2);
      } else if(galleryInfo[galleryIndex][3] != '' && galleryInfo[galleryIndex][3] != 'false') {
        //new code starts here
        var params = {};
        var attrs = {};
        var flashvars = {};
        //if (jQuery('#bgholder object').length > 0){
        attrs.id = "#bgimg";
        attrs.moviefile = encodeURIComponent(galleryInfo[galleryIndex][3]);
        //attrs.autoplay = 1;
        //attrs.wmode = "transparent";
        flashvars.moviefile = encodeURIComponent(galleryInfo[galleryIndex][3]);
        flashvars.autoplay = 1;
        flashvars.wmode = "transparent";
        params.moviefile = encodeURIComponent(galleryInfo[galleryIndex][3]);
        params.autoplay = 1;
        params.wmode = "transparent";
        var swf_file = '<?php echo $_SESSION['template_url']; ?>tdplayer.swf';
        jQuery(this).html("<img id=\"bgimg\" />");//fixes videos iteration
        swfobject.embedSWF(swf_file, "bgimg", "300", "120", "9", false, flashvars, params, attrs);
        //new code ends here
        //jQuery(this).html('<object width="400" height="300"><param name="movie" value="<?php echo $_SESSION['template_url']; ?>tdplayer.swf?moviefile=' + galleryInfo[galleryIndex][3] + '&autoplay=1" /><param name="wmode" value="opaque"></param><embed src="<?php echo $_SESSION['template_url']; ?>tdplayer.swf?moviefile=' + galleryInfo[galleryIndex][3] + '&autoplay=1" type="application/x-shockwave-flash" wmode="opaque" width="400" height="300"></embed></object>');
        videoResize();
        jQuery(this).fadeIn(fadeInTime);
        jQuery('#gallery').delay(fadeDelay2).fadeIn(fadeInTime2);
      } else if(galleryInfo[galleryIndex][2] != '' && galleryInfo[galleryIndex][2] != 'false') {
       jQuery(this).html('<img id="bgimg" alt="' + galleryInfo[galleryIndex][0] + '" />');
   
        jQuery('#bgimg')[0].src = galleryInfo[galleryIndex][2];
        
        if(jQuery.browser.msie){
        	jQuery('#bgimg')[0].src = galleryInfo[galleryIndex][2]+"?rad="+Math.random();
        }
        
        jQuery('#bgimg').load(function(){
        	var orgW = jQuery('#bgimg')[0].width;
          var orgH = jQuery('#bgimg')[0].height;
          if(orgW != 0 && orgH != 0) {
          	var h = jQuery(window).height();
          	var w = jQuery(window).width();
          	var ratioW = w / orgW;
          	var ratioH = h / orgH;
          	if(ratioW > ratioH) {
          		jQuery('#bgimg').css({'height':(w * orgH / orgW), 'width':w});
          	} else {
          		jQuery('#bgimg').css({'height':h, 'width':(h * orgW / orgH)});
          	}
        	}
          jQuery('#bgholder').fadeIn(fadeInTime);
          jQuery('#gallery').delay(fadeDelay2).fadeIn(fadeInTime2);
          backgroundResize();
        });
        
      }
     
    });
  });
}

slideShowRunning = false;

/* diahsow */
function slideShowToggle(){
	if(slideShowRunning==false){
		slideShowInterval = setInterval(slide2next,galleryDiaInterval);
		slideShowRunning = true;
		jQuery('.gallery-slideshow').html('stop');
		jQuery('.gallery-slideshow').removeClass('play');
		jQuery('.gallery-slideshow').addClass('pause');
	}else{
		clearInterval(slideShowInterval);
		slideShowRunning = false;
		jQuery('.gallery-slideshow').html('play');
		jQuery('.gallery-slideshow').removeClass('pause');
		jQuery('.gallery-slideshow').addClass('play');
	}
}

function slide2next(){
	if(galleryIndex < galleryMax-1){
		loadGalleryItem(galleryIndex+1);
		//alert(galleryInfo[galleryIndex+1][3]);
	}else{
		galleryIndex = 0;
		loadGalleryItem(galleryIndex);
	}
}



/* Resize video player to match screen size */
function videoResize() {
  jQuery('#bgholder object').attr('width', jQuery(window).width());
  jQuery('#bgholder object').attr('height', jQuery(window).height());
  jQuery('#bgholder object embed').attr('width', jQuery(window).width());
  jQuery('#bgholder object embed').attr('height', jQuery(window).height());
  //jQuery('#bgholder embed').attr('width', jQuery(window).width());
  //jQuery('#bgholder embed').attr('height', jQuery(window).height());
}

/* Resize iframe to match screen size */
function iframeResize() {
  jQuery('#bgholder iframe').attr('width', jQuery(window).width());
  jQuery('#bgholder iframe').attr('height', jQuery(window).height());
}

jQuery(window).resize(function(){
  jQuery('#gallery-holder').css('width',jQuery(window).width()+'px');
});

jQuery(document).ready(function() {
  /* Set Gallery controls slide in/out */
  setTimeout(function() {
  jQuery('#gallery-holder').css('width',jQuery(window).width()+'px');
    jQuery('#gallery-holder').animate({'height':'290px'}, {queue:false, duration:400, easing:'easeInOutCubic', complete:function() {
    
      jQuery('.gallery-toggle').stop(true, true).animate({'background-position':'left -27px'}, {queue:false, duration:300});
    }});
  }, 800);
  jQuery('.gallery-toggle').click(function() {
    if(jQuery('#gallery-holder').css('height').replace('px', '') > 30) {
      jQuery('#gallery-holder').stop(true, true).animate({'height':'30px'}, {queue:false, duration:400, easing:'easeInOutCubic', complete:function() {
        jQuery('.gallery-toggle').stop(true, true).animate({'background-position':'left 3px'}, {queue:false, duration:500});
      }});
    } else {
      jQuery('#gallery-holder').stop(true, true).animate({'height':'280px'}, {queue:false, duration:500, easing:'easeInOutCubic', complete:function() {
        jQuery('.gallery-toggle').stop(true, true).animate({'background-position':'left -27px'}, {queue:false, duration:500});
      }});
    }
  });
  
  /* Toggle everything */
  jQuery('.gallery-hide-all').click(function() {
    if(jQuery('#gallery-holder').css('z-index') != 2) {
      jQuery('#logo-container').stop(true, true).animate({'top':'-200px', 'opacity':0}, {queue:false, duration:1000});
      jQuery('#header').stop(true, true).animate({'top':'-250px', 'opacity':0}, {queue:false, duration:1000});
      jQuery('#color-menu').stop(true, true).animate({'top':'-250px', 'opacity':0}, {queue:false, duration:1000});
      setTimeout(function() {
        jQuery('#gallery-holder').css({'z-index':2});
        jQuery('#gallery-holder').stop(true, true).animate({'bottom':0, 'height':'30px'}, {queue:false, duration:1000});
      }, 400);
      setTimeout(function() {
        jQuery('#footer-container').stop(true, true).animate({'bottom':'-50px', 'opacity':0}, {queue:false, duration:1000});
      }, 900);
    } else {
      jQuery('#footer-container').stop(true, true).animate({'bottom':0, 'opacity':1}, {queue:false, duration:1000});
      setTimeout(function() {
        jQuery('#gallery-holder').stop(true, true).animate({'bottom':'40px', 'height':'298px'}, {queue:false, duration:1000, complete:function() {
          jQuery('#gallery-holder').css({'z-index':5});
        }});
      }, 400);
      setTimeout(function() {
        jQuery('#header').stop(true, true).animate({'top':0, 'opacity':.8}, {queue:false, duration:1000});
        jQuery('#logo-container').stop(true, true).animate({'top':0, 'opacity':1}, {queue:false, duration:1000});
      	jQuery('#color-menu').stop(true, true).animate({'top':'0px', 'opacity':1}, {queue:false, duration:1000});
      }, 800);
    }
  });
  
  /* Set thumbnail scrollers click and hover */
  jQuery('.gallery-thumbnails-prev').click(function() {
    if(jQuery('.gallery-thumbnails-holder').css('left') != '0px') {
      jQuery('.gallery-thumbnails-holder').stop(true, true).animate({'left':'+=275px'}, {queue:false, duration:800, easing:'easeInOutCubic'});
    }
  });
  jQuery('.gallery-thumbnails-next').click(function() {
    if(jQuery('.gallery-thumbnails-holder').css('left').replace('px', '') > -((Math.ceil(galleryInfo.length/5) - 1) * 270)) {
      jQuery('.gallery-thumbnails-holder').stop(true, true).animate({'left':'-=275px'}, {queue:false, duration:800, easing:'easeInOutCubic'});
    }
  });
  
  /* Set thumbnail hover */
  jQuery('.gallery-thumbnails-holder img').hover(function() {
    jQuery(this).stop(true, true).animate({'opacity':.5}, {queue:false, duration:400});
  }, function() {
    jQuery(this).stop(true, true).animate({'opacity':1}, {queue:false, duration:400});
  });
  
  jQuery(window).resize(backgroundResize);
  jQuery(window).resize(videoResize);
  jQuery(window).resize(iframeResize);
  jQuery('#bgholder').css({'z-index':1});
  videoResize();
  iframeResize();
});