/**********************************************************************
* DIGITAL CAVALRY WP VOTING SYSTEM PLUGIN 
* (WP voting system)   
* 
* File name:   
*      admin.js
* Brief:       
*      Plugin admin panel JavaScript file
* Author:      
*      DigitalCavalry
* Author URI:
*      http://themeforest.net/user/DigitalCavalry
* Contact:
*      digitalcavalry@gmail.com 
**********************************************************************/  

/*********************************************************** 
* MAIN
************************************************************/  

 jQuery(document).ready(function($)
    {   
        var q = jQuery.noConflict(); 
        
        // saved bar
        q('.cms-saved-bar').stop().css('opacity', 0.0).animate({opacity:1.0}, 600).animate({opacity:0.0}, 600).animate({opacity:1.0}, 600);
        
        
        // image loading
        var formfield = null;
        
        q('.upload_image_button').click(function() {
               
         formfield = q(this).attr('name');  
         tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true'); 
         return false;

        });

        window.original_send_to_editor = window.send_to_editor;
        
        window.send_to_editor = function(html) {

            if(formfield)
            {
                imgurl = q('img',html).attr('src');
                q('#'+formfield).val(imgurl);
                tb_remove();
                formfield = null;
            } else
            {
                window.original_send_to_editor(html);
            }
        }  
                  
    }); 
    
    
