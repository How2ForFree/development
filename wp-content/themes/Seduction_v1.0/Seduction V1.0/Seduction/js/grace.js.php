<?php
session_start();
?>
var slideInfo = [
  <?php
  $comma = '';
  foreach($_SESSION['slideInfo'] AS $s) {
    echo $comma . '[' . $s . ']';
    $comma = ', ';
  } ?>
];
var slideTime = <?php echo $_SESSION['slideTime']; ?>;
var slideW = <?php echo $_SESSION['slideW']; ?>;
var slideH = <?php echo $_SESSION['slideH']; ?>;
var showSlides = '<?php echo $_SESSION['showSlides']; ?>';
var showTimer = <?php echo $_SESSION['showTimer']; ?>;
var slideIndex = 0;
var mainSlideTimeout = 0;

/* Display text overlay */
function placeOverlay() {
  if(jQuery('#grace-textoverlay').length == 0) { jQuery('#grace-holder').append('<div id="grace-textoverlay"></div>'); }
  var div = '<div>';
  var overlayH = 75;
  var titleTopMargin = 0;
  if(slideInfo[slideIndex][9] != '') {
    div += '<strong>' + slideInfo[slideIndex][9] + '</strong>';
  }
  if(slideInfo[slideIndex][10] != '') {
    div += '<p>' + slideInfo[slideIndex][10] + '</p>';
    overlayH += 50;
  } else {
    titleTopMargin = 20;
  }
  if(slideInfo[slideIndex][11] != '') {
    div += '<span><a href="' + slideInfo[slideIndex][11] + '"><?php echo $_SESSION['read_more']; ?> &raquo;</a></span>';
  }
  div += '</div>';
  jQuery('#grace-textoverlay').append(div);
  jQuery('#grace-textoverlay').css({'background':'url("<?php echo $_SESSION['template_url']; ?>images/grace/textoverlay.png")', 'position':'absolute', 'top':slideH + 'px', 'left':'0px', 'height':(overlayH + 70) + 'px', 'width': slideW + 'px', 'z-index':2});
  jQuery('#grace-textoverlay div').css({'width':(slideW / 2) + 'px', 'float':'right', 'margin':'15px 25px'});
  jQuery('#grace-textoverlay div strong').css({'color':'#fff', 'font-size':'16px', 'line-height':'18px', 'font-weight':'normal', 'letter-spacing':'.5px', 'margin':titleTopMargin + ' 0 5px 0', 'display':'block'});
  jQuery('#grace-textoverlay div p').css({'color':'#eee', 'font-size':'11px', 'text-align':'justify', 'line-height':'16px', 'margin':0});
  jQuery('#grace-textoverlay div span').css({'width':(slideW / 2) + 'px'});
  jQuery('#grace-textoverlay div a').css({'color':'#ccc', 'font-size':'11px', 'float':'right', 'text-decoration':'none'});
  jQuery('#grace-textoverlay div a').hover(function() {
    jQuery(this).css({'color':'#eee', 'text-decoration':'underline'});
  }, function() {
    jQuery(this).css({'color':'#ccc', 'text-decoration':'none'});
  });
  jQuery('#grace-textoverlay').animate({'top':(slideH - overlayH) + 'px'}, {queue:false, duration:300, easing:'easeOutBack'});
  if(slideInfo.length > 1) { setTimeout(function() { removeOverlay(); }, (slideTime - 400)); }
}

/* Fade out text overlay */
function removeOverlay() {
  jQuery('#grace-textoverlay').animate({top:slideH + 'px', opacity:0}, {queue:false, duration:200, easing:'easeInCubic', complete:function() { jQuery('#grace-textoverlay').remove()}});
}

/* Place thumbnails/squares, initiate slides */
function showSlide() {
  switch(showSlides) {
    case 'thumbnails':
      if(jQuery('#grace-thumbnails').length == 0) {
        jQuery('#grace-holder').append('<div id="grace-thumbnails"></div>');
        jQuery('#grace-thumbnails').css({'background':'url("<?php echo $_SESSION['template_url']; ?>images/grace/thumbshadow.png") repeat-x left top', 'background-position':'5px 5px', 'position':'absolute', 'top':(slideH - 50) + 'px', 'left':'6px', 'height':'40px', 'width':(slideInfo.length * 40) + 'px', 'z-index':3});  
        for(var i = 0; i < slideInfo.length; i++) {
          jQuery('#grace-thumbnails').append('<img src="<?php echo $_SESSION['template_url']; ?>img.php?f=' + slideInfo[i][1] + '&w=30&h=30&a=c" id="grace-thumb_' + (i + 1) + '" />');
          jQuery('#grace-thumb_' + (i + 1)).css({'float':'left', 'margin':'5px', 'cursor':'pointer', 'opacity':0});
          jQuery('#grace-thumb_' + (i + 1)).hover(function() {
            jQuery(this).css({'border':'2px solid #fff', 'margin':'3px', 'opacity':1});
          }, function() {
            jQuery(this).css({'border':'none', 'margin':'5px', 'opacity':.3});
            if(jQuery(this).attr('id').split('_')[1] == slideIndex) { 
              jQuery(this).css({'opacity':1});
            }
          });
          jQuery('#grace-thumb_' + (i + 1)).click(function() {
            if(showTimer) { jQuery('#grace-timer').stop(true, true).fadeOut().remove(); }
            setTimeout(removeOverlay, 200);
            clearTimeout(mainSlideTimeout);
            var j = slideIndex - 1;
            if(j < 0) {
              j = slideInfo.length - 1;
            }
            for(var i = 1; i <= slideInfo[j][2]; i++) {
              jQuery('#grace-slide_' + i).stop(true, true).fadeOut().remove();
            }
            slideIndex = this.id.split('_')[1] - 1;
            showSlide();
          });
        }
      }
      for(var i = 0; i < slideInfo.length; i++) {
        jQuery('#grace-thumb_' + (i + 1)).stop(true, true);
        jQuery('#grace-thumb_' + (i + 1)).animate({opacity:(i == slideIndex) ? 1 : .3}, {queue:false, duration:300, easing:'easeInExpo'});
      }
      break;
    case 'squares':
      if(jQuery('#grace-squares').length == 0) {
        jQuery('#grace-holder').append('<div id="grace-squares"></div>');
        jQuery('#grace-squares').css({'background':'url("<?php echo $_SESSION['template_url']; ?>images/grace/squareshadow.png") repeat-x left top', 'background-position':'5px 5px', 'position':'absolute', 'top':(slideH - 30) + 'px', 'left':'6px', 'height':'20px', 'width':(slideInfo.length * 20) + 'px', 'z-index':8});  
        for(var i = 1; i <= slideInfo.length; i++) {
          jQuery('#grace-squares').append('<div id="grace-square_' + i + '"></div>');
          jQuery('#grace-square_' + i).css({'background':'#fff', 'float':'left', 'margin':'5px', 'cursor':'pointer', 'opacity':0, 'width':'10px', 'height':'10px'});
          jQuery('#grace-square_' + i).hover(function() {
            jQuery(this).css({'opacity':.8, 'border':'1px solid #222', 'margin':'4px'});
          }, function() {
            jQuery(this).css({'opacity':.3, 'border':'none', 'margin':'5px'});
            if(jQuery(this).attr('id').split('_')[1] == slideIndex) { 
              jQuery(this).css({'opacity':.8});
            }
          });
          jQuery('#grace-square_' + i).click(function() {
            if(showTimer) { jQuery('#grace-timer').stop(true, true).fadeOut().remove(); }
            setTimeout(removeOverlay, 200);
            clearTimeout(mainSlideTimeout);
            var j = slideIndex - 1;
            if(j < 0) {
              j = slideInfo.length - 1;
            }
            for(var k = 1; k <= slideInfo[j][2]; k++) {
              jQuery('#grace-slide_' + k).stop(true, true).fadeOut().remove();
            }
            slideIndex = this.id.split('_')[1] - 1;
            showSlide();
          });
        }
      }
      for(var i = 0; i < slideInfo.length; i++) {
        jQuery('#grace-square_' + (i + 1)).stop(true, true);
        jQuery('#grace-square_' + (i + 1)).animate({opacity:(i == slideIndex) ? .8 : .3}, {queue:false, duration:300, easing:'easeInExpo'});
      }
      break;
  }
  if(showTimer) { jQuery('#grace-timer').fadeOut(200); }
  switch(slideInfo[slideIndex][0]) {
    case 'vertical':
      showVerticalSlide();
      break;
    case 'horizontal':
      showHorizontalSlide();
      break;
    default:
      jQuery('#grace-holder').append('<div id="grace-slide_1"></div>');
      jQuery('#grace-slide_1').css({'background':'url("' + slideInfo[slideIndex][1] + '") no-repeat 0px 0px', 'left':'0px', 'position':'absolute', 'top':'0px', 'height':slideH + 'px', 'width':slideW + 'px', 'opacity':0});
      jQuery('#grace-slide_1').animate({'opacity':1}, {queue:false, duration:slideInfo[slideIndex][4], easing:slideInfo[slideIndex][5], complete:makeWhole});
      break;
  }
}

/* Set next slide timeout */
function nextSlide() {
  slideIndex++;
  if(slideIndex >= slideInfo.length) {
    slideIndex = 0;
  }
  mainSlideTimeout = setTimeout(showSlide, slideTime);
}

/* Place whole image and remove slices */
function makeWhole() {
  if(slideInfo[slideIndex][9] || slideInfo[slideIndex][10]) { placeOverlay(); }
  if(jQuery('#grace-slide_whole').length == 0) { jQuery('#grace-holder').append('<div id="grace-slide_whole"></div>'); }
  jQuery('#grace-slide_whole').css({'background':'url("' + slideInfo[slideIndex][1] + '") no-repeat', 'left':'0px', 'position':'absolute', 'top':'0px', 'height':slideH + 'px', 'width':slideW + 'px', 'float':'left'});
  for(var i = 1; i <= slideInfo[slideIndex][2]; i++) {
    jQuery('#grace-slide_' + i).remove();
  }
  if(slideInfo.length > 1) {
    if(showTimer) {
      if(jQuery('#grace-timer').length == 0) { jQuery('#grace-holder').append('<div id="grace-timer"></div>'); }
      jQuery('#grace-timer').css({'background':'#eee', 'position':'absolute', 'top':(slideH - 3) + 'px', 'left':'0px', 'height':'2px', 'width':'1px', 'border-top':'1px solid #999', 'opacity':.4, 'z-index':3});
      jQuery('#grace-timer').animate({'width':slideW + 'px'}, {queue:false, duration:slideTime, easing:'linear'});
    }
    nextSlide();
  }
}

/* Animate vertical slide */
function verticalSlide(i, top, d, s, last) {
  var f = (slideInfo[slideIndex][8]) ? 0 : 1;
  var j = i - 1;
  jQuery('#grace-holder').append('<div id="grace-slide_' + i + '"></div>');
  jQuery('#grace-slide_' + i).css({'background':'url("' + slideInfo[slideIndex][1] + '") no-repeat -' + (s * j) + 'px 0px', 'left':(s * j) + 'px', 'position':'absolute', 'top':top + 'px', 'height':slideH + 'px', 'width':s + 'px', 'float':'left', 'opacity':f});
  if(last) {
    jQuery('#grace-slide_' + i).delay(d).animate({'top':'0px', 'opacity':1, 'background-position':'-' + (s * j) + 'px 0px'}, {queue:true, duration:slideInfo[slideIndex][4], easing:slideInfo[slideIndex][5], complete:makeWhole});
  } else {
    jQuery('#grace-slide_' + i).delay(d).animate({'top':'0px', 'opacity':1, 'background-position':'-' + (s * j) + 'px 0px'}, {queue:true, duration:slideInfo[slideIndex][4], easing:slideInfo[slideIndex][5]});
  }
}

/* Place vertical slides */
function showVerticalSlide() {
  var nr = slideInfo[slideIndex][2];
  var s = Math.ceil(slideW / nr);
  var d = slideInfo[slideIndex][3];
  var top = (slideInfo[slideIndex][6]) ? slideH : -slideH;
  switch(slideInfo[slideIndex][7]) {
    case 'fromleft':
      for(var i = 1; i <= nr; i++) {
        var last = (i == nr) ? true : false;
        verticalSlide(i, top, i * d, s, last);
      }
      break;
    case 'fromright':
      for(var i = nr; i > 0; i--) {
        var last = (i == 1) ? true : false;
        verticalSlide(i, top, (nr * d) - (i * d), s, last);
      }
      break;
    case 'frommiddle':
      for(var i = Math.round(nr / 2); i > 0; i--) {
        verticalSlide(i, top, (nr / 2 * d) - (i * d), s, false);
      }
      for(var i = Math.round(nr / 2) + 1; i <= nr; i++) {
        var last = (i == nr) ? true : false;
        verticalSlide(i, top, ((i-1) * d) - (nr / 2 * d), s, last);
      }
      break;
    case 'tomiddle':
      for(var i = nr; i > Math.round(nr / 2); i--) {
        verticalSlide(i, top, (nr * d) - (i * d), s, false);
      }
      for(var i = 1; i <= Math.round(nr / 2); i++) {
        var last = (i == Math.round(nr / 2)) ? true : false;
        verticalSlide(i, top, (i - 1) * d, s, last);
      }
      break;
    case 'random':
      var nrs = [];
      for(var i = 1; i <= nr; i++) {
        nrs[i-1] = i;
      }
      nrs.sort(function() { return Math.round(Math.random())-0.5; } );
      nrs.sort(function() { return Math.round(Math.random())-0.5; } );
      for(var j = 0; j < nrs.length; j++) {
        var i = nrs[j];
        var last = (j == nrs.length - 1) ? true : false;
        verticalSlide(i, top, j * d, s, last);
      }
      break;
    default:
      for(var i = 1; i <= nr; i++) {
        var last = (i == nr) ? true : false;
        verticalSlide(i, top, i * d, s, last);
      }
      break;
  }
}

