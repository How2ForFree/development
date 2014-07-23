<?php
/**
 * @package WordPress
 * @subpackage Starkers
 */

get_header(); ?>

		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			
		<!-- CONTENT CONTAINER -->
		<div id="container">
		
			<!-- MAIN COLUMN -->
			<div class="post rounded single_page" id="post-<?php the_ID(); ?>">
				<h1><?php the_title(); ?></h1>
				<?php the_content('<p>Read the rest of this page &raquo;</p>'); ?>
				<?php wp_link_pages(array('before' => '<p>Pages: ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
	            <?php edit_post_link('Edit this entry', '<p>', '</p>'); ?>
			</div>
			<!-- /END MAIN COLUMN -->
	        
	        
			<!-- CHECK FOR REMOVE_SIDEBAR CUSTOM FIELD -->
        	<?php if(get_custom_field('remove_sidebar')) { ?>
												
					<?php } else { ?>
						
			        <!-- SIDEBAR COLUMN -->
			        <div id="sidebar" class="rounded">
							<ul>
							<?php dynamic_sidebar(1); ?>
			                </ul>             
			        </div>
			        <!-- /END SIDEBAR COLUMN -->	
			        
			<?php } ?>	
			
        
		</div>
		<!-- CONTENT CONTAINER -->
        
		<?php endwhile; endif; ?>
	
<?php get_footer(); ?>