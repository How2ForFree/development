<?php /*
Template Name: Gallery Fullwidth
*/ ?>
<?php
if(is_home() || is_category())
query_posts(array_merge(array( 'post_type' => array('post', 'portfolio') ),$wp_query->query));   // enable blog and portfolio posts
/**
 * @package WordPress
 * @subpackage Classic_Theme
 */
get_header();
?>
<?php
//allows the theme to get info from the theme options page
/*global $options;
foreach ($options as $value) {
    if (lcp_option( $value['id'] ) === FALSE) { $$value['id'] = $value['std']; }
    else { $$value['id'] =lcp_option( $value['id'] ); }
     $$value['id'] = stripslashes($$value['id']); 
    }                                             */
?>


    <div id="border_top"></div><!--  END "border_top"  //-->
    <div id="header" class="clearfix">
        <div id="logo">
        	<a href="<?php echo get_bloginfo('url');?>">
            <?php $logoIMG = lcp_option('lcp_head_logo');
            if(@$_SERVER["HTTPS"] == 'on'){
               $logoIMG = substr_replace($logoIMG,"https://",0,7);
            }
          ?>
          <img src="<?php echo $logoIMG;  ?>" alt="<?php echo get_bloginfo('name');?>" id="lclogo"/>
          </a>
        </div><!--  END "logo"  //-->
        <div id="header_contacts"><?php echo lcp_option('lcp_head_info'); ?></div>
    </div><!--  END "header"  //-->
    <div id="container" class="clearfix">
    	<div id="toppanel" class="clearfix">
            <div id="navigation">
                 <?php dynamic_sidebar('Navigation'); ?>
            </div><!--  END "navigation"  //-->
            <div id="search">
                  <form id="searchform" action="<?php echo get_bloginfo('wpurl');?>" method="get">
                        <div>
                             <input id="s" class="field" type="text" onblur="if (this.value == '') {this.value = '<?php echo lcp_option('lcp_srch_input_text'); ?>';}" onfocus="if (this.value == '<?php echo lcp_option('lcp_srch_input_text');?>') {this.value = '';}" value="<?php echo lcp_option('lcp_srch_input_text');?>" name="s"/>
                             <input class="submit" type="submit" name="submit" value="<?php echo lcp_option('lcp_srch_name'); ?>"/>
                        </div>
                  </form>
            </div><!--  END "search"  //-->
            
      </div><!--  END "toppanel"  //-->
        <div id="content_wrap">
          <div id="inner_content">
<?php 
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////// MAIN LOOP //////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/*
 there are "rendering" all the posts and Pages.
*/
?>       
             <?php if (  $wp_query->have_posts()) : while (have_posts()) : the_post(); ?>
            
<?php
// >>>>>>>>>>>>>>>> PORTFOLIO & PAGE POST >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>

?>             
             <div class="entry fullwidth" id="post-<?php the_ID();?>">      
                    <?php if(get_post_meta($post->ID, 'mainimg', true) != ""){ ?>
                      <a href="<?php echo get_bloginfo('template_url')."/".get_post_meta($post->ID, 'mainimg', true); ?>" rel="prettyPhoto[portfolio]" title="portfolio"><img src="<?php echo get_bloginfo('template_url')."/scripts/timthumb.php?src=".get_post_meta($post->ID, 'mainimg', true)."&amp;h=170&amp;w=560&amp;zc=1"; ?>" alt="port1.jpg"/></a>
                    <?php } ?>    
                    <div class="title_holder">
                        <h1><a href="<?php the_permalink(); ?>" class="title"><?php the_title(); ?></a></h1>
                    </div><!--  END "title_holder"  //-->
                    <div class="entry_content">
                       	<?php the_content(__('[..]')); ?>
                       	<?php edit_post_link(__('Edit This entry')); ?>
                    </div><!--  END "entry_content"  //-->
                    <div id="gallery_fullwidth">
                      <?php
                      $attachment_args = array(
                           'post_type' => 'attachment',
                           'numberposts' => -1,          // one attachement image per post
                           'post_status' => null,
                           'post_parent' =>$post->ID,
                           'orderby' => 'menu_order ID'
                      );
                      if(current_user_can(read_private_pages))
                        $attachments = get_posts($attachment_args);
                      if ($attachments) {
                        foreach($attachments as $gall_image )                                                                 
                        {
                          $att_img =  wp_get_attachment_url( $gall_image->ID);
                          echo '<a title="'.$gall_image->post_title.'" rel="prettyPhoto[Gallery]" href="'.$att_img.'" class="gallery_link">';
                          echo  '<img src="'.get_bloginfo('template_url').'/scripts/timthumb.php?src='.$att_img.'&amp;w=133&amp;h=133&amp;zc=1" class="gallery_thumb" alt=""/>';
                          echo '</a>';
                        }
                      }
                        ?>
                            <div class="clear"></div>
                     	</div><!--  END "gallery"  //-->
                    <div class="comments">
                    <?php comments_template(); ?>
                    </div>
              </div>                    
<?php                   
                  
// <<<<<<<<<<<<<<<< END PORTFOLIO & PAGE POST <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
?>

<?php 
// >>>>>>>>>>>>>>>> NO-POST >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
endwhile; 
             
endif;
// <<<<<<<<<<<<<<<< END NO-POST <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////// END MAIN LOOP //////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////?> 

            
          </div><!--  END "inner_content"  //-->
          

        </div><!--  END "content_wrap"  //-->
    </div><!--  END "container"  //-->

<?php get_footer(); ?>
