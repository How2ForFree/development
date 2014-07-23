<?php
/**
 * Template Name: One Column
 */

get_header(); ?>
<!-- CONTAINER -->
<div id="container" class="subpage onecolumn clearfix">
    <!-- CONTENT -->
	<div id="content" class="mainbar">	
    <div id="content-wrapper">
        <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
    
            <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>> 
                <?php $hide_title = get_post_meta( get_the_ID(), 'misc_title' ); ?>
                <?php if ( $hide_title['0'] != 'yes') : ?>
                  <h1 class="entry-title"><?php the_title(); ?></h1>
                <?php endif; ?>
                
                <div class="entry-content">
                    <?php the_content(); ?>
    
                    <?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'corporate' ), 'after' => '</div>' ) ); ?>
    
                    <?php edit_post_link( __( 'Edit', 'corporate' ), '<span class="edit-link">', '</span>' ); ?>
                </div><!-- .entry-content -->
            </div><!-- #post-## -->
    
           <?php comments_template( '', true ); ?>
    
        <?php endwhile; ?>

    </div><!-- /#content-wrapper -->
	</div><!-- #content -->
</div><!-- #container -->
<?php get_footer(); ?>
