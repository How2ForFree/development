<?php
/**
 * @package WordPress
 * @subpackage Starkers
 */

get_header();
?>

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	
	<!-- CONTENT CONTAINER -->
	
	<!-- CHECK FOR REMOVE_SIDEBAR CUSTOM FIELD -->
	<?php if(get_custom_field('remove_sidebar')) { ?>
	<div id="container" style="width: 600px !important;">
	<?php } else { ?>
	<div id="container">
	<?php } ?>
	
		<!-- MAIN COLUMN -->
		<div <?php post_class("single_post rounded") ?> id="post-<?php the_ID(); ?>">
			<h1 class="title"><?php the_title(); ?></h1>
            
			<div class="the_content"><?php the_content('<p>Read the rest of this entry &raquo;</p>'); ?></div>
			<?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
			
			<br />
			<div class="font_size_small single_date"><?php the_time('l, F jS, Y') ?>. Filed under: <?php the_category(' ') ?></div>
			<?php the_tags( '<p class="post_tags">Tags: ', ' ', '</p>'); ?>
            <?php edit_post_link('Edit this entry','',''); ?>
            

			<div class="comment-list">
				<?php comments_template(); ?>
            </div>
            
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
	<?php endwhile; else: ?>

		<p>Sorry, no posts matched your criteria.</p>

<?php endif; ?>

<?php get_footer(); ?>