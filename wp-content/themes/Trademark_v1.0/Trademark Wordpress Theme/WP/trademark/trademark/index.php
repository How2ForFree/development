<?php get_header(); ?>
<!-- CONTAINER -->
<div id="container" class="subpage clearfix">
    <!-- CONTENT -->
	<div id="content" class="mainbar">
    <div id="content-wrapper">
        <?php get_template_part( 'loop', 'index' ); ?>
    </div><!-- /#content-wrapper -->
	</div><!-- #content -->
	
	<?php get_sidebar(); ?>
</div><!-- #container -->
<?php get_footer(); ?>
