<?php

include_once 'grace_options.php';

/* Update option field */
function updateThemeOptionField($field) {
  $current_data = get_option($field);
	$new_data = $_POST[$field];

  if($current_data !== false) {
    if(trim($new_data) == '') {
    	delete_option($field);
    } elseif($new_data != $current_data) {
    	update_option($field, $new_data);
    }
  }	elseif($new_data != '') {
  	add_option($field, $new_data);
  }
}

/* If form was submitted */
if(isset($_POST['td-action'])) {

	/* Update Grace Options */
	graceUpdateOptions(1);

  /* Unset old sidebars and encode new ones */
  if($_POST['_screen-sidebars']) {
    foreach($_POST['_screen-sidebars'] AS $k => $sidebar) {
      if(trim($sidebar) == '') {
        unset($_POST['_screen-sidebars'][$k]);
      } else {
        $_POST['_screen-sidebars'][$k] = urlsafe(strtolower($sidebar));
      }
    }
    $_POST['_screen-sidebars'] = serialize($_POST['_screen-sidebars']);
  }
  /* Unset old footer sidebars and encode new ones */
  if($_POST['_screen-footersidebars']) {
    foreach($_POST['_screen-footersidebars'] AS $k => $f) {
      if(trim($f) == '') {
        unset($_POST['_screen-footersidebars'][$k]);
      } else {
        $_POST['_screen-footersidebars'][$k] = urlsafe(strtolower($f));
      }
    }
    $_POST['_screen-footersidebars'] = serialize($_POST['_screen-footersidebars']);
  }
  /* Unset old footer menus and encode new ones */
  if($_POST['_screen-footermenus']) {
    foreach($_POST['_screen-footermenus'] AS $k => $f) {
      if(trim($f) == '') {
        unset($_POST['_screen-footermenus'][$k]);
      } else {
        $_POST['_screen-footermenus'][$k] = urlsafe($f);
      }
    }
    $_POST['_screen-footermenus'] = serialize($_POST['_screen-footermenus']);
  }
  /* Glue gallery categories together */
  if($_POST['_screen-galleryCategories']) {
    $_POST['_screen-galleryCategories'] = implode(';', $_POST['_screen-galleryCategories']);
  }
  
  /* Check link for http */
  if(isset($_POST['_screen-copyright-link'])) {
    $_POST['_screen-copyright-link'] = checkLinkForHttp($_POST['_screen-copyright-link']);
  }
  
  /* Update options */
  $optionFields = array('_screen-favicon', '_screen-cufonFont', '_screen-payoffColor', '_screen-home-payoff', '_screen-home-text', '_screen-home-bgType', '_screen-home-bgImg', '_screen-home-footermenu', '_screen-category-layout', '_screen-category-bgType', '_screen-category-bgImg', '_screen-category-footermenu', '_screen-logo-img', '_screen-logo-text', '_screen-copyright-name', '_screen-copyright-link', '_screen-sidebars', '_screen-footersidebars', '_screen-footermenus', '_screen-facebook', '_screen-flickr', '_screen-linkedin', '_screen-rss', '_screen-twitter', '_screen-youtube', '_screen-analytics', '_screen-galleryCategories', '_screen-galleryFade', '_screen-galleryDiaInterval', '_disp_blog_post', '_screen-headerColor', '_screen-footerColor', '_screen-contentColor', '_screen-blogframeColor', '_screen-h1Color', '_screen-h2Color', '_screen-h3Color', '_screen-h4Color', '_screen-h5Color', '_screen-h6Color', '_screen-payofftextColor', '_screen-paragraphColor', '_screen-linkColor', '_screen-linkhoverColor', '_screen-widgeth3Color', '_screen-widgetlinkhoverColor', '_screen-breadcrumbColor', '_screen-breadcrumbhoverColor', '_screen-blogh2Color', '_screen-blogh2hoverColor', '_screen-blogmetaColor', '_screen-blogmetahoverColor', '_screen-logotextColor', '_screen-logotexthoverColor', '_screen-widgetlinkColor', '_screen-widgetlinkhoverColor', '_screen-widgetsublinkColor', '_screen-menulinkColor', '_screen-menulinkhoverColor', '_screen-menusubtitlesColor', '_screen-submenulinkColor', '_screen-submenulinkhoverColor', '_screen-footermenuColor', '_screen-footermenuhoverColor', '_screen-copyrightColor', '_screen-copyrighthoverColor', '_screen-backgroundColor');
  foreach($optionFields AS $o) {
    updateThemeOptionField($o);
	}
  foreach($trnslt_vars AS $var) {
    updateThemeOptionField('_screen-trnslt-' . $var);
	}
}

