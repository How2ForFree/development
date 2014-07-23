<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head>
    <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
  
    <link rel="profile" href="http://gmpg.org/xfn/11" />
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
    <?php if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' ); ?>
    <!--[if IE 7]><link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/files/css/ie7.css"    media="screen, projection" /><![endif]-->
    <?php echo perfect_title(); ?>
    <?php wp_head(); ?>
    
    <style type="text/css">
        <?php if ( get_option( 'background_image' ) ) : ?>
        html {
            background-image: url('<?php echo get_option( 'background_image' ); ?>');  
            background-position: <?php echo get_option( 'background_image_v' ); ?> <?php echo get_option( 'background_image_h' ); ?>;       
            background-repeat: <?php echo get_option( 'background_image_repeat' ); ?>;
        }
        <?php endif; ?>
        
        <?php if ( get_option( 'background_color' ) ) : ?>
            html { background-color: <?php echo get_option( 'background_color' ); ?>; }
        <?php endif; ?>

        <?php if ( get_option( 'backround_attachment' ) ) : ?>
            html { background-attachment: <?php echo get_option( 'backround_attachment' ); ?>; }
        <?php endif; ?>
        
        <?php if ( get_option( 'header_color' ) ): ?>
            #header { background-color: <?php echo get_option( 'header_color' ); ?>; }
            #navigation-header li ul { background-color: <?php echo get_option( 'header_color' ); ?>; }
        <?php endif; ?>        

        <?php if ( get_option( 'main_color' ) ): ?>
            #container    { background-color: <?php echo get_option( 'main_color' ); ?>; }
            .frame-inner  { border: 1px solid <?php echo get_option( 'main_color' ); ?>; }
            .rule span    { background-color: <?php echo get_option( 'main_color' ); ?>; }
        <?php endif; ?>          

        <?php if ( get_option( 'slider_color' ) ): ?>
            #slider { background-color: <?php echo get_option( 'slider_color' ); ?>; }
        <?php endif; ?>           
        
        <?php if ( get_option( 'toolbar_color' ) ): ?>
            #toolbar { background-color: <?php echo get_option( 'toolbar_color' ); ?>; }
        <?php endif; ?>   
        
        <?php if ( get_option( 'navigation_color' ) ): ?>
            #navigation { background-color: <?php echo get_option( 'navigation_color' ); ?>; }
        <?php endif; ?>   
        
        <?php if ( get_option( 'footer_color' ) ): ?>
            #main-footer { background-color: <?php echo get_option( 'footer_color' ); ?>; }
        <?php endif; ?>                           
        
        <?php if ( get_option( 'titles_color' ) ): ?>
            
            a,
            h1, h2, h3,	h4, h5, h6, 	
			h1 a, h2 a, h3 a, h4 a, h5 a, h6 a,
			#logo .title, #navigation-header li strong, 
			#toolbar h2, #toolbar #descriptions strong, 
			#main-footer h3,
			.widget-container h1, .widget-container h2, .widget-container h3,
			.widget-container h4, .widget-container h5, .widget-container h6,
			.widget-container h1 a, .widget-container h2 a, .widget-container h3 a,
			.widget-container h4 a, .widget-container h5 a, .widget-container h6 a,
			.widget-container ul.menu li a:hover, 
			.widget-container ul.menu li.current_page_item li a:hover,
			.widget_twitter .twitter-timestamp, .widget_calendar caption,
			.mainbar .entry-meta a, .mainbar .entry-utility a,
			.portfolio-website .website-name a, 
			#comments .vcard .fn								 		{ color: <?php echo get_option( 'titles_color' ); ?>; }
            
        <?php endif; ?>
        
        <?php if ( get_option( 'links_color' ) ): ?>
            
            .mainbar a											{ color: <?php echo get_option( 'links_color' ); ?>; }
			.mainbar a:hover									{ color: <?php echo get_option( 'links_color' ); ?>; }
			#main-footer a, #main-footer a:hover				{ color: <?php echo get_option( 'links_color' ); ?>; }
			h5 a:hover, h6 a:hover								{ color: <?php echo get_option( 'links_color' ); ?>; }
			#content h5 a:hover, #content h6 a:hover			{ color: <?php echo get_option( 'links_color' ); ?>; }
			.widget-container a:hover							{ color: <?php echo get_option( 'links_color' ); ?>; }
			.widget-container ul.menu li.current_page_item a	{ color: <?php echo get_option( 'links_color' ); ?>; }
            
			#navigation ul li.current-menu-item a       { color: <?php echo get_option( 'links_color' ); ?>; }
            #navigation ul li.current-menu-item ul a    { color: #fff !important; }
            #navigation li.current-page-ancestor a      { color: <?php echo get_option( 'links_color' ); ?>; }
            #navigation li.current-page-ancestor ul a   { color: #fff !important; }
            
            #navigation-header li a:hover span			 		{ color: <?php echo get_option( 'links_color' ); ?>; }
            #navigation-header li.current-menu-item span 		{ color: <?php echo get_option( 'links_color' ); ?>; }
            #navigation-header li.current-page-ancestor span 	{ color: <?php echo get_option( 'links_color' ); ?>; }

            #navigation li a:hover                  { color: <?php echo get_option( 'links_color' ); ?> !important; }
            #navigation li ul li a:hover            { color: <?php echo get_option( 'links_color' ); ?> !important; }
            
            input#submit			{ background-color: <?php echo get_option( 'links_color' ); ?>; border-color: <?php echo get_option( 'links_color' ); ?>;}
            input.wpcf7-submit		{ background-color: <?php echo get_option( 'links_color' ); ?>; border-color: <?php echo get_option( 'links_color' ); ?>;}
            
        <?php endif; ?>
             
    </style>
    <style type="text/css" id="color1"></style>
    <style type="text/css" id="color2"></style>
    
    <script type="text/javascript">
        // get links colors from themebox
        var linksColor = '#FFFFFF';
        var cookieColor = false;
        var phpColor = false;
        
        <?php if ( get_option( 'links_color' ) ): ?>
			linksColor = '<?php echo get_option( 'links_color' ); ?>';
			phpColor = true;
		<?php endif; ?>
		
		if(undefined != jQuery.cookie('links-variant')) {
			linksColor = jQuery.cookie('links-variant');
			cookieColor = true;
		}
		
		if(cookieColor || phpColor){
			
			Cufon.replace('#navigation > ul > li > a', {
				textShadow: '1px 1px rgba(0, 0, 0, 0.2)',
				hover: {
					color: linksColor
				}
			});
			Cufon.replace('#feature-list-tabs h3 a', {
				textShadow: '1px 1px rgba(0, 0, 0, 0.2)',
				hover: {
					color: linksColor
				}
			});
			Cufon.replace('h1 a', { hover: { color: linksColor }});
			Cufon.replace('h2 a', { hover: { color: linksColor }});
			Cufon.replace('h3 a', { hover: { color: linksColor }});
			Cufon.replace('h4 a', { hover: { color: linksColor }});
			
			Cufon.replace('.portfolio-website .website-name a', { hover: { color: linksColor }});
		}
		                     
    </script>
