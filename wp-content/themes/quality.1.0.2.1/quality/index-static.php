<?php
/**
* @Theme Name	:	Quality
* @file         :	index-static.php
* @package      :	Quality
* @author       :	Vibhor
* @license      :	license.txt
* @filesource   :	wp-content/themes/Quality/index-static.php
*/
?>
<!-- Quality Main Slider --->
<?php $current_options=get_option('quality_options') ; ?>

<div class="row">
		<?php 	if($current_options['home_feature']!='')  ?>
			<img src="<?php echo $current_options['home_feature']; ?>"  alt="Quality" class="img-responsive banner" />	
</div>
<!-- /Quality Main Slider --->