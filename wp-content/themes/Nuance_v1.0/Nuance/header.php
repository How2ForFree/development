<?php
/* ------------------------------------------------------------------------------------------------------------
	
	Page part template - Header
	
------------------------------------------------------------------------------------------------------------ */
?>

	<!DOCTYPE html >
	<html <?php language_attributes(); ?>>

	<head>
		
		<?php global $domain; ?>
		
		<?php include TEMPLATEPATH.'/functions/jwpanel/jwpanel-get.php'; ?>
		
		<meta charset="<?php bloginfo('charset'); ?>" />
		
		<?php if (is_search()) { ?>
		   <meta name="robots" content="noindex, nofollow" /> 
		<?php } ?>

		<title>
		
			<?php
				
				/* First part of title */
				if (is_tag()){
				
					single_tag_title(__('Tag Archive for &quot;', $domain)); _e('&quot; - ', $domain);
					
				}elseif (is_archive()){
				
					wp_title(''); _e(' Archive - ', $domain);
					
				}elseif (is_search()){
				
					echo __('Search for &quot;', $domain).esc_html($s).__('&quot; - ', $domain);
					
				}elseif (!(is_404()) && (is_single()) || (is_page()) && !is_front_page()) {
				
					wp_title(''); echo ' - ';
					
				}elseif (is_404()){
				
					_e('Not Found - ', $domain);
					
				}
				
				/* Second part of title */
				if (is_home() || is_front_page()){
				
					bloginfo('name'); echo ' - '; bloginfo('description');
					
				}else{
				
					bloginfo('name'); 
					
				}
				
				/* Third part of title */
				if ($paged > 1) {
				
					echo ' - page '. $paged; 
					
				}
			?>
			
		</title>
		
		<!-- Favicon -->
		<?php if($jw_favicon != ''){ ?>
	
			<link rel="shortcut icon" href="<?php echo $jw_favicon; ?>" type="image/x-icon" />
			
		<?php }else{ ?>
		
			<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico" type="image/x-icon" />
		
		<?php } ?>
		
		<!-- Main stylesheet (style.css) -->
		<link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>" type="text/css" />
		
		<link href='http://fonts.googleapis.com/css?family=Droid+Sans:regular,italic,bold,bolditalic' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Droid+Serif:regular,italic,bold,bolditalic' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Puritan:regular,italic,bold,bolditalic' rel='stylesheet' type='text/css'>
		
		<link href='http://fonts.googleapis.com/css?family=<?php echo $jw_heading_font; ?>:regular,italic,bold,bolditalic' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=<?php echo $jw_nav_font; ?>:regular,italic,bold,bolditalic' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=<?php echo $jw_tagline_font; ?>:regular,italic,bold,bolditalic' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=<?php echo $jw_content_font; ?>:regular,italic,bold,bolditalic' rel='stylesheet' type='text/css'>
		
		<style type="text/css">
			body { font-family:"<?php echo str_replace('+', ' ', $jw_content_font); ?>"; }
			#navigation { font-family:"<?php echo str_replace('+', ' ', $jw_nav_font); ?>"; }
			#main h1, #main h2, #main h3, #main h4, #main h5, #main h6, #main h1 a, #main h2 a, #main h3 a, #main h4 a, #main h5 a, #main h6 a { font-family:"<?php echo str_replace('+', ' ', $jw_heading_font); ?>" !important; }
			#tagline  h2, #tagline h1 { font-family:"<?php echo str_replace('+', ' ', $jw_tagline_font); ?>"; }
		</style>
		
		<!-- Pingback -->
		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
		
		<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
		
		<?php wp_head(); ?>
		
		<?php if(isset($post)){ $post_custom = get_post_custom($post->ID); } /* Get the custom fields values */ ?>
		
		<?php if(isset($post_custom['jw_slider']) && $post_custom['jw_slider_type'][0] == 'regular'){ ?>
		
		<?php if(isset($post_custom['jw_slider_effect'])){ $slide_effect = $post_custom['jw_slider_effect'][0]; }else{ $slide_effect = 'fade'; } ?>
		
		<script>
			jQuery(window).load(function(){
				/* --------------------------------------------------
					Top Slider - Init
				-------------------------------------------------- */
				if(jQuery('#slider-slides').length){
					$('#slider-slides').cycle({
						pager:  '#slider-pager',
						pagerAnchorBuilder: function(idx, slide) { 
							return '<li></li>'; 
						},
						timeout: <?php $slider_delay = $post_custom['jw_slider_delay'][0] * 1000; echo $slider_delay; ?>,
						prev: '#slider-prev',
						next: '#slider-next',
						fx: '<?php echo $slide_effect;  ?>',
						before: function(currSlideElement, nextSlideElement, options, forwardFlag){
							jQuery('#slide-caption').html(jQuery(nextSlideElement).find('.slide-caption').html());
						}
					});
				}
				
			});
		</script>
		<?php } ?>
		
		<?php if(isset($post_custom['jw_slider']) && $post_custom['jw_slider_type'][0] == 'piecemaker'){ ?>
			
			<script type="text/javascript">
				var flashvars = {};
				flashvars.cssSource = "<?php echo get_template_directory_uri().'/scripts/piecemaker/piecemaker.css' ?>";
				flashvars.xmlSource = "<?php echo get_template_directory_uri().'/scripts/piecemaker/piecemaker-xml.php?post_id='.$post->ID; ?>";

				var params = {};
				params.play = "true";
				params.menu = "false";
				params.scale = "showall";
				params.wmode = "transparent";
				params.allowfullscreen = "true";
				params.allowscriptaccess = "always";
				params.allownetworking = "all";
				
				<?php
					function getAttribute($attrib, $tag){
						//get attribute from html tag
						$re = '/' . preg_quote($attrib) . '=([\'"])?((?(1).+?|[^\s>]+))(?(1)\1)/is';
						if (preg_match($re, $tag, $match)) {
							return urldecode($match[2]);
						}
						return false;
					}

					$subject = $post_custom['jw_slider'][0];
					$height = getAttribute('height', $subject);
					if(empty($height)){ $height = 250; }
					$height += 150;
				?>
				
				<?php $slider_width = 960; ?>
				
				swfobject.embedSWF('<?php echo get_template_directory_uri().'/scripts/piecemaker/piecemaker.swf' ?>', 'piecemaker', <?php echo $slider_width; ?>, '<?php echo $height; ?>', '10', null, flashvars, params, null);

			</script>
			
		<?php } ?>
		
	</head>
	
	<?php $body_class = ''; /* For additional body classes */ ?>
	
	<body <?php body_class($body_class); ?>>
		
		<div id="header">
		
			<div class="wrap960 col-clear">
				
				<div id="logo">
					<?php if($jw_logo_textual == 'on'){ ?>
							
						<h1><a href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a></h1>
						
					<?php }else{ ?>
					
						<?php if($jw_logo_image != ''){ $logo_img = $jw_logo_image; }else{ $logo_img = get_template_directory_uri().'/images/logo.png'; } ?> 
						<a href="<?php echo home_url(); ?>"><img src="<?php echo $logo_img; ?>" alt="" /></a>
						
					<?php } ?>
				</div><!-- #logo -->
				
				<div id="navigation">
					<?php 
					if (has_nav_menu('main_navigation')){
						wp_nav_menu(array('container_class' => '', 'menu_class' => 'sf-menu', 'theme_location' => 'main_navigation', 'link_before' => '', 'link_after' => '', 'walker' => new description_walker()));
					} 
					?>
				</div><!-- #navigation -->
				
			</div><!-- .wrap960 -->
			
		</div><!-- #header -->
		
		<?php if((isset($post_custom['jw_tagline_show']) && $post_custom['jw_tagline_show'][0] == 'on') || !isset($post_custom['jw_tagline_show'])){ ?>
		
			<div id="tagline">
		
				<div class="wrap960">
					<?php if(is_front_page() && !is_page()){
						?><h2>Thank you for purchasing Nuance</h2><?php
					}else if(is_search()){ ?>
						<h1><?php echo 'Search for &quot;'.esc_html($s).'&quot;'; ?></h1>
					<?php }else if(is_archive()){ ?>
						<h1><?php _e('Archive', $domain); ?></h1>
					<?php }else{ ?>
						<?php if(isset($post_custom['jw_title'])){ ?>
							<h2><?php echo $post_custom['jw_title'][0]; ?></h2>
							<?php
								if(isset($post_custom['jw_description'])){
									?><small>{ <?php echo $post_custom['jw_description'][0]; ?> }</small><?php
								}
							?>
						<?php }else{ ?>
							<h2><?php the_title(); ?></h2>
							<?php
								if(isset($post_custom['jw_description'])){
									?><small>{ <?php echo $post_custom['jw_description'][0]; ?> }</small><?php
								}
							?>
						<?php } ?>
					<?php } ?>
				</div><!-- .wrap960 -->
				
			</div><!-- #tagline -->
		
		<?php } ?>
		
		<?php if(isset($post_custom['jw_slider'])){ ?>
			<?php jw_slider_output(''); ?>
		<?php } ?>
		
		<div id="main" class="col-clear">