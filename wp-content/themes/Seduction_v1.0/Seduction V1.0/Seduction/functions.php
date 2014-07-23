<?php
/* Set array with translation strings */
$trnslt_vars = array('Home' => 'home', 'No comments' => 'noComments', 'Comment' => 'comment', 'Comments' => 'comments', 'Search' => 'search', 'Results for' => 'resultsFor', 'No results' => 'noResults', 'Gender' => 'gender', 'Male' => 'male', 'Female' => 'female', 'Name' => 'name', 'Address' => 'address', 'Postal code' => 'postalcode', 'City' => 'city', 'Country' => 'country', 'Telephone' => 'telephone', 'E-mail' => 'email', 'Website' => 'website', 'Message' => 'message', 'Submit' => 'submit', 'Add comment' => 'addComment', 'Please login to place a comment.' => 'pleaseLogin', 'Logged in as' => 'loggedInAs', 'Logout' => 'logout', 'read more' => 'readMore', 'items' => 'items', 'Toggle fullscreen' => 'togglefullscreen', 'Toggle gallery info' => 'togglegalleryinfo', 'Previous category' => 'previouscategory', 'Next category' => 'nextcategory', 'Previous thumbnails' => 'previousthumbnails', 'Next thumbnails' => 'nextthumbnails', 'View this item' => 'viewthisitem', 'This message was sent from' => 'sentFrom', 'Please fill in all required (*) fields.' => 'requiredFields', 'Your information has been successfully sent.' => 'sendSuccess', 'Wrong CAPTCHA code entered.' => 'badCaptcha', 'Something went wrong whilst sending your information. Please try<br /> again at a later time.' => 'sendFailure', 'This post is password protected. Enter the password to view comments.' => 'passwordProtected');

require_once('lib/theme_options.php');
require_once('lib/post_options.php');
require_once('lib/widgets.php');
require_once('lib/menu.php');
require_once 'lib/shortcodes.php';
require_once('lib/shortcodes/tinymce.php');

/* Translate string, returns input if no translation was found */
function trnslt($str) {
  global $trnslt_vars;
  if(array_key_exists($str, $trnslt_vars)) {
    $trnsltn = get_option('_screen-trnslt-' . $trnslt_vars[$str]);
    if($trnsltn !== false && trim($trnsltn) != '') {
      return $trnsltn;
    }
  }
  return $str;
}


function dimox_breadcrumbs() {
 
  $delimiter = '/';
  $name = 'Home'; //text for the 'Home' link
  $currentBefore = '';
  $currentAfter = '';
 
  if ( !is_home() && !is_front_page() || is_paged() ) {
 
    global $post;
    $home = get_bloginfo('url');
    echo '<a href="' . $home . '">' . $name . '</a> ' . $delimiter . ' ';
 
    if ( is_category() ) {
      global $wp_query;
      $cat_obj = $wp_query->get_queried_object();
      $thisCat = $cat_obj->term_id;
      $thisCat = get_category($thisCat);
      $parentCat = get_category($thisCat->parent);
      if ($thisCat->parent != 0) echo(get_category_parents($parentCat, TRUE, ' ' . $delimiter . ' '));
      echo $currentBefore . 'Archive by category &#39;';
      single_cat_title();
      echo '&#39;' . $currentAfter;
 
    } elseif ( is_day() ) {
      echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
      echo '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
      echo $currentBefore . get_the_time('d') . $currentAfter;
 
    } elseif ( is_month() ) {
      echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
      echo $currentBefore . get_the_time('F') . $currentAfter;
 
    } elseif ( is_year() ) {
      echo $currentBefore . get_the_time('Y') . $currentAfter;
 
    } elseif ( is_single() ) {
      $cat = get_the_category(); $cat = $cat[0];
      echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
      echo $currentBefore;
      the_title();
      echo $currentAfter;
 
    } elseif ( is_page() && !$post->post_parent ) {
      echo $currentBefore;
      the_title();
      echo $currentAfter;
 
    } elseif ( is_page() && $post->post_parent ) {
      $parent_id  = $post->post_parent;
      $breadcrumbs = array();
      while ($parent_id) {
        $page = get_page($parent_id);
        $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
        $parent_id  = $page->post_parent;
      }
      $breadcrumbs = array_reverse($breadcrumbs);
      foreach ($breadcrumbs as $crumb) echo $crumb . ' ' . $delimiter . ' ';
      echo $currentBefore;
      the_title();
      echo $currentAfter;
 
    } elseif ( is_search() ) {
      echo $currentBefore . 'Search results for &#39;' . get_search_query() . '&#39;' . $currentAfter;
 
    } elseif ( is_tag() ) {
      echo $currentBefore . 'Posts tagged &#39;';
      single_tag_title();
      echo '&#39;' . $currentAfter;
 
    } elseif ( is_author() ) {
       global $author;
      $userdata = get_userdata($author);
      echo $currentBefore . 'Articles posted by ' . $userdata->display_name . $currentAfter;
 
    } elseif ( is_404() ) {
      echo $currentBefore . 'Error 404' . $currentAfter;
    }
 
    if ( get_query_var('paged') ) {
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
      echo __('Page') . ' ' . get_query_var('paged');
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
    }
 
 
  }
}


