var arrSelectFunc = new Array();
var switch_speed = 200;
var page_change_speed = 200;
var navigation_hover_speed = 200;
var fading = false;

  var slb_maxheight = 200;
  var scroll_click = 0;
  var last_clicked;
  var isSelectChecked = false;

jQuery(document).ready(function() {

jQuery(".wrapper_nav li").hover(function(){
  if(jQuery(this).attr("name") != "selected" )
  {
    jQuery(this).find(".active").stop().fadeTo(0,0);
    jQuery(this).find(".active").css("display", "block");
    jQuery(this).find(".active").fadeTo(navigation_hover_speed,1);
  }
},function(){
  if(jQuery(this).attr("name") != "selected" )
  {   
    jQuery(this).find(".active").stop().fadeTo(navigation_hover_speed,0, function() {    jQuery(this).find(".active").css("display", "none");} );

  }
});

//////////////////////////////////////////////////////////////////////////////
// 
////////////////////////////////////////////////////////////////////////////// 

	var content = jQuery('div.content-admin');
	content.find('input[type=text]').css('width', '420px');
	content.find('textarea.td-panel').css({
		'width': '420px',
		'height': '250px'
	});
	content.find('input[type=submit]').attr('class', 'btn_save').attr('value', '');
	content.find('input[type=checkbox]').removeAttr('class');
	
	content.find('select').each( function(index, obj) { 
		var chId = obj.id;
		var chName = obj.name;
		var chVal  = obj.value;
		var arr = obj.options;
		var chCur = chVal;
		var chFunc = jQuery(obj).attr('onchange');
		var chHtml = obj.innerHTML;

		try{
			if(obj.selectedIndex < arr.length && typeof arr[obj.selectedIndex] == 'object')
				chCur = arr[obj.selectedIndex].text;
		} catch(err){}
		var opts = '';
		for(var i = 0, len = arr.length; i < len; i++){
			opts += '<li title="'+ arr[i].value +'">'+ arr[i].text +'</li>';
		}

		jQuery(obj).replaceWith(
			'<div class="select">' + 
                '<div class="selectbox_wrapper">' + 
                    '<input type="hidden" value="'+ chVal +'" name="'+ chName +'"'+ (chId != '' ? ' id="'+ chId +'"/>' : '/>') + 
					//'<select style="display:none;" name="'+ chName +'" '+ (chId != '' ? 'id="'+ chId +'"' : '') + '>'+ chHtml +'</select>' +
                    '<div class="selected">'+ chCur +'</div>' + 
                    '<div class="select_options_wrapper">' + 
                        '<div class="select_options_container">' + 
                            '<ul class="select_options">' + 
                                opts + 
                            '</ul>' + 
                        '</div>' + 
                        '<div class="scrollbox">' + 
                            '<div class="scrollbar_wrapper">' + 
                                '<div class="scrollbar" name="0"></div>' + 
                            '</div>' + 
                        '</div>' + 
                        '<div class="clear"></div>' + 
                        '<div class="select_shadow"></div>' + 
                    '</div>' + 
                '</div>' + 
                '<div class="clear"></div>' + 
            '</div>'
		);
		if(typeof chFunc == 'function') {
			arrSelectFunc.push( {id: chId, func: chFunc} );
		}
	});

//////////////////////////////////////////////////////////////////////////////
// SWITCH BUTTON function
//////////////////////////////////////////////////////////////////////////////    
    
    jQuery(".btn_switch").click(function() {
      var new_value = jQuery(this).find(".btn_switch_input").attr("value");
      
      if(new_value == "true")
      {
        var name = jQuery(this).find(".switch_check_input").attr("name");
		jQuery(this).find(".switch_check_input").attr("name", '').attr('title', name);
		
		jQuery(this).find(".btn_switch_input").attr("value", "false");
        jQuery(this).find(".on_off").stop().animate({left: -53}, switch_speed);  
      }
      else
      {
        var name = jQuery(this).find(".switch_check_input").attr("title");
		jQuery(this).find(".switch_check_input").attr("name", name);
		
		jQuery(this).find(".btn_switch_input").attr("value", "true");
        jQuery(this).find(".on_off").stop().animate({left: 0}, switch_speed);  
      }
    });

    jQuery(".info_small").mousemove(function(e){
      var tooltip_text = jQuery(this).parent().find(".desc").html();
      jQuery(".fresh_tooltip").css("display", "block");
      jQuery(".fresh_tooltip").find(".tooltip").html(tooltip_text);
      jQuery(".fresh_tooltip").css("top", e.pageY - 50);
      jQuery(".fresh_tooltip").css("left", e.pageX -260);
      jQuery(".fresh_tooltip").html(jQuery(this).parent().find(".desc").html());

    });
     jQuery(".info_small").mouseout(function(){
      jQuery(".fresh_tooltip").css("display", "none");
     });
     jQuery(window).resize(function() {
      var wp_content_height = jQuery("#wpcontent").css("height");
      jQuery("#freshpanel").css("height", wp_content_height);
    });
//////////////////////////////////////////////////////////////////////////////
// SELECTBOX function
//////////////////////////////////////////////////////////////////////////////    

  
  setAllSelectEventHandlers();
  
  
  jQuery("body").mouseup(function() {
		jQuery(".scrollbar_wrapper").attr("rel","");
  });

     
  jQuery("body").click(function(){
    jQuery(".select_options_wrapper").css("display","none");
    jQuery(".select_options_wrapper").parent().attr("rel","");

    if(!isSelectChecked) {
		jQuery(last_clicked).parent().find(".select_options_wrapper").css("display","block");
		jQuery(last_clicked).parent().attr("rel","open");
	} else {
		isSelectChecked = false;
	}
	
	last_clicked = null;
  });
  
////////////////////////////////////////////////////
//
///////////////////////////////////////////////////
 jQuery(".selected").css({
      'MozUserSelect' : 'none'
    }).bind('selectstart', function() {
      return false;
    }).mousedown(function() {
      return false;
    });
  jQuery(".scrollbar_wrapper").css({
      'MozUserSelect' : 'none'
    }).bind('selectstart', function() {
      return false;
    }).mousedown(function() {
      return false;
    }); 
 jQuery("ul.select_options li").css({
      'MozUserSelect' : 'none'
    }).bind('selectstart', function() {
      return false;
    }).mousedown(function() {
      return false;
    });
});

