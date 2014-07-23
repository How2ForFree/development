<?php
/*
Template Name: Sidebar Left
*/
?>
<?php get_header() ?>
	<?php include 'page-tagline.php' ?>
	<div id="content-wrapper">
		<div id="content" class="sidebar-left">
			<?php include 'page-common.php' ?>
			<?php get_sidebar(); ?>
			<div class="clear"></div>
		</div>
	</div>
<?php get_footer() ?>