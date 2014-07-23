jQuery(document).ready(function($) {
	/** Comment form **/
	$("#commentform #submit").click( function(){
		//#commentform #submit
		$(".error").removeClass("error");
		
		var hasError = false;
		var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
		
		var emailToVal = $("#email").val();
		if (emailToVal == '') {
			//$("#email").after('<span class="error"><span class="linkhighlight"><b>!</b></span>&nbsp;&nbsp;You forgot to enter email address.</span>');
			$("#email").addClass("error");
			hasError = true;
		} else if (!emailReg.test(emailToVal) && emailToVal != undefined) {	
			//$("#email").after('<span class="error"><span class="linkhighlight"><b>!</b></span>&nbsp;&nbsp;Enter a valid email address.</span>');
			$("#email").addClass("error");
			hasError = true;
		}
		
		var nameVal = $("#author").val();
		if (nameVal == '' || nameVal == 'Name' ) {
			//$("#author").after('<span class="error"><span class="linkhighlight"><b>!</b></span>&nbsp;&nbsp;Enter your name.</span>');
			$("#author").addClass("error");
			hasError = true;
		}
		
		var messageVal = $("#comment").val();
		if(messageVal == '' || messageVal == 'Your message') {
			//$("#comment").after('<span class="error"><span class="linkhighlight"><b>!</b></span>&nbsp;&nbsp;You forgot to enter the message.</span>');
			$("#comment").addClass("error");
			hasError = true;
		}
		
		if (hasError == false) {
			var urlVal = $("#url").val();
			if (urlVal == '' || urlVal == 'Website (URL)' ) {
				$("#url").val('');
				urlVal = "";
			}
			/*var install_url = commentpost;
			
			$author = nameVal;
			$email = emailToVal;
			$website = urlVal;
			$message = messageVal;
			$comment_parent = $(".p_container [name=comment_parent]").val();
			$post = $(".p_container [name=comment_post_ID]").val();
			$html = "&_wp_unfiltered_html_comment="+$(".p_container [name=_wp_unfiltered_html_comment]").val();
			
			$.ajax({
				 type: "POST",
				 url: install_url + "wp-comments-post.php",
				 data: "author="+$author+"&email="+$email+"&url="+$website+"&comment="+$message+"&comment_post_ID="+$post+"&comment_parent="+$comment_parent+"&submit=submit comment="+$html,
				 beforeSend:function()
				 {
					$('#comment').attr("disabled", true);
					$('#author').attr("disabled", true);
					$('#email').attr("disabled", true);
					$('#url').attr("disabled", true);
				  },
				 error:function()
				 {
					$('#comment').removeAttr("disabled");
					$('#author').removeAttr("disabled");
					$('#email').removeAttr("disabled");
					$('#url').removeAttr("disabled");
					
					$("#cboxLoadedContent .p_container #respond #commentform").prepend('<p class="error">Error posting comment please try again...</p>');
				  },
				 success: function(response)
				 {								
					$("#comments_hack").html(response);
					var new_list;
					new_list = $("#comments_hack").html();
					$("#cboxLoadedContent").html(new_list);
					$("#respond").slideUp(500);	
					$(".replylink").hide();
				 }
	  		});*/
			document.commentform.submit();
		}
		
		return false;
	});
	
	$('#commentform input').each(function () {
		if ($(this).val() == '') {
			$(this).val($(this).attr('rel'));
		}
	})
	.focus(function () {
		if ($(this).val() == $(this).attr('rel')) {
			$(this).val('');
		}
	})
	.blur(function () {
		if ($(this).val() == '') {
			$(this).val($(this).attr('rel'));
		}
	});
	
	$('#commentform textarea').focus(function () {
		if ($(this).val() == "Your message") {
			$(this).val('');
		}
	})
	.blur(function () {
		if ($(this).val() == '') {
			$(this).val("Your message");
		}
	});
	
	
});