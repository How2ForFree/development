<?php
/**
 * Template Name: Contact
 *
 */

get_header(); ?>
<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/contact/style.css" />
<script type="text/javascript">  
        
$(document).ready(function() {
	
    $("#ajax-contact-form").submit(function() {
        $('#load').append('<center><img src="<?php bloginfo('template_url'); ?>/contact/images/ajax-loader.gif" alt="Currently Loading" id="loading" /></center>');

        var fem = $(this).serialize(),
			note = $('#note');
	
        $.ajax({
            type: "POST",
            url: "<?php bloginfo('template_url'); ?>/contact/contact.php",
            data: fem,
            success: function(msg) {
				if ( note.height() ) {			
					note.slideUp(1000, function() { $(this).hide(); });
				} 
				else note.hide();

				$('#loading').fadeOut(300, function() {
					$(this).remove();

					// Message Sent? Show the 'Thank You' message and hide the form
					result = (msg === 'OK') ? '<div class="success">Your message has been sent. Thank you!</div>' : msg;

					var i = setInterval(function() {
						if ( !note.is(':visible') ) {
							note.html(result).slideDown(1000);
							clearInterval(i);
						}
					}, 40);    
				}); // end loading image fadeOut
            }
        });

        return false;
    });
});


</script>  
<!-- Begin Container -->

<div id="container"> 
  <!-- Begin Page Intro -->
  <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
  <?php
    $intro = get_post_meta($post->ID, 'intro', true); 

	if ($intro) {
	    echo "<h3 class='intro'>$intro<span></span></h3>";
	}
?>
  <!-- End Page Intro -->
  
  <div class="contact-form">
    <?php the_content(); ?>
    
    <!--begin:contact form block-->
<div id="contactform">
	<fieldset>
	
	<!--begin:notice message block-->
	<div id="note"></div>
	<!--begin:notice message block-->

		<form id="ajax-contact-form" method="post" action="javascript:alert('success!');">
            <input class="required inpt" type="hidden" name="to" value="<?php echo get_option("of_email");?>" />
			<input class="required inpt" type="text" name="name" value="" /><label>Name</label><br />
			<input class="required inpt" type="text" name="email" value="" /><label>E-Mail</label><br />
			<input class="required inpt" type="text" name="subject" value="" /><label>Subject</label><br />
			<textarea class="textbox" name="message" rows="6" cols="30"></textarea><br />
			<input class="required inpt" type="text" name="answer" value="" /><label>Are you human? 3-1+2 </label><br />
			<label id="load" style="display:none"></label>
<button type="submit">Submit</button>
		</form>
	</fieldset>
<!--end:contact form block--> 
    
  </div>  </div>
  
  <!-- Begin Information -->
  <div class="information">
    <ul class="contact-info">
      <?php
    $address = get_post_meta($post->ID, 'address', true);
    $phone = get_post_meta($post->ID, 'phone', true);
    $email = get_post_meta($post->ID, 'email', true);
    
    

	if ($address) {
	    echo "<li class='home'>$address</li>";
	}
	if ($phone) {
	    echo "<li class='tel'>$phone</li>";
	}
	if ($email) {
	    echo "<li class='mail'>$email</li>";
	}
?>
    </ul>
    <!-- Begin Map -->
    
    <?php
    $map = get_post_meta($post->ID, 'map', true);
    
    

	if ($map) {
	    echo "<div class='map'><iframe width='393' height='217' frameborder='0' scrolling='no' marginheight='0' marginwidth='0' src='$map &amp;output=embed'></iframe></div>";
	}
	
?>
    
    <!-- End Map --> 
  </div>
  <!-- End Information -->
  
  <?php endwhile; endif; ?>
</div>
<?php get_footer(); ?>
