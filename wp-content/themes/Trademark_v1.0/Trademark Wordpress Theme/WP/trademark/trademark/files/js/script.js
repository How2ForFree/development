// Jquery no conflict mode
$j = jQuery.noConflict();

/* ******************************************************************************************
 * Bootstrap
 * ******************************************************************************************/
$j(document).ready(function() {
  InitCufon();

  InitMisc();
  
  InitMenu();
            
  InitImages();
  
});

/* ******************************************************************************************
 * Font Replacement
 * ******************************************************************************************/
function InitCufon() {
	
    Cufon.replace('#page h1, #page h2, #page h3, #page h4, #logo .title, #navigation-header strong, .portfolio-website .website-name');    
    Cufon.replace('#feature-list-tabs h3', {
        textShadow: '1px 1px rgba(0, 0, 0, 0.2)'
    });
    
    Cufon.replace('#navigation > ul > li > a', {
        textShadow: '1px 1px rgba(0, 0, 0, 0.2)'
    });
    
}

/* ******************************************************************************************
 * Menu
 * ******************************************************************************************/
function InitMenu() {
  $j('#navigation ul.sub-menu').parent().addClass('parent');    
  $j('#navigation li').hover(
    function() {
      $j(this).find('ul:first').css({'visibility': 'visible', 'display': 'none'}).slideDown('150');
      $j(this).find('li:last').css({'background-image': 'none'});
            
    },
    function() { 
      $j(this).find('ul:first').css({'visibility': 'hidden'});
    }
  );
  
  $j('#navigation-header ul.sub-menu').parent().addClass('parent');    
  $j('#navigation-header li').hover(
    function() {
      $j(this).find('ul:first').css({'visibility': 'visible', 'display': 'none'}).slideDown('150');
      $j(this).find('li:last').css({'background-image': 'none'});
            
    },
    function() { 
      $j(this).find('ul:first').css({'visibility': 'hidden'});
    }
  );
}

/* ******************************************************************************************
 * Images
 * ******************************************************************************************/
function InitImages() {
	// Image fancybox
	$j("a[href$='gif']").fancybox();
	$j("a[href$='jpg']").fancybox();
	$j("a[href$='png']").fancybox();
}

/* ******************************************************************************************
 * Miscellaneous
 * ******************************************************************************************/
function InitMisc() {  
  $j('#content input, #content textarea').each(function(index) {    
    var id = $j(this).attr('id');
    var name = $j(this).attr('name');    
    if (id.length == 0 && name.length != 0) {
      $j(this).attr('id', name);
    }
  });
  
  $j('#main label').inFieldLabels();
  
  $j('.rule span').click(function() {        
	  $j.scrollTo(0, 1000, {axis:'y'}); 
	  return false;   
 });
}
