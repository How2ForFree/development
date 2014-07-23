<?php
/**
 * @package WordPress
 * @subpackage London Creative
 */
// this line is really important for correct working portfolio posts
  query_posts(array_merge(array( 'post_type' => array('post', 'portfolio') ),$wp_query->query));
   if( is_category() )
  {
    $cat_id = $wp_query->get('cat');
    if(get_option($cat_id.'-cat_orderby') != 'none' && get_option($cat_id.'-cat_orderby') != '')
    {
       query_posts(array_merge(array( 'orderby' => get_option($cat_id.'-cat_orderby'), 'order' => get_option($cat_id.'-cat_order')),$wp_query->query));
    }
  }

  
get_header();

/**
 * here is located only PHP stuff for excluding some portfolio posts from home page,
 * getting all the portfolio categories and other important functions.
 */
// get blog categories from freshpanel                                                /*
$blog_cats =   lcp_option('lcp_cat_blog');
  if(strpos($blog_cats,",")!= -1) $blog_cats =  split(",", lcp_option('lcp_cat_blog'));

// get portfolio categories from freshpanel
$portfolio_cats =   lcp_option('lcp_cat_portfolio');
  if(strpos($portfolio_cats,",")!= -1) $portfolio_cats =  split(",", lcp_option('lcp_cat_portfolio'));
  $portfolio_home_exclude[0] = null;


if(lcp_option('lcp_hp_exclude_portfolio') == 'true') $portfolio_home_exclude = $portfolio_cats;
  $exclude_home_cats = split(",", lcp_option('lcp_hp_exclude_cats'));

  $cats_home_exclude = array_merge( $exclude_home_cats, $portfolio_home_exclude);

if( is_home() )
{
    if(!$cats_home_exclude[0])// $cats_home_exclude = '0';
    {

        query_posts(array_merge(array( 'post_type' => array('post', 'portfolio'),'posts_per_page' => get_option('lcp_ppp_home'), 'orderby'=>'date','order'=>'DESC'),$wp_query->query));   // enable blog and portfolio posts
    }
    else
    {
        query_posts(array_merge(array( 'post_type' => array('post', 'portfolio'),'category__not_in' =>  $cats_home_exclude  ,'posts_per_page' => get_option('lcp_ppp_home'), 'orderby'=>'date','order'=>'DESC'),$wp_query->query));   // enable blog and portfolio posts
        
    }
}
else {
    $category_template = get_option(get_cat_ID(single_cat_title("", false)).'-cat_template');
    query_posts(array_merge(array( 'post_type' => array('post', 'portfolio'), 'orderby'=>'date','order'=>'ASC' ),$wp_query->query));
}   // enable blog and portfolio posts

if(is_category($portfolio_cats) || post_in_child_cat($portfolio_cats) ||  get_post_type($post) == 'portfolio')
    query_posts(array_merge(array('posts_per_page' => get_option('lcp_ppp_portfolio')),$wp_query->query));
else
  query_posts(array_merge(array('posts_per_page' => get_option('lcp_ppp_blog')),$wp_query->query));
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
<?php 
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////// SLIDER /////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$to_require = 'freshcubes';
if(get_option('lcp_show_slider_old') == 'true') $to_require = 'lcp';

if(is_front_page() && lcp_option( 'lcp_show_slider' ) == "true" )
    require 'sliders/slider_'.$to_require.'.php';

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////// SLIDER END//////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
?>      

<?php 
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////// MESSAGE BUTTONS ////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
?>        
      <?php if(lcp_option('lcp_show_msg') == 'true' && is_home() ){ ?>
        <div id="message_buttons">
			     <div class="button1"><a href="<?php echo lcp_option('lcp_msga_link'); ?>"><?php echo lcp_option('lcp_msga_title'); ?></a></div>
           <div class="button2"><a href="<?php echo lcp_option('lcp_msgb_link'); ?>"><?php echo lcp_option('lcp_msgb_title'); ?></a></div>
        </div><!--  END "message_buttons"  //-->
      <?php } ?>
<?php
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////// MESSAGE BUTTONS ENDS ///////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
?>
        <div id="content_wrap">
          <div id="inner_content" class="<?php if($category_template == 'fullwidth') echo 'content_fullwidth';?>">
<?php 
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////// MAIN LOOP //////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/*
 there are "rendering" all the posts and Pages.
*/
?>       
             <?php
              if((lcp_option('lcp_hp_hide_blogposts') == "true" && is_home()) || !is_home() )
              {
              if (  $wp_query->have_posts()) : while (have_posts()) : the_post(); ?>
              <?php 
/**
 * FULLWIDTH POST UPGRADE
 **/                 
                  $img_fullwidth_size = 560;
                  $fullwidth = '';
                  if(($category_template == 'fullwidth' ) && !is_home ()) 
                  {
                   
                    $fullwidth = 'fullwidth';
                    $img_fullwidth_size = 900;
                  }

/**
 * END FULLWIDTH POST UPGRADE
 **/                    
              ?>
              <div class="entry <?php echo $fullwidth;?>" id="post-<?php the_ID();?>">
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
                        $img_height = '';
                        if(get_option('lcp_blog_height') != '' )
                          $img_height = '&amp;h='.get_option('lcp_blog_height');
                      
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
                          <a href="<?php echo $big_image ?>" rel="prettyPhoto[Gallery]" title="Gallery"><img src="<?php echo get_bloginfo('template_url')."/scripts/timthumb.php?src=".$image_link."&amp;w=".$img_fullwidth_size."&amp;zc=1".$img_height; ?>" alt="<?php the_title(); ?>"/></a>
                      <?php 
                      }
                      else
                      {
                    ?>
                          <a href="<?php the_permalink(); ?>"><img src="<?php echo get_bloginfo('template_url')."/scripts/timthumb.php?src=".$image_link."&amp;w=".$img_fullwidth_size."&amp;zc=1".$img_height; ?>" alt="<?php the_title(); ?>"/></a>
                      
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
                                echo '<a href="'; the_permalink(); echo '" class="more-link">'; echo stripslashes(get_option('lcp_translate_readmore')); echo '</a>';

                              }
                              else
                              {
                                the_content(__(stripslashes(get_option('lcp_translate_readmore')))); 
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
                        $img_height = '';
                        if(get_option('lcp_portfolio_height') != '' )
                          $img_height = '&amp;h='.get_option('lcp_portfolio_height');
                     
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
                          <a href="<?php echo $big_image ?>" rel="prettyPhoto[Gallery]" title="Gallery"><img src="<?php echo get_bloginfo('template_url')."/scripts/timthumb.php?src=".$image_link."&amp;w=".$img_fullwidth_size."&amp;zc=1".$img_height; ?>" alt="<?php the_title(); ?>"/></a>
                      <?php 
                      }
                      else
                      {
                    ?>
                          <a href="<?php the_permalink(); ?>"><img src="<?php echo get_bloginfo('template_url')."/scripts/timthumb.php?src=".$image_link."&amp;w=".$img_fullwidth_size."&amp;zc=1".$img_height; ?>" alt="<?php the_title(); ?>"/></a>
                      
                      <?php }}} ?>
                    <div class="title_holder">
                        <h1><a href="<?php the_permalink(); ?>" class="title"><?php the_title(); ?></a></h1>
                    </div><!--  END "title_holder"  //-->
                    <div class="entry_content">
                       	<?php
                              if(!empty($post->post_excerpt)) {
                                the_excerpt(__(stripslashes(get_option('lcp_translate_readmore'))));
                                echo '<a href="'; the_permalink(); echo '" class="more-link">'; echo stripslashes(get_option('lcp_translate_readmore')); echo '</a>';


                              }
                              else
                              {
                                the_content(__(stripslashes(get_option('lcp_translate_readmore')))); 
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
}
// <<<<<<<<<<<<<<<< END NO-POST <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////// END MAIN LOOP //////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////?>         
<?php if(function_exists('wp_pagenavi') && ((lcp_option('lcp_hp_hide_blogposts') == "true" && is_home()) || !is_home() )) { wp_pagenavi(); } ?>  <!-- You need to have WP-PageNavi plugin installed for using this!-->
          </div><!--  END "inner_content"  //-->

<?php              
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////// SIDEBARS ///////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////?>  
<?php if($category_template != 'fullwidth' ){ ?>                       
          <div id="sidebar_home">
          <?php

              if(is_home() )
             {
               if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Home Sidebar") ) :
               endif; 
             }
             if(is_page())
             {
               if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Page Sidebar") ) :
               endif;
             }
              if(!is_category($portfolio_cats) && !is_home())
             {
               if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Blog Sidebar") ) :
               endif;
             }
              if(is_category($portfolio_cats))
             {
               if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Portfolio Sidebar") ) :
               endif;
             }             
             
           ?>  
          </div><!--  END "sidebar_home"  //-->
<?php } ?>          
<?php          
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////// END SIDEBARS ///////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////?>           
          
        </div><!--  END "content_wrap"  //-->
    </div><!--  END "container"  //-->

<?php get_footer(); ?>
