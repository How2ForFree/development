<?php
/*
	Admin Options
*/

				
$themename = 'Nuance';
$shortname = 'jw';

$options = array();

// General options

$options[] = array( 'title' => 'General',
					'type'  => 'open' );
					
$options[] = array( 'title' => 'Logo - Upload Image',
					'desc'  => 'Upload the logo image.',
					'id'    => $shortname.'_logo_image',
					'std'   => '',
					'type'  => 'upload' );
					
$options[] = array( 'title' => 'Logo - Textual',
					'desc'  => 'If you want a textual logo turn this on. The name of your blog will be shown in text format instead of a logo.',
					'id'    => $shortname.'_logo_textual',
					'std'   => 'off',
					'type'  => 'switch' );
					
$options[] = array( 'title' => 'Favicon - Upload Image',
					'desc'  => 'Upload the favicon image.',
					'id'    => $shortname.'_favicon',
					'std'   => '',
					'type'  => 'upload' );

$options[] = array( 'title' => 'Comments',
					'desc'  => 'Enable or disable the comments feature on pages.',
					'id'    => $shortname.'_pages_comments',
					'std'   => 'off',
					'type'  => 'switch' );
					
$options[] = array( 'title' => 'Analytics code',
					'desc'  => 'Insert the google analytics or any other analytics code here. It will be placed before the closing body tag.',
					'id'    => $shortname.'_analytics',
					'std'   => '',
					'type'  => 'textarea' );

$options[] = array( 'title' => 'Email Address',
					'desc'  => 'Emails from the contact form shortcode and the contact form module (content composer) will be sent to this email.',
					'id'    => $shortname.'_email',
					'std'   => get_option('admin_email'),
					'type'  => 'text' );
					
$options[] = array( 'type'  => 'close' );


// Portfolio options

$options[] = array( 'title' => 'Portfolio',
					'type'  => 'open' );

$options[] = array( 'title' => 'Portfolio Single - Content',
					'desc'  => 'Enable or disable the content on portfolio posts.',
					'id'    => $shortname.'_portfolio_single_content',
					'std'   => 'off',
					'type'  => 'switch' );

$options[] = array( 'title' => 'Portfolio Single - Similar Projects',
					'desc'  => 'Show similar projects.',
					'id'    => $shortname.'_portfolio_similar',
					'std'   => 'on',
					'type'  => 'switch' );											
					
$options[] = array( 'title' => 'Portfolio Single - Sidebar - Description',
					'desc'  => 'Enable or disable the description shown in sidebar on portfolio posts.',
					'id'    => $shortname.'_portfolio_single_sidebar_description',
					'std'   => 'on',
					'type'  => 'switch' );	

$options[] = array( 'title' => 'Portfolio Single - Sidebar - Info',
					'desc'  => 'Enable or disable the info shown in sidebar on portfolio posts.',
					'id'    => $shortname.'_portfolio_single_sidebar_info',
					'std'   => 'on',
					'type'  => 'switch' );						
					
$options[] = array( 'title' => 'Comments',
					'desc'  => 'Enable or disable the comments feature on portfolio posts.',
					'id'    => $shortname.'_portfolio_comments',
					'std'   => 'off',
					'type'  => 'switch' );
					
$options[] = array( 'title' => 'Portfolio Listing - Popup Grid - Items Per Page',
					'desc'  => 'How many portfolio items to show per page.',
					'id'    => $shortname.'_portfolio_per_page_p1',
					'std'   => '6',
					'type'  => 'text' );
					
$options[] = array( 'title' => 'Portfolio Listing - Normal Grid - Items Per Page',
					'desc'  => 'How many portfolio items to show per page.',
					'id'    => $shortname.'_portfolio_per_page_p2',
					'std'   => '6',
					'type'  => 'text' );
					
$options[] = array( 'title' => 'Portfolio Listing - Normal Grid + Sidebar - Items Per Page',
					'desc'  => 'How many portfolio items to show per page.',
					'id'    => $shortname.'_portfolio_per_page_p3',
					'std'   => '6',
					'type'  => 'text' );
					
$options[] = array( 'title' => 'Portfolio Listing - Popup Grid - Lightbox',
					'desc'  => 'Enable or disable the lightbox feature. If disabled clicking the images will take to the portfolio post.',
					'id'    => $shortname.'_portfolio_thickbox_p1',
					'std'   => 'on',
					'type'  => 'switch' );
					
$options[] = array( 'title' => 'Portfolio Listing - Normal Grid - Lightbox',
					'desc'  => 'Enable or disable the lightbox feature. If disabled clicking the images will take to the portfolio post.',
					'id'    => $shortname.'_portfolio_thickbox_p2',
					'std'   => 'on',
					'type'  => 'switch' );
					
