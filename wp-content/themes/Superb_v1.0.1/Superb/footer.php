	<div id="footer-wrapper">
	    <div id="footer-top"></div>
	    <?php $footer_config = (int)uds_get_option('uds-footer-config', 'uds_footer_options', 3); ?>
	    <div id="footer-inner" class="footer-config-<?php echo $footer_config ?>">
	    	<?php for($i = 1; $i <= $footer_config; $i++): ?>
				<div class="footer-column <?php echo $i == $footer_config ? 'last' : '' ?>">
					<?php dynamic_sidebar('footer'.$i); ?>
				</div>
			<?php endfor; ?>
	    	<div class="clear"></div>
	    </div>
	    <div id="footer-bottom">
	    	<div id="footer-bottom-inner">
	    		<div class="left social-footer">
	    			<?php echo '' != uds_get_option('uds-rss', 'uds_social_options') 		? '<a href="'.esc_url(uds_get_option('uds-rss', 'uds_social_options')).'" class="rss"><img src="'.get_template_directory_uri().'/images/footer-rss.png" alt="png" class="social"/></a>' : '' ?>
	    			<?php echo '' != uds_get_option('uds-skype', 'uds_social_options') 	? '<a href="callto://'.esc_url(uds_get_option('uds-skype', 'uds_social_options')).'" class="skype"><img src="'.get_template_directory_uri().'/images/footer-skype.png" alt="png" class="social"/></a>' : '' ?>
	    			<?php echo '' != uds_get_option('uds-facebook', 'uds_social_options') ? '<a href="'.esc_url(uds_get_option('uds-facebook', 'uds_social_options')).'" class="facebook"><img src="'.get_template_directory_uri().'/images/footer-facebook.png" alt="png" class="social"/></a>' : '' ?>
	    			<?php echo '' != uds_get_option('uds-twitter', 'uds_social_options') 	? '<a href="'.esc_url(uds_get_option('uds-twitter', 'uds_social_options')).'" class="twitter"><img src="'.get_template_directory_uri().'/images/footer-twitter.png" alt="png" class="social"/></a>' : '' ?>
	    			<?php echo '' != uds_get_option('uds-youtube', 'uds_social_options') 	? '<a href="'.esc_url(uds_get_option('uds-youtube', 'uds_social_options')).'" class="youtube"><img src="'.get_template_directory_uri().'/images/footer-youtube.png" alt="png" class="social"/></a>' : '' ?>
	    			<?php echo '' != uds_get_option('uds-flickr', 'uds_social_options') 	? '<a href="'.esc_url(uds_get_option('uds-flickr', 'uds_social_options')).'" class="flickr"><img src="'.get_template_directory_uri().'/images/footer-flickr.png" alt="png" class="social"/></a>' : '' ?>
	    			<?php echo '' != uds_get_option('uds-linkedin', 'uds_social_options') ? '<a href="'.esc_url(uds_get_option('uds-linkedin', 'uds_social_options')).'" class="linkedin"><img src="'.get_template_directory_uri().'/images/footer-linkedin.png" alt="png" class="social"/></a>' : '' ?>
	    		</div>
	    		<?php $logo = esc_url(uds_get_option('uds-footer-logo', 'uds_footer_options')) ?>
	    		<?php if(!empty($logo)): ?>
		    		<img src="<?php echo $logo ?>" alt="Logo" class="footer-logo" />
	    		<?php endif; ?>
	    		<div class="right">
	    			<p class="copyright">&copy; <?php echo date('Y') ?> <?php echo esc_html(uds_get_option('uds-copyright', 'uds_footer_options')) ?></p>
	    		</div>
	    		<div class="clear"></div>
	    	</div>
	    </div>
	</div>
	
	<?php wp_footer() ?>
	
	<script type="text/javascript">
		//<![CDATA[
			// GMap widget support
	    	jQuery(document).ready(function($){// return;
				$('.uds-google-map').each(function(){
					var mapContainer = this;
					var lat = parseInt($('.lat', this).remove().text(), 10);
					var lng = parseInt($('.lng', this).remove().text(), 10);
					var center = new google.maps.LatLng(lat, lng);
					
					var type = null;
					switch($('.mapTypeId', this).remove().text()){
						case 'ROADMAP':
							type = google.maps.MapTypeId.ROADMAP;
							break;
						case 'SATELLITE':
							type = google.maps.MapTypeId.SATELLITE;
							break;
						case 'TERRAIN':
							type = google.maps.MapTypeId.TERRAIN;
							break;
						case 'HYBRID':
						default:
							type = google.maps.MapTypeId.HYBRID;
							break;
					}
					
					var options = {
						center: center,
						zoom: parseInt($('.zoom', this).remove().text(), 10),
						scrollwheel: $('.wheel', this).remove().text() == "true" ? true : false,
						mapTypeId: type,
						mapTypeControl: $('.mapTypeControl', this).remove().text() == "true" ? true : false,
						navigationControl: $('.navigationControl', this).remove().text() == "true" ? true : false,
						scaleControl: $('.scaleControl', this).remove().text() == "true" ? true : false,
						streetViewControl: $('.streetViewControl', this).remove().text() == "true" ? true : false
					};
					
					$(mapContainer).css({
						width: $('.width', this).remove().text(),
						height: $('.height', this).remove().text()
					});
					
					var doMarker = $('.marker', this).remove().text() == "true" ? true : false;
					var markerContent = '';
					if($('.marker-content', this).size() > 0) {
						markerContent = $('.marker-content', this).remove().html();
					}
					
					try {
						var map = new google.maps.Map(mapContainer, options);			
						
						$(mapContainer).show();
						
						var marker;									
						if(true == doMarker) {
							marker = new google.maps.Marker({
						    	position: center, 
						    	map: map
		  					});
		  				}
		  				
		  				var infoWindow;
		  				if(true === doMarker && markerContent !== '') {
		  					infoWindow = new google.maps.InfoWindow({
								content: markerContent
							});
							
							google.maps.event.addListener(marker, 'click', function(){
			  					infoWindow.open(map, marker);
			  				});
		  				
			  				infoWindow.open(map, marker);
		  				}
					} catch(err) {}
				});
			});
		//]]>
	</script>
	
	<?php if(uds_get_option('uds-ga', 'uds_general_options') == 'on'): ?>
	<?php $ga = uds_get_option('uds-ga-tracking-code', 'uds_general_options'); ?>
		<script type="text/javascript">
		    var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
		    document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
		</script>
		<script type="text/javascript">
		    try {
		    	var pageTracker = _gat._getTracker("<?php echo $ga?>");
		    	<?php $tracking_domain = uds_get_option("uds-ga-tracking-domain", 'uds_general_options') ?>
		    	<?php if(!empty($tracking_domain)): ?>
		    		pageTracker._setDomainName("<?php echo $tracking_domain ?>");
		    	<?php endif; ?>
		    	pageTracker._trackPageview();
		    } catch(err) {}
		</script>
	<?php endif; ?>
</body>
</html>