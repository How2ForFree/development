<div id="mainheader">
<div id="logo-container">
<div id="logo">
<div>
<?php
/* CHECK DISPLAY: LOGO IMAGE, LOGO TEXT OR DEFAULT WP BLOG TITEL */
$logoImg = get_option('_screen-logo-img');
$logoText = get_option('_screen-logo-text');
if(trim($logoText) == '') { $logoText = get_bloginfo('name'); }
if(trim($logoImg) != '') {
$logoImg = makePathAbsolute($logoImg);
?>
<a href="<?php bloginfo('url'); ?>"><img src="<?php echo $logoImg; ?>" alt="<?php echo $logoText; ?>" title="" /></a>
<?php
} elseif($logoText != get_bloginfo('name')) {
?>
<a href="<?php bloginfo('url'); ?>"><p style="margin:45px 0 0 0;"><?php echo $logoText; ?></p></a>
<?php
} else {
?>
<a href="<?php bloginfo('url'); ?>"><p><?php bloginfo('name'); ?></p><span><?php bloginfo('description'); ?></span></a>
<?php
}
?>
</div>
</div>
</div> 
<?php
/* GET SEDUCTION HEADER COLOR */
$headerColor = get_option('_screen-headerColor');

$headerColor = ($headerColor !== false) ? ' style="background:#' . $headerColor . ';"' : '';
?>

<div id="header">
<div id="header-container">
<?php
/* DISPLAY WP MENU */
$menuwalker = new ThemeDutchMenuWalker;
wp_nav_menu(array('theme_location' => 'screen-main-menu', 'container_class' => 'menu', 'depth' => 2, 'walker' => $menuwalker, 'fallback_cb' => 'oldSchoolWordpressMenu'));
?>      
</div>
</div>
</div>
<div id="color-menu"<?php echo $headerColor ?>></div>



  