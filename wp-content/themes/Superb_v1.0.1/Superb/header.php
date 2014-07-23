<?php
	global $homepage_config;
	if(uds_get_option('uds-maintenance', 'uds_maintenance_options') == 'on' && !is_user_logged_in()) {
		include 'maintenance.php';
		exit();
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="<?php bloginfo('text_direction'); ?>" xml:lang="<?php bloginfo('language'); ?>">
<head profile="http://gmpg.org/xfn/11">
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	<meta http-equiv="Content-language" name="language" content="<?php bloginfo('language'); ?>" />
	<meta name="description" content="<?php bloginfo('description') ?>" />
	<meta name="keywords" content="<?php echo esc_attr(uds_get_option('uds-keywords', 'uds_general_options')) ?>" />
	<title><?php bloginfo('name') ?> <?php wp_title() ?></title>
	<?php wp_head() ?>
	<!--[if lte IE 8]>
		<link rel="stylesheet" href="<?php echo get_template_directory_uri()?>/css/ie8.css" type="text/css" media="screen" charset="utf-8"/>
	<![endif]-->
	<!--[if lte IE 7]>
	    <link rel="stylesheet" href="<?php echo get_template_directory_uri()?>/css/ie7.css" type="text/css" media="screen" charset="utf-8"/>
	<![endif]-->
	<link rel="SHORTCUT ICON" href="<?php echo esc_url(uds_get_option('uds-favicon', 'uds_general_options')) ?>"/>
	<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php bloginfo("rss2_url"); ?>" />
	<link rel="alternate" type="application/rss+xml" title="<?php bloginfo("name"); ?> RSS Comments Feed" href="<?php bloginfo("comments_rss2_url"); ?>" />
</head>
<body <?php body_class() ?>>
	<div id="header-wrapper">
		<div id="header">
			<div id="logo">
				<?php if(uds_get_option('uds-heading-type', 'uds_header_options') == 'image'): ?>
					<a href="<?php bloginfo('url') ?>" class="logo"><img src="<?php echo esc_url(uds_get_option('uds-logo', 'uds_header_options')) ?>" alt="" /></a>
				<?php else: ?>
					<div class="textual">
						<h1><a href="<?php bloginfo('url') ?>"><?php echo esc_html(uds_get_option('uds-heading', 'uds_header_options')) ?></a></h1>
						<h3><a href="<?php bloginfo('url') ?>"><?php echo esc_html(uds_get_option('uds-subheading', 'uds_header_options')) ?></a></h3>
					</div>
				<?php endif; ?>
			</div>
			<div class="nav">
				<?php 
				if(has_nav_menu('main-menu')) {
					wp_nav_menu(array(
						'theme_location' => 'main-menu',
						'container' => 'ul',
						'walker' => new UDS_Menu_Walker
					));
				} else {
					wp_nav_menu(array(
						'container' => 'ul'
					));
				}
				?>
			</div>
			<div class="clear"></div>
		</div>
	</div>
	<?php if(is_front_page()): ?>
		<?php if((UDS_LIVE_PREVIEW && $homepage_config == 'ubillboard') || (!UDS_LIVE_PREVIEW && uds_get_option('uds-billboard-type', 'uds_home_page_options') == 'ubillboard')): ?>
			<?php $billboard = get_uds_billboard() ?>
			<?php if($billboard != false && !empty($billboard)): ?>
				<div id="bb-wrapper">
					<div id="bb-wrapper-inner">
						<div id="bb-wrapper-shadow-top"></div>
						<?php echo $billboard ?>
					</div>
				</div>
				<div id="billboard-bottom"></div>
			<?php endif; ?>
		<?php elseif((UDS_LIVE_PREVIEW && $homepage_config == 'image') || (!UDS_LIVE_PREVIEW && uds_get_option('uds-billboard-type', 'uds_home_page_options') == 'image')): ?>
			<div id="bb-wrapper">
				<div id="static-image-wrapper">
					<?php $src = uds_get_option('uds-billboard-image', 'uds_home_page_options') ?>
					<?php $alt = uds_get_option('uds-billboard-image-alt', 'uds_home_page_options') ?>
					<img class="static-image" src="<?php echo $src ?>" alt="<?php echo $alt ?>" />
				</div>
				<div id="billboard-bottom"></div>
			</div>
		<?php else: ?>
			<div id="billboard-bottom"></div>
		<?php endif; ?>
	<?php endif; ?>