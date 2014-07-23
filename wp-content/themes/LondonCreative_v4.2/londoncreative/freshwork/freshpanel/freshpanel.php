<?php
  //////////////////////////////////////////////////////////////////////////////
  // VARIABLES
  //////////////////////////////////////////////////////////////////////////////
  $themename = "FreshPanel"; 
  $shortname = "lcp";       
  //////////////////////////////////////////////////////////////////////////////
  // FRESHPANEL SETTINGS
  //////////////////////////////////////////////////////////////////////////////
  $options = array ( 
 
  //////////////////////////////////////////////////////////////////////////////
  // GENERAL
  //////////////////////////////////////////////////////////////////////////////
                                     
   array( "name" => "General", 
          "type" => "navigation",
          "icon" => "general"), 
  //////////////////////////////////////////////////////////////////////////////
  // PERFORMANCE TAB
  //////////////////////////////////////////////////////////////////////////////

  //////////////////////////////////////////////////////////////////////////////
  // CATEGORIES TAB
  //////////////////////////////////////////////////////////////////////////////
        array( "name" => "Logo", 
            "type" => "tab"), 
  
    
       array( "name" => "Please insert here the URLs of your Logo images. TIP: Use transparent GIF or PNG files.", 
              "type" => "info"),
             
        
       array( "name" => "Header Logo URL", 
              "desc" => "Please insert the URL of your Logo image for Header (big)", 
              "id" => $shortname."_head_logo", 
              "type" => "text",
              "std" => ""),

      array( "name" => "Footer Logo URL", 
              "desc" => "Please insert the URL of your Logo image for Footer (smaller)", 
              "id" => $shortname."_foot_logo", 
              "type" => "text",
              "std" => ""),

             
     
     array(  "type" => "tab-close"),
    
       
 // HEADER      
      array( "name" => "Header", 
            "type" => "tab"), 
  
    
       array( "name" => "Use to fill the right content area in Header. Insert e.g. your contact info, social icons, whatever HTML code you want.", 
              "type" => "info"),
             
        
       array( "name" => "Header - Right Section", 
              "desc" => "Insert whatever HTML CODE you want.", 
              "id" => $shortname."_head_info", 
              "type" => "text",
              "std" => ""),                           
       
             
     
     array(  "type" => "tab-close"),
    
    
           array( "name" => "Footer", 
            "type" => "tab"), 
  
    
       array( "name" => "Use to fill the left content area in Footer. Insert e.g. your copyright, contact info or whatever HTML code you want.", 
              "type" => "info"),
             
        
       array( "name" => "Footer - Left Section", 
              "desc" => "Insert whatever HTML CODE you want.", 
              "id" => $shortname."_footer_copyright", 
              "type" => "text",
              "std" => ""),                           
       
             
     
     array(  "type" => "tab-close"),
    
    
      array( "name" => "Portfolio", 
            "type" => "tab"), 

    
       array( "name" => "General settings for Portfolio posts. TIP: You can also disable Comments per each post via 'Edit post'.", 
              "type" => "info"),
             
   
       array( "name" => "Enable Comments in Portfolio", 
              "desc" => "Enable / Disable Comments in Portfolio", 
              "id" => $shortname."_show_portfolio_comments", 
              "type" => "checkbox", 
              "std" => "true"),               

      array( "name" => "Auto Portfolio Posts", 
              "desc" => "Render all posts in portfolio categories as portfolio posts (even if they are not created by WP3 Portfolio post type). <br /><br />You can use this feature ONLY if you are upgrading your site any my theme from WP2.9 to WP3.0. If you turn this ON, all posts assigned to the 'Portfolio' category will be rendered just like you were used to. <br /><br />There will be NO need to rewrite all your Portfolio posts from scratch using the new Post Type feature (new in WP3.0). But my suggestion is to rewrite it anyway. <br /><br /><strong>You also HAVE TO set your Portfolio category in 'FreshPanel -> Categories -> Portfolio Categories' !!!</strong> <br /><br />I've only added this feature for people who are too lazy to do that or have hundreds of posts.", 
              "id" => $shortname."_cat_render_portfolio", 
              "type" => "checkbox", 
              "std" => "false"),              
             
     
     array(  "type" => "tab-close"),
    
     
      array( "name" => "Panel", 
            "type" => "tab"), 

    
       array( "name" => "General settings for FreshPanel. Adjust to your liking.", 
              "type" => "info"),
             
   
       array( "name" => "Header Links", 
              "desc" => "Enable / Disable links in FreshPanel's header.", 
              "id" => $shortname."_show_header_links", 
              "type" => "checkbox", 
              "std" => "true"),               

     
     array(  "type" => "tab-close"),
    
       
      array( "name" => "Reset", 
            "type" => "tab"), 

    
       array( "name" => "If you want to reset FreshPanel to default values, please hit the red buttons below.", 
              "type" => "info"),
             
   
       array( "name" => "Reset", 
 
              "type" => "reset", 
              "std" => "true"),               

     
     array(  "type" => "tab-close"),

    
   
    
   array( "type" => "navigation-close"),
  //////////////////////////////////////////////////////////////////////////////
  // IMAGE
  //////////////////////////////////////////////////////////////////////////////
     array( "name" => "Images", 
            "type" => "navigation",
            "icon" => "images"),
    
       array( "name" => "General", 
              "type" => "tab"), 
      
       array( "name" => "Setup the general usage of Images on your site. TIP: Don't use the relative path if you want to use WP's Image Uploader.", 
              "type" => "info"), 
             
       array( "name" => "Use Relative Image URLs", 
              "desc" => "If Enabled, automatically inserts the URL of your choice before every image used via Custom Field. <br /><br />If you are not going to use an WP's default Image Uploader and you rather wish to upload your images to one folder on FTP manually, you can then set in the field below the URL to this folder and insert to the Custom Fields only the name of your image (e.g. 'myphoto.jpg').", 
              "id" => $shortname."_cb_relative_links", 
              "type" => "checkbox", 
              "std" => "false"),
   
       array( "name" => "Relative Path", 
              "desc" => "Insert the path to the folder which stores your images on your FTP. E.g. 'http://www.mysite.com/images/' <br /><br /> You can use this field only if you have enabled the 'Use Relative Image URLs' above.", 
              "id" => $shortname."_tb_relative_path", 
              "type" => "text", 
              "std" => ""),  
     
     array(  "type" => "tab-close"),
     
       array( "name" => "Size", 
              "type" => "tab"), 
      
       array( "name" => "If you want you can customize here the default fixed sizes of main images on your site. The values are in pixels.", 
              "type" => "info"), 

   
       array( "name" => "Blog - Image height", 
              "desc" => "Insert a fixed height of blog images in px or leave blank for disabling the fixed height.", 
              "id" => $shortname."_blog_height", 
              "type" => "text", 
              "std" => "170"),  
     
       array( "name" => "Blog Single View - Image height", 
              "desc" => "Insert a fixed height of blog images (single post view) in px or leave blank for disabling the fixed height.", 
              "id" => $shortname."_blog_single_height", 
              "type" => "text", 
              "std" => "170"),       
    
     
       array( "name" => "Portfolio - Image height", 
              "desc" => "Insert a fixed height of portfolio images in px or leave blank for disabling the fixed height.", 
              "id" => $shortname."_portfolio_height", 
              "type" => "text", 
              "std" => "170"),  
     
       array( "name" => "Portfolio Single View - Image height", 
              "desc" => "Insert a fixed height of portfolio images (single post view) in px or leave blank for disabling the fixed height.", 
              "id" => $shortname."_portfolio_single_height", 
              "type" => "text", 
              "std" => "170"),       
        
     
       array( "name" => "Page - Image height", 
              "desc" => "Insert a fixed height of page images in px or leave blank for disabling the fixed height.", 
              "id" => $shortname."_page_height", 
              "type" => "text", 
              "std" => "170"),       
      array(  "type" => "tab-close"),     
  
   array( "type" => "navigation-close"),
  
  //////////////////////////////////////////////////////////////////////////////
  // HOME PAGE
  //////////////////////////////////////////////////////////////////////////////
     array( "name" => "Home Page", 
            "type" => "navigation", "icon" => "home"),
           
     array( "name" => "Slider", 
            "type" => "tab"), 
    
       array( "name" => "Setup the Slider on your Home page. You can customize here things like sliding speed and size of the images.", 
              "type" => "info"), 

       array( "name" => "Show Slider", 
              "desc" => "Enable / Disable Slider on your Home Page", 
              "id" => $shortname."_show_slider", 
              "type" => "checkbox",
              "std" => "true"),
              
       array( "name" => "Show Old slider", 
              "desc" => "Enable / Disable Old slider based on categories instead of new slider based on slider manager", 
              "id" => $shortname."_show_slider_old", 
              "type" => "checkbox",
              "std" => "false"),              
      
       array( "name" => "Limit the Number of Posts in Slider", 
              "desc" => "Use whatever integer value you want. Default '99999' will be able to display max 99999 Posts in Slider.", 
              "id" => $shortname."_slider_limiter", 
              "type" => "text", 
              "std" => "99999"),
             
       array( "name" => "Automatic Sliding", 
              "desc" => "Enable / Disable Automatic Sliding", 
              "id" => $shortname."_show_slider_autoslide", 
              "type" => "checkbox",
              "std" => "true"), 
                         
       array( "name" => "Sliding Interval (Speed) in 'ms'", 
              "desc" => "Sliding Interval in ms, e.g. '3000' = 3 seconds", 
              "id" => $shortname."_show_slider_interval", 
              "type" => "text",
              "std" => "3000"), 
             
      array( "name" => "Fixed Height", 
              "desc" => "Enable / Disable the usage of Fixed Height of 'Big Image' in Slider", 
              "id" => $shortname."_slider_fixed_height", 
              "type" => "checkbox",
              "std" => "true"), 
                         
       array( "name" => "Fixed Height Size in 'px'", 
              "desc" => "Insert the Height of the 'Big Image' you would like to use. The value is in pixels. Recommended is 350px as seen on my demo site.", 
              "id" => $shortname."_slider_height", 
              "type" => "text",
              "std" => "350"),              
                          

     array(  "type" => "tab-close"),
    
       array( "name" => "Exclude", 
              "type" => "tab"), 
      
       array( "name" => "You can adjust here the 'Blog' section of your Home Page to your liking.", 
              "type" => "info"), 
             
       array( "name" => "Blog Section", 
              "desc" => "Enable / Disable the Blog section of your Home Page.", 
              "id" => $shortname."_hp_hide_blogposts", 
              "type" => "checkbox", 
              "std" => "true"),

       array( "name" => "Exclude Portfolio Posts", 
              "desc" => "If Enabled, this will exclude all your Portfolio Posts from Blog section on Home Page", 
              "id" => $shortname."_hp_exclude_portfolio", 
              "type" => "checkbox", 
              "std" => "true"),
      

             
       array( "name" => "Exclude Categories from Home Page", 
              "desc" => "Use this to exclude any Categories you don't want to have in your Home Page's Blog section. Use Category ID's separated with comma.<br /><br /> E.g.:
'25,85,33,15,2,68'", 
              "id" => $shortname."_hp_exclude_cats", 
              "type" => "text", 
              "std" => ""), 
             
                              
                                                   
     
     array(  "type" => "tab-close"),
             array( "name" => "Buttons", 
              "type" => "tab"), 
      
       array( "name" => "There are 2 special buttons on your Home Page. Use these settings to adjust them.", 
              "type" => "info"), 
             
             
           array( "name" => "Message Buttons", 
              "desc" => "Enable / Disable those two Message Buttons on your Home Page", 
              "id" => $shortname."_show_msg", 
              "type" => "checkbox",
              "std" => "true"),
                         
             
        array( "name" => "Message Button (A) Title", 
              "desc" => "Insert here the text for Message Button (A)", 
              "id" => $shortname."_msga_title", 
              "type" => "text", 
              "std" => "Are you ready to meet the creatives?"),
             
        array( "name" => "Message Button (A) URL", 
              "desc" => "Insert here the URL where you want the Message Button (A) to be linked.", 
              "id" => $shortname."_msga_link", 
              "type" => "text", 
              "std" => ""),
             
        array( "name" => "Message Button (B) Title", 
              "desc" => "Insert here the text for Message Button (B)", 
              "id" => $shortname."_msgb_title", 
              "type" => "text", 
              "std" => "See complete portfolio"),
             
        array( "name" => "Message Button (B) URL", 
              "desc" => "Insert here the URL where you want the Message Button (B) to be linked.", 
              "id" => $shortname."_msgb_link", 
              "type" => "text", 
              "std" => ""),                                                  
                                                   
     
     array(  "type" => "tab-close"),
     
  
   array( "type" => "navigation-close"),
  
   array( "name" => "Categories", 
            "type" => "navigation", "icon" => "categories"),
           
             
     array( "name" => "General", 
              "type" => "tab"),
             
           array( "name" => "The Category Settings tab is very important for you. Make sure you read the documentation to learn how to use it.", 
              "type" => "info"), 

       array( "name" => "Portfolio Categories", 
              "desc" => "ALERT: You have to adjust this field every time after you add a new Portfolio (parent only) Category. Otherwise you won't be able to render the Portfolio Sidebar ! <br /><br /> Please insert the ID's of your Portfolio Categories. <br /><br />Use Category ID's separated with comma. E.g.:
'25,85,33,15,2,68'.", 
              "id" => $shortname."_cat_portfolio", 
              "type" => "text",
              "std" => ""),
             
         array( "name" => "Slider Categories",  
              "desc" => "ALERT: Every Post in these categories will be displayed in Slider on your Home Page. <br /><br /> Please insert the ID's of your Slider Categories. <br /><br />Use Category ID's separated with comma. E.g.: 
'25,85,33,15,2,68'.",  
              "id" => $shortname."_cat_slider",  
              "type" => "text",
              "std" => ""),    
               
                                                      
     array(  "type" => "tab-close"),
    
     array( "name" => "Posts per page", 
              "type" => "tab"),
             
           array( "name" => "You can set here custom posts per page values.", 
              "type" => "info"), 

       array( "name" => "Home Page", 
              "desc" => "How many posts per page appear at the homepage?", 
              "id" => $shortname."_ppp_home", 
              "type" => "text",
              "std" => "5"),
             
       array( "name" => "Blog Category", 
              "desc" => "How many posts per page appear in the Blog Category?", 
              "id" => $shortname."_ppp_blog", 
              "type" => "text",
              "std" => "5"),           
             
       array( "name" => "Portfolio Category", 
              "desc" => "How many posts per page appear at the Portfolio Category?", 
              "id" => $shortname."_ppp_portfolio", 
              "type" => "text",
              "std" => "5"),               
                                
       array( "name" => "Search", 
              "desc" => "How many posts per page appear at the search?", 
              "id" => $shortname."_ppp_search", 
              "type" => "text",
              "std" => "5"),                                          
     array(  "type" => "tab-close"),    

   array( "type" => "navigation-close"),             
  //////////////////////////////////////////////////////////////////////////////
  // CONTACT
  //////////////////////////////////////////////////////////////////////////////  
   array( "name" => "Contact Form", 
            "type" => "navigation", "icon" => "contact"),
    
   array( "name" => "General", 
              "type" => "tab"), 
      
       array( "name" => "Please insert here your Contact Info in order to have fully working Contact Form.", 
              "type" => "info"), 

       array( "name" => "Your E-Mail", 
              "desc" => "Please insert your E-Mail Address", 
              "id" => $shortname."_cf_yourmail", 
              "type" => "text", 
              "std" => ""),  

       array( "name" => "Subject", 
              "desc" => "Please insert the Subject of these E-Mails", 
              "id" => $shortname."_cf_subject", 
              "type" => "text", 
              "std" => ""),  
                                                   
     array(  "type" => "tab-close"),
    
 
  
   array( "type" => "navigation-close"),
  //////////////////////////////////////////////////////////////////////////////
  // TRANSLATION
  //////////////////////////////////////////////////////////////////////////////  
   array( "name" => "Translate", 
            "type" => "navigation", "icon" => "translate"),       
           
          array( "name" => "Buttons", 
              "type" => "tab"), 
      
       array( "name" => "Here you can set up some different translation for classic WordPress elements", 
              "type" => "info"), 
 
          array( "name" => "Read More button", 
        "desc" => "Please insert format of readmore button", 
        "id" => $shortname."_translate_readmore", 
        "type" => "text",
        "std" => "[..]"),
		  
	 array(  "type" => "tab-close"),

    
  //////////////////////////////////////////////////////////////////////////////
  // TRANSLATION - COMMENT FORM
  //////////////////////////////////////////////////////////////////////////////    
         array( "name" => "Widgets", 
              "type" => "tab"), 
      
       array( "name" => "Here you can set up some additional settings for custom widgets. Date formats, etc.", 
              "type" => "info"), 
 
          array( "name" => "Popular Posts Widget - Date format", 
        "desc" => "Insert here the date format which you want to use. For specifications see 'date()' php function", 
        "id" => $shortname."_translate_date", 
        "type" => "text",
        "std" => "F j, Y"),
       
   
     array(  "type" => "tab-close"),            
            
        array( "name" => "Comments", 
              "type" => "tab"), 
      
       array( "name" => "In case you want to translate some hard coded texts in Comments, you can do it here.", 
              "type" => "info"), 

       array( "name" => "Leave a Comment", 
              "desc" => "Leave a Comment", 
              "id" => $shortname."_com_leave", 
              "type" => "text", 
              "std" => "Leave a Comment"),
             
       array( "name" => "No Comments", 
              "desc" => "No Comments", 
              "id" => $shortname."_com_no", 
              "type" => "text", 
              "std" => "No Comments"),   
             
       array( "name" => "1 Comment", 
              "desc" => "1 Comment", 
              "id" => $shortname."_com_1", 
              "type" => "text", 
              "std" => "1 Comment"),
             
             
      array( "name" => "% Comments", 
              "desc" => "% Comments", 
              "id" => $shortname."_com_more", 
              "type" => "text", 
              "std" => "% Comments"),  
             
      array( "name" => "'Submit Comment' button name", 
              "desc" => "'Submit Comment' button name", 
              "id" => $shortname."_com_send", 
              "type" => "text", 
              "std" => "Submit Comment"),     
             
      array( "name" => "Comments are closed", 
              "desc" => "Comments are closed", 
              "id" => $shortname."_com_closed", 
              "type" => "text", 
              "std" => "Comments are closed"),                                                        
   
     array(  "type" => "tab-close"),            
     
     
     
  //////////////////////////////////////////////////////////////////////////////
  // TRANSLATION - SEARCH
  //////////////////////////////////////////////////////////////////////////////    
       array( "name" => "Search", 
              "type" => "tab"), 
      
       array( "name" => "In case you want to translate some hard coded texts in Search, you can do it here.", 
              "type" => "info"), 

       array( "name" => "'Search' button name", 
              "desc" => "'Search' button name", 
              "id" => $shortname."_srch_name", 
              "type" => "text", 
              "std" => "Search"),
             
       array( "name" => "'Enter keywords..' input", 
              "desc" => "'Enter keywords..' input", 
              "id" => $shortname."_srch_input_text", 
              "type" => "text", 
              "std" => "Enter keywords.."),
             
      array( "name" => "No Posts Found", 
              "desc" => "No Posts Found", 
              "id" => $shortname."_srch_nopost", 
              "type" => "text", 
              "std" => "No Posts Found"),                  
                                   
   
     array(  "type" => "tab-close"),
     
     
        //////////////////////////////////////////////////////////////////////////////
  // TRANSLATION  - CONTACT FORM
  //////////////////////////////////////////////////////////////////////////////      
       array( "name" => "Contact Form", 
              "type" => "tab"), 
      
       array( "name" => "In case you want to translate some hard coded texts in Contact Form, you can do it here.", 
              "type" => "info"), 

       array( "name" => "Name", 
              "desc" => "Name", 
              "id" => $shortname."_cf_name", 
              "type" => "text", 
              "std" => "Name*"),  

       array( "name" => "E-Mail", 
              "desc" => "E-Mail", 
              "id" => $shortname."_cf_email", 
              "type" => "text", 
              "std" => "E-Mail*"),  

       array( "name" => "'Send' button name", 
              "desc" => "'Send' button name", 
              "id" => $shortname."_cf_send", 
              "type" => "text", 
              "std" => "Send"),  
             
       array( "name" => "Message was successfully sent", 
              "desc" => "Message was successfully sent", 
              "id" => $shortname."_cf_send_ok", 
              "type" => "text", 
              "std" => "Message was successfully sent"),  
             
       array( "name" => "An error occured. Please try again later.", 
              "desc" => "An error occured. Please try again later.", 
              "id" => $shortname."_cf_send_ko", 
              "type" => "text", 
              "std" => "An error occured. Please try again later."),

       array( "name" => "Security question ?",
              "desc" => "Do you want to have a security question? It helps stop spam. Leave blank if you dont want this. For example = 1 + 5",
              "id" => $shortname."_cf_security_que",
              "type" => "text",
              "std" => ""),
              
       array( "name" => "Answer to security question",
              "desc" => "If youser type this, your email will be sent",
              "id" => $shortname."_cf_security_answer",
              "type" => "text",
              "std" => ""),
              
       array( "name" => "Fail to answer",
              "desc" => "If user failed with answering. For example: Email was unable to send, because you filled wrong security question.",
              "id" => $shortname."_cf_security_answer_fail",
              "type" => "text",
              "std" => ""),
                                                                 
     array(  "type" => "tab-close"),  

     
  
   array( "type" => "navigation-close"),
  
          array( "name" => "Color Skin", 
            "type" => "navigation", "icon" => "color"),
           
      array( "name" => "Color Skin", 
              "type" => "tab"),
             
       array( "name" => "Please select color skin", 
              "type" => "info"),
             
       array( "name" => "Skin Color", 
              "desc" => "Select skin color", 
              "id" => $shortname."_color_skin", 
              "type" => "select",
              "options" => array("yellow", "red", "blue"),
              "std" => "yellow"),
               
       array(  "type" => "tab-close"),  

   array( "type" => "navigation-close"),                  
   );
  //////////////////////////////////////////////////////////////////////////////
  // INIT FUNCTION
  //////////////////////////////////////////////////////////////////////////////   
  function freshpanel_add_init()
  {   
    $file_dir=get_bloginfo('template_directory'); 
    if($_GET['page'] == 'freshpanel.php') {
        wp_enqueue_style("functions", $file_dir."/freshwork/freshpanel/freshpanel.css", false, "1.0", "all");
       // wp_enqueue_script("rm_script", $file_dir."/freshwork/freshpanel/js/jquery.livequery.js", false, "1.0");
        wp_enqueue_script("rm_script", $file_dir."/freshwork/freshpanel/js/controls.js", false, "1.0");
        wp_enqueue_script("rm_scriptd", $file_dir."/freshwork/freshpanel/jquery.select.js", false, "1.0");
    }
    else if($_GET['page'] == 'freshslider.php') {

        wp_enqueue_style("functionss", $file_dir."/freshwork/freshslider/freshslider.css", false, "1.0", "all");
        wp_enqueue_script("rm_scripts", $file_dir."/freshwork/freshslider/js/control.js", false, "1.0");
    }
  }
 
  //////////////////////////////////////////////////////////////////////////////
  // FRESHPANEL ADD FUNCTION
  //////////////////////////////////////////////////////////////////////////////
  function freshpanel_add_admin()
  {
    global $themename, $shortname, $options;
    if ( $_GET['page'] == basename(__FILE__) ) { 
    
       
         if( 'reset' == $_REQUEST['reset'] ) { 
    
       foreach ($options as $value) { 
           delete_option( $value['id'] ); } 
    
       header("Location: admin.php?page=freshpanel.php&reset=true");
       }  
       else if ( 'save' == $_REQUEST['action'] ) { 
     //{
          /* foreach ($options as $value) { 
      //    echo $_REQUEST['st_checkbox1111']."sa";
           update_option( $value['id'], addslashes($_REQUEST[ $value['id'] ]) );
          
            }  */
    
       foreach ($options as $value) { 
           if( isset( $_REQUEST[ $value['id'] ] ) ) { update_option( $value['id'],  ($_REQUEST[ $value['id'] ])  ); } else { delete_option( $value['id'] ); } } 
        
           header("Location: admin.php?page=freshpanel.php&saved=true"); 
       die; 
        
      }
   
     /*  else if( 'reset' == $_REQUEST['action'] ) { 
        
           foreach ($options as $value) { 
               delete_option( $value['id'] ); } 
        
           header("Location: admin.php?page=zodiacbox.php&reset=true"); 
       die; 
        
       }          */
   }
        

    add_menu_page($themename, $themename, 'administrator', basename(__FILE__), 'freshpanel_admin');   
  }
  //////////////////////////////////////////////////////////////////////////////
  // FRESHPANEL CORE FUNCTION
  //////////////////////////////////////////////////////////////////////////////
  function freshpanel_admin()
  {
   global $themename, $shortname, $options; 
   $navigation_content ="";
   $tab_content = "";
   $navigation_counter = 0;
   $tab_counter= 0;
   $options_content = "";
   foreach ($options as $value) { 
 //    echo "xxxxxxx".get_option( $value['id'] );
      if (get_option( $value['id'] ) != "") $value['std'] =   get_option( $value['id'] );
      else
      {
        update_option( $value['id'],$value['std'] );
      }
      switch ( $value['type'] ) {       
        case "navigation":
          $tab_counter = 0;
          $style = ""; $selected = 'name="selected"';
  
          if($navigation_counter != 0) {$style = 'style="display:none;"'; $selected="";};
          $navigation_content .= '<li '.$selected.'>';
          $navigation_content .= '  <div class="passive" name="nav_'.$navigation_counter.'"></div>';
          $navigation_content .= '  <div class="active" '.$style.'></div>';
          $navigation_content .= '  <a href="javascript:" class="'.$value['icon'].'" >'.$value['name'].'</a>';
          $navigation_content .= '  <div class="active_arrow"></div>';
          $navigation_content .= '</li>';
          $tab_content .= '<ul class="tabs_wrapper" '.$style.' id="nav_'.$navigation_counter.'_tab">';  
          $options_content .= '<div class="box" id="nav_'.$navigation_counter.'_box" '.$style.' '.$selected.'>';   
        break;
       
        case "tab":
          $style = 'class="tab_active"'; $selected = 'name="selected"';
          $display = "";
          if($tab_counter != 0) {$style = 'class="tab_passive"'; $selected=""; $display='style="display:none;"';};
          $tab_content .= '<li '.$selected.'>';
          $tab_content .= '  <a href="javascript:" '.$style.' name="tab_'.$navigation_counter.'_'.$tab_counter.'">'.$value["name"].'</a>';
          $tab_content .= '</li>';
          $options_content .= '<div class="content_wrapper" id="tab_'.$navigation_counter.'_'.$tab_counter.'_wrapper" '.$display.' '. $selected . '>'; 
        break;
  
        case "info":
          $options_content .= '<div class="intro_info">';
          $options_content .= '<img src="'.get_bloginfo('template_url').'/freshwork/freshpanel/gfx/info_big.png" alt="info" class="info_big" />';
          $options_content .= '<p>'.$value['name'].'</p>';
          $options_content .= '<img src="'.get_bloginfo('template_url').'/freshwork/freshpanel/gfx/divider.png" class="divider" alt="divider" />';
          $options_content .= '</div>';
          $options_content .= '<div class="content">';
         
        break;
       
        case "select":
          $select_content = "";
          foreach ($value['options'] as $select_options) {
            $select_content .=   '<li>'.$select_options.'</li>';
          }
          $options_content .= '
                         <div class="select">
                                <h2>'.$value['name'].'</h2>
                                <img src="'.get_bloginfo('template_url').'/freshwork/freshpanel/gfx/info_small.png" class="info_small" />
                                <p class="desc" style="display:none;">'.$value['desc'].'</p>
                                <div class="selectbox_wrapper">
                                    <input type="hidden" value="'.$value['std'].'" name="'.$value['id'].'" id="'.$value['id'].'">
                                    <div class="selected">'.$value['std'].'</div>
                                    <div class="select_options_wrapper">
                                      <div class="select_options_container">
                                            <ul class="select_options">
                                            '.$select_content.'
                                            </ul>
                                        </div>
                                        <div class="scrollbox">
                                            <div class="scrollbar_wrapper">
                                              <div class="scrollbar" name="0">
                                              </div>
                                            </div>
                                        </div>
                                        <div class="clear"></div>
                                        <div class="select_shadow"></div>
                                    </div>
                                </div>
                                <div class="clear"></div>
                            </div><!-- END "div.select" -->';


        break;
       

        case "checkbox":
          $options_content .= '<div class="switch">';
          $options_content .= '<h2>'.$value['name'].'</h2>';
          $options_content .= '<div class="btn_switch">';
          $options_content .= '<input type="hidden" class="btn_switch_input" name="'.$value['id'].'" id="'.$value['id'].'" value="'.$value['std'].'">';
          if($value['std']=="true") $options_content .= '<div class="on_off" style="left:0px"></div>';
          else $options_content .= '<div class="on_off"></div>';
          $options_content .= '<img src="'.get_bloginfo('template_url').'/freshwork/freshpanel/gfx/btn_switch_overlay.png" class="over" />';

          $options_content .= '</div><!-- END "div.btn_switch" -->';
         
                    $options_content .= '<img src="'.get_bloginfo('template_url').'/freshwork/freshpanel/gfx/info_small.png" alt="info" class="info_small" />';
          $options_content .= '<p class="desc" style="display:none;">'.$value['desc'].'</p>';
                    $options_content .= '</div><!-- END "div.switch" -->';
        break;
       

       
        case "text":
          $options_content .= '<div class="input">';
          $options_content .= '<h2>'.$value['name'].'</h2>';
          $options_content .= '<img src="'.get_bloginfo('template_url').'/freshwork/freshpanel/gfx/info_small.png" alt="info" class="info_small"/>';
          $options_content .= '<p class="desc" style="display:none;">'.$value['desc'].'</p>';
          $options_content .= '<input type="text" name="'.$value['id'].'" id="'.$value['id'].'" value="'.(htmlspecialchars(stripslashes(($value['std'])))).'">';
          $options_content .= '</div><!-- END "div.input" -->';
        break;
       
        case "reset":
          $options_content .= '<input type="submit" value="reset" class="btn_reset" name="reset" id="reset">';       
        break;
       
        case "tab-close":
          $options_content .= '  <input name="save" type="submit" class="btn_save" value="" />  ';
          $options_content .= '<br /></div>';
          $options_content .= '</div>';
          $tab_counter++;
        break; 
  
        case "navigation-close":
          $tab_content .= '</ul>';
          $navigation_counter++; 
          $options_content .= '</div>'; 
        break;
               

      }   
   } 
  ?>
<img id="sneak_peak" style='position:absolute; z-index:999;'>
<div class="fresh_tooltip" style="position:absolute";>'.$value['desc'].'</div>
<div id="freshpanel"> 
  <form method="post" action="?page=freshpanel.php&action=save">
    <div id="wrapper_glogal">
        <div class="wrapper_bg_outer">
            <div class="wrapper_bg">
                <div class="left">
                    <div class="logo"><img src="<?php echo get_bloginfo('template_url') ?>/freshwork/freshpanel/gfx/logo.png" alt="freshpanel logo" /></div>
                    <ul class="wrapper_nav">
                            <?php echo $navigation_content;?>
                    </ul><!-- END "ul.wrapper_nav" -->
                    <div class="shadow_bottom"></div>
                </div><!-- END "div.left" -->
                <div class="right">
                    <div class="header">
                        <div class="header_inner">
                        <?php if(get_option('lcp_show_header_links') == "true" ){ ?>
                            <div class="links">
                                <h2>G'day admin!</h2>
                                <p><a href="http://themeforest.net/item/london-creative-portfolio-blog-wp-theme/70613?ref=freshface" target="_blank" class="btn_small">TF Item Page</a></p>
                                <p><a href="http://themeforest.net/item/london-creative-portfolio-blog-wp-theme/70613?ref=freshface#version_history" target="_blank" class="btn_small">Check for newer version</a></p>
                                <p><a href="<?php echo get_bloginfo('template_url');?>/help/" target="_blank" class="btn_small">Documentation</a></p>
                            </div><!-- END "div.links" -->
                        <div class="fresh_items">
                            <h2>Browse my themes:</h2>
                            <div class="fresh_themes_wrapper">
                            <?php 
								/* gets the data from URL */
								if( function_exists  (  'curl_init'  ) )
								{
								  $fresh_url = 'http://freshface.cz/freshpanel/mythemes.php';
								$ch = curl_init();
								$timeout = 5;
								curl_setopt($ch,CURLOPT_URL,$fresh_url);
								curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
								curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
								$fresh_data = curl_exec($ch);
								curl_close($ch);
								echo $fresh_data;
								}      
							?>

                            </div><!-- END "div.fresh_themes_wrapper" -->
                            <div class="button_wrapper">
                                <p><a href="http://themeforest.net/user/freshface/portfolio?ref=freshface" target="_blank" class="btn_small">Browse all</a></p>
                                <p><a href="http://www.freshface.net/fffp-lcp/" target="_blank" class="btn_small">Visit my Blog</a></p>
                                <div class="btn_nav">
                                    <div class="btn_nav_left"></div>
                                    <div class="btn_nav_right"></div>
                                </div>
                            </div><!-- END "div.button_wrapper" -->
                        </div><!-- END "div.fresh_items" -->
                        <?php } ?>
                    </div><!-- END "div.header_inner" -->
                       <?php echo $tab_content; ?>
                    </div><!-- END "div.header" -->
                    <?php echo $options_content; ?>
   
                </div><!-- END "div.right" -->
                <div class="clear"></div>
            </div><!-- END "div.wrapper_bg" -->
        </div><!-- END "div.wrapper_bg_outer" -->
    </div>
    <!-- END "div#wrapper_glogal" --><div class="theme_version">Theme + Version: LondonCreative+ v4.2</div>
    </form>
</div><!-- END "div#freshpanel" -->
  <?php
  }
  //////////////////////////////////////////////////////////////////////////////
  // ACTIONS
  //////////////////////////////////////////////////////////////////////////////
  add_action('admin_init', 'freshpanel_add_init'); 
  add_action('admin_menu', 'freshpanel_add_admin');        
 
?>