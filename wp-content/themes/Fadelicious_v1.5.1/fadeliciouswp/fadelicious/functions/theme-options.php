<?php

add_action('init','of_options');

if (!function_exists('of_options')) {
function of_options(){
	
// VARIABLES
$themename = get_theme_data(STYLESHEETPATH . '/style.css');
$themename = $themename['Name'];
$shortname = "of";

// Populate OptionsFramework option in array for use in theme
global $of_options;
$of_options = get_option('of_options');

$GLOBALS['template_path'] = get_bloginfo('stylesheet_directory');

//Access the WordPress Categories via an Array
$of_categories = array();  
$of_categories_obj = get_categories('hide_empty=0');
foreach ($of_categories_obj as $of_cat) {
    $of_categories[$of_cat->cat_ID] = $of_cat->cat_name;}
$categories_tmp = array_unshift($of_categories, "Select a category:");    
       
//Access the WordPress Pages via an Array
$of_pages = array();
$of_pages_obj = get_pages('sort_column=post_parent,menu_order');    
foreach ($of_pages_obj as $of_page) {
    $of_pages[$of_page->ID] = $of_page->post_name; }
$of_pages_tmp = array_unshift($of_pages, "Select a page:");       

// Image Alignment radio box
$options_thumb_align = array("alignleft" => "Left","alignright" => "Right","aligncenter" => "Center"); 

// Image Links to Options
$options_image_link_to = array("image" => "The Image","post" => "The Post"); 

//Testing 
$options_select = array("one","two","three","four","five"); 
$options_radio = array("one" => "One","two" => "Two","three" => "Three","four" => "Four","five" => "Five"); 

//Stylesheets Reader
$alt_stylesheet_path = STYLESHEETPATH . '/styles/';
$alt_stylesheets = array("gray" => "gray","blue" => "blue","brown" => "brown","green" => "green","pink" => "pink","yellow" => "yellow");

if ( is_dir($alt_stylesheet_path) ) {
    if ($alt_stylesheet_dir = opendir($alt_stylesheet_path) ) { 
        while ( ($alt_stylesheet_file = readdir($alt_stylesheet_dir)) !== false ) {
            if(stristr($alt_stylesheet_file, ".css") !== false) {
                $alt_stylesheets[] = $alt_stylesheet_file;
            }
        }    
    }
}

//More Options
$uploads_arr = wp_upload_dir();
$all_uploads_path = $uploads_arr['path'];
$all_uploads = get_option('of_uploads');
$other_entries = array("Select a number:","1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19");
$body_repeat = array("no-repeat","repeat-x","repeat-y","repeat");
$body_pos = array("top left","top center","top right","center left","center center","center right","bottom left","bottom center","bottom right");

// Set the Options Array
$options = array();

$options[] = array( "name" => "General Settings",
                    "type" => "heading");
					

$options[] = array( "name" => "Custom Logo",
					"desc" => "Specify the image address of your online logo. (i.e: http://yoursite.com/logo.png)",
					"id" => $shortname."_logo",
					"std" => "",
					"type" => "text");
					

$options[] = array( "name" => "Custom Favicon",
					"desc" => "Specify a 16px x 16px image that will represent your website's favicon. (i.e: http://yoursite.com/favicon.png)",
					"id" => $shortname."_custom_favicon",
					"std" => "",
					"type" => "text"); 
					
$options[] = array( "name" => "Contact Form Email",
					"desc" => "Enter your E-mail address to use on the Contact Form Page Template. Ex: name@yoursite.com",
					"id" => $shortname."_email",
					"std" => "",
					"type" => "text"); 
					                                               
$options[] = array( "name" => "Tracking Code",
					"desc" => "Paste your Google Analytics (or other) tracking code here. This will be added into the footer template of your theme.",
					"id" => $shortname."_google_analytics",
					"std" => "",
					"type" => "textarea");        
 
                    
$options[] = array( "name" => "Theme Settings",
					"type" => "heading");
					
               
					
$options[] = array( "name" => "Portfolio Category",
					"desc" => "Select a category for Portfolio",
					"id" => $shortname."_portfolio_category",
					"std" => "Select a category:",
					"type" => "select",
					"options" => $of_categories);  
					
$options[] = array( "name" => "Blog Category",
					"desc" => "Select a category for Blog",
					"id" => $shortname."_blog_category",
					"std" => "Select a category:",
					"type" => "select",
					"options" => $of_categories);  

$options[] = array( "name" => "Slider Settings",
					"type" => "heading");	
					
$options[] = array( "name" => "Featured Category",
					"desc" => "Select a category for the images that will be drawn into Slider",
					"id" => $shortname."_featured_category",
					"std" => "Select a category:",
					"type" => "select",
					"options" => $of_categories);  					
                                    
$options[] = array( "name" => "Speed",
					"desc" => "Speed of the transition ",
					"id" => $shortname."_slider_speed",
					"std" => "1000",
					"type" => "text"); 				

                                    
$options[] = array( "name" => "Auto Play",
					"desc" => "Milliseconds between slide transitions (0 to disable auto advance)",
					"id" => $shortname."_slider_timeout",
					"std" => "4000",
					"type" => "text"); 	


$options[] = array( "name" => "Pause",
					"desc" => "True (1) to enable pause on hover, false (0) to disable.",
					"id" => $shortname."_slider_pause",
					"std" => "1",
					"type" => "text"); 

$options[] = array( "name" => "Footer Settings",
					"type" => "heading");
					
$options[] = array( "name" => "Facebook URL",
					"desc" => "Enter your Facebook URL if you have one",
					"id" => $shortname."_facebook",
					"std" => "",
					"type" => "text"); 					
					
$options[] = array( "name" => "Twitter URL",
					"desc" => "Enter your Twitter URL if you have one",
					"id" => $shortname."_twitter",
					"std" => "",
					"type" => "text"); 
								
$options[] = array( "name" => "Tumblr URL",
					"desc" => "Enter your Tumblr URL if you have one",
					"id" => $shortname."_tumblr",
					"std" => "",
					"type" => "text"); 

$options[] = array( "name" => "Flickr URL",
					"desc" => "Enter your Flickr URL if you have one",
					"id" => $shortname."_flickr",
					"std" => "",
					"type" => "text"); 					
					
$options[] = array( "name" => "StumbleUpon URL",
					"desc" => "Enter your StumbleUpon URL if you have one",
					"id" => $shortname."_stumbleupon",
					"std" => "",
					"type" => "text"); 
								
$options[] = array( "name" => "Delicious URL",
					"desc" => "Enter your Delicious URL if you have one",
					"id" => $shortname."_delicious",
					"std" => "",
					"type" => "text"); 
								
$options[] = array( "name" => "RSS Feed URL",
					"desc" => "Enter your RSS Feed URL if you have one",
					"id" => $shortname."_rss",
					"std" => "",
					"type" => "text"); 	


$options[] = array( "name" => "Footer Text",
                    "desc" => "Enter text you want to be displayed on Footer",
                    "id" => $shortname."_footer_text",
                    "std" => "",
                    "type" => "textarea");   

					                    					                    
$options[] = array( "name" => "Styling Options",
					"type" => "heading");                                                      
    
				
					
$options[] = array( "name" => "Theme Stylesheet",
					"desc" => "Select your themes alternative color scheme.",
					"id" => $shortname."_alt_stylesheet",
					"std" => "default.css",
					"type" => "select",
					"options" => $alt_stylesheets); 
					
$options[] = array( "name" => "Custom CSS",
                    "desc" => "Quickly add some CSS to your theme by adding it to this block.",
                    "id" => $shortname."_custom_css",
                    "std" => "",
                    "type" => "textarea");
					

update_option('of_template',$options); 					  
update_option('of_themename',$themename);   
update_option('of_shortname',$shortname);

}
}
?>
