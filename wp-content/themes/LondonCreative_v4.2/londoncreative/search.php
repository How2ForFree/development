<?php
              $blog_cats =   lcp_option('lcp_cat_blog');
              if(strpos($blog_cats,",")!= -1) $blog_cats =  split(",", lcp_option('lcp_cat_blog'));
              
              $portfolio_cats =   lcp_option('lcp_cat_portfolio');
              if(strpos($portfolio_cats,",")!= -1) $portfolio_cats =  split(",", lcp_option('lcp_cat_portfolio'));
              $portfolio_home_exclude[0] = null;
              

              if(lcp_option('lcp_hp_exclude_portfolio') == 'true') $portfolio_home_exclude = $portfolio_cats;
              
              $exclude_home_cats = split(",", lcp_option('lcp_hp_exclude_cats'));
             // if(strpos($exclude_home_cats,",")= -1) $exclude_home_cats =  split(",", lcp_option('lcp_hp_exclude_cats'));
              $cats_home_exclude = array_merge( $exclude_home_cats, $portfolio_home_exclude);
if(is_home())
query_posts(array_merge(array( 'post_type' => array('post', 'portfolio'), 'category__not_in' => $cats_home_exclude  ),$wp_query->query));   // enable blog and portfolio posts
else query_posts(array_merge(array( 'post_type' => array('post', 'portfolio') ),$wp_query->query));   // enable blog and portfolio posts

query_posts(array_merge(array('posts_per_page' => get_option('lcp_ppp_search')),$wp_query->query));
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
        	<a href="<?php echo get_bloginfo('wpurl');?>">
            <img src="<?php echo lcp_option('lcp_head_logo'); ?>" alt="<?php echo get_bloginfo('name');?>" id="lclogo"/>
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
                  // RENDER PORTFOLIO POSTS ?
                  $render_portfolio = false;
                  if(lcp_option('lcp_cat_render_portfolio') == "true")
                  {
                    if(is_category($portfolio_cats) || post_in_child_cat($portfolio_cats) ) $render_portfolio = true;
                  }
// >>>>>>>>>>>>>>>> BLOG POST >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
                   if(get_post_type( $post ) == 'post' && !$render_portfolio){
?>              
                    <?php if(get_post_meta($post->ID, 'mainimg', true) != "" || get_post_meta($post->ID, 'mainimg_medium', true) != "" || get_post_meta($post->ID, 'embed_video', true) != ""){ 
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
                          <a href="<?php echo $big_image ?>" rel="prettyPhoto[portfolio]" title="portfolio"><img src="<?php echo get_bloginfo('template_url')."/scripts/timthumb.php?src=".$image_link."&amp;w=560&amp;zc=1"; ?>" alt="<?php echo $post->post_name; ?>"/></a>
                      <?php 
                      }
                      else
                      {
                    ?>
                          <a href="<?php the_permalink(); ?>"><img src="<?php echo get_bloginfo('template_url')."/scripts/timthumb.php?src=".$image_link."&amp;&amp;w=560&amp;zc=1"; ?>" alt="postimg"/></a>
                      
                      <?php }}} ?>
                    <div class="date clearfix">
                        <div class="date_holder">
                            <?php the_time('\<\s\p\a\n \c\l\a\s\s\=\"\m\o\n\t\h\"\>M\<\s\p\a\n\ \c\l\a\s\s\=\"\y\e\a\r\"\> Y \<\/\s\p\a\n\>\<\/\s\p\a\n\>\<\s\p\a\n\ \c\l\a\s\s\=\"\d\a\y\"\>d\<\/\s\p\a\n\>','',''); ?>
                        </div><!--  END "date_holder"  //-->
                    </div><!--  END "date"  //-->
                    <div class="title_holder">
                        <h1><a href="<?php the_permalink(); ?>" class="title"><?php the_title(); ?></a><?php if(('open' == $post-> comment_status))  comments_popup_link('0','1', '%', 'comment_counter'); ?></h1>
                        <h3>Posted In <span><?php the_category(','); ?></span></h3>
                    </div><!--  END "title_holder"  //-->
                    <div class="entry_content">
							 <?php
                              if(!empty($post->post_excerpt)) {
                                the_excerpt(__(get_option('lcp_translate_readmore')));
                                echo '<a href="'; the_permalink(); echo '" class="more-link">'.get_option('lcp_translate_readmore').'</a>';
    
                              }
                              else
                              {
                                the_content(__(get_option('lcp_translate_readmore'))); 
                              }
                              ?>
                              <?php edit_post_link(__('Edit This entry')); ?>
                    </div><!--  END "entry_content"  //-->
<?php
                   }  
// <<<<<<<<<<<<<<<< END BLOG POST <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<


// >>>>>>>>>>>>>>>> PORTFOLIO & PAGE POST >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
                  
                   else if(get_post_type( $post ) == 'portfolio' || get_post_type( $post ) == 'page' || $render_portfolio)
                   {
?>                   
                    <?php if(get_post_meta($post->ID, 'mainimg', true) != "" || get_post_meta($post->ID, 'mainimg_medium', true) != "" || get_post_meta($post->ID, 'embed_video', true) != ""){ 
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
                          <a href="<?php echo $big_image ?>" rel="prettyPhoto[portfolio]" title="portfolio"><img src="<?php echo get_bloginfo('template_url')."/scripts/timthumb.php?src=".$image_link."&amp;w=560&amp;zc=1"; ?>" alt="<?php echo $post->post_name; ?>"/></a>
                      <?php 
                      }
                      else
                      {
                    ?>
                          <a href="<?php the_permalink(); ?>"><img src="<?php echo get_bloginfo('template_url')."/scripts/timthumb.php?src=".$image_link."&amp;&amp;w=560&amp;zc=1"; ?>" alt="postimg"/></a>
                      
                      <?php }}} ?>
                    <div class="title_holder">
                        <h1><a href="<?php the_permalink(); ?>" class="title"><?php the_title(); ?></a></h1>
                    </div><!--  END "title_holder"  //-->
                    <div class="entry_content">
                             <?php
                              if(!empty($post->post_excerpt)) {
                                the_excerpt(__(get_option('lcp_translate_readmore')));
                                echo '<a href="'; the_permalink(); echo '" class="more-link">[..]</a>';

                              }
                              else
                              {
                                the_content(__(get_option('lcp_translate_readmore'))); 
                              }
                              ?>

                       	<?php edit_post_link(__('Edit This entry')); ?>
                    </div><!--  END "entry_content"  //-->
<?php                   
                   }
                     
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
<?php if(function_exists('wp_pagenavi')) { wp_pagenavi(); } ?>  <!-- You need to have WP-PageNavi plugin installed for using this!-->
          </div><!--  END "inner_content"  //-->

<?php              
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////// SIDEBARS ///////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////?>                     
          <div id="sidebar_home">
          <?php

               if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Page Sidebar") ) :
               endif;
  
           ?>  
          </div><!--  END "sidebar_home"  //-->
<?php          
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////// END SIDEBARS ///////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////?>           
          
        </div><!--  END "content_wrap"  //-->
    </div><!--  END "container"  //-->

<?php get_footer(); ?>