</head>
<?php 

if ( ! isset( $content_width ) ) $content_width = 900;

$classes = get_body_class($class); 
$theme_variant = get_option('theme_variant');
if ( !empty( $theme_variant ) ) {
    $classes[] = $theme_variant;
}
if ( get_option( 'no_gradients' ) ){
    $classes[] = "nograd";
}

?>
<body <?php body_class($classes);?>>
<?php require_once('themebox.php'); ?>
<!-- BACK -->
<div id="back">
    <!-- PAGE -->
    <div id="page">
        <div id="page-wrapper">
        
            <!-- HEADER -->
            <div id="header">
            
                <!-- LOGO -->
                <div id="logo">
                    <a href="<?php echo home_url(); ?>">
                        <?php if (get_option( 'logo_url' )): ?>
                            <img src="<?php echo link_to( get_option( 'logo_url' ) ); ?>" alt="<?php bloginfo( 'blogname' ); ?>" />                    
                        <?php endif; ?>
                        
                        <?php if (get_option( 'logo_text' )): ?>
                           <span class="title"><?php echo get_option( 'logo_text' ); ?></span>
                        <?php endif; ?>
                    </a>                    
                </div><!-- /#logo -->
                
                <?php if(get_option('show_header_box')): ?>
						<div id="header-box" style="width:<?php echo get_option('header_box_width'); ?>px;">
							<?php echo stripslashes(get_option('header_box_text')); ?>
						</div>
                <?php else: ?>
                
					<?php if(has_nav_menu('header')): ?>
						<!-- NAVIGATION HEADER-->
						<div id="navigation-header">
								<?php wp_nav_menu( array( 'theme_location' => 'header', 'container' => '', 'walker' => new description_walker() ) ); ?>
						</div><!-- /#navigation-header -->
					<?php endif; ?>
					
				<?php endif; ?>
                
                <div id="header-bottom"></div>
            </div><!-- /#header -->
            
            <?php if ($_COOKIE["navigation-position"]) { ?>
				<?php if(trim($_COOKIE["navigation-position"]) == 'top'): ?>
				
					<?php if(has_nav_menu('main')): ?>
						<!-- NAVIGATION -->
						<div id="navigation" class="clearfix">
								<?php wp_nav_menu( array( 'theme_location' => 'main', 'container' => '') ); ?>
						</div><!-- /#navigation -->
					<?php endif; ?>
				
				<?php endif; ?>
            <?php } else if(get_option('main_menu_position') == 'top') { ?>
                
					<?php if(has_nav_menu('main')): ?>
						<!-- NAVIGATION -->
						<div id="navigation" class="clearfix">
								<?php wp_nav_menu( array( 'theme_location' => 'main', 'container' => '') ); ?>
						</div><!-- /#navigation -->
					<?php endif; ?>

            <?php } ?>
            
			<?php require_once('header-slider.php'); ?>
            
            <!-- MAIN -->
            <div id="main">
				<?php if ($_COOKIE["navigation-position"]) { ?>
					<?php if(trim($_COOKIE["navigation-position"]) == 'bottom'): ?>
					
						<?php if(has_nav_menu('main')): ?>
							<!-- NAVIGATION -->
							<div id="navigation" class="clearfix">
									<?php wp_nav_menu( array( 'theme_location' => 'main', 'container' => '') ); ?>
							</div><!-- /#navigation -->
						<?php endif; ?>
					
					<?php endif; ?>
				<?php } else if(get_option('main_menu_position')!= 'top') { ?>
					
					<?php if(has_nav_menu('main')): ?>
					<!-- NAVIGATION -->
					<div id="navigation" class="clearfix">
							<?php wp_nav_menu( array( 'theme_location' => 'main', 'container' => '') ); ?>
					</div><!-- /#navigation -->
					<?php endif; ?>
					
                <?php } ?>
