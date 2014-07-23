<?php
/**
 * The Header for our theme.
 */
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<title>
<?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 * We filter the output of wp_title() a bit -- see
	 * twentyten_filter_wp_title() in functions.php.
	 */
	wp_title( '|', true, 'right' );

	?>
</title>
<?php
	/* We add some JavaScript to pages with the comment form
	 * to support sites with threaded comments (when in use).
	 */
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	/* Always have wp_head() just before the closing </head>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to add elements to <head> such
	 * as styles, scripts, and meta tags.
	 */ 
	 
	wp_head();
?>
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/style/css/<?php echo get_option('of_alt_stylesheet'); ?>.css" media="screen" />
<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/style/css/zoombox.css" media="screen" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<!--[if IE 7]>
<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/style/css/ie7.css" media="all" />
<![endif]-->
<!--[if IE 8]>
<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/style/css/ie8.css" media="all" />
<![endif]-->
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/style/js/ddsmoothmenu.js?ver=3.0.3"></script>
<script type="text/javascript">
$(document).ready(function(){
zoombox.FLVPlayer = "<?php bloginfo('template_url'); ?>/style/js/zoombox/FLVplayer.swf",   // URL of the FLV Player
zoombox.MP3Player = "<?php bloginfo('template_url'); ?>/style/js/zoombox/MP3player.swf"  // URL of the MP3 Player
});
</script>

<?php if ( has_nav_menu( 'main_nav' ) ) { ?>
<script type="text/javascript">
$(document).ready(function(){
ddsmoothmenu.init({
	mainmenuid: "smoothmenu1" //menu DIV id
	
})
});
</script>
<?php } ?>


<script type="text/javascript">
$(function() {
			if ($('#faded').length) {
			jQuery('#faded').cycle({
				fx: 'fade',
				timeout:         <?php if ( get_option('of_slider_timeout') !='' ) {?><?php echo get_option('of_slider_timeout'); ?><?php } else {?>4000<?php }?>,  // milliseconds between slide transitions (0 to disable auto advance)
				speed: <?php if ( get_option('of_slider_speed') !='' ) {?><?php echo get_option('of_slider_speed'); ?><?php } else {?>1000<?php }?>,  // speed of the transition 
				pause:           <?php if ( get_option('of_slider_pause') !='' ) {?><?php echo get_option('of_slider_pause'); ?><?php } else {?>1<?php }?>,     // true to enable "pause on hover" 
				pager: '.pagination',
				prev:    '.prev',
        		next:    '.next',
				pagerEvent: 'click',
    			cleartypeNoBg:   true
});
			jQuery('#faded').css("display", "block");
			jQuery('.pagination').css("display", "block");
			}
}); 
</script>

<?php if ( get_option('of_custom_css') !='' ) {?>
<style type="text/css">
<?php echo get_option('of_custom_css'); ?>
</style>
<?php }?>
</head>

<body <?php body_class(); ?>>
<!-- Begin Header -->
<div id="header"> 
  <!-- Begin Logo -->
  <div id="logo"><a href="<?php bloginfo( 'url' ); ?>"><img src="<?php if ( get_option('of_logo') !='' ) {?><?php echo get_option('of_logo'); ?><?php } else {?><?php bloginfo('template_url'); ?>/style/images/logo.png<?php }?>" alt="<?php bloginfo('name'); ?>" /></a></div>
  <!-- End Logo --> 
  <!-- Begin Menu -->
  <div id="menu">
    <div id="smoothmenu1" class="ddsmoothmenu">
      <?php fadelicious_nav(); ?>
      <span></span></div>
  </div>
  <div class="clearfix"></div>
</div>
<!-- End Menu --> 
<!-- End Header -->