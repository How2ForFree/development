/*  
    NAME: Paralel Slider;
    AUTHOR: Freshface;
    WEBSITE: http://www.freshface.net
*/         
 

     jQuery(document).ready(function($){  
                	if(!($.browser.msie))
      	{
      // we make objects from slider SIGNS
			     var rot=$('#sign_min').rotate(0);
			     var rota=$('#sign_max').rotate(0);      
		    } 
        	else// if(($.browser.msie && $.browser.version!="6.0"))
          {
          //alert('pss');

          
          }   

    if(jQuery.browser.msie)
      {
        $("#vml_ie").append("<style>v\:image { behavior:url(#default#VML); display:inline-block ; -ms-interpolation-mode: bicubic}</style>\n");
        $("#vml_ie").append("<xml:namespace ns=\"urn:schemas-microsoft-com:vml\" prefix=\"v\" />");
      } 
        $('#featured_home li').find("a.slider_img").preload();        
  /*
      
      
        
      <!-- Include the VML behavior -->
<style>v\:image { behavior:url(#default#VML); display:inline-block ; -ms-interpolation-mode: bicubic}</style>
<!-- Declare the VML namespace -->
<xml:namespace ns="urn:schemas-microsoft-com:vml" prefix="v" />
 */
      /////////////////////////////
      // SLIDER
      /////////////////////////////
      // PARAMETERS:
      var $rotate_plus_sign_about = 180;    // degrees
      var $rotate_minus_sign_about = -180;  // degrees
      var $width_of_the_image = 162;        // width of ONE image in pixels, including the margin !!
      var $speed_of_moving = 0;             // in miliseconds, speed which are the images moving
      
      // SLIDER MAX is the minus sign
      // SLIDER MIN is the plus sign
      
      /////////////////////////////
      //INTERNAL PARAMS, PLEASE DONT CHANGE
      /////////////////////////////
	    var $rotmaxangle = 180;
      var $rotminangle = -180;
      var $es = $("#slider").find("li").size();   // el = Elements in Slider
      var $es_width = $width_of_the_image;
      var autoslide_interval;
       var actual_img = 0; 
     //   alert($es)
      $("#sl_content").css("width", $es_width * $es);
	    var $kook = 0;
      var $step = 0;
      var $actual_step = 0; 
      var $max_step = $es - 5;
      var actual_selected = 0;
      /*      $('#featured_home li').click(function() {
        $("#slider_main_img").fadeTo(150, 0);   //  fade the MAIN IMAGE to WHITE. And when is the main image white, we call the callback function 
        $(this).fadeTo(150, 0.5,  function()    // fade all slider images to non transparent
        {// callback function
          // GETTING THE Attributes from slider
          $("#slider_post_cat").html($(this).find("div.slider_tit").html());
         // $("#slider_img_tit").attr("href", $(this).find("a.slider_tit").attr("href"));
            
          $("#slider_img_desc").html($(this).find("a.slider_desc").html());
          $("#slider_img_desc").attr("href", $(this).find("a.slider_desc").attr("href"));
          
          // FLIPPING THE IMAGE
          $("#slider_main_img").attr("src",$(this).find("a.slider_img").attr("href")); 
           $("#slider_main_img").fadeTo(150, 1); // FADING MAIN IMAGE TO NORMAL
        });
  
       
  
        $('#featured_home li').fadeTo(5, 1);      // FADE ALL SLIDER IMAGES TO NORMAL
  		  $(this).fadeTo(150, 1);

      });*/
     function auto_slide()
      {
      //  alert($es);
         if(actual_selected < $es - 1)
         {
           actual_selected++;
         }
         else // reset slider
         {
             actual_selected = 0;
             $kook = 0;
             $("#sl_content").stop(false, false);
          $("#sl_content").animate({marginLeft: $kook}, 300 );
         }
         if(actual_selected >=5)
         {
          $actual_step = actual_selected - 4;
          //alert (actual_step);
          $step = $es_width; 
          $kook = $kook -  $step; 
          $("#sl_content").stop(false, false);
          $("#sl_content").animate({marginLeft: $kook}, 300 );
         }
         
         //  $("#slider_main_img").fadeTo(150, 0); 
           $('#slider_ul li').eq(actual_selected).fadeTo(150, 0.5,  function() 
           {
                //alert($(this).html() );
                change_images($(this).find("a.slider_desc").attr("title"));
                $(this).fadeTo(5, 1);
  
           });                                      

      } 

       var slider_interval = autoslide_time; 
      if(slider_interval != 0)
      {
      autoslide_interval = setInterval ( auto_slide, slider_interval);
      }
      
      if(!($.browser.msie)) 
      {         
       // $('#round_max').css("border", "1px solid black");
        $('#round_max').css("width", 26);	
        $('#round_max').css("height", 26);	
        $('#round_min').css("width", 26);	
        $('#round_min').css("height", 26);	
      }
      else
      {     
      $('#round_max').css("margin", "34px 10px 33px 10px;");
      $('#round_min').css("margin", "34px 10px 33px 10px;");
     
      $('#sign_min').css("positon", "absolute");
      $('#sign_min').css("top", 41);
      $('#sign_min').css("left", 16);
      
      $('#sign_max').css("positon", "absolute");
      $('#sign_max').css("top", 40);
      $('#sign_max').css("left", 16);
       // $('#slider_max').("width", 26);	
      }
      
      
      

			if(!$.browser.msie)   // position of the signs in IE (dear got i was making that about 3 hours)
			{
  			rot[0].css("position", "absolute");
  			rot[0].css("top", '38px');
  			rot[0].css("left", '13px');
  			rota[0].css("position", "absolute");
  			rota[0].css("top", '37px');
  			rota[0].css("left", '12px');
			}
	/*		else if(!($.browser.msie && $.browser.version=="6.0"))                // position of the signs in normal working internet browser (mozilla, opera, etc)
			{
        rot[0].css("position", "absolute");
  			rot[0].css("top", '38px');
  			rot[0].css("left", '13px');
  			rota[0].css("position", "absolute");
  			rota[0].css("top", '37px');
  			rota[0].css("left", '12px');
      }
    */  
      // SLIDER MAX is the minus sign
      // SLIDER MIN is the plus sign
      $('#slider_max').hover(     // HERE WE SCALE THE CIRCLE WHEN THE MOUSE IS IN THE ELEMENT
      function () {
      if(!($.browser.msie && $.browser.version=="6.0")) 
      {
      $('#round_max').animate({ 
        width: 30, 
        height: 30,
        marginLeft: 10 ,
        marginTop:35
        }, 50 );
      }
      }, 
      function () {
      if(!($.browser.msie && $.browser.version=="6.0")) 
      {
        $('#round_max').animate({ 
        width: 26, 
        height: 26,
        marginLeft: 12 ,
        marginTop:37
        }, 50 );
        }
      }); 
              $('#round_max').animate({ 
        width: 26, 
        height: 26,
        marginLeft: 12 ,
        marginTop:37
        }, 50 );
        
      
              $('#round_min').animate({ 
        width: 26, 
        height: 26,
        marginLeft: 12 ,
        marginTop:37
        }, 50 );
      
    $('#slider_min').hover(   // HERE WE SCALE THE CIRCLE WHEN THE MOUSE IS IN THE ELEMENT
      function () {
       if(!($.browser.msie && $.browser.version=="6.0")) 
      {
      $('#round_min').animate({ 
        width: 30, 
        height: 30,
        marginLeft: 10 ,
        marginTop:35
        }, 50 );
        }
      }, 
      function () {
       if(!($.browser.msie && $.browser.version=="6.0")) 
      {
        $('#round_min').animate({ 
        width: 26, 
        height: 26,
        marginLeft: 12 ,
        marginTop:37
        }, 50 );
        }
      }); 
      
       // SLIDER MAX is the minus sign
      // SLIDER MIN is the plus sign
      
      // HERE IS THE ROTATING OF MINUS SIGN AND SLIDING
      $('#slider_max').click(function() {
      clearInterval(autoslide_interval);
      $('#slider').onselectstart = function () { return false; }
      $('#sign_max').stop();
      // IE fix
       if(!($.browser.msie)) 
      {
      if($rotminangle%360 == 0 && $.browser.msie)
      {
      	rota[0].animate({
        top: 38,
        left: 13
        }, 0 );
			}
			else if($.browser.msie)
		  {          
		  	rota[0].animate({
        top: 37,
        left: 12
        }, 0 );
      }
          
      // main rotation
      rota[0].rotateAnimation($rotminangle);
      $rotminangle = $rotminangle - 180;
      }
      
      if($actual_step <= 0)   // if is the slider on the end, we make a bounce effect
      {
        $("#sl_content").stop(false, false);
        $("#sl_content").animate({marginLeft: +20}, 300 );
        $("#sl_content").animate({marginLeft: 0}, 80 );
      }
     else  // when the slider can move, we move it
      {
        $step =$es_width;
        $kook = $kook +  $step; 
        $("#sl_content").stop(false, false);
        $("#sl_content").animate({marginLeft: $kook}, 400 );
        $actual_step--;
      }
      });
        
        
        
       
       // SLIDER MAX is the minus sign
      // SLIDER MIN is the plus sign 
      $('#slider_min').click(function() {
      clearInterval(autoslide_interval);
      $('#sign_min').stop();
      // IE fix
       if(!($.browser.msie)) 
      {
      if($rotmaxangle%360 == 0 && $.browser.msie)
      {
      	rot[0].animate({
        top: 38,
        left: 14
        }, 0 );
			}
			else if($.browser.msie)
		  {
		  	rot[0].animate({
        top: 37,
        left: 13
        }, 0 );      
      }
      rot[0].rotateAnimation($rotmaxangle);
      $rotmaxangle = $rotmaxangle + 180;
      }          
      if($actual_step >= $max_step) // if we cant move, do the bounce effect
      {
        $("#sl_content").stop(false, false);
        var $bounce = (($es * $es_width) - (5*$es_width)) * (-1);
        $("#sl_content").animate({marginLeft: $bounce - 20}, 300 );
        $("#sl_content").animate({marginLeft: $bounce}, 80 );
      }
      else    // else move the slider
      {
        $step = $es_width; 
        $kook = $kook -  $step; 
        $("#sl_content").stop(false, false);
        $("#sl_content").animate({marginLeft: $kook}, 300 );
        $actual_step++;
      }       
      });
     
      // CHANGING THE IMAGES     
      $('#featured_home li').click(function() {
        clearInterval(autoslide_interval);
      //  $("#slider_main_img").fadeTo(150, 0);   //  fade the MAIN IMAGE to WHITE. And when is the main image white, we call the callback function 
        $(this).fadeTo(150, 0.5,  function()    // fade all slider images to non transparent
        {// callback function
          // GETTING THE Attributes from slider
        /*  $("#slider_post_cat").html($(this).find("div.slider_tit").html());
         // $("#slider_img_tit").attr("href", $(this).find("a.slider_tit").attr("href"));
            
          $("#slider_img_desc").html($(this).find("a.slider_desc").html());
          $("#slider_img_desc").attr("href", $(this).find("a.slider_desc").attr("href"));
          
          // FLIPPING THE IMAGE
          $("#slider_main_img").attr("src",$(this).find("a.slider_img").attr("href")); 
          // $("#slider_main_img").fadeTo(150, 1); // FADING MAIN IMAGE TO NORMAL       */
        
          change_images($(this).find("a.slider_desc").attr("title"));         //slider_desc
        });
  
       
  
        $('#featured_home li').fadeTo(5, 1);      // FADE ALL SLIDER IMAGES TO NORMAL
  		  $(this).fadeTo(150, 1);

      });
       
        /*                               
  var actual_img = 0;    
  var slide_count =  $('#fresh_cube_nav_wrapper li').length;
   if(autoslide_time != 0)
  {   
var autoslide_interval = setInterval(function(){
      actual_img++;
      if(actual_img == slide_count){actual_img=0;}
      change_images(actual_img);      
      }, autoslide_time);
 }              */
// postup:
/*
  1. switchnout obrazky - aktualni z pozadi do kostek, ktere budou mit display block pote
  2. budouci z kostek do pozadi
  3. zjistit transition
  4. udelat animaci
  5. switchnout obrazky
 */ /*  
$('.fresh_cube').click(function(){
     var is_lightbox = $('.fresh_cube_image_'+actual_img).find('.lightbox').attr('title');
     var link_url = $('.fresh_cube_image_'+actual_img).find('.lightbox').html();
     if(link_url != '')
     {
      if(is_lightbox == 1){$.prettyPhoto.open(link_url,'','');}
      else{ window.location = link_url;}
     }
});
                                    */
    $('#fresh_cube_nav_wrapper li').click(function(){
  // actual_img = $(this).attr('title');
      clearInterval(autoslide_interval);
    change_images($(this).attr('title'));
    
  //  alert($('.fresh_cube_image_0').attr('title')); 
  });
  
  $('.slide_left').click(function(){            
   clearInterval(autoslide_interval); 
  $('.fresh_cube').parent().attr('rel','');
    $('.fresh_cube:animated').parent().attr('rel', 'animating');   
    if(actual_img -1 >= 0 && $('.fresh_cube').parent().attr('rel') != 'animating'){
    actual_img --;   
    change_images(actual_img);}
    else if(actual_img -1 < 0 && $('.fresh_cube').parent().attr('rel') != 'animating')
    {
      actual_img = slide_count - 1;   
    change_images(actual_img);
    }
  });
  
    $('.slide_right').click(function(){      
      actual_img++;
        clearInterval(autoslide_interval); 
        $('.fresh_cube').parent().attr('rel','');
        $('.fresh_cube:animated').parent().attr('rel', 'animating');    

      
      if( actual_img < slide_count && $('.fresh_cube').parent().attr('rel') != 'animating')
      {
    //    alert(actual_img + '  ' + $('#fresh_cube_nav_wrapper li').size());
     
        change_images(actual_img);
      }
      else if( actual_img >= slide_count && $('.fresh_cube').parent().attr('rel') != 'animating' )
      {actual_img = 0;change_images(actual_img);}
      else {
      actual_img--;}
  });
  $('.slider_shadow').click(function(){
     // img_id = actual_img - 1;
     clearInterval(autoslide_interval);
      var lightbox = $('.fresh_cube_image_'+actual_img).find('.ligthbox').attr('title');
      
      var linkurl = $('.fresh_cube_image_'+actual_img).find('.ligthbox').html();
    //  var img = $('.fresh_cube_image_'+actual_img).find('img').attr('src');
      //alert(img);
      if(lightbox == 1)
      {
        $.prettyPhoto.open(linkurl,'','');
      }
      else
      {
        window.location = linkurl;
      }
      return false;
      
  } );
  function change_images(img_id)
  {       
   
//    alert($('.fresh_cube:[name=dsdsdsdsds]')); 
    $('.fresh_cube').parent().attr('rel','');
    $('.fresh_cube:animated').parent().attr('rel', 'animating');
   if( $('.fresh_cube').parent().attr('rel') != 'animating')
   {         
      actual_img = img_id;
    $('#fresh_cube_nav_wrapper li').removeClass('active');
     $('#fresh_cube_nav_wrapper li').eq(img_id).addClass('active');
    var new_img_src = $('.fresh_cube_image_'+img_id).find('img').attr('src');
  //  alert(new_img_src);
    var actual_img_src = $('#slider_freshcubes').css('background-image');
    
    //alert(actual_img_src);
   // alert(img_src);
    reset_grid();
    $('.fresh_cube').css('background-image', actual_img_src);// 'url('+img_src+')');
    $('.fresh_cube').css('display', 'block');
    $('.fresh_cube').css('opacity', 1);
     
    $('#slider_freshcubes').css('background-image', 'url('+new_img_src+')');
    $('.post_info_holder').html($('.fresh_cube_image_'+img_id).find('.transition').html());  


    var transition_name =  $('.fresh_cube_image_'+img_id).find('.transition').attr('title');

    transition(transition_name);
   } 
    //transition_random();
  }
  function transition(name)
  {
    // random, basic, fly
  //  alert(name);
    if(name == 'random') {transition_random();}
    else if( name == 'lcp') {transition_lcp();}
    else if (name == 'basic') {transition_basic();}
    else if( name == 'fly') {transition_fly();}
    else if( name == 'flyback') {transition_flyback();}
    else if( name == 'lines') {transition_lines();}
    else if( name == 'column') {transition_column();}    
  }
  
  function reset_grid()
  {
    for(var w = 0; w < 8; w++)
    {
      for(var h = 0; h < 3; h++)
      {
        $('#fresh_cube_'+w+'_'+h).css('width', 120);
        $('#fresh_cube_'+w+'_'+h).css('height', 120);
        $('#fresh_cube_'+w+'_'+h).css('top', h*120);
        $('#fresh_cube_'+w+'_'+h).css('left', w*120);
      }
    }
  }
  function transition_random()
  {
    for(var w = 0; w < 8; w++)
    {
      for(var h = 0; h < 3; h++)
      {
        var hide_time = Math.random() * 700 + 400;
        $('#fresh_cube_'+w+'_'+h).animate({opacity:0}, hide_time);
      }
    }
  }
  function transition_basic()
  {
    for(var w = 0; w < 8; w++)
    {
      for(var h = 0; h < 3; h++)
      {
        $('#fresh_cube_'+w+'_'+h).animate({opacity:0}, 500 + (w*150) );
      }
    }
  }
  function transition_fly()
  {
  var animate_time = 500;
   for(var h = 0; h < 3; h++)
    {
       for(var w = 0; w < 8; w++)
      {
        animate_time = (w+h)*100;
        
        $('#fresh_cube_'+w+'_'+h).delay(animate_time).animate({opacity: -1,top:(h-1)*120, left:(w-1)*120}, 450);
     //   $('#fresh_cube_'+w+'_'+h).delay(animate_time).animate({opacity:0}, {queue:false, duration:450/2});
      }
    }
  }  
  function transition_flyback()
  {
    var animate_time = 500;
     for(var h = 0; h < 3; h++)
      {
         for(var w = 0; w < 8; w++)
        {
          animate_time = (w+h)*100;
          
          $('#fresh_cube_'+w+'_'+h).delay(animate_time).animate({opacity: -1,top:(h+1)*120, left:(w+1)*120}, 450);
       //   $('#fresh_cube_'+w+'_'+h).delay(animate_time).animate({opacity:0}, {queue:false, duration:450/2});
        }
      }
  }  
    function transition_lines()
  {
    var animate_time = 500;
     for(var h = 0; h < 3; h++)
      {
         for(var w = 0; w < 8; w++)
        {
          animate_time = (w+1)*50;
          
          if(h==1)
          {
            $('#fresh_cube_'+(7-w)+'_'+h).delay(animate_time).animate({opacity: 0}, 450);
          }
          else
          {
            $('#fresh_cube_'+w+'_'+h).delay(animate_time).animate({opacity: 0}, 450);
          }
       //   $('#fresh_cube_'+w+'_'+h).delay(animate_time).animate({opacity:0}, {queue:false, duration:450/2});
        }
      }
  } 
  function transition_lcp()
  {
          // $('#slider_freshcubes').stop().animate({opacity: 0}, 1);
      var act_bg_img = $('#slider_freshcubes').css('background-image');
      var counter = 1;
       $('#slider_freshcubes').css('background-image', '');
      $('.fresh_cube').stop().animate({opacity: 0}, 190,function(){
      if(counter == 1)
      {
          $('#slider_freshcubes').css('display','none');
          $('#slider_freshcubes').css('background-image', act_bg_img);
          $('#slider_freshcubes').animate({opacity: 0}, 1);
          $('#slider_freshcubes').css('display','block');   
            $('#slider_freshcubes').animate({opacity: 1}, 190);
        }
        counter++;
      } );
      
   // $('.fresh_cube').css('width',0);
    //$('.fresh_cube').animate({opacity: 0}, 0);
  } 
  function transition_column()
  {
        $('.fresh_cube').animate({width:0, opacity:0}, 500);
  }
  
});