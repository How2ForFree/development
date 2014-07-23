<?php
/* CHECK WHICH BACKGROUND / FOOTER MENU SHOULD BE PLACED */
if(isset($_SESSION['isCategory'])) {
session_unregister('isCategory');
$footermenu = get_option('_screen-category-footermenu');
$bgType = get_option('_screen-category-bgType');
$bgImg = get_option('_screen-category-bgImg');
} elseif($post->ID && !is_home()) {
$footermenu = get_post_meta($post->ID, '_screen-footermenu', true);
$bgType = get_post_meta($post->ID, '_screen-bgType', true);
$bgImg = get_post_meta($post->ID, '_screen-bgImg', true);
} else {
$footermenu = get_option('_screen-home-footermenu');
$bgType = get_option('_screen-home-bgType');
$bgImg = get_option('_screen-home-bgImg');
$bgVideo = get_option('_screen-category-bgVideo');
}

/* GET COPYRIGHT INFORMATION  */
$copyrightName = get_option('_screen-copyright-name');
if(!copyrightName || trim($copyrightName) == '') {
$copyrightName = 'Theme Dutch';
}
$copyrightLink = get_option('_screen-copyright-link');
if(!copyrightLink || trim($copyrightLink) == '') {
$copyrightLink = 'http://www.theme-dutch.com';
}

/* GET GOOGLE ANALYTICS CODE */
$analytics = get_option('_screen-analytics');
?>
<?php
/* GET FOOTER COLOR */
$footerColor = get_option('_screen-footerColor');

$footerColor = ($footerColor !== false) ? ' style="background:#' . $footerColor . ';"' : '';
?>

<div id="footer-container"<?php echo $footerColor ?>>
<div id="footer">
<?php    
/* INJECT WP MENU INTO THE FOOTER */
if($footermenu != 'false') {
$nav = wp_nav_menu(array('theme_location' => $footermenu, 'container_class' => 'footermenu', 'menu_class' => '', 'depth' => 1, 'echo'=>false));
if( strpos($nav, '<li') === false ) {
$nav = str_replace('</ul>', '<li>&nbsp;</li></ul>', $nav);
}
echo $nav;
}
?>
<div class="footercopyright">
<ul>
<li><a href="<?php echo $copyrightLink; ?>">&copy; <?php echo date('Y') . ' ' . $copyrightName; ?></a></li>
</ul>
</div>

<div id="footer-sociables">
<div id="sociables">
<?php
/* DISPLAY YOUR FAVORITE SOCIABLES */
$facebook = get_option('_screen-facebook');
if($facebook) {
?>
<a href="http://www.facebook.com/<?php echo $facebook; ?>" target="_blank"><img src="<?php bloginfo('template_url'); ?>/images/facebook.png" alt="Facebook" title="Facebook" /></a>
<?php }
$flickr = get_option('_screen-flickr');
if($flickr) {
?>
<a href="http://www.flickr.com/<?php echo $flickr; ?>" target="_blank"><img src="<?php bloginfo('template_url'); ?>/images/flickr.png" alt="Flickr" title="Flickr" /></a>
<?php }
$linkedin = get_option('_screen-linkedin');
if($linkedin) {
?>
<a href="http://www.linkedin.com/in/<?php echo $linkedin; ?>" target="_blank"><img src="<?php bloginfo('template_url'); ?>/images/linkedin.png" alt="LinkedIn" title="LinkedIn" /></a>
<?php }
$rss = get_option('_screen-rss');
if($rss) {
?>
<a href="<?php echo $rss; ?>" target="_blank"><img src="<?php bloginfo('template_url'); ?>/images/rss.png" alt="RSS Feed" title="RSS Feed" /></a>
<?php }
$twitter = get_option('_screen-twitter');
if($twitter) {
?>
<a href="http://www.twitter.com/<?php echo $twitter; ?>" target="_blank"><img src="<?php bloginfo('template_url'); ?>/images/twitter.png" alt="Twitter" title="Twitter" /></a>
<?php }
$youtube = get_option('_screen-youtube');
if($youtube) {
?>
<a href="http://www.youtube.com/<?php echo $youtube; ?>" target="_blank"><img src="<?php bloginfo('template_url'); ?>/images/youtube.png" alt="YouTube" title="YouTube" /></a>
<?php } ?>
</div>
</div>
</div>
</div>
</div>
<?php

