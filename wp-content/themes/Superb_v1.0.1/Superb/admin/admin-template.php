<div class="uds-wrap">
	<?php uds_admin_render_header() ?>
	<?php uds_admin_render_sidebar() ?>
	<div class="uds-admin-main">
		<h2><?php echo $heading ?></h2>
		<?php uds_render_options_form($options) ?>
	</div>
</div>
<?php uds_render_js_support() ?>