<?php

if ( function_exists('register_sidebar') ) {
	register_sidebar(array(
		'name' => 'Main Sidebar',
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h2 class="widget_title">',
		'after_title' => '</h2>',
	));
	
	register_sidebar(array(
		'name' => 'Footer 1',
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h2 class="widget_title">',
		'after_title' => '</h2>',
	));
	
	register_sidebar(array(
		'name' => 'Footer 2',
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h2 class="widget_title">',
		'after_title' => '</h2>',
	));
	
	register_sidebar(array(
		'name' => 'Footer 3',
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h2 class="widget_title">',
		'after_title' => '</h2>',
	));
	
	register_sidebar(array(
		'name' => 'Footer 4',
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h2 class="widget_title">',
		'after_title' => '</h2>',
	));
	
}

?>