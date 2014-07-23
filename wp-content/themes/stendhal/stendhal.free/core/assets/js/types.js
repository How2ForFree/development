// Types JavaScript Document
jQuery(document).ready(function($){


	//upload
 	$('input.upload_button').live('click',function() { 
		var upField = $(this).prev();
		var this_button = $(this);
				
		tb_show('', 'media-upload.php?post_id=0&type=image&TB_iframe=true&width=700');    
		
		window.send_to_editor = function(html) {
			//alert(html);
						
			imgurl = $('a', '<div>' + html + '</div>').attr('href');
			upField.val(imgurl);
      upField.change();
			console.log(upField);
			//upId.val(idimg[1]);
						
			if ( ! this_button.hasClass('upload-button') ) {
		 		$image_preview = upField.parents('.sortItem').find('.ss-ImageSample');
				if( $image_preview.length > 0 ) $image_preview.attr('src',imgurl);
			}
      
			tb_remove();
		}          
    
		return false;
	});  
	
	// select
    var select_value = function() {
        var value = $(this).children("option:selected").text();
        
        if( value == '' )
            value = $(this).children().children("option:selected").text();
        
                                                                        
        if ( $(this).parent().find('span').length <= 0 ) {  
            $(this).before('<span></span>');
        }
        
        $(this).parent().children('span').replaceWith('<span>'+value +'</span>'); 
    };                
    $('.select_wrapper select').each(select_value).change(select_value);
  
    // preview  
    $('.upload_img_url').change(function(){
        var url = $(this).val();
        var re = new RegExp("(http|ftp|https)://[a-zA-Z0-9@?^=%&amp;:/~+#-_.]*.(gif|jpg|jpeg|png|ico)");
        
        var preview = $(this).parent().siblings('.upload_img_preview');
        if(re.test(url)) {
        	preview.html('<img src="'+url+'" style="max-width:600px; max-height:300px;" />');
        } else {
        	preview.html('');
        }
    }).change();
  
  
  	//wp editor
	$('.submit [type=submit]').on('click', function(){
		$('.wp-editor-wrap.tmce-active .switch-html').click(function(){
			$(this).addClass('yit_switch_changed');
		}).click();
		
		$('.yit_switch_changed').removeClass('yit_switch_changed').next().click();
    });
});
