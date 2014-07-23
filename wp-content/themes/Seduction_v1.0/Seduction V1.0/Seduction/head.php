<?php
/* GET SEO MODULE FIELDS */
$seoTitle = get_post_meta($post->ID, '_screen-seo-title', true);
$seoDescription = get_post_meta($post->ID, '_screen-seo-description', true);
$seoKeywords = get_post_meta($post->ID, '_screen-seo-keywords', true);

wp_deregister_script('jquery');
wp_register_script('jquery', ("http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"), false, '1.4.2');
wp_enqueue_script('jquery');
?>
<title><?php
/* DISPLAY SEO TITLE IF SET, ELSE DISPLAY DEFAULT WP STYLE TITLE */
if($seoTitle !== false && trim($seoTitle) != '') {
echo $seoTitle;
} else {
bloginfo('name') . wp_title();
}
?></title>
<?php
/* DISPLAY SEO DESCRIPTION IF SET */
if($seoDescription !== false && trim($seoDescription) != '') {
echo '<meta name="description" content="' . $seoDescription . '" />
';
}
/* DISPLAY SEO KEYWORDS IF SET */
if($seoKeywords) {
echo '<meta name="keywords" content="' . $seoKeywords . '" />
';
}
$fontType = get_option('_screen-cufonFont');
?>
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/fonts/<?php echo $fontType  ? $fontType  : 'Museo';?>/stylesheet.css"  type="text/css" media="screen" />
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
<!--[if IE]>
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/ie.css" type="text/css" media="screen" />
<![endif]-->
<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="alternate" type="text/xml" title="RSS .92" href="<?php bloginfo('rss_url'); ?>" />
<link rel="alternate" type="application/atom+xml" title="Atom 0.3" href="<?php bloginfo('atom_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<?php
/* DISPLAY FAVICON IF SET */
$favicon = get_option('_screen-favicon');
if($favicon !== false && trim($favicon) != '') {
?>
<link rel="shortcut icon" href="<?php echo $favicon; ?>" type="image/x-icon" />
<link rel="icon" href="<?php echo $favicon; ?>" type="image/x-icon" />
<?php
}
?>
<?php wp_get_archives('type=monthly&format=link'); ?>
<?php wp_head(); ?>
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/colorbox.css" type="text/css" media="screen" />
<?php include_once(TEMPLATEPATH . '/colors.php'); ?>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/jquery-1.4.2.min.js"></script>
<script type="text/javascript">
	$.noConflict();	
</script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/swfobject/swfobject.js"></script>
<script type='text/javascript' src='<?php bloginfo('template_url'); ?>/js/jquery.colorbox-min.js'></script>
<script type='text/javascript' src='<?php bloginfo('template_url'); ?>/js/gl/galleria.js'></script>
<script type="text/javascript">Galleria.loadTheme('<?php bloginfo('template_url'); ?>/js/gl/themes/classic/galleria.classic.js');</script>
<script type="text/javascript">var themeDir = '<?php bloginfo('template_url'); ?>';</script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/lightbox.js"></script>