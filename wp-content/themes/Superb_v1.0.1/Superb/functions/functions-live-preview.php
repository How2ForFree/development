<?php

add_action('init', 'uds_live_preview_init');
function uds_live_preview_init()
{
	if(!UDS_LIVE_PREVIEW) return;
	global $homepage_config;
	session_start();
	
	add_action('wp_footer', 'uds_live_preview_markup');
	
	$homepage_configs = array('ubillboard', 'image', 'none');
	
	if(isset($_GET['homepage_config']) && in_array($_GET['homepage_config'], $homepage_configs)) {
		$homepage_config = $_GET['homepage_config'];
	} else {
		$homepage_config = 'ubillboard';
	}
	
	$theme = get_template_directory_uri();
	
	wp_enqueue_style('uds-live-preview', $theme . '/css/live-preview.css');
	wp_enqueue_script('uds-live-preview', $theme . '/js/live-preview.js', array('jquery', 'scripts'));
}

function uds_live_preview_markup()
{
	$color = uds_driving_color();
	?>
		<div class="uds-live-preview">
			<div class="uds-color-wheel">
				<div class="uds-color-wheel-selection"></div>
			</div>
			<div class="uds-preview-dragger">&raquo;</div>
			<form method="post" class="live-preview-form" action="<?php the_permalink() ?>">
				<fieldset>
					<input type="hidden" name="color" value="<?php echo esc_attr($color) ?>" />
					<input type="submit" value="<?php esc_attr_e('Apply color to all page elements', 'uds-textdomain') ?>" class="submit" />
				</fieldset>
			</form>
		</div>
	<?php
}

?>