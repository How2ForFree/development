<?php
class FreshPopular_Widget extends WP_Widget {
  function FreshPopular_Widget()
  {
    /* Widget settings. */
		$widget_ops = array( 'classname' => 'freshpopular', 'description' => __('Custom popular posts widget widget by freshface', 'examplesss') );

		/* Widget control settings. */
		$control_ops = array( 'width' => 300, 'height' => 850, 'id_base' => 'freshpopular-widget' );

		/* Create the widget. */
		$this->WP_Widget( 'freshpopular-widget', __('FreshPopular', 'example'), $widget_ops, $control_ops );
  }
   function widget( $args, $instance ) 
  {
		  extract( $args );
	
    	$title = apply_filters('widget_title', $instance['title'] );
  		$limiter = $instance['limiter'];

 

   global $wpdb;
  $limit = get_option('st_blogpost_popular_count');
  $table_name = $wpdb->prefix.'posts'; 
  $result = mysql_query("SELECT * FROM $table_name WHERE post_status = 'publish' AND post_type='post' ORDER BY comment_count DESC LIMIT $limiter");
  ?>
<?php echo  $before_widget.$before_title.$title.$after_title; ?>
                    <ul id="rp_posts_popular">

               
  <?php
  while($row = mysql_fetch_array($result))
  {
    
      //$popular_query = new WP_Query();
	    //$popular_query->query('p='.$row['ID']);
	    
	   // if ($popular_query->have_posts()):
    	
    	//while ($popular_query->have_posts()) : $popular_query->the_post();
    	 $popular_post = get_post($row['ID']);
		 $attachement_img =      get_post_meta($row['ID'], 'mainimg', true);
          echo '<li>';
         // echo 'sdsdsd';
            if($attachement_img == '') $attachement_img = get_bloginfo('template_url').'/gfx/rp_thumb_blank.png'; 
            
            {  echo '<a href="'; echo get_permalink($popular_post->ID); echo'">'; echo '<img class="rp_thumb" src="'.get_bloginfo('template_url').'/scripts/timthumb.php?src='.$attachement_img.'&amp;w=60&amp;h=60&amp;zc=1" alt="';  echo $popular_post->post_title; echo '" />';   echo '</a>'; }
            echo '<a href="'; echo get_permalink($popular_post->ID); echo'" class="rp_title">'; echo $popular_post->post_title; echo '</a>';
			echo '<br />'; echo '<span class="rp_date">';  echo date(get_option('lcp_translate_date'),strtotime($popular_post->post_date)); echo '</span>'; echo '<div class="clear"></div>';
          echo '</li>';

    //	endwhile;
    	//else:
    //	echo 'No popular posts';
    	//endif;

  }

                            ?>
  </ul><!-- END "ul#rp_popular" -->                     
                            <?php
							echo $after_widget;


	}
  	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags for title and name to remove HTML (important for text inputs). */
		$instance['title'] =  $new_instance['title'];
		$instance['limiter'] =  $new_instance['limiter'];
		  return $instance;
    }
   	function form( $instance ) 
  {

		/* Set up some default widget settings. */
		$defaults = array( 'title' => 'FreshPopular',
                       'limiter' => '3');
                       
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
  
		<!-- Widget Title: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'hybrid'); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
		</p>
    
		<p>
			<label for="<?php echo $this->get_field_id( 'limiter' ); ?>"><?php _e('Limiter:', 'hybrid'); ?></label>
			<input id="<?php echo $this->get_field_id( 'limiter' ); ?>" name="<?php echo $this->get_field_name( 'limiter' ); ?>" value="<?php echo $instance['limiter']; ?>" style="width:100%;" />
		</p>        

	<?php
	} 
    
}
////////////////////////////////////////////////////////////////////////////////
// FRESHCONTACT WIDGET
////////////////////////////////////////////////////////////////////////////////


add_action( 'widgets_init', 'freshcontact_load_widgets' );
function freshcontact_load_widgets()
{
  register_widget( 'FreshContact_Widget' );
   register_widget( 'FreshPopular_Widget' );

}

class FreshContact_Widget extends WP_Widget {
  function FreshContact_Widget()
  {
    /* Widget settings. */
		$widget_ops = array( 'classname' => 'freshcontact', 'description' => __('Custom contact form and social widget by freshface', 'examplesss') );

		/* Widget control settings. */
		$control_ops = array( 'width' => 300, 'height' => 850, 'id_base' => 'freshcontact-widget' );

		/* Create the widget. */
		$this->WP_Widget( 'freshcontact-widget', __('FreshContact', 'example'), $widget_ops, $control_ops );
  }
  function widget( $args, $instance ) 
  {
		extract( $args );
    	$title = apply_filters('widget_title', $instance['title'] );
  		$email = $instance['email'];
  		$subject = $instance['subject'];
  		$description = $instance['description'];
  		$sendtxt = $instance['sendtxt'];
 // 		$show_sex = isset( $instance['show_sex'] ) ? $instance['show_sex'] : false;
 
 echo $before_widget;

    ?>
    <?php echo $before_title.$title.$after_title.$description; 
    if($_POST['fc_send_email'] == 1 ) 
      {
       require_once "class.phpmailer.php";
        $email_adress_where_send = $lcp_cf_yourmail;
        $mail = new PHPMailer();
          $mail->IsMail();
          $mail->IsHTML(true);    
          $mail->CharSet  = "utf-8";
          $mail->From     = $_POST['fc_email'];
          $mail->FromName = $_POST['fc_name'];
          $mail->WordWrap = 50;    
          $mail->Subject  =  $_POST['fc_user_subject'];
          
          $mail->Body     =  $_POST['fc_text']; //
          $mail->AddAddress( $_POST['fc_user_email'] );
          $mail->AddReplyTo($_POST['fc_email']);
          if(!$mail->Send()) {  // send e-mail
            $status =   lcp_option('lcp_cf_send_ko');
          }                            
          else
          {
             $status =  lcp_option('lcp_cf_send_ok');
          }
          echo $status;
      }
      else if($instance['show_contact'] == 'true')
      {
    ?>

    			
    			<form action="" id="widget_contact" method="post">
    				<p><input type="text" name="fc_name" id="fc_name" /><label for="fc_name">Name*</label></p>
    				<p><input type="text" name="fc_email" id="fc_email" /><label for="fc_name">E-Mail*</label></p>
    				<p><textarea cols="10" id="fc_text" name="fc_text" rows="10"></textarea></p>
    			  <p style="display:none;"><input type="hidden" name="fc_send_email" value= "1" /></p> 
    				<p style="display:none;"><input type="hidden" name="fc_user_email" value="<?php echo $email; ?>" /></p> 
    				<p style="display:none;"><input type="hidden" name="fc_user_subject" value="<?php echo $subject; ?>" /></p> 
    				<p><input type="submit" value="<?php echo $sendtxt; ?>" tabindex="5" id="fc_submit" class="btn_b" name="fc_submit" /></p>          
    			</form>                                                                                                             
    			

    <?php
     /*
       http://www.facebook.com/sharer.php?u=www.pokus.com&t=pokus
     */
    }
     
   if($instance['show_social'] == 'true')
   {                    
    echo '<div id="widget_social">';
    if($instance['twitter'] !='') echo '<a href="'.$instance['twitter'].'"><img src="'.get_bloginfo('template_url').'/gfx/icons/social/small/twitter.png" alt="twitter" /></a>';
    if($instance['facebook'] !='') echo '<a href="'.$instance['facebook'].'"><img src="'.get_bloginfo('template_url').'/gfx/icons/social/small/facebook.png" alt="facebook" /></a>';
    if($instance['linkedin'] !='') echo '<a href="'.$instance['linkedin'].'"><img src="'.get_bloginfo('template_url').'/gfx/icons/social/small/linkedin.png" alt="linkedin" /></a>';
    if($instance['stumbleupon'] !='') echo '<a href="'.$instance['stumbleupon'].'"><img src="'.get_bloginfo('template_url').'/gfx/icons/social/small/stumbleupon.png" alt="stumbleupon" /></a>';
    if($instance['tumbler'] !='') echo '<a href="'.$instance['tumbler'].'"><img src="'.get_bloginfo('template_url').'/gfx/icons/social/small/tumblr.png" alt="tumbler" /></a>';
    if($instance['flickr'] !='') echo '<a href="'.$instance['flickr'].'"><img src="'.get_bloginfo('template_url').'/gfx/icons/social/small/flickr.png" alt="flickr" /></a>';
    if($instance['delicious'] !='') echo '<a href="'.$instance['delicious'].'"><img src="'.get_bloginfo('template_url').'/gfx/icons/social/small/delicious.png" alt="delicious" /></a>';
    if($instance['rss'] !='') echo '<a href="'.$instance['rss'].'"><img src="'.get_bloginfo('template_url').'/gfx/icons/social/small/rss.png" alt="rss" /></a>';
    if($instance['emailurl'] !='') echo '<a href="'.$instance['emailurl'].'"><img src="'.get_bloginfo('template_url').'/gfx/icons/social/small/email.png" alt="emailurl" /></a>';
    if($instance['youtube'] !='') echo '<a href="'.$instance['youtube'].'"><img src="'.get_bloginfo('template_url').'/gfx/icons/social/small/youtube.png" alt="youtube" /></a>';
    if($instance['vimeo'] !='') echo '<a href="'.$instance['vimeo'].'"><img src="'.get_bloginfo('template_url').'/gfx/icons/social/small/vimeo.png" alt="vimeo" /></a>';
    if($instance['msn'] !='') echo '<a href="'.$instance['msn'].'"><img src="'.get_bloginfo('template_url').'/gfx/icons/social/small/msn.png" alt="msn" /></a>';
    if($instance['skype'] !='') echo '<a href="'.$instance['skype'].'"><img src="'.get_bloginfo('template_url').'/gfx/icons/social/small/skype.png" alt="skype" /></a>';
    if($instance['mobileme'] !='') echo '<a href="'.$instance['mobileme'].'"><img src="'.get_bloginfo('template_url').'/gfx/icons/social/small/mobileme.png" alt="mobileme" /></a>';
  
    echo '<div class="clear"></div></div>'; 
    }
   echo $after_widget;

	}
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags for title and name to remove HTML (important for text inputs). */
		$instance['title'] =  $new_instance['title'];
		$instance['email'] =  $new_instance['email'];

		/* No need to strip tags for sex and show_sex. */
		$instance['subject'] = $new_instance['subject'];
    $instance['description'] = $new_instance['description'];
     $instance['sendtxt'] = $new_instance['sendtxt'];
    		$instance['twitter'] = $new_instance['twitter'];
    $instance['facebook'] = $new_instance['facebook'];
    		$instance['linkedin'] = $new_instance['linkedin'];
    $instance['stumbleupon'] = $new_instance['stumbleupon'];
    		$instance['tumbler'] = $new_instance['tumbler'];
    $instance['flickr'] = $new_instance['flickr'];
    		$instance['delicious'] = $new_instance['delicious'];
    		    $instance['rss'] = $new_instance['rss'];
    		$instance['emailurl'] = $new_instance['emailurl'];
    		
    		$instance['youtube'] = $new_instance['youtube'];
    $instance['vimeo'] = $new_instance['vimeo'];
    		$instance['msn'] = $new_instance['msn'];
    		    $instance['skype'] = $new_instance['skype'];
    		$instance['mobileme'] = $new_instance['mobileme'];    		
        		    $instance['show_contact'] = $new_instance['show_contact'];
    		$instance['show_social'] = $new_instance['show_social']; 
		return $instance;
	}
	
	function form( $instance ) 
  {

		/* Set up some default widget settings. */
		$defaults = array( 'title' => 'FreshContact',
                       'show_contact' => 'true',
                       'show_social' => 'true',
                       'email' => '', 
                       'subject' => '',
                       'description' => '',
                       'sendtxt' => 'Send E-Mail',
                       
                       'twitter' => '',
                       'facebook' => '',
                       'linkedin' => '',
                       'stumbleupon' => '',
                       'tumbler' => '',
                       'flickr' => '',
                       'delicious' => '',
                       'rss' => '',
                       'emailurl' => '',
                       'youtube' => '',
                       'vimeo' => '',
                       'msn' => '',
                       'skype' => '',
                       'mobileme' => '');
                       
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
  
		<!-- Widget Title: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'hybrid'); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
		</p>
    
    <p>
			<label for="<?php echo $this->get_field_id( 'show_contact' ); ?>"><?php _e('Show Contact:', 'hybrid'); ?></label>
			<input type="checkbox" id="<?php echo $this->get_field_id( 'show_contact' ); ?>" <?php if( $instance['show_contact'] == "true") echo 'checked'; ?> name="<?php echo $this->get_field_name( 'show_contact' ); ?>" value="true" style="width:100%;" />
		</p>         
    <p>
			<label for="<?php echo $this->get_field_id( 'show_social' ); ?>"><?php _e('Show Social:', 'hybrid'); ?></label>
			<input type="checkbox" id="<?php echo $this->get_field_id( 'show_social' ); ?>" <?php if( $instance['show_social'] == "true") echo 'checked'; ?> name="<?php echo $this->get_field_name( 'show_social' ); ?>" value="true" style="width:100%;" />
		</p>		
    
    <p>
			<label for="<?php echo $this->get_field_id( 'description' ); ?>"><?php _e('Text description:', 'example'); ?></label>
			<textarea id="<?php echo $this->get_field_id( 'description' ); ?>" name="<?php echo $this->get_field_name( 'description' ); ?>" style="width:100%;" ><?php echo $instance['description']; ?></textarea>
		</p>
		<!-- Your Email: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'email' ); ?>"><?php _e('Your email:', 'example'); ?></label>
			<input id="<?php echo $this->get_field_id( 'email' ); ?>" name="<?php echo $this->get_field_name( 'email' ); ?>" value="<?php echo $instance['email']; ?>" style="width:100%;" />
		</p>

		<!-- Your Email: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'subject' ); ?>"><?php _e('Email subject:', 'example'); ?></label>
			<input id="<?php echo $this->get_field_id( 'subject' ); ?>" name="<?php echo $this->get_field_name( 'subject' ); ?>" value="<?php echo $instance['subject']; ?>" style="width:100%;" />
		</p>
		
						<!-- Your Email: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'sendtxt' ); ?>"><?php _e('Send button text:', 'example'); ?></label>
			<input id="<?php echo $this->get_field_id( 'sendtxt' ); ?>" name="<?php echo $this->get_field_name( 'sendtxt' ); ?>" value="<?php echo $instance['sendtxt']; ?>" style="width:100%;" />
		</p>
				<!-- Your Email: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'twitter' ); ?>"><?php _e('Twitter URL:', 'example'); ?></label>
			<input id="<?php echo $this->get_field_id( 'twitter' ); ?>" name="<?php echo $this->get_field_name( 'twitter' ); ?>" value="<?php echo $instance['twitter']; ?>" style="width:100%;" />
		</p>
		
				<!-- Your Email: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'facebook' ); ?>"><?php _e('Facebook URL :', 'example'); ?></label>
			<input id="<?php echo $this->get_field_id( 'facebook' ); ?>" name="<?php echo $this->get_field_name( 'facebook' ); ?>" value="<?php echo $instance['facebook']; ?>" style="width:100%;" />
		</p>
		
				<!-- Your Email: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'linkedin' ); ?>"><?php _e('LinkedIn URL :', 'example'); ?></label>
			<input id="<?php echo $this->get_field_id( 'linkedin' ); ?>" name="<?php echo $this->get_field_name( 'linkedin' ); ?>" value="<?php echo $instance['linkedin']; ?>" style="width:100%;" />
		</p>
		
						<!-- Your Email: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'stumbleupon' ); ?>"><?php _e('StumbleUpon URL :', 'example'); ?></label>
			<input id="<?php echo $this->get_field_id( 'stumbleupon' ); ?>" name="<?php echo $this->get_field_name( 'stumbleupon' ); ?>" value="<?php echo $instance['stumbleupon']; ?>" style="width:100%;" />
		</p>
		
				<!-- Your Email: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'tumbler' ); ?>"><?php _e('Tumblr URL :', 'example'); ?></label>
			<input id="<?php echo $this->get_field_id( 'tumbler' ); ?>" name="<?php echo $this->get_field_name( 'tumbler' ); ?>" value="<?php echo $instance['tumbler']; ?>" style="width:100%;" />
		</p>
		
				<!-- Your Email: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'flickr' ); ?>"><?php _e('Flickr URL :', 'example'); ?></label>
			<input id="<?php echo $this->get_field_id( 'flickr' ); ?>" name="<?php echo $this->get_field_name( 'flickr' ); ?>" value="<?php echo $instance['flickr']; ?>" style="width:100%;" />
		</p>
		
		
				<!-- Your Email: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'delicious' ); ?>"><?php _e('Delicious URL :', 'example'); ?></label>
			<input id="<?php echo $this->get_field_id( 'delicious' ); ?>" name="<?php echo $this->get_field_name( 'delicious' ); ?>" value="<?php echo $instance['delicious']; ?>" style="width:100%;" />
		</p>		
		
		<p>
			<label for="<?php echo $this->get_field_id( 'rss' ); ?>"><?php _e('RSS URL :', 'example'); ?></label>
			<input id="<?php echo $this->get_field_id( 'rss' ); ?>" name="<?php echo $this->get_field_name( 'rss' ); ?>" value="<?php echo $instance['rss']; ?>" style="width:100%;" />
		</p>		
		
		<p>
			<label for="<?php echo $this->get_field_id( 'emailurl' ); ?>"><?php _e('Email URL :', 'example'); ?></label>
			<input id="<?php echo $this->get_field_id( 'emailurl' ); ?>" name="<?php echo $this->get_field_name( 'emailurl' ); ?>" value="<?php echo $instance['emailurl']; ?>" style="width:100%;" />
		</p>
    
    		<p>
			<label for="<?php echo $this->get_field_id( 'youtube' ); ?>"><?php _e('Youtube URL :', 'example'); ?></label>
			<input id="<?php echo $this->get_field_id( 'youtube' ); ?>" name="<?php echo $this->get_field_name( 'youtube' ); ?>" value="<?php echo $instance['youtube']; ?>" style="width:100%;" />
		</p>		
    
    		<p>
			<label for="<?php echo $this->get_field_id( 'vimeo' ); ?>"><?php _e('Vimeo URL :', 'example'); ?></label>
			<input id="<?php echo $this->get_field_id( 'vimeo' ); ?>" name="<?php echo $this->get_field_name( 'vimeo' ); ?>" value="<?php echo $instance['vimeo']; ?>" style="width:100%;" />
		</p>				
		
				<p>
			<label for="<?php echo $this->get_field_id( 'msn' ); ?>"><?php _e('MSN URL :', 'example'); ?></label>
			<input id="<?php echo $this->get_field_id( 'msn' ); ?>" name="<?php echo $this->get_field_name( 'msn' ); ?>" value="<?php echo $instance['msn']; ?>" style="width:100%;" />
		</p>		
		
						<p>
			<label for="<?php echo $this->get_field_id( 'skype' ); ?>"><?php _e('Skype URL :', 'example'); ?></label>
			<input id="<?php echo $this->get_field_id( 'skype' ); ?>" name="<?php echo $this->get_field_name( 'skype' ); ?>" value="<?php echo $instance['skype']; ?>" style="width:100%;" />
		</p>		
		
						<p>
			<label for="<?php echo $this->get_field_id( 'mobileme' ); ?>"><?php _e('MobileMe URL :', 'example'); ?></label>
			<input id="<?php echo $this->get_field_id( 'mobileme' ); ?>" name="<?php echo $this->get_field_name( 'mobileme' ); ?>" value="<?php echo $instance['mobileme']; ?>" style="width:100%;" />
		</p>		

	<?php
	}
}
?>
