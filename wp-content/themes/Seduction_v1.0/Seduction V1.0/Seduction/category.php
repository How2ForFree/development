<?php
session_start();
/* IF CURRENT CATEGORY IS SELECTED FOR THE FS GALLERY, INCLUDE GALLERY.PHP */
$galleryCategories = get_option('_screen-galleryCategories');
$galleryCategories = explode(';', $galleryCategories);
if(is_category($galleryCategories)) {
require_once(TEMPLATEPATH . '/gallery.php');
exit();
}
/* TO MAKE SURE THE FOOTER INCLUDE KNOWS THIS IS A CATEGORY (the is_category() FUNCTION ALWEAYS RETURNS FALSE IN THE FOOTER...) */
$_SESSION['isCategory'] = true;
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7"/>
<?php require_once(TEMPLATEPATH . '/head.php'); ?>
</head>

<?php
/* GET CONTENT COLOR */
$contentColor = get_option('_screen-contentColor');

$contentColor = ($contentColor !== false) ? ' style="background:#' . $contentColor . ';"' : '';
?>

<?php
/* GET SLOGAN COLOR */
$payoffColor = get_option('_screen-payoffColor');

$payoffColor = ($payoffColor !== false) ? ' style="background:#' . $payoffColor . ';"' : '';

?>

<?php
/* GET BLOG FRAME COLOR */
$blogframeColor = get_option('_screen-blogframeColor');

$blogframeColor = ($blogframeColor !== false) ? ' style="background:#' . $blogframeColor . ';"' : '';

?>

<body>
<div id="container">
<div id="content"<?php echo $contentColor ?>>
<?php
for($i = 1; have_posts(); $i++) { the_post();
/* Get class for chosen number of columns */
$columns = get_option('_screen-category-layout');
$class = 'one-third';
$class = ($columns == 1) ? 'one-whole' : $class;
$class = ($columns == 2) ? 'one-half' : $class;
$class .= ($i % $columns == 0) ? ' last' : '';
?>

<div class="<?php echo $class; ?> blog">
<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
<div class="blogmeta"><?php the_author_link(); ?> | <?php echo get_the_date(); ?> | <a href="<?php the_permalink(); ?>#comments"><?php comments_number(trnslt('no comments'), '1 ' . trnslt('comment'), '% ' . trnslt('comments')); ?></a></div>
<?php
/* Get and resize first post image  */
$img = get_first_image();
if($img != '') {
$w = 275;
$w = ($columns == 1) ? 892 : $w;
$w = ($columns == 2) ? 432 : $w;
$h = 100;
$h = ($columns == 1) ? 300 : $h;
$h = ($columns == 2) ? 150 : $h;
echo '<a href="' . get_permalink() . '" class="hoverimg"><img src="' . get_bloginfo('template_url') . '/img.php?f=' . $img . '&w=' . $w . '&h=' . $h . '&a=c" alt="' . get_the_title() . '" /></a><div '.$blogframeColor.'class="blogshadow' . $columns . '"></div>';
} else {
echo '<p></p>';
}
?>
<p><?php
/* Shorten post content to 250 characters */
//echo shorten(str_replace(']]>', ']]&gt;', apply_filters('the_content', get_the_content())), 250);
?>
<?php
$text = get_the_content();
if($img != '') {
$text = preg_replace('/<img (.*)>/', '', $text, 1);
}
$_text = teamDutchShortcodeConverter(str_replace(']]>', ']]&gt;', apply_filters('the_content', stripslashes_deep($text))));
if(intval(get_option('rss_use_excerpt')) == 1 && strpos($_text, '</script>') === false && strpos($_text, "<a rel='lightbox_video'") === false) {
echo shorten($_text, 250);
} else {
echo $_text;
}
?>
</p>
<div class="blogdivider<?php echo $columns; ?>"></div>
<div class="readmore"><a href="<?php the_permalink(); ?>"><?php echo trnslt('read more'); ?> &raquo;</a></div>
</div>
<?php
}
?>
<div class="floatfix"></div>
<div class="postnavigation"><?php previous_posts_link(); ?></div>
<div class="postnavigation alignright"><?php next_posts_link(); ?></div>
<div class="floatfix"></div>
</div>
</div>
</div>
<div id="content-s"></div>
</div>
<?php get_header(); ?>
<?php get_footer(); ?>
</body>
</html>