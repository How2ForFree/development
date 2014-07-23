<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<head profile="http://gmpg.org/xfn/11">
<meta name="google-site-verification" content="4rV-6rwSG2qln1R7AqfMRDiiLGOKYZr21Lf6b2y8Kpw" />
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<title><?php page_title(); ?></title>
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<link href="<?php echo strtolower(get_option('theme_favicon')); ?>" rel="shortcut icon" type="image/gif" />



<!-- SCRIPTS SECTION ||||||||||||||||||||||||||||||||| -->

	<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
	<script type="text/javascript">
		<?php if (is_home()) : ?>
		var homepage = true;
		<?php else: ?>
		var homepage = false;
		<?php endif; ?>
		var $templatepath = '<?php bloginfo('template_directory'); ?>/';
	</script>

	<?php wp_enqueue_script('jquery'); wp_head(); ?>

	<!-- Javascript (jQuery) + Superfish Scripts -->
	<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jquery.easing.1.3.js"></script>
	<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jquery.vgrid.0.1.5.min.js"></script>
	<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/superfish.js"></script>
	<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/hoverIntent.js"></script>
	<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jquery.ceebox-min.js"></script>
	
	<!-- Cufon Load Fonts -->
	<script src="<?php bloginfo('template_directory'); ?>/js/cufon-yui.js" type="text/javascript"></script>
	<script src="<?php bloginfo('template_directory'); ?>/js/League_Gothic_400.font.js" type="text/javascript"></script>

	<!-- Comments Validation Javascript -->
	<?php if (is_singular()) : ?>
	<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/commentsvalidate.js"></script>
	<?php endif; ?>
			
	<!-- Core Javascript -->
	<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/flex.js"></script>
	


 
<!-- CSS SECTION  ||||||||||||||||||||||||||||||||| -->

	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
	
	<?php if (get_option('theme_color')) : ?>
	<link href="<?php bloginfo('template_directory'); ?>/css/custom/<?php echo strtolower(get_option('theme_color')); ?>/quick-styles.css" media="screen" rel="stylesheet" type="text/css" />
	<script src="<?php bloginfo('template_directory'); ?>/css/custom/<?php echo strtolower(get_option('theme_color')); ?>/cufon.js" type="text/javascript"></script>
	<?php else: ?>
	<link rel="stylesheet" type="text/css" media="screen,projection" href="<?php bloginfo('template_directory'); ?>/css/custom/default/quick-styles.css"  />
	<link href="<?php bloginfo('template_directory'); ?>/css/custom/<?php echo strtolower(get_option('theme_color')); ?>/quick-styles.css" media="screen" rel="stylesheet" type="text/css" />
	<?php endif; ?>
	
	<!-- STYLESWITCHER --><?php @include('styleswitcher/styleswitcher.php'); ?><!-- /END STYLESWITCHER -->
	
	<!--[if IE 6]>
		<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/css/import/ie-6.0.css" />
	<![endif]-->
	
	<!-- Add the Custom CSS -->
	<style type="text/css">
 	<?php echo get_option('theme_customcss'); ?>
 	.single_post, .single_page {
	width:<?php echo get_option('theme_customwidth'); ?>px !important;
	}
	#grid-content div{display: none;}
	#grid-content div div{display: inline;}
 	</style>
 	
 	
</head>


<?php
if(is_front_page() ) $bodyclass="home";
else $bodyclass="subpage";
?>
<body class="<?php echo $bodyclass;?>">
	
	<!-- STYLESWITCHER --><?php @include('styleswitcher/styleswitcher_html.php'); ?><!-- /END STYLESWITCHER -->
	
	<!-- TOP BAR  -->    
    <div id="top_bar">
    	<div class="margin25px">
    		    		
    		<!-- LOGO  -->    	
    		<div id="logo">
    		<?php $colorpath = strtolower(get_option('theme_color'));
    		$logopath = (get_option('theme_logo')) ? get_option('theme_logo') : get_bloginfo('template_directory') . "/css/custom/" . $colorpath . "/images/default_logo.png"; ?>
    		    		

            <a id="logolink" href="<?php bloginfo('url') ?>/" title="<?php echo bloginfo('blog_name'); ?>"><img id="logotype" src="<?php echo $logopath; ?>" alt="<?php echo bloginfo('blog_name'); ?>" /></a>
            </div>
            <!-- /LOGO  -->
                                    
            
            <!-- NAVIGATION  -->
			<div id="navigation">
						
				<?php mytheme_nav(); ?>		
					
					<?php if (is_front_page()) { ?>
					<?php if (get_option('theme_shuffle_link') == 'Yes') { ?>
					<ul class="shuffle"><li class="page_item"><a href="#" id="rsort"><?php echo strtolower(get_option('theme_shuffle_text')); ?></a></li></ul>
					<?php } else {} } ?>
				
						
			</div>
			<!-- /END NAVIGATION  -->
			
						
			<!-- SOCIAL MEDIA + SEARCH -->
            <div id="right_links">
            	
            	<?php get_search_form(); ?>


 				<a href="<?php bloginfo('rss2_url'); ?>" target="_blank"><img src="<?php bloginfo('template_directory'); ?>/images/social_media/rss_16.png" alt="RSS" /></a>
 				
 				<?php if (get_option('theme_email_top')) : ?>
                <a id="email_link" href="mailto:<?php echo get_option('theme_email_top'); ?>" title="Email" target="_blank"><img src="<?php bloginfo('template_directory'); ?>/images/social_media/email_16.png" alt="email" /></a>
                <?php endif; ?>
                
                <?php if (get_option('theme_tumblr')) : ?>
                <a id="tumblr" href="<?php echo get_option('theme_tumblr'); ?>" title="Tumblr" target="_blank"><img src="<?php bloginfo('template_directory'); ?>/images/social_media/tumblr_16.png" alt="tumblr" /></a>
                <?php endif; ?>
                
                <?php if (get_option('theme_vimeo')) : ?>
                <a id="vimeo" href="<?php echo get_option('theme_vimeo'); ?>" title="Vimeo" target="_blank"><img src="<?php bloginfo('template_directory'); ?>/images/social_media/vimeo_16.png" alt="vimeo" /></a>
                <?php endif; ?>
                
                <?php if (get_option('theme_facebook')) : ?>
                <a id="facebook" href="<?php echo get_option('theme_facebook'); ?>" title="Facebook" target="_blank"><img src="<?php bloginfo('template_directory'); ?>/images/social_media/facebook_16.png" alt="facebook" /></a>
                <?php endif; ?>                
            
            	<?php if (get_option('theme_twitter')) : ?>
            	<a id="twitter" href="http://www.twitter.com/<?php echo get_option('theme_twitter'); ?>" title="Twitter" target="_blank"><img src="<?php bloginfo('template_directory'); ?>/images/social_media/twitter_16.png" alt="twitter" /></a>
            	<?php endif; ?>

             
                
               
                
                
                
               
                  								
            </div>
            <!--/SOCIAL MEDIA + SEARCH -->
                                   
        </div>
    </div>
    <!-- /TOP BAR  -->    
    
    
    <!-- MAIN CONTENT  -->    
    <div class="mainmargin" id="grid-content">
   
        