/* Shorten a string */
function shorten($str, $chars) {
	include_once 'lib/shortcodes.php';
	
  $str = teamDutchShortcodeConverter(str_replace(']]>', ']]&gt;', apply_filters('the_content', $str)));
  $str = strip_tags($str);
  if(strlen($str) > $chars) {
    $str = substr($str, 0, $chars);
    $bits = explode(' ', $str);
    $last = strlen($bits[count($bits) - 1]) + 1;
    $str = substr($str, 0, -$last);
    while(in_array(substr($str, -1), array(' ', ',', '.', '?', '!'))) {
      $str = substr($str, 0, -1);
    }
    $str .= '...';
  }
  return $str;
}

/* Find first image in a post */
function get_first_image() {
  global $post, $posts;
  $first_img = '';
  ob_start();
  ob_end_clean();
  $output = preg_match_all('/<img.+?src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
  $first_img = $matches[1][0];
  return $first_img;
}

/* Remove all unsafe characters from a string */
function urlsafe($str) {
	$str = utf8_decode(html_entity_decode(html_entity_decode($str)));
	$str = str_replace(array(' ', ',', '.', '"', "'", '/', "\\", '+', '=', ')', '(', '*', '&', '^', '%', '$', '#', '@', '!', '~', '`', '<', '>', '?', '[', ']', '{', '}', '|', ':'), '', $str);
	$bad = utf8_decode('ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûüýýþÿŔŕ');
	$bad_arr = array();
	for($i = 0; $i < strlen($bad); $i++) {
		$bad_arr[] = htmlentities($bad[$i]);
	}
	$good = 'AAAAAAACEEEEIIIIDNOOOOOOUUUUYbsaaaaaaaceeeeiiiidnoooooouuuuyybyRr';
	for($i = 0; $i < strlen($str); $i++) {
		for($j = 0; $j < count($bad_arr); $j++) {
			if(htmlentities($str[$i]) == $bad_arr[$j]) {
				$str[$i] = $good{$j};
			}
		}
	}
	for($i = 0; $i < strlen($str); $i++) {
		if(!ereg('[a-zA-Z0-9\-]', $str[$i])) {
			$str = str_replace($str[$i], '', $str);
		}
	}
	return $str;
}

/* Check if string contains http(s) and add if absent */
function checkLinkForHttp($str) {
  if(trim($str) != '' && strpos(strtolower($str), 'http://') === false && strpos(strtolower($str), 'https://') === false) {
		$str = 'http://' . $str;
	}
	return $str;
}

/* Make a relative path absolute */
function makePathAbsolute($str) {
  if(trim($str) != '' && strpos(strtolower($str), 'http://') === false && strpos(strtolower($str), 'https://') === false) {
		$str = get_bloginfo('template_url') . '/' . $str;
	}
	return $str;
}
?>