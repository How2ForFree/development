<?php

// define themes
$uds_themes = array(
	'contrast' => array(
		'label' => 'Default',
		'file' => null
	),
	'dark' => array(
		'label' => 'Dark',
		'file' => 'theme-dark.css'
	)
);

// define backgrounds	
$uds_backgrounds = array(
	'none' => array(
		'label' => 'Default',
		'file' => null
	),
	'carbon' => array(
		'label' => 'Carbon',
		'file' => 'theme-bg-carbon.css'
	),
	'darkstars' => array(
		'label' => 'Dark Stars',
		'file' => 'theme-bg-darkstars.css'
	),
	'wood' => array(
		'label' => 'Wood',
		'file' => 'theme-bg-wood.css'
	),
	'darkwood' => array(
		'label' => 'Dark Wood',
		'file' => 'theme-bg-darkwood.css'
	),
	'vintage' => array(
		'label' => 'Vintage',
		'file' => 'theme-bg-vintage.css'
	),
	'stripes-vertical' => array(
		'label' => 'Vertical stripes',
		'file' => 'theme-bg-stripes-vertical.css'
	),
	'blue' => array(
		'label' => 'Blue',
		'file' => 'theme-bg-blue.css'
	),
	'brown' => array(
		'label' => 'Brown',
		'file' => 'theme-bg-brown.css'
	),
	'purple' => array(
		'label' => 'Purple',
		'file' => 'theme-bg-purple.css'
	),
	'red' => array(
		'label' => 'Red',
		'file' => 'theme-bg-red.css'
	)
);

$uds_options_pages = array(
	'uds_home_page_options' => array(
		'function' => 'uds_theme_admin_home_page',
		'page' => __('Home Page Options', 'uds-textdomain'),
		'menu' => __('Home', 'uds-textdomain')
	),
	'uds_general_options' => array(
		'function' => 'uds_theme_admin_general',
		'page' => __('General Options', 'uds-textdomain'),
		'menu' => __('General', 'uds-textdomain')
	),
	'uds_blog_options' => array(
		'function' => 'uds_theme_admin_blog',
		'page' => __('Blog Options', 'uds-textdomain'),
		'menu' => __('Blog', 'uds-textdomain')
	),
	'uds_header_options' => array(
		'function' => 'uds_theme_admin_header',
		'page' => __('Header Options', 'uds-textdomain'),
		'menu' => __('Header', 'uds-textdomain')
	),
	'uds_footer_options' => array(
		'function' => 'uds_theme_admin_footer',
		'page' => __('Footer Options', 'uds-textdomain'),
		'menu' => __('Footer', 'uds-textdomain')
	),
	'uds_social_options' => array(
		'function' => 'uds_theme_admin_social',
		'page' => __('Social Networks Options', 'uds-textdomain'),
		'menu' => __('Social Networks', 'uds-textdomain')
	),
	'uds_maintenance_options' => array(
		'function' => 'uds_theme_admin_maintenance',
		'page' => __('Maintenance Options', 'uds-textdomain'),
		'menu' => __('Maintenance', 'uds-textdomain')
	)
);

$uds_general_options = array(
	/*
	'uds-theme' => array(
			'label' => 'Theme',
			'description' => 'Shown on frontend',
			'default' => 'default',
			'type' => 'select',
			'options' => array(
				'default' => 'Default'
			)
		),
	*/
	'uds-keywords' => array(
		'label' => __('Keywords', 'uds-textdomain'),
		'description' => __('SEO optimization keywords', 'uds-textdomain'),
		'default' => '',
		'type' => 'string'
	),
	'uds-main-color' => array(
		'label' => __('Main Color', 'uds-textdomain'),
		'description' => __('Set your main design color', 'uds-textdomain'),
		'default' => '2cb0e0',
		'type' => 'color'
	),
	'uds-breadcrumb-separator' => array(
		'label' => __('Breadcrumbs separator', 'uds-textdomain'),
		'description' => '',
		'default' => '»',
		'type' => 'string'
	),
	'uds-favicon' => array(
		'label' => __('Favicon', 'uds-textdomain'),
		'description' => '',
		'default' => get_template_directory_uri() . '/images/favicon.ico',
		'type' => 'image'
	),
	'uds-ga' => array(
		'label' => __('Google Analytics', 'uds-textdomain'),
		'description' => __('Enable/Disable Google Analytics support', 'uds-textdomain'),
		'default' => '',
		'type' => 'optional',
		'optionals' => array(
			'uds-ga-tracking-code' => array(
				'label' => __('Tracking Code', 'uds-textdomain'),
				'description' => '',
				'default' => '',
				'type' => 'string'
			),
			'uds-ga-tracking-domain' => array(
				'label' => __('Tracking domain', 'uds-textdomain'),
				'description' => __('Main tagline text', 'uds-textdomain'),
				'default' => '',
				'type' => 'string'
			)
		)
	)
);

