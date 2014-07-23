<?php

global $uds_general_options;

?>
<div class="wrap">
	<h2><?php echo UDS_TEMPLATE_NAME ?> - <?php _e('General Options', 'uds-textdomain') ?></h2>
	<?php uds_render_options_form($uds_general_options) ?>
</div>
<?php uds_render_js_support() ?>