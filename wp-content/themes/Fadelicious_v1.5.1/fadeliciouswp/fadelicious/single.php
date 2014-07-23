<?php

$pcat = get_option('of_portfolio_category');
$pcatid = get_cat_id($pcat);
$bcat = get_option('of_blog_category');
$bcatid = get_cat_id($bcat);

$post = $wp_query->post;
if ( in_category($bcatid) ) {
include(TEMPLATEPATH . '/single-blog.php'); } 
elseif ( in_category($pcatid) ) {
include(TEMPLATEPATH . '/single-portfolio.php'); } 
else {
include(TEMPLATEPATH . '/single-blog.php');
} ?>