/* CHECK WHICH BACKGROUND / FOOTER MENU SHOULD BE PLACED */
if(isset($_SESSION['isGallery'])) {
if($_SESSION['galleryFirst'][3] != '') {
echo '<div id="bgholder" style="display:block;"><iframe src="' . $_SESSION['galleryFirst'][3] . '"></iframe></div>';
} elseif($_SESSION['galleryFirst'][2] != '') {
?>
<div id="bgholder" style="display:block;">
<object id="bgimg" >
</object>
<script type="text/javascript">
var params = {};
var attrs = {};
var flashvars = {};
attrs.id = "#bgimg";
flashvars.moviefile = encodeURIComponent("<?php echo $_SESSION['galleryFirst'][2];?>");
flashvars.autoplay = 1;
flashvars.wmode = "transparent";
params.moviefile = encodeURIComponent("<?php echo $_SESSION['galleryFirst'][2];?>");
params.autoplay = 1;
params.wmode = "transparent";
var swf_file = '<?php echo $_SESSION['template_url']; ?>tdplayer.swf';
//jQuery("#bgholder").html("");
//alert(swf_file);
swfobject.embedSWF(swf_file, "bgimg", jQuery(window).width(), jQuery(window).height(), "9", false, flashvars, params, attrs); 
</script>
</div>
<?php
//echo '<div id="bgholder" style="display:block;"><object id="bgimg" width="1280" height="1024"><param name="movie" value="' . $_SESSION['template_url'] . 'tdplayer.swf?moviefile=' . $_SESSION['galleryFirst'][2] . '&autoplay=1" /><param name="wmode" value="transparent"></param><embed src="' . $_SESSION['template_url'] . 'tdplayer.swf?moviefile=' . $_SESSION['galleryFirst'][2] . '&autoplay=1" type="application/x-shockwave-flash" wmode="transparent" width="1280" height="1024"></embed></object></div>';
} elseif($_SESSION['galleryFirst'][1] != '') {
echo '<div id="bgholder"><img src="' . makePathAbsolute($_SESSION['galleryFirst'][1]) . '" id="bgimg" alt="' . $_SESSION['galleryFirst'][0] . '" /></div>';
}
} else {

/* GET BACKGROUND COLOR */
$backgroundColor = get_option('_screen-backgroundColor');


/* CHECK WHICH BACKGROUND TYPE HAS BEEN CHOSEN */
switch($bgType) {
case 'video':
if(trim($bgImg) != '') {
?>
<div id="bgholder" style="display:block;">
<object id="bgimg" >
</object>
<script type="text/javascript">
var params = {};
var attrs = {};
var flashvars = {};
attrs.id = "#bgimg";
flashvars.moviefile = encodeURIComponent("<?php echo $bgImg; ?>");
flashvars.autoplay = 1;
flashvars.wmode = "transparent";
params.moviefile = encodeURIComponent("<?php echo $bgImg; ?>");
params.autoplay = 1;
params.wmode = "transparent";
var swf_file = '<?php echo $_SESSION['template_url']; ?>tdplayer.swf';
swfobject.embedSWF(swf_file, "bgimg", jQuery(window).width(), jQuery(window).height(), "9.0.0", false, flashvars, params, attrs);

if( jQuery('#container').find('div').length == 0 ) {
jQuery('#bgholder').css('z-index', 1);
} else {
jQuery('#bgholder').css('z-index', -1);
}
</script>
</div>
<?php
}
if (strpos($_SERVER['HTTP_USER_AGENT'], "Firefox") !== false) {
?><script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/gallery.js.php"></script><?php  
}
break;
case 'image':
if(trim($bgImg) != '') {
$bgImg = makePathAbsolute($bgImg);
echo '<div id="bgholder"><img src="' . $bgImg . '" id="bgimg" alt="' . get_post_meta($post->ID, '_screen-seo-imgalt', true) . '" /></div>';
}
break;
case 'dark':
echo '<div id="bgholder" style="background:#333 url(\'' . get_bloginfo('template_url') . '/images/bg-pattern-dark.gif\'); display:block;"></div>';
break;
case 'medium':
echo '<div id="bgholder" style="background:#999 url(\'' . get_bloginfo('template_url') . '/images/bg-pattern-medium.gif\'); display:block;"></div>';
break;
case 'light':
echo '<div id="bgholder" style="background:#eee url(\'' . get_bloginfo('template_url') . '/images/bg-pattern-light.gif\'); display:block;"></div>';
break;
  case 'color':
echo '<div id="bgholder" style="background-color:#' . $backgroundColor . '; display:block;"></div>';
break;
}
}
?>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/functions.js"></script>
<?php
if(isset($_SESSION['isGallery'])) {
session_unregister('isGallery');
?><script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/gallery.js.php"></script><?php
}
/* IF GRACE SLIDER SHOULD BE DISPLAYD */
if($_SESSION['showGrace'] == 'slides') {
?><script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/grace.js.php"></script>
<?php }
if($analytics) { 
echo stripslashes_deep($analytics);
}
?>

<?php wp_footer(); ?>