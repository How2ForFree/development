<?php
$wp_include = "../wp-load.php";
$i = 0;
while (!file_exists($wp_include) && $i++ < 10) {
  $wp_include = "../$wp_include";
}
require($wp_include);

// check for rights
if ( !is_user_logged_in() || !current_user_can('edit_posts') ) 
	wp_die(__("You are not allowed to be here"));
?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Theme Dutch Shortcode</title>
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php echo get_option('blog_charset'); ?>" />
	<script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-includes/js/tinymce/tiny_mce_popup.js"></script>
	<script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-includes/js/tinymce/utils/mctabs.js"></script>
	<script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-includes/js/tinymce/utils/form_utils.js"></script>
	<script language="javascript" type="text/javascript" src="<?php echo get_template_directory_uri() ?>/lib/shortcodes/tinymce.js"></script>
	<base target="_self" />
</head>
<body id="link" onLoad="tinyMCEPopup.executeOnLoad('init();');document.body.style.display='';" style="display:none">
	<fieldset>
	  <legend>Select the shortcode you would like to insert</legend>
	  <table border="0" cellpadding="4" cellspacing="0">
     <tr>
      <td><select id="style_shortcode" name="style_shortcode" style="width: 200px">
          <option value="0">No Style</option>
	        <optgroup label="Boxes">
						<option value="header_box">Header Box</option>
						<option value="download_box">Download Box</option>
						<option value="td_titled_box">TD Titled Box</option>
						<option value="info_box">Info Box</option>
					</optgroup>
          <optgroup label="Dividers">
            <option value="divider_large">Large divider Black</option>
            <option value="divider_large_white">Large divider White</option>
            <option value="divider_large_gray">Large divider Gray</option>
            <option value="divider_short">Short divider Black</option>
            <option value="divider_short_white">Short divider White</option>
            <option value="divider_short_gray">Short divider Gray</option>
					</optgroup>
	        <optgroup label="Dropcaps">
						<option value="dropcap1">Dropcap 1</option>
						<option value="dropcap2">Dropcap 2</option>
						<option value="dropcap3">Dropcap 3</option>
					</optgroup>
	        <optgroup label="Layouts">
						<option value="one_half_layout">Two Column Layout</option>
						<option value="one_third_layout">Three Column Layout</option>
            <option value="one_fourth_layout">Four Column Layout</option>
            <option value="one_fifth_layout">Five Column Layout</option>
            <option value="one_sixth_layout">Six Column Layout</option>
						<option value="one_third_two_third">One Third - Two Third</option>
						<option value="two_third_one_third">Two Third - One Third</option>
					</optgroup>
	        <optgroup label="Links">
						<option value="download_link">Download Link</option>
						<option value="email_link">E-mail Link</option>
						<option value="td_link">TD Link</option>
					</optgroup>
	        <optgroup label="Lists">
						<option value="bullet_list">Bullet List</option>
						<option value="check_list">Check List</option>
            <option value="barcode_black_list">Barcode Black List</option>
            <option value="barcode_red_list">Barcode Red List</option>
            <option value="barcode_green_list">Barcode Green List</option>
            <option value="barcode_blue_list">Barcode Blue List</option>
            <option value="barcode_orange_list">Barcode Orange List</option>
            <option value="chat_black_list">Chat Black List</option>
            <option value="chat_red_list">Chat Red List</option>
            <option value="chat_green_list">Chat Green List</option>
            <option value="chat_blue_list">Chat Blue List</option>
            <option value="chat_orange_list">Chat Orange List</option>
            <option value="check_black_list">Check Black List</option>
            <option value="check_red_list">Check Red List</option>
            <option value="check_green_list">Check Green List</option>
            <option value="check_blue_list">Check Blue List</option>
            <option value="check_orange_list">Check Orange List</option>
            <option value="link_black_list">Link Black List</option>
            <option value="link_red_list">Link Red List</option>
            <option value="link_green_list">Link Green List</option>
            <option value="link_blue_list">Link Blue List</option>
            <option value="link_orange_list">Link Orange List</option>
            <option value="map_black_list">Map Black List</option>
            <option value="map_red_list">Map Red List</option>
            <option value="map_green_list">Map Green List</option>
            <option value="map_blue_list">Map Blue List</option>
            <option value="map_orange_list">Map Orange List</option>
					</optgroup>
	        <optgroup label="Misc.">
						<option value="button">Button</option>
						<option value="contact_info">Contact Info</option>
						<option value="framed_tabs">Framed Tabs</option>
					</optgroup>
	        <optgroup label="Pullquotes">
						<option value="pullquote_left">Pullquote Left</option>
						<option value="pullquote_right">Pullquote Right</option>
					</optgroup>
	        <optgroup label="Toggles">
						<option value="toggle">Toggle</option>
						<option value="toggle_framed">Toggle Framed</option>
					</optgroup>
		  <optgroup label="Lightbox gallery">
			  <option value="image">Single image</option>
			  <option value="image_gallery">Image gallery</option>
			  <option value="video">Single video</option>
			  <option value="video_gallery">Video gallery</option>
		  </optgroup>
        </select></td>
      </tr>
    </table>
	</fieldset>

  <div class="mceActionPanel">
  	<div style="float:left">
  		<input type="button" id="cancel" name="cancel" value="Cancel" onClick="tinyMCEPopup.close();" />
  	</div>
  	<div style="float:right">
  		<input type="submit" id="insert" name="insert" value="Insert" onClick="insertTeamDutchShortcode();" />
  	</div>
	</div>
	
</body>
</html>
