<?php if(!isset($post_custom['jw_show_intro'][0]) || $post_custom['jw_show_intro'][0] == 'yes'){ ?>

	<div class="intro sub">
		
		<?php if(isset($post_custom['jw_title'][0])){ /* Custom or regular post/page title */ ?>
			<h1><?php echo $post_custom['jw_title'][0]; ?></h1>
		<?php }else{ ?>
			<h1><?php the_title(); ?></h1>
		<?php } ?>
		
		<?php if(isset($post_custom['jw_description'][0])){ /* Page description */ ?>
			<p><?php echo $post_custom['jw_description'][0]; ?></p>
		<?php } ?>
		
	</div><!-- .intro.sub -->
	
	<?php if($post_custom['jw_layout'][0] != 'layout_p1'){ ?>
		<div class="hr"></div>
	<?php } ?>

<?php } ?>