$options[] = array( 'title' => 'Slug',
					'desc'  => 'When using permalinks the url of a portfolio post will be like http://website.com/portfolio-view/title-of-portfolio-post, if you want to change that <strong>portfolio-view</strong> you can change it here. <strong>IMPORTANT:</strong> Can\'t be same as a post/page name. <strong>IMPORTANT:</strong> After changing visit Settings &rarr; Permalinks in order for WordPress to refresh permalinks.',
					'id'    => $shortname.'_portfolio_slug',
					'std'   => 'portfolio-view',
					'type'  => 'text' );

$options[] = array( 'type' => 'close' );


// Blog options
$options[] = array( 'title' => 'Blog',
					'type'  => 'open' );

$options[] = array( 'title' => 'Posts Per Page',
					'desc'  => 'How many blog posts to show per page.',
					'id'    => $shortname.'_posts_per_page',
					'std'   => '5',
					'type'  => 'text' );

$options[] = array( 'title' => 'About The Author',
					'desc'  => 'Enable or disable the "About author" section.',
					'id'    => $shortname.'_blog_about_author',
					'std'   => 'on',
					'type'  => 'switch' );
					
$options[] = array( 'title' => 'Thumbnails',
					'desc'  => 'Enable or disable the thumbnails.',
					'id'    => $shortname.'_blog_thumbnails',
					'std'   => 'on',
					'type'  => 'switch' );
					
$options[] = array( 'title' => 'Full First Post',
					'desc'  => 'Show the full content of the first post.',
					'id'    => $shortname.'_blog_first_full',
					'std'   => 'off',
					'type'  => 'switch' );
					
$options[] = array( 'title' => 'Read More Link',
					'desc'  => 'Show the read more link on the blog listing for each post.',
					'id'    => $shortname.'_blog_read_more',
					'std'   => 'on',
					'type'  => 'switch' );

$options[] = array( 'type' => 'close' );

/* Appearance options */

$options[] = array( 'title' => 'Appearance',
					'type'  => 'open' );
					
$options[] = array( 'title' => 'Image loading animation',
					'desc'  => 'Show a loading animation until an image is loaded.',
					'id'    => $shortname.'_image_load_animation',
					'std'   => 'on',
					'type'  => 'switch' );
					
$options[] = array( 'title' => 'Headings Font',
					'desc'  => 'Please select the font you want for the headings.',
					'id'    => $shortname.'_heading_font',
					'std'   => 'Puritan',
					'type'  => 'select',
					'optns' => array('PT Sans' => 'PT+Sans',
									 'PT Sans Narrow' => 'PT+Sans+Narrow',
									 'PT Sans Caption' => 'PT+Sans+Caption',
									 'Droid Sans' => 'Droid+Sans',
									 'Droid Serif' => 'Droid+Serif',
									 'Nobile' => 'Nobile',
									 'Molengo' => 'Molengo',
									 'OFL Sorts Mill Goudy TT' => 'OFL+Sorts+Mill+Goudy+TT',
									 'Vollkorn' => 'Vollkorn',
									 'Cantarell' => 'Cantarell',
									 'Ubuntu' => 'Ubuntu',
									 'Crimson Text' => 'Crimson+Text',
									 'Cuprum' => 'Cuprum',
									 'Cardo' => 'Cardo',
									 'Arvo' => 'Arvo',
									 'Neuton' => 'Neuton',
									 'Philosopher' => 'Philosopher',
									 'Old Standard TT' => 'Old+Standard+TT',
									 'Arimo' => 'Arimo',
									 'Allerta' => 'Allerta',
									 'Tinos' => 'Tinos',
									 'Orbitron' => 'Orbitron',
									 'Puritan' => 'Puritan',
									 'Cabin' => 'Cabin',
									 'Copse' => 'Copse',
									 'Lato' => 'Lato',
									 'Allerta Stencil' => 'Allerta+Stencil',
									 'Yanone Kaffeesatz' => 'Yanone+Kaffeesatz',
									 'Lobster' => 'Lobster'
									));
									
$options[] = array( 'title' => 'Tagline Font',
					'desc'  => 'Please select the font you want for the tagline.',
					'id'    => $shortname.'_tagline_font',
					'std'   => 'Puritan',
					'type'  => 'select',
					'optns' => array('Georgia' => 'Georgia',
									 'PT Sans' => 'PT+Sans',
									 'PT Sans Narrow' => 'PT+Sans+Narrow',
									 'PT Sans Caption' => 'PT+Sans+Caption',
									 'Droid Sans' => 'Droid+Sans',
									 'Droid Serif' => 'Droid+Serif',
									 'Nobile' => 'Nobile',
									 'Molengo' => 'Molengo',
									 'OFL Sorts Mill Goudy TT' => 'OFL+Sorts+Mill+Goudy+TT',
									 'Vollkorn' => 'Vollkorn',
									 'Cantarell' => 'Cantarell',
									 'Ubuntu' => 'Ubuntu',
									 'Crimson Text' => 'Crimson+Text',
									 'Cuprum' => 'Cuprum',
									 'Cardo' => 'Cardo',
									 'Arvo' => 'Arvo',
									 'Neuton' => 'Neuton',
									 'Philosopher' => 'Philosopher',
									 'Old Standard TT' => 'Old+Standard+TT',
									 'Arimo' => 'Arimo',
									 'Allerta' => 'Allerta',
									 'Tinos' => 'Tinos',
									 'Orbitron' => 'Orbitron',
									 'Puritan' => 'Puritan',
									 'Cabin' => 'Cabin',
									 'Copse' => 'Copse',
									 'Lato' => 'Lato',
									 'Allerta Stencil' => 'Allerta+Stencil',
									 'Yanone Kaffeesatz' => 'Yanone+Kaffeesatz',
									 'Lobster' => 'Lobster'
									));
									