$uds_header_options = array(
	'uds-heading-type' => array(
		'label' => __('Heading type', 'uds-textdomain'),
		'description' => __('Heading can be text or image', 'uds-textdomain'),
		'default' => 'image',
		'type' => 'alternate',
		'options' => array(
			'text' => __('Textual', 'uds-textdomain'),
			'image' => __('Image', 'uds-textdomain')
		),
		'alternates' => array (
			'text' => array(
				'uds-heading' => array(
					'label' => __('Heading', 'uds-textdomain'),
					'description' => __('Heading text', 'uds-textdomain'),
					'default' => UDS_TEMPLATE_NAME,
					'type' => 'string'
				),
				'uds-subheading' => array(
					'label' => __('Subheading', 'uds-textdomain'),
					'description' => __('Subeading text', 'uds-textdomain'),
					'default' => '',
					'type' => 'string'
				)
			),
			'image' => array(
				'uds-logo' => array(
					'label' => __('Logo', 'uds-textdomain'),
					'description' => __('Heading logo', 'uds-textdomain'),
					'default' => get_template_directory_uri() . '/images/logo.png',
					'type' => 'image'
				)
			)
		)
	)
);

$uds_home_page_options = array(
	'uds-billboard-type' => array(
		'label' => __('Billboard Type', 'uds-textdomain'),
		'description' => __('Appearance of the Home page', 'uds-textdomain'),
		'default' => 'ubillboard',
		'type' => 'alternate',
		'options' => array(
			'none' => __('No Billboard', 'uds-textdomain'),
			'ubillboard' => __('uBillboard', 'uds-textdomain'),
			'image' => __('Single Image', 'uds-textdomain')
		),
		'alternates' => array(
			'image' => array(
				'uds-billboard-image' => array(
					'label' => __('Static Billboard Image (960px wide)', 'uds-textdomain'),
					'description' => '',
					'default' => get_template_directory_uri() . '/images/billboard-static-image.png',
					'type' => 'image'
				),
				'uds-billboard-image-alt' => array(
					'label' => __('Alternate Text', 'uds-textdomain'),
					'description' => __('Useful for blind users and search engines', 'uds-textdomain'),
					'default' => '',
					'type' => 'text'
				)
			)
		)
	),
	'uds-show-tagline' => array(
		'label' => __('Show Tagline', 'uds-textdomain'),
		'description' => __('Enable/Disable Tagline entirely', 'uds-textdomain'),
		'default' => 'on',
		'type' => 'optional',
		'optionals' => array(
			'uds-tagline-text' => array(
				'label' => __('Tagline text', 'uds-textdomain'),
				'description' => __('Main tagline text', 'uds-textdomain'),
				'default' => __('Superb is powerful Wordpress theme enhanced with modern techniques. Unlimited colors, 5 custom widgets, tons of shortcodes and so much more!', 'uds-textdomain'),
				'type' => 'string'
			),
			'uds-tagline-button-link' => array(
				'label' => __('Tagline link', 'uds-textdomain'),
				'description' => '',
				'default' => 'http://themes.udesignstudios.net/superb/take-the-tour/',
				'type' => 'string'
			),
			'uds-tagline-link-text' => array(
				'label' => __('Tagline link text', 'uds-textdomain'),
				'description' => '',
				'default' => __('Take the tour', 'uds-textdomain'),
				'type' => 'string'
			)
		)
	)
);

$uds_blog_options = array(
	'uds-blog-sidebar-position' => array(
		'label' => __('Blog Sidebar', 'uds-textdomain'),
		'description' => __('Blog Sidebar position', 'uds-textdomain'),
		'default' => 'right',
		'type' => 'select',
		'options' => array(
			'right' => __('Right', 'uds-textdomain'),
			'left' => __('Left', 'uds-textdomain')
		)
	),
	'uds-blog-post-length' => array(
		'label' => __('Blog page shows', 'uds-textdomain'),
		'description' => __('Auto will display excerpts only when an excerpt is available, otherwise it will display the whole content', 'uds-textdomain'),
		'default' => 'auto',
		'type' => 'select',
		'options' => array(
			'auto' => __('Auto', 'uds-textdomain'),
			'excerpt' => __('Excerpts only', 'uds-textdomain'),
			'content' => __('Whole content', 'uds-textdomain')
		)
	),
	'uds-show-authorbox' => array(
		'label' => __('Show author box', 'uds-textdomain'),
		'description' => __('Little about me box below post content', 'uds-textdomain'),
		'default' => 'on',
		'type' => 'switch'
	)
);

