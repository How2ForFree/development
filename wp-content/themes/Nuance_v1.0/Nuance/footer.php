<?php
/* ------------------------------------------------------------------------------------------------------------
	
	Page part template - Footer
	
------------------------------------------------------------------------------------------------------------ */
?>
	
	<?php global $domain; /* The unique string used for translation */ ?>
	
	<?php $sidebar_name = 'Footer Widgets'; ?>
	
	<?php include TEMPLATEPATH.'/functions/jwpanel/jwpanel-get.php'; ?>
				
		</div><!-- #main -->
		
		<div id="footer">
			<div class="wrap960 col-clear">
				<div id="footer-inner">
				
					<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar($sidebar_name)) : else : ?>
			
						<!-- No widgets START -->
						
						<div class="widget">
							<h6 class="widget-title"><?php _e('No Widgets Added Yet', $domain); ?></h6>
							<p><em><?php _e('Please add them in the WordPress admin page under Appearance &rarr; Widgets. The widget section is', $domain); echo ' "'.$sidebar_name.'".'; ?></em></p>
						</div>
						
						<!-- No widgets END -->
						
					<?php endif; ?>
					
				</div><!-- #footer-inner -->
			</div><!-- .wrap960 -->
		</div><!-- #footer -->
		
		<?php wp_footer(); ?>

		<?php if($jw_analytics != ''){ echo $jw_analytics; } ?>
		
	</body>
	</html>	