/* DISPLAY THEME OPTIONS SEDUCTION */
function teamDutchPlaceThemeOptions() {
  global $trnslt_vars;
  ?>
  <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/tdpanel.css" type="text/css" media="screen" />
  <script type='text/javascript' src="<?php bloginfo('template_url'); ?>/lib/control.js"></script>

<div class="wrap">
  <div class="tdpanel">
    <div class="tdpanellarge"> </div>
  </div>
  <div style="float:left;">

    <div class="td-panel">
	 <ul class="wrapper_nav">
       	<li>
			<div class="passive" name="nav_0"></div>
			<div class="active" style="display:none;"></div>
			<a href="javascript:showTab('tab-general'); " class="general" >GENERAL</a>
			<div class="active_arrow"></div>
		</li>
		<li>
			<div class="passive" name="nav_0"></div>
			<div class="active" style="display:none;"></div>
			<a href="javascript:showTab('tab-color');" class="colors" >COLORS</a>
			<div class="active_arrow"></div>
		</li>
		<li>
			<div class="passive" name="nav_0"></div>
			<div class="active" style="display:none;"></div>
			<a href="javascript:showTab('tab-home');" class="home" >HOME</a>
			<div class="active_arrow"></div>
		</li>
		<li>
			<div class="passive" name="nav_0"></div>
			<div class="active" style="display:none;"></div>
			<a href="javascript:showTab('tab-category');" class="blog" >BLOG</a>
			<div class="active_arrow"></div>
		</li>
		<li>
			<div class="passive" name="nav_0"></div>
			<div class="active" style="display:none;"></div>
			<a href="javascript:showTab('tab-logo');" class="logo" >LOGO</a>
			<div class="active_arrow"></div>
		</li>
		<li>
			<div class="passive" name="nav_0"></div>
			<div class="active" style="display:none;"></div>
			<a href="javascript:showTab('tab-copyright');" class="copyright" >COPYRIGHT</a>
			<div class="active_arrow"></div>
		</li>
		<li>
			<div class="passive" name="nav_0"></div>
			<div class="active" style="display:none;"></div>
			<a href="javascript:showTab('tab-sidebars');" class="sidebars" >SIDEBARS</a>
			<div class="active_arrow"></div>
		</li>
		<li>
			<div class="passive" name="nav_0"></div>
			<div class="active" style="display:none;"></div>
			<a href="javascript:showTab('tab-footersidebars');" class="footer-bars" >FOOTER SIDEBARS</a>
			<div class="active_arrow"></div>
		</li>
		<li>
			<div class="passive" name="nav_0"></div>
			<div class="active" style="display:none;"></div>
			<a href="javascript:showTab('tab-footermenus');" class="footer-menu" >FOOTER MENUS</a>
			<div class="active_arrow"></div>
		</li>
		<li>
			<div class="passive" name="nav_0"></div>
			<div class="active" style="display:none;"></div>
			<a href="javascript:showTab('tab-sociables');" class="social-media" >SOCIAL MEDIA</a>
			<div class="active_arrow"></div>
		</li>
		<li>
			<div class="passive" name="nav_0"></div>
			<div class="active" style="display:none;"></div>
			<a href="javascript:showTab('tab-translations');" class="translaitions" >TRANSLATIONS</a>
			<div class="active_arrow"></div>
		</li>
		<li>
			<div class="passive" name="nav_0"></div>
			<div class="active" style="display:none;"></div>
			<a href="javascript:showTab('tab-gallery');" class="fsgallery" >FS GALLERY</a>
			<div class="active_arrow"></div>
		</li>
		<li>
			<div class="passive" name="nav_0"></div>
			<div class="active" style="display:none;"></div>
			<a href="javascript:showTab('tab-support');" class="support" >SUPPORT</a>
			<div class="active_arrow"></div>
		</li>
	</ul>
   </div>
    </div>
    <div class="content-admin" style="float:right;">
	  <form method="post" action="" id="screenform">
	<div class="td-panel">
    <div style="margin:-8px 0 0 0; display:none; color:#fff; padding:10px; width:595px;" id="tab-intro" class="tabs">
      <div>
        <p colspan="2"><h1>Theme Description</h1></p>
      </div>
      <div>
        <p><p>Seduction is an impressive Wordpress 3.0 theme designed to be suitable for every kind of business you want and gives you full control over all major design elements a designer can wish for. Seduction really has all the features you possibly can imagine to design a unique and personal website for any client or yourself. Whether you want to present a corporate business, a product, a photographer or even a musician, it's possible with this powerful and professional Seduction theme..</p>
       </p>
      </div>
    </div>
    <?php
  /* Get general options */
  $favicon = get_option('_screen-favicon');
  $cufonEnabled = get_option('_screen-cufonEnabled');
  $hide = ($cufonEnabled != 'true') ? ' style="display:none;"' : '';
  $cufonFont = get_option('_screen-cufonFont');
	$payofftextColor = get_option('_screen-payofftextColor');
  $analytics = get_option('_screen-analytics');
  ?>
    <div cellpadding="0" cellspacing="5" style="margin:-8px 0 0 0; display:none; color:#fff; padding:10px; width:600px;" id="tab-general" class="tabs">
      <div>
        <p colspan="2"><h1>General</h1></p>
      </div>
      <div>
        <p valign="top" width="150" style="padding:3px 0 0 0;">Favicon location:</p>
        <p><input type="text" id="screen-favicon" name="_screen-favicon" value="<?php echo $favicon; ?>" />
          <br />
          <span style="color:#999; font-size:10px;">Enter the full URL of your custom favicon image here (e.g. http://www.yoursite.com/favicon.ico)</span></p>
      </div>
      <div id="screen-font-tr">
        <p valign="top" style="padding:3px 0 0 0;">Special font:</p>
        <p><select id="screen-cufonFont" name="_screen-cufonFont">
            <option<?php
        if($cufonFont == "Anivers") { echo " selected"; }
        ?>>Anivers</option>
            <option<?php
		
		if($cufonFont == "Accid") { echo " selected"; }
        ?>>Accid</option>
            <option<?php
		
		if($cufonFont == "Andale-Mono") { echo " selected"; }
        ?>>Andale-Mono</option>
            <option<?php
		
		if($cufonFont == "Aurulent-Sans-Mono") { echo " selected"; }
        ?>>Aurulent-Sans-Mono</option>
            <option<?php
		
		if($cufonFont == "Boston-Traffic") { echo " selected"; }
        ?>>Boston-Traffic</option>
            <option<?php
		
		if($cufonFont == "Bodonitown") { echo " selected"; }
        ?>>Bodonitown</option>
            <option<?php
		
		if($cufonFont == "BodoniXT") { echo " selected"; }
        ?>>BodoniXT</option>
            <option<?php
		
		if($cufonFont == "BonvenoCF") { echo " selected"; }
        ?>>BonvenoCF</option>
            <option<?php
		
		if($cufonFont == "Chantelli-Antiqua") { echo " selected"; }
        ?>>Chantelli-Antiqua</option>
            <option<?php
		
		if($cufonFont == "Crimson") { echo " selected"; }
        ?>>Crimson</option>
            <option<?php
		
		if($cufonFont == "Calluna") { echo " selected"; }
        ?>>Calluna</option>
            <option<?php
		
		if($cufonFont == "Delicious") { echo " selected"; }
        ?>>Delicious</option>
            <option<?php
		
        if($cufonFont == "Diavlo") { echo " selected"; }
        ?>>Diavlo</option>
            <option<?php
		
		if($cufonFont == "FontleroyBrown") { echo " selected"; }
        ?>>FontleroyBrown</option>
            <option<?php
		
		if($cufonFont == "Furore") { echo " selected"; }
        ?>>Furore</option>
            <option<?php
		
        if($cufonFont == "Fetrigopro") { echo " selected"; }
        ?>>Fetrigopro</option>
            <option<?php
		
        if($cufonFont == "Fontin") { echo " selected"; }
        ?>>Fontin</option>
            <option<?php
		
        if($cufonFont == "FontinSans") { echo " selected"; }
        ?>>FontinSans</option>
            <option<?php
		
		if($cufonFont == "Firsttest") { echo " selected"; }
        ?>>Firsttest</option>
            <option<?php
		
		if($cufonFont == "Gothic-Ultra") { echo " selected"; }
        ?>>Gothic-Ultra</option>
            <option<?php
		
		if($cufonFont == "Garogier") { echo " selected"; }
        ?>>Garogier</option>
            <option<?php
		
		if($cufonFont == "Inconsolata") { echo " selected"; }
        ?>>Inconsolata</option>
            <option<?php
		
		if($cufonFont == "Kingthings-Exeter") { echo " selected"; }
        ?>>Kingthings-Exeter</option>
            <option<?php
		
		if($cufonFont == "Josefin") { echo " selected"; }
        ?>>Josefin</option>
            <option<?php
		
		if($cufonFont == "Libel") { echo " selected"; }
        ?>>Libel</option>
            <option<?php
		
		if($cufonFont == "Lilly") { echo " selected"; }
        ?>>Lilly</option>
            <option<?php
		
		if($cufonFont == "Major-Snafu") { echo " selected"; }
        ?>>Major-Snafu</option>
            <option<?php
		
		if($cufonFont == "Museo") { echo " selected"; }
        ?>>Museo</option>
            <option<?php
		
		if($cufonFont == "Matiz") { echo " selected"; }
        ?>>Matiz</option>
            <option<?php
		
		if($cufonFont == "Medio") { echo " selected"; }
        ?>>Medio</option>
            <option<?php
		
		if($cufonFont == "Qikki") { echo " selected"; }
        ?>>Qikki</option>
            <option<?php
		
		if($cufonFont == "SouciSans") { echo " selected"; }
        ?>>SouciSans</option>
            <option<?php
		
		if($cufonFont == "SaxMono") { echo " selected"; }
        ?>>SaxMono</option>
            <option<?php
		
		if($cufonFont == "Steelfish") { echo " selected"; }
        ?>>Steelfish</option>
            <option<?php
		
		if($cufonFont == "Trendy-University") { echo " selected"; }
        ?>>Trendy-University</option>
            <option<?php
		
		if($cufonFont == "Ubuntu") { echo " selected"; }
        ?>>Ubuntu</option>
            <option<?php
		
		if($cufonFont == "Underwood") { echo " selected"; }
        ?>>Underwood</option>
            <option<?php
		
        if($cufonFont == "Verily-Serift") { echo " selected"; }
        ?>>Verily-Serift</option>
          </select>
          <br />
          <span style="color:#999; font-size:10px;">Select a font to be used for headings.</span></p>
      </div>
      <div>
        <p valign="top" style="padding:3px 0 0 0;">Google Analytics:</p>
        <p><textarea class="td-panel"  id="screen-analytics" name="_screen-analytics" style="height:120px; width:505px;"><?php echo stripslashes_deep($analytics); ?></textarea>
          <br />
          <span style="color:#999; font-size:10px;">Past your Google Analytics code here.</span></p>
      </div>
      <div>
        <p valign="top" style="padding:3px 0 0 0;">Dummy content:</p>
        <p><select id="screen-dummycontent" name="_screen-dummycontent">
            <option value="false">Don't place dummy content</option>
            <option value="true">Place dummy content</option>
          </select>
          <br />
          <span style="color:#999; font-size:10px;">This option will help you understand how Seduction works.<br />
          Seduction will automatic put dummy content into your website.<br />
          Please use with a new Wordpress 3.0+ installation.</span></p>
      </div>
      <?php
      /* Import dummy content */
      if(isset($_POST['_screen-dummycontent']) && $_POST['_screen-dummycontent'] == 'true') {
      ?>
      <div>
        <p colspan="2"><?php
        require_once('importer/importer.php');
        ?></p>
      </div>
      <?php
      }
      ?>
      <div>
        <p colspan="2"><input type="submit" name="save" value="Save changes" style="cursor:pointer; margin:5px 0;" /></p>
      </div>
    </div>
    <?php 
		// Get Color options 
		$payoffColor = get_option('_screen-payoffColor');
		$headerColor = get_option('_screen-headerColor');
		$footerColor = get_option('_screen-footerColor');
		$contentColor = get_option('_screen-contentColor');
		$blogframeColor = get_option('_screen-blogframeColor');
		$h1Color = get_option('_screen-h1Color');
		$h2Color = get_option('_screen-h2Color');
		$h3Color = get_option('_screen-h3Color');
		$h4Color = get_option('_screen-h4Color');
		$h5Color = get_option('_screen-h5Color');
		$h6Color = get_option('_screen-h6Color');
		$paragraphColor = get_option('_screen-paragraphColor');
		$linkColor = get_option('_screen-linkColor');
		$linkhoverColor = get_option('_screen-linkhoverColor');
		$widgeth3Color = get_option('_screen-widgeth3Color');
		$widgetlinkhoverColor = get_option('_screen-widgetlinkhoverColor');
		$breadcrumbColor = get_option('_screen-breadcrumbColor');		
		$breadcrumbhoverColor = get_option('_screen-breadcrumbhoverColor');
		$blogh2Color = get_option('_screen-blogh2Color');		
		$blogh2hoverColor = get_option('_screen-blogh2hoverColor');		
		$blogmetaColor = get_option('_screen-blogmetaColor');		
		$blogmetahoverColor = get_option('_screen-blogmetahoverColor');
		$logotextColor = get_option('_screen-logotextColor');			
		$logotexthoverColor = get_option('_screen-logotexthoverColor');			
		$widgetlinkColor = get_option('_screen-widgetlinkColor');			
		$widgetlinkhoverColor = get_option('_screen-widgetlinkhoverColor');
		$widgetsublinkColor = get_option('_screen-widgetsublinkColor');		
		$menulinkColor = get_option('_screen-menulinkColor');		
		$menulinkhoverColor = get_option('_screen-menulinkhoverColor');		
		$menusubtitlesColor = get_option('_screen-menusubtitlesColor');
		$footermenuColor = get_option('_screen-footermenuColor');
		$footermenuhoverColor = get_option('_screen-footermenuhoverColor');
		$copyrightColor = get_option('_screen-copyrightColor');
		$copyrighthoverColor = get_option('_screen-copyrighthoverColor');	
		$backgroundColor = get_option('_screen-backgroundColor');
		$submenulinkColor = get_option('_screen-submenulinkColor');
		$submenulinkhoverColor = get_option('_screen-submenulinkhoverColor');
	?>
    <div cellpadding="0" cellspacing="5" style="margin:-8px 0 0 0; display:none; color:#fff; padding:10px; width:600px;" id="tab-color" class="tabs">
      <div>
        <p colspan="2"><h1>Colors</h1></p>
         <p valign="top" style="padding:3px 0 0 0;">The possibilities for the usage of color are immense. You can change all major elements in your website simply by choosing the color you like. Even if you want transparency you only have to leave the field Blanc.</p>
      </div>
      <div>
       
      </div>
      <div>
        <p valign="top" style="padding:3px 0 0 0;">Background color:</p>
        <p><input type="text" id="screen-backgroundColor" name="_screen-backgroundColor" value="<?php echo $backgroundColor; ?>" />
          <br />
          <span style="color:#999; font-size:10px;">Use the colorpicker to change the background color. Then on the page/post of your choise set the Background Type to Color</span></p>
      </div>
      <div>
        <p colspan="2"><h3 style="margin:15px 0 0 0; padding-bottom: 10px; border-bottom:#ddd solid 1px;">Header Colors</h3></p>
      </div>
      <div>
        <p valign="top" style="padding:3px 0 0 0;">Logo text color:</p>
        <p><input type="text" id="screen-logotextColor" name="_screen-logotextColor" value="<?php echo $logotextColor; ?>" />
          <br />
          <span style="color:#999; font-size:10px;">Use the colorpicker to change the logo text color.</span></p>
      </div>
      <div>
        <p valign="top" style="padding:3px 0 0 0;">Logo text hover color:</p>
        <p><input type="text" id="screen-logotexthoverColor" name="_screen-logotexthoverColor" value="<?php echo $logotexthoverColor; ?>" />
          <br />
          <span style="color:#999; font-size:10px;">Use the colorpicker to change the logo text hover color.</span></p>
      </div>
      <div>
        <p valign="top" style="padding:3px 0 0 0;">Theme header color:</p>
        <p><input type="text" id="screen-headerColor" name="_screen-headerColor" value="<?php echo $headerColor; ?>" />
          <br />
          <span style="color:#999; font-size:10px;">Use the colorpicker to choose a header color.</span></p>
      </div>
      <div>
        <p valign="top" style="padding:3px 0 0 0;">Menu links color:</p>
        <p><input type="text" id="screen-menulinkColor" name="_screen-menulinkColor" value="<?php echo $menulinkColor; ?>" />
          <br />
          <span style="color:#999; font-size:10px;">Use the colorpicker to change the menu links color.</span></p>
      </div>
      <div>
        <p valign="top" style="padding:3px 0 0 0;">Menu links hover color:</p>
        <p><input type="text" id="screen-menulinkhoverColor" name="_screen-menulinkhoverColor" value="<?php echo $menulinkhoverColor; ?>" />
          <br />
          <span style="color:#999; font-size:10px;">Use the colorpicker to change the menu links hover color.</span></p>
      </div>
      <div>
        <p valign="top" style="padding:3px 0 0 0;">Menu sub titles color:</p>
        <p><input type="text" id="screen-menusubtitlesColor" name="_screen-menusubtitlesColor" value="<?php echo $menusubtitlesColor; ?>" />
          <br />
          <span style="color:#999; font-size:10px;">Use the colorpicker to change the menu sub titles color.</span></p>
      </div>
      <div>
        <p valign="top" style="padding:3px 0 0 0;">Sub menu link color:</p>
        <p><input type="text" id="screen-submenulinkColor" name="_screen-submenulinkColor" value="<?php echo $submenulinkColor; ?>" />
          <br />
          <span style="color:#999; font-size:10px;">Use the colorpicker to change the sub menu links color.</span></p>
      </div>
      <div>
        <p valign="top" style="padding:3px 0 0 0;">Sub menu link hover color:</p>
        <p><input type="text" id="screen-submenulinkhoverColor" name="_screen-submenulinkhoverColor" value="<?php echo $submenulinkhoverColor; ?>" />
          <br />
          <span style="color:#999; font-size:10px;">Use the colorpicker to change the sub menu links hover color.</span></p>
      </div>
      <div>
        <p colspan="2"><h3 style="margin:15px 0 0 0; padding-bottom: 10px; border-bottom:#ddd solid 1px;">Slogan Colors</h3></p>
      </div>
      <div>
 
      </div>
      <div>
        <p valign="top" style="padding:3px 0 0 0;">Theme Slogan color:</p>
        <p><input type="text" id="screen-payoffColor" name="_screen-payoffColor" value="<?php echo $payoffColor; ?>" />
          <br />
          <span style="color:#999; font-size:10px;">Use the colorpicker to choose a slogan color.</span></p>
      </div>
      <div>
        <p valign="top" style="padding:3px 0 0 0;">Slogan Text color:</p>
        <p><input type="text" id="screen-payofftextColor" name="_screen-payofftextColor" value="<?php echo $payofftextColor; ?>" />
          <br />
          <span style="color:#999; font-size:10px;">Use the colorpicker to change the Slogan text color.</span></p>
      </div>
      <div>
        <p colspan="2"><h3 style="margin:15px 0 0 0; padding-bottom: 10px; border-bottom:#ddd solid 1px;">Content block Colors</h3></p>
      </div>
      <div>
   
        <p><input type="text" id="screen-contentColor" name="_screen-contentColor" value="<?php echo $contentColor; ?>" />
          <br />
          <span style="color:#999; font-size:10px;">Use the colorpicker to change the content block color.</span></p>
      </div>
      <div>
        <p valign="top" style="padding:3px 0 0 0;">Paragraph text color:</p>
        <p><input type="text" id="screen-paragraphColor" name="_screen-paragraphColor" value="<?php echo $paragraphColor; ?>" />
          <br />
          <span style="color:#999; font-size:10px;">Use the colorpicker to change the paragraph text color.</span></p>
      </div>
      <div>
        <p colspan="2"><h3 style="margin:15px 0 0 0; padding-bottom: 10px; border-bottom:#ddd solid 1px;">Heading Colors</h3></p>
      </div>
      <div>
        <p valign="top" style="padding:3px 0 0 0;">H1 color:</p>
        <p><input type="text" id="screen-h1Color" name="_screen-h1Color" value="<?php echo $h1Color; ?>" />
          <br />
          <span style="color:#999; font-size:10px;">Use the colorpicker to change the H1 color.</span></p>
      </div>
      <div>
        <p valign="top" style="padding:3px 0 0 0;">H2 color:</p>
        <p><input type="text" id="screen-h2Color" name="_screen-h2Color" value="<?php echo $h2Color; ?>" />
          <br />
          <span style="color:#999; font-size:10px;">Use the colorpicker to change the H2 color.</span></p>
      </div>
      <div>
        <p valign="top" style="padding:3px 0 0 0;">H3 color:</p>
        <p><input type="text" id="screen-h3Color" name="_screen-h3Color" value="<?php echo $h3Color; ?>" />
          <br />
          <span style="color:#999; font-size:10px;">Use the colorpicker to change the H3 color.</span></p>
      </div>
      <div>
        <p valign="top" style="padding:3px 0 0 0;">H4 color:</p>
        <p><input type="text" id="screen-h4Color" name="_screen-h4Color" value="<?php echo $h4Color; ?>" />
          <br />
          <span style="color:#999; font-size:10px;">Use the colorpicker to change the H4 color.</span></p>
      </div>
      <div>
        <p valign="top" style="padding:3px 0 0 0;">H5 color:</p>
        <p><input type="text" id="screen-h5Color" name="_screen-h5Color" value="<?php echo $h5Color; ?>" />
          <br />
          <span style="color:#999; font-size:10px;">Use the colorpicker to change the H5 color.</span></p>
      </div>
      <div>
        <p valign="top" style="padding:3px 0 0 0;">H6 color:</p>
        <p><input type="text" id="screen-h6Color" name="_screen-h6Color" value="<?php echo $h6Color; ?>" />
          <br />
          <span style="color:#999; font-size:10px;">Use the colorpicker to change the H6 color.</span></p>
      </div>
      <div>
        <p colspan="2"><h3 style="margin:15px 0 0 0; padding-bottom: 10px; border-bottom:#ddd solid 1px;">Heading Link Colors</h3></p>
      </div>
      <div>
        <p valign="top" style="padding:3px 0 0 0;">Link color:</p>
        <p><input type="text" id="screen-linkColor" name="_screen-linkColor" value="<?php echo $linkColor; ?>" />
          <br />
          <span style="color:#999; font-size:10px;">Use the colorpicker to change the link color.</span></p>
      </div>
      <div>
        <p valign="top" style="padding:3px 0 0 0;">Link hover color:</p>
        <p><input type="text" id="screen-linkhoverColor" name="_screen-linkhoverColor" value="<?php echo $linkhoverColor; ?>" />
          <br />
          <span style="color:#999; font-size:10px;">Use the colorpicker to change the link hover color.</span></p>
      </div>
      <div>
        <p colspan="2"><h3 style="margin:15px 0 0 0; padding-bottom: 10px; border-bottom:#ddd solid 1px;">Breadcrumb</h3></p>
      </div>
      <div>
        <p valign="top" style="padding:3px 0 0 0;">Breadcrumb color:</p>
        <p><input type="text" id="screen-breadcrumbColor" name="_screen-breadcrumbColor" value="<?php echo $breadcrumbColor; ?>" />
          <br />
          <span style="color:#999; font-size:10px;">Use the colorpicker to change the breadcrumb color.</span></p>
      </div>
      <div>
        <p valign="top" style="padding:3px 0 0 0;">Breadcrumb hover color:</p>
        <p><input type="text" id="screen-breadcrumbhoverColor" name="_screen-breadcrumbhoverColor" value="<?php echo $breadcrumbhoverColor; ?>" />
          <br />
          <span style="color:#999; font-size:10px;">Use the colorpicker to change the breadcrumb hover color.</span></p>
      </div>
      <div>
        <p colspan="2"><h3 style="margin:15px 0 0 0; padding-bottom: 10px; border-bottom:#ddd solid 1px;">Blog Colors</h3></p>
      </div>
      <div>
        <p valign="top" style="padding:3px 0 0 0;">Blog frame color:</p>
        <p><input type="text" id="screen-blogframeColor" name="_screen-blogframeColor" value="<?php echo $blogframeColor; ?>" />
          <br />
          <span style="color:#999; font-size:10px;">Use the colorpicker to change the blog frame color.</span></p>
      </div>
      <div>
        <p valign="top" style="padding:3px 0 0 0;">Blog title color:</p>
        <p><input type="text" id="screen-blogh2Color" name="_screen-blogh2Color" value="<?php echo $blogh2Color; ?>" />
          <br />
          <span style="color:#999; font-size:10px;">Use the colorpicker to change the blog title color.</span></p>
      </div>
      <div>
        <p valign="top" style="padding:3px 0 0 0;">Blog title hover color:</p>
        <p><input type="text" id="screen-blogh2hoverColor" name="_screen-blogh2hoverColor" value="<?php echo $blogh2hoverColor; ?>" />
          <br />
          <span style="color:#999; font-size:10px;">Use the colorpicker to change the blog title hover color.</span></p>
      </div>
      <div>
        <p valign="top" style="padding:3px 0 0 0;">Blog meta color:</p>
        <p><input type="text" id="screen-blogmetaColor" name="_screen-blogmetaColor" value="<?php echo $blogmetaColor; ?>" />
          <br />
          <span style="color:#999; font-size:10px;">Use the colorpicker to change the blog meta color.</span></p>
      </div>
      <div>
        <p valign="top" style="padding:3px 0 0 0;">Blog meta hover color:</p>
        <p><input type="text" id="screen-blogmetahoverColor" name="_screen-blogmetahoverColor" value="<?php echo $blogmetahoverColor; ?>" />
          <br />
          <span style="color:#999; font-size:10px;">Use the colorpicker to change the blog meta hover color.</span></p>
      </div>
      <div>
        <p colspan="2"><h3 style="margin:15px 0 0 0; padding-bottom: 10px; border-bottom:#ddd solid 1px;">Widget Colors</h3></p>
      </div>
      <div>
        <p valign="top" style="padding:3px 0 0 0;">Widget title color:</p>
        <p><input type="text" id="screen-widgeth3Color" name="_screen-widgeth3Color" value="<?php echo $widgeth3Color; ?>" />
          <br />
          <span style="color:#999; font-size:10px;">Use the colorpicker to change the widget title color.</span></p>
      </div>
      <div>
        <p valign="top" style="padding:3px 0 0 0;">Widget link hover color:</p>
        <p><input type="text" id="screen-widgetlinkhoverColor" name="_screen-widgetlinkhoverColor" value="<?php echo $widgetlinkhoverColor; ?>" />
          <br />
          <span style="color:#999; font-size:10px;">Use the colorpicker to change the widget link hover color.</span></p>
      </div>
      <div>
        <p valign="top" style="padding:3px 0 0 0;">Widget links color:</p>
        <p><input type="text" id="screen-widgetlinkColor" name="_screen-widgetlinkColor" value="<?php echo $widgetlinkColor; ?>" />
          <br />
          <span style="color:#999; font-size:10px;">Use the colorpicker to change the widget links color.</span></p>
      </div>
      <div>
        <p valign="top" style="padding:3px 0 0 0;">Widget links hover color:</p>
        <p><input type="text" id="screen-widgetlinkhoverColor" name="_screen-widgetlinkhoverColor" value="<?php echo $widgetlinkhoverColor; ?>" />
          <br />
          <span style="color:#999; font-size:10px;">Use the colorpicker to change the widget links hover color.</span></p>
      </div>
      <div>
        <p valign="top" style="padding:3px 0 0 0;">Widget sub links color:</p>
        <p><input type="text" id="screen-widgetsublinkColor" name="_screen-widgetsublinkColor" value="<?php echo $widgetsublinkColor; ?>" />
          <br />
          <span style="color:#999; font-size:10px;">Use the colorpicker to change the widget links hover color.</span></p>
      </div>
      <div>
        <p colspan="2"><h3 style="margin:15px 0 0 0; padding-bottom: 10px; border-bottom:#ddd solid 1px;">Footer Colors</h3></p>
      </div>
      <div>
        <p valign="top" style="padding:3px 0 0 0;">Theme footer color:</p>
        <p><input type="text" id="screen-footerColor" name="_screen-footerColor" value="<?php echo $footerColor; ?>" />
          <br />
          <span style="color:#999; font-size:10px;">Use the colorpicker to choose a footer color.</span></p>
      </div>
      <div>
        <p valign="top" style="padding:3px 0 0 0;">Footer menu links color:</p>
        <p><input type="text" id="screen-footermenuColor" name="_screen-footermenuColor" value="<?php echo $footermenuColor; ?>" />
          <br />
          <span style="color:#999; font-size:10px;">Use the colorpicker to change the footer menu links color.</span></p>
      </div>
      <div>
        <p valign="top" style="padding:3px 0 0 0;">Footer menu links hover color:</p>
        <p><input type="text" id="screen-footermenuhoverColor" name="_screen-footermenuhoverColor" value="<?php echo $footermenuhoverColor; ?>" />
          <br />
          <span style="color:#999; font-size:10px;">Use the colorpicker to change the footer menu links hover color.</span></p>
      </div>
      <div>
        <p valign="top" style="padding:3px 0 0 0;">Footer copyright link color:</p>
        <p><input type="text" id="screen-copyrightColor" name="_screen-copyrightColor" value="<?php echo $copyrightColor; ?>" />
          <br />
          <span style="color:#999; font-size:10px;">Use the colorpicker to change the footer copyright link color.</span></p>
      </div>
      <div>
        <p valign="top" style="padding:3px 0 0 0;">Footer copyright link hover color:</p>
        <p><input type="text" id="screen-copyrighthoverColor" name="_screen-copyrighthoverColor" value="<?php echo $copyrighthoverColor; ?>" />
          <br />
          <span style="color:#999; font-size:10px;">Use the colorpicker to change the footer copyright link hover color.</span></p>
      </div>
      <div>
        <p colspan="2"><input type="submit" name="save" value="Save changes" style="cursor:pointer; margin:5px 0;" /></p>
      </div>
    </div>
    <?php
    /* Get home options */
    $homePayoff = get_option('_screen-home-payoff');
    $homeText = get_option('_screen-home-text');
    $homeBgType = get_option('_screen-home-bgType');
    $homeBgImg = get_option('_screen-home-bgImg');
    $hide = ($homeBgType != 'image') ? ' style="display:none;"' : '';
    $homeFootermenu = get_option('_screen-home-footermenu');
    ?>
    <div id="tab-home" style="display:none; width:620px;" class="tabs">
      <div cellpadding="0" cellspacing="5" style="margin:-8px 0 0 0; color:#fff; padding:10px;">
        <div>
          <p colspan="2"><h1>Home</h1></p>
        </div>
        <div>
          <p colspan="2" style="padding:0 0 0 0;">Seduction provides two ways to make a home page. You can choose the regular way to create a page or choose this option here at the Seduction Admin panel. This page gives you many options to design your home page. You can ad your home slogan here, design your home content as well as you background, footer menu, blogposts etc.<br />
        </div>
        <div>
          <p valign="top" style="padding:3px 0 0 0;">Home slogan:</p>
          <p><input type="text" id="screen-home-payoff" name="_screen-home-payoff" value="<?php echo $homePayoff; ?>" />
            <br />
            <span style="color:#999; font-size:10px;">Here you can enter the slogan that will be displayed directly above the content.</span></p>
        </div>
        <div>
          <p valign="top" style="padding:30px 0 0 0;">Home content:</p>
          <p><div id="poststuff">
              <div id="<?php
        echo user_can_richedit() ? 'postdivrich' : 'postdiv';
        ?>" class="postarea" style="margin:0 0 5px 0;">
                <?php
				the_editor(stripslashes_deep($homeText), '_screen-home-text', '_screen-home-title', true, 3);
				?>
              </div>
            </div>
            <span style="color:#999; font-size:10px;">The Visual / HTML editor gives you total control of your homepage. You can even spice it up with the use of short codes!<br />
            Tip: Try setting a background image and leaving the content empty for a clean and beautiful homepage!</span></p>
        </div>
        <div>
          <p valign="top" style="padding:3px 0 0 0;">Background type:</p>
          <p><select id="screen-home-bgType" name="_screen-home-bgType" onChange="showBgImgField();">
              <option<?php
        if($homeBgType == "dark") { echo " selected"; }
        ?>>dark</option>
              <option<?php
        if($homeBgType == "medium") { echo " selected"; }
        ?>>medium</option>
              <option<?php
        if($homeBgType == "light") { echo " selected"; }
        ?>>light</option>
        		<option<?php
        if($homeBgType == "color") { echo " selected"; }
        ?>>color</option>
              <option<?php
        if($homeBgType == "image") { echo " selected"; }
        ?>>image</option>
              <option<?php
        if($homeBgType == "video") { echo " selected"; }
        ?>>video</option>
            </select>
            <br />
            <span style="color:#999; font-size:10px;">Select a background type to use on the homepage.</span></p>
        </div>
        <div id="screen-home-bgImg-tr"<?php echo $hide; ?>>
          <p valign="top" style="padding:3px 0 0 0;" id="bgImgTitle">Background image:</p>
          <p><input type="text" id="screen-home-bgImg" name="_screen-home-bgImg" value="<?php echo $homeBgImg; ?>" />
            <br />
            <span style="color:#999; font-size:10px;" id="bgImgDesc">Enter the full URL to your background image here (e.g. http://www.yoursite.com/images/background.jpg). For the best result use images with a resolution of 1280 x 1024 pixels.</span></p>
        </div>
        <div>
          <p valign="top" style="padding:3px 0 0 0;">Choose footer menu:</p>
          <p><select id="screen-home-footermenu" name="_screen-home-footermenu">
              <option value="false"<?php
        if($homeFootermenu == "false") { echo " selected"; }
       ?>>none</option>
              <?php
        $footermenus = get_option('_screen-footermenus');
        if(is_string($footermenus)) {
          $footermenus = unserialize($footermenus);
        } else {
          $footermenus = array();
        }
        if($footermenus) {
          foreach($footermenus AS $f) {
            echo '<option';
                if($homeFootermenu == $f) { echo " selected"; }
            echo '>' . $f . '</option>';
          }
        }
        ?>
            </select>
            <br />
            <span style="color:#999; font-size:10px;">Please select a footer menu. See the Footer menu section of the Help for more information.</span></p>
        </div>
        <div>
          <p>Display blog posts:</p>
          <p><!--input type="checkbox" name="dispBlogPost" id="dispBlogPost" value="1" onchange="checkDispBlogPost()"/-->
            
            <?php wp_dropdown_categories(array('name'=>'_disp_blog_post', 'show_option_none'=>'none', 'selected' => get_option( '_disp_blog_post' ))) ?>
            <script type="text/javascript">
				  function checkDispBlogPost() {
					  var obj = document.getElementById('dispBlogPost');
					  if(obj.checked){
						  $('#dispBlogPostSel').show();
					  } else {
						  $('#dispBlogPostSel').hide();
					  }
				  }
				  //checkDispBlogPost();
			  </script></p>
        </div>
      </div>
      <div style="margin:0; width:575px; color:#fff; padding:10px;">
        <?php
				$GLOBALS['post']->ID = 1;
				placeGraceOptions();
			?>
      </div>
      <div style="margin:0; margin-left:180px; padding:10px;">
        <input type="submit" name="save" value="Save changes" style="cursor:pointer; margin:5px 0;" />
      </div>
    </div>
    <?php
  /* Get category options */
  $categoryLayout = get_option('_screen-category-layout');
  $categoryBgType = get_option('_screen-category-bgType');
  $categoryBgImg = get_option('_screen-category-bgImg');
  $hide = ($categoryBgType != 'image') ? ' style="display:none;"' : '';
  $categoryFootermenu = get_option('_screen-category-footermenu');
  ?>
    <div cellpadding="0" cellspacing="5" style="margin:-8px 0 0 0; display:none; color:#fff; padding:10px; width:595px;" id="tab-category" class="tabs">
      <div>
        <p colspan="2"><h1>Blog</h1></p>
      </div>
      <div>
        <p valign="top" width="150" style="padding:3px 0 0 0;">Page layout:</p>
        <p><select id="screen-category-layout" name="_screen-category-layout">
            <option value="1"<?php
        if($categoryLayout == 1) { echo " selected"; }
        ?>>1 column</option>
            <option value="2"<?php
        if($categoryLayout == 2) { echo " selected"; }
        ?>>2 columns</option>
            <option value="3"<?php
        if($categoryLayout == 3) { echo " selected"; }
        ?>>3 columns</option>
          </select>
          <br />
          <span style="color:#999; font-size:10px;">Select the amount of columns for the blog page.</span></p>
      </div>
      <div>
        <p valign="top" style="padding:3px 0 0 0;">Posts per page:</p>
        <p><span style="color:#999; font-size:10px;">You can edit this setting on the <a href="options-reading.php">Settings > Reading</a> page under <em>Blog pages show at most</em>.</span></p>
      </div>
      <div>
        <p valign="top" style="padding:3px 0 0 0;">Background type:</p>
        <p><select id="screen-category-bgType" name="_screen-category-bgType" onChange="showCategoryBgImgField();">
            <option<?php
        if($categoryBgType == "dark") { echo " selected"; }
        ?>>dark</option>
            <option<?php
        if($categoryBgType == "medium") { echo " selected"; }
        ?>>medium</option>
            <option<?php
        if($categoryBgType == "light") { echo " selected"; }
        ?>>light</option>
            <option<?php
        if($categoryBgType == "image") { echo " selected"; }
        ?>>image</option>
        <option<?php
        if($categoryBgType == "color") { echo " selected"; }
        ?>>color</option>
          </select>
          <br />
          <span style="color:#999; font-size:10px;">Select a background type to use on the blog page.</span></p>
      </div>
      <div id="screen-category-bgImg-tr"<?php echo $hide; ?>>
        <p valign="top" style="padding:3px 0 0 0;">Background image:</p>
        <p><input type="text" id="screen-category-bgImg" name="_screen-category-bgImg" value="<?php echo $categoryBgImg; ?>" />
          <br />
          <span style="color:#999; font-size:10px;">Enter the full URL to your background image here (e.g. http://www.yoursite.com/images/background.jpg). For the best result use images with a resolution of 1280 x 1024 pixels.</span></p>
      </div>
      <div>
        <p valign="top" style="padding:3px 0 0 0;">Choose footer menu:</p>
        <p><select id="screen-category-footermenu" name="_screen-category-footermenu">
            <option value="false"<?php
        if($homeFootermenu == "false") { echo " selected"; }
        ?>>none</option>
            <?php
        $footermenus = get_option('_screen-footermenus');
        if(is_string($footermenus)) {
          $footermenus = unserialize($footermenus);
        } else {
          $footermenus = array();
        }
        if($footermenus) {
          foreach($footermenus AS $f) {
            echo '<option';
                if($categoryFootermenu == $f) { echo " selected"; }
            echo '>' . $f . '</option>';
          }
        }
        ?>
          </select>
          <br />
          <span style="color:#999; font-size:10px;">Please select a footer menu. See the Footer menu section of the Help for more information.</span></p>
      </div>
      <div>
        <p colspan="2"><input type="submit" name="save" value="Save changes" style="cursor:pointer; margin:5px 0;" /></p>
      </div>
    </div>
    <?php
  /* Get logo options */
  $logoImg = get_option('_screen-logo-img');
  $logoText = get_option('_screen-logo-text');
  ?>
    <div cellpadding="0" cellspacing="5" style="margin:-8px 0 0 0; display:none; color:#fff; padding:10px; width:595px;" id="tab-logo" class="tabs">
      <div>
        <p colspan="2"><h1>Logo</h1></p>
      </div>
      <div>
        <p valign="top" width="150" style="padding:3px 0 0 0;">Image:</p>
        <p><input type="text" name="_screen-logo-img" value="<?php echo $logoImg; ?>" style="width:350px;" />
          <br />
          <span style="color:#999; font-size:10px;">Enter the full URL of your logo image (e.g. http://www.yoursite.com/images/logo.png)<br />
          Logo Dimension advice: 150 x 70px. Seduction will automatically align your logo vertically.<br />
          If your logo is larger, you might need to modify style.css to align it perfectly.</span></p>
      </div>
      <div>
        <p valign="top" style="padding:3px 0 0 0;">Text:</p>
        <p><input type="text" name="_screen-logo-text" value="<?php echo $logoText; ?>" style="width:350px;" />
          <br />
          <span style="color:#999; font-size:10px;">If the logo image is given, this text will be used as the alt text.<br />
          If no image is given this text is shown in the header.<br />
          If you leave both image and text fields empty, your Wordpress blog name will be shown in the header.</span></p>
      </div>
      <div>
        <p colspan="2"><input type="submit" name="save" value="Save changes" style="cursor:pointer; margin:5px 0;" /></p>
      </div>
    </div>
    <?php
  /* Get copyright options */
  $copyrightName = get_option('_screen-copyright-name');
  $copyrightLink = get_option('_screen-copyright-link');
  ?>
    <div cellpadding="0" cellspacing="5" style="margin:-8px 0 0 0; display:none; color:#fff; padding:10px; width:595px;" id="tab-copyright" class="tabs">
      <div>
        <p colspan="2"><h1>Copyright information</h1></p>
      </div>
      <div>
        <p valign="top" width="150" style="padding:3px 0 0 0;">Name:</p>
        <p><input type="text" name="_screen-copyright-name" value="<?php echo $copyrightName; ?>" style="width:350px;" />
          <br />
          <span style="color:#999; font-size:10px;">Enter your copyright information here.</span></p>
      </div>
      <div>
        <p valign="top" style="padding:3px 0 0 0;">Link:</p>
        <p><input type="text" name="_screen-copyright-link" value="<?php echo $copyrightLink; ?>" style="width:350px;" />
          <br />
          <span style="color:#999; font-size:10px;">Enter your link here (e.g. http://www.yoursite.com).</span></p>
      </div>
      <div>
        <p colspan="2"><input type="submit" name="save" value="Save changes" style="cursor:pointer; margin:5px 0;" /></p>
      </div>
    </div>
    <?php
  /* Get sidebars */
  $sidebars = get_option('_screen-sidebars');
  if(is_array($sidebars)) {
    
  } elseif(is_string($sidebars)) {
    $sidebars = unserialize($sidebars);
  } else {
    $sidebars = array();
  }
  ?>
    <div cellpadding="0" cellspacing="5" style="margin:-8px 0 0 0; display:none; color:#fff; padding:10px; width:600px;" id="tab-sidebars" class="tabs">
      <div>
        <p colspan="2"><h1>Sidebars</h1></p>
      </div>
      <div>
        <p valign="top" width="150" style="padding:8px 0 0 0;">Create new:</p>
        <p>
			<input type="text" name="_screen-sidebars[]" style="width:307px;" />
			<input type="button" value="Add" onclick="jQuery('#screenform').trigger('submit')"/>
			<br />
          <span style="color:#999; font-size:10px;">Here you can create custom sidebars which can be filled at the Widgets page. You can select the sidebar in the editor of the Page or Post where you want to show it.</span></p>
      </div>
      <div>
        <p valign="top">Available:</p>
        <p><?php
        if($sidebars) {
          foreach($sidebars AS $sb) {
            ?>
          <div id="screen-sidebar-<?php echo $sb; ?>" style="display:block; padding:5px; margin:0 0 5px 0; background:#444444;"><?php echo $sb; ?> <a href="javascript:removeSidebar('<?php echo $sb; ?>');" style="float:right;">remove</a>
            <input type="hidden" name="_screen-sidebars[]" value="<?php echo $sb; ?>" />
          </div>
          <?php
          }
        }
        ?></p>
      </div>
      <div>
        <p colspan="2"><input type="submit" name="save" value="Save changes" style="cursor:pointer; margin:5px 0;" /></p>
      </div>
    </div>
    <?php
  /* Get footer sidebars */
  $footersidebars = get_option('_screen-footersidebars');
  if(is_array($footersidebars)) {
    
  } elseif(is_string($footersidebars)) {
    $footersidebars = unserialize($footersidebars);
  } else {
    $footersidebars = array();
  }
  ?>
    <div cellpadding="0" cellspacing="5" style="margin:-8px 0 0 0; display:none; color:#fff; padding:10px; width:595px;" id="tab-footersidebars" class="tabs">
      <div>
        <p colspan="2"><h1>Footer Sidebars</h1></p>
      </div>
      <div>
        <p valign="top" width="150" style="padding:8px 0 0 0;">Create new:</p>
        <p>
			<input type="text" name="_screen-footersidebars[]" style="width:307px;" />
			<input type="button" value="Add" onclick="jQuery('#screenform').trigger('submit')"/>
          <br />
          <span style="color:#999; font-size:10px;">Here you can create custom footer widget areas which can be filled at the Widgets page. You can select the footer widget area in the editor of the Page or Post where you want to show it.</span></p>
      </div>
      <div>
        <p valign="top">Available:</p>
        <p><?php
        if($footersidebars) {
          foreach($footersidebars AS $f) {
            ?>
          <div id="screen-footersidebar-<?php echo $f; ?>" style="display:block; padding:5px; margin:0 0 5px 0; background:#444444;"><?php echo $f; ?> <a href="javascript:removeFooterSidebar('<?php echo $f; ?>');" style="float:right;">remove</a>
            <input type="hidden" name="_screen-footersidebars[]" value="<?php echo $f; ?>" />
          </div>
          <?php
          }
        }
        ?></p>
      </div>
      <div>
        <p colspan="2"><input type="submit" name="save" value="Save changes" style="cursor:pointer; margin:5px 0;" /></p>
      </div>
    </div>
    <?php
  /* Get footer menus */
  $footermenus = get_option('_screen-footermenus');
  if(is_array($footermenus)) {
    
  } elseif(is_string($footermenus)) {
    $footermenus = unserialize($footermenus);
  } else {
    $footermenus = array();
  }
  ?>
    <div cellpadding="0" cellspacing="5" style="margin:-8px 0 0 0; display:none; color:#fff; padding:10px; width:595px;" id="tab-footermenus" class="tabs">
      <div>
        <p colspan="2"><h1>Footer Menus</h1></p>
      </div>
      <div>
        <p valign="top" width="150" style="padding:8px 0 0 0;">Create new:</p>
        <p>
			<input type="text" name="_screen-footermenus[]" style="width:307px;" />
			<input type="button" value="Add" onclick="jQuery('#screenform').trigger('submit')"/>
			<br />
          <span style="color:#999; font-size:10px;">Here you can create footer menus which can be filled with a Wordpress 3.0 menu at the Menus page. You can select the footer menu in the editor of the Page or Post where you want to show it.<br />
          This feature, like many features in the Seduction theme, was added with SEO in mind.</span></p>
      </div>
      <div>
        <p valign="top">Available:</p>
        <p><?php
        if($footermenus) {
          foreach($footermenus AS $f) {
            ?>
          <div id="screen-footermenu-<?php echo $f; ?>" style="display:block; padding:5px; margin:0 0 5px 0; background:#444444;"><?php echo $f; ?> <a href="javascript:removeFootermenu('<?php echo $f; ?>');" style="float:right;">remove</a>
            <input type="hidden" name="_screen-footermenus[]" value="<?php echo $f; ?>" />
          </div>
          <?php
          }
        }
        ?></p>
      </div>
      <div>
        <p colspan="2"><input type="submit" name="save" value="Save changes" style="cursor:pointer; margin:5px 0;" /></p>
      </div>
    </div>
    <?php
  /* Get sociables options */
  $facebook = get_option('_screen-facebook');
  $flickr = get_option('_screen-flickr');
  $linkedin = get_option('_screen-linkedin');
  $rss = get_option('_screen-rss');
  $twitter = get_option('_screen-twitter');
  $youtube = get_option('_screen-youtube');
  ?>
    <div cellpadding="0" cellspacing="5" style="margin:-8px 0 0 0; display:none; color:#fff; padding:10px; width:595px;" id="tab-sociables" class="tabs">
      <div>
        <p colspan="2"><h1>Sociables</h1>
          <br />
          <span style="color:#999; font-size:10px;">This feature enables you to link to your favourite social media websites.<br />
          If a field is left empty, the corresponding icon will not be displayed at the top of your website</span></p>
      </div>
      <div>
        <div>Facebook:</div>
        <div style="color:#bbb;height:42px;">
			<div style="float:left;width:150px;">
				www.facebook.com/
			</div>
			<input type="text" id="screen-facebook" name="_screen-facebook" value="<?php echo $facebook; ?>"/>
		</div>
      </div>
      <div>
        <div>Flickr:</div>
        <div style="color:#bbb;height:42px;">
			<div style="float:left;width:150px;">
				www.flickr.com/
			</div>
          <input type="text" id="screen-flickr" name="_screen-flickr" value="<?php echo $flickr; ?>" />
		</div>
      </div>
      <div>
        <div>LinkedIn:</div>
        <div style="color:#bbb;height:42px;">
			<div style="float:left;width:150px;">
				www.linkedin.com/in/
			</div>
          <input type="text" id="screen-linkedin" name="_screen-linkedin" value="<?php echo $linkedin; ?>" />
		</div>
      </div>
      <div>
		<div>&nbsp;</div>
        <div style="height:42px;">
			<div style="float:left;width:150px;">
				RSS:
			</div>
			<input type="text" id="screen-rss" name="_screen-rss" value="<?php echo $rss; ?>" />
		</div>
      </div>
      <div>
        <div>Twitter:</div>
        <div style="color:#bbb;height:42px;">
			<div style="float:left;width:150px;">
				www.twitter.com/
			</div>
          <input type="text" id="screen-twitter" name="_screen-twitter" value="<?php echo $twitter; ?>" />
		</div>
      </div>
      <div>
        <div>YouTube:</div>
        <div style="color:#bbb;height:42px;">
			<div style="float:left;width:150px;">
				www.youtube.com/
			</div>
			<input type="text" id="screen-youtube" name="_screen-youtube" value="<?php echo $youtube; ?>" />
		</div>
      </div>
      <div>
        <div colspan="2"><input type="submit" name="save" value="Save changes" style="cursor:pointer; margin:5px 0;" /></div>
      </div>
    </div>
    <?php
  /* Display translations */
  ?>
    <div cellpadding="0" cellspacing="5" style="margin:-8px 0 0 0; display:none; color:#fff; padding:10px; width:600px;" id="tab-translations" class="tabs">
      <div>
        <p colspan="3"><h1>Translations</h1></p>
      </div>
      <div>
        <p colspan="3" style="padding:0 0 20px 0;">With this feature you can change the terms used throughout your website. Just translate the words of your choice to your language and save!</p>
      </div>
      <div>
        <?php
      $i = 0;
      foreach($trnslt_vars AS $key => $var) {
        $trnsltn = get_option('_screen-trnslt-' . $var);
        if($trnsltn === false || trim($trnsltn) == '') {
          $trnsltn = $key;
        }
        if(strlen($key) < 50) {
      ?>
        <p valign="top" width="355"><?php echo $key; ?><br />
          <input type="text" id="screen-trnslt-<?php echo $var; ?>" name="_screen-trnslt-<?php echo $var; ?>" value="<?php echo $trnsltn; ?>" style="width:200px;" /></p>
        <?php
        } else {
        ?>
        <p width="355"><?php echo $key; ?><br />
          <textarea class="td-panel"  id="screen-trnslt-<?php echo $var; ?>" name="_screen-trnslt-<?php echo $var; ?>" style="height:120px; width:200px;"><?php echo $trnsltn; ?></textarea></p>
        <?php
        }
        if($i % 2) {
          ?>
      </div>
      <div>
        <?php
        } else {
          ?>
        <p width="20"></p>
        <?php
        }
        $i++;
      }
      if($i % 2) {
        ?>
        <p></p>
      </div>
      <div>
        <?php
      }
      ?>
      </div>
      <div>
        <p colspan="3"><input type="submit" name="save" value="Save changes" style="cursor:pointer; margin:5px 0;" /></p>
      </div>
    </div>
    <?php
  /* Display gallery options */
  $galleryCategories = get_option('_screen-galleryCategories');
  $galleryCategories = explode(';', $galleryCategories);
  ?>
    <div cellpadding="0" cellspacing="5" style="margin:-8px 0 0 0; display:none; color:#fff; padding:10px; width:595px;" id="tab-gallery" class="tabs">
      <div>
        <p><h1>Gallery</h1></p>
      </div>
      <div>
        Choose categories to be used as gallery or portfolio:
          <?php
        $categories = get_categories('hide_empty=0');
		$themeDir = get_bloginfo('template_url');
        foreach($categories AS $c) { 
			$switch_name = '';
			$is_checked = 'false';
			$switch_pos = 'left: -53px;';
			if(in_array($c->cat_ID, $galleryCategories)) {
				$switch_name = '_screen-galleryCategories[]';
				$is_checked = 'true';
				$switch_pos = 'left: 0px;';
			}
		?>
					<div class="switch">
						<div class="switch_title"><?php echo $c->name; ?></div>
						<div class="btn_switch">
								<input type="hidden" name="<?php echo $switch_name; ?>" title="_screen-galleryCategories[]" value="<?php echo $c->cat_ID; ?>"  class="switch_check_input" />
								<input type="hidden" value="<?php echo $is_checked; ?>" class="btn_switch_input">
								<div style="<?php echo $switch_pos; ?>" class="on_off"></div>
								<img class="over" src="<?php echo $themeDir; ?>/lib/td-panel-img/btn_switch_overlay.png"/>
						</div>
					</div>
          <?php /* <input type="checkbox" name="_screen-galleryCategories[]" value="<?php echo $c->cat_ID; ?>" <?php if(in_array($c->cat_ID, $galleryCategories)) { ?> checked<?php } ?>/> */ ?>
          <?php /* echo $c->name; ?><br /> */ ?>
          <?php
        }
        ?>
	  </div>
	  <div>
          <span style="color:#999; font-size:10px;">Don't forget to put the gallery categories into your main menu (Appearance &gt; Menus).</span></p>
      </div>
      <div>
        <p>Fade with effect:<br />
          <?php
        
       	$galleryFade = get_option('_screen-galleryFade');
        	echo "<!--serg {$_POST['_screen-galleryFade']} --><select name=\"_screen-galleryFade\" id='id_screen-galleryFade'>".
        	"<option value='0' ".($galleryFade==0 ? "selected=\"selected\"" : "").">Off</option>".
        	"<option value='1' ".($galleryFade==1 ? "selected=\"selected\"" : "").">On</option>".        	
        	"</select>";
        ?></p>
      </div>
      <div>
        <p>Diashow interval rate (1-5):<br />
          <?php        
       	$galleryDiaInterval = get_option('_screen-galleryDiaInterval');
        ?>
          <input type="text" name="_screen-galleryDiaInterval" value="<?php echo $galleryDiaInterval ? $galleryDiaInterval : 3; ?>" style="width:100px;" /></p>
      </div>
      <div>
        <p><input type="submit" name="save" value="Save changes" style="cursor:pointer; margin:5px 0;" /></p>
      </div>
    </div>
    <?php
  /* Get copyright options */
  $copyrightName = get_option('_screen-copyright-name');
  $copyrightLink = get_option('_screen-copyright-link');
  ?>
    <div cellpadding="0" cellspacing="5" style="margin:-8px 0 0 0; display:none; color:#fff; padding:10px; width:595px;" id="tab-support" class="tabs">
      <div>
        <p colspan="2"><h1>Support information</h1></p>
      </div>
      <div>
        <p><h3>Have your WordPress template up and running in no time!</h3>
          <strong>Step 1</strong>
          <p>The first step for you to take will be to send us an email through ThemeForest, so we can verify that you have bought the WordPress template at Themeforest.net</p>
          <strong>Step 2</strong>
          <p>Make an account at the support page and register your account with the same info as on ThemeForest. You will get a subscriber account that we must activate first.</p>
          <strong>Step 3</strong>
          <p>We activate your account after we received your request and verified your account. Then you'll have full access to the restricted member areas. Once you login to the member area, you will find everything you need; from manuals to video manuals and support forum. If you have a request for our support team, there is an extra request form that you can fill in. So, if you have a question we always are here to help!</p>
          <p>Get your free support <a href="http://theme-dutch.com/support" target="_blank" title="Theme dutch support">Support</a> account</p></p>
      </div>
      <div>
      </div>
    </div>
    <input type="hidden" name="td-action" value="save" />
  </div><?php // end of TD-panel div ?>
  </form>
</div>
</div>
<script type="text/javascript" src="<?php echo get_bloginfo('template_url'); ?>/js/jquery-1.4.2.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo get_bloginfo('template_url'); ?>/js/cp/css/colorpicker.css" />
<script type="text/javascript" src="<?php echo get_bloginfo('template_url'); ?>/js/cp/js/colorpicker.js"></script> 
<script type="text/javascript">
    $(document).ready(function() {
      var hash = window.location.hash.replace("#", "");
      if($("#tab-" + hash).length > 0) {
        $("#tab-" + hash).fadeIn();
      } else {
        $("#tab-intro").fadeIn();
      }
      $('#screen-payoffColor, #screen-headerColor, #screen-footerColor, #screen-contentColor, #screen-blogframeColor, #screen-h1Color, #screen-h2Color, #screen-h3Color, #screen-h4Color, #screen-h5Color, #screen-h6Color, #screen-payofftextColor, #screen-paragraphColor, #screen-linkColor, #screen-linkhoverColor, #screen-widgeth3Color, #screen-widgetlinkhoverColor, #screen-breadcrumbColor, #screen-breadcrumbhoverColor, #screen-blogh2Color, #screen-blogh2hoverColor, #screen-blogmetaColor, #screen-blogmetahoverColor, #screen-logotextColor, #screen-logotexthoverColor, #screen-widgetlinkColor, #screen-widgetlinkhoverColor, #screen-widgetsublinkColor, #screen-menulinkColor, #screen-menulinkhoverColor, #screen-menusubtitlesColor, #screen-footermenuColor, #screen-footermenuhoverColor, #screen-copyrightColor, #screen-copyrighthoverColor, #screen-backgroundColor, #screen-submenulinkhoverColor, #screen-submenulinkColor').ColorPicker({
      	onSubmit:function(hsb, hex, rgb, el) {
      		$(el).val(hex);
      		$(el).ColorPickerHide();
      	},
      	onBeforeShow:function() {
      		$(this).ColorPickerSetColor(this.value);
      	}
      });
			
		showBgImgField();
    });
    function showTab(id) {
      $("#screenform").attr("action", "#" + id.replace("tab-", ""));
      $(".tabs").stop(true, true).fadeOut(200);
      $("#" + id).delay(300).fadeIn();
    }
    function removeSidebar(id) {
      if(confirm("Are you sure you want to remove this sidebar?")) {
        $("#screen-sidebar-" + id).fadeOut(300, function() {
          $(this).empty().remove();
          $("#screenform").submit();
        });
      }
    }
    function showBgImgField() {
      if($("#screen-home-bgType").val() == "image") {
		  $('#bgImgTitle').html('Background image:');
		  $('#bgImgDesc').html('Enter the full URL to your background image here (e.g. http://www.yoursite.com/images/background.jpg). For the best result use images with a resolution of 1280 x 1024 pixels.');
		  $("#screen-home-bgImg-tr").fadeIn();
      } else if ($("#screen-home-bgType").val() == "video") {
		  $('#bgImgTitle').html('Background video:');
		  $('#bgImgDesc').html('Enter the full URL of your background video (e.g. http://www.yoursite.com/videos/video.flv)<br/>Supported file types: flv, f4v, mp4, mov');
		  $("#screen-home-bgImg-tr").fadeIn();
	  } else {
        $("#screen-home-bgImg-tr").fadeOut(200);
      }
    }
    function showCategoryBgImgField() {
      if($("#screen-category-bgType").val() == "image") {
        $("#screen-category-bgImg-tr").fadeIn();
      } else {
        $("#screen-category-bgImg-tr").fadeOut(200);
      }
    }
    function removeFooterSidebar(id) {
      if(confirm("Are you sure you want to remove this footer sidebar?")) {
        $("#screen-footersidebar-" + id).fadeOut(300, function() {
          $(this).empty().remove();
          $("#screenform").submit();
        });
      }
    }
    function removeFootermenu(id) {
      if(confirm("Are you sure you want to remove this footermenu?")) {
        $("#screen-footermenu-" + id).fadeOut(300, function() {
          $(this).empty().remove();
          $("#screenform").submit();
        });
      }
    }
  </script>
<?php
}

/* Add tinyMCE for homepage WYSIWYG editing */
if($_GET['page'] == 'theme_options.php') {
  add_filter('admin_head','showTinyMCE');
}
function showTinyMCE() {
	wp_enqueue_script('common');
	wp_enqueue_script('jquery-color');
	wp_print_scripts('editor');
	if(function_exists('add_thickbox')) { add_thickbox(); }
	wp_print_scripts('media-upload');
	if(function_exists('wp_tiny_mce')) { wp_tiny_mce(); }
	wp_admin_css();
	wp_enqueue_script('utils');
	do_action('admin_print_styles-post-php');
	do_action('admin_print_styles');
	remove_all_filters('mce_external_plugins');
}

/* Add theme options page */
add_action('admin_menu', 'teamDutchAddThemeOptions');
function teamDutchAddThemeOptions() {
  add_menu_page('Seduction options', '<span style="color:#000000;">SEDUCTION</span>', 'edit_themes', 'theme_options.php', 'teamDutchPlaceThemeOptions', get_bloginfo('template_url') . '/images/seduction-icon.png');
}
?>