function onScrollbarMove(e){
    var difference =   (e.pageY - scroll_click);
                 
    var end_offset = jQuery(".scrollbar_wrapper[rel=scrolling]").parent().offset().top + jQuery(".scrollbar_wrapper[rel=scrolling]").parent().height();
    var start_offset = jQuery(".scrollbar_wrapper[rel=scrolling]").parent().offset().top;
    if(difference + jQuery(".scrollbar_wrapper[rel=scrolling]").height() < end_offset && difference > start_offset)
    { 
      jQuery(".scrollbar_wrapper[rel=scrolling]").css("top", difference - jQuery(".scrollbar_wrapper[rel=scrolling]").parent().offset().top);
       
    }
    else if(difference + jQuery(".scrollbar_wrapper[rel=scrolling]").height() > end_offset)
    {
      jQuery(".scrollbar_wrapper[rel=scrolling]").css("top", jQuery(".scrollbar_wrapper[rel=scrolling]").parent().height() - jQuery(".scrollbar_wrapper[rel=scrolling]").height()) ;
  //    jQuery(".scrollbar_wrapper[rel=scrolling]").offset({ top: end_offset - jQuery(".scrollbar_wrapper[rel=scrolling]").height()}); 
    }
    else if(difference < start_offset)
    {
      jQuery(".scrollbar_wrapper[rel=scrolling]").css("top", 0);
    }
    var scale_height =  jQuery(".scrollbar_wrapper[rel=scrolling]").parent().parent().find(".select_options_container").height();   
    var scale_difference = jQuery(".scrollbar_wrapper[rel=scrolling]").parent().offset().top - jQuery(".scrollbar_wrapper[rel=scrolling]").offset().top;
    var constant =  ((jQuery(".scrollbar_wrapper[rel=scrolling]").parent().parent().find(".select_options").height() - scale_height) / (jQuery(".scrollbar_wrapper[rel=scrolling]").parent().height() - jQuery(".scrollbar_wrapper[rel=scrolling]").height() )); 
     
   if( constant * scale_difference * -1  <  jQuery(".scrollbar_wrapper[rel=scrolling]").parent().parent().find(".select_options").height()  -scale_height)
   {
    jQuery(".scrollbar_wrapper[rel=scrolling]").parent().parent().find(".select_options").css("top", constant * scale_difference);
   }
   else                                                                                                
   {
    jQuery(".scrollbar_wrapper[rel=scrolling]").parent().parent().find(".select_options").css("top", -1*(jQuery(".scrollbar_wrapper[rel=scrolling]").parent().parent().find(".select_options").height()  -scale_height));
   }
  }

  function onSelectedClick() {
	jQuery(this).parent().attr("name", "clicked");
    var status = jQuery(this).parent().attr("rel");
    if(status=="open")
    {
      jQuery(this).parent().find(".select_options_wrapper").css("display","none");
      jQuery(this).parent().attr("rel","");
      jQuery(this).parent().attr("name", "");
    }
    else
    {
      last_clicked = this;
      jQuery(this).parent().find(".select_options_wrapper").css("display","block");
      jQuery(this).parent().attr("rel","open");
      jQuery(this).parent().find(".scrollbar").css("height",100);
      
      var slb_height = jQuery(this).parent().find(".select_options").height();

      if(slb_height > slb_maxheight) {
      
        jQuery(this).parent().find(".scrollbox").css("height",jQuery(this).parent().find(".select_options_container").height());
        var  divider =    jQuery(this).parent().find(".select_options_container").height() / jQuery(this).parent().find(".select_options").height();

  //    alert(jQuery(this).parent().find(".select_options").height() );
        jQuery(this).parent().find(".scrollbar").css("height", jQuery(this).parent().find(".select_options_container").height() * divider );
      }
      else
      {
        //jQuery(this).parent().find(".scrollbox").css("display","none");
		jQuery(this).parent().find(".scrollbox").show();
        jQuery(this).parent().find(".select_options").addClass("select_options_fullwidth");
        jQuery(this).parent().find(".scrollbar").css("display", "none"); 
        jQuery(this).parent().find(".select_options_container").css("height", jQuery(this).parent().find(".select_options").height());
        jQuery(this).parent().find(".scrollbox").css("height",jQuery(this).parent().find(".select_options_container").height());
      }

    }
  }
  
  function onScrollboxMousedown() {
		last_clicked = jQuery(this).parent();
  }
  
  function onScrollbarWrap(e) {   
  last_clicked  = jQuery(this).parent().parent().parent();
    jQuery(this).parent().parent().parent().attr("name", "clicked");
   
    jQuery(this).attr("rel","scrolling");  
    scroll_click = e.pageY -  jQuery(this).offset().top;
  }
  
  function onDivScrollbarMousedown() {
		jQuery("body").bind('mousemove', onScrollbarMove);
  }
  
  function onDivScrollbarMouseUp() {
		jQuery("body").unbind('mousemove', onScrollbarMove);
  }
  
  function onSelectOptionsLiClick() {
	var parent = jQuery(this).parent().parent().parent().parent();
    parent.find(".selected").html(jQuery(this).html());
    parent.find("input").attr("value", jQuery(this).attr('title'));
	var id = parent.find("input").attr('id');
	for(var i = 0, len = arrSelectFunc.length; i < len; i++){
		if(arrSelectFunc[i].id = id){
			arrSelectFunc[i].func();
		}
	}

    //jQuery(this).parent().parent().parent().parent().find(".select_options_wrapper").css("display","none");
	parent.find(".select_options_wrapper").css("display","none");
    parent.attr("rel","");
	
	isSelectChecked = true;
  }
  
  function setAllSelectEventHandlers() {
	jQuery(".selected").bind('click', onSelectedClick);
	jQuery(".scrollbox").bind('mousedown', onScrollboxMousedown);
	jQuery(".scrollbar_wrapper").bind('mousedown', onScrollbarWrap);
	jQuery('div.scrollbar').bind('mousedown', onDivScrollbarMousedown);
	jQuery('div.scrollbar').bind('mouseup', onDivScrollbarMouseUp);
	jQuery(".select_options li").bind('click', onSelectOptionsLiClick);
  }