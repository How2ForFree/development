<?php
/**
 * @package WordPress
 * @subpackage Classic_Theme
 */
?>
<?php
//allows the theme to get info from the theme options page
/*global $options;
foreach ($options as $value) {
    if (lcp_option( $value['id'] ) === FALSE) { $$value['id'] = $value['std']; }
    else { $$value['id'] =lcp_option( $value['id'] ); }
     $$value['id'] = stripslashes($$value['id']);
    }    */
?>

<div id="footer" class="clearfix">
    <div id="footer_left"><?php echo lcp_option('lcp_footer_copyright'); ?></div>
    <div id="footer_right"><a href="<?php echo get_bloginfo('url');?>"><img src="<?php echo lcp_option('lcp_foot_logo'); ?>" alt="<?php echo get_bloginfo('name');?>" /></a></div>
</div>
<div id="footer_bottom" class="clearfix"></div><!--  END "footer"  //-->

</div><!--  END "wrapper"  //-->
<?php wp_footer(); ?> 
</body>
</html>
