<?php if ( get_option( 'show_themebox' ) ) : ?>

<div id="theme-box">
    
    <div id="titlesColor" style="display:none"><?php echo get_option( 'titles_color' ); ?></div>
    <div id="linksColor" style="display:none"><?php echo get_option( 'links_color' ); ?></div>
    
    <span id="theme-box-closer" class="opened">open/close</span>
    <a href="<?php echo home_url(); ?>" id="theme-box-reset" class="not">Reset All</a>
    <a href="http://themeforest.net/user/ait" id="theme-box-purchase">Purchase NOW</a>
	<a href="http://themeforest.net/user/ait/follow" id="theme-box-follow">Follow Us</a>

    <h2>Patterns</h2>
    <ul class="theme-patterns clearfix">
        <li><a href="#" rel="stripes.png" class="stripes not"><span>Stripes</span></a></li>
		<li><a href="#" rel="stripes2.png" class="stripes not"><span>Stripes2</span></a></li>
        <li><a href="#" rel="grid.png" class="grid not"><span>Grid</span></a></li>
        <li><a href="#" rel="diagonal.png" class="grid not"><span>Diagonal</span></a></li>
        <li><a href="#" rel="squares.png" class="grid not"><span>Squares</span></a></li>
        <li><a href="#" rel="carbon1.png" class="grid not"><span>Carbon1</span></a></li>
        <li><a href="#" rel="carbon2.png" class="grid not"><span>Carbon2</span></a></li>
        <li><a href="#" rel="carbon3.png" class="grid not"><span>Carbon3</span></a></li>
        <li><a href="#" rel="ornament1.png" class="grid not"><span>Ornament1</span></a></li>
        <li><a href="#" rel="ornament2.png" class="grid not"><span>Ornament2</span></a></li>
		<li><a href="#" rel="stars.png" class="grid not"><span>Stars</span></a></li>
		<li><a href="#" rel="sand.png" class="grid not"><span>Sand</span></a></li>
        <li><a href="#" rel="floral.png" class="grid not"><span>Floral</span></a></li>
        <li><a href="#" rel="floral2.png" class="grid not"><span>Floral2</span></a></li>
        <li><a href="#" rel="none" class="grid not"><span>None</span></a></li>
    </ul> 
        
    <h2>Color Settings</h2>
    <div class="colors clearfix">
      <div class="colorpicker-col1">
        <div class="cp-name">Background:</div>
        <div class="cp-data"><input type="text" id="colorpicker" name="" /></div>
        
        <div class="cp-name">Slider:</div>
        <div class="cp-data"><input type="text" id="colorpicker2" name="" /></div>                
        
        <div class="cp-name">Main:</div>
        <div class="cp-data"><input type="text" id="colorpicker4" name="" /></div>                        
        
        <div class="cp-name">Footer:</div>
        <div class="cp-data"><input type="text" id="colorpicker6" name="" /></div>
        
        <div class="cp-name">Links:</div>
        <div class="cp-data"><input type="text" id="colorpicker8" name="" /></div>                                
      </div>
      <div class="colorpicker-col2">  
        <div class="cp-name">Header:</div>
        <div class="cp-data"><input type="text" id="colorpicker1" name="" /></div>        
        
        <div class="cp-name">Toolbar:</div>
        <div class="cp-data"><input type="text" id="colorpicker3" name="" /></div>                
        
        <div class="cp-name">Navigation:</div>
        <div class="cp-data"><input type="text" id="colorpicker5" name="" /></div>
        
        <div class="cp-name">Titles:</div>
        <div class="cp-data"><input type="text" id="colorpicker7" name="" /></div>                                
      </div>
    </div>
    
    <h2>Main Navigation</h2>
    <ul>
        <li><a href="" id="main-navigation-top" class="not">Top</a></li>
        <li><a href="" id="main-navigation-bottom" class="not">Bottom</a></li>
    </ul>
    
    <h2>Theme Variants</h2>
    <ul>
        <li><a href="" id="theme-light" class="not">Light (Dark Fonts)</a></li>
        <li><a href="" id="theme-dark" class="not">Dark (Light Fonts)</a></li>
    </ul> 
    
    <h2>Our WP Themes</h2>
    <select id="best-sellers">
	  <option value="select">- please select -</option>
	  <option value="corporate">Corporate Easy</option>
	  <option value="simplicius">Simplicius Simplicissimus</option>
	  <option value="universal-business">Universal business</option>
	  <option value="glamorous">Glamorous</option>
	  <option value="trademark">Trademark</option>
	</select>
</div><!-- /#theme-box  -->
<?php endif; ?>
