<?php
/**
* @Theme Name	:	Quality
* @file         :	footer.php
* @package      :	Quality
* @author       :	Vibhor
* @license      :	license.txt
* @filesource   :	wp-content/themes/quality/footer.php
*/
?>
<?php $current_options=get_option('quality_options'); ?>
<div class="qua_footer_area">
	<div class="container">
		<div class="col-md-12">
			<p><?php if($current_options['footer_customizations']!='') { echo $current_options['footer_customizations']; } ?>
			<a target="_blank" rel="nofollow" href="<?php if($current_options['created_by_link']!='') { echo $current_options['created_by_link']; } ?>"><?php if($current_options['created_by_link']!='') { echo $current_options['created_by_link'];} ?></a></p>
		</div>	
	</div>	
</div>
<?php
if($current_options['webrit_custom_css']!='') {  ?>
<style>
<?php echo $current_options['webrit_custom_css']; ?>
</style>
<?php } ?>	
<!-- /Footer Widget Secton -->
<?php wp_footer(); ?>
</body>
</html>