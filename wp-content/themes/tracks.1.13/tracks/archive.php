<?php get_header(); ?>
    
<?php

// The loop
if ( have_posts() ) :
    while (have_posts() ) :
        the_post();
        get_template_part('content');
    endwhile;
endif; ?>

<?php ct_tracks_post_navigation(); ?>

<?php get_footer(); ?>