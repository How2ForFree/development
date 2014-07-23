<?php
/* ------------------------------------------------------------------------------------------------------------
	
	Page template - Full width page.
	
------------------------------------------------------------------------------------------------------------ */
?>

	<?php include TEMPLATEPATH.'/functions/jwpanel/jwpanel-get.php'; ?>

	<?php get_header(); ?>

	<?php 
		
		/* Get the custom fields values */
		$post_custom = get_post_custom($post->ID);
		
		/* Get the post/page */
		the_post();
		
		$slider_layout = $post_custom['jw_layout'][0];
		
	?>
	
	<?php if(isset($post_custom['jw_layout'][0]) && $post_custom['jw_layout'][0] == 'layout_sc'){ get_sidebar(); } /* If sidebar + content layout get the left sidebar */ ?>
	
	<div id="content" class="<?php if($post_custom['jw_layout'][0] != 'layout_c'){ ?>two-third<?php } if($post_custom['jw_layout'][0] == 'layout_sc'){ ?> last<?php } ?>">
		
		<?php if(isset($post_custom['jw_composer'][0]) && $post_custom['jw_composer'][0] == 'active'){ ?>
		
			<?php echo do_shortcode($post_custom['jw_composer_front'][0]); ?>
		
		<?php }else{ ?>
			
			<?php the_content(); /* Show the post/page content */ ?>
			
		<?php } ?>
		
		<?php 
		if($jw_pages_comments == 'on'){
			comments_template(); 
		}
		?>
	
	</div> <!-- #content -->
	
	<?php if(!isset($post_custom['jw_layout'][0]) || $post_custom['jw_layout'][0] == 'layout_cs'){ get_sidebar(); } /* If content + sidebar layout get the right sidebar */ ?>

	<?php get_footer(); ?>