$uds_footer_options = array(
	'uds-footer-config' => array(
		'label' => __('Footer configuration', 'uds-textdomain'),
		'description' => __('Column configuration of the footer', 'uds-textdomain'),
		'default' => '4',
		'type' => 'select',
		'options' => array(
			'2' => __('2 Columns', 'uds-textdomain'),
			'3' => __('3 Columns', 'uds-textdomain'),
			'4' => __('4 Columns', 'uds-textdomain'),
			'5' => __('5 Columns', 'uds-textdomain')
		)
	),
	'uds-footer-logo' => array(
		'label' => __('Footer Logo', 'uds-textdomain'),
		'description' => __('Footer Logo', 'uds-textdomain'),
		'default' => get_template_directory_uri() . '/images/footer-logo.png',
		'type' => 'image'
	),
	'uds-copyright' => array(
		'label' => __('Copyright owner', 'uds-textdomain'),
		'description' => '',
		'default' => 'uDesign.sk',
		'type' => 'string'
	)
);

$uds_social_options = array(
	'uds-rss' => array(
		'label' => __('RSS URL', 'uds-textdomain'),
		'description' => '',
		'default' => '',
		'type' => 'string'
	),
	'uds-skype' => array(
		'label' => __('Skype URL', 'uds-textdomain'),
		'description' => '',
		'default' => '',
		'type' => 'string'
	),
	'uds-facebook' => array(
		'label' => __('Facebook URL', 'uds-textdomain'),
		'description' => '',
		'default' => '',
		'type' => 'string'
	),
	'uds-twitter' => array(
		'label' => __('Twitter URL', 'uds-textdomain'),
		'description' => '',
		'default' => '',
		'type' => 'string'
	),
	'uds-youtube' => array(
		'label' => __('Youtube URL', 'uds-textdomain'),
		'description' => '',
		'default' => '',
		'type' => 'string'
	),
	'uds-flickr' => array(
		'label' => __('Flickr URL', 'uds-textdomain'),
		'description' => '',
		'default' => '',
		'type' => 'string'
	),
	'uds-linkedin' => array(
		'label' => __('LinkedIn URL', 'uds-textdomain'),
		'description' => '',
		'default' => '',
		'type' => 'string'
	),
);

$uds_maintenance_options = array(
	'uds-maintenance' => array(
		'label' => __('Maintenance Mode', 'uds-textdomain'),
		'description' => __('Logged users see site as usual, not logged visitors see a maintenance message', 'uds-textdomain'),
		'default' => '',
		'type' => 'optional',
		'optionals' => array(
			'uds-maintenance-line' => array(
				'label' => __('Maintenance message', 'uds-textdomain'),
				'description' => __('A message to be show while under maintenance', 'uds-textdomain'),
				'default' => __('We are currently under maintenance. We should be back in:', 'uds-textdomain'),
				'type' => 'text'
			),
			'uds-maintenance-social-link' => array(
				'label' => __('Enable social connection (Twitter)', 'uds-textdomain'),
				'description' => __('If Social options are filled in, links are included on the maintenance page', 'uds-textdomain'),
				'default' => 'on',
				'type' => 'switch'
			)
		)
	),
	'uds-maintenance-show-date' => array(
		'label' => __('Maintenance Mode Show End Date', 'uds-textdomain'),
		'description' => __('Logged users see site as usual, not logged visitors see a maintenance message', 'uds-textdomain'),
		'default' => '',
		'type' => 'optional',
		'optionals' => array(
			'uds-maintenance-end-date' => array(
				'label' => __('Maintenance End Date', 'uds-textdomain'),
				'description' => '',
				'default' => date('Y-m-d'),
				'type' => 'date'
			),
			'uds-maintenance-end-time' => array(
				'label' => __('Maintenance End Time', 'uds-textdomain'),
				'description' => '',
				'default' => '00:00',
				'type' => 'time'
			)
		)
	)
);

?>