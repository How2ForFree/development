<?php
/**
 * The template for displaying the footer.
 */
?>


<!-- Begin Footer -->


<?php
	/* A sidebar in the footer? Yep. You can can customize
	 * your footer with three columns of widgets.
	 */
	get_sidebar( 'footer' );
?>

<!-- End Footer --> 

<!-- Begin Footer Bottom -->
<div id="footer-bottom">
  <div id="footer-bottom-light"></div>
  <div class="footer-bottom-content">
    <div class="copyright">
      <p><?php echo get_option('of_footer_text'); ?></p>
    </div>
    <div class="social">
    	<?php if ( get_option('of_facebook') !='' ) {?>
        	<a href="<?php echo get_option('of_facebook'); ?>"><img src="<?php bloginfo('template_url'); ?>/style/images/social1.png" alt="Facebook" /></a>
        <?php } else {?>
        <?php }?>
    	
    	<?php if ( get_option('of_twitter') !='' ) {?>
        	<a href="<?php echo get_option('of_twitter'); ?>"><img src="<?php bloginfo('template_url'); ?>/style/images/social2.png" alt="Twitter" /></a>
        <?php } else {?>
        <?php }?>
        
        <?php if ( get_option('of_tumblr') !='' ) {?>
        	<a href="<?php echo get_option('of_tumblr'); ?>"><img src="<?php bloginfo('template_url'); ?>/style/images/social3.png" alt="Tumblr" /></a>
        <?php } else {?>
        <?php }?>
        
        <?php if ( get_option('of_flickr') !='' ) {?>
        	<a href="<?php echo get_option('of_flickr'); ?>"><img src="<?php bloginfo('template_url'); ?>/style/images/social4.png" alt="Flickr" /></a>
        <?php } else {?>
        <?php }?>
        
        <?php if ( get_option('of_stumbleupon') !='' ) {?>
        	<a href="<?php echo get_option('of_stumbleupon'); ?>"><img src="<?php bloginfo('template_url'); ?>/style/images/social5.png" alt="StumbleUpon" /></a>
        <?php } else {?>
        <?php }?>
        
        <?php if ( get_option('of_delicious') !='' ) {?>
        	<a href="<?php echo get_option('of_delicious'); ?>"><img src="<?php bloginfo('template_url'); ?>/style/images/social6.png" alt="Del.icio.us" /></a>
        <?php } else {?>
        <?php }?>
        
        <?php if ( get_option('of_rss') !='' ) {?>
        	<a href="<?php echo get_option('of_rss'); ?>"><img src="<?php bloginfo('template_url'); ?>/style/images/social7.png" alt="RSS Feed" /></a>
        <?php } else {?>
        <?php }?>
    </div>
  </div>
</div></div>
<!-- End Footer Bottom -->
</div>
<?php wp_footer();?>
</body>
</html>
