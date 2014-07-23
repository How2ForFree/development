<?php
// CONTACT FORM PRE-HTML CODE - SCROLL DOWN TO SEE THE BEGINNING OF THE ACTUAL HTML CODING

		/****SET THE MAX CHARS FOR EACH MESSAGE***************/
			
			//it is recommended not to set the max too high, to prevent extremely long messages
			// from stalling your server
			
			$EMAIL_MAX = 2500;
			$SMS_MAX = 120;
		
		/*****************************************************/

		//function for stripping whitespace and some chars
		function cleanUp($str_to_clean, $newlines, $spaces){
		
			//build list of whitespace chars to be removed
			$bad_chars = array('\r', '\t', ';');
		
			//if newlines are false, add that to the list of bad chars
			if(!$newlines){array_push($bad_chars, '\n');}
			
			//if spaces are false, strip them too
			if(!$spaces){array_push($bad_chars, ' ');}
			
			$str_to_clean_a = str_replace($bad_chars, '', $str_to_clean);
			$str_to_clean_b = strip_tags($str_to_clean_a);
			return $str_to_clean_b;
		}
		
		//function to check for valid email address pattern
		function checkEmail($email) {
			if(!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $email)) {return false;}
			return true;
		}
		//function to check for valid url pattern
		function checkURL($url) {
			if(!eregi("^http:\/\/", $url)) {return false;}
			return true;
		}
		
// END CONTACT FORM PRE-HTML CODE
?>





<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr">

<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Flex | Premium Portfolio Template</title>

<!-- SCRIPTS SECTION ||||||||||||||||||||||||||||||||| -->

	<!-- Javascript (jQuery) + Superfish Scripts -->
	<script type='text/javascript' src='../assets/js/jquery-1.3.2.min.js'></script>
	<script type="text/javascript" src="../assets/js/jquery.easing.1.3.js"></script>
	<script type="text/javascript" src="../assets/js/jquery.vgrid.0.1.5.min.js"></script>
	<script type="text/javascript" src="../assets/js/superfish.js"></script>
	<script type="text/javascript" src="../assets/js/hoverIntent.js"></script>
	<script type="text/javascript" src="../assets/js/jquery.swfobject.js"></script>
	<script type="text/javascript" src="../assets/js/jquery.ceebox-min.js"></script>
	
	<!-- Cufon Load Fonts -->
	<script src="../assets/js/cufon-yui.js" type="text/javascript"></script>
	<script src="../assets/js/League_Gothic_400.font.js" type="text/javascript"></script>
				
	<!-- Core Javascript -->
	<script type="text/javascript" src="../assets/js/flex.js"></script>
	

 
<!-- CSS SECTION  ||||||||||||||||||||||||||||||||| -->

	<!-- Style.css Loads all other major stylesheets. assets/css/core.css is the primary stylesheet for this template. -->
	<link rel="stylesheet" href="../assets/style.css" type="text/css" media="screen" />
		
	<!-- This is the "skin" stylesheet. Cufon.js just helps you set the Current Page Link color in the header nav. -->
	<link href="skin/quick-styles.css" media="screen" rel="stylesheet" type="text/css" />
	<script src="skin/cufon.js" type="text/javascript"></script>
		
	<!--[if IE 6]>
		<link rel="stylesheet" type="text/css" href="../assets/css/ie-6.0.css" />
	<![endif]-->
	
	<!-- This is how you might add some custom CSS :) -->
	<style type="text/css">
 	#logo {
	padding:0px 0;
	margin: -1px 0 0 -20px;
	} 	.single_post, .single_page {
	width:590px !important;
	}
	#grid-content div{display: none;}
	#grid-content div div{display: inline;}
 	</style>
 	 	
 	
 	



