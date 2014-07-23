<?php
/* ------------------------------------------------------------------------------------------------------------
	
	Page template - Portfolio single post page
	
------------------------------------------------------------------------------------------------------------ */
?>

	<?php include TEMPLATEPATH.'/functions/jwpanel/jwpanel-get.php'; ?>

	<?php if($jw_image_load_animation == 'on'){ $image_animate_class = 'image-load-animate'; }else{ $image_animate_class = ''; } ?>
	
	<?php get_header(); ?>

	<?php global $domain; ?>
	
	<?php 
		
		/* Get the custom fields values */
		$post_custom = get_post_custom($post->ID);
		
		/* Get the post/page */
		the_post();
		
		$slider_layout = $post_custom['jw_layout'][0];
		
	?>
	
	<?php if(isset($post_custom['jw_layout'][0]) && $post_custom['jw_layout'][0] == 'layout_sc'){ get_sidebar('portfolio'); } /* If sidebar + content layout get the left sidebar */ ?>
	
	<div id="content" class="<?php if($post_custom['jw_layout'][0] != 'layout_c'){ ?>two-third<?php } if(isset($post_custom['jw_layout'][0]) && $post_custom['jw_layout'][0] == 'layout_sc'){ ?> last<?php } ?>">
			
		<?php if(isset($post_custom['jw_composer'][0]) && $post_custom['jw_composer'][0] == 'active'){ ?>
		
			<?php echo do_shortcode($post_custom['jw_composer_front'][0]); ?>
		
		<?php }else{ ?>
		
			<?php if($post_custom['jw_layout'][0] == 'layout_c'){ $thumbnail_id = 'jw_full'; }else{ $thumbnail_id = 'jw_portfolio_twothird'; } ?>
			
			<?php if(isset($post_custom['jw_portfolio_video'])){ $real_link = $post_custom['jw_portfolio_video'][0]; $lightbox_class = 'lightbox-video'; } ?>
			<?php if(isset($post_custom['jw_portfolio_images'])){ preg_match('!http://.+\.(?:jpe?g|png|gif)!Ui', $post_custom['jw_portfolio_images'][0],$matches); $real_link = $matches[0]; $lightbox_class = 'lightbox-image'; } ?>
			
			<?php if(isset($post_custom['jw_portfolio_video']) || isset($post_custom['jw_portfolio_images'])){ ?>
				<a href="<?php echo $real_link; ?>" class="<?php echo $lightbox_class.' '.$image_animate_class; ?>" rel="prettyPhoto[pp_gal_<?php echo $post->ID; ?>]"><?php if(has_post_thumbnail()){ the_post_thumbnail('jw_portfolio_twothird', array('class' => 'wrapped')); } ?></a>			
				<?php
					if(isset($post_custom['jw_portfolio_images'])){
						$jw_portfolio_images = preg_replace('/\[portfolio_image/', '[portfolio_image show="no"', $post_custom['jw_portfolio_images'][0], 1);
							$jw_portfolio_images = preg_replace('/\[portfolio_image/', '[portfolio_image post_id="'.$post->ID.'"', $jw_portfolio_images);
						echo do_shortcode($jw_portfolio_images);
					}
				?>
			<?php }else{ ?>
				<div class="<?php echo $image_animate_class; ?>">
					<?php if(has_post_thumbnail()){ the_post_thumbnail($thumbnail_id, array('class' => "wrapped")); } ?>
				</div>
			<?php } ?>
			
			<?php if($jw_portfolio_single_content == 'on'){ the_content(); } ?>
			
			<?php if($jw_portfolio_similar == 'on'){ ?>
			
				<?php echo do_shortcode('[related_posts type="portfolio"]'); ?>
			
			<?php } ?>
			
		<?php } ?>
		
		<?php 
		if($jw_portfolio_comments == 'on'){
			comments_template(); 
		}
		?>
	
	</div><!-- .two-third -->

	<?php if(!isset($post_custom['jw_layout'][0]) || $post_custom['jw_layout'][0] == 'layout_cs'){ get_sidebar('portfolio'); } /* If content + sidebar layout get the right sidebar */ ?>
	
	<?php get_footer(); ?>