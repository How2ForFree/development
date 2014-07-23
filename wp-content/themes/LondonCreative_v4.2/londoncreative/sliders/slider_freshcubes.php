<div id="featured_home" class="clearfix"> 
<div class="slider_shadow">

<?php
  global $wpdb;
  $table_name = $wpdb->prefix.'fresh_slider';
  $result = mysql_query("SELECT * FROM $table_name  ORDER BY img_order ASC");
  $r2 = mysql_query("SELECT * FROM $table_name ORDER BY img_order ASC LIMIT 1");
  $r2r = mysql_fetch_array($r2);
  if($r2r['lightbox'] == 1){
  //$pttyPhoto = 'rel="PrettyPhoto[Gallery]"';
  }    
  $img_count = mysql_num_rows($result);
?>
                <div class="post_info_holder clearfix">
                    <div class="post_category" id="slider_post_cat">/ <a href="<?php echo $r2r['link_url']; ?>" title="View all posts in Web Design" <?php echo $pttyPhoto; ?>><?php echo $r2r['alt']; ?></a> / </div>
                    <div class="post_name"><a href="<?php echo $r2r['link_url']; ?>" <?php echo $pttyPhoto; ?> id="slider_img_desc"><?php echo $r2r['description']; ?></a></div>
                </div><!--  END "post_info_holder"  //--> 
        <div id="slider_freshcubes" style="background-image: url('<?php echo get_bloginfo('template_url').'/scripts/timthumb.php?src='.$r2r['image_url'].'&amp;w=920&amp;h=350&amp;zc=1'; ?>')">
<?php


$c_w = 120;
$c_h = 120;
for($w =0; $w < 8; $w++)
{
  for($h=0; $h <3; $h++)
  {
    echo '<div class="fresh_cube" id="fresh_cube_'.$w.'_'.$h.'" style="left:'.($w*120).'px; top:'.($h*120).'px; background-position:'.($w*-120).'px '.($h*-120).'px; background-image: url("'.get_bloginfo('template_url').'/scripts/timthumb.php?src='.$r2r['image_url'].'&amp;w=920&amp;h=350&amp;zc=1");"></div>';
  }
}
?>
            
               
          <ul id="fresh_cube_data">
            <?php
            $id_object = 0;
            while($row = mysql_fetch_array($result))
            {
              echo '<li class="fresh_cube_image_'.$id_object.'" >';
              echo  '<img src="'.get_bloginfo('template_url').'/scripts/timthumb.php?src='.$row['image_url'].'&amp;w=920&amp;h=350&amp;zc=1" />';//echo '<span class="img_src">'.$row['image_url'].'</span>';                            
              echo  '<span class="transition" title="'.$row['transition'].'">

                    <div class="post_category" id="slider_post_cat">/ <a href="'.$row['link_url'].'" title="View all posts in Web Design" rel="category">'.$row['alt'].'</a> / </div>
                    <div class="post_name"><a href="'.$row['link_url'].'" id="slider_img_desc">'.$row['description'].'</a></div>


              </span>';
              echo '<span class="ligthbox" title="'.$row['lightbox'].'">'.$row['link_url'].'</span>';
              echo '</li>';
              $id_object++;
            }
            ?>
          </ul>
		  <div class="slide_left"></div>
		  <div class="slide_right"></div>
          <div class="slide_info">


     <!--     <div class="slide_desc">
          	<h4 class="slide_title"><?php echo $r2r['alt']; ?></h4>
            <p><?php echo $r2r['description']; ?></p>
          </div>           -->
 
          
          </div>
        </div><!-- END "div.slider_fresh" -->
  </div>
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
                      $table_name = $wpdb->prefix.'fresh_slider';
                      $result = mysql_query("SELECT * FROM $table_name ORDER BY img_order ASC");
                      $img_count = mysql_num_rows($result);  
                             
                     //query_posts(array_merge(array( 'post_type' => array('post', 'portfolio'), 'category__not_in' => $cats_home_exclude  ),$wp_query->query)); 
                     
                     // $my_query->set('post_type', array('post', 'portfolio'));
                      ?>
                      <?php
                       $counter = 0;
                       while ($row = mysql_fetch_array($result))
                      { ?>
                      <li>
                        <?php $slider_image = 'mainimg'; 
                        if(get_post_meta($post->ID, 'mainimg_small', true)!="" ) $slider_image = 'mainimg_small';
                        
                        ?>
                        <img src="<?php echo get_bloginfo('template_url');?>/scripts/timthumb.php?src=<?php echo $row['image_url']; ?>&amp;h=100&amp;w=152&amp;zc=1" alt="img" />
                        <div class="slider_tit" style="display:none"> / <?php echo $row['alt'];?> / </div>
                        <a class="slider_desc" title="<?php echo $counter; ?>" style="display:none" href="<?php echo $row['link_url']; ?>"><?php echo $row['description']; ?></a>
                        <a class="slider_img" title="<?php echo $row['lightbox']; ?>"  style="display:none" href="<?php echo get_bloginfo('template_url');?>/scripts/timthumb.php?src=<?php echo $row['image_url'].$fixed_height; ?>&amp;w=920&amp;zc=1"></a>
                        
                      </li>
                      <?php $counter++; } ?>
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
</div>  