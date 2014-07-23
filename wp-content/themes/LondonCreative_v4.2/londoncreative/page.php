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
              <div class="entry" id="post-<?php the_ID();?>">
<?php
// >>>>>>>>>>>>>>>> PORTFOLIO & PAGE POST >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>

?>                   
                    <?php if(get_post_meta($post->ID, 'mainimg', true) != "" || get_post_meta($post->ID, 'mainimg_medium', true) != "" || get_post_meta($post->ID, 'embed_video', true) != ""){ 
                        $img_height = '';
                        if(get_option('lcp_page_height') != '' )
                          $img_height = '&amp;h='.get_option('lcp_page_height');
                    
                      //echo    iget_post_meta($post->ID, 'mainimg_medium', true)."k";
                        $image_customfield_name = 'mainimg';
                      if(get_post_meta($post->ID, 'mainimg_medium', true) != "") $image_customfield_name = 'mainimg_medium';
                      $image_link = "";
                      if(lcp_option('lcp_cb_relative_links') == "true"){
                        $image_link = lcp_option('lcp_tb_relative_path').get_post_meta($post->ID, $image_customfield_name, true);
                        $big_image = lcp_option('lcp_tb_relative_path').get_post_meta($post->ID, 'mainimg', true);
                      }
                      else
                      {
                        $image_link = get_post_meta($post->ID, $image_customfield_name, true);
                        $big_image = get_post_meta($post->ID, 'mainimg', true);
                      }
                      
                      if(get_post_meta($post->ID, 'embed_video', true) != "")
                        echo stripslashes(get_post_meta($post->ID, 'embed_video', true));
                      else
                      { 
                      if(get_post_meta($post->ID, 'show_lightbox', true) == "true" )
                      { ?>
                          <a href="<?php echo $big_image ?>" rel="prettyPhoto[portfolio]" title="portfolio"><img src="<?php echo get_bloginfo('template_url')."/scripts/timthumb.php?src=".$image_link."&amp;w=560&amp;zc=1".$img_height; ?>" alt="<?php the_title(); ?>"/></a>
                      <?php 
                      }
                      else
                      {
                    ?>
                          <a href="<?php the_permalink(); ?>"><img src="<?php echo get_bloginfo('template_url')."/scripts/timthumb.php?src=".$image_link."&amp;&amp;w=560&amp;zc=1".$img_height; ?>" alt="<?php the_title(); ?>"/></a>
                      
                      <?php }}} ?>
                      <?php if ( get_post_meta($post->ID, 'page_title', true) != "false" ){ ?>  
                    <div class="title_holder">
                        <h1><a href="<?php the_permalink(); ?>" class="title"><?php the_title(); ?></a></h1>
                    </div><!--  END "title_holder"  //-->
                    <?php } ?>
                    <div class="entry_content">
                       	<?php the_content(__('[..]')); ?>
                       	<?php edit_post_link(__('Edit This entry')); ?>
                    </div><!--  END "entry_content"  //-->
                    <div class="comments">
                    <?php if(('open' == $post-> comment_status)) comments_template(); ?>
                    </div>
<?php                   
                  
// <<<<<<<<<<<<<<<< END PORTFOLIO & PAGE POST <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
?>
              </div><!--  END "entry"  //-->
<?php 
// >>>>>>>>>>>>>>>> NO-POST >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
endwhile; 
else:
?>
    <div class="entry">
      <div class="entry_content">
        <h3><span><?php echo lcp_option('lcp_srch_nopost');?></span></h3>
      </div>
    </div>
<?php
endif;
// <<<<<<<<<<<<<<<< END NO-POST <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////// END MAIN LOOP //////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////?> 

            
          </div><!--  END "inner_content"  //-->
          
          <div id="sidebar_home">
          <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Page Sidebar") ) :
               endif;
          ?>
          </div><!--  END "sidebar_home"  //-->
        </div><!--  END "content_wrap"  //-->
    </div><!--  END "container"  //-->

<?php get_footer(); ?>
