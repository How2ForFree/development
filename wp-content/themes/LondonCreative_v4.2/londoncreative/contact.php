<?php /*
Template Name: Contact
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


$status = "";

if(isset($_POST['cf_text']) ) 
{
  if($_POST['cf_que'] != get_option('lcp_cf_security_answer') )
    $status = get_option('lcp_cf_security_answer_fail');
  else
  {
    $email_adress_where_send = $lcp_cf_yourmail;
    include "scripts/class.phpmailer.php";
    $mail = new PHPMailer();
      $mail->IsMail();
      $mail->IsHTML(true);
      $mail->CharSet  = "utf-8";
      $mail->From     = $_POST['cf_mail'];
      $mail->FromName = $_POST['cf_name'];
      $mail->WordWrap = 50;
      $mail->Subject  =  lcp_option('lcp_cf_subject');
      $mail->Body     =  $_POST['cf_text']; //
      $mail->AddAddress( get_option('lcp_cf_yourmail') );
      $mail->AddReplyTo($_POST['cf_mail']);
    if(!$mail->Send()) {  // send e-mail
      $status =  lcp_option('lcp_cf_send_ko');
    }
    else
    {
       $status =  lcp_option('lcp_cf_send_ok');
    }
  }
}
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
                


                    <?php if ( get_post_meta($post->ID, 'page_title', true) != "false" ){ ?>  
                    <div class="title_holder">
                        <h1><a href="<?php the_permalink(); ?>" class="title"><?php the_title(); ?></a></h1>
                    </div><!--  END "title_holder"  //-->
                    <?php } ?>
                    <div class="entry_content">
                    
                    	  <?php if($status !="") echo $status;
                        else
                        {
                                                 ?>
                        <?php the_content(""); ?>
                        <form class="contact_form" method="post" action="">
                          <p><input type="text" id="cf_name" name="cf_name" /><label for="name"><?php echo lcp_option('lcp_cf_name'); ?></label></p>
                          <p><input type="text" id="cf_mail" name="cf_mail" /><label for="mail"><?php echo lcp_option('lcp_cf_email'); ?></label></p>
                        <?php
                          $sec_que = get_option('lcp_cf_security_que');
                          if($sec_que != '') {
                        ?>
                          <p><input type="text" id="cf_que" name="cf_que" /><label for="mail"><?php echo $sec_que; ?></label></p>
                        <?php
                          }
                        ?>
                          <p><textarea rows="10" name="cf_text" id="cf_text" cols="10"></textarea></p>
                          <p><input type="submit" id="cf_send" name="cf_send" value="<?php echo lcp_option('lcp_cf_send'); ?>" /></p>
                        </form>
                        <?php } ?>
                    </div><!--  END "entry_content"  //-->
                    
<?php                   
                  
// <<<<<<<<<<<<<<<< END PORTFOLIO & PAGE POST <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
?>
              </div><!--  END "entry"  //-->
<?php 
// >>>>>>>>>>>>>>>> NO-POST >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
endwhile; 
             
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
