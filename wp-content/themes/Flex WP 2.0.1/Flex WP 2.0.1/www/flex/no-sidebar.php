<?php
/**
 * @package WordPress
 * @subpackage Starkers
 */
/*
 * Template Name: No Sidebar
*/
get_header(); ?>

		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<div class="post rounded single_page" id="post-<?php the_ID(); ?>">
			<h1><?php the_title(); ?></h1>
			<?php the_content('<p>Read the rest of this page &raquo;</p>'); ?>
			<?php wp_link_pages(array('before' => '<p>Pages: ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
            <?php edit_post_link('Edit this entry', '<p>', '</p>'); ?>
		</div>
		        
        
		<?php endwhile; endif; ?>
	
<?php get_footer(); ?>