$options[] = array( 'title' => 'Content Font',
					'desc'  => 'Please select the font you want for the main content.',
					'id'    => $shortname.'_content_font',
					'std'   => 'Droid+Sans',
					'type'  => 'select',
					'optns' => array('PT Sans' => 'PT+Sans',
									 'PT Sans Narrow' => 'PT+Sans+Narrow',
									 'PT Sans Caption' => 'PT+Sans+Caption',
									 'Droid Sans' => 'Droid+Sans',
									 'Droid Serif' => 'Droid+Serif',
									 'Nobile' => 'Nobile',
									 'Molengo' => 'Molengo',
									 'OFL Sorts Mill Goudy TT' => 'OFL+Sorts+Mill+Goudy+TT',
									 'Vollkorn' => 'Vollkorn',
									 'Cantarell' => 'Cantarell',
									 'Ubuntu' => 'Ubuntu',
									 'Crimson Text' => 'Crimson+Text',
									 'Cuprum' => 'Cuprum',
									 'Cardo' => 'Cardo',
									 'Arvo' => 'Arvo',
									 'Neuton' => 'Neuton',
									 'Philosopher' => 'Philosopher',
									 'Old Standard TT' => 'Old+Standard+TT',
									 'Arimo' => 'Arimo',
									 'Allerta' => 'Allerta',
									 'Tinos' => 'Tinos',
									 'Orbitron' => 'Orbitron',
									 'Puritan' => 'Puritan',
									 'Cabin' => 'Cabin',
									 'Copse' => 'Copse',
									 'Lato' => 'Lato',
									 'Allerta Stencil' => 'Allerta+Stencil',
									 'Yanone Kaffeesatz' => 'Yanone+Kaffeesatz',
									 'Lobster' => 'Lobster'
									));
									
$options[] = array( 'title' => 'Navigation Font',
					'desc'  => 'Please select the font you want for the main content.',
					'id'    => $shortname.'_nav_font',
					'std'   => 'Droid+Sans',
					'type'  => 'select',
					'optns' => array('PT Sans' => 'PT+Sans',
									 'PT Sans Narrow' => 'PT+Sans+Narrow',
									 'PT Sans Caption' => 'PT+Sans+Caption',
									 'Droid Sans' => 'Droid+Sans',
									 'Droid Serif' => 'Droid+Serif',
									 'Nobile' => 'Nobile',
									 'Molengo' => 'Molengo',
									 'OFL Sorts Mill Goudy TT' => 'OFL+Sorts+Mill+Goudy+TT',
									 'Vollkorn' => 'Vollkorn',
									 'Cantarell' => 'Cantarell',
									 'Ubuntu' => 'Ubuntu',
									 'Crimson Text' => 'Crimson+Text',
									 'Cuprum' => 'Cuprum',
									 'Cardo' => 'Cardo',
									 'Arvo' => 'Arvo',
									 'Neuton' => 'Neuton',
									 'Philosopher' => 'Philosopher',
									 'Old Standard TT' => 'Old+Standard+TT',
									 'Arimo' => 'Arimo',
									 'Allerta' => 'Allerta',
									 'Tinos' => 'Tinos',
									 'Orbitron' => 'Orbitron',
									 'Puritan' => 'Puritan',
									 'Cabin' => 'Cabin',
									 'Copse' => 'Copse',
									 'Lato' => 'Lato',
									 'Allerta Stencil' => 'Allerta+Stencil',
									 'Yanone Kaffeesatz' => 'Yanone+Kaffeesatz',
									 'Lobster' => 'Lobster'
									));
									
$options[] = array( 'title' => 'Archives&amp;Search layout',
					'desc'  => 'Choose the layout for the archives pages (category, tag, author...) and the search page.',
					'id'    => $shortname.'_archive_search_layout',
					'std'   => 'layout_cs',
					'type'  => 'select',
					'optns' => array('Content + Sidebar' => 'layout_cs',
									 'Sidebar + Content' => 'layout_sc'
									));
									
$options[] = array( 'type' => 'close' );
?>