<?php
session_start();
/* Unregister any old session information */
session_unregister('showGrace');
session_unregister('slideTime');
session_unregister('slideW');
session_unregister('slideH');
session_unregister('showSlides');
session_unregister('showTimer');
session_unregister('slideInfo');
$_SESSION['template_url'] =  get_bloginfo('template_url') . '/';
$_SESSION['read_more'] =  trnslt('read more');
$_SESSION['showGrace'] = get_post_meta($post->ID, '_grace-showGrace', true);
$video = '';
if(!$_SESSION['showGrace']) { $_SESSION['showGrace'] = 'false'; }

/* Fill session with Grace slider options */
if($_SESSION['showGrace'] == 'slides') {
  $_SESSION['slideTime'] = get_post_meta($post->ID, '_grace-slideTime', true);
  if(!$_SESSION['slideTime']) { $_SESSION['slideTime'] = 7500; }
  $_SESSION['slideW'] = get_post_meta($post->ID, '_grace-slideW', true);
  if(!$_SESSION['slideW']) { $_SESSION['slideW'] = 960; }
  $_SESSION['slideH'] = get_post_meta($post->ID, '_grace-slideH', true);
  if(!$_SESSION['slideH']) { $_SESSION['slideH'] = 400; }
  $_SESSION['showSlides'] = get_post_meta($post->ID, '_grace-showSlides', true);
  if(!$_SESSION['showSlides']) { $_SESSION['showSlides'] = 'false'; }
  $_SESSION['showTimer'] = get_post_meta($post->ID, '_grace-showTimer', true);
  if(!$_SESSION['showTimer']) { $_SESSION['showTimer'] = 'false'; }
  
  $_SESSION['slideInfo'] = array();
  for($i = 1; get_post_meta($post->ID, '_grace-type_' . $i, true); $i++) {
    $type = get_post_meta($post->ID, '_grace-type_' . $i, true);
    $img = get_post_meta($post->ID, '_grace-img_' . $i, true);
    $img = makePathAbsolute($img);
    $nr = get_post_meta($post->ID, '_grace-nr_' . $i, true);
    if($type == 'fade' || trim($nr) == '') { $nr = 1; }
    $delay = get_post_meta($post->ID, '_grace-delay_' . $i, true);
    $time = get_post_meta($post->ID, '_grace-time_' . $i, true);
    $easing = get_post_meta($post->ID, '_grace-easing_' . $i, true);
    $invert = get_post_meta($post->ID, '_grace-invert_' . $i, true);
    $direction = ($type == 'horizontal') ? get_post_meta($post->ID, '_grace-directiony_' . $i, true) : ($type == 'vertical') ? get_post_meta($post->ID, '_grace-directionx_' . $i, true) : '';
    $fade = get_post_meta($post->ID, '_grace-fade_' . $i, true);
    $title = get_post_meta($post->ID, '_grace-title_' . $i, true);
    $text = get_post_meta($post->ID, '_grace-text_' . $i, true);
    $text = nl2br($text);
    $text = preg_replace('/[\n\r]/', '', $text); 
    $link = get_post_meta($post->ID, '_grace-link_' . $i, true);
    if(trim($img) != '') {
    $_SESSION['slideInfo'][] = "'" . $type . "', '" . $img . "', " . $nr . ", " . $delay . ", " . $time . ", '" . $easing . "', " . $invert . ", '" . $direction . "', " . $fade . ", '" . $title . "', '" . $text . "', '" . $link . "'";
    }
  }
/* Get Grace video options */
} elseif($_SESSION['showGrace'] == 'video') {
  $_SESSION['slideW'] = get_post_meta($post->ID, '_grace-videoW', true);
  $_SESSION['slideH'] = get_post_meta($post->ID, '_grace-videoH', true);
  $vimeo = get_post_meta($post->ID, '_grace-vimeo', true);
  $youtube = get_post_meta($post->ID, '_grace-youtube', true);
  $custom = get_post_meta($post->ID, '_grace-custom', true);
  $autoplay = (get_post_meta($post->ID, '_grace-autoplay', true) == 'true') ? 'autoplay=1' : '';
  $_autoplay = ($autoplay == 'autoplay=1' ) ? 1 : 0;
  if(trim($vimeo) != '') {
    $video = '<object width="' . $_SESSION['slideW'] . '" height="' . $_SESSION['slideH'] . '"><param name="allowfullscreen" value="true" /><param name="allowscriptaccess" value="always" /><param name="movie" value="http://vimeo.com/moogaloop.swf?clip_id=' . $vimeo . '&' . $autoplay . '" /><param name="wmode" value="opaque"></param><embed src="http://vimeo.com/moogaloop.swf?clip_id=' . $vimeo . '&' . $autoplay . '" type="application/x-shockwave-flash" allowfullscreen="true" allowscriptaccess="always" wmode="opaque" width="' . $_SESSION['slideW'] . '" height="' . $_SESSION['slideH'] . '"></embed></object>';
  } elseif(trim($youtube) != '') {
    $video = '<object width="' . $_SESSION['slideW'] . '" height="' . $_SESSION['slideH'] . '"><param name="movie" value="http://www.youtube.com/v/' . $youtube . '?' . $autoplay . '&amp;fs=1&amp;hl=en_US&amp;hd=1"></param><param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param><param name="wmode" value="opaque"></param><embed src="http://www.youtube.com/v/' . $youtube . '?' . $autoplay . '&amp;fs=1&amp;hl=en_US&amp;hd=1" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" wmode="opaque" width="' . $_SESSION['slideW'] . '" height="' . $_SESSION['slideH'] . '"></embed></object>';
  } else {
	  $themeDir = get_bloginfo('template_url');
    $video = '<object data="'.$themeDir.'/tdplayer.swf"  type="application/x-shockwave-flash"  width="' . $_SESSION['slideW'] . '" height="' . $_SESSION['slideH'] . '">
    			<param name="movie" value="' . get_bloginfo('template_url') . '/tdplayer.swf?moviefile=' . $custom . '&' . $autoplay . '" />
				<param value="'.$custom.'" name="moviefile"/>
    			<param name="wmode" value="opaque"/>
				<param value="'.$_autoplay.'" name="autoplay"/>
				<param value="moviefile='.$custom.'&'.$autoplay.'&wmode=transparent" name="flashvars"/>
    			<embed src="' . get_bloginfo('template_url') . '/tdplayer.swf?moviefile=' . $custom . '&' . $autoplay . '" type="application/x-shockwave-flash" wmode="opaque" width="' . $_SESSION['slideW'] . '" height="' . $_SESSION['slideH'] . '"></embed>
    			</object>
    			
    			';/*
	  $video = "<object data='$themeDir/tdplayer.swf' type='application/x-shockwave-flash' width='{$_SESSION['slideW']}' height='{$_SESSION['slideH']}'>
	<param value='$custom' name='moviefile'/>
	<param value='0' name='autoplay'/>
	<param value='transparent' name='wmode'/>
	<param value='moviefile=$custom&autoplay=0&wmode=transparent' name='flashvars'/>
</object>";*/
	  /*$video = "
        <object id='grace-video-holder' style='display:block !important;visibility:visible !important;opacity:1 !important;'></object>
        <script type='text/javascript'>
        var params = {};
        var attrs = {};
        var flashvars = {};
        attrs.id = '#grace-video-holder';
        flashvars.moviefile = encodeURIComponent('$custom');
        flashvars.autoplay = 1;
        flashvars.wmode = 'transparent';
        params.moviefile = encodeURIComponent('$custom');
        params.autoplay = 1;
        params.wmode = 'transparent';
        var swf_file = '{$_SESSION['template_url']}tdplayer.swf';
        swfobject.embedSWF(swf_file, 'grace-video-holder', {$_SESSION['slideW']}, {$_SESSION['slideH']}, '9', false, flashvars, params, attrs);
        </script>
	  ";*/
  }
}
?>