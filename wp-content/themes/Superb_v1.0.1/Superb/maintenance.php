<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="<?php bloginfo('text_direction'); ?>" xml:lang="<?php bloginfo('language'); ?>">
<head profile="http://gmpg.org/xfn/11">
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	<meta http-equiv="Content-language" content="<?php bloginfo('language'); ?>" />
	<meta name="description" content="<?php bloginfo('description') ?>" />
	<title><?php bloginfo('name') ?> <?php wp_title() ?></title>
	<?php wp_head() ?>
	<link rel="stylesheet" href="<?php echo get_template_directory_uri()?>/css/maintenance.css" type="text/css" media="screen" charset="utf-8"/>
	<!--[if lte IE 8]>
		<link rel="stylesheet" href="<?php echo get_template_directory_uri()?>/css/ie8.css" type="text/css" media="screen" charset="utf-8"/>
	<![endif]-->
	<!--[if lte IE 7]>
	    <link rel="stylesheet" href="<?php echo get_template_directory_uri()?>/css/ie7.css" type="text/css" media="screen" charset="utf-8"/>
	<![endif]-->
	<!--[if IE 6]>
	    <link rel="stylesheet" href="<?php echo get_template_directory_uri()?>/css/ie6.css" type="text/css" media="screen" charset="utf-8"/>
	<![endif]-->
	<link rel="SHORTCUT ICON" href="<?php echo esc_url(uds_get_option('uds-favicon', 'uds_general_options'))?>"/>
	<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php bloginfo("rss2_url"); ?>" />
	<link rel="alternate" type="application/rss+xml" title="<?php bloginfo("name"); ?> RSS Comments Feed" href="<?php bloginfo("comments_rss2_url"); ?>" />
</head>
<body <?php body_class() ?>>
	<div id="header-wrapper" class="maintenance">
		<div id="header">
			<div id="logo">
				<?php if(uds_get_option('uds-heading-type', 'uds_header_options') == 'image'): ?>
					<a href="<?php esc_url(bloginfo('url')) ?>" class="logo"><img src="<?php echo uds_get_option('uds-logo', 'uds_header_options') ?>" alt="" /></a>
				<?php else: ?>
					<h1><a href="<?php bloginfo('url') ?>"><?php echo esc_html(uds_get_option('uds-heading', 'uds_header_options')) ?></a></h1>
					<h3><a href="<?php bloginfo('url') ?>"><?php echo esc_html(uds_get_option('uds-subheading', 'uds_header_options')) ?></a></h3>
				<?php endif; ?>
			</div>
			<div class="clear"></div>
		</div>
	</div>
	<div id="content-wrapper">
		<div id="content" class="full-width">
			<div id="main">
				<h1 class="maintenance-content"><?php echo esc_html(uds_get_option("uds-maintenance-line", 'uds_maintenance_options')) ?></h1>
				<?php if(uds_get_option('uds-maintenance-show-date', 'uds_maintenance_options', '') == 'on'): ?>
				<div id="construction">
					<span class="date"><?php echo uds_get_option('uds-maintenance-end-date', 'uds_maintenance_options', date('Y-m-d')) ?></span>
					<span class="time"><?php echo uds_get_option('uds-maintenance-end-time', 'uds_maintenance_options', '23:59') ?></span>
					<div class="days">
						<span class="text"><?php _e('Days', 'uds-textdomain') ?></span>
						<div class="number">00</div>
					</div>
					<div class="colon">:</div>
					<div class="hours">
						<span class="text"><?php _e('Hours', 'uds-textdomain') ?></span>
						<div class="number">00</div>
					</div>
					<div class="colon">:</div>
					<div class="minutes">
						<span class="text"><?php _e('Minutes', 'uds-textdomain') ?></span>
						<div class="number">00</div>
					</div>
					<div class="colon">:</div>
					<div class="seconds">
						<span class="text"><?php _e('Seconds', 'uds-textdomain') ?></span>
						<div class="number">00</div>
					</div>
					<div class="clear"></div>
				</div>
				<?php endif; ?>
				<?php if(uds_get_option('uds-maintenance-social-link', 'uds_maintenance_options', '') == 'on' && uds_get_option('uds-twitter', 'uds_social_options') != ''): ?>
				<div class="construction-twitter">
					<h2><?php _e('Meanwhile, you can follow us on Twitter. We will announce the official launch there.', 'uds-textdomain') ?></h2>
					<?php echo do_shortcode("[button link='".uds_get_option('uds-twitter', 'uds_social_options')."' type='blue' target='_blank' ]".__('Follow us on Twitter!', 'uds-textdomain')."[/button]") ?>
				</div>
				<?php endif; ?>
				<?php if(UDS_LIVE_PREVIEW): ?>
					<h3 class="feature"><?php _e('Unlimited color options, tons of shortcodes and options and much more :). Soon.', 'uds-textdomain') ?></h3>
				<?php endif; ?>
			</div>
		</div>
		<div class="clear"></div>
	</div>
	<div id="footer-wrapper">
	    <div id="footer-top"></div>
	    <?php $footer_config = uds_get_option('uds-footer-config', 'uds_footer_options', 3); ?>
	    <div id="footer-inner" class="footer-config-<?php echo $footer_config ?>">
	    	<div class="clear"></div>
	    </div>
	    <div id="footer-bottom">
	    	<div id="footer-bottom-inner">
	    		<div class="right">
	    			<p class="copyright">&copy; <?php echo date('Y') ?> <?php echo uds_get_option('uds-copyright', 'uds_footer_options') ?></p>
	    		</div>
	    		<img src="<?php echo uds_get_option('uds-footer-logo', 'uds_footer_options') ?>" alt="" class="footer-logo" />
	    		<div class="left social-footer">
	    			<?php echo '' != uds_get_option('uds-rss', 'uds_social_options') 		? '<a href="'.esc_url(uds_get_option('uds-rss', 'uds_social_options')).'" class="rss"><img src="'.get_template_directory_uri().'/images/footer-rss.png" alt="png" class="social"/></a>' : '' ?>
	    			<?php echo '' != uds_get_option('uds-skype', 'uds_social_options') 	? '<a href="callto://'.esc_url(uds_get_option('uds-skype', 'uds_social_options')).'" class="skype"><img src="'.get_template_directory_uri().'/images/footer-skype.png" alt="png" class="social"/></a>' : '' ?>
	    			<?php echo '' != uds_get_option('uds-facebook', 'uds_social_options') ? '<a href="'.esc_url(uds_get_option('uds-facebook', 'uds_social_options')).'" class="facebook"><img src="'.get_template_directory_uri().'/images/footer-facebook.png" alt="png" class="social"/></a>' : '' ?>
	    			<?php echo '' != uds_get_option('uds-twitter', 'uds_social_options') 	? '<a href="'.esc_url(uds_get_option('uds-twitter', 'uds_social_options')).'" class="twitter"><img src="'.get_template_directory_uri().'/images/footer-twitter.png" alt="png" class="social"/></a>' : '' ?>
	    			<?php echo '' != uds_get_option('uds-youtube', 'uds_social_options') 	? '<a href="'.esc_url(uds_get_option('uds-youtube', 'uds_social_options')).'" class="youtube"><img src="'.get_template_directory_uri().'/images/footer-youtube.png" alt="png" class="social"/></a>' : '' ?>
	    			<?php echo '' != uds_get_option('uds-flickr', 'uds_social_options') 	? '<a href="'.esc_url(uds_get_option('uds-flickr', 'uds_social_options')).'" class="flickr"><img src="'.get_template_directory_uri().'/images/footer-flickr.png" alt="png" class="social"/></a>' : '' ?>
	    			<?php echo '' != uds_get_option('uds-linkedin', 'uds_social_options') ? '<a href="'.esc_url(uds_get_option('uds-linkedin', 'uds_social_options')).'" class="linkedin"><img src="'.get_template_directory_uri().'/images/footer-linkedin.png" alt="png" class="social"/></a>' : '' ?>
	    		</div>
	    		<div class="clear"></div>
	    	</div>
	    </div>
	</div>
	<?php if(uds_get_option('uds-ga', 'uds_general_options') == 'on'): ?>
	<?php $ga = uds_get_option('uds-ga-tracking-code', 'uds_general_options'); ?>
		<script type="text/javascript">
		    var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
		    document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
		</script>
		<script type="text/javascript">
		    try {
		    	var pageTracker = _gat._getTracker("<?php echo $ga?>");
		    	<?php $tracking_domain = uds_get_option("uds-ga-tracking-domain", 'uds_general_options') ?>
		    	<?php if(!empty($tracking_domain)): ?>
		    		pageTracker._setDomainName("<?php echo $tracking_domain ?>");
		    	<?php endif; ?>
		    	pageTracker._trackPageview();
		    } catch(err) {}
		</script>
	<?php endif; ?>
</body>
</html>