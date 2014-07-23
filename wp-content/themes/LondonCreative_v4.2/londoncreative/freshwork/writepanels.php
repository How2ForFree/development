<?php
////////////////////////////////////////////////////////////////////////////////
// PAGE WRITE PANELS
////////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////////
// ACTIONS
////////////////////////////////////////////////////////////////////////////////
  add_action('admin_menu', 'create_meta_box');  
  add_action('save_post', 'save_postdata');  
  
  /* register and create meta boxes for pages */
  function create_meta_box() {
    global $theme_name;
      if ( function_exists('add_meta_box') ) {
       // add_meta_box( 'new-meta-boxes', 'Post settings', 'new_meta_boxes', 'post', 'normal', 'high' );
        add_meta_box( 'page-writepanels-new', 'Page settings', 'page_writepanels_new', 'portfolio', 'normal', 'high' );
        add_meta_box( 'page-writepanels-new', 'Page settings', 'page_writepanels_new', 'post', 'normal', 'high' );
        add_meta_box( 'page-writepanels-new', 'Page settings', 'page_writepanels_new', 'page', 'normal', 'high' );
      } // end(if)
  } // end(create_meta_box)
  
  /* save post data here */
  function save_postdata( $post_id ) {
    
   // if ($_POST['post_type'] ==  'page' || )
    {
         global $post, $page_write_panel;
        
        foreach($page_write_panel as $meta_box) {
        if($meta_box['type'] != "divider"){
        // Verify
        if ( !wp_verify_nonce( $_POST[$meta_box['name'].'_noncename'], plugin_basename(__FILE__) )) {
        return $post_id;
        }
        
        if ( 'post' == $_POST['post_type'] ) {
          if ( !current_user_can( 'edit_page', $post_id ))
          return $post_id;
        } else {
        if ( !current_user_can( 'edit_post', $post_id ))
        return $post_id;
        }
 
        $data = $_POST[$meta_box['name']];
        $data = addslashes($data);
        if(get_post_meta($post_id, $meta_box['name']) == "")
        add_post_meta($post_id, $meta_box['name'], $data, true);
        elseif($data != get_post_meta($post_id, $meta_box['name'], true))
        update_post_meta($post_id, $meta_box['name'], $data);
        elseif($data == "")
        delete_post_meta($post_id, $meta_box['name'], get_post_meta($post_id, $meta_box['name'], true));
        }
        }
     }
  } // end(save_postdata)
// ARRAYS
 $page_write_panel =  
   array(  
   "POST SETINGS" => array(  
   "name" => "POST SETTINGS",  
   "type" => "divider"),
   
   "mainimg" => array(  
   "name" => "mainimg",  
   "std" => "",  
   "title" => "Main Image",  
   "description" => "Used throughout the Theme. Insert an image as big as possible."),  

   "mainimg_lightbox" => array(  
   "name" => "show_lightbox",  
   "std" => "false",  
   "title" => "Show Lightbox",  
   "type" => "checkbox",
   "description" => "If enabled, the Image will open the lightbox instead of direct linking to post"),
     
   "embed video" => array(  
   "name" => "embed_video", 
   "type" => "textarea", 
   "std" => "",  
   "title" => "Embed Video",  
   "description" => "Insert the embed code of your video."),
   
   "mainimg_medium" => array(  
   "name" => "mainimg_medium",  
   "std" => "",  
   "title" => "Medium Image",  
   "description" => "Medium Image has got fixed width 560px."),
   
   "mainimg_small" => array(  
   "name" => "mainimg_small",  
   "std" => "",  
   "title" => "Small Smage",  
   "description" => "Used only in slider. Default fixed dimensions are 152 * 100 px"),
   
   "page_title" => array(  
   "name" => "page_title",  
   "std" => "true",  
   "title" => "Page Title",  
   "type" => "checkbox",
   "description" => "Display Page Title ?"),
   
   
       "fullwidth" => array(  
   "name" => "fullwidth",  
   "std" => "false",  
   "title" => "Fullwidth",  
   "type" => "checkbox",
   "description" => "Display single post with fullwidth template ?")        
   

   );
   
// HTML DRAWING

  function page_writepanels_new() {
    global $post, $page_write_panel;
    
    foreach($page_write_panel as $meta_box) {  // we'r going through all values
      $meta_box_value = get_post_meta($post->ID, $meta_box['name'], true);
  
      if($meta_box_value == "") $meta_box_value = $meta_box['std']; // if is empty, insert standart value
      $meta_box_value = stripslashes($meta_box_value);
      
      // html structure
      if($meta_box["type"] == "divider") echo '<h1>'.$meta_box['name'].'</h1>';

      else
      {
          echo '<div id="'.$meta_box['name'].'_div">';
          echo'<input type="hidden"  name="'.$meta_box['name'].'_noncename" id="'.$meta_box['name'].'_noncename" value="'.wp_create_nonce( plugin_basename(__FILE__) ).'" />';
          echo'<h2>'.$meta_box['title'].'</h2>';
          if($meta_box['type'] == "textarea")     // TEXTAREA
          {
            echo '<textarea name="'.$meta_box['name'].'" width="400px" cols="55" rows="4" />'.$meta_box_value.'</textarea><br />';
          }
              else if($meta_box['type'] == "checkbox")
            {
               echo '<select name="'.$meta_box['name'].'" id="'.$meta_box['name'].'">';
               if($meta_box_value == "true" )
               {
                echo   '<option value="true" selected>yes</option>';
                echo   '<option value="false" >no</option>';
               
               }
               else
               {
                echo   '<option value="true"  >yes</option>';
                echo   '<option value="false" selected>no</option>';
               }
              
               echo '</select>';
            
              // echo'<input type="checkbox" name="'.$meta_box['name'].'" value="ssss" checked size="55" /><br />';
                }
          else                                    // TEXT
          {
            echo'<input type="text" id="'.$meta_box['name'].'" name="'.$meta_box['name'].'" size="68" value="'.$meta_box_value.'" /><br />';
          }
          echo'<p><label for="'.$meta_box['name'].'_value">'.$meta_box['description'].'</label></p>';
          echo '</div>';
        
      }// end(else)
    }  // END FOREACH
  }    // end(page_writepanels_new)

?>
