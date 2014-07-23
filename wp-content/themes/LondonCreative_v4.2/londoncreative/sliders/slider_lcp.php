<?php 
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////// SLIDER /////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
?>
        <div id="featured_home" class="clearfix">
        	<div class="bigimg">
        	<?php 
            
             $my_args = array('cat' => lcp_option('lcp_cat_slider'),
            'posts_per_page' => 1,
            'post_type' => array('post', 'portfolio'),
            'order_by' => 'date');
            $my_query = new WP_Query($my_args);
 
            while ($my_query->have_posts()) : $my_query->the_post();
            $fixed_height = "";
            if(lcp_option('lcp_slider_fixed_height') == "true" )
              $fixed_height = '&amp;h='.lcp_option('lcp_slider_height');
          ?>
  
            	<img src="<?php echo get_bloginfo('template_url');?>/scripts/timthumb.php?src=<?php echo get_post_meta($post->ID, 'mainimg', true).$fixed_height;?>&amp;w=920&amp;zc=1" alt="Big Image" id="slider_main_img"/>
                <div class="post_info_holder clearfix">
                    <div class="post_category" id="slider_post_cat">/ <?php the_category(',');?> / </div>
                    <div class="post_name"><a href="<?php the_permalink(); ?>" id="slider_img_desc"><?php the_title(); ?></a></div>
                </div><!--  END "post_info_holder"  //-->
           <?php endwhile;  ?>
      		</div><!--  END "bigimg"  //-->
      		
      		
            <div class="slider" id="slider">
            	<div class="minus" id="slider_max">
<img src="<?php echo get_bloginfo('template_url');?>/skins/<?php echo get_option('lcp_color_skin');?>/gfx/slider_round.png" class="round" id="round_max" alt="round" />
                    <img src="<?php echo get_bloginfo('template_url');?>/skins/<?php echo get_option('lcp_color_skin');?>/gfx/slider_round_minus.png" class="sign" id="sign_max" alt="minus" />
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
                        
                        ?>
                        <img src="<?php echo get_bloginfo('template_url');?>/scripts/timthumb.php?src=<?php echo get_post_meta($post->ID, $slider_image, true);?>&amp;h=100&amp;w=152&amp;zc=1" alt="img" />
                        <div class="slider_tit" style="display:none"> / <?php the_category(',');?> / </div>
                        <a class="slider_desc" style="display:none" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        <a class="slider_img"  style="display:none" href="<?php echo get_bloginfo('template_url');?>/scripts/timthumb.php?src=<?php echo get_post_meta($post->ID, 'mainimg', true).$fixed_height;?>&amp;w=920&amp;zc=1"></a>
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
                    <img src="<?php echo get_bloginfo('template_url');?>/skins/<?php echo get_option('lcp_color_skin');?>/gfx/slider_round_plus.png" class="sign" id="sign_min" alt="plus" />                
               </div><!--  END "slider_min"  //-->
            </div><!--  END "slider"  //-->
            
            
        </div><!--  END "featured_home"  //-->
<?php 
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////// SLIDER END//////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
?> 