<?php
/** 
* @Theme Name	:	Quality
* @file         :	header.php
* @package      :	Quality
* @author       :	Vibhor
* @license      :	license.txt
* @filesource   :	wp-content/themes/quality/header.php
*/
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<!--[if IE]>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">``
	<![endif]-->
	<meta charset="<?php bloginfo('charset'); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />    
	<meta name="generator" content="WordPress <?php bloginfo('version'); ?>" />	
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<!-- Theme Css -->
	<?php $current_options=get_option('quality_options'); ?>
	<?php if($current_options['upload_image_favicon']!=''){ ?>
	<link rel="shortcut icon" href="<?php  echo $current_options['upload_image_favicon']; ?>" /> 
	<?php } ?>
	<link href="<?php echo get_stylesheet_uri(); ?>" rel="stylesheet" />	
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<!--Header Logo & Menus-->
<div class="container">
	<nav class="navbar navbar-default" role="navigation">
	  <div class="container-fluid">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
		  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		  </button>
		  <div class="logo pull-left" >			
			<?php 
			if($current_options['text_title'] =="on")
				{ ?>
					<div class="qua_title_head">
					<h1 class="qua-logo" ><a href="<?php echo home_url( '/' ); ?>"><?php echo get_bloginfo( ); ?></a></h1>
					</div><?php 
				} else if($current_options['upload_image_logo']!='') 
					{ ?>
					<a href="<?php echo home_url( '/' ); ?>"><img src="<?php echo $current_options['upload_image_logo']; ?>" style="height:<?php if($current_options['height']!='') { echo $current_options['height']; }  else { "80"; } ?>px; width:<?php if($current_options['width']!='') { echo $current_options['width']; }  else { "200"; } ?>px;" /></a>
					<?php } else { ?> 
					<a href="<?php echo home_url( '/' ); ?>"><img src="<?php echo WEBRITI_TEMPLATE_DIR_URI; ?>/images/logo.png"></a>
					<?php } ?>			
		  </div>
		</div>
		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		<?php
		wp_nav_menu( array(  
				'theme_location' => 'primary',
				'container'  => 'nav-collapse collapse navbar-inverse-collapse',
				'menu_class' => 'nav navbar-nav navbar-right',
				'fallback_cb' => 'quality_fallback_page_menu',
				'walker' => new quality_nav_walker()
				)
			);	
		?>
		</div><!-- /.navbar-collapse -->
	  </div><!-- /.container-fluid -->
	</nav>		
</div>