<?php
/* INCLUDE GRACE FRONTEND*/
if (is_home()) {
	$realPostId = $post->ID;
	$post->ID = 1;
}
include_once('lib/grace_frontend.php');


if (isset($realPostId)) {
	$post->ID = $realPostId;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7"/>
<?php require_once(TEMPLATEPATH . '/head.php'); ?>
</head>
<body>
<div id="container">
<?php
/* CHECK IF GRACE SHOULD BE DISPLAYED */
if ($_SESSION['showGrace'] == 'slides' || $_SESSION['showGrace'] == 'video') {
?>
<div id="grace"
style="width:<?php echo $_SESSION['slideW']; ?>px; height:<?php echo ($_SESSION['slideH'] + 0); ?>px;">
<div id="grace-mask"
style="width:<?php echo $_SESSION['slideW']; ?>px; height:<?php echo $_SESSION['slideH']; ?>px;">
<div id="grace-holder"><?php echo $video; ?></div>
</div>
</div>
<?php
}
/* GET SLOGAN TITEL COLOR */
$payoffColor = get_option('_screen-payoffColor');

$payoffColor = ($payoffColor !== false) ? ' style="background:#' . $payoffColor . ';"' : '';
?>
<?php
/* GET CONTENT COLOR */
$contentColor = get_option('_screen-contentColor');

$contentColor = ($contentColor !== false) ? ' style="background:#' . $contentColor . ';"' : '';
?>

<?php
/* GET BLOG FRAME COLOR */
$blogframeColor = get_option('_screen-blogframeColor');

$blogframeColor = ($blogframeColor !== false) ? ' style="background:#' . $blogframeColor . ';"' : '';

?>

<?php
/* DISPLAY PAGE/POST INFO  */
if (!is_home() && have_posts()) {
the_post();
$payoff = get_post_meta($post->ID, '_screen-payoff', true);
?>
<div id="payoff"<?php echo $payoffColor ?>>
<div id="sloganoverlay">
<h2><?php echo $payoff; ?></h2>
</div>
</div>

<div class="floatfix ie7"></div>
<div id="content"<?php echo $contentColor ?>>
<div class="td-breadcrumb<?php
/* DISPLAY CONTENT ACCORDING TO THE CHOSEN LAYOUT */
switch (get_post_meta($post->ID, '_screen-showSidebar', true)) {
case 'left':
echo ' sidebartop-l';
break;
case 'right':
echo ' sidebartop-r';
break;
}
?>"><span>          
<?php dimox_breadcrumbs() ?>          
</span></div>
<?php
/* GET SIDEBAR */
$sidebar = get_post_meta($post->ID, '_screen-sidebar', true);
/* DISPLAY CONTENT ACCORDING TO THE CHOSEN LAYOUT */
switch (get_post_meta($post->ID, '_screen-showSidebar', true)) {
/* RIGHT SIDEBAR */
case 'right':
?>
<div class="two-thirds-left">
<div class="sidebarmiddle">
<?php if ($post->post_type == 'post'): ?>
<div class="blogmeta">
<?php the_author_link(); ?> | <?php the_date(); ?> | <a href="#comments"><?php comments_number(trnslt('no comments'), '1 ' . trnslt('comment'), '% ' . trnslt('comments')); ?></a>
</div>
<?php endif; ?>
<?php
echo str_replace(']]>', ']]&gt;', apply_filters('the_content', get_the_content()));
require_once(TEMPLATEPATH . '/contact.php');
comments_template();
?>
</div>
<div class="sidebarbottom"></div>
</div>
<div class="one-third-right widgets">
<?php
if (!function_exists("dynamic_sidebar") || !dynamic_sidebar('S: ' . $sidebar)) {  }
echo '</div>';
break;
/* LEFT SIDEBAR */
case 'left':
echo '<div class="one-third-left widgets">';
if (!function_exists("dynamic_sidebar") || !dynamic_sidebar('S: ' . $sidebar)) {  }
?></div>
<div class="two-thirds-right">
<div class="sidebarmiddle">
<?php if ($post->post_type == 'post') { ?>
<div class="blogmeta">
<?php the_author_link(); ?> | <?php the_date(); ?> | <a href="#comments"><?php comments_number(trnslt('no comments'), '1 ' . trnslt('comment'), '% ' . trnslt('comments')); ?></a>
</div>
<?php } ?>
<?php
echo str_replace(']]>', ']]&gt;', apply_filters('the_content', get_the_content()));
require_once(TEMPLATEPATH . '/contact.php');
comments_template();
?>
</div>
<div class="sidebarbottom"></div>
</div><?php
break;
/* FULL WIDH */
default:
if ($post->post_type == 'post') { ?>
<div class="blogmeta">
<?php the_author_link(); ?> | <?php the_date(); ?> | <a href="#comments"><?php comments_number(trnslt('no comments'), '1 ' . trnslt('comment'), '% ' . trnslt('comments')); ?></a>
</div>
<?php } ?>
<?php
echo str_replace(']]>', ']]&gt;', apply_filters('the_content', get_the_content()));
require_once(TEMPLATEPATH . '/contact.php');
comments_template();
break;
}
?>
<div class="floatfix"></div>
<?php
/* DISPLAY FOOTER */
$footersidebar = get_post_meta($post->ID, '_screen-footersidebar', true);
if ($footersidebar !== false && $footersidebar != 'false') {
?>
<div class="divider"></div>
<div class="widgets"><?php
if (!function_exists("dynamic_sidebar") || !dynamic_sidebar('F: ' . $footersidebar)) {
//
}
?></div>
<div class="floatfix"></div><?php
}
?>
</div>

<div id="content-s"></div>
<?php
/* DISPLAY HOME INFORMATION  */
} elseif (is_home()) {
/* GET THE HOME INFORMATION  */
$homeTitle = get_option('_screen-home-title');
$homeText = get_option('_screen-home-text');
if (trim($homeTitle) != '') {
?>
<div id="payoff"<?php echo $payoffColor ?>>
<div id="sloganoverlay">
<h2><?php echo $homeTitle; ?></h2>
</div>
</div>
<?php
}
if (trim($homeText) != ''):
?>
<div id="payoff"<?php echo $payoffColor ?>>
<div id="sloganoverlay">
<h2> <?php echo get_option('_screen-home-payoff'); ?> </h2>
</div>
</div>
<div class="floatfix ie7"></div>
<div id="content"<?php echo $contentColor ?>>
<?php echo teamDutchShortcodeConverter(str_replace(']]>', ']]&gt;', apply_filters('the_content', stripslashes_deep($homeText)))); ?>
<div class="floatfix"></div>
</div>

<div id="content-s"></div>
<?php endif; ?>
<?php if (is_home() && get_option('_disp_blog_post') > -1): ?>
<div id="blog-content"<?php echo $contentColor ?>>
<?php
global $wp_query;
$cat = get_option('_disp_blog_post');
$wp_query->query_vars['cat'] = $cat;
$wp_query->request = "SELECT SQL_CALC_FOUND_ROWS  wp_posts.* FROM wp_posts  INNER JOIN wp_term_relationships ON (wp_posts.ID = wp_term_relationships.object_id) INNER JOIN wp_term_taxonomy ON (wp_term_relationships.term_taxonomy_id = wp_term_taxonomy.term_taxonomy_id)  WHERE 1=1  AND wp_term_taxonomy.taxonomy = 'category' AND wp_term_taxonomy.term_id IN ('$cat') AND wp_posts.post_type = 'post' AND (wp_posts.post_status = 'publish' OR wp_posts.post_status = 'private') GROUP BY wp_posts.ID ORDER BY wp_posts.post_date DESC LIMIT 0, 10";
$wp_query->get_posts();
for ($i = 1; have_posts(); $i++) {
the_post();
/* GET CLASS FOR SELECTED NUMBER OF COLUMNS */
$columns = get_option('_screen-category-layout');
$class = 'one-third';
$class = ($columns == 1) ? 'one-whole' : $class;
$class = ($columns == 2) ? 'one-half' : $class;
$class .= ($i % $columns == 0) ? ' last' : '';
?>
<div class="<?php echo $class; ?> blog">
<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
<div class="blogmeta"><?php the_author_link(); ?> | <?php echo get_the_date(); ?> | <a
href="<?php the_permalink(); ?>#comments"><?php comments_number(trnslt('no comments'), '1 ' . trnslt('comment'), '% ' . trnslt('comments')); ?></a>
</div>
<?php
/* GET AND RESIZE FIRST POST IMAGE   */
$img = get_first_image();
if ($img != '') {
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
							?></p>
<div class="blogdivider<?php echo $columns; ?>"></div>
<div class="readmore"><a href="<?php the_permalink(); ?>"><?php echo trnslt('read more'); ?> &raquo;</a>
</div>
</div>
<?php
}
?>
<div class="floatfix"></div>
<div class="postnavigation"><?php previous_posts_link(); ?></div>
<?php
$catLink = get_next_posts_link( 'Next Page &raquo;', 0 );
if( $catLink != '' ){
$catLink = get_category_link( $cat );
$catLink = "<a title='Next page' href='$catLink/page/2'>Next Page &raquo;</a>";
}
?>
<div class="postnavigation alignright"><?php echo $catLink; ?></div>
<div class="floatfix"></div>
</div>

<div id="blog-content-s"></div>
<?php endif; ?>
<?php
}
?>
</div>
<?php get_header(); ?>
<?php get_footer(); ?>
</body>
</html>