<!-- CONTACT FORM CODE START -->
<script type="text/javascript">
v_fields = new Array('sender_name','sender_email','sender_subject','sender_message');alert_on = true;thanks_on = true; thanks_message = "Thank you. Your message has been sent.";	
	function validateForm(){
		
		//alert(v_fields);
		
		//init errors
		var err = "";
		
		//start checking fields
		for(i=0;i<v_fields.length;i++){
			
			//store the field value
			var _thisfield = eval("document.contact."+v_fields[i]+".value");
			
			//check the field value
			if(v_fields[i] == "sender_name"){
				if(!isAlpha(_thisfield)){ err += "Please enter a valid name\n";}
			}else if(v_fields[i] == "sender_subject"){
				if(!isAlpha(_thisfield)){ err += "Please enter a valid subject\n";}
			}else if(v_fields[i] == "sender_email"){
				if(!isEmail(_thisfield)){ err += "Please enter a valid email address\n";}
			}else if(v_fields[i] == "sender_url"){
				if(!isURL(_thisfield)){ err += "Please enter a valid URL\n";}
			}else if(v_fields[i] == "sender_phone"){
				if(!isPhone(_thisfield)){ err += "Please enter a valid phone number\n";}
			}else if(v_fields[i] == "sender_message"){
				if(!isText(_thisfield)){ err += "Please enter a valid message\n";}
			}
			
		}//end for
		
		if(err != ""){ 
			if(alert_on){
				alert("The following errors have occurred\n"+err);
			}else{
				showErrors(err);
			}
			
			return false;
		
		}
		
		return true;
	}
	
	//function to show errors in HTML
	function showErrors(str){
		var err = str.replace(/\n/g,"<br />");
		document.getElementById("form_errors").innerHTML = err;
		document.getElementById("form_errors").style.display = "block";
	
	}
	
	//function to show thank you message in HTML
	function showThanks(str){
		var tym = str.replace(/\n/g,"<br />");
		document.getElementById("form_thanks").innerHTML = tym;
		document.getElementById("form_thanks").style.display = "block";
	
	}
	
	function isEmail(str){
	if(str == "") return false;
	var regex = /^[^\s()<>@,;:\/]+@\w[\w\.-]+\.[a-z]{2,}$/i
	return regex.test(str);
	}
	
	function isText(str){
		if(str == "") return false;
		return true;
	}
	
	function isURL(str){
		var regex = /[a-zA-Z0-9\.\/:]+/
		return regex.test(str);
	}
	
	// returns true if the number is formatted in the following ways:
	// (000)000-0000, (000) 000-0000, 000-000-0000, 000.000.0000, 000 000 0000, 0000000000
	function isPhone(str){
		var regex = /^\(?[2-9]\d{2}[\)\.-]?\s?\d{3}[\s\.-]?\d{4}$/
		return regex.test(str);
	}
	
	// returns true if the string contains A-Z, a-z or 0-9 or . or # only
	function isAddress(str){
		var regex = /[^a-zA-Z0-9\#\.]/g
		if (regex.test(str)) return true;
		return false;
	}
	
	// returns true if the string is 5 digits
	function isZip(str){
		var regex = /\d{5,}/;
		if(regex.test(str)) return true;
		return false;
	}
	
	// returns true if the string contains A-Z or a-z only
	function isAlpha(str){
		var regex = /[a-zA-Z]/g
		if (regex.test(str)) return true;
		return false;
	}
	
	// returns true if the string contains A-Z or a-z or 0-9 only
	function isAlphaNumeric(str){
		var regex = /[^a-zA-Z0-9]/g
		if (regex.test(str)) return false;
		return true;
	}

</script>

	<?php
	if(isset($_POST["submitForm"])){

		$_name = cleanUp($_POST["sender_name"], false, true);

		$_email = cleanUp($_POST["sender_email"], false, false);

		$_subject = cleanUp($_POST["sender_subject"], false, true);

		$_message = cleanUp($_POST["sender_message"], true, true);

		$_url = cleanUp($_POST["sender_url"], false, false);

		
		$_body = "You have been sent this message from your contact form\n\n";
		
		if($_name){
			$_body .= "NAME: $_name\n\n";
		}
		
		if($_email){
			$_body .= "EMAIL: $_email\n\n";
		}
		
		if($_url){
			$_body .= "URL: $_url\n\n";
		}
		
		if($_phone){
			$_body .= "PHONE: $_phone\n\n";
		}
		
		if($_message){
		
			//check length of body, reduce to max chars
			if(strlen($_message) > $EMAIL_MAX){$_message= substr($_message, 0, $EMAIL_MAX);}else{$_message = $_message;}
			if(strlen($_message) > $SMS_MAX){$_message2 = substr($_message, 0, $SMS_MAX);}else{$_message2 = $_message;}
		}
		
		

		//store the recipient(s)
		$_to = array();




		// !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
		// ===================================
		// ===================================
		
		// ENTER YOUR EMAIL ADDRESS RIGHT HERE
		$_to[] = "brandon.r.jones@gmail.com";
		
		// ===================================
		// ===================================
		// !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
		
		
		
		
		//define the subject
		if(!$_subject){$_subject = "E-Mail from your contact form";}

		
		if(!$_name){$_name = "CONTACT FORM";}
		if(!$_email){$_email = $_name;}
		
		//set the headers
		$_header = "From: $_name < $_email >" . "\r\n" .
    "Reply-To: ".$_email."\r\n" .
    "Super-Simple-Mailer: supersimple.org";
		
		//we can send up to 2 emails (EMAIL and/or SMS)
		if(count($_to) > 2){ $_to = array_slice($_to,0,2);}
		
		for($i=0;$i<count($_to);$i++){
			
			//get the correct message, based on where it is delivering to
			if(strstr($_to[$i],"teleflip.com")){$_text = $_body.$_message2;}else{$_text = $_body.$_message;}
			
			//send the email(s)
			mail($_to[$i], $_subject, $_text, $_header);
			
		}
		
		echo "<script type=\"text/javascript\">window.onload = function(){showThanks(thanks_message);}</script>";
	}
	?>	
<!-- CONTACT FORM CODE END  -->

 	

</head>

<body class="home">
	
	<!-- TOP BAR  -->    
    <div id="top_bar">
    	<div class="margin25px">
    		    		
    		<!-- LOGO  -->    	
    		<div id="logo">    		    		    		
            <a id="logolink" href="#" title="Flex"><img id="logotype" src="skin/images/default_logo.png" alt="Flex" /></a>
            </div>
            <!-- /LOGO  -->
                                    
            
            <!-- NAVIGATION  -->
			<div id="navigation">
			                
				<ul class="sf-menu">
					<li class="home current_page_item"><a href="index.html">Home</a></li>
					
					<li class="page_item"><a href="about.html" title="About">About</a>
						<ul>
							<li class="page_item"><a href="html-test.html" title="HTML Test Page">HTML Test Page</a></li>
							<li class="page_item "><a href="overview.html" title="Overview">Overview</a></li>
							<li class="page_item"><a href="clients.html" title="Client List">Client List</a></li>
						</ul>
					</li>
					
					<li class="page_item"><a href="services.html" title="Services">Services</a>
					<ul>
							<li class="page_item"><a href="service-1.html" title="Illustration &amp; Design">Illustration &amp; Design</a></li>
							<li class="page_item"><a href="service-2.html" title="Photography">Photography</a></li>
							<li class="page_item"><a href="service-3.html" title="Web Design">Web Design</a></li>
						</ul>
					</li>
					
					<li class="page_item"><a href="contact.html" title="Contact">Contact</a></li>
					
					<li class="page_item"><a href="#" id="rsort">shuffle!</a></li>
				</ul>
						
			</div>
			<!-- /END NAVIGATION  -->
			
			
						
			<!-- SOCIAL MEDIA + SEARCH -->
            <div id="right_links">
            	
	            <div class="search">
				<form method="post" action="/themes/wp/mu/wpmu/index.php">
				<fieldset>
				<input type="text" class="field" name="s" value="" />
				<input type="submit" class="button" name="send" value="" />
				</fieldset>
				</form>
				</div>
	
	 			<a href="#" target="_blank"><img src="../assets/images/social_media/rss_16.png" alt="RSS" /></a>
	 				
	 			<a id="facebook" href="#" title="Facebook" target="_blank"><img src="../assets/images/social_media/facebook_16.png" alt="facebook" /></a>
	                                
	            <a id="twitter" href="http://www.twitter.com/makedesign" title="Twitter" target="_blank"><img src="../assets/images/social_media/twitter_16.png" alt="twitter" /></a>                  								
	            
            </div>
            <!--/SOCIAL MEDIA + SEARCH -->
            
            
                                   
        </div>
    </div>
    <!-- /TOP BAR  -->    
    
        

    
    <!-- MAIN CONTENT  -->    
    <div class="mainmargin" id="grid-content">
           
    		
	<!-- CONTENT CONTAINER -->
	
	<!-- CHECK FOR REMOVE_SIDEBAR CUSTOM FIELD -->
		<div id="container">

		
		<!-- MAIN COLUMN -->
		<div class="single_post rounded">
       		
			<h1>Contact Us Today!</h1>
			
			<div class="the_content">
				
				<p><img src="../assets/images/pages/contact.jpg" alt="" title="contact" width="590" height="246" class="bordered" /></p>
				<h3>Fill out this simple form below to send us a message:</h3>
				<p>The Flex template comes complete with a fully styled contact form. Just use one of the free "contact form builders" on the web, drop in the functional code that links to your inbox, and you're all set! Build the contact form that suits your exact needs, then put it to work on your site!</p>
				<p><div class="contact">
								<form action="" method="post">
									<fieldset>
										<input type="text" name="name" value="Your Name" />
										<input type="text" name="email" value="Your Email (Kept Private)" />
										<input type="text" name="website" value="Your Website" />
										<textarea name="comment" cols="65" rows="10">Your Comments</textarea>
										<input type="submit" class="button" name="submit" value="Send Email" />
									</fieldset>
								</form></div></p>
			</div>

            
        </div>
        <!-- /END MAIN COLUMN -->
        
        						
        	
		<!-- SIDEBAR COLUMN -->        
		<div id="sidebar" class="rounded">
			<ul>
				<li>
					<ul>
						<li id="text-5" class="widget widget_text"><h2 class="widget_title">Affiliates</h2>			
							<div class="textwidget">
								<ul class="ads">
									<li><a href="#"><img src="../assets/images/themeforest.jpg" alt="Theme Forest"/></a></li>
									<li><a href="#"><img src="../assets/images/graphic_river.jpg" alt="Graphic River"/></a></li>
									<li><a href="#"><img src="../assets/images/flash_den.jpg" alt="Flash Den"/></a></li>
									<li><a href="#"><img src="../assets/images/audio_jungle.jpg" alt="Audio Jungle"/></a></li>
								</ul>
							</div>
						</li>
					</ul>
				</li>
				
				<li class="widget widget_text">
					<h2 class="widget_title">Features</h2>			
					<div class="textwidget">
						<img src="../assets/images/sidebar_big_ad.jpg" alt="arsenal"/>			
					</div>
				</li>	
				
			</ul>
					
		</div>
		<!-- /END SIDEBAR COLUMN -->			
			                
	</div>
	<!-- CONTENT CONTAINER -->

    </div> 
    <!-- /MAIN CONTENT -->
    
    
    
    
    
    <!-- FOOTER -->
    <div id="footer">
    	
    	<!-- FOOTER COLUMNS -->
    	<div class="margin25px">
    		
            <div id="footer_left" class="footer_column">
            	<ul>
					<li id="text-4" class="widget widget_text"><h2 class="widget_title">About the Theme</h2><div class="textwidget"><img src="../assets/images/flex-thumb.jpg" alt="image" style="float: left; margin-right: 10px;"/>The Flex theme is designed to be, well, flexible. Display images, articles, videos, audio, and more. Control everything from the speed of transitions, the number of images per page, the style of the site (over 12 custom styles so far), and much, much more! Installation is a breeze, and you'll be adding your own content in minutes. Let's get started now!</div>
					</li>		
				</ul>
            </div>
                        
            <div class="footer_column">
	            <ul>
	                <li id="text-3" class="widget widget_text"><h2 class="widget_title">Affiliates</h2>			
	                	<div class="textwidget">
	                		<ul class="ads">
								<li><a href="#"><img src="../assets/images/themeforest.jpg" alt="Theme Forest"/></a></li>
								<li><a href="#"><img src="../assets/images/graphic_river.jpg" alt="Graphic River"/></a></li>
								<li><a href="#"><img src="../assets/images/flash_den.jpg" alt="Flash Den"/></a></li>
								<li><a href="#"><img src="../assets/images/audio_jungle.jpg" alt="Audio Jungle"/></a></li>
							</ul>
						</div>
					</li>				
				</ul>
            </div>
                        
            <div id="footer_middle_column" class="footer_column">
                <ul>
                	<li id="recent-comments-3" class="widget widget_recent_comments">
                			<h2 class="widget_title">Favorite Links</h2>                			
                			<ul>
                				<li><a href='#' rel='external nofollow' class='url'>Desktopography</a> - Hot Desktop Wallpaper</li>
                				<li><a href='#' rel='external nofollow' class='url'>ThemeForest</a> - Great Themes</li>
                				<li><a href='#' rel='external nofollow' class='url'>Envato Marketplaces</a></li>
                				<li><a href='#' rel='external nofollow' class='url'>MediaTemple</a> - Awesome Hosting</li>
                				<li><a href='#' rel='external nofollow' class='url'>Desktopography</a> - Hot Desktop Wallpaper</li>
                				<li><a href='#' rel='external nofollow' class='url'>ThemeForest</a> - Great Themes</li>
                				<li><a href='#' rel='external nofollow' class='url'>Envato Marketplaces</a></li>
                				<li><a href='#' rel='external nofollow' class='url'>MediaTemple</a> - Awesome Hosting</li>
                				<li><a href='#' rel='external nofollow' class='url'>Envato Marketplaces</a></li>
            				</ul>
					</li>		
				</ul>
            </div>
                        
            <div class="footer_column">
	            <ul>
	                <li class="widget widget_categories"><h2 class="widget_title">Categories</h2>	
	                	<ul>
							<li class="cat-item cat-item-186"><a href="#" title="View all posts filed under Graphic Design">Graphic Design</a> (13)</li>				
							<li class="cat-item cat-item-4"><a href="#" title="View all posts filed under Inspiration">Inspiration</a> (4)</li>
							<li class="cat-item cat-item-201"><a href="#" title="View all posts filed under Landscapes">Landscapes</a> (1)</li>
							<li class="cat-item cat-item-126"><a href="#" title="View all posts filed under Photography">Photography</a> (12)	</li>
							<li class="cat-item cat-item-200"><a href="#" title="View all posts filed under Portraits">Portraits</a> (1)</li>
							<li class="cat-item cat-item-12"><a href="#" title="View all posts filed under Typography">Typography</a> (10)</li>
							<li class="cat-item cat-item-174"><a href="#" title="View all posts filed under Web Design">Web Design</a> (10)</li>
							<li class="cat-item cat-item-199"><a href="#" title="View all posts filed under Weddings">Weddings</a> (1)</li>
						</ul>				
					</li>               
				 </ul>
            </div>
            
    	</div>
    	<!-- /FOOTER COLUMNS -->    	
    	
    	
    	<div class="copyright">Copyright 2010 by Your Company.</div>
    </div>
	<!-- /FOOTER -->
	
	
	
	
</body>

</html>