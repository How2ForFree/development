
<?php
get_header();
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
<?php 
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////// SLIDER /////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//echo lcp_option( 'lcp_show_slider' ). "XXXX";
if(is_front_page() && lcp_option( 'lcp_show_slider' ) == "true" ){  // SLIDER START ?>
        <div id="featured_home" class="clearfix">
        	<div class="bigimg">
        	<?php 
            
             $my_args = array('cat' => lcp_option('lcp_cat_slider'),
            'posts_per_page' => 1,
            'post_type' => array('post', 'portfolio'),
            'order_by' => 'date');
            $my_query = new WP_Query($my_args);
 
            while ($my_query->have_posts()) : $my_query->the_post();
              if(lcp_option('lcp_cb_relative_links') == "true")
                        $image_link = lcp_option('lcp_tb_relative_path').get_post_meta($post->ID, 'mainimg', true);
              else
                  $image_link = get_post_meta($post->ID, 'mainimg', true); 
            $fixed_height = "";
            if(lcp_option('lcp_slider_fixed_height') == "true" )
              $fixed_height = '&amp;h='.lcp_option('lcp_slider_height');
          ?>
  
            	<img src="<?php echo get_bloginfo('template_url');?>/scripts/timthumb.php?src=<?php echo $image_link.$fixed_height;?>&amp;w=920&amp;zc=1" alt="Big Image" id="slider_main_img"/>
                <div class="post_info_holder clearfix">
                    <div class="post_category" id="slider_post_cat">/ <?php the_category(',');?> / </div>
                    <div class="post_name"><a href="<?php the_permalink(); ?>" id="slider_img_desc"><?php the_title(); ?></a></div>
                </div><!--  END "post_info_holder"  //-->
           <?php endwhile;  ?>
      		</div><!--  END "bigimg"  //-->
      		
      		
            <div class="slider" id="slider">
            	<div class="minus" id="slider_max">
                	<img src="<?php echo get_bloginfo('template_url');?>/skins/<?php echo get_option('lcp_color_skin');?>/gfx/slider_round.png" class="round" id="round_max" alt="round" />
                    <img src="<?php echo get_bloginfo('template_url');?>/images/slider_round_minus.png" class="sign" id="sign_max" alt="minus" />
                </div>
                	<div class="thumbs" id="thumbs">
                		<div class="slider_content" id="sl_content">
                			<ul id="slider_ul">
                	
                      <?php 
                      ////////////////////////////////////////////////////////////       
                      // SLIDER
                      ////////////////////////////////////////////////////////////       
                      $catid = $lcp_slider_id;                                                              

                       
                      $my_args = array('cat' => lcp_option('lcp_cat_slider'),
                      'posts_per_page' => lcp_option('lcp_slider_limiter'),
                      'order_by'  => 'date',
                      'post_type' => array('post', 'portfolio'));
                      
                      $my_query = new WP_Query($my_args);
                     
                     //query_posts(array_merge(array( 'post_type' => array('post', 'portfolio'), 'category__not_in' => $cats_home_exclude  ),$wp_query->query)); 
                     
                     // $my_query->set('post_type', array('post', 'portfolio'));
                      ?>
                      <?php while ($my_query->have_posts()) : $my_query->the_post(); ?>
                      <li>
                        <?php $slider_image = 'mainimg'; 
                        if(get_post_meta($post->ID, 'mainimg_small', true)!="" ) $slider_image = 'mainimg_small';
                         
                          if(lcp_option('lcp_cb_relative_links') == "true")
                              $image_path = lcp_option('lcp_tb_relative_path');
                          else
                              $image_path = ''; 
                          
                        ?>
                        <img src="<?php echo get_bloginfo('template_url');?>/scripts/timthumb.php?src=<?php echo $image_path; echo get_post_meta($post->ID, $slider_image, true);?>&amp;h=100&amp;w=152&amp;zc=1" alt="img" />
                        <div class="slider_tit" style="display:none"> / <?php the_category(',');?> / </div>
                        <a class="slider_desc" style="display:none" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        <a class="slider_img"  style="display:none" href="<?php echo get_bloginfo('template_url');?>/scripts/timthumb.php?src=<?php echo $image_path; echo get_post_meta($post->ID, 'mainimg', true).$fixed_height;?>&amp;w=920&amp;zc=1"></a>
                      </li>
                      <?php endwhile;  ?>
                      <?php
                      ////////////////////////////////////////////////////////////
                      ?>
                			</ul><!--  END "slider_ul"  //-->
                		</div><!--  END "sl_content"  //-->
                	</div><!--  END "thumbs"  //-->
                <div class="plus" id="slider_min">
                	<img src="<?php echo get_bloginfo('template_url');?>/skins/<?php echo get_option('lcp_color_skin');?>/gfx/slider_round.png" class="round" id="round_min" alt="round" />
                    <img src="<?php echo get_bloginfo('template_url');?>/images/slider_round_plus.png" class="sign" id="sign_min" alt="plus" />                
                </div><!--  END "slider_min"  //-->
            </div><!--  END "slider"  //-->
            
            
        </div><!--  END "featured_home"  //-->
<?php 
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////// SLIDER END//////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
?>      

<?php 
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////// MESSAGE BUTTONS ////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
?>        
      <?php if(lcp_option('lcp_show_msg') == 'true'){ ?>
        <div id="message_buttons">
			     <div class="button1"><a href="<?php echo lcp_option('lcp_msga_link'); ?>"><?php echo lcp_option('lcp_msga_title'); ?></a></div>
           <div class="button2"><a href="<?php echo lcp_option('lcp_msgb_link'); ?>"><?php echo lcp_option('lcp_msgb_title'); ?></a></div>
        </div><!--  END "message_buttons"  //-->
      <?php } ?>
<?php }
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////// MESSAGE BUTTONS ENDS ///////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
?>
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
             <?php
              if((lcp_option('lcp_hp_hide_blogposts') == "true" && is_home()) || !is_home() )
              {
              if (  $wp_query->have_posts()) : while (have_posts()) : the_post(); ?>
              <div class="entry fullwidth" id="post-<?php the_ID();?>">
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
                          <a href="<?php echo $big_image ?>" rel="prettyPhoto[Gallery]" title="Gallery"><img src="<?php echo get_bloginfo('template_url')."/scripts/timthumb.php?src=".$image_link."&amp;w=560&amp;zc=1"; ?>" alt="<?php the_title(); ?>"/></a>
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
                              the_excerpt(__('[..]'));
                              }
                              else
                              {
                                the_content(__('[..]')); 
                              }?>
                              <?php edit_post_link(__('Edit This entry')); ?>
                    </div><!--  END "entry_content"  //-->
<?php
                   }  
// <<<<<<<<<<<<<<<< END BLOG POST <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<


// >>>>>>>>>>>>>>>> PORTFOLIO >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
                  
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
                          <a href="<?php echo $big_image ?>" rel="prettyPhoto[Gallery]" title="Gallery"><img src="<?php echo get_bloginfo('template_url')."/scripts/timthumb.php?src=".$image_link."&amp;w=560&amp;zc=1"; ?>" alt="<?php the_title(); ?>"/></a>
                      <?php 
                      }
                      else
                      {
                    ?>
                          <a href="<?php the_permalink(); ?>"><img src="<?php echo get_bloginfo('template_url')."/scripts/timthumb.php?src=".$image_link."&amp;&amp;w=900&amp;zc=1"; ?>" alt="postimg"/></a>
                      
                      <?php }}} ?>
                    <div class="title_holder">
                        <h1><a href="<?php the_permalink(); ?>" class="title"><?php the_title(); ?></a></h1>
                    </div><!--  END "title_holder"  //-->
                    <div class="entry_content">
                       	<?php the_content(__('[..]')); ?>
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
        </div><!--  END "content_wrap"  //-->
    </div><!--  END "container"  //-->

<?php get_footer(); ?>