/* Animate horizontal slice */
function horizontalSlide(i, left, d, s, last) {
  var f = (slideInfo[slideIndex][8]) ? 0 : 1;
  var j = i - 1;
  jQuery('#grace-holder').append('<div id="grace-slide_' + i + '"></div>');
  jQuery('#grace-slide_' + i).css({'background':'url("' + slideInfo[slideIndex][1] + '")', 'left':left + 'px', 'background-position':'0px -' + (s * j) + 'px', 'position':'absolute', 'top':(s * j) + 'px', 'height':s + 'px', 'width':slideW + 'px', 'float':'left', 'opacity':f});
  if(last) {
    jQuery('#grace-slide_' + i).delay(d).animate({'left':'0px', 'opacity':1, 'background-position':'0px -' + (s * j) + 'px'}, {queue:true, duration:slideInfo[slideIndex][4], easing:slideInfo[slideIndex][5], complete:makeWhole});
  } else {
    jQuery('#grace-slide_' + i).delay(d).animate({'left':'0px', 'opacity':1, 'background-position':'0px -' + (s * j) + 'px'}, {queue:true, duration:slideInfo[slideIndex][4], easing:slideInfo[slideIndex][5]});
  }
}

/* Place horizontal slices */
function showHorizontalSlide() {
  var nr = slideInfo[slideIndex][2];
  var s = Math.ceil(slideH / nr);
  var d = slideInfo[slideIndex][3];
  var left = (slideInfo[slideIndex][6]) ? slideW : -slideW; 
  switch(slideInfo[slideIndex][7]) {
    case 'fromtop':
      for(var i = 1; i <= nr; i++) {
        var last = (i >= nr) ? true : false;
        horizontalSlide(i, left, i * d, s, last);
      }
      break;
    case 'frombottom':
      for(var i = nr; i > 0; i--) {
        var last = (i == 1) ? true : false;
        horizontalSlide(i, left, (nr * d) - (i * d), s, last);
      }
      break;
    case 'frommiddle':
      for(var i = Math.round(nr / 2); i > 0; i--) {
        horizontalSlide(i, left, (nr / 2 * d) - (i * d), s, false);
      }
      for(var i = Math.round(nr / 2) + 1; i <= nr; i++) {
        var last = (i >= nr) ? true : false;
        horizontalSlide(i, left, (i * d) - (nr / 2 * d), s, last);
      }
      break;
    case 'tomiddle':
      for(var i = nr; i > Math.round(nr / 2); i--) {
        horizontalSlide(i, left, (nr * d) - (i * d), s, false);
      }
      for(var i = 1; i <= Math.round(nr / 2); i++) {
        var last = (i >= Math.round(nr / 2)) ? true : false;
        horizontalSlide(i, left, i * d, s, last);
      }
      break;
    case 'random':
      var nrs = [];
      for(var i = 1; i <= nr; i++) {
        nrs[i-1] = i;
      }
      nrs.sort(function() { return Math.round(Math.random())-0.5; } );
      nrs.sort(function() { return Math.round(Math.random())-0.5; } );
      for(var j = 0; j < nrs.length; j++) {
        var i = nrs[j];
        var last = (j == nrs.length - 1) ? true : false;
        horizontalSlide(i, left, j * d, s, last);
      }
      break;
    default:
      for(var i = 1; i <= nr; i++) {
        var last = (i >= nr) ? true : false;
        horizontalSlide(i, left, i * d, s, last);
      }
      break;
  }
}
jQuery(document).ready(function() {
  for(var i = 0; i < slideInfo.length; i++) {
    var imgObj = new Image();
    imgObj.src = slideInfo[i][1];
  }
  mainSlideTimeout = setTimeout(showSlide